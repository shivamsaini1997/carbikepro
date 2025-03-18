@extends('frontend.layouts.main')
@section('main')

<section class="b-featured pt-5">

    <div class="container">

        @if (!empty($products))

        <h2 class="s-title wow zoomInUp" data-wow-delay="0.3s">Search Results For: {{$query}}</h2>
        <div class="row">
                @foreach ($products as $item)
               
                <div class="col-md-4">
                    <div class="b-featured__item wow rotateIn" data-wow-delay="0.3s" data-wow-offset="150">
                        <a href="{{ url(strtolower($item->category) . '/' . strtolower($item->brands) . '/' . $item->product_url) }}">
                            <img src="{{ asset($item->productimage1) }}" alt=" {{ $item->product_name }}" />
                            @if ($item->product_label == '1')
                                <span class="m-premium">Just Launched</span>
                            @elseif ($item->product_label == '2')
                                <span class="m-leasing">Electric</span>
                            @endif
                        </a>
                        <h5>
                            <a href="{{ url(strtolower($item->category) . '/' . strtolower($item->brands) . '/' . $item->product_url) }}">
                                {{ $item->product_name }}
                            </a>
                        </h5>
                        <div class="b-featured__item-prices">
                            Rs {{ $item->showroom_price }}
                        </div>
                        <div class="b-featured__item-count"><span
                                class="fa fa-tachometer"></span>{{ $item->top_speed }}</div>
                        <div class="b-featured__item-links">
                            <a
                                href="{{ url(strtolower($item->category) . '/' . strtolower($item->brands) . '/' . $item->product_url) }}">{{ $item->brands }}</a>
                            <a
                                href="{{ url(strtolower($item->category) . '/' . strtolower($item->brands) . '/' . $item->product_url) }}">{{ $item->color }}</a>
                            <a
                                href="{{ url(strtolower($item->category) . '/' . strtolower($item->brands) . '/' . $item->product_url) }}">{{ $item->fuel_type }}</a>
                        </div>
                        <a href="{{ url(strtolower($item->category) . '/' . strtolower($item->brands) . '/' . $item->product_url) }}"
                            class="btn m-btn newcardbtn">Get on road price</a>
                    </div>
                </div>
                
                @endforeach
            </div>

        @else
        <h2 class="s-title wow zoomInUp" data-wow-delay="0.3s">Search Results</h2>
        @if($vehicles->isEmpty())
            <p>No vehicles found matching your criteria.</p>
        @else
        <div class="row">
            @foreach ($vehicles as $vehicle)
                <div class="col-md-3">
                    <div class="b-featured__item wow rotateIn" data-wow-delay="0.3s" data-wow-offset="150">
                        <a href="{{ url(strtolower($vehicle->category) . '/' . strtolower($vehicle->brands) . '/' . $vehicle->product_url) }}">
                            <img src="{{ asset($vehicle->productimage1) }}" alt=" {{ $vehicle->product_name }}" />
                            @if ($vehicle->product_label == '1')
                                <span class="m-premium">Just Launched</span>
                            @elseif ($vehicle->product_label == '2')
                                <span class="m-leasing">Electric</span>
                            @endif
                        </a>
                        <h5>
                            <a href="{{ url(strtolower($vehicle->category) . '/' . strtolower($vehicle->brands) . '/' . $vehicle->product_url) }}">
                                {{ $vehicle->product_name }}
                            </a>
                        </h5>
                        <div class="b-featured__item-prices">
                            Rs {{ $vehicle->showroom_price }}
                        </div>
                        <div class="b-featured__item-count"><span
                                class="fa fa-tachometer"></span>{{ $vehicle->top_speed }}</div>
                        <div class="b-featured__item-links">
                            <a
                                href="{{ url(strtolower($vehicle->category) . '/' . strtolower($vehicle->brands) . '/' . $vehicle->product_url) }}">{{ $vehicle->brands }}</a>
                            <a
                                href="{{ url(strtolower($vehicle->category) . '/' . strtolower($vehicle->brands) . '/' . $vehicle->product_url) }}">{{ $vehicle->color }}</a>
                            <a
                                href="{{ url(strtolower($vehicle->category) . '/' . strtolower($vehicle->brands) . '/' . $vehicle->product_url) }}">{{ $vehicle->fuel_type }}</a>
                        </div>
                        <a href="{{ url(strtolower($vehicle->category) . '/' . strtolower($vehicle->brands) . '/' . $vehicle->product_url) }}"
                            class="btn m-btn newcardbtn">Get on road price</a>
                    </div>
                </div>
            @endforeach
        </div>
        @endif
        @endif

    </div>

    
</section>
@endsection
