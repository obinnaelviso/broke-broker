@extends('layouts.dash.main')
@section('title', 'Manage Investments - '.config('app.name'))
@section('manage-investment-active', 'active')
@section('content')
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="page-header">
            <h2 class="pageheader-title">Manage Investment</h2>
            <p class="pageheader-text">On this dashboard you'll see your active/running investments and completed investments.</p>
            <hr>
        </div>
    </div>
</div>

@include('layouts.dash.alerts')

<div class="row mb-3">
    <div class="col-md-12">
        <div class="card">
            <h3 class="card-header">Active Investments</h3>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Title</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Profit per Cycle</th>
                                <th scope="col">Duration</th>
                                <th scope="col">Completed Cycles</th>
                                <th scope="col">Start Date</th>
                                <th scope="col">End Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($active_investments as $investment)
                                @php
                                    $profit_per_cycle = ($investment->amount * $investment->plan->percentage)/100;
                                @endphp
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $investment->plan->title }}</td>
                                    <td>${{  $investment->amount  }}</td>
                                    <td class="text-success">${{ $profit_per_cycle }}+</td>
                                    <td>{{ $investment->plan->duration }}</td>
                                    <td>{{ $investment->completed_cycles.'/'.$investment->plan->cycles }}</td>
                                    <td>{{ $investment->created_at->toFormattedDateString() }}</td>
                                    <td>{{ $investment->expire_at->toFormattedDateString() }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $active_investments->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
