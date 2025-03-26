
	@include('layouts.admin.com_header')

	<body>

		<!-- Loading starts -->
		<div id="loading-wrapper">
			<div class="spinner-border" role="status">
				<span class="sr-only">Loading...</span>
			</div>
		</div>
		<!-- Loading ends -->


		<!-- Page wrapper start -->
		<div class="page-wrapper pinned">
			
			<!-- Sidebar wrapper start -->
			@include('layouts.admin.com_sidebar')
			<!-- Sidebar wrapper end -->

			<!-- Page content start  -->
			<div class="page-content">

				<!-- Header start -->

				@include('layouts.admin.top_header')
				
				<!-- Header end -->
				
				<!-- Main container start -->
				<div class="main-container product-body">
					@yield('content')
					@include('layouts.admin.toaster')
				</div>
				<!-- Main container end -->

			</div>
			<!-- Page content end -->

		</div>
		<!-- Page wrapper end -->

		@include('layouts.admin.com_js')
		@stack('scripts')
	</body>
</html>