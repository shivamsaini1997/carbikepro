@extends('frontend.layouts.main')
@section('main')
    <section class="b-pageHeader">
        <div class="container">
            <h1 class="wow zoomInLeft" data-wow-delay="0.7s">About Us</h1>

        </div>
    </section>
    <!--b-pageHeader-->

    <div class="b-breadCumbs s-shadow">
        <div class="container">
            <a href="{{ url('/') }}" class="b-breadCumbs__page">Home</a><span class="fa fa-angle-right"></span><a
                href="{{ route('about-us') }}" class="b-breadCumbs__page m-active">About Us</a>
        </div>
    </div>
    <!--b-breadCumbs-->

    <section class="b-best">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-xs-12">
                    <div class="b-best__info">
                        <header class="s-lineDownLeft b-best__info-head">
                            <h2 class="wow zoomInUp" data-wow-delay="0.5s">About Us</h2>
                        </header>
                        <h6 class="wow zoomInUp" data-wow-delay="0.5s">Welcome to Carandbikepro, your trusted partner in the
                            automotive world. With years of experience and a passion for vehicles, we are proud to offer a
                            wide range of high-quality cars, bikes, and SUVs to meet the needs of drivers everywhere.
                            Whether you’re looking for a reliable family vehicle, a high-performance sports car, or
                            something in between, we have the perfect option for you.</h6>
                        <p class="wow zoomInUp" data-wow-delay="0.5s">At Carandbikepro, we believe that buying a car should
                            be a rewarding experience. That’s why we provide not only an exceptional selection of vehicles
                            but also personalized service to guide you through every step of the process. From finding the
                            ideal model to securing financing and handling post-purchase services, our team is here to
                            ensure your satisfaction at every turn.</p>

                    </div>
                </div>

            </div>
        </div>
    </section>
    <!--b-best-->


    <section class="b-more">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-xs-12">
                    <div class="b-more__why wow zoomInLeft" data-wow-delay="0.5s">
                        <h2 class="s-title">WHY CHOOSE US</h2>

                        <ul class="s-list">
                            <li><span class="fa fa-check"></span> <b>Quality Selection</b>: We carry a diverse inventory of
                                new and pre-owned cars from top brands, ensuring that there’s something for every taste and
                                budget.</li>
                            <li><span class="fa fa-check"></span> <b>Expert Advice</b>: Our knowledgeable staff is
                                passionate about cars and ready to offer expert advice to help you make informed decisions.
                            </li>
                            <li><span class="fa fa-check"></span> <b> Customer Satisfaction</b>: We put our customers first,
                                offering transparent pricing, flexible financing options, and an easy, stress-free buying
                                experience.</li>
                            <li><span class="fa fa-check"></span> <b>Reliable Service</b>: Beyond the sale, we offer
                                comprehensive maintenance and repair services to keep your vehicle running smoothly for
                                years to come.</li>
                        </ul>
                        <p>Join the <b>Carandbikepro</b> family today and experience the difference that quality, service,
                            and expertise can make in your automotive journey</p>
                    </div>
                </div>

            </div>
        </div>
        </div>
    </section>
    <!--b-more-->
@endsection
