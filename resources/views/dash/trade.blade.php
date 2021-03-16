@extends('layouts.dash.main')
@section('title', 'Trading Dashboard - '.config('app.name'))
@section('trade-active', 'active')
@section('content')

@include('layouts.dash.wallet')

<div class="row mb-5">
    @if($wallet->amount < 2000)
        @section('input-js')
            <script>
                $('#tradingInfo').modal();
            </script>
        @endsection
        <div class="modal fade" style="margin-top: 50px" id="tradingInfo" tabindex="-1" role="dialog" aria-labelledby="tradingInfoLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog" role="document">
                <div class="modal-content" style="background-color: black;">
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
    <div class="col-md-12">
        <!-- TradingView Widget BEGIN -->
<div class="tradingview-widget-container" style="margin-left: -28px">
    <div id="tradingview_b5841"></div>
    <div class="tradingview-widget-copyright"><a href="https://www.tradingview.com/symbols/USDEUR/?exchange=FX_IDC" rel="noopener" target="_blank"><span class="blue-text">USDEUR Chart</span></a> by TradingView</div>
    <script type="text/javascript" src="https://s3.tradingview.com/tv.js"></script>
    <script type="text/javascript">
            new TradingView.widget(
            {
            "width": 1085,
            "height": 610,
            "symbol": "FX_IDC:USDEUR",
            "interval": "D",
            "timezone": "America/Chicago",
            "theme": "dark",
            "style": "1",
            "locale": "en",
            "toolbar_bg": "#f1f3f6",
            "enable_publishing": false,
            "allow_symbol_change": true,
            "show_popup_button": true,
            "popup_width": "1000",
            "popup_height": "650",
            "container_id": "tradingview_b5841"
        }
            );
    </script>
  </div>
    </div>
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
