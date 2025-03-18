<header class="b-topBar wow slideInDown" data-wow-delay="0.7s">
    <div class="container">
        <div class="row" style="align-items: center; display: flex;">
            <div class="col-md-5 col-xs-6">
                <div class="b-topBar__addr">
                    <span class="fa fa-map-marker"></span>
                    {{$global->address}}
                </div>
            </div>
            <div class="col-md-4 col-xs-6">
                <div class="b-topBar__tel" style="text-transform: lowercase !important;">
                    <input class="typeahead form-control" id="autokeyword" type="text" placeholder="Search Vehicle" autocomplete="off">
                    <div class="results"></div>
                </div>
                
                
            </div>
            <div class="col-md-3 col-xs-6">

                <nav class="b-topBar__nav userl">
                    <ul>
                   
                       <!-- Check if user is logged in -->
                       @if(Auth::guard('alluser')->check())
                       <!-- Show user profile dropdown -->
                       <li>
                           <div class="b-topBar__lang">
                               <div class="dropdown userloginbox">
                                   <a class="m-langLink dropdown-toggle" data-toggle='dropdown' href="#">
                                       <i class="fa fa-user" aria-hidden="true" style="padding: 0 5px;"></i>
                                       <span>{{ explode(' ', Auth::guard('alluser')->user()->name)[0] }} <span class="fa fa-caret-down"></span></span>
                                   </a>
                                   <ul class="dropdown-menu">
                                       <li>
                                           <a href="{{ route('users.logout') }}"
                                              onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                              Logout
                                           </a>
                                           <form id="logout-form" action="{{ route('users.logout') }}" method="POST" style="display: none;">
                                               @csrf
                                           </form>
                                       </li>
                                   </ul>
                               </div>
                           </div>
                       </li>
                   @else
                       <!-- Show register and sign-in links if user is not logged in -->
                       <li style="display: flex;">
                           <a href="javascript:void(0)" data-target="#myModal" data-toggle="modal" style="padding: 0 5px;">Register</a>
                           <span>/</span>
                           <a href="javascript:void(0)" data-target="#loginmodal" data-toggle="modal" style="padding: 0 5px;">Sign in</a>
                       </li>
                   @endif
                   


                    </ul>
                </nav>
            </div>
            
        </div>
    </div>
</header>
<!--b-topBar-->

<nav class="b-nav">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="b-nav__logo wow slideInLeft" data-wow-delay="0.3s">
                    <h3><a href="{{ url('/') }}">CAR<span>Bike</span></a></h3>
                    <h2><a href="{{ url('/') }}">CAR AND BIKE PRO</a></h2>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="b-nav__list wow slideInRight" data-wow-delay="0.3s">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#nav">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <div class="collapse navbar-collapse navbar-main-slide" id="nav">
                        <ul class="navbar-nav-menu">
                                @php
                                    // dd($categorysall);
                                @endphp
                            @foreach ($categorysall as $item)
                                @if ($item->parent_id == 0)
                                    <li class="dropdown">
                                        <a class="dropdown-toggle" data-toggle='dropdown'
                                            href="javascript:void()">{{ $item->category }}<span
                                                class="fa fa-caret-down"></span></a>
                                        <ul class="dropdown-menu h-nav">
                                            @foreach ($categorysall as $subcategorys)
                                                @if ($item->id == $subcategorys->parent_id)
                                                    <li>
                                                        <a href="{{ url($subcategorys->slug) }}">{{ $subcategorys->category }}</a>
                                                    </li>
                                                @endif
                                                
                                            @endforeach
                                            <li>
                                                @foreach ($categorysall as $subcategorys)
                                                @if ($item->id == $subcategorys->parent_id)
                                                    <a href="{{ url('find-' . $subcategorys->slug) }}">{{ 'Find' . ' ' . $subcategorys->category }}</a>
                                                @endif
                                                @endforeach
                                            </li>
                                        </ul>
                                    </li>
                                @endif
                            @endforeach

                            <li class="dropdown">
                                <a class="dropdown-toggle" data-toggle='dropdown' href="#">News & Reviews <span
                                        class="fa fa-caret-down"></span></a>
                                <ul class="dropdown-menu h-nav">
                                    @foreach ($newsReviews as $item)
                                        <li><a href="{{ url('news/' . $item->slug) }}">{{ $item->news_page }}</a></li>
                                    @endforeach
                                    <li><a href="{{ route('videos') }}">Video </a></li>
                                </ul>
                            </li>
                            <li class="dropdown mobilemodal">
                                <a href="javascript:void(0)" class="dropdown-toggle" data-target="#myModal" data-toggle="modal">Register</a>
                                
                            </li>
                            <li class="dropdown mobilemodal">
                                
                                <a href="javascript:void(0)" class="dropdown-toggle"  data-target="#loginmodal" data-toggle="modal">Sign in</a>
                            </li>
                        </ul>

                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>
<!--b-nav-->

    
@include('frontend.layouts.login_registre')


