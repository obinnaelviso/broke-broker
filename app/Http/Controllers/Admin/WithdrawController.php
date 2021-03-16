<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Model\WithdrawRequest;
use App\Model\ServiceStat;
use App\Model\TransType;
use App\Model\Transaction;
use App\Model\ReferenceNo;

class WithdrawController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index() {
    	$suser = $this->suser();
    	$withdraw_requests = WithdrawRequest::newest()->paginate(15);
    	return view('admin.withdraw_requests', compact(['suser', 'withdraw_requests']));
    }

    public function request_response(WithdrawRequest $withdraw_request, Request $request) {
    	$suser = $this->suser();
    	$ss_accept = ServiceStat::find(3);
    	$ss_reject = ServiceStat::find(4);
		$tt_credit = TransType::find(1);
		$tt_withdraw = TransType::find(4);
    	$user = $withdraw_request->user;
    	$wallet = $user->wallet;

    	if($request->withdraw === "Accept") {
    		$transaction = new Transaction;
    		$reference_no = new ReferenceNo;

    		$withdraw_request->service_stat_id = $ss_accept->id;
    		$withdraw_request->message = $request->message;
    		// Fill in transaction information
	    	$transaction->trans_type_id = $tt_withdraw->id;
	    	$transaction->wallet_id = $wallet->id;
	    	$transaction->amount = ($withdraw_request->amount + $withdraw_request->charge);
	    	$transaction->prev_amount = $wallet->amount;
	    	$transaction->service_stat_id = $ss_accept->id;

	    	$reference_no->reference_no = $this->generateReferenceNo();
	    	$reference_no->trans_type_id = $tt_withdraw->id;
	    	$user->reference_nos()->save($reference_no);
	    	$transaction->reference_no_id = $reference_no->id;
	    	$withdraw_request->reference_no_id = $reference_no->id;
	    	$user->transactions()->save($transaction);
	    	$suser->withdraw_requests()->save($withdraw_request);

	    	session()->flash('success', 'Withdraw Request Accepted!');
    	}
    	else {
    		$transaction = new Transaction;
    		$reference_no = new ReferenceNo;

    		$withdraw_request->service_stat_id = $ss_reject->id;
    		$withdraw_request->message = $request->message;
    		// Fill in transaction information
	    	$transaction->trans_type_id = $tt_credit->id;
	    	$transaction->wallet_id = $wallet->id;
	    	$transaction->amount = ($withdraw_request->amount + $withdraw_request->charge);
	    	$transaction->prev_amount = $wallet->amount;
	    	$transaction->service_stat_id = $ss_reject->id;

	    	// credit wallet back
	    	$wallet->amount += ($withdraw_request->amount + $withdraw_request->charge);
	    	$reference_no->reference_no = $this->generateReferenceNo();
	    	$reference_no->trans_type_id = $tt_credit->id;
	    	$user->reference_nos()->save($reference_no);
	    	$transaction->reference_no_id = $reference_no->id;
	    	$withdraw_request->reference_no_id = $reference_no->id;
	    	$user->transactions()->save($transaction);
	    	$suser->withdraw_requests()->save($withdraw_request);
	    	$wallet->save();

	    	session()->flash('failed', 'Withdraw Request Rejected!');
    	}
    	return redirect()->route('suser.withdraw_requests');
    }

    protected function generateReferenceNo() {
    	$permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		return substr(str_shuffle($permitted_chars), 0, 25);
    }

    public function suser() {
    	return Auth::user('admin');
    }
}
