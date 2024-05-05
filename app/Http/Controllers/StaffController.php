<?php

namespace App\Http\Controllers;

use App\Models\Combo;
use App\Models\Food;
use App\Models\Movie;
use App\Models\Price;
use App\Models\RoomType;
use App\Models\Schedule;
use App\Models\Seat;
use App\Models\SeatType;
use App\Models\Ticket;
use App\Models\TicketSeat;
use App\Models\TicketCombo;
use App\Models\TicketFood;
use App\Models\StaffTheater;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StaffController extends Controller
{
    public function addUser(){
        return view('admin.web.addUser');
    }
    public function buyTicket(Request $request) {
        $theater = Auth::user()->StaffTheater;
        if (isset($request->date)) {
            $date_cur = $request->date;
        } else {
            $date_cur = date('Y-m-d');
        }
        $roomTypes = RoomType::all();
        $movies = Movie::whereDate('releaseDate', '<=', Carbon::today()->format('Y-m-d'))
            ->where('endDate', '>', Carbon::today()->format('Y-m-d'))
            ->get();
        $moviesEarly = Movie::all()->filter(function ($movie) {
            foreach ($movie->schedules as $schedule) {
                if ($schedule->status && $movie->releaseDate > date('Y-m-d')) {
                    return $movie;
                }
            }
            return null;
        });
        return view('admin.web.buyTicket', [
            'movies' => $movies,
            'moviesEarly' => $moviesEarly,
            'theater' => $theater,
            'date_cur' => $date_cur,
            'roomTypes' => $roomTypes,
        ]);
    }

    public function Hadpaid() {
        return redirect('admin/buyTicket')->with('success', 'Thanh toán thành công!');
    }


    public function ticket($schedule_id) {
        $seatTypes = SeatType::all();
        $combos = Combo::where('status', 1)->get();
        $tickets = Ticket::where('schedule_id', $schedule_id)->get();
        $schedule = Schedule::find($schedule_id);
        if (strtotime($schedule->startTime) < strtotime('17:00')) {
            $price = Price::where('generation', 'vtt')
                ->where('day', 'like', '%' . date('l', strtotime($schedule->date)) . '%')
                ->where('after', '08:00')->get()->first()->price;
        } else {
            $price = Price::where('generation', 'vtt')
                ->where('day', 'like', '%' . date('l', strtotime($schedule->date)) . '%')
                ->where('after', '17:00')->get()->first()->price;
        }
        $roomSurcharge = $schedule->room->roomType->surcharge;
        $room = $schedule->room;
        $movie = $schedule->movie;

        return view('admin.web.ticketBuy', [
            'schedule' => $schedule,
            'room' => $room,
            'seatTypes' => $seatTypes,
            'roomSurcharge' => $roomSurcharge,
            'price' => $price,
            'movie' => $movie,
            'tickets' => $tickets,
            'combos' => $combos,
        ]);
    }

    public function scanBarcode(Request $request) {
        $user = User::where('code', $request->code)->get()->first();
        if (!$user) {
            return response('user not found', 500);
        }
        return response()->json([
            'username' => $user->fullName,
            'userPoint' => $user->point,
            'userId' => $user->code,
        ]);
    }

    public function checkUser(Request $request){
        $userCode = $request->input('userCode');
        $user = User::where('code', $userCode)->first();

        if ($user) {
            return response()->json(['success' => true, 'user' => $user]);
        } else {
            return response()->json(['success' => false]);
        }
    }

    public function createTicket (Request $request)
    {
        $ticket = new Ticket([
            'schedule_id' => $request->schedule_id,
            'user_id' => $request->user_id,
            'code'=>rand(1000000000000000, 9999999999999999),
            'payment' => $request->ticketPayment,
            'totalPrice' => $request->totalPrice,
        ]);
        $ticket->save();
        if ($request->ticketSeats) {
            foreach ($request->ticketSeats as $i => $seat) {
                $seatArray = json_decode($seat, true);
                foreach ($seatArray as $seatId => $seats) {
                    $seatRow = $seats[0];
                    $seatCol = $seats[1];
                    $seatPrice = $seats[2];
                    $roomId = new Schedule;
                    $ticketSeat = new TicketSeat([
                        'row' => $seatRow,
                        'col' => $seatCol,
                        'price' => $seatPrice,
                        'ticket_id' => $ticket->id,
                    ]);
                    $seats = Seat::where('row', $seatRow)->where('col', $seatCol)->where('room_id', $ticket->schedule->room_id)->get()->first();
                    $ticketSeat->seatType = $seats->seatType->name;
                    $ticketSeat->save();
                }
            }
        }

        if($request->ticketCombos){
            foreach ($request->ticketCombos as $combo) {
                $comboArray = json_decode($combo, true);
                $comboId = key($comboArray);
                if ($comboId !== null) {
                    $comboName = $comboArray[$comboId]['name'];
                    $quantity = $comboArray[$comboId]['quantity'];
                    $ticketcombo = new TicketCombo([
                        'comboName' => $comboName,
                        'quantity' => $quantity,
                        'ticket_id' => $ticket->id,
                    ]);
                    $ticketcombo->save();
                }
            }
        }

        if($request->ticketPayment === 'QR'){
            return redirect('/admin/paymentQR/' . $ticket->id);
        }
        if($request->ticketPayment === 'MONEY'){
            return view('admin.web.payTicket', [
                'ticket' => $ticket
            ]);
        }
    }

    public function paymentQR($ticket_id){
        $ticket = Ticket::find($ticket_id);
        function execPostRequest($url, $data)
        {
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                    'Content-Type: application/json',
                    'Content-Length: ' . strlen($data))
            );
            curl_setopt($ch, CURLOPT_TIMEOUT, 5);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
            //execute post
            $result = curl_exec($ch);
            //close connection
            curl_close($ch);
            return $result;
        }


        $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";


        $partnerCode = 'MOMOBKUN20180529';
        $accessKey = 'klm05TvNBzhg7h7j';
        $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
        $orderInfo = "Thanh toán qua QR MoMo";
        $amount = $ticket->totalPrice;
        $orderId = $ticket->code;
        $redirectUrl = "http://127.0.0.1:8000/admin/buyTicket/Success";
        $ipnUrl = "http://127.0.0.1:8000/admin/buyTicket/Success";
        $extraData = "";
        $autoCapture =FALSE;

            $requestId = time() . "";
            $requestType = "captureWallet";
            // $extraData = ($_POST["extraData"] ? $_POST["extraData"] : "");
            //before sign HMAC SHA256 signature
            $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId  . "&requestType=" . $requestType;
            $signature = hash_hmac("sha256", $rawHash, $secretKey);
            $data = array('partnerCode' => $partnerCode,
                'partnerName' => "Test",
                "storeId" => "MomoTestStore",
                'requestId' => $requestId,
                'amount' => $amount,
                'orderId' => $orderId,
                'orderInfo' => $orderInfo,
                'redirectUrl' => $redirectUrl,
                'ipnUrl' => $ipnUrl,
                'lang' => 'vi',
                'extraData' => $extraData,
                'requestType' => $requestType,
                'signature' => $signature);
            $result = execPostRequest($endpoint, json_encode($data));
            $jsonResult = json_decode($result, true);  // decode json
            //Just a example, please check more in there
            return redirect($jsonResult['payUrl']);
            sleep(10);
    }

    public function handleResult(Request $request)
    {
        if ($request->type == 'ticket') {
            return redirect('admin/buyTicket')->with('success', 'Thanh toán thành công!');
        } else {
            return redirect('admin/buyCombo')->with('success', 'Thanh toán thành công!');
        }
        return redirect('admin/buyTicket')->with('fail', 'Thanh toán thất bại!');
    }

    public function delete($id)
    {
        $ticket = Ticket::find($id);
        $ticket->delete();
        return redirect('admin/buyTicket')->with('fail', 'Thanh toán thất bại!');
    }

    public function scanTicket() {
        return view('admin.scanTicket.scanTicket');
    }

    public function handleScanTicket(Request $request) {
        $message = 'vé hợp lệ';
        $check = true;
        $seatsList = '';
        $ticket = Ticket::where('code',  $request->code)->first();

        if ($ticket) {
            if ($ticket->schedule->date == date('Y-m-d')) {
                if (strtotime('- 10 minutes', strtotime($ticket->schedule->startTime)) > strtotime(date('H:i:s'))) {
                    $message = 'Chưa đến giờ chiếu phim';
                    $check = false;
                    $ticket->status = true;
                } else {
                    if (strtotime($ticket->schedule->endTime) > strtotime(date('H:i:s'))) {
                        if ($ticket->status) {
                            $ticket->status = false;
                            $check = true;
                            $message = 'vé hợp lệ';
                        } else {
                            $message = 'vé không hợp lệ';
                            $check = false;
                        }
                    } else {
                        $message = 'suất chiếu đã kết thúc';
                        $check = false;
                        $ticket->status = false;
                    }
                }

            } else if ($ticket->schedule->date > date('Y-m-d')) {
                    $message = 'Chưa đến ngày chiếu phim';
                    $check = false;
                    $ticket->status = true;
            } else  {
                $message = 'suất chiếu đã kết thúc';
                $check = false;
                $ticket->status = false;
            }

            $ticket->save();

            foreach ($ticket->ticketSeats as $seats) {
                $seatsList .= $seats->row.$seats->col.',';
            }
        } else {
            $message = 'không tìm thấy vé';
            $check = false;
        }

        return response()->json([
            'theater' => $ticket->schedule->room->theater->name,
            'room' => $ticket->schedule->room->name,
            'movie' => $ticket->schedule->movie->name,
            'seats' => $seatsList,
            'date' => $ticket->schedule->date,
            'startTime' => $ticket->schedule->startTime,
            'message' => $message,
            'check' => $check,
        ]);
    }

    public function buyCombo(Request $request) {
        $combos = Combo::where('status', 1)->get();
        $foods = Food::where('status', 1)->get();
        return view('admin.web.buyCombo', [
            'combos' => $combos,
            'foods' => $foods,
        ]);
    }



    public function scanCombo() {
        return view('admin.scanCombo.scanCombo');
    }

    public function handleScanCombo(Request $request) {
        $ticket = Ticket::where('code', $request->code)->first();
        $message = 'vé hợp lệ';
        $check = true;

        if (!$ticket) {
            $message = 'không tìm thấy vé';
            $check = false;
        } else {
            if ($ticket->receivedCombo) {
                $message = 'Đã lấy đồ ăn';
                $check = false;
            } else {
                $ticket->receivedCombo = true;
            }
        }
        $comboHtml = '<ul>';
        foreach ($ticket->ticketCombos as $combo) {
            $comboHtml .= '<li>'.$combo->quantity.' X '.$combo->comboName.'<br>('.$combo->comboDetails.')</li>';
        }

        foreach ($ticket->ticketFoods as $food) {
            $comboHtml .= '<li>'.$food->quantity.' X '.$food->foodName.'</li>';
        }
        $comboHtml .= '</ul>';

        $ticket->save();

        return response()->json([
            'comboHtml' => $comboHtml,
            'message' => $message,
            'check' => $check,
        ]);
    }

    public function ticketComboPayment(Request $request) {
        $ticket = Ticket::find($request->ticket_id);
        $ticket->holdState = false;
        $ticket->totalPrice = $request->totalPrice;
        $ticket->save();

        return response('', 200);
    }
}