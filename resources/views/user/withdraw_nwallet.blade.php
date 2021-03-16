@extends('layouts.user.main')
@section('title', 'Transfer Money - '.config('app.name'))
@section('page-title', 'Transfer Money')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('user.home') }}">Home</a></li>
	<li class="breadcrumb-item active" aria-current="page">@yield('page-title')</li>
@endsection
@section('content')
  <div class="row">
    <div class="col-md-6">
      <form action="{{ route('user.transfer') }}" method="POST" class="row">
            @csrf
          <div class="col-lg-12">
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
          {{-- <div class="col-lg-12">
            <div class="alert alert-warning">
              <ul>
                <li><strong>*</strong> The minimum withdraw amount is &#8358;{{ (integer)$withdraw_spec->min_amt }}</li>
                <li><strong>*</strong> You can only withdraw &#8358;{{ (integer)$withdraw_spec->max_amt }} at a time</li>
                <li><strong>*</strong> Withdraw charge is &#8358;{{ (integer)$withdraw_spec->charge }}</li>
                <li><a class="alert-link" href="{{ route('user.add_money') }}">Add Money >></a></li>
              </ul>
            </div>
          </div> --}}
          <div class="col-lg-12">
            <input type="text" class="form-control mb-4" name="amount" id="positive-integer" placeholder="Amount" value="{{ old('amount') }}" autofocus required>
          </div>
          <div class="col-lg-12">
            <input type="text" class="form-control mb-4" name="acc_name" id="acc_name" placeholder="Account Name" value="{{ old('acc_name') }}" autofocus autocomplete="false" required>
          </div>
          <div class="col-lg-12">
            <input type="text" class="form-control mb-4" name="bank" id="bank" placeholder="Bank Name" value="{{ old('bank') }}" autofocus autocomplete="false" required>
          </div>
          <div class="col-lg-12">
            <input type="text" class="form-control num mb-4" name="acc_no" placeholder="Account Number" value="{{ old('acc_no') }}" maxlength="10" autofocus autocomplete="false" required>
          </div>
          <div class="col-md-6">
            <select class="form-control mb-4" id="acc_type" name="acc_type" required>
                <option value="" selected disabled>Account Type</option>
                <option value="dollars" @if(old('acc_type') === 'euros') selected @endif>USD ($)</option>
                <option value="pounds" @if(old('acc_type') === 'pounds') selected @endif>GBP (E)</option>
                <option value="euros" @if(old('acc_type') === 'euros') selected @endif>EUR (E)</option>
                <option value="others" @if(old('acc_type') === 'others') selected @endif>Others</option>
            </select>
          </div>
          <div class="col-md-6">
            <select class="form-control mb-4" id="transfer_type" name="transfer_type" required>
                <option value="" selected disabled>Transfer Type:</option>
                <option value="local" @if(old('transfer_type') === 'local') selected @endif>Local Transfer</option>
                <option value="international" @if(old('transfer_type') === 'international') selected @endif>International Transfer</option>
            </select>
          </div>
          <div class="col-lg-12">
            <input type="text" class="form-control mb-4" name="iban_no" id="iban_no" placeholder="Iban Number" value="{{ old('iban_no') }}">
          </div>
          <div class="col-lg-12">
            <input type="text" class="form-control mb-4" name="address" id="address" placeholder="Address" value="{{ old('address') }}">
          </div>
          <div class="col-lg-12">
            <input type="text" class="form-control mb-4" name="swift_code" id="swift_code" placeholder="Swift Code" value="{{ old('swift_code') }}">
          </div>
          <div class="col-lg-12">
            <input type="password" class="form-control mb-4" name="password" id="password" placeholder="Confirm Password" autofocus required>
          </div>
          <div class="col-lg-12">
            <input type="password" class="form-control mb-4" name="transaction_pin" id="transaction_pin" maxlength="4" placeholder="Enter your 4-digit transaction pin" autofocus required>
          </div>
          <div class="col-lg-6">
            <input type="text" class="form-control mb-4 num" name="otp" id="otp" placeholder="Type in OTP" autofocus required>
          </div>
          <div class="col-lg-6"><button type="button" class="btn btn-success" style="color: white" id="generate-otp">Generate OTP</button></div>
          <div class="col-12 mb-4">
            <button class="btn btn-primary">{{ __('Submit') }}</button>
          </div>
          @if($errors->any())
            <div class="col-lg-12">
              <div class="alert alert-danger">
                <ul>
                  @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
            </div>
          @endif
        </form>
    </div>
    <div class="col-md-6">
      {{-- <a class="btn btn-primary mb-4" href="{{ route('user.withdraw_money.history') }}">Go to Transfer History</a> --}}
      <div id="accordion">
        <div class="card">
          <div class="card-header">
            <a class="card-link" data-toggle="collapse" href="#togglePending">
              Recent Pending Transfers
            </a>
          </div>
          <div id="togglePending" class="collapse hide" data-parent="#accordion">
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>Reference No.</th>
                      <th>Amount</th>
                      <th>Charge</th>
                      <th>Account Name</th>
                      <th>Bank</th>
                      <th>Account No.</th>
                      <th>Account Type</th>
                      <th>Date Sent</th>
                      <th>Expiry Date</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($withdraw_pendings as $withdraw_pending)
                      <form action="{{ route('user.withdraw_money.cancel', $withdraw_pending->id) }}" method="POST">
                          @csrf
                        <tr>
                          <td>{{ strtoupper(substr($withdraw_pending->reference_no->reference_no, 0, 12)) }}</td>
                          <td>{{ $withdraw_pending->amount }}</td>
                          <td>{{ $withdraw_pending->charge }}</td>
                          <td>{{ $withdraw_pending->acc_name }}</td>
                          <td>{{ $withdraw_pending->bank_name }}</td>
                          <td>{{ $withdraw_pending->acc_no }}</td>
                          <td>{{ $withdraw_pending->acc_type }}</td>
                          <td>{{ $withdraw_pending->created_at->toFormattedDateString() }}</td>
                          <td>{{ $withdraw_pending->expire_at->toFormattedDateString() }}</td>
                          <td><div class="orange-text"><i>{{ $withdraw_pending->service_stat->name }}</i></div></td>
                          <td><button class="btn btn-primary">Cancel</button></td>
                        </tr>
                      </form>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>

        <div class="card">
          <div class="card-header">
            <a class="collapsed card-link" data-toggle="collapse" href="#toggleFailed">
              Recent Failed Transfer Requests
            </a>
          </div>
          <div id="toggleFailed" class="collapse" data-parent="#accordion">
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>Reference No.</th>
                      <th>Amount</th>
                      <th>Charge</th>
                      <th>Account Name</th>
                      <th>Bank</th>
                      <th>Account No.</th>
                      <th>Account Type</th>
                      <th>Date Sent</th>
                      <th>Expiry Date</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($withdraw_faileds as $withdraw_failed)
                      <tr>
                        <td>{{ strtoupper(substr($withdraw_failed->reference_no->reference_no, 0, 12)) }}</td>
                        <td>{{ $withdraw_failed->amount }}</td>
                        <td>{{ $withdraw_failed->charge }}</td>
                        <td>{{ $withdraw_failed->acc_name }}</td>
                        <td>{{ $withdraw_failed->bank_name }}</td>
                        <td>{{ $withdraw_failed->acc_no }}</td>
                        <td>{{ $withdraw_failed->acc_type }}</td>
                        <td>{{ $withdraw_failed->created_at->toFormattedDateString() }}</td>
                        <td>{{ $withdraw_failed->expire_at->toFormattedDateString() }}</td>
                        <td><div class="red-text"><i>{{ $withdraw_failed->service_stat->name }}</i></div></td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>

        <div class="card">
          <div class="card-header">
            <a class="collapsed card-link" data-toggle="collapse" href="#toggleSuccess">
              Recent Successful Transfer Requests
            </a>
          </div>
          <div id="toggleSuccess" class="collapse" data-parent="#accordion">
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>Reference No.</th>
                      <th>Amount</th>
                      <th>Charge</th>
                      <th>Account Name</th>
                      <th>Bank</th>
                      <th>Account No.</th>
                      <th>Account Type</th>
                      <th>Date Sent</th>
                      <th>Expiry Date</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($withdraw_successes as $withdraw_success)
                      <tr>
                        <td>{{ strtoupper(substr($withdraw_success->reference_no->reference_no, 0, 12)) }}</td>
                        <td>{{ $withdraw_success->amount }}</td>
                        <td>{{ $withdraw_success->charge }}</td>
                        <td>{{ $withdraw_success->acc_name }}</td>
                        <td>{{ $withdraw_success->bank_name }}</td>
                        <td>{{ $withdraw_success->acc_no }}</td>
                        <td>{{ $withdraw_success->acc_type }}</td>
                        <td>{{ $withdraw_success->created_at->toFormattedDateString() }}</td>
                        <td>{{ $withdraw_success->expire_at->toFormattedDateString() }}</td>
                        <td><div class="green-text"><i>{{ $withdraw_success->service_stat->name }}</i></div></td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
@section('input-js')
<script>
    var type = $('#transfer_type').val()
    if(type == 'international') {
        $('#iban_no').show()
        $('#swift_code').show()
        $('#address').show()
    } else {
        $('#iban_no').hide()
        $('#swift_code').hide()
        $('#address').hide()
    }

    $('#transfer_type').change(function() {
        var type = $('#transfer_type').val()
        if(type == 'local') {
            $('#iban_no').hide()
            $('#swift_code').hide()
            $('#address').hide()
        } else {
            $('#iban_no').show()
            $('#swift_code').show()
            $('#address').show()
        }
    })
    $('#generate-otp').click(function() {
        $('#generate-otp').prop('disabled',true);
        $('#generate-otp').prop('class','btn btn-warning');
        $('#generate-otp').html("Generating...");
        $.ajax({
            type: "POST",
            data: {
                "_token": "{{ csrf_token() }}",
                "user_id": {{ $user->id }},
                "user_otp": true
            },
            url: '{{ route('suser.otps.generate') }}',
            success: function(msg){
                $("#otp-status").fadeOut(200, function(){
                        // form.html(msg).fadeIn().delay(2000);
                        $("#otp-status").hide().load(location.href + " #otp-status *").fadeIn().delay(200);
                }).hide()
                alert('OTP generated successfully and sent to you. Please check your email.')
                $('#generate-otp').prop('disabled',false);
                $('#generate-otp').prop('class','btn btn-success');
                $('#generate-otp').html("Generate OTP");
            },
            error: function(event) {
                event.responseText ? alert(event.responseText): alert('Something went wrong. Please try again!')
                $('#generate-otp').prop('disabled',false);
                $('#generate-otp').prop('class','btn btn-success');
                $('#generate-otp').html("Generate OTP");
            }
        });
    })
</script>
@endsection
