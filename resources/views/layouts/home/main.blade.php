<!DOCTYPE html>
<html lang="en">
@include('layouts.home.head')
<body>
@include('layouts.home.header')
@yield('content')

@include('layouts.home.footer')
	<!--====== Javascripts & Jquery ======-->
	<script src="/home/js/jquery-3.2.1.min.js"></script>
	<script src="/home/js/owl.carousel.min.js"></script>
	<script src="/home/js/jquery.countdown.js"></script>
	<script src="/home/js/masonry.pkgd.min.js"></script>
	<script src="/home/js/magnific-popup.min.js"></script>
    <script src="/home/js/main.js"></script>
    <script src="/home/toastr/toastr.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.js"></script>
    <!--Start of Tawk.to Script-->
    @include('layouts.tawk')
    @yield('myJS')
</body>
</html>
