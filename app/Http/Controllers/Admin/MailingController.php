<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Mail\AdminMail;
use App\Model\AdminMailing;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Model\User;

class MailingController extends Controller
{
    public function __construct() 
    {
        $this->middleware('auth:admin');
    }

    public function index() {
    	$suser = $this->suser();
    	return view('admin.mailings', compact(['suser']));
    }

    public function send(Request $request) {
    	$suser = $this->suser();
    	$users = User::all();
    	if($users->count()) {
    		// Save Mail
    		$mailings = new AdminMailing;
    		$mailings->subject = $request->subject;
    		$mailings->message = $request->message;
    		$suser->admin_mailings()->save($mailings);

    		// Get User email address
	    	$emails = array();
	    	foreach ($users as $user) {
	    		$emails[] = $user->email;
	    	}
	    	// Send Mail
	    	// return (new AdminMail($request))->render();
	    	Mail::bcc($emails)->send(new AdminMail($request));
	    	return redirect()->route('suser.mailings')->with('success', 'Mail Sent successfully!!!');
    	} else
    		return redirect()->route('suser.mailings')->with('failed', 'There are no users available!!!');
    }

    public function suser() {
    	return Auth::user('admin');
    }
}
