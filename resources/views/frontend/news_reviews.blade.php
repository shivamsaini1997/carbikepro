@extends('frontend.layouts.main')
@push('title')
    @foreach ($newsdetails as $item)
        <title>{{ $item->news_page }}</title>
    @endforeach
@endpush

@section('main')
    <style>
        .s-titleDet {
            display: -webkit-box;
            -webkit-line-clamp: 1;
            /* Limit to 4 lines */
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .limited-text {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            /* Limit to 4 lines */
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
            margin-bottom: 15px;
        }

        .limited-text p {
            margin: 0;
        }
    </style>
    <section class="b-pageHeader py-5">
        <div class="container py-5">
            {{-- @foreach ($newsdetails as $item)   --}}
            <h1 class=" wow zoomInLeft" data-wow-delay="0.3s">{{ $newsreviewpage->news_page }}</h1>
            {{-- @endforeach --}}

        </div>
    </section>
    <!--b-pageHeader-->

    <div class="b-breadCumbs s-shadow">
        <div class="container wow zoomInUp" data-wow-delay="0.3s">

            <a href="{{ route('homepage') }}" class="b-breadCumbs__page">Home</a><span class="fa fa-angle-right"></span>
            <a href="{{ $newsreviewpage->slug }}" class="b-breadCumbs__page m-active">{{ $newsreviewpage->news_page }}</a>
        </div>
    </div>
    <!--b-breadCumbs-->


    <div class="b-blog s-shadow ">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-xs-12">
                    <aside class="b-blog__aside d-none">
                        <div class="b-blog__aside-categories wow zoomInUp" data-wow-delay="0.3s">
                            <header class="s-lineDownLeft">
                                <h2 class="s-titleDet">Explore Other Cars Brands</h2>
                            </header>
                            <nav>
                                <ul class="b-blog__aside-categories-list">
                                    <ul class="b-blog__aside-categories-list">
                                        @foreach ($brandscar as $item)
                                            @if ($item->category == 'Cars')
                                                <li
                                                    class="{{ request()->url() === url($item->category . '/' . $item->brands_url) ? 'm-active' : '' }}">
                                                    <a
                                                        href="{{ url(strtolower($item->category) . '/' . $item->brands_url) }}">
                                                        {{ $item->brands_name }}
                                                    </a>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </ul>
                            </nav>
                        </div>
                        <div class="b-blog__aside-categories wow zoomInUp" data-wow-delay="0.3s">
                            <header class="s-lineDownLeft">
                                <h2 class="s-titleDet">Explore Other Bikes Brands</h2>
                            </header>
                            <nav>
                                <ul class="b-blog__aside-categories-list">
                                    <ul class="b-blog__aside-categories-list">
                                        @foreach ($brandsbike as $item)
                                            @if ($item->category == 'Bikes')
                                                <li
                                                    class="{{ request()->url() === url($item->category . '/' . $item->brands_url) ? 'm-active' : '' }}">
                                                    <a
                                                        href="{{ url(strtolower($item->category) . '/' . $item->brands_url) }}">
                                                        {{ $item->brands_name }}
                                                    </a>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </ul>
                            </nav>
                        </div>
                    </aside>
                </div>
                <div class="col-md-9 col-xs-12">
                    <div class="b-blog__posts">
                        @foreach ($newsdetails as $item)
                            <div class="b-blog__posts-one wow zoomInUp" data-wow-delay="0.3s">
                                <div class="row">
                                    <div class="col-xs-8">
                                        <header class="b-blog__posts-one-body-head s-lineDownLeft">
                                            <div class="b-blog__posts-one-body-head-notes">
                                                <span class="b-blog__posts-one-body-head-notes-note"><span
                                                        class="fa fa-calendar-o"></span>{{ $item->created_at->format('d-m-Y') }}</span>
                                            </div>
                                            <h2 class="s-titleDet">{{ $item->title }}</h2>
                                        </header>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-4 pull-right">
                                        <img class="img-responsive center-block" src="{{ asset($item->news_image) }}"
                                            alt="{{ $item->title }}" />
                                    </div>
                                    <div class="col-xs-8 pull-right">
                                        <div class="b-blog__posts-one-info">
                                            <div class="limited-text">
                                                {!! $item->news_details !!}
                                            </div>
                                            <a href="{{ url('news/' . $newsreviewpage->slug . '/' . $item->slug) }}"
                                                class="btn m-btn m-readMore">Read More<span
                                                    class="fa fa-angle-right"></span></a>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        @endforeach
                        <div class="blog__pagination px-2 text-center">
                            {{ $newsdetails->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--b-blog-->
@endsection
