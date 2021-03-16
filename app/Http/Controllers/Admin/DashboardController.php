<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Model\AccStat;

class DashboardController extends Controller
{
    public function __construct() 
    {
        $this->middleware('auth:admin');
    }

    public function home() {
    	$suser = $this->suser();
    	$as_active = AccStat::find(2);
    	if($suser->acc_stat_id == 4) {
    		$suser->acc_stat_id = $as_active->id;
    		$suser->save();
    	}
    	return view('admin.home', compact('suser'));
    }

    public function suser() {
    	return Auth::user('admin');
    }
}
