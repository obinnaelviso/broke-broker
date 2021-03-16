<!-- jQuery -->
<script src="{{ config('globals.path') }}/plugins/jQuery/jquery.min.js"></script>
<!-- Bootstrap JS -->
<script src="{{ config('globals.path') }}/plugins/bootstrap/bootstrap.min.js"></script>
<!-- slick slider -->
<script src="{{ config('globals.path') }}/plugins/slick/slick.min.js"></script>
<!-- masonry -->
<script src="{{ config('globals.path') }}/plugins/masonry/masonry.js"></script>
<!-- instafeed -->
<script src="{{ config('globals.path') }}/plugins/instafeed/instafeed.min.js"></script>
<!-- smooth scroll -->
<script src="{{ config('globals.path') }}/plugins/smooth-scroll/smooth-scroll.js"></script>
<!-- headroom -->
<script src="{{ config('globals.path') }}/plugins/headroom/headroom.js"></script>
<!-- reading time -->
<script src="{{ config('globals.path') }}/plugins/reading-time/readingTime.min.js"></script>

<!-- Datetime picker time -->
<script src="{{ config('globals.path') }}/plugins/datetime-picker/jquery.datetimepicker.full.min.js"></script>

<!-- Numeric validation -->
<script src="{{ config('globals.path') }}/plugins/numeric-validation/jquery.numeric.min.js"></script>

<!-- Magnific Popup -->
<script src="{{ config('globals.path') }}/plugins/magnific-popup/jquery.magnific-popup.min.js"></script>

<!-- IPhone Checkbox -->
<script src="{{ config('globals.path') }}/plugins/iphone-checkbox/Sswitch.js"></script>

<!-- International Phone Number -->
<script src="{{ config('globals.path') }}/plugins/intltel/js/intlTelInput.min.js"></script>

<!-- Ck editor -->
<script src="https://cdn.ckeditor.com/4.12.1/full/ckeditor.js"></script>

<!-- Main Script -->
<script src="{{ config('globals.path') }}/js/script.js"></script>

@include('layouts.customJs')
@stack('modals-here')
@stack('more-js')
