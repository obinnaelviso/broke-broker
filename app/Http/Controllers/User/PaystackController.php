<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Unicodeveloper\Paystack\Paystack;
use App\Model\Transaction;
use App\Model\TransType;
use App\Model\ReferenceNo;
use App\Model\ServiceStat;

class PaystackController extends Controller
{
    /**
     * Redirect the User to Paystack Payment Page
     * @return Url
     */
    public function checkout(Request $request)
    {
        $this->validate(request(), [
            'amount' => 'required|numeric|min:500'
        ]);
    	// checkout
        $paystack = new Paystack();
        $request->email = $this->user()->email;
        $request->amount *= 100;
        $request->key = config('paystack.secretKey');
        $request->reference = $paystack->genTranxRef();
        $request->subaccount = 'ACCT_kfyn6da7s3zfan9';

        return $paystack->getAuthorizationUrl()->redirectNow();
    }

    /**
     * Obtain Paystack payment information
     * @return void
     */
    public function handleGatewayCallback()
    {
    	// Get Payment Data
    	$paystack = new Paystack();
        $paymentDetails = $paystack->getPaymentData();
        $status = $paymentDetails['data']['status'];
        $amount = ((float) $paymentDetails['data']['amount']) * 0.01;
        $reference_id = $paymentDetails['data']['reference'];

        if( $status === 'success') {
        	$wallet = $this->user()->wallet;
        	$user = $this->user();
            $transaction = new Transaction;
        	$trans_type = TransType::find(1);
        	$service_stat = ServiceStat::find(3);
            $prev_amount = $wallet->amount;
        	$reference_no = new ReferenceNo;

            // Save Reference No.
            $reference_no->reference_no = $reference_id;
            $reference_no->trans_type_id = $trans_type->id;
            $user->reference_nos()->save($reference_no);

        	// Credit wallet
        	$wallet->amount += $amount;

        	// Fill in credit info
        	$transaction->trans_type_id = $trans_type->id;
        	$transaction->wallet_id = $wallet->id;
        	$transaction->amount = $amount;
        	$transaction->prev_amount = $prev_amount;
        	$transaction->reference_no_id = $reference_no->id;
        	$transaction->service_stat_id = $service_stat->id;
        	$user->transactions()->save($transaction);
            $wallet->save();
        	// Notify
        	session()->flash('success', 'Your nwallet has been credited successfully!');
        }

        // dd($paymentDetails);
        return redirect()->route('user.add_money');
    }

    protected function user() {
    	return Auth::user();
    }
}
