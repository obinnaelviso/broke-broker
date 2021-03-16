<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Model\Admin;
use Illuminate\Support\Facades\Validator;
use App\Model\AccStat;

class SUsersController extends Controller
{
    public function __construct() 
    {
        $this->middleware('auth:admin');
    }

    public function index() {
    	$suser = $this->suser();
    	$susers = Admin::paginate(10);
    	return view('admin.manage_admin', compact(['suser', 'susers']));
    }

    public function account_status(Admin $suser) {
    	$as_active = AccStat::find(2);
    	$as_block = AccStat::find(3);
    	if($suser->acc_stat_id == $as_active->id) {
    		$suser->acc_stat_id = $as_block->id;
    		$suser->save();
    		session()->flash('failed', "User Account Blocked!");
    	}
    	else if($suser->acc_stat_id == $as_block->id) {
    		$suser->acc_stat_id = $as_active->id;
    		$suser->save();
    		session()->flash('success', "User Account Unblocked!");
    	}
    	return redirect()->route('suser.manage_admin');
    }

    public function profile_edit() {
    	$suser = $this->suser();
    	return view('admin.edit_profile', compact('suser'));
    }

    public function edit_profile(Request $request) {
    	$suser = $this->suser();

    	$this->validator($request->all())->validate();

        $suser->first_name = $request->first_name;
        $suser->last_name = $request->last_name;
        $suser->gender = $request->gender;
        $suser->phone = $request->phone;
        $suser->email = $request->email;
        $suser->address = $request->address;
        $suser->state = $request->state;
        $suser->save();

        session()->flash('success', 'Profile updated successfully!');
        return redirect()->route('suser.manage_admin');
    }

    public function password_change() {
    	$suser = $this->suser();
    	return view('admin.change_password', compact('suser'));
    }

    public function change_password(Request $request) {
    	$suser = $this->suser();

    	$this->validate(request(), [
            'old_password' => 'required',
            'password' => 'required|min:8|confirmed'
        ]);

        if($suser->password_check($request->old_password)) {
            $suser->password = $request->password;
            $suser->save();
            
            session()->flash('success', 'Password changed successfully!');
            return redirect()->route('suser.manage_admin');       
        }
        session()->flash('error','Wrong Password. Please try again!');
        return redirect()->back();
    }

    public function suser() {
    	return Auth::user('admin');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'gender' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users'],
            'state' => ['required', 'string', 'max:255'],
        ]);
    }
}
