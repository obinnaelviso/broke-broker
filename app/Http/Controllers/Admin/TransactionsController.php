<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\DefaultTransaction;
use Illuminate\Support\Facades\Auth;
use App\Model\MyTransaction;
use App\Model\User;
use Carbon\Carbon;

class TransactionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index() {
    	$suser = $this->suser();
        $transactions = MyTransaction::all();
        $users = User::all();
    	return view('admin.transactions', compact(['suser', 'transactions', 'users']));
    }

    public function add_transaction(Request $request) {
        MyTransaction::create([
            'description' => $request->description,
            'prev_bal' => $request->prev_bal,
            'amount' => $request->amount,
            'profit' => $request->profit,
            'reference_no' => $this->generateReferenceNo(12),
            'created_at' => $request->created_at ? Carbon::create($request->created_at) : null,
            'user_id' => $request->user_id]
        );
        return redirect()->route('suser.transactions')->with('success', 'Transaction added successfully!');
    }

    public function defaultTransactions() {
    	$suser = $this->suser();
        $transactions = DefaultTransaction::all();
        $users = User::all();
    	return view('admin.default_transactions', compact(['suser', 'transactions', 'users']));
    }

    public function addDefaultTransactions(Request $request) {
        DefaultTransaction::create([
            'initial_deposit' => $request->initial_deposit,
            'profit_made' => $request->profit_made,
            'created_at' => $request->created_at ? Carbon::create($request->created_at) : null
        ]);
        return redirect()->route('suser.default-transactions')->with('success', 'Default Transaction added successfully!');
    }

    public function deleteDefaultTransactions(DefaultTransaction $transaction) {
        $transaction->delete();
        return "successful";
    }

    public function delete_transaction(MyTransaction $transaction) {
        $transaction->delete();
        return "successful";
    }

    public function suser() {
    	return Auth::user('admin');
    }

    protected function generateReferenceNo($size) {
    	$permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		return substr(str_shuffle($permitted_chars), 0, $size);
    }
}
