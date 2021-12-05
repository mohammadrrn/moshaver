<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function usersList()
    {
        $usersList = User::with('plan')->with('item')->with('role')->paginate($this->pagination);
        $data = [
            'usersList' => $usersList
        ];
        return view('panel.users.usersList', compact('data'));
    }

    public function inactive(Request $request)
    {
        $userId = $request->input('user_id');
        $user = User::find($userId);
        $user->status = 2;
        $user->save();
        return redirect()->back()->with(['success', 'عملیات با موفقیت انجام شد']);
    }

    public function active(Request $request)
    {
        $userId = $request->input('user_id');
        $user = User::find($userId);
        $user->status = 1;
        $user->save();
        return redirect()->back()->with(['success', 'عملیات با موفقیت انجام شد']);
    }
}
