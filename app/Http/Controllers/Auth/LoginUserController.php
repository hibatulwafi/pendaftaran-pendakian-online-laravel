<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
class LoginUserController extends Controller
{
    use AuthenticatesUsers;
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function username() {
      return 'username';
    }

    public function login(Request $request)
    {
           // Validate the form data
          $this->validate($request, [
              'password' => 'required|min:6',
              'username' => 'required',
          ]);
          // Attempt login
          if ( Auth::guard('pendaki')->attempt(['username' => $request->username, 'password' => $request->password], $request->remember)) {
              return redirect()->intended(route('pendaki.dashboard'));
  } else {
  //Else redirect to form login
     return redirect()->back()->withInput($request->only('username', 'remember'));
  }
    }

    public function form()
    {
        return view('user_ui.login');
       
    }
}
