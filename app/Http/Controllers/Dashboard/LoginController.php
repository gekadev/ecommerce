<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminLoginValidation;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    public function login()
    {

        return view('dashboard.auth.loginform');
    }
    // strat authontication //
    public  function authinticate( AdminLoginValidation $request )
    {
        // Validate the form data
        $credentials   = array(
            'email'    => $request->get('email'),
            'password' => $request->get('password'),
            'status'   =>1,
            'deleted'  =>1

        );
            $remember_me = $request->has('remember_me')?true : false;
        // Attempt to log the user in
        if (Auth::guard('admin')->attempt($credentials, $remember_me)) {

            return redirect(route("admin.dashboard"));

        }

        // if unsuccessful, then redirect back to the login with the form data
        return redirect()->back()->with("error",trans('dashboard\login.loginMessage'));
    }
    // start logout function
    public function logout()
    {
        $gaurd = $this->getGaurd();
        $gaurd->logout();
        return redirect(route("admin.login"));
    }

    public function getGaurd()
    {
        return auth('admin');
    }

}
