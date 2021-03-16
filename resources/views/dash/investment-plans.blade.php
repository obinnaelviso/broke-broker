@extends('layouts.dash.main')
@section('title', 'Investment Plans - '.config('app.name'))
@section('investment-plans-active', 'active')
@section('content')
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="page-header">
            <h2 class="pageheader-title">Investment Plans</h2>
            <p class="pageheader-text">Choose a suitable investment package that best suites your needs to start earning big.</p>
            <hr>
        </div>
    </div>
</div>


<div class="row mb-5">
    @foreach($investment_plans as $investment_plan)
    @php
        $minimum_payout_per_cycle = round(($investment_plan->min_amount * $investment_plan->percentage)/100);
        $total_profit = $minimum_payout_per_cycle * $investment_plan->cycles;
        $total_payout = $total_profit + $investment_plan->min_amount;
    @endphp
    <div class="col-md-4 col-sm-6">
        <div class="card card-pricing text-center px-3 mb-4">
            <span class="h6 w-60 mx-auto px-4 py-1 rounded-bottom bg-primary text-white shadow-sm text-capitalize">{{ $investment_plan->title }}</span>
            <div class="bg-transparent card-header pt-4 border-0">
                <h1 class="h1 font-weight-normal text-primary text-center mb-0">$<span class="price">{{ intval($investment_plan->min_amount) }}</span><span class="h6 text-muted ml-2"><br> per {{ $investment_plan->duration }} days</span></h1>
            </div>
            <div class="card-body pt-0">
                <ul class="list-unstyled mb-4">
                    <li>Max. Amount: <strong class="text-secondary">${{ $investment_plan->max_amount }}</strong></li>
                    <li>Capital Included: <strong>YES</strong></li>
                    <li>Percentage: <strong>{{ $investment_plan->percentage }}%</strong></li>
                    <li>Min. Payout/Cycle: <strong class="text-success">${{ $minimum_payout_per_cycle }}+</strong></li>
                    <li>Total Cycles: <strong>{{ $investment_plan->cycles }}</strong></li>
                    <li>Min. Profit: <strong class="text-success">${{ $total_profit }}+</strong></li>
                    <li>Min. Payout With Capital: <strong class="text-success">${{ $total_payout }}+</strong></li>
                    <li>Bonus Included: <strong>{!! $investment_plan->bonus ? "<span class='text-success'>$".$investment_plan->bonus."+</span>" : "NONE" !!}</strong></li>
                </ul>
                <a href="{{ route('user.investments.plans.select', $investment_plan->id) }}" class="btn btn-outline-secondary mb-3">Invest now!</a>
            </div>
        </div>
    </div>
    @endforeach
    {{-- <div class="col-md-4">
        <div class="card card-pricing popular shadow text-center px-3 mb-4">
            <span class="h6 w-60 mx-auto px-4 py-1 rounded-bottom bg-primary text-white shadow-sm">Professional</span>
            <div class="bg-transparent card-header pt-4 border-0">
                <h1 class="h1 font-weight-normal text-primary text-center mb-0" data-pricing-value="30">$<span class="price">6</span><span class="h6 text-muted ml-2">/ per month</span></h1>
            </div>
            <div class="card-body pt-0">
                <ul class="list-unstyled mb-4">
                    <li>Up to 5 users</li>
                    <li>Basic support on Github</li>
                    <li>Monthly updates</li>
                    <li>Free cancelation</li>
                </ul>
                <a href="https://www.totoprayogo.com" target="_blank" class="btn btn-primary mb-3">Order Now</a>
            </div>
        </div>
    </div> --}}
</div>
@endsection
@push('more-js')
@endpush
