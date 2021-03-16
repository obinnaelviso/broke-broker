@if(session()->has('success') || session()->has('failed'))
<div class="row">
    <div class="col-12">
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
</div>
@endif
