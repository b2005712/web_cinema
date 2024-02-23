<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use App\Models\Theater;
use App\Models\Ticket;
use App\Models\TicketSeat;
use App\Models\User;
use App\Models\Movie;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $info = Info::find(1);
        view()->share('info', $info);
    }
        public function admin(){
            return view('admin.home');
        }
}
