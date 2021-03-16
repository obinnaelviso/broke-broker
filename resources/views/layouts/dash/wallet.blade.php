<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="page-header">
            <h2 class="pageheader-title">Balance</h2>
            {{-- <p class="pageheader-text">Get to manage all your wallets in one place</p> --}}
            <hr>
        </div>
    </div>
</div>

<!-- ============================================================== -->
<!-- wallets  -->
<!-- ============================================================== -->
<div class="row mb-5">
    <!-- ============================================================== -->
    <!-- USD  -->
    <!-- ============================================================== -->
    <div class="col-md-6">
        <div class="card border-3 border-top border-top-primary">
            <div class="card-body">
                <h5 class="text-muted">USD</h5>
                <div class="metric-value d-inline-block">
                    <h1 class="mb-1">${{ $wallet->amount }}</h1>
                </div>
                <div class="metric-label d-inline-block float-right text-success font-weight-bold">
                    <span class="icon-circle-small icon-box-xs text-success bg-success-light"><i class="fa fa-fw fa-arrow-up"></i></span><span class="ml-1">15.86%</span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card border-3 border-top border-secondary">
            <div class="card-body">
            <h5 class="text-muted">INVESTED</h5>
                <div class="metric-value d-inline-block">
                    <h1 class="mb-1">${{ $wallet->bonus }}</h1>
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
    <div class="col-md-6">
        <div class="card border-3 border-top border-brand">
            <div class="card-body">
                <h5 class="text-muted">BTC VALUE</h5>
                <div class="metric-value d-inline-block">
                    <h1 class="mb-1"><i class="fab fa-bitcoin"></i> {{ $btc_value }}</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card border-3 border-top border-success bg-success">
            <div class="card-body">
                <h5 class="text-light">TOTAL LIVE TRADERS</h5>
                <div class="metric-value d-inline-block">
                    <h1 class="mb-1 text-light">{{ $total_live_traders->message_1 }}</h1>
                </div>
                <div class="metric-label d-inline-block float-right text-success font-weight-bold">
                    <span class="icon-circle-small icon-box-xs text-light bg-success-light"><i class="fa fa-fw fa-arrow-up"></i></span><span class="ml-1 text-light">288.10%</span>
                </div>
            </div>
        </div>
    </div>
</div>
