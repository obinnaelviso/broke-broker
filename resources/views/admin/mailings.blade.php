@extends('layouts.admin.main')
@section('title', 'Mail Users - nwallet')
@section('page-title', 'Mail Users')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('suser.home') }}">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">@yield('page-title')</li>
@endsection

@section('content')
<div class="row">
	<div class="container">
	    <div class="col-12">
	    	<div class="row">
		    	<div class="col-12">
			        @if(session()->has('success'))
			          <div class="alert alert-success">
			            {{ session()->get('success') }}
			          </div>
			        @endif
			        @if(session()->has('failed'))
			          <div class="alert alert-danger">
			            {{ session()->get('failed') }}
			          </div>
			        @endif
		     	</div>
		     	<form action="{{ route('suser.mailings') }}" method="post" style=" margin:auto">
		     		@csrf
		     		<div class="row text-center">
		     			<div class="col-md-12 mb-4">
		    				<h6>Subject</h6>
		    				<input type="text" class="form-control" maxlength="255" name="subject">
				    	</div>
				    	{{-- <div class="form-check">
						  <label class="form-check-label">
						    <input type="radio" class="form-check-input" name="users">Specfic User
						  </label>
						</div> --}}
		    			<div class="col-md-12 mb-4">
		    				<h6>Message</h6>
		    				<textarea type="text" id="editor" class="form-control" name="message" maxlength="1000" rows="10"></textarea>
		    			</div>
		    			<div class="col-md-12">
		    				<button class="btn btn-primary" type="submit"><i class="ti-upload"></i> Send</button>
		    			</div>
		     		</div>
		     	</form>
		    </div>
		</div>
	</div>
</div>
@endsection