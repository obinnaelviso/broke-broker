<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Model\Investment;
use App\Model\InvestmentPlan;
use Carbon\Carbon;

class InvestmentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index() {
    	$suser = $this->suser();
        $active_investments = Investment::where('status', Investment::PENDING)->get();
    	return view('admin.investments', compact(['suser', 'active_investments']));
    }

    public function cancel(Investment $investment) {
        $investment->user->wallet->amount += $investment->amount;
        $investment->user->wallet->save();
        $investment->status = Investment::CANCELLED;
        $investment->save();
        return response(['success', 'Investment cancelled successfully!']);
    }

    public function complete(Investment $investment) {
        $pending_cycles = $investment->plan->cycles - $investment->completed_cycles;
        $profit_per_cycle = ($investment->amount * $investment->plan->percentage)/100;
        $total_profit = $profit_per_cycle * $pending_cycles;
        $total_payout = $investment->amount + $total_profit;
        $investment->user->wallet->amount += $total_payout;
        $investment->user->wallet->save();
        $investment->status = Investment::COMPLETED;
        $investment->completed_cycles = $investment->plan->cycles;
        $investment->save();
        return response(['success', 'Investment completed successfully!']);
    }
    public function plans() {
    	$suser = $this->suser();
        $investment_plans = InvestmentPlan::orderBy('min_amount', 'asc')->get();
    	return view('admin.investment-plans', compact(['suser', 'investment_plans']));
    }

    public function plans_add(Request $request) {
    	$this->validate(request(), [
            'title' => 'required',
            'min_amount' => 'required|numeric',
            'max_amount' => 'required|numeric',
            'duration' => 'numeric|nullable',
            'cycles' => 'numeric|nullable',
            'percentage' => 'numeric|nullable',
            'bonus' => 'numeric|nullable',
        ]);

        InvestmentPlan::create([
            'title' => $request->title,
            'min_amount' => $request->min_amount,
            'max_amount' => $request->max_amount,
            'duration' => $request->duration ?: 7,
            'cycles' => $request->cycles ?: 1,
            'percentage' => $request->percentage ?: 15,
            'bonus' => $request->bonus]
        );
        return redirect()->route('suser.investments.plans')->with('success', 'Investment plan added successfully!');

    }

    public function plans_edit(InvestmentPlan $investmentPlan, Request $request) {
    	$this->validate(request(), [
            'title' => 'required',
            'min_amount' => 'required|numeric',
            'max_amount' => 'required|numeric',
            'duration' => 'numeric|nullable',
            'cycles' => 'numeric|nullable',
            'percentage' => 'numeric|nullable',
            'bonus' => 'numeric|nullable',
        ]);

        $investmentPlan->update([
            'title' => $request->title,
            'min_amount' => $request->min_amount,
            'max_amount' => $request->max_amount,
            'duration' => $request->duration ?: 7,
            'cycles' => $request->cycles ?: 1,
            'percentage' => $request->percentage ?: 15,
            'bonus' => $request->bonus]
        );
        return redirect()->route('suser.investments.plans')->with('success', 'Investment plan updated successfully!');
    }

    public function plans_delete(InvestmentPlan $investmentPlan) {
        $investmentPlan->delete();
        return response(['success' => 'Investment plan removed successfully!']);
    }

    public function suser() {
    	return Auth::user('admin');
    }

    protected function generateReferenceNo($size) {
    	$permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		return substr(str_shuffle($permitted_chars), 0, $size);
    }
}
