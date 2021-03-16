<section class="section">
	<div class="container">
	  <div class="row">
	    <div class="col-12">
	      <h4>@yield('page-title')</h4><hr>
	      <nav aria-label="breadcrumb">
			  <ol class="breadcrumb">
			    @yield('breadcrumb')
			  </ol>
			</nav>
	    </div>
	  </div>
	  @yield('content')
	</div>
</section>