<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Homepage;
use App\Model\Wallet;
use App\Model\Transaction;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:user');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
    	$user = $this->user();
        if($user->acc_stat_id == 1) {
            Auth::guard('user')->logout();
            return redirect()->route('login')->with('failed',
                'Your account has being temporarily blocked due to security reasons.
                Please hold on, we are currently working on it and it will be activated shortly.
                You will receive your account details after activation.');
        }
        $wallet = $this->user()->wallet;
        $section3a = Homepage::find(5);
        return view('dash.profile', compact(['user', 'wallet', 'section3a']));
    }

    public function profile_edit()
    {
        $user = $this->user();
        if($user->acc_stat_id == 1) {
            Auth::guard('user')->logout();
            return redirect()->route('login')->with('failed',
                'Your account has being temporarily blocked due to security reasons.
                Please hold on, we are currently working on it and it will be activated shortly.
                You will receive your account details after activation.');
        }
        $wallet = $this->user()->wallet;
        $section3a = Homepage::find(5);
        return view('user.profile_edit', compact(['user', 'wallet', 'section3a']));
    }

    public function edit_profile(Request $request) {
        $user = $this->user();
        if($user->acc_stat_id == 1) {
            Auth::guard('user')->logout();
            return redirect()->route('login')->with('failed',
                'Your account has being temporarily blocked due to security reasons.
                Please hold on, we are currently working on it and it will be activated shortly.
                You will receive your account details after activation.');
        }
        $this->validator($request->all())->validate();

        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        // $user->gender = $request->gender;
        $user->phone = $request->phone;
        // $user->address = $request->address;
        // $user->country = $request->country;
        $user->save();

        session()->flash('success', 'Profile updated successfully!');
        return redirect()->route('user.profile');
    }

    public function change_password() {
        $user = $this->user();
        if($user->acc_stat_id == 1) {
            Auth::guard('user')->logout();
            return redirect()->route('login')->with('failed',
                'Your account has being temporarily blocked due to security reasons.
                Please hold on, we are currently working on it and it will be activated shortly.
                You will receive your account details after activation.');
        }
        $wallet = $this->user()->wallet;
        $section3a = Homepage::find(5);
        return view('dash.change-password', compact(['user', 'wallet', 'section3a']));
    }

    public function password_change(Request $request) {
        $this->validate(request(), [
            'old_password' => 'required|min:8',
            'password' => 'required|min:8|confirmed'
        ]);

        $user = $this->user();
        if($user->acc_stat_id == 1) {
            Auth::guard('user')->logout();
            return redirect()->route('login')->with('failed',
                'Your account has being temporarily blocked due to security reasons.
                Please hold on, we are currently working on it and it will be activated shortly.
                You will receive your account details after activation.');
        }
        if($user->password_check($request->old_password)) {
            $user->password = $request->password;
            $user->save();

            session()->flash('success', 'Password changed successfully!');
            return redirect('/user/change-password');
        }
        session()->flash('error','Wrong Password. Please try again!');
        return redirect()->back();
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            // 'gender' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:255'],
            // 'state' => ['required', 'string', 'max:255'],
        ]);
    }

    protected function user() {
        return Auth::user();
    }
}
