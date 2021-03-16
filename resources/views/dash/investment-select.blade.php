@extends('layouts.dash.main')
@section('title', ucfirst($investmentPlan->title).' Investment Plan - '.config('app.name'))
@section('profile-active', 'active')
@section('content')

<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="page-header">
            <h2 class="pageheader-title text-capitalize">{{ $investmentPlan->title }} Investment Plan</h2>
            {{-- <p class="pageheader-text">Fill in your account details and your withdrawal will be processed in less than an hour</p> --}}
            <hr>
        </div>
    </div>
</div>

<div class="row mb-5">
    <div class="col-md-12 card p-5">
        @include('layouts.dash.alerts')
      <form action="{{ route('user.investments.plans.invest', $investmentPlan->id) }}" method="POST">
        @csrf

        <div class="row">
            <div class="col-md-12">
                <label for="amount" class="col-form-label">Amount to Invest <span class="text-danger">*</span></label>
                <input type="text" class="form-control form-control-lg mb-4 @error('amount') is-invalid @enderror" name="amount" id="amount" value="{{ old('amount') ?: $investmentPlan->min_amount }}" required>
                @error('amount')
                    <div class="alert alert-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </div>
                @enderror
            </div>
        </div>

        <hr>

        <div class="row">
            <div class="col-md-6">
                <h3>Balance:</h3>
            </div>
            <div class="col-md-6 text-right">
                <h3>${{ $wallet->amount }}</h3>
            </div>
        </div>

        <hr>

        <div class="row">
            <div class="col-md-6">
                <h3>Duration:</h3>
            </div>
            <div class="col-md-6 text-right">
                <h3>{{ $investmentPlan->duration }} days</h3>
            </div>
        </div>

        <hr>

        <div class="row">
            <div class="col-md-6">
                <h3>Percentage Profit:</h3>
            </div>
            <div class="col-md-6 text-right">
                <h3>{{ $investmentPlan->percentage }}%</h3>
            </div>
        </div>

        <hr>

        <div class="row">
            <div class="col-md-6">
                <h3>Cycles:</h3>
            </div>
            <div class="col-md-6 text-right">
                <h3>{{ $investmentPlan->cycles }}</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <button class="btn btn-primary btn-lg btn-block"><i class="fa fa-hourglass" aria-hidden="true"></i> Invest</button>
            </div>
        </div>
      </form>
    </div>
</div>

@endsection
@section('input-js')

<!-- Numeric validation -->
<script src="/plugins/numeric-validation/jquery.numeric.min.js"></script>

<script type="text/javascript">
	$(".num").numeric({ decimal: false, negative: false }, function() { alert("Positive integers only"); this.value = ""; this.focus(); });
	$("#positive-integer").numeric({ decimal: false, negative: false }, function() { alert("Positive integers only"); this.value = ""; this.focus(); });
</script>
@endsection
