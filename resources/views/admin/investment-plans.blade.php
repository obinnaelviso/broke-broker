@extends('layouts.admin.main')
@section('title', 'Investment Plans')
@section('page-title', 'Investment Plans')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('suser.home') }}">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">@yield('page-title')</li>
@endsection
@section('content')
  <div class="row text-center">
  	<div class="col-12">
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
      <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#add_investment_plan">Add Investments</button>
      @push('modals-here')@include('admin.add_investment_plan')@endpush
      <div class="table-responsive">
        <table class="table table-bordered" id="my-investment-plans">
          <thead>
            <tr>
              <th>Title</th>
              <th>Minimum Amount</th>
              <th>Maximum Amount</th>
              <th>Duration</th>
              <th>Cycles</th>
              <th>Percentage</th>
              <th>Bonus</th>
              <th>Date</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach($investment_plans as $investment_plan)
              <tr>
                <td>{{ $investment_plan->title }}</td>
                <td>{{ $investment_plan->min_amount }}</td>
                <td>{{ $investment_plan->max_amount }}</td>
                <td>{{ $investment_plan->duration }}</td>
                <td>{{ $investment_plan->cycles }}</td>
                <td>{{ $investment_plan->percentage }}</td>
                <td>{{ $investment_plan->bonus }}</td>
                <td>{{ $investment_plan->created_at }}</td>
                <td>
                    <button
                        class="btn btn-primary"
                        data-toggle="modal"
                        data-target="#edit_investment_plan"
                        data-id="{{ $investment_plan->id }}"
                        data-title="{{ $investment_plan->title }}"
                        data-min-amount="{{ $investment_plan->min_amount }}"
                        data-max-amount="{{ $investment_plan->max_amount }}"
                        data-duration="{{ $investment_plan->duration }}"
                        data-cycles="{{ $investment_plan->cycles }}"
                        data-percentage="{{ $investment_plan->percentage }}"
                        data-bonus="{{ $investment_plan->bonus }}"
                    >Edit</button>
                    <br><button class="btn btn-danger" onclick="deleteInvestmentPlan('{{ $investment_plan->id }}')">Delete</button>
                </td>
                @push('modals-here')@include('admin.edit_investment_plan')@endpush
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection
@push('more-js')
<script>
function deleteInvestmentPlan(investment_id) {
    var alertDelete = confirm("Are you sure you want to delete?")
    if(alertDelete == true) {
        $.ajax({
            type: "DELETE",
            data: {
                "_token": "{{ csrf_token() }}",
            },
            url: "/suser/investments/plans/"+investment_id+"/delete",
            success: function(msg){
                $("#my-investment-plans").fadeOut(200, function(){
                        $("#my-investment-plans").hide().load(location.href + " #my-investment-plans").fadeIn().delay(200);
                }).hide()
            alert('Investment removed successfully!')
            }
        });
    }
}
$('#edit_investment_plan').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    var id = button.data('id');
    var title = button.data('title')
    var min_amount = button.data('min-amount')
    var max_amount = button.data('max-amount')
    var duration = button.data('duration')
    var cycles = button.data('cycles')
    var percentage = button.data('percentage')
    var bonus = button.data('bonus')
    // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
    // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
    var modal = $(this)
    modal.find('.modal-body #title').val(title)
    modal.find('.modal-body #min_amount').val(min_amount)
    modal.find('.modal-body #max_amount').val(max_amount)
    modal.find('.modal-body #cycles').val(cycles)
    modal.find('.modal-body #duration').val(duration)
    modal.find('.modal-body #percentage').val(percentage)
    modal.find('.modal-body #bonus').val(bonus)
    modal.find('.modal-content form').attr('action', `/suser/investments/plans/${id}/edit`)
})

$('#edit_investment_plan').on('hide.bs.modal', function (event) {
    var modal = $(this)
    modal.find('.modal-content form').attr('action', '');
});
</script>
@endpush
