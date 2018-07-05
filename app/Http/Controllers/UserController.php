<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function update(Request $request)
	{     
		$user = $request->user();
        if ($request->has('password') && $request->input('password') != null) {
            $user->password = bcrypt($request->input('password'));
            $user->save();
        }
        if ($request->has('wupassword') && $request->input('wupassword') != null) {
            $user->wupassword = $request->input('wupassword');
            $user->save();
        }

		$user->update($request->except(['password', 'wupassword']));
    	//$user->flips->init();
		return redirect()->back();
	}
}
