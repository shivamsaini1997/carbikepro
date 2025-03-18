@extends('frontend.layouts.main')
@push('title')
    <title>Brands</title>
@endpush
@section('main')
    <section class="b-auto">

        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    @php
                        $carsButtonDisplayed = false; // Flag variable
                        $bikeButtonDisplayed = false; // Flag variable
                        $scooterButtonDisplayed = false; // Flag variable
                    @endphp

                    @foreach ($brands as $item)
                        @foreach ($catparentid as $catergore)
                            @if ($item->category == $catergore->category && !$carsButtonDisplayed)
                                <h2 class="s-title wow zoomInUp" data-wow-delay="0.3s">
                                    {{ $item->category }} Brands
                                </h2>
                                @php
                                    $carsButtonDisplayed = true;
                                @endphp
                            @endif
                        @endforeach
                    @endforeach
            
                        <div class="row">
                            @foreach ($brands as $item)
                                <div class="col-xs-6 col-sm-4 col-md-3 col-lg-2">
                                    <div class="brand-img">
                                        <a href="{{ $item->brands_url }}" class="wow slideInUp text-center"
                                            data-wow-delay="0.3s" data-wow-offset="100">
                                            <img class="img-responsive" src="{{ asset($item->brands_image) }}" alt="{{ $item->brands_name }}">
                                            <h2 class="text-center">{{ $item->brands_name }}</h2>
                                        </a>
                                    </div>

                                </div>
                            @endforeach

                        </div>


                 
                </div>
            </div>
        </div>
    </section>
@endsection
