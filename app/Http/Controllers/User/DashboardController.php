<?php

namespace App\Http\Controllers\User;

use App\ConversionRate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\WithdrawSpec;
use App\Model\PromoCode;
use App\Model\ServiceStat;
use App\Model\MyTransaction;
use App\Model\AdminMsg;
use App\Model\InvestmentPlan;
use App\Model\Homepage;
use App\Model\Investment;
use App\Model\TransType;
use App\Model\ReferenceNo;
use App\Model\StaticMessage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:user', 'verified']);
    }

    public function home() {
    	$user = $this->user();
        $wallet = $this->user()->wallet;
        $btc_rate = ConversionRate::where('currency_1', 'btc')->where('currency_2', 'usd')->first();
        $btc_value = round($wallet->amount / $btc_rate->value, 8);
        $total_live_traders = StaticMessage::where('title', 'total_live_traders')->first();
        // dd($btc_value);
        // $transactions = $user->transactions()->orderBy('created_at','desc')->get();
        $transactions = $user->transactions;
        // dd($transactions);
        if($user->acc_stat_id == 1) {
            Auth::guard('user')->logout();
            return redirect()->route('login')->with('failed',
                'Your account has being temporarily blocked due to security reasons.
                Please hold on, we are currently working on it and it will be activated shortly.
                You will receive your account details after activation.');
        }
    	return view('dash.home', compact(['user', 'wallet','transactions', 'total_live_traders', 'btc_value']));
    }

    public function trade() {
    	$user = $this->user();
        $wallet = $this->user()->wallet;
        $btc_rate = ConversionRate::where('currency_1', 'btc')->where('currency_2', 'usd')->first();
        $btc_value = round($wallet->amount / $btc_rate->value, 8);
        $total_live_traders = StaticMessage::where('title', 'total_live_traders')->first();
        if($user->acc_stat_id == 1) {
            Auth::guard('user')->logout();
            return redirect()->route('login')->with('failed',
                'Your account has being temporarily blocked due to security reasons.
                Please hold on, we are currently working on it and it will be activated shortly.
                You will receive your account details after activation.');
        }
    	return view('dash.trade', compact(['user', 'wallet','btc_rate', 'btc_value', 'total_live_traders']));
    }

    public function transaction_pin() {
    	$user = $this->user();
        if($user->acc_stat_id == 1) {
            Auth::guard('user')->logout();
            return redirect()->route('login')->with('failed',
                'Your account has being temporarily blocked due to security reasons.
                Please hold on, we are currently working on it and it will be activated shortly.
                You will receive your account details after activation.');
        }
        return view('auth.transaction_pin');

    }

    public function process_pin(Request $request) {
    	$user = $this->user();
        if($user->acc_stat_id == 1) {
            Auth::guard('user')->logout();
            return response('Your account has being temporarily blocked due to security reasons.
                Please hold on, we are currently working on it and it will be activated shortly.
                You will receive your account details after activation.', 200);
        }
        if($user->transaction_pin == $request->pin) {
            return response('transaction pin verified successfully!', 200);
        }
        return response('Invalid transaction pin. Please check your email to verify your transaction pin!', 403);
    }

    public function add_money() {
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
    	return view('dash.fund-wallet', compact(['user', 'wallet', 'section3a']));
    }

    public function account_statement(Request $request) {
    	$user = $this->user();
        if($user->acc_stat_id == 1) {
            Auth::guard('user')->logout();
            return redirect()->route('login')->with('failed',
                'Your account has being temporarily blocked due to security reasons.
                Please hold on, we are currently working on it and it will be activated shortly.
                You will receive your account details after activation.');
        }
        $wallet = $user->wallet;
        $section3a = Homepage::find(5);
        $transactions = $user->transactions;
        return view('user.account_statement', compact(['user','wallet', 'transactions', 'section3a']));
    }

    public function investments() {
    	$user = $this->user();
        if($user->acc_stat_id == 1) {
            Auth::guard('user')->logout();
            return redirect()->route('login')->with('failed',
                'Your account has being temporarily blocked due to security reasons.
                Please hold on, we are currently working on it and it will be activated shortly.
                You will receive your account details after activation.');
        }
        $active_investments = $user->investments()->where('status', Investment::PENDING)->orderBy('updated_at')->paginate(50);
        return view('dash.manage-investments', compact(['user', 'active_investments']));
    }

    public function investment_plans() {
    	$user = $this->user();
        if($user->acc_stat_id == 1) {
            Auth::guard('user')->logout();
            return redirect()->route('login')->with('failed',
                'Your account has being temporarily blocked due to security reasons.
                Please hold on, we are currently working on it and it will be activated shortly.
                You will receive your account details after activation.');
        }
        $investment_plans = InvestmentPlan::orderBy('min_amount', 'asc')->get();
        return view('dash.investment-plans', compact(['user', 'investment_plans']));
    }

    public function investment_select(InvestmentPlan $investmentPlan) {
    	$user = $this->user();
        if($user->acc_stat_id == 1) {
            Auth::guard('user')->logout();
            return redirect()->route('login')->with('failed',
                'Your account has being temporarily blocked due to security reasons.
                Please hold on, we are currently working on it and it will be activated shortly.
                You will receive your account details after activation.');
        }
        $wallet = $user->wallet;
        return view('dash.investment-select', compact(['user', 'wallet', 'investmentPlan']));

    }

    public function invest(InvestmentPlan $investmentPlan, Request $request) {
    	$user = $this->user();
        if($user->acc_stat_id == 1) {
            Auth::guard('user')->logout();
            return redirect()->route('login')->with('failed',
                'Your account has being temporarily blocked due to security reasons.
                Please hold on, we are currently working on it and it will be activated shortly.
                You will receive your account details after activation.');
        }

        $amount = (float) $request->amount;

        $wallet = $user->wallet;

        $rules = [
            'amount' => 'lte:'.$wallet->amount
        ];

        $messages = [
            'lte' => 'Insufficient Balance. Please fund your account to begin investment and start earning.'
        ];

        $validator = Validator::make(['amount' => $amount], $rules, $messages);
        if ($validator->fails()) {
            return redirect()->route('user.fund_wallet')->with('failed', 'Insufficient Balance. Please fund your account using any payment method of your choice to begin investment and start earning.');
        }
        if ($amount < $investmentPlan->min_amount) {
            return back()->withErrors(['amount' => 'Invalid amount. Amount must be greater than minimum investment amount or you select another investment package.'])->withInput();
        }
        if ($amount > $investmentPlan->max_amount) {
            return back()->withErrors(['amount' => 'Invalid amount. Amount must be lesser than maximum investment amount or you select another investment package.'])->withInput();
        }

        $total_duration = $investmentPlan->duration * $investmentPlan->cycles;

        $user->investments()->create([
            'investment_plan_id' => $investmentPlan->id,
            'amount' => $amount,
            'expire_at' => now()->addDays($total_duration),
        ]);

        $wallet->amount -= $request->amount;
        $wallet->save();

        return redirect()->route('user.investments')->with('success', 'Investment started successfully!');
        // return redirect()->route('')->with('success', 'Investment started successfully!');
    }


    public function withdraw_money() {
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
        $withdraw_spec = WithdrawSpec::firstOrFail();
        $withdraw_pendings = $user->withdraw_requests()->pending()->orderBy('id','desc')->limit(5)->get();
        $withdraw_faileds = $user->withdraw_requests()->failed()->orderBy('id','desc')->get();
        $withdraw_successes = $user->withdraw_requests()->success()->orderBy('id','desc')->get();
        $btc_rate = ConversionRate::where('currency_1', 'btc')->where('currency_2', 'usd')->first();
        $btc_value = round($wallet->amount / $btc_rate->value, 8);
        $total_live_traders = StaticMessage::where('title', 'total_live_traders')->first();
    	return view('dash.withdraw', compact(['user', 'wallet', 'btc_value', 'total_live_traders', 'withdraw_pendings', 'withdraw_spec', 'withdraw_faileds', 'section3a', 'withdraw_successes']));
    }

    public function withdraw_history(Request $request) {
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
        $withdraw_requests = $user->withdraw_requests();
        $sort = "newest";
        $filter = "all";

        // Sort Data
        if($request->sort === 'oldest') {
            $withdraw_requests = $withdraw_requests->oldest();
            $sort = 'oldest';
        }
        else
            $withdraw_requests = $withdraw_requests->newest();

        // Filter Data
        if($request->filter === 'success') {
            $withdraw_requests = $withdraw_requests->success();
            $filter = 'success';
        }
        elseif($request->filter === 'failed') {
            $withdraw_requests = $withdraw_requests->failed();
            $filter = 'failed';
        }
        elseif($request->filter === 'pending') {
            $withdraw_requests = $withdraw_requests->pending();
            $filter = 'pending';
        }
        elseif($request->filter === 'in_progress') {
            $withdraw_requests = $withdraw_requests->inProgress();
            $filter = 'in_progress';
        }

        $withdraw_requests = $withdraw_requests->paginate(15);
        return view('user.withdraw_history', compact(['user','wallet','withdraw_requests','section3a', 'filter', 'sort']));
    }

    public function transfer_money() {
    	$user = $this->user();
        if($user->acc_stat_id == 1) {
            Auth::guard('user')->logout();
            return redirect()->route('login')->with('failed',
                'Your account has being temporarily blocked due to security reasons.
                Please hold on, we are currently working on it and it will be activated shortly.
                You will receive your account details after activation.');
        }
        $withdraw_spec = WithdrawSpec::find(2);
    	$wallet = $this->user()->wallet;
        $section3a = Homepage::find(5);
    	return view('user.transfer_nwallet', compact(['user', 'wallet', 'withdraw_spec', 'section3a']));
    }

    public function redeem_pc() {
    	$user = $this->user();
        if($user->acc_stat_id == 1) {
            Auth::guard('user')->logout();
            return redirect()->route('login')->with('failed',
                'Your account has being temporarily blocked due to security reasons.
                Please hold on, we are currently working on it and it will be activated shortly.
                You will receive your account details after activation.');
        }
        $wallet = $this->user()->wallet;
        $promo_codes = $user->assigned_pcs()->where('service_stat_id', 1)->paginate(5);
        return view('user.redeem_pc', compact(['user', 'wallet', 'promo_codes']));
    }

    public function pc_redeem(Request $request) {
    	$user = $this->user();
        if($user->acc_stat_id == 1) {
            Auth::guard('user')->logout();
            return redirect()->route('login')->with('failed',
                'Your account has being temporarily blocked due to security reasons.
                Please hold on, we are currently working on it and it will be activated shortly.
                You will receive your account details after activation.');
        }
        $wallet = $this->user()->wallet;
        $promo_codes = $user->assigned_pcs()->where('service_stat_id', 1);

        $this->validate(request(), [
            'code' => 'required|exists:promo_codes'
        ]);


        $promo_code = $request->code;
        $valid_code = PromoCode::where('code', $promo_code)->firstOrFail();
        $ss_used = ServiceStat::find(9);
        $ss_success = ServiceStat::find(3);
        $tt_pc_credit = TransType::find(5);
        $check_code = $promo_codes->where('promo_code_id', $valid_code->id)->count();
        $get_code = $promo_codes->where('promo_code_id', $valid_code->id);

        if($check_code) {
            $get_code = $get_code->firstOrFail();
            $get_code->service_stat_id = $ss_used->id;
            $transaction = new Transaction;
            $reference_no = new ReferenceNo;

            // Fill in transaction information
            $transaction->trans_type_id = $tt_pc_credit->id;
            $transaction->wallet_id = $wallet->id;
            $transaction->amount = $get_code->promo_code->amount;
            $transaction->prev_amount = $wallet->amount;
            $transaction->service_stat_id = $ss_success->id;

            // credit wallet back
            $wallet->amount += $get_code->promo_code->amount;
            $reference_no->reference_no = $this->generateReferenceNo();
            $reference_no->trans_type_id = $tt_pc_credit->id;
            $user->reference_nos()->save($reference_no);
            $transaction->reference_no_id = $reference_no->id;
            $user->transactions()->save($transaction);
            $get_code->save();
            $wallet->save();

            session()->flash('success', 'Promo Code redeemed successfully!');
        } else {
            session()->flash('failed', 'Promo Code may have been used by you or is no more valid!');
        }
        return redirect()->route('user.redeem_pc');
    }

    protected function user() {
    	return Auth::user();
    }

    protected function generateReferenceNo() {
        $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        return substr(str_shuffle($permitted_chars), 0, 25);
    }
}
