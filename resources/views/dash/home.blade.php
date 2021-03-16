@extends('layouts.dash.main')
@section('title', 'Dashboard Home - '.config('app.name'))
@section('home-active', 'active')
@section('content')

@include('layouts.dash.wallet')
@if($wallet->amount < 100)
        @section('input-js')
            <script>
                $('#tradingInfo').modal();
            </script>
        @endsection
        <div class="modal fade" style="margin-top: 50px" id="tradingInfo" tabindex="-1" role="dialog" aria-labelledby="tradingInfoLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog" role="document">
                <div class="modal-content" style="background-color: black; ">
                    <div class="modal-header text-white">
                        Insufficient Funds on Trading Account.
                        <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </a>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-warning" style="font-size: 16px">
                            Sorry, your trading dashboard is not active at the moment due to insufficient funds.<br>*<br>
                            You need a minimum of $500 in your account to activate your trading dashboard for the first time.<br>*<br>
                            So that you can start buying, selling and trading.
                            <br>*<br>
                            <a class="btn btn-danger" href="{{ route('user.fund_wallet') }}">Click on this link to make a deposit and start trading!</a>
                            <br>*<br>
                            In need of any help, you can talk to us on the live chat for further assistance. Thanks!
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="#" class="btn btn-secondary" data-dismiss="modal">Close</a>
                    </div>
                </div>
            </div>
        </div>

    @endif

    <div class="card">
        <h4 class="card-header">Recent Transactions </h4>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            @php $i = 1 @endphp
                            <th scope="col">#</th>
                            <th scope="col">Intial Deposit</th>
                            <th scope="col">Profit Made</th>
                            {{-- <th scope="col">Date</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($transactions as $transaction)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>${{ $transaction->amount }}</td>
                                <td class="text-success">${{ $transaction->prev_bal }}</td>
                                {{-- <td>{{ $transaction->created_at }}</td> --}}
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="page-header">
            <h2 class="pageheader-title">Live Forex Market Heat Rates</h2>
            {{-- <p class="pageheader-text">Get to manage all your wallets in one place</p> --}}
            <hr>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
<!-- TradingView Widget BEGIN -->
<div class="tradingview-widget-container" style="margin-left: -28px">
    <div class="tradingview-widget-container__widget"></div>
    <div class="tradingview-widget-copyright"><a href="https://www.tradingview.com/markets/currencies/forex-heat-map/" rel="noopener" target="_blank"><span class="blue-text">Forex Heat Map</span></a> by TradingView</div>
    <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-forex-heat-map.js" async>
    {
    "width": 1085,
    "height": 400,
    "currencies": [
      "EUR",
      "USD",
      "JPY",
      "GBP",
      "CHF",
      "AUD",
      "CAD",
      "NZD",
      "CNY"
    ],
    "isTransparent": false,
    "colorTheme": "dark",
    "locale": "en"
  }
    </script>
  </div>
  <!-- TradingView Widget END -->
    </div>
</div>

<!-- ============================================================== -->
<!-- end wallets  -->
<!-- ============================================================== -->
@endsection
