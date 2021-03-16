@extends('layouts.admin.main')
@section('title', 'Edit Website - nwallet')
@section('page-title', 'Edit Website')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('suser.home') }}">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">@yield('page-title')</li>
@endsection

@section('content')
<div class="row">
	<div class="container">
	    <div class="col-12">
	    	@include('layouts.alert')
		    <form action="{{ route('suser.configure_homepage') }}" method="post" enctype="multipart/form-data">
		    	@csrf
			    <div class="row">
			    	<div class="col-12">
			    		{{-- Edit BTC Exchange Rate 1 --}}
			    		<div class="form-group">
			    			<div class="col-sm-12 mb-4">
			    				<h6>Edit BTC Exchange Rates</h6>
			    			</div>
			    			<div class="col-md-6 mb-4">
                                <label>1 BTC in USD</label>
			    				<input type="text" class="form-control" maxlength="255" name="usd_value" value="{{ $btc_conversion->value }}">
			    			</div>
			    		</div>
			    		<hr>
			    		<div class="row">
			    			<button class="btn btn-primary" type="submit">Save Changes</button>
			    		</div>
			    	</div>
			    </div>
			</form>
		    @if($errors->any())
		        <div class="col-12">
			      <div class="alert alert-danger">
			        <ul>
			          @foreach($errors->all() as $error)
			            <li>{{ $error }}</li>
			          @endforeach
			        </ul>
			      </div>
		        </div>
		    @endif
	    </div>
    </div>
  </div>
@endsection
