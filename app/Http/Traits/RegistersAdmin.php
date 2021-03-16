<?php

namespace App\Http\Traits;

use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;

trait RegistersAdmin
{

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showAdminRegisterForm()
    {
        return view('auth.aregister');
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        if($request->submit) 
            return redirect()->route('suser.manage_admin')->with('success', 'New Admin registered successfully!');
        return $this->registered($request, $user)
                        ?: redirect()->route('suser.login')->with('success', 'New Admin registered successfully!');
    }

    /**
     * The user has been registered.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function registered(Request $request, $user)
    {
        //
    }
}
