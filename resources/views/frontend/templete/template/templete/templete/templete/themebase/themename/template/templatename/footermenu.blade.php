<div class="b-info">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-xs-6">
                @include('frontend.layouts.footeraboutus')
            </div>
            <div class="col-md-2 col-xs-6">
                <div class="b-info__latest">
                    <h3>Menu</h3>
                    <div class="b-info__contacts-item">
                        <ul style="padding:0px">
                            <li><a href="{{url('about-us')}}" class="menu-navlink">About</a></li>
                            <li><a href="{{url('new-cars')}}" class="menu-navlink">Cars</a></li>
                            <li><a href="{{url('new-bikes')}}" class="menu-navlink">Bikes</a></li>
                            <li><a href="{{url('new-scooters')}}" class="menu-navlink">Scooter</a></li>
                            <li><a href="{{url('electric-cars')}}" class="menu-navlink">Electric Cars</a></li>
                            <li><a href="{{url('electric-bikes')}}" class="menu-navlink">Electric Bikes</a></li>
                            <li><a href="{{url('electric-scooters')}}" class="menu-navlink">Electric Scooters</a></li>
                            <li><a href="{{url('news/latest-news')}}" class="menu-navlink">Latest News</a></li>
                            <li><a href="{{url('news/articles')}}" class="menu-navlink">Articles</a></li>
                            <li><a href="{{url('/news/expert-review')}}" class="menu-navlink">Expert Review</a></li>
                            <li><a href="{{url('/videos')}}" class="menu-navlink">Video</a></li>
                        </ul>
                        
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-xs-6">
                <div class="b-info__twitter">
                    <h3>Quick Links</h3>
                    <div class="b-info__contacts-item">
                        <ul style="padding:0px">
                            <li><a href="{{url('popular-cars')}}" class="menu-navlink">Popular Cars</a></li>
                            <li><a href="{{url('upcoming-cars')}}" class="menu-navlink">Upcoming Cars</a></li>
                            <li><a href="{{url('latest-cars')}}" class="menu-navlink">Latest Cars</a></li>
                            <li><a href="{{url('popular-bikes')}}" class="menu-navlink">Popular Bikes</a></li>
                            <li><a href="{{url('upcoming-bikes')}}" class="menu-navlink">Upcoming Bikes</a></li>
                            <li><a href="{{url('latest-bikes')}}" class="menu-navlink">Latest Bikes</a></li>
                            <li><a href="{{url('popular-scooters')}}" class="menu-navlink">Popular Scooters</a></li>
                            <li><a href="{{url('upcoming-scooters')}}" class="menu-navlink">Upcoming Scooters</a></li>
                            <li><a href="{{url('latest-scooters')}}" class="menu-navlink">Latest Scooters</a></li>

                        </ul>
                        
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-xs-6">
                <address class="b-info__contacts wow zoomInUp" data-wow-delay="0.3s" style="margin: 0;">
                    <p><b>Contact us</b></p>
                    <div class="b-info__contacts-item">
                        <span class="fa fa-map-marker"></span>
                        <em>{{$global->address}}</em>
                    </div>
                    <div class="b-info__contacts-item">
                        <span class="fa fa-phone"></span>
                        <em>Phone: {{$global->phone}}</em>
                    </div>
                    {{-- <div class="b-info__contacts-item">
                        <span class="fa fa-fax"></span>
                        <em>FAX: 1-800- 624-5462</em>
                    </div> --}}
                    <div class="b-info__contacts-item">
                        <span class="fa fa-envelope"></span>
                        <em>Email: {{$global->email}}</em>
                    </div>
                </address>
                <address class="b-info__map">
                    {{-- <a href="contacts.html">Open Location Map</a> --}}
                </address>
            </div>
        </div>
    </div>
</div>