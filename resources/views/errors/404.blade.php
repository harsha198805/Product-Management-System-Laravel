@extends('layouts.app')
@section('content')

<section class="contact-form-body">
    <div class="container">
        <div class="row justify-center text-center">
            <div class="col-xl-8 col-lg-10">
                <h2 class="text-64 md:text-40 capitalize">404</h2>
                <h4 class="text-50 md:text-30 capitalize">Oops! The page you're looking for cannot be found.</h4>
                <a href="{{ url('/') }}">Go back to the homepage</a>
            </div>
        </div>
    </div>
</section>

@endsection