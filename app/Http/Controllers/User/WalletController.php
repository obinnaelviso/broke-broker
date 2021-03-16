<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\TransferRequestSent;
use App\Model\Homepage;
use App\Model\Wallet;
use App\Model\User;
use App\Model\TransType;
use App\Model\ServiceStat;
use App\Model\TransferStat;
use App\Model\Transaction;
use App\Model\WithdrawSpec;
use App\Model\WithdrawRequest;
use App\Model\ReferenceNo;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class WalletController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:user');
    }

    public function withdraw(Request $request) {
    	$user = $this->user();
        $wallet = $this->user()->wallet;
    	$withdraw_spec = WithdrawSpec::find(1);
    	$withdraw_request = new WithdrawRequest;
    	$service_stat_p = ServiceStat::find(5);
    	$reference_no = new ReferenceNo;
    	$transaction = new Transaction;
    	$trans_type = TransType::find(4);
    	// $min_amt = $withdraw_spec->min_amt;
    	// $max_amt = $withdraw_spec->max_amt;
    	$charge = $withdraw_spec->charge;
    	$amount = $wallet->amount;
        $password_check = $user->password_check($request->password);
        // $otp = $user->otp->code;
        // $transaction_pin = $user->transaction_pin;

        // Validate form
        if($request->has_bitcoin != null) {
            $this->withdraw_bitcoin($request, $amount, $password_check)->validate();
        } else
    	    $this->withdraw_validator($request, $amount, $password_check)->validate();

    	// Add Information into withdraw_request
    	$withdraw_request->amount = $request->amount;
    	$withdraw_request->charge = $charge;
    	$withdraw_request->bitcoin_address = $request->bitcoin_address;
    	$withdraw_request->acc_name = $request->acc_name;
    	$withdraw_request->bank_name = $request->bank;
    	$withdraw_request->acc_no = $request->acc_no;
        $withdraw_request->acc_type = $request->acc_type;
        $withdraw_request->transfer_type = $request->transfer_type;
        if($request->transfer_type == 'international') {
            $withdraw_request->iban_no = $request->iban_no;
            $withdraw_request->swift_code = $request->swift_code;
            $withdraw_request->address = $request->address;
        }
    	$withdraw_request->service_stat_id = $service_stat_p->id;
    	$withdraw_request->expire_at = now()->addWeekdays(7);

    	// Fill in transaction information
    	$transaction->trans_type_id = $trans_type->id;
    	$transaction->wallet_id = $wallet->id;
    	$transaction->amount = $request->amount + $charge;
    	$transaction->prev_amount = $amount;
    	$transaction->service_stat_id = $service_stat_p->id;

    	// Update Wallet
    	$wallet->amount -= ($request->amount + $charge);

    	// Generate reference No
    	$reference_no->reference_no = $this->generateReferenceNo();
    	$reference_no->trans_type_id = $trans_type->id;
    	$user->reference_nos()->save($reference_no);
    	$withdraw_request->reference_no_id = $reference_no->id;
    	$user->withdraw_requests()->save($withdraw_request);
    	$transaction->reference_no_id = $reference_no->id;
    	$user->transactions()->save($transaction);
    	$wallet->save();

        //Success
        // Mail::to($user->email)->send(new TransferRequestSent($withdraw_request));
    	session()->flash('success', 'Please wait while your withdrawal is being processed. You will get a feedback from us in an hour. Thanks!');
    	return redirect('/user/withdraw');
    }

    public function withdraw_cancel(WithdrawRequest $withdraw_request) {
    	$ss_pending = ServiceStat::find(5);
    	if($withdraw_request->service_stat_id == $ss_pending->id) {
    		$transaction = new Transaction;
    		$reference_no = new ReferenceNo;
    		$ss_success = ServiceStat::find(3);
    		$ss_cancelled = ServiceStat::find(7);
    		$tt_credit = TransType::find(1);
    		$user = $this->user();
    		$wallet = $this->user()->wallet;

    		$withdraw_request->service_stat_id = $ss_cancelled->id;
    		// Fill in transaction information
	    	$transaction->trans_type_id = $tt_credit->id;
	    	$transaction->wallet_id = $wallet->id;
	    	$transaction->amount = ($withdraw_request->amount + $withdraw_request->charge);
	    	$transaction->prev_amount = $wallet->amount;
	    	$transaction->service_stat_id = $ss_success->id;

	    	// credit wallet back
	    	$wallet->amount += ($withdraw_request->amount + $withdraw_request->charge);
	    	$reference_no->reference_no = $this->generateReferenceNo();
	    	$reference_no->trans_type_id = $tt_credit->id;
	    	$user->reference_nos()->save($reference_no);
	    	$transaction->reference_no_id = $reference_no->id;
	    	$withdraw_request->reference_no_id = $reference_no->id;
	    	$user->transactions()->save($transaction);
	    	$withdraw_request->save();
	    	$wallet->save();

	    	session()->flash('success', 'Withdraw Request Cancelled Successfully!');
    	}

    	return redirect()->route('user.withdraw_money');
    }

    public function transfer(Request $request) {
    	$user = $this->user();
    	$wallet = $this->user()->wallet;
        $withdraw_spec = WithdrawSpec::find(2);
    	$email = $user->email;
    	$amount = $wallet->amount;
    	$password_check = $user->password_check($request->password);
        $service_stat = ServiceStat::find(3);
    	$trans_type_t = TransType::find(3); // Transfer trans_type
    	$trans_type_c = TransType::find(1); // Credit trans_type
        $min_amt = $withdraw_spec->min_amt;
        $max_amt = $withdraw_spec->max_amt;
        $charge = $withdraw_spec->charge;
    	$transfer_stat = new TransferStat;
    	$transaction = new Transaction;
    	$reference_no = new ReferenceNo;

    	// Validate form
        $this->transfer_validator($request, $amount, $password_check, $min_amt, $max_amt, $charge, $email)->validate();

    	// Get Recepient info
    	$recepient = User::where('email', $request->email)->firstOrFail();
    	$recepient_wallet = $recepient->wallet;
    	$recepient_prev_amount = $recepient_wallet->amount;
    	// Perform Transfer
    	$wallet->amount -= $request->amount;
    	$recepient_wallet->amount += $request->amount;

    	// Generate reference No
    	$reference_no->reference_no = $this->generateReferenceNo();
    	$reference_no->trans_type_id = $trans_type_t->id;
    	$user->reference_nos()->save($reference_no);

    	// Fill in transaction information
    	$transaction->trans_type_id = $trans_type_t->id;
    	$transaction->reference_no_id = $reference_no->id;
    	$transaction->wallet_id = $wallet->id;
    	$transaction->amount = $request->amount;
    	$transaction->prev_amount = $amount;
    	$transaction->service_stat_id = $service_stat->id;

    	// Fill in transfer information
    	$transfer_stat->recepient_id = $recepient->id;
    	$transfer_stat->reference_no_id = $transaction->reference_no_id;
    	$transfer_stat->amount = $transaction->amount;
    	$transfer_stat->service_stat_id = $transaction->service_stat_id;

    	// Save transaction for user to database;
    	$user->transactions()->save($transaction);

    	// Save transaction for recepient
    	$transaction_r = $transaction->replicate();
    	$transaction_r->prev_amount = $recepient_prev_amount;
    	$transaction_r->wallet_id = $recepient_wallet->id;
    	$transaction_r->trans_type_id =  $trans_type_c->id;
    	$recepient->transactions()->save($transaction_r);
    	$user->transfer_stats()->save($transfer_stat);

    	// Save Wallet
    	$wallet->save();
    	$recepient_wallet->save();

    	// success
    	session()->flash('success', 'Transaction Completed Successfully!');
    	return redirect()->route('user.transfer_money');
    }

    protected function user() {
        return Auth::user();
    }

    protected function generateReferenceNo() {
    	$permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		return substr(str_shuffle($permitted_chars), 0, 25);
    }

    protected function transfer_validator($data, $amount, $password, $min_amt, $max_amt, $charge, $email)
    {
    	$validator = Validator::make($data->all(), [
    		'amount' => 'required|numeric|min:0',
    		'email' => 'required|email|exists:users',
    		'password' => 'required',
    	]);

    	$validator->after(function ($validator) use ($data, $amount, $password, $min_amt, $max_amt, $charge, $email) {
		    if ($data->amount > $max_amt) {
                $validator->errors()->add('amount', 'Sorry, but can only withdraw N'.(integer)$max_amt.' from your wallet at a time!');
            }
            elseif ($data->amount < $min_amt) {
                $validator->errors()->add('amount', 'Sorry, but you can only withdraw atleast N'.(integer)$min_amt.' from your wallet!');
            }
            elseif (($data->amount + $charge) > $amount) {
		        $validator->errors()->add('amount', 'Sorry, but you have insufficient balance!');
		    }
		    if ($data->email === $email) {
		    	$validator->errors()->add('email', 'Sorry, but you cannot make a transfer to your own wallet');
		    }
		    if (!$password) {
		    	$validator->errors()->add('password', 'Incorrect Password. Please try again!');
		    }
		});

		return $validator;
    }

    protected function withdraw_validator($data, $amount, $password)
    {
    	$validator = Validator::make($data->all(), [
    		'amount' => 'required|numeric|min:0',
    		'acc_name' => 'required|string',
    		'acc_no' => 'required|string',
    		// 'acc_type' => 'required|string',
    		'bank' => 'required|string',
            // 'password' => 'required',
    	]);

    	$validator->after(function ($validator) use ($data, $amount, $password) {
		    if (($data->amount) > $amount) {
		        $validator->errors()->add('amount', 'Sorry, but you have insufficient balance. Try a smaller amount!');
		    }
		    if (!$password) {
		    	$validator->errors()->add('password', 'Incorrect Password. Please try again!');
            }
            // if ($transaction_pin != $data->transaction_pin) {
            //     $validator->errors()->add('transaction_pin', 'Incorrect transaction pin. Please try again!');
            // }
            // if ($otp != $data->otp) {
            //     $validator->errors()->add('otp', 'Incorrect OTP. Please try again!');
            // }
		});

		return $validator;
    }

    protected function withdraw_bitcoin($data, $amount, $password)
    {
    	$validator = Validator::make($data->all(), [
    		'amount' => 'required|numeric|min:0',
    		'bitcoin_address' => 'required|string',
            'password' => 'required',
    	]);

    	$validator->after(function ($validator) use ($data, $amount, $password) {
		    if (($data->amount) > $amount) {
		        $validator->errors()->add('amount', 'Sorry, but you have insufficient balance. Try a smaller amount!');
		    }
		    if (!$password) {
		    	$validator->errors()->add('password', 'Incorrect Password. Please try again!');
            }
            // if ($transaction_pin != $data->transaction_pin) {
            //     $validator->errors()->add('transaction_pin', 'Incorrect transaction pin. Please try again!');
            // }
            // if ($otp != $data->otp) {
            //     $validator->errors()->add('otp', 'Incorrect OTP. Please try again!');
            // }
		});

		return $validator;
    }
}
