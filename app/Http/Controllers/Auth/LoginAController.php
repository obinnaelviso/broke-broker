<?php

namespace App\Http\Controllers\Auth;

use App\Http\Traits\AuthenticatesAdmins;
use App\Http\Controllers\Controller;

class LoginAController extends Controller
{
    
    use AuthenticatesAdmins;

     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }
}
