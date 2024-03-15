<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function user()
    {
        $users = User::where('role', 'LIKE', 'user')->paginate(50);
        return view('admin.web.user', ['users' => $users]);
    }
    public function searchUser(Request $request)
    {
        $output = '';
        if ($request->search == null) {
            $users = User::orderBy('id', 'DESC')->Paginate(50);
        } else {
            $users = User::where('code', 'LIKE', '%' . $request->search . '%')->orWhere('email', 'LIKE', '%' . $request->search . '%')->get();
        }

        return Response($output);
    }

    public function delete($id)
    {
        $user = User::find($id);
        $user->delete();
        return response()->status(200);
    }
}
