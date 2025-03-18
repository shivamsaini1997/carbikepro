@extends('frontend.layouts.main')
@section('main')
    @push('title')
        <title>{{ 'Find' . ' ' . $categorys->category }}</title>
    @endpush
    @push('meta')
        <meta name="keywords" content="">
        <meta name="description" content="">
    @endpush
    <section class="b-pageHeader">
        <div class="container">
            <h1 class="wow zoomInLeft" data-wow-delay="0.5s">{{ 'Find' . ' ' . $categorys->category }}</h1>

        </div>
    </section>

    <div class="b-breadCumbs s-shadow">
        <div class="container wow zoomInUp" data-wow-delay="0.5s">
            <a href="home.html" class="b-breadCumbs__page">Home</a><span class="fa fa-angle-right"></span><a
                href="listTableTwo.html" class="b-breadCumbs__page m-active">Search Results</a>
        </div>
    </div>


    <div class="b-items">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-sm-4 col-xs-12">
                    <aside class="b-items__aside">
                        <h2 class="s-title wow zoomInUp" data-wow-delay="0.5s" style="font-size: 18px;">REFINE YOUR SEARCH
                        </h2>
                        <div class="b-items__aside-main wow zoomInUp" data-wow-delay="0.5s">
                            <form action="">
                                <div class="b-items__aside-main-body">
                                    <div class="b-items__aside-main-body-item">
                                        @php
                                            $secondWord = explode(' ', $categorys->category)[1] ?? null;
                                        @endphp
                                        <label>Search {{ $secondWord }} Brands</label>
                                        @foreach ($brands as $brand)
                                            @if ($brand->category == $secondWord)
                                                <div>
                                                    <input type="checkbox" class="brand-filter"
                                                        id="{{ $brand->brands_name }}" name="brands[]"
                                                        value="{{ $brand->brands_name }}">
                                                    <label
                                                        for="{{ $brand->brands_name }}">{{ $brand->brands_name }}</label><br>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                    <div class="b-items__aside-main-body-item">
                                        <label>Fuel Types</label>
                                        <div>
                                            <input type="checkbox" class="fuel-filter" id="Petrol" name="fuels[]"
                                                value="Petrol">
                                            <label for="Petrol">Petrol</label><br>
                                        </div>
                                        <div>
                                            <input type="checkbox" class="fuel-filter" id="Diesel" name="fuels[]"
                                                value="Diesel">
                                            <label for="Diesel">Diesel</label><br>
                                        </div>
                                        <div>
                                            <input type="checkbox" class="fuel-filter" id="Electric" name="fuels[]"
                                                value="Electric">
                                            <label for="Electric">Electric</label><br>
                                        </div>
                                        <div>
                                            <input type="checkbox" class="fuel-filter" id="CNG" name="fuels[]"
                                                value="CNG">
                                            <label for="CNG">CNG</label><br>
                                        </div>
                                    </div>
                                    @if ($secondWord == 'Cars')
                                        <div class="b-items__aside-main-body-item">
                                            <label>Body Types </label>

                                            <div>
                                                <input type="checkbox" class="body_types" id="Hatchback" name="body_types[]"
                                                    value="Hatchback">
                                                <label for="Hatchback"> Hatchback</label><br>
                                            </div>
                                            <div>
                                                <input type="checkbox" class="body_types" id="Sedan" name="body_types[]"
                                                    value="Sedan">
                                                <label for="Sedan"> Sedan</label><br>
                                            </div>
                                            <div>
                                                <input type="checkbox" class="body_types" id="SUV" name="body_types[]"
                                                    value="SUV">
                                                <label for="SUV"> SUV</label><br>
                                            </div>
                                            <div>
                                                <input type="checkbox" class="body_types" id="Truck" name="body_types[]"
                                                    value="Truck">
                                                <label for="Truck"> Truck</label><br>
                                            </div>
                                            <div>
                                                <input type="checkbox" class="body_types" id="Station Wagon"
                                                    name="body_types[]" value="Station Wagon">
                                                <label for="Station Wagon"> Station Wagon</label><br>
                                            </div>
                                            <div>
                                                <input type="checkbox" class="body_types" id="Coupe" name="body_types[]"
                                                    value="Coupe">
                                                <label for="Coupe"> Coupe</label><br>
                                            </div>
                                            <div>
                                                <input type="checkbox" class="body_types" id="Convertible"
                                                    name="body_types[]" value="Convertible">
                                                <label for="Convertible"> Convertible</label><br>
                                            </div>
                                            <div>
                                                <input type="checkbox" class="body_types" id="MUV"
                                                    name="body_types[]" value="MUV">
                                                <label for="MUV"> MUV</label><br>
                                            </div>
                                            <div>
                                                <input type="checkbox" class="body_types" id="MPV"
                                                    name="body_types[]" value="MPV">
                                                <label for="MPV"> MPV </label><br>
                                            </div>
                                            <div>
                                                <input type="checkbox" class="body_types" id="Crossover"
                                                    name="body_types[]" value="Crossover">
                                                <label for="Crossover"> Crossover </label><br>
                                            </div>
                                            <div>
                                                <input type="checkbox" class="body_types" id="Minivan"
                                                    name="body_types[]" value="Minivan">
                                                <label for="Minivan"> Minivan </label><br>
                                            </div>
                                        </div>
                                    @endif


                                    <div class="b-items__aside-main-body-item">
                                        <label>Transmission</label>
                                        <div>
                                            <input type="checkbox" id="Manual" class="transmission"
                                                name="transmission[]" value="Manual">
                                            <label for="Manual"> Manual</label><br>
                                        </div>
                                        <div>
                                            <input type="checkbox" id="Automatic" class="transmission"
                                                name="transmission[]" value="Automatic">
                                            <label for="Automatic"> Automatic</label><br>
                                        </div>
                                    </div>

                                    <div class="b-items__aside-main-body-item">
                                        <label>Mileage</label>
                                        <div>
                                            <input type="checkbox" id="Under_10_Kmpl" class="mileage" name="mileage[]"
                                                value="10">
                                            <label for="Under_10_Kmpl"> Under 10 Kmpl</label><br>
                                        </div>
                                        <div>
                                            <input type="checkbox" id="10-15Kmpl" class="mileage" name="mileage[]"
                                                value="10 - 15">
                                            <label for="10-15Kmpl"> 10 - 15 Kmpl</label><br>
                                        </div>
                                        <div>
                                            <input type="checkbox" id="15_Kmpl_and_Above" class="mileage"
                                                name="mileage[]" value="15">
                                            <label for="15_Kmpl_and_Above"> 15 Kmpl and Above</label><br>
                                        </div>
                                    </div>

                                </div>

                            </form>
                        </div>

                    </aside>
                </div>
                <div class="col-lg-9 col-sm-8 col-xs-12">
                    <div class="row m-border b-featured latestcars" id="product-list" style="padding: 30px 0px">
                        @foreach ($product as $items)
                            @php
                                $firstword = explode(' ', $categorys->category)[0] ?? null;
                                $secondWord = explode(' ', $categorys->category)[1] ?? null;

                            @endphp

                            @if ($items->category == $secondWord)
                                <div class="col-lg-4 col-md-6">
                                    <div>
                                        <div class="b-featured__item wow rotateIn" data-wow-delay="0.3s"
                                            data-wow-offset="150">
                                            <a
                                                href="{{ url(strtolower($items->category) . '/' . strtolower($items->brands) . '/' . $items->product_url) }}">
                                                <img src="{{ asset($items->productimage1) }}"
                                                    alt="{{ $items->product_name }}" />
                                                @if ($items->product_label == '1')
                                                    <span class="m-premium">Just Launched</span>
                                                @endif
                                                @if ($items->product_label == '2')
                                                    <span class="m-leasing">Electric</span>
                                                @endif
                                            </a>
                                            <h5><a
                                                    href="{{ url(strtolower($items->category) . '/' . strtolower($items->brands) . '/' . $items->product_url) }}">{{ $items->product_name }}</a>
                                            </h5>
                                            <div class="b-featured__item-prices">
                                                Rs {{ $items->showroom_price }}
                                            </div>
                                            <div class="b-featured__item-count">
                                                <span class="fa fa-tachometer"></span>
                                                {{ $items->top_speed }}
                                            </div>
                                            <div class="b-featured__item-links">
                                                <a
                                                    href="{{ url(strtolower($items->category) . '/' . strtolower($items->brands) . '/' . $items->product_url) }}">{{ $items->brands }}</a>
                                                <a
                                                    href="{{ url(strtolower($items->category) . '/' . strtolower($items->brands) . '/' . $items->product_url) }}">{{ $items->color }}</a>
                                                <a
                                                    href="{{ url(strtolower($items->category) . '/' . strtolower($items->brands) . '/' . $items->product_url) }}">{{ $items->fuel_type }}</a>
                                            </div>
                                            <a href="{{ url(strtolower($items->category) . '/' . strtolower($items->brands) . '/' . $items->product_url) }}"
                                                class="btn m-btn newcardbtn">Get on road price</a>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                        @foreach ($evproduct as $item)
                            @if ($item->category == $firstword)
                                @php
                                    $productsecondWord = explode(' ', $item->pages_name)[1] ?? null;
                                    // dd($productsecondWord);
                                @endphp
                                @if ($productsecondWord == 'Cars')
                                    <div class="col-lg-4 col-md-6">
                                        <div>
                                            <div class="b-featured__item wow rotateIn" data-wow-delay="0.3s"
                                                data-wow-offset="150">
                                                <a
                                                    href="{{ url(strtolower($item->category) . '/' . strtolower($item->brands) . '/' . $item->product_url) }}">
                                                    <img src="{{ asset($item->productimage1) }}"
                                                        alt="{{ $item->product_name }}" />
                                                    @if ($item->product_label == '1')
                                                        <span class="m-premium">Just Launched</span>
                                                    @endif
                                                    @if ($item->product_label == '2')
                                                        <span class="m-leasing">Electric</span>
                                                    @endif
                                                </a>
                                                <h5><a
                                                        href="{{ url(strtolower($item->category) . '/' . strtolower($item->brands) . '/' . $item->product_url) }}">{{ $item->product_name }}</a>
                                                </h5>
                                                <div class="b-featured__item-prices">
                                                    Rs {{ $item->showroom_price }}
                                                </div>
                                                <div class="b-featured__item-count">
                                                    <span class="fa fa-tachometer"></span>
                                                    {{ $item->top_speed }}
                                                </div>
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
                                    </div>
                                @endif
                            @endif
                        @endforeach


                    </div>

                </div>
            </div>
        </div>
    </div>
    <!--b-items-->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script>
        $(document).ready(function() {
                $('.brand-filter, .fuel-filter, .transmission, .mileage, .body_types').on('change', function() {
                    let selectedBrands = [];
                    let selectedFuels = [];
                    let selectedTransmission = [];
                    let selectedMileage = [];
                    let selectedBodyType = [];
    
                    // Collect selected brands
                    $('.brand-filter:checked').each(function() {
                        selectedBrands.push($(this).val());
                    });
    
                    // Collect selected fuel types
                    $('.fuel-filter:checked').each(function() {
                        selectedFuels.push($(this).val());
                    });
    
                    // Collect selected transmission types
                    $('.transmission:checked').each(function() {
                        selectedTransmission.push($(this).val());
                    });
    
                    // Collect selected mileage
                    $('.mileage:checked').each(function() {
                        selectedMileage.push($(this).val());
                    });
    
                    // Collect selected body types
                    $('.body_types:checked').each(function() {
                        selectedBodyType.push($(this).val());
                    });
    
                    // Send AJAX request
                    $.ajax({
                        url: '{{ url('find-' . $categorys->slug) }}',
                        method: 'GET',
                        data: {
                            brands: selectedBrands,
                            fuels: selectedFuels,
                            transmission: selectedTransmission,
                            mileage: selectedMileage,
                            body_types: selectedBodyType
                        },
                        success: function(response) {
                            let productHtml = '';
                            if (response.product.length > 0) {
                                response.product.forEach(function(product) {
                                    productHtml += `
                                <div class="col-lg-4 col-md-6">
                                    <div>
                                        <div class="b-featured__item wow rotateIn" data-wow-delay="0.3s" data-wow-offset="150">
                                            <a href="${product.category.toLowerCase()}/${product.brands.toLowerCase()}/${product.product_url}">
                                                <img src="{{ asset('') }}/${product.productimage1}" alt="${product.product_name}" />
                                                ${product.product_label === '1' ? '<span class="m-premium">Just Launched</span>' : ''}
                                                ${product.product_label === '2' ? '<span class="m-leasing">Electric</span>' : ''}
                                            </a>
                                            <h5><a href="${product.category.toLowerCase()}/${product.brands.toLowerCase()}/${product.product_url}">${product.product_name}</a></h5>
                                            <div class="b-featured__item-prices">Rs ${product.showroom_price}</div>
                                            <div class="b-featured__item-count">
                                                <span class="fa fa-tachometer"></span>
                                                ${product.top_speed}
                                            </div>
                                            <div class="b-featured__item-links">
                                                <a href="${product.category.toLowerCase()}/${product.brands.toLowerCase()}/${product.product_url}">${product.brands}</a>
                                                <a href="${product.category.toLowerCase()}/${product.brands.toLowerCase()}/${product.product_url}">${product.color}</a>
                                                <a href="${product.category.toLowerCase()}/${product.brands.toLowerCase()}/${product.product_url}">${product.fuel_type}</a>
                                            </div>
                                            <a href="${product.category.toLowerCase()}/${product.brands.toLowerCase()}/${product.product_url}" class="btn m-btn newcardbtn">Get on road price</a>
                                        </div>
                                    </div>
                                </div>`;
                                });
                            } else {
                                productHtml =
                                    '<div class="col-12 text-center"><p style="font-size:22px";">Product not available!</p></div>';
                            }
    
                            // Update product list
                            $('#product-list').html(productHtml);
                        },
                        error: function(xhr, status, error) {
                            console.error("Status: ", status);
                            console.error("Error: ", error);
                            console.error("Response: ", xhr.responseText);
                        }
                    });
                });
            });
    </script>
    
@endsection
