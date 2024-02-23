<?php

namespace App\Http\Controllers;

use App\Models\Info;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class MainController extends Controller
{
    public function admin(){
        return view('admin.web.home');
    }

    public function home(){
        return view('web.home');
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

    public function movieDetails(){
        return view('web.movieDetails');
    }

    public function movies(){
        return view('web.movies');
    }


    public function theater(){
        return view('web.theater');
    }

    public function test(){
        return view('web.test');
    }

    public function ticket(){
        return view('web.ticket');
    }
}
