@extends('frontend.layouts.main')
@section('main')
    <section class="newcar py-5">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h2><b>Videos And Podcasts</b></h2>
                    <p>Watch the latest videos of car reviews, bike reviews, launch stories and expert reviews, first drive
                        impressions, road tests and comparison tests done by the CarBike360 team.</p>
                </div>

            </div>
        </div>
    </section>
    <section class="b-auto videobox">
        <div class="container">
            <div class="row">
                <div class="col-lg-10">
                    <div class="" style="text-align: start;">
                        <div class="mb-5">
                            <a href="#" class="b-auto__main-toggle s-lineDownCenter m-active j-tab wow zoomInLeft"
                                data-wow-delay="0.3s" data-wow-offset="100" data-to="#first">All</a>
                            <a href="#" class="b-auto__main-toggle j-tab wow zoomInUp" data-wow-delay="0.3s"
                                data-wow-offset="100" data-to="#second">Four Wheeler</a>
                            <a href="#" class="b-auto__main-toggle j-tab wow zoomInUp" data-wow-delay="0.3s"
                                data-wow-offset="100" data-to="#three">Two Wheeler</a>
                            <a href="#" class="b-auto__main-toggle j-tab wow zoomInUp" data-wow-delay="0.3s"
                                data-wow-offset="100" data-to="#fore">Electric</a>
                        </div>
                        <div class="clearfix"></div>
                        <div id="first">
                           
                                <div class="row">
                                    @foreach ($allvideo as $item)
                                        <div class="col-sm-4 col-xs-12 mb-5">
                                            <a href="{{route('videos-detail',$item->slug)}}">
                                                <div class="b-world__item wow zoomInLeft" data-wow-delay="0.3s"
                                                    data-wow-offset="100">
                                                    <img class="img-responsive" src="{{asset($item->video_thanmbnail)}}" alt="{{$item->video_title}}">
                                                    <h2>{{$item->video_title}}</h2>
                                                    <span><b>{{ $item->created_at->format('d-M-Y h:i A') }}
                                                    </b></span>
                                                </div>
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="blog__pagination px-2" style="text-align: center">
                                            {{ $allvideo->links('pagination::bootstrap-4') }}
                                        </div>
                                    </div>
                                </div>
                            
                        </div>
                        <div  id="second">
                                <div class="row">
                                    @foreach ($wheelervideo as $item)
                                        <div class="col-sm-4 col-xs-12 mb-5">
                                            <a href="{{route('videos-detail',$item->slug)}}">
                                                <div class="b-world__item wow zoomInLeft" data-wow-delay="0.3s"
                                                    data-wow-offset="100">
                                                    <img class="img-responsive" src="{{asset($item->video_thanmbnail)}}" alt="{{$item->video_title}}">
                                                    <h2>{{$item->video_title}}</h2>
                                                    <span><b>{{ $item->created_at->format('d-M-Y h:i A') }}
                                                    </b></span>
                                                </div>
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                        </div>
                        <div id="three">
                            
                                <div class="row">
                                    @foreach ($Twowheelervideo as $item)
                                        <div class="col-sm-4 col-xs-12 mb-5">
                                            <a href="{{route('videos-detail',$item->slug)}}">
                                                <div class="b-world__item wow zoomInLeft" data-wow-delay="0.3s"
                                                    data-wow-offset="100">
                                                    <img class="img-responsive" src="{{asset($item->video_thanmbnail)}}" alt="{{$item->video_title}}">
                                                    <h2>{{$item->video_title}}</h2>
                                                    <span><b>{{ $item->created_at->format('d-M-Y h:i A') }}
                                                    </b></span>
                                                </div>
                                            </a>
                                        </div>
                                    @endforeach

                                </div>
                           
                        </div>
                        <div id="fore">
                                <div class="row">
                                    @foreach ($electricvideo as $item)
                                        <div class="col-sm-4 col-xs-12 mb-5">
                                            <a href="{{route('videos-detail',$item->slug)}}">
                                                <div class="b-world__item wow zoomInLeft" data-wow-delay="0.3s"
                                                    data-wow-offset="100">
                                                    <img class="img-responsive" src="{{asset($item->video_thanmbnail)}}" alt="{{$item->video_title}}">
                                                    <h2>{{$item->video_title}}</h2>
                                                    <span><b>{{ $item->created_at->format('d-M-Y h:i A') }}
                                                    </b></span>
                                                </div>
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 text-start d-none">
                    <div class="row">
                        <aside class="b-blog__aside">
                            <div class="b-blog__aside-categories wow zoomInUp" data-wow-delay="0.3s">
                                <header class="s-lineDownLeft">
                                    <h2 class="s-titleDet">Explore Other Cars Brands</h2>
                                </header>
                                <nav>
                                    <ul class="b-blog__aside-categories-list text-left">
                                        @foreach ($brandscar as $item)
                                            @if ($item->category == 'Cars')
                                                <li lass="{{ request()->url() === url($item->category . '/' . $item->brands_url) ? 'm-active' : '' }}">
                                                    <a href="{{ url(strtolower($item->category) . '/' . $item->brands_url) }}">
                                                        {{ $item->brands_name }}
                                                    </a>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </nav>
                            </div>
                        </aside>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
