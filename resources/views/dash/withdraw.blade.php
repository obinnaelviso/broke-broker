@extends('layouts.dash.main')
@section('title', 'Withdraw Funds - '.config('app.name'))
@section('withdraw-active', 'active')
@section('content')
@include('layouts.dash.wallet')
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="page-header">
            <h2 class="pageheader-title">Withdraw Funds</h2>
            <p class="pageheader-text">Fill in your account details and your withdrawal will be processed in less than an hour</p>
            <hr>
        </div>
    </div>
</div>


<div class="row mb-5">
    <div class="col-md-4 col-sm-6 col-6">
        @include('layouts.dash.alerts')
        <img class="img-fluid" src="/home/img/payments/Bitcoin_logo.png" alt="withdraw to bitcoin address" height="100px">
        <a href="#" class="btn btn-warning btn-block text-white mt-5" data-toggle="modal" data-target="#withdrawWithBitcoin">
            Withdraw to Bitcoin Address
        </a>
        <div class="modal fade" id="withdrawWithBitcoin" tabindex="-1" role="dialog" aria-labelledby="withdrawWithBitcoinLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        Withdraw to Bitcoin Address
                        <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </a>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('user.withdraw') }}" method="POST" class="row">
                            @csrf
                            <div class="col-lg-12 mb-3">
                                <label for="amount" class="col-form-label">Withdraw Amount</label>
                                <input id="amount" type="text" name="amount" class="form-control" placeholder="0.00" value="{{ old('amount') }}">
                            </div>
                            <div class="col-lg-12 mb-3">
                                <input type="hidden" name="has_bitcoin" value="1">
                                <label for="amount" class="col-form-label">Bitcoin Address</label>
                                <input type="text" name="bitcoin_address" class="form-control" placeholder="e.g 13jjhWpsejQzuUFKxEffYSLifiLl11zmvpZ3E" value="{{ old('bitcoin_address') }}">
                            </div>
                            <div class="col-lg-12 mb-3">
                                <label for="password">Password</label>
                                <input type="password" class="form-control mb-4" name="password" id="password" placeholder="Confirm Password">
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
                            <div class="col-lg-12">
                                <button class="btn btn-primary">{{ __('Submit') }}</button>
                            </div>
                        </form>

                    </div>
                    <div class="modal-footer">
                        <a href="#" class="btn btn-secondary" data-dismiss="modal">Close</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 offset-md-4 col-sm-6 col-6">
        <img class="img-fluid" src="/home/img/payments/bank-transfer.png" width="200px" alt="withdraw with bank transfer">
        <a href="#" class="btn btn-primary btn-block mt-2" data-toggle="modal" data-target="#withdrawToBank">
            Wire Directly To Bank Account
        </a>
        <div class="modal fade" id="withdrawToBank" tabindex="-1" role="dialog" aria-labelledby="withdrawToBankLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        Wire Directly To Bank account
                        <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </a>
                    </div>
                    <div class="modal-body">
                    <form action="{{ route('user.withdraw') }}" method="POST" class="row">
                        @csrf
                        @include('layouts.dash.alerts')
                        <div class="col-lg-12">
                            <label for="amount" class="col-form-label">Withdraw Amount</label>
                            <input type="text" class="form-control mb-4" name="amount" id="positive-integer" placeholder="0.00" value="{{ old('amount') }}" autofocus required>
                          </div>
                          <div class="col-lg-12">
                            <label for="amount" class="col-form-label">Account Name</label>
                            <input type="text" class="form-control mb-4" name="acc_name" id="acc_name" placeholder="Account Name" value="{{ old('acc_name') }}" autocomplete="false" required>
                          </div>
                          <div class="col-lg-12">
                            <label for="amount" class="col-form-label">Bank Name</label>
                            <input type="text" class="form-control mb-4" name="bank" id="bank" placeholder="Bank Name" value="{{ old('bank') }}" autocomplete="false" required>
                          </div>
                          <div class="col-lg-12">
                            <label for="amount" class="col-form-label">Account Number</label>
                            <input type="text" class="form-control num mb-4" name="acc_no" placeholder="Account Number" value="{{ old('acc_no') }}" maxlength="10" autocomplete="false" required>
                          </div>
                          <div class="col-lg-12">
                            <label for="amount" class="col-form-label">Withdrawal Type</label>
                            <select class="form-control mb-4" id="transfer_type" name="transfer_type" required>
                                <option value="" selected disabled>Withdrawal Type:</option>
                                <option value="local" @if(old('transfer_type') === 'local') selected @endif>Local</option>
                                <option value="international" @if(old('transfer_type') === 'international') selected @endif>International</option>
                            </select>
                          </div>
                          <div class="col-lg-12">
                            <label for="amount" id="iban_no_lbl" class="col-form-label">Iban Number</label>
                            <input type="text" class="form-control mb-4" name="iban_no" id="iban_no" placeholder="Iban Number" value="{{ old('iban_no') }}">
                          </div>
                          <div class="col-lg-12">
                            <label for="amount" id="address_lbl" class="col-form-label">Address</label>
                            <input type="text" class="form-control mb-4" name="address" id="address" placeholder="Address" value="{{ old('address') }}">
                          </div>
                          <div class="col-lg-12">
                            <label for="amount" id="swift_code_lbl" class="col-form-label">Bank Swift Code</label>
                            <input type="text" class="form-control mb-4" name="swift_code" id="swift_code" placeholder="Swift Code" value="{{ old('swift_code') }}">
                          </div>
                          <div class="col-lg-12">
                            <label for="amount" class="col-form-label">Confirm Password</label>
                            <input type="password" class="form-control mb-4" name="password" id="password" placeholder="Confirm Password" required>
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
                        <div class="col-lg-12">
                            <button class="btn btn-primary">{{ __('Submit') }}</button>
                        </div>
                    </form>

                    </div>
                    <div class="modal-footer">
                        <a href="#" class="btn btn-secondary" data-dismiss="modal">Close</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- <div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="simple-card">
            <ul class="nav nav-tabs" id="myTab5" role="tablist">
                <li class="nav-item">
                    <a class="nav-link border-left-0 active show" id="home-tab-simple" data-toggle="tab" href="#bitcoin-withdrawal" role="tab" aria-controls="home" aria-selected="true">Withdraw Bitcoin <i class="fab fa-bitcoin    "></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="profile-tab-simple" data-toggle="tab" href="#wallet-withdraw" role="tab" aria-controls="profile" aria-selected="false">Withdraw Wallet $</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent5">
                <div class="tab-pane fade active show" id="bitcoin-withdrawal" role="tabpanel" aria-labelledby="home-tab-simple">
                    <form action="{{ route('user.withdraw') }}" method="POST" class="row">
                        @csrf
                        @include('layouts.dash.alerts')
                        <div class="col-lg-12 mb-3">
                            <label for="amount" class="col-form-label">Withdraw Amount</label>
                            <input id="amount" type="text" name="amount" class="form-control" placeholder="0.00" value="{{ old('amount') }}">
                        </div>
                        <div class="col-lg-12 mb-3">
                            <input type="hidden" name="has_bitcoin" value="1">
                            <label for="amount" class="col-form-label">Bitcoin Address</label>
                            <input type="text" name="bitcoin_address" class="form-control" placeholder="e.g 13jjhWpsejQzuUFKxEffYSLifiLl11zmvpZ3E" value="{{ old('bitcoin_address') }}">
                        </div>
                        <div class="col-lg-12 mb-3">
                            <label for="password">Password</label>
                            <input type="password" class="form-control mb-4" name="password" id="password" placeholder="Confirm Password">
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
                        <button class="btn btn-primary">{{ __('Submit') }}</button>
                    </form>
                </div>
                <div class="tab-pane fade" id="wallet-withdraw" role="tabpanel" aria-labelledby="profile-tab-simple">
                    <form action="{{ route('user.withdraw') }}" method="POST" class="row">
                        @csrf
                        @include('layouts.dash.alerts')
                        <div class="col-lg-12">
                            <label for="amount" class="col-form-label">Withdraw Amount</label>
                            <input type="text" class="form-control mb-4" name="amount" id="positive-integer" placeholder="0.00" value="{{ old('amount') }}" autofocus required>
                          </div>
                          <div class="col-lg-12">
                            <label for="amount" class="col-form-label">Account Name</label>
                            <input type="text" class="form-control mb-4" name="acc_name" id="acc_name" placeholder="Account Name" value="{{ old('acc_name') }}" autocomplete="false" required>
                          </div>
                          <div class="col-lg-12">
                            <label for="amount" class="col-form-label">Bank Name</label>
                            <input type="text" class="form-control mb-4" name="bank" id="bank" placeholder="Bank Name" value="{{ old('bank') }}" autocomplete="false" required>
                          </div>
                          <div class="col-lg-12">
                            <label for="amount" class="col-form-label">Account Number</label>
                            <input type="text" class="form-control num mb-4" name="acc_no" placeholder="Account Number" value="{{ old('acc_no') }}" maxlength="10" autocomplete="false" required>
                          </div>
                          <div class="col-lg-12">
                            <label for="amount" class="col-form-label">Withdrawal Type</label>
                            <select class="form-control mb-4" id="transfer_type" name="transfer_type" required>
                                <option value="" selected disabled>Withdrawal Type:</option>
                                <option value="local" @if(old('transfer_type') === 'local') selected @endif>Local</option>
                                <option value="international" @if(old('transfer_type') === 'international') selected @endif>International</option>
                            </select>
                          </div>
                          <div class="col-lg-12">
                            <label for="amount" id="iban_no_lbl" class="col-form-label">Iban Number</label>
                            <input type="text" class="form-control mb-4" name="iban_no" id="iban_no" placeholder="Iban Number" value="{{ old('iban_no') }}">
                          </div>
                          <div class="col-lg-12">
                            <label for="amount" id="address_lbl" class="col-form-label">Address</label>
                            <input type="text" class="form-control mb-4" name="address" id="address" placeholder="Address" value="{{ old('address') }}">
                          </div>
                          <div class="col-lg-12">
                            <label for="amount" id="swift_code_lbl" class="col-form-label">Bank Swift Code</label>
                            <input type="text" class="form-control mb-4" name="swift_code" id="swift_code" placeholder="Swift Code" value="{{ old('swift_code') }}">
                          </div>
                          <div class="col-lg-12">
                            <label for="amount" class="col-form-label">Confirm Password</label>
                            <input type="password" class="form-control mb-4" name="password" id="password" placeholder="Confirm Password" required>
                          </div>
                           <div class="col-lg-12">
                            <input type="password" class="form-control mb-4" name="transaction_pin" id="transaction_pin" maxlength="4" placeholder="Enter your 4-digit transaction pin" required>
                          </div>
                          <div class="col-lg-6">
                            <input type="text" class="form-control mb-4 num" name="otp" id="otp" placeholder="Type in OTP" required>
                          </div>
                          <div class="col-lg-6"><button type="button" class="btn btn-success" style="color: white" id="generate-otp">Generate OTP</button></div>
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
                        <button class="btn btn-primary">{{ __('Submit') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}

{{-- <div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="page-header">
            <h2 class="pageheader-title">Live Crypto/Currency Converter</h2>
            {{-- <p class="pageheader-text">Get to manage all your wallets in one place</p> --}}
            <hr>
        </div>
    </div>
</div> --}}

{{-- <div class="row mb-5">
    <div class="col-md-6">
        <div class="row"> --}}
            {{-- BTCUSD --}}
            {{-- <div class="col-12 mb-3"><div style="width: 400px; height:220px; background-color: #1D2330; overflow:hidden; box-sizing: border-box; border: 1px solid #282E3B; border-radius: 4px; text-align: right; line-height:14px; block-size:220px; font-size: 12px; font-feature-settings: normal; text-size-adjust: 100%; box-shadow: inset 0 -20px 0 0 #262B38;padding:1px;padding: 0px; margin: 0px;"><div style="height:200px; padding:0px; margin:0px; width: 100%;"><iframe src="https://widget.coinlib.io/widget?type=single_v2&theme=dark&coin_id=859&pref_coin_id=1505" width="400" height="196px" scrolling="auto" marginwidth="0" marginheight="0" frameborder="0" border="0" style="border:0;margin:0;padding:0;line-height:14px;"></iframe></div><div style="color: #626B7F; line-height: 14px; font-weight: 400; font-size: 11px; box-sizing: border-box; padding: 2px 6px; width: 100%; font-family: Verdana, Tahoma, Arial, sans-serif;"><a href="https://coinlib.io" target="_blank" style="font-weight: 500; color: #626B7F; text-decoration:none; font-size:11px">Cryptocurrency Prices</a>&nbsp;by Coinlib</div></div></div> --}}
            {{-- USDBTC --}}
            {{-- <div class="col-12"><div style="width: 400px; height:220px; background-color: #1D2330; overflow:hidden; box-sizing: border-box; border: 1px solid #282E3B; border-radius: 4px; text-align: right; line-height:14px; block-size:220px; font-size: 12px; font-feature-settings: normal; text-size-adjust: 100%; box-shadow: inset 0 -20px 0 0 #262B38;padding:1px;padding: 0px; margin: 0px;"><div style="height:200px; padding:0px; margin:0px; width: 100%;"><iframe src="https://widget.coinlib.io/widget?type=single_v2&theme=dark&coin_id=1505&pref_coin_id=859" width="400" height="196px" scrolling="auto" marginwidth="0" marginheight="0" frameborder="0" border="0" style="border:0;margin:0;padding:0;line-height:14px;"></iframe></div><div style="color: #626B7F; line-height: 14px; font-weight: 400; font-size: 11px; box-sizing: border-box; padding: 2px 6px; width: 100%; font-family: Verdana, Tahoma, Arial, sans-serif;"><a href="https://coinlib.io" target="_blank" style="font-weight: 500; color: #626B7F; text-decoration:none; font-size:11px">Cryptocurrency Prices</a>&nbsp;by Coinlib</div></div></div> --}}
        {{-- </div>
    </div>
    <div class="col-md-6">
        <div style="width: 400px; height:335px; background-color: #232937; overflow:hidden; box-sizing: border-box; border: 1px solid #282E3B; border-radius: 4px; text-align: right; line-height:14px; block-size:335px; font-size: 12px; font-feature-settings: normal; text-size-adjust: 100%; box-shadow: inset 0 -20px 0 0 #262B38;margin: 0;width: 400px;padding:1px;padding: 0px; margin: 0px;"><div style="height:315px; padding:0px; margin:0px; width: 100%;"><iframe src="https://widget.coinlib.io/widget?type=converter&theme=dark" width="400" height="310px" scrolling="auto" marginwidth="0" marginheight="0" frameborder="0" border="0" style="border:0;margin:0;padding:0;"></iframe></div><div style="color: #626B7F; line-height: 14px; font-weight: 400; font-size: 11px; box-sizing: border-box; padding: 2px 6px; width: 100%; font-family: Verdana, Tahoma, Arial, sans-serif;"><a href="https://coinlib.io" target="_blank" style="font-weight: 500; color: #626B7F; text-decoration:none; font-size:11px">Cryptocurrency Prices</a>&nbsp;by Coinlib</div></div>
    </div>
</div> --}}
@endsection
@section('input-js')

<!-- Numeric validation -->
<script src="/plugins/numeric-validation/jquery.numeric.min.js"></script>

<script type="text/javascript">
	$(".num").numeric({ decimal: false, negative: false }, function() { alert("Positive integers only"); this.value = ""; this.focus(); });
	$("#positive-integer").numeric({ decimal: false, negative: false }, function() { alert("Positive integers only"); this.value = ""; this.focus(); });
</script>
<script>
    var type = $('#transfer_type').val()
    if(type == 'international') {
        $('#iban_no').show()
        $('#iban_no_lbl').show()
        $('#swift_code').show()
        $('#swift_code_lbl').show()
        $('#address').show()
        $('#address_lbl').show()
    } else {
        $('#iban_no').hide()
        $('#iban_no_lbl').hide()
        $('#swift_code').hide()
        $('#swift_code_lbl').hide()
        $('#address').hide()
        $('#address_lbl').hide()
    }

    $('#transfer_type').change(function() {
        var type = $('#transfer_type').val()
        if(type == 'local') {
            $('#iban_no').hide()
            $('#iban_no_lbl').hide()
            $('#swift_code').hide()
            $('#swift_code_lbl').hide()
            $('#address').hide()
            $('#address_lbl').hide()
        } else {
            $('#iban_no').show()
            $('#iban_no_lbl').show()
            $('#swift_code').show()
            $('#swift_code_lbl').show()
            $('#address').show()
            $('#address_lbl').show()
        }
    })
</script>
@endsection
