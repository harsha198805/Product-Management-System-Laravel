
<!doctype html>
<html lang="en">
	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<!-- Meta -->
		<meta name="description" content="">
		<meta name="author" content="">
		<link rel="shortcut icon" href="{{ URL::to('assets/admin/img/fav.png') }}" />

		<!-- Title -->
		<title>Admin</title>
        <meta name="csrf-token" content="{{ csrf_token() }}" />
		<!-- *************
			************ Common Css Files *************
		************ -->
		<!-- Bootstrap css -->
        <link rel="stylesheet" href="{{ URL::to('assets/admin/css/bootstrap.min.css') }}">
		<!-- Icomoon Font Icons css -->
        <link rel="stylesheet" href="{{ URL::to('assets/admin/fonts/style.css') }}">
		<!-- Main css -->
        <link rel="stylesheet" href="{{ URL::to('assets/admin/css/main.css') }}">


		<!-- *************
			************ Vendor Css Files *************
		************ -->
		<!-- DateRange css -->
        <link rel="stylesheet" href="{{ URL::to('assets/admin/vendor/daterange/daterange.css') }}">

		<!-- Datepicker css -->
        <link rel="stylesheet" href="{{ URL::to('assets/admin/vendor/datepicker/classic.css') }}">
        <link rel="stylesheet" href="{{ URL::to('assets/admin/vendor/datepicker/classic.date.css') }}">

		<!-- Steps Wizard CSS -->
        <link rel="stylesheet" href="{{ URL::to('assets/admin/vendor/wizard/jquery.steps.css') }}">

		<!-- Input Tags css -->
        <link rel="stylesheet" href="{{ URL::to('assets/admin/vendor/input-tags/tagsinput.css') }}">

		<!-- Summernote CSS -->
        <link rel="stylesheet" href="{{ URL::to('assets/admin/vendor/summernote/summernote-bs4.css') }}">
        <link rel="stylesheet" href="{{ URL::to('assets/admin/vendor/toaster/toastr.min.css') }}">
        <link rel="stylesheet" href="{{ URL::to('assets/admin/vendor/swetalert/sweetalert2.min.css') }}">
        <link rel="stylesheet" href="{{ URL::to('assets/admin/vendor/bs-select/bs-select.css') }}">

	</head>