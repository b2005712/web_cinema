<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use App\Models\Theater;
use App\Models\Ticket;
use App\Models\TicketSeat;
use App\Models\Info;
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

    public function home()
    {
        $info = Info::find(1);
        return view('admin.web.home', [
            'info' => $info
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
}
