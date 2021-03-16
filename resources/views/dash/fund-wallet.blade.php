@extends('layouts.dash.main')
@section('title', 'Deposit - '.config('app.name'))
@section('fund-active', 'active')
@section('content')
{{-- @include('layouts.dash.wallet') --}}
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="page-header">
            <h2 class="pageheader-title">Deposit</h2>
            <p class="pageheader-text">Choose your payment method to make a deposit.</p>
            <hr>
        </div>
    </div>
</div>

    @include('layouts.dash.alerts')
<div class="row mb-5">
    <!-- ============================================================== -->
    <!-- USD  -->
    <!-- ============================================================== -->
    <div class="col-md-3">
        <div class="card border-3 border-top border-brand text-center">
            <div class="card-body">
                <img class="img-fluid" src="/home/img/payments/Bitcoin_logo.png" alt="pay With bitcoin payment">
                <a href="#" class="btn btn-warning btn-block text-white mt-5" data-toggle="modal" data-target="#payWithBitcoin">
                    Pay With Bitcoin
                </a>
                <div class="modal fade" id="payWithBitcoin" tabindex="-1" role="dialog" aria-labelledby="payWithBitcoinLabel" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <img class="img-fluid" src="/home/img/payments/Bitcoin_logo.png" alt="pay With bitcoin payment">
                                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </a>
                            </div>
                            <div class="modal-body">
                                <p>
                                    Payment through means of bitcoin should be carried out by sending from your bitcoin wallet or machine to the bitcoin address / QR Code below: <br>
                                    <br>
                                    <img class="img-fluid" src="{{ asset('images/wallet-barcode.jpeg') }}" width="150px">
                                    <h3 id="address">19ENgKgeGY2jWu7JFSL85am13MB1PA419L</h3>
                                    <br>
                                    <button class="btn btn-primary" onclick="copyAddress();">Click to Copy Address</button>
                                    <br><br>
                                    Send a screenshot or evidence of payment to this email address: <a href="mailto:{{ config('mail.from.address') }}" class="text-secondary">{{ config('mail.from.address') }}</a> for instant confirmation.
                                    <br><br>
                                    Your wallet will be credited once your payment is fully confirmed.
                                </p>
                            </div>
                            <div class="modal-footer">
                                <a href="#" class="btn btn-secondary" data-dismiss="modal">Close</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- end USD  -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- new customer  -->
    <!-- ============================================================== -->
    <div class="col-md-3">
        <div class="card border-3 border-top border-top-primary text-center">
            <div class="card-body">
                <img class="img-fluid" src="/home/img/payments/PayPal_logo.svg.png" alt="pay With paypal">
                <a href="#" class="btn btn-primary btn-block text-white mt-5" data-toggle="modal" data-target="#payWithPaypal">
                    Pay With Paypal
                </a>
                <div class="modal fade" id="payWithPaypal" tabindex="-1" role="dialog" aria-labelledby="payWithPaypalLabel" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <img class="img-fluid" src="/home/img/payments/PayPal_logo.svg.png" alt="pay With bitcoin payment">
                                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </a>
                            </div>
                            <div class="modal-body">
                                <p>If you wish to fund your {{ @config('app.name') }} account via this method, please contact our Live Chat agent to receive the appropriate payment details or send a support ticket or Mail. Alternatively, you can contact your Account Manager to help you fund your account. Thanks for choosing {{ @config('app.name') }}..</p>
                                <a href="mailto:{{ config('mail.from.address') }}" class="btn btn-primary btn-block"><i class="fa fa-envelope" aria-hidden="true"></i> Send a Support Ticket</a> <strong>- OR -</strong> <a href="javascript:void(Tawk_API.toggle())" class="btn btn-danger btn-block"><i class="fa fa-comments" aria-hidden="true"></i> Chat With Us</a>
                            </div>
                            <div class="modal-footer">
                                <a href="#" class="btn btn-secondary" data-dismiss="modal">Close</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- end new customer  -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- visitor  -->
    <!-- ============================================================== -->
    <div class="col-md-3">
        <div class="card border-3 border-top border-secondary text-center">
            <div class="card-body">
                <img class="img-fluid" src="/home/img/payments/Skrill_logo.svg.png" alt="pay With paypal">
                <a href="#" class="btn btn-secondary btn-block text-white mt-2" data-toggle="modal" data-target="#payWithSkrill">
                    Pay With Skrill
                </a>
                <div class="modal fade" id="payWithSkrill" tabindex="-1" role="dialog" aria-labelledby="payWithSkrillLabel" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <img class="img-fluid" src="/home/img/payments/Skrill_logo.svg.png" alt="pay With skrill">
                                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </a>
                            </div>
                            <div class="modal-body">
                                <p>If you wish to fund your {{ @config('app.name') }} account via this method, please contact our Live Chat agent to receive the appropriate payment details or send a support ticket or Mail. Alternatively, you can contact your Account Manager to help you fund your account. Thanks for choosing {{ @config('app.name') }}..</p>
                                <a href="mailto:{{ config('mail.from.address') }}" class="btn btn-primary btn-block"><i class="fa fa-envelope" aria-hidden="true"></i> Send a Support Ticket</a> <strong>- OR -</strong> <a href="javascript:void(Tawk_API.toggle())" class="btn btn-danger btn-block"><i class="fa fa-comments" aria-hidden="true"></i> Chat With Us</a>
                            </div>
                            <div class="modal-footer">
                                <a href="#" class="btn btn-secondary" data-dismiss="modal">Close</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card border-3 border-top border-top-dark text-center">
            <div class="card-body">
                <img class="img-fluid" src="/home/img/payments/visa-mastercard.png" alt="pay With Card">
                <a href="#" class="btn btn-dark btn-block text-white mt-3" data-toggle="modal" data-target="#payWithCard">
                    Pay With Card
                </a>
                <div class="modal fade" id="payWithCard" tabindex="-1" role="dialog" aria-labelledby="payWithCardLabel" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <img class="img-fluid" src="/home/img/payments/visa-mastercard.png" alt="pay with card">
                                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </a>
                            </div>
                            <div class="modal-body">
                                <p>If you wish to fund your {{ @config('app.name') }} account via this method, please contact our Live Chat agent to receive the appropriate payment details or send a support ticket or Mail. Alternatively, you can contact your Account Manager to help you fund your account. Thanks for choosing {{ @config('app.name') }}..</p>
                                <a href="mailto:{{ config('mail.from.address') }}" class="btn btn-primary btn-block"><i class="fa fa-envelope" aria-hidden="true"></i> Send a Support Ticket</a> <strong>- OR -</strong> <a href="javascript:void(Tawk_API.toggle())" class="btn btn-danger btn-block"><i class="fa fa-comments" aria-hidden="true"></i> Chat With Us</a>
                            </div>
                            <div class="modal-footer">
                                <a href="#" class="btn btn-secondary" data-dismiss="modal">Close</a>
                            </div>
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
function copyAddress() {
    /* Get the text field */
    var copyText = document.getElementById("address");

    /* Select the text field */
    selectText("address")
    // copyText.setSelectionRange(0, 99999); /*For mobile devices*/

    /* Copy the text inside the text field */
    document.execCommand("copy");

    /* Alert the copied text */
    alert("Copied the text: " + copyText.innerHTML);
}

function selectText(containerid) {
    if (document.selection) { // IE
        var range = document.body.createTextRange();
        range.moveToElementText(document.getElementById(containerid));
        range.select();
    } else if (window.getSelection) {
        var range = document.createRange();
        range.selectNode(document.getElementById(containerid));
        window.getSelection().removeAllRanges();
        window.getSelection().addRange(range);
    }
}
</script>
@endsection
