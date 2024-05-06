<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use App\Models\Theater;
use App\Models\Ticket;
use App\Models\TicketSeat;
use App\Models\Info;
use App\Models\User;
use App\Models\Movie;
use App\Models\StaffTheater;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function __construct()
    {
        $info = Info::find(1);
        view()->share('info', $info);
    }

    public function login(Request $request){
        $request->validate(
            [
                'username' => 'required',
                'password' => 'required'
            ],
            [
                'username.required' => 'Vui lòng nhập email quản lý hoặc nhân viên',
                'password.required' => 'Vui lòng nhập mật khẩu!'
            ]
        );
        $email = Auth::attempt(['email' => $request['username'], 'password' => $request['password']]);
        $phone = Auth::attempt(['phone' => $request['username'], 'password' => $request['password']]);
        
        if ($email || $phone) {
            if(Auth::user()->role =='admin') {
                return redirect('/admin')->with('success','Đăng nhập tài khoản admin thành công');
            } elseif(Auth::user()->role =='staff') {
                return redirect('/admin/staff')->with('success','Chào mừng bạn '.Auth::user()->fullname.' !');
            }
        } else {
            return redirect('/admin')->with('warning','Sai tài khoản hoặc mật khẩu');
        }
    }

    public function logout(){
        Auth::logout();
        return redirect('/admin')->with('success','Đăng xuất thành công');
    }

    public function home()
    {
        if (Auth::user()) {
            if (Auth::user()->role == 'admin') {
                $info = Info::find(1);
                $now = Carbon::now('Asia/Ho_Chi_Minh')->endOfDay();
                $year = Carbon::now('Asia/Ho_Chi_Minh')->subDays(365)->startOfYear()->toDateString();
                $start_of_month = Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth();
                $total_year = Ticket::whereBetween('created_at', [$year, $now])->orderBy('created_at', 'ASC')->get();
                $theaters = Theater::orderBy('id', 'ASC')->get();
                $ticket = Ticket::whereDate('created_at', Carbon::today())->get();
                $ticket_seat = TicketSeat::get()->whereBetween('created_at', [$year, $now])->count();
                $user = User::where('role', 'user')->get();
                $movies = Movie::all();
                foreach ($theaters as $theater) {
                    $total_seat = 0;
                    $total_price = 0;
                    foreach ($theater['rooms'] as $theater_room) {
                        foreach ($theater_room['schedules'] as $theater_schedule) {
                            foreach ($theater_schedule['Ticket'] as $theater_ticket) {
                                $total_seat += $theater_ticket['ticketseats']->count();
                                $total_price += $theater_ticket['totalPrice'];
                            }
                        }
                    }
                    $theater->setAttribute('totalPrice', $total_price);
                    $theater->setAttribute('ticketseats', $total_seat);
                }

                foreach ($movies as $movie) {
                    $total_seat = 0;
                    $total_price = 0;
                    foreach ($movie['schedules'] as $movie_schedule) {
                        foreach ($movie_schedule['Ticket'] as $movie_ticket) {
                            $total_seat += $movie_ticket['ticketseats']->count();
                            $total_price += $movie_ticket['totalPrice'];
                        }
                    }
                    $movie->setAttribute('totalPrice', $total_price);
                    $movie->setAttribute('ticketseats', $total_seat);
                }

                $movies = $movies->sortByDesc('totalPrice');

                $sum = 0;
                $sum_today = 0;
                //total of month
                foreach ($total_year as $value) {
                    $sum += $value['totalPrice'];
                }
                //total today
                foreach ($ticket as $today) {
                    $sum_today += $today['totalPrice'];
                }
                return view('admin.web.home', [
                    'user' => $user,
                    'ticket' => $ticket,
                    'sum' => $sum,
                    'sum_today' => $sum_today,
                    'now' => $now,
                    'start_of_month' => $start_of_month,
                    'ticket_seat' => $ticket_seat,
                    'year' => $year,
                    'theaters' => $theaters,
                    'movies' => $movies
                ]);
            }
            else {
                return view('admin.web.login');
            }
            }
        else {
            return view('admin.web.login');
        }
    }

    public function filter_by_date(Request $request)
    {
        $start_time = Carbon::createFromFormat('Y-m-d', $request->from_date)->startOfDay();
        $end_time = Carbon::createFromFormat('Y-m-d', $request->to_date)->endOfDay(); // lấy ngày cuối cùng
        

        $get = Ticket::whereBetween('created_at', [$start_time, $end_time])->orderBy('created_at', 'ASC')->get();
        $value_first = $get->first();
        $value_last = $get->last();

        $date_current = date("d-m-Y", strtotime($value_first['created_at']));

        $total = 0;
        $seat_count = 0;
        $chart_data = [];

        foreach ($get as $value) {
            if ($date_current == date("d-m-Y", strtotime($value['created_at']))) {
                $total += $value['totalPrice'];
                $seat_count += $value['ticketSeats']->count();
            } else {
                $data = array(
                    'date' =>  $date_current,
                    'total' => $total,
                    'seat_count' => $seat_count
                );
                $date_current = date("d-m-Y", strtotime($value['created_at']));
                $total = $value['totalPrice'];
                $seat_count = $value['ticketSeats']->count();
                array_push($chart_data, $data);
            }
            if ($value_last->id == $value['id']) {
                $data = array(
                    'date' => date("d-m-Y", strtotime($value['created_at'])),
                    'total' => $total,
                    'seat_count' => $seat_count
                );
                array_push($chart_data, $data);
            }
        }
        return response()->json([
            'success' => 'Thành công',
            'chart_data' => $chart_data
        ]);
    }

    public function info()
    {
        $info = Info::find(1);
        return view('admin.web.info', [
            'info' => $info
        ]);
    }
    public function postInfo(Request $request)
    {
        $info = Info::find(1);
        if ($request->hasFile('Image')) {
            $file = $request->file('Image');
            $format = $file->getClientOriginalExtension();
            if ($format != 'jpg' && $format != 'png' && $format != 'jpeg') {
                return redirect('admin/info')->with('warning', 'Không hỗ trợ ' . $format);
            }
            if ($info->logo != '') {
                unlink('images/web/' . $info->logo);
            }
            $file->move('images/web/', "logo.png");
            $request['logo'] =  "logo.png";
        }

        $info->update($request->all());

        return redirect('admin/info')->with('success', 'Thành công');
    }



    public function admin(){
        return view('admin.home');
    }

    public function staff()
    {
        $staff = User::where('role', 'staff')->orderBy('id', 'DESC')->paginate(10);
        $theaters = Theater::all();
        
        return view('admin.web.staff', [
            'staff' => $staff,
            'theaters' => $theaters
        ]);
    }

    public function postCreate(Request $request)
    {
        $request->validate([
            'fullname' => 'required|min:1',
            'email' => 'required|unique:users',
            'phone' => 'required|unique:users',
            'password' => 'required',
        ], [
            'fullname.required' => 'fullname is required',
            'email.required' => 'Email is required',
            'email.unique' => 'Email already exists',
            'password.required' => 'Password is required',
            'phone.required' => 'Phone is required',
            'phone.unique' => 'Phone already exists'
        ]);
        $request['password'] = bcrypt($request['password']);
        $staff = new User([
            'fullname' => $request['fullname'],
            'password' => $request['password'],
            'email' => $request['email'],
            'phone' => $request['phone'],
            'role' => 'staff',
            'code' => rand(10000000000, 9999999999999999)
        ]);
        //        dd($staff);
        $staff->save();
        $staff_theater = new StaffTheater([
            'user_id' => $staff->id,
            'theater_id' => $request->theater_id 
        ]);
        $staff_theater->save();
        return redirect('/admin/staff')->with('success', 'Tạo tài khoản thành công!');
    }

    public function delete($id)
    {
        $user = User::find($id);
        if ($user['status'] == 0) {
            User::destroy($id);
            return response()->json(['success' => 'Xóa thành công!']);
        }
    }

    public function scanTicket(){
        return view('admin.web.scanTicket');
    }
}
