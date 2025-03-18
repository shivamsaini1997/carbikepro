@extends('frontend.layouts.main')
@section('main')
    <section class="b-pageHeader">
        <div class="container">
            <h1 class="wow zoomInUp" data-wow-delay="0.7s">Error 404 Page</h1>
        </div>
    </section>

    <div class="b-breadCumbs s-shadow">
        <div class="container">
            <a href="{{ url('/') }}" class="b-breadCumbs__page">Home</a>
            <span class="fa fa-angle-right"></span>
            <span class="b-breadCumbs__page m-active">Page Not Found</span>
        </div>
    </div>

    <section class="b-error s-shadow">
        <div class="container text-center">
            <h1 class="wow zoomInUp" data-wow-delay="0.7s">Error 404</h1>
            <img class="img-responsive center-block wow zoomInUp" data-wow-delay="0.7s" src="{{ asset('frontend/images/backgrounds/404.png') }}" alt="404" />
            <h2 class="s-lineDownCenter wow zoomInUp" data-wow-delay="0.7s" style="    padding: 0;">Page Not Found</h2>
            <p class="wow zoomInUp" data-wow-delay="0.7s">
                The page you are looking for is not available and might have been removed, its name changed, or is temporarily unavailable.
            </p>
            <a href="{{ url('/') }}" class="btn btn-primary wow zoomInUp" data-wow-delay="0.7s">Go to Homepage</a>
        </div>
        <img alt="404 Background" src="{{ asset('frontend/images/backgrounds/404Bg.jpg') }}" class="img-responsive center-block b-error-img" />
    </section>
@endsection
