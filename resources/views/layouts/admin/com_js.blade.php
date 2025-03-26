		<!--**************************
			**************************
				**************************
							Required JavaScript Files
				**************************
			**************************
		**************************-->
        <script src="{{ URL::to('assets/admin/vendor/particles/particles.js') }}"></script>
        
        <script src="{{ URL::to('assets/admin/vendor/particles/app.js') }}"></script>

		<!-- Required jQuery first, then Bootstrap Bundle JS -->
        <script src="{{ URL::to('assets/admin/js/jquery.min.js') }}"></script>
        <script src="{{ URL::to('assets/admin/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ URL::to('assets/admin/js/moment.js') }}"></script>


		<!-- *************
			************ Vendor Js Files *************
		************* -->
		<!-- Slimscroll JS -->
        <script src="{{ URL::to('assets/admin/vendor/slimscroll/slimscroll.min.js') }}"></script>
        <script src="{{ URL::to('assets/admin/vendor/slimscroll/custom-scrollbar.js') }}"></script>

		<!-- Daterange -->
        <script src="{{ URL::to('assets/admin/vendor/daterange/daterange.js') }}"></script>
        <script src="{{ URL::to('assets/admin/vendor/daterange/custom-daterange.js') }}"></script>

		<!-- Polyfill JS -->
        <script src="{{ URL::to('assets/admin/vendor/polyfill/polyfill.min.js') }}"></script>

		<!-- Apex Charts -->
        <script src="{{ URL::to('assets/admin/vendor/apex/apexcharts.min.js') }}"></script>
        <script src="{{ URL::to('assets/admin/vendor/apex/admin/visitors.js') }}"></script>
        <script src="{{ URL::to('assets/admin/vendor/apex/admin/deals.js') }}"></script>
        <script src="{{ URL::to('assets/admin/vendor/apex/admin/income.js') }}"></script>
        <script src="{{ URL::to('assets/admin/vendor/apex/admin/customers.js') }}"></script>

		<!-- Datepickers -->
        <script src="{{ URL::to('assets/admin/vendor/datepicker/picker.js') }}"></script>
        <script src="{{ URL::to('assets/admin/vendor/datepicker/picker.date.js') }}"></script>
        <script src="{{ URL::to('assets/admin/vendor/datepicker/custom-picker.js') }}"></script>

		<!-- Steps wizard JS -->
        <script src="{{ URL::to('assets/admin/vendor/wizard/jquery.steps.min.js') }}"></script>
        <script src="{{ URL::to('assets/admin/vendor/wizard/jquery.steps.custom.js') }}"></script>

		<!-- Input Tags JS -->
        <script src="{{ URL::to('assets/admin/vendor/input-tags/tagsinput.min.js') }}"></script>
        <script src="{{ URL::to('assets/admin/vendor/input-tags/typeahead.js') }}"></script>
        <script src="{{ URL::to('assets/admin/vendor/input-tags/tagsinput-custom.js') }}"></script>

		<!-- Summernote JS -->
        <script src="{{ URL::to('assets/admin/vendor/summernote/summernote-bs4.js') }}"></script>
        <script src="{{ URL::to('assets/admin/vendor/toaster/toastr.min.js') }}"></script>
        <script src="{{ URL::to('assets/admin/vendor/swetalert/sweetalert2.min.js') }}"></script>
        <script src="{{ URL::to('assets/admin/vendor/bs-select/bs-select.min.js') }}"></script>
		<script>
			$(document).ready(function() {
				$('.summernote').summernote({
					height: 170,
					tabsize: 2
				});
			});
		</script>
		<script>
			toastr.options = {
				"closeButton": true,
				"debug": false,
				"newestOnTop": true,
				"progressBar": true,
				"positionClass": "toast-top-right",
				"preventDuplicates": false,
				"onclick": null,
				"showDuration": "300",
				"hideDuration": "1000",
				"timeOut": "5000",
				"extendedTimeOut": "1000",
				"showEasing": "swing",
				"hideEasing": "linear",
				"showMethod": "fadeIn",
				"hideMethod": "fadeOut"
			};
		</script>


		<!-- Main JS -->
        <script src="{{ URL::to('assets/admin/js/main.js') }}"></script>