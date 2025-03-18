@extends('admin.layout.head')
@push('title')
    <title>Admin Login</title>
@endpush

<body class="hold-transition login-page">
    <style>
        footer {
            display: none !important;
        }
    </style>

    <div class="login-box text-center">

        {{-- <img src="{{ url('backend/img/sakhujagroup.png') }}" alt=""> --}}
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Admin Login</p>

                <form action="{{route('admin-login')}}" method="post">
                    @csrf
                    <div class="input-group mb-3">
                        <div class="input-group">
                            <input type="email" class="form-control @error('email') is-invalid @enderror" value="{{old('email')}}" name="email" placeholder="Email">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                        </div>
                        <span class="text-danger mb-2">
                            @error('email')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group">
                            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                        <span class="text-danger mb-2">
                            @error('password')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>

                    <div class="row">


                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block">Login</button>
                        </div>

                    </div>
                </form>

                <p class="mb-1">
                    <a href="{{route('forgetpassword')}}">Forgot Password</a>
                </p>

            </div>

        </div>
    </div>

</body>


@include('admin.layout.footer')
