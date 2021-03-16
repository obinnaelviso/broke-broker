@extends('layouts.home.main')
@section('page-title', 'Contact Us - Royal Imperial Bank')
@section('content')
	<!--/home -->
    <div id="home" class="inner-w3pvt-page">
        <div class="overlay-innerpage">
            @include('layouts.home.header')
        </div>
    </div>
        <section class="about-info py-5 px-lg-5">
	        <div class="content-w3ls-inn px-lg-5">
	            <div class="container py-md-5 py-3">
	                <div class="px-lg-5">
	                    <h3 class="tittle-w3ls mb-lg-5 mb-4"><span class="pink">Contact</span> Us</h3>
	                    <div class="col-md-4"><p><span class="fa fa-map-marker"></span> {!! $contact_a->body !!}</p></div><div class="col-md-4"><span class="fa fa-phone"></span> {!! $contact_p->body !!}</p></div><div class="col-md-4"><span class="fa fa-envelope"></span> <a href="mailto:{{ $contact_e->body }}">{!! $contact_e->body !!}</a></div>{{--
	                    <p class="mt-5 pr-lg-5">Accumsan orci faucibus id eu lorem semper. Eu ac iaculis ac nunc nisi lorem vulputate lorem neque cubilia ac in adipiscing in curae lobortis tortor primis integer massa adipiscing id nisi accumsan pellentesque commodo blandit enim arcu non at amet id arcu magna. Accumsan orci faucibus id eu lorem semper nunc nisi lorem vulputate lorem neque cubilia.</p> --}}


	                    <div class="contact-hny-form mt-lg-5 mt-3">
	                        <h3 class="title-hny mb-lg-5 mb-3">
	                            Drop a Line
	                        </h3>
	                        <form action="{{ route('contact_us') }}" method="post">
	                        	@csrf
	                        	@if(session()->has('success'))
					                <div class="alert alert-success">
					                  {{ session()->get('success') }}
					                </div>
					              @endif
	                            <div class="row">
	                                <div class="col-lg-6">
	                                    <div class="form-group">
	                                        <label for="name">Your Name</label>
	                                        <input type="text" name="name" id="name">
	                                    </div>
	                                    <div class="form-group">
	                                        <label for="email">Your Email ID <span class="red-text">*</span></label>
	                                        <input type="text" name="email" id="w3lSender" required>
	                                    </div>
	                                    <div class="form-group">
	                                        <label for="subject">Subject</label>
	                                        <input type="text" name="subject" id="w3lSubject">
	                                    </div>
	                                </div>
	                                <div class="col-lg-6">
	                                    <div class="form-group">
	                                        <label for="message">Message</label>
	                                        <textarea name="message" id="w3lMessage"></textarea>
	                                    </div>
	                                </div>
	                                <div class="form-group mx-auto mt-3">
	                                    <button type="submit" class="btn btn-default morebtn more black con-submit">Submit</button>
	                                </div>
	                            </div>
	                        </form>
	                    </div>
	                </div>
	            </div>
	        </div>
    	</section>
    <!-- //home -->

@endsection
