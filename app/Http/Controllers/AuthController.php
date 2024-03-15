<?php

namespace App\Http\Controllers;

use App\Models\Info;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;



class AuthController extends Controller
{

    public function signIn(Request $request)
    {
        $request->validate(
            [
                'username' => 'required',
                'password' => 'required'
            ],
            [
                'username.required' => 'Vui lòng nhập email hoặc số điện thoại!',
                'password.required' => 'Vui lòng nhập mật khẩu!'
            ]
        );
        $email = Auth::attempt(['email' => $request['username'], 'password' => $request['password']]);
        $phone = Auth::attempt(['phone' => $request['username'], 'password' => $request['password']]);

        if ($email || $phone) {
            if(Auth::user()->role =='admin')
            {
                return redirect('/admin')->with('success','Đăng nhập tài khoản admin thành công');
            }
            if($request->has('rememberme')){
                session(['username_web'=>$request->username]);
                session(['password_web'=>$request->password]);
            }else{
                session()->forget('username_web');
                session()->forget('password_web');
            }
            return redirect('/')->with('success','Chào mừng bạn '.Auth::user()->fullName.' !');
        } else {
            return redirect($request->url)->with('warning','Sai tài khoản hoặc mật khẩu');
        }
    }

    public function signUp(Request $request)
    {
        $request->validate([
            'fullname' => 'required|min:1',
            'email' => 'required|max:255|unique:users',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:12|unique:users',
            'gender' => 'required',
            'agreement' => 'required',
            'password' => 'required|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9]).{6,}$/',
            'repassword' => 'required|same:password',
        ], [
            'fullname.required' => 'Vui lòng nhập họ tên',
            'email.required' => 'Vui lòng nhập email',
            'email.unique' => 'Email đã tồn tại',
            'phone.regex'=>'Vui lòng nhập nhập lại số điện thoại (10 số)',
            'password.regex'=>'Mật khẩu phải có ít nhất 1 chữ hoa,1 chữ thường,1 số và độ dài tối thiểu 6 kí tự',
            'phone.required' => 'Vui lòng nhập số điện thoại',
            'phone.unique' => 'Số điện thoại đã tồn tại',
            'password.required' => 'Vui lòng nhập mật khẩu',
            'repassword.required' => 'Vui lòng nhập lại mật khẩu',
            'repassword.same' => "Mật khẩu nhập lại không trùng khớp",
            'gender.required' => "Vui lòng chọn giới tính",
            'agreement.required' => "Vui lòng đồng ý với điều khoản",
        ]);
        $user = new User([
            'fullname'=>$request['fullname'],
            'password'=>bcrypt($request['password']),
            'email'=>$request['email'],
            'Brith'=>$request['brith'],
            'gender'=>$request['gender'],
            'phone'=>$request['phone'],
            'code'=>rand(1000000000000000, 9999999999999999),
            'role' => 'user'
        ]);
        $user->save();
        if($user){
            return redirect('/login')->with('success', 'Đăng ký thành công');
        }
        else{
            return redirect('/')->with('fail', 'Đăng ký không thành công');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/')->with('success','Đăng xuất thành công');
    }
}
