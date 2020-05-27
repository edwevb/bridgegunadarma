<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\User;
class UserManagementController extends Controller
{
    public function index()
    {
	   $data_user = User::orderBy('role_id','desc')->get();
	   return view('admin.auth.userManage',compact('data_user'));
    }

    public function create(Request $request)
    {
        $request->validate([
            'name'             => 'required|alpha_spaces|max:64',
            'username'         => 'required|unique:users|min:6',
            'email'            => 'required|unique:users|email',
            'password'         => 'required|min:6',
            'confirm_password' => 'required|min:6|same:password'
        ]);

        $user = new User;
        $user->name           = $request->name;
        $user->username       = $request->username;
        $user->role_id        = $request->role_id;
        $user->email          = $request->email;
        $user->password       = bcrypt($request->password);
        $user->remember_token = Str::random(60);
        $user->save();
        return redirect('/user')->with('AlertSuccess','Data berhasil ditambahkan!');
    }

    public function edit(User $user)
    {
    	return view('admin.auth.EditUser',compact('user'));
    }

    public function update(Request $request, User $user)
    {
    	$request->validate([
			'email'            => 'required|email',
			'password'         => 'required|min:6',
			'confirm_password' => 'required|min:6|same:password'
        ]);

		User::where('id', $user->id)
            ->update([
				'name'           => $request->name,
				'role_id'        => $request->role_id,
				'email'          => $request->email,
				'password'       => bcrypt($request->password),
				'remember_token' => $request->remember_token
            ]);
            
        return redirect('/user')->with('AlertSuccess','Data '.$user->username.' berhasil diperbaharui!');
    }

    public function destroy(User $user)
    {
		User::destroy($user->id);
		return redirect('/user')->with('AlertSuccess','Data '.$user->username.' berhasil dihapus!');
    }
}
