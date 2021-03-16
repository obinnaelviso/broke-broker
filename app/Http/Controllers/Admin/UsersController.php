<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Mail\AccountActivated;
use App\Mail\CreditAlert;
use App\Model\User;
use App\Model\AccStat;
use App\Model\ServiceStat;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index() {
    	$suser = $this->suser();
    	$users = User::paginate(25);
    	return view('admin.manage_users', compact(['suser', 'users']));
    }

    public function manage_user(User $user) {
    	$suser = $this->suser();
    	$transactions = $user->transactions;
    	// $withdraw_requests = $user->withdraw_requests()->newest()->paginate(15, ['*'], 'withdraw-requests');
    	// $assigned_pcs = $user->assigned_pcs()->orderBy('updated_at', 'desc')->paginate(15, ['*'], 'assigned-pcs');
    	return view('admin.manage_user', compact(['suser', 'user', 'transactions']));
    }

    public function addUserTransactions(User $user, Request $request) {
        $user->transactions()->create([
            'amount' => $request->amount,
            'prev_bal' => $request->prev_bal,
            'reference_no' => $this->generateAccountNo(10),
            'created_at' => $request->created_at ? Carbon::create($request->created_at) : null
        ]);
        return back()->with('success', 'Transaction added successfully!');
    }

    public function update_email(User $user, Request $request) {
    	$this->validate(request(), [
            'email' => 'required|email'
        ]);

        $user->email = $request->email;
        $user->save();

    	return redirect()->route('suser.manage_user', $user->id)->with('success', "Email address updated successfully!");
    }

    public function delete_user(User $user, Request $request) {
		$user->transactions()->delete();
		$user->otps()->delete();
        $user->delete();
        $request->session()->flash('success', 'User account deleted successfully!');
        return response('success. Account deleted permanently', 200);
    }

    public function account_status(User $user) {
    	$as_inactive = AccStat::find(1);
    	$as_active = AccStat::find(2);
    	$as_block = AccStat::find(3);
    	if($user->acc_stat_id == $as_active->id) {
    		$user->acc_stat_id = $as_block->id;
    		$user->save();
    		session()->flash('failed', "User account blocked!");
    	}
    	else if($user->acc_stat_id == $as_block->id) {
    		$user->acc_stat_id = $as_active->id;
    		$user->save();
    		session()->flash('success', "User account unblocked!");
        }
        else if($user->acc_stat_id == $as_inactive->id) {
            $user->acc_stat_id = $as_active->id;
            $user->acc_no = $this->generateAccountNo(10);
            $user->save();
            Mail::to($user->email)->send(new AccountActivated($user));
    		session()->flash('success', "User's account is active!");
        }
    	return redirect()->route('suser.manage_user', $user->id);
    }

    public function wallet_status(User $user) {
    	$ss_active = ServiceStat::find(1);
    	$ss_block = ServiceStat::find(2);
    	if($user->wallet->service_stat_id == $ss_active->id) {
    		$user->wallet->service_stat_id = $ss_block->id;
    		$user->wallet->save();
    		session()->flash('failed', "User Wallet Frozen!");
    	}
    	else if($user->wallet->service_stat_id == $ss_block->id) {
    		$user->wallet->service_stat_id = $ss_active->id;
    		$user->wallet->save();
    		session()->flash('success', "User Wallet Unfrozen!");
    	}
    	return redirect()->route('suser.manage_user', $user->id);
    }

    public function edit_balance(User $user, Request $request) {
        $user->wallet->amount = $request->amount;
        $user->wallet->save();
        return (string)$user->wallet->amount;
    }

    protected function generateAccountNo($size) {
    	$permitted_chars = '67890123456789012345647473838990303304912345654300000000000000001111117777777345678765456789876556789789012349012345678905678901234567890123456789012345678901267890123456789012345';
		return substr(str_shuffle($permitted_chars), 0, $size);
    }

    public function suser() {
    	return Auth::user('admin');
    }
}
