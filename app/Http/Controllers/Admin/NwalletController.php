<?php

namespace App\Http\Controllers\Admin;

use App\ConversionRate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Model\WithdrawSpec;
use App\Model\AdminMsg;
use App\Model\Homepage;
use Illuminate\Support\Facades\Storage;

class NwalletController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index() {
    	$suser = $this->suser();
    	$withdraw_spec = WithdrawSpec::find(1);
    	$transfer_spec = WithdrawSpec::find(2);
        $admin_msg = AdminMsg::find(1);
    	return view('admin.configure_nwallet', compact(['suser', 'withdraw_spec', 'transfer_spec', 'admin_msg']));
    }

    public function configure(Request $request) {
    	$suser = $this->suser();
    	$withdraw_spec = WithdrawSpec::find(1);
    	$transfer_spec = WithdrawSpec::find(2);
        $admin_msg = AdminMsg::find(1);
    	$messages = [
    		'with_min.min' => 'The minimum withdraw amount field must be greater than :min.',
    		'with_max.min' => 'The maximum withdraw amount field must be greater than :min.',
    		'with_bal.min' => 'The wallet balance field for withdrawal must be greater than :min.',
    		'with_charge.min' => 'The withdrawal charge field must be greater than :min.',
    		'trf_min.min' => 'The minimum transfer amount field must be greater than :min.',
    		'trf_max.min' => 'The maximum transfer amount field must be greater than :min.',
    		'trf_bal.min' => 'The wallet balance field for transfer must be greater than :min.',
    		'trf_charge.min' => 'The transfer charge field must be greater than :min.',
    	];

    	Validator::make($request->all(), [
            'with_min' => 'required|numeric|min:0',
            'with_max' => 'required|numeric|min:0',
            'with_bal' => 'required|numeric|min:0',
            'with_charge' => 'required|numeric|min:0',
            'trf_min' => 'required|numeric|min:0',
            'trf_max' => 'required|numeric|min:0',
            'trf_bal' => 'required|numeric|min:0',
            'trf_charge' => 'required|numeric|min:0',
            'popup_message' => 'required|string',
            'popup_title' => 'required|string',
        ], $messages)->validate();
    	// Configure Withdraw
    		$withdraw_spec->min_amt = $request->with_min;
    		$withdraw_spec->max_amt = $request->with_max;
    		$withdraw_spec->min_bal = $request->with_bal;
    		$withdraw_spec->charge = $request->with_charge;

    	// Configure Transfer
    		$transfer_spec->min_amt = $request->trf_min;
    		$transfer_spec->max_amt = $request->trf_max;
    		$transfer_spec->min_bal = $request->trf_bal;
    		$transfer_spec->charge = $request->trf_charge;

    	// Configure User Popup
    		$admin_msg->title = $request->popup_title;
    		$admin_msg->message = $request->popup_message;
    		if($request->status) $admin_msg->service_stat_id = 1;
    		else $admin_msg->service_stat_id = 8;

    	$withdraw_spec->save();
    	$transfer_spec->save();
    	$admin_msg->save();
    	return redirect()->route('suser.configure_nwallet')->with('success', "Changes saved successfully!");
    }

    public function configure_homepage() {
    	$suser = $this->suser();
    	$btc_conversion = ConversionRate::where('currency_1', 'btc')->first();

    	return view('admin.configure_homepage', compact(['suser', 'btc_conversion']));
    }

    public function edit_homepage(Request $request) {
    	$btc_conversion = ConversionRate::where('currency_1', 'btc')->first();
        $btc_conversion->value = $request->usd_value;
        $btc_conversion->save();
    	return redirect()->route('suser.configure_homepage')->with('success', 'Website Changes Saved!');
    }

    public function suser() {
    	return Auth::user('admin');
    }
}
