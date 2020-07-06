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

    public function validateUser($request)
    {
        $request->validate([
            'name'             => 'required|alpha_spaces|max:64',
            'email'            => 'required|unique:users|email',
            'role_id'          => 'required',
            'password'         => 'required|min:6',
            'confirm_password' => 'required|min:6|same:password'
        ]);
    }

    public function create(Request $request)
    {
        $this->validateUser($request);
        
        $user = new User;
        $user->name           = $request->name;
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
        $this->validateUser($request);

		User::where('id', $user->id)
            ->update([
				'name'           => $request->name,
				'role_id'        => $request->role_id,
				'email'          => $request->email,
				'password'       => bcrypt($request->password),
				'remember_token' => $user->remember_token
            ]);
            
        return redirect('/user')->with('AlertSuccess','Data '.$user->username.' berhasil diperbaharui!');
    }

    public function destroy(User $user)
    {
		User::destroy($user->id);
		return redirect('/user')->with('AlertSuccess','Data '.$user->username.' berhasil dihapus!');
    }
}
