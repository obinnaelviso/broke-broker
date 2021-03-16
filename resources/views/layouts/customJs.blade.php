<script type="text/javascript">
	function query() {
		document.getElementById('query').submit();
    }
</script>
<script>
	$(document).ready(function(){
	  $('[data-toggle="tooltip"]').tooltip();
	});
</script>

{{-- <script>
    CKEDITOR.replace( 'editor' );
</script> --}}

<script type="text/javascript">
	$(".num").numeric({ decimal: false, negative: false }, function() { alert("Positive integers only"); this.value = ""; this.focus(); });
	$("#positive-integer").numeric({ decimal: false, negative: false }, function() { alert("Positive integers only"); this.value = ""; this.focus(); });
</script>
<script>
  var element = false;
  $(function () {
    $('#inline-popups').magnificPopup({
        type: 'inline',
        //delay removal by X to allow out-animation
        removalDelay: 500,
        callbacks: {
            beforeOpen: function () {
                this.st.image.markup = this.st.image.markup.replace('mfp-figure',
                    'mfp-figure mfp-with-anim');
                this.st.mainClass = this.st.el.attr('data-effect');
            }
        },
        closeOnContentClick: true,
    });
  });
</script>
@yield('input-js')
