<?php

namespace App\Http\Controllers;

use App\Models\Info;
use App\Models\User;
use App\Models\Movie;
use App\Models\Theater;
use App\Models\Banner;
use App\Models\Schedule;
use App\Models\RoomType;
use App\Models\SeatType;
use App\Models\Combo;
use App\Models\Ticket;
use App\Models\Seat;
use App\Models\Price;
use App\Models\TicketSeat;
use App\Models\TicketCombo;
use App\Models\MovieGenres;
use App\Models\Rating;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use SimpleSoftwareIO\QrCode\Facades\QrCode;


class MainController extends Controller
{
    public function __construct()
    {
        $info = Info::find(1);
        view()->share('info', $info);
    }

    public function profile(){
        $user = Auth::user();
        $sum = 0;
        foreach ($user['ticket'] as $ticket) {
            $sum += $ticket['totalPrice'];
        }
        $sort_ticket = $user['ticket']->sortDesc();
        $sum_percent = ($sum * 100) / 4000000;
        return view('web.profile', ['sort_ticket' => $sort_ticket, 'user' => $user, 'sum' => $sum, 'sum_percent' => $sum_percent]);
    }

    public function admin(){
        return view('admin.web.home');
    }

    public function home(){
        $movies = Movie::where('status', 1)->get();
        $banners = Banner::where('status', 1)->get();
        return view('web.home', [
            'movies' => $movies,
            'banners' => $banners
        ]);
    }

    public function movieDetails($id, Request $request)
    {
        $movie = Movie::find($id);
        $roomTypes = RoomType::all();
        $cities = [];
        $theaters = Theater::where('status', 1)->get();
        foreach ($theaters as $theater) {
            if (in_array($theater->city, $cities)) {
                continue;
            } else {
                array_push($cities, $theater->city);
            }
        }
        date_default_timezone_set('Asia/Ho_Chi_Minh'); // Thiết lập múi giờ cho múi giờ của Việt Nam
        $current_time = date('H:i');
        return view('web.movieDetails', [
            'current_time' => $current_time,
            'movie' => $movie,
            'cities' => $cities,
            'roomTypes' => $roomTypes,
            'roomTypes' => $roomTypes,
            'theaters' => $theaters,
        ]);
    }

    public function news(){
        return view('web.news');
    }

    public function contact(){
        return view('web.contact');
    }

    public function login(){
        return view('web.login');
    }

    public function register(){
        return view('web.register');
    }

    public function movies(){
        $movies = Movie::all();
        $genres = MovieGenres::all();
        $rating = Rating::all();
        return view('web.movies', 
        [
            'movies' => $movies, 
            'genres' => $genres,
            'rating' => $rating,
        ]);
    }


    public function theater(){
        $movies = Movie::all();
        $roomTypes = RoomType::all();
        $cities = [];
        $theaters = Theater::where('status', 1)->get();
        foreach ($theaters as $theater) {
            if (in_array($theater->city, $cities)) {
                continue;
            } else {
                array_push($cities, $theater->city);
            }
        }
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $current_time = date('H:i');
        return view('web.theater',[
            'current_time' => $current_time,
            'movies' => $movies,
            'cities' => $cities,
            'roomTypes' => $roomTypes,
            'theaters' => $theaters,
        ]);
    }

    public function test(Request $request ){
        dd($request->all());
    }

    public function ticket($schedule_id){
        if(Auth::check()){
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
            return view('web.ticket',[
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
        else {
            return redirect('/login')->with('warning', 'Yêu cầu đăng nhập');
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
        foreach ($request->ticketSeats as $i => $seat) {
            $seatArray = json_decode($seat, true);
            foreach ($seatArray as $seatId => $seats) {
                // Lấy thông tin từ mỗi combo
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
        if($request->ticketPayment === 'QR'){
            return redirect('/paymentQR/' . $ticket->id);
        }
        if($request->ticketPayment === 'ATM'){
            return redirect('/paymentATM/' . $ticket->id);
        }
    }

    public function ticketPaid($ticket_id){
        $ticket = Ticket::find($ticket_id);
        $ticketCombo = TicketCombo::where('ticket_id',$ticket_id)->get();
        $ticketSeat = TicketSeat::where('ticket_id',$ticket_id)->get();
        $user = User::find($ticket->user_id);
        return view('web.ticketPaid',[
            'ticket' => $ticket,
            'ticketCombo' => $ticketCombo,
            'ticketSeat' => $ticketSeat,
            'user' => $user,
        ]);
    }

    // Thanh toán momo

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
        $redirectUrl = "http://127.0.0.1:8000/ticketPaid/".$ticket_id;
        $ipnUrl = "http://127.0.0.1:8000/ticketPaid/".$ticket_id;
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


    public function paymentATM($ticket_id){
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
        $orderInfo = "Thanh toán qua MoMo";
        $amount = $ticket->totalPrice;
        $orderId = $ticket->code;
        $redirectUrl = "http://127.0.0.1:8000/ticketPaid/".$ticket_id;
        $ipnUrl = "http://127.0.0.1:8000/ticketPaid/".$ticket_id;
        $extraData = "";
        

        $requestId = time() . "";
        $requestType = "payWithATM";
        // $extraData = ($_POST["extraData"] ? $_POST["extraData"] : "");
        //before sign HMAC SHA256 signature
        $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
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
    }

    public function search(Request $request)
    {
        $request->validate(
            [
                'search' => 'required|min:3',
            ],
            [
                'search.required' => 'Nhập tìm kiếm',
            ]
        );
        $result = new Collection();
        $movies = Movie::select('movies.*')
            ->join('movieGenres_movies', 'movies.id', '=', 'movieGenres_movies.movie_id')
            ->join('movie_genres', 'movieGenres_movies.movieGenre_id', '=', 'movie_genres.id')
            ->where('movies.status', '=', '1')
            ->where('movie_genres.name', 'like', '%' . $request->search . '%')
            ->orWhere('movies.name', 'like', '%' . $request->search . '%')->get();
        foreach ($movies as $movie) {
            if (!$result->contains('id', $movie->id)) {
                $result->push($movie);
            }
        }
        return view('web.search', ['result' => $result, 'search' => $request->search]);
    }

    public function movieFilter(Request $request){
        $result = new Collection();
        foreach ($request->movieGenres as $value) {
            $movies = Movie::select('movies.*')
            ->join('movieGenres_movies', 'movies.id', '=', 'movieGenres_movies.movie_id')
            ->join('movie_genres', 'movieGenres_movies.movieGenre_id', '=', 'movie_genres.id')
            ->where('movies.status', '=', '1')
            ->where('movie_genres.id', '=', $value)->get();
            foreach ($movies as $movie) {
                if (!$result->contains('id', $movie->id)) {
                    $result->push($movie);
                }
            }
        }
        if ($request->rating){
            $rating = Rating::find($request->rating);
            
        }
        dd($result);


    }
}
