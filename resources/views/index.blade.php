@extends('layouts.home.main')
@section('page-title', 'Welcome to '.config('app.name'))
@section('content')
    	<!-- Hero section -->
	<section class="hero-section">
		<div class="hero-slider owl-carousel">
			<div class="hs-item set-bg" data-setbg="/home/img/hero-slider/1.jpeg">
				<div class="hs-text">
					<div class="container">
						<div class="row">
							<div class="col-lg-8">
								<div class="hs-subtitle">No. 1 Trading Broker</div>
								<h2 class="hs-title">Start Earning On {{ config('app.name') }}</h2>
								<p class="hs-des">Whether you're getting started or want to invest with the help of an experienced professional,<br> we can help find the right strategy for you.</p>
								<a class="site-btn" href="{{ route('register') }}">REGISTER NOW</a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="hs-item set-bg" data-setbg="/home/img/hero-slider/2.jpeg">
				<div class="hs-text">
					<div class="container">
						<div class="row">
							<div class="col-lg-8">
								<div class="hs-subtitle">GET STARTED</div>
								<h2 class="hs-title">Join {{ config('app.name') }} today</h2>
								<p class="hs-des">{{ config('app.name') }} has gained a leading reputation among traders due to its wide offering of investment assets and superior trading conditions.<br> Our trading strategies are easy to learn and implement, and you start earning with it in no time.</p>
								<a class="site-btn" href="{{ route('register') }}">REGISTER NOW</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Hero section end -->


	<!-- Services section -->
	<section class="service-section spad set-bg" data-setbg="/home/img/bgs/dark-blue.jpg">
		<div class="container services">
			<div class="section-title text-center">
				<h1 style="color:orange; text-shadow: black 2px 2px 2px">START TRADING NOW!</h1>
				<h2 class="text-capitalize text-white">Our Online Managers Will Help You Succeed</h2><br>
				<h5 class="text-capitalize text-white">More than 1000+ assets available for you</h5>
				<h5 class="text-capitalize text-white">From any device, any time, with a highest level of security and beautiful managers in video chat!</h5>
				{{-- <p>We provides the opportunity to prepare for life</p> --}}
			</div>
			<div class="row text-center">
				<div class="col-12">
                    <img class="img-fluid animate__animated animate__bounce" src="/home/img/pc-mobile.png" data-aos-delay="100" data-aos-duration="1000" alt="mobile-desktop devices">
				</div>
			</div>
		</div>
	</section>
	<!-- Services section end -->


    <!-- Enroll section -->
    <div id="start-trading"></div>
	<section class="enroll-section spad set-bg text-center" data-setbg="/home/img/enroll-bg.jpg">
		<div class="container">
            <div class="section-title text-white">
                <h2 style="color:orange; text-shadow: black 2px 2px 2px">START EARNING LIVE!</h2>
                <h3>IN JUST 3 EASY STEPS</h3>
            </div>
			<div class="row">
				<div class="col-md-4">
					<div class="text-white" data-aos-delay="50" data-aos-duration="500">
                        <div style="font-size: 5em"><i class="fa fa-gift"></i></div>
                        <h4>Register To Gain Access!</h4>
                        <a href="#step1"><div class="steps">1</div></a>
					</div>
				</div>
				<div class="col-md-4">
					<div class="text-white" data-aos-delay="150" data-aos-duration="500">
                        <div style="font-size: 5em"><i class="ti-wallet"></i></div>
                        <h4>Funding your Trading Account!</h4>
                        <a href="#step2"><div class="steps">2</div></a>
					</div>
				</div>
				<div class="col-md-4">
					<div class="text-white" data-aos-delay="250" data-aos-duration="500">
                        <div style="font-size: 5em"><i class="fa fa-line-chart"></i></div>
                        <h4>Predict The Market Direction And Earn!</h4>
                        <a href="#step3"><div class="steps">3</div></a>
					</div>
				</div>
			</div>
		</div>
	</section>
    <!-- Enroll section end -->

    <!-- Step 1 section -->
    <div id="step1"></div>
	<section class="enroll-section spad set-bg" data-setbg="/home/img/bgs/fx-buy-sell-min.jpg">
		<div class="container">
			<div class="row">
				<div class="col-md-6">
					<div class="text-white" data-aos-delay="50" data-aos-duration="500">
                        <img src="/home/img/member/businessman.png" alt="" class="img-fluid">
					</div>
				</div>
				<div class="col-md-6">
					<div class="text-white"  data-aos-delay="150" data-aos-duration="500">
                        <h2 style="color:orange; text-shadow: black 2px 2px 2px">Step 1</h2><br>
                        <h3 class="text-uppercase">REGISTER NOW AND RECEIVE A FREE GIFT <i class="fa fa-gift" aria-hidden="true"></i></h3>
                        <p>Join {{ config('app.name') }} today and start earning huge profits and income. Start trading today with our strategies to help you succeed. Our professionals are available on our live chat 24/7 to help assist you in anything.</p>
                        <img src="/home/img/fx-register.PNG" alt="" class="img-fluid mb-3">
                        <br><br>
                        <a class="site-btn" href="#">REGISTER</a>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Step 1 section end -->


    <!-- Step 2 section -->
    <div id="step2"></div>
	<section class="enroll-section spad set-bg" data-setbg="/home/img/bgs/fx-1.jpg">
		<div class="container text-center">
            <div class="section-title text-white" data-aos-delay="150" data-aos-duration="500">
                <h2 style="color:orange; text-shadow: black 2px 2px 2px">Step 2</h2>
                <h3>FUND YOUR TRADING ACCOUNT</h3>
                <h5>You can fund your account right after registration. <br> We support all of the following payment methods below.</h5>
            </div>
			<div class="row">
				<div class="col-md-12">
                    <div class="payments">
                        <div><img src="/home/img/payments/visa.png" alt="visa"></div>
                        <div><img src="/home/img/payments/master.png" alt="mastercard"></div>
                        <div><img src="/home/img/payments/okpay.png" alt="ok-pay"></div>
                        <div><img src="/home/img/payments/skrill_w.png" alt="skrill"></div>
                        <div><img src="/home/img/payments/yandex.png" alt="yandex"></div>
                        <div><img src="/home/img/payments/payoneer.png" alt="payoneer"></div>
                        <div><img src="/home/img/payments/neteller.png" alt="neteller"></div>
                        <div><img src="/home/img/payments/qiwi.png" alt="qiwi"></div>
                        <div><img src="/home/img/payments/transfer.png" alt="transfer"></div>
                    </div>
				</div>
			</div>
		</div>
	</section>
    <!-- Step 2 section end -->

    <!-- Step 3 section -->
    <div id="step3"></div>
	<section class="enroll-section spad set-bg" data-setbg="/home/img/bgs/stocks.jpg">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="text-white"  data-aos-delay="150" data-aos-duration="500">
                        <h2 style="color:orange; text-shadow: black 2px 2px 2px">Step 3</h2><br>
                        <h2>Predict Market Direction and Earn! <i class="fa fa-money" aria-hidden="true"></i></h2>
                        <p>Independently or with the help of our specialists you will learn trading strategies that will help boost your earnings.</p>
                        <p>You will evaluate how fast we process the payouts. All withdrawal requests are done within an hour!</p>
                        <iframe src="{{ route('tradetyni') }}" class="mini-platform d-none d-sm-block" width="704px" frameborder="0" height="338px"></iframe>
                        <br><br>
                        <a class="site-btn" href="#">Start trading now!</a>
					</div>
				</div>
			</div>
		</div>
	</section>
    <!-- Step 3 section end -->


	<!-- Fact section -->
	<section class="fact-section spad set-bg" data-setbg="/home/img/course/6.jpg">
		<div class="container">
			<div class="row">
				<div class="col-md-6 fact">
					<div class="fact-icon">
						<i class="ti-user"></i>
					</div>
					<div class="fact-text">
						<h2>12819</h2>
						<p>ACTIVE TRADERS</p>
					</div>
				</div>
				<div class="col-md-6 fact">
					<div class="fact-icon">
						<i class="ti-bar-chart"></i>
					</div>
					<div class="fact-text">
						<h2>$17754503</h2>
						<p>TRADING VOLUME</p>
					</div>
				</div>
				<div class="col-md-6 fact">
					<div class="fact-icon">
						<i class="ti-wallet"></i>
					</div>
					<div class="fact-text">
						<h2>$2388577</h2>
						<p>PAYMENTS IN OUR TRADERS</p>
					</div>
                </div>
                <div class="clearfix"></div>
				<div class="col-md-6 fact">
					<div class="fact-icon">
						<i class="ti-timer"></i>
					</div>
					<div class="fact-text">
						<h2>42 MINS</h2>
						<p>AVG. TIME FOR WITHDRAWAL REQUESTS</p>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Fact section end-->

	<!-- Event section -->
	<section class="event-section spad set-bg" data-setbg="/home/img/bgs/executives.jpg">
		<div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div id="testimonial-slider" class="owl-carousel">
                        <div class="testimonial">
                            <p class="description">
                                The site is good, The support team is also nice and fast in the answers.                            
                            </p>
                            <div class="testimonial-content">
        {{--                         <div class="pic">
                                    <img src="images/img-1.jpg">
                                </div> --}}
                                <h3 class="title">Ridwan Usain</h3>
                            </div>
                        </div>

                        <div class="testimonial">
                            <p class="description">
                                    Made $995 in 6 hours!! Way more winners than losers. I would say 85% they are right!
                            </p>
                            <div class="testimonial-content">
        {{--                         <div class="pic">
                                    <img src="images/img-2.jpg">
                                </div> --}}
                                <h3 class="title">Kristina Kurta</h3>
                            </div>
                        </div>

                        <div class="testimonial">
                            <p class="description">
            Great work guys and I can confirm that I rode at least 300 of those pips of profits which your trading signals spotted over the last 5 days. It was great for my account. I just need to know how on earth you guys manage it?                            
                            </p>
                            <div class="testimonial-content">
        {{--                         <div class="pic">
                                    <img src="images/img-3.jpg">
                                </div> --}}
                                <h3 class="title">Rollin Psalms</h3>
                            </div>
                        </div>



                        <div class="testimonial">
                                <p class="description">
                Very good… 80% of them are winning trades, keep up the good job.                                </p>
                                <div class="testimonial-content">
            {{--                         <div class="pic">
                                        <img src="images/img-3.jpg">
                                    </div> --}}
                                    <h3 class="title">Katrina Richman</h3>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
	</section>
	<!-- Event section end -->
@endsection
@section('myJS')
<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
<script src="/home/js/faker.js"></script>
  <script>

      var toast = new Toastr({position: 'topRight', timeout: 3000});
    //   var delay = Math.floor((Math.random() * 20000) + 5000)
      var delay = 5000

      setInterval(showToast, delay)

      function showToast() {
        //   var name = shuffle(clients)
        var name = faker.name.findName()
        var selectCountry = shuffle([faker.address.state(), 'South Africa', 'Netherlands'])
        var country = selectCountry[0]
        var amount = Math.floor((Math.random() * (50000-2000)) + 2000)
        toast.show(name + ' from ' + country + '<br> just earned $'+ amount)
      }

      function shuffle(a) {
        var j, x, i;
        for (i = a.length - 1; i > 0; i--) {
            j = Math.floor(Math.random() * (i + 1));
            x = a[i];
            a[i] = a[j];
            a[j] = x;
        }
        return a;
       }

    AOS.init();


    $('.payments').slick({
        slidesToShow: 5,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 1000,
    })

    $("#testimonial-slider").owlCarousel({
        items:2,
        itemsDesktop:[1000,2],
        itemsDesktopSmall:[979,2],
        itemsTablet:[768,1],
        pagination:true,

        autoPlay:true
    });
  </script>
@endsection
