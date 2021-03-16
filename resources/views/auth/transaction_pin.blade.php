@section('title', 'Transaction Pin Verification!')
<!DOCTYPE html>
<html lang="zxx">

@include('layouts.head')

<body>
  <section class="section" style=" text-align: center; margin-top: 70px">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h2 class="mb-4 text-center">Transaction Pin Verification</h2>
            <div class="col-md-6" style="position: relative; margin: 0 auto; width: 450px;">
              <input type="text" class="form-control mb-4 num" name="transaction_pin" id="pin" placeholder="Enter Transaction Pin" autofocus>
            </div>
            <div class="col-12 mb-4">
              <button class="btn btn-primary" id="verify-pin">{{ __('Continue') }}</button>
            </div>
        </div>
      </div>
    </div>
  </section>

@include('layouts.footer')

@include('layouts.js')
<script>
$('#verify-pin').click(function() {
    var pin = $('#pin').val()
    $.ajax({
        type: "POST",
        data: {
            "_token": "{{ csrf_token() }}",
            "pin": pin
        },
        url: '{{ route('user.process.pin') }}',
        success: function(msg){
            window.location.href = '{{ route('user.home') }}'
        },
        error: function(msg) {
            alert(msg.responseText)
        }
    });
    })
</script>
</body>
</html>
