@extends('Admin.layout.head')
@push('title')
    <title>Reset Password</title>
@endpush

<body class="hold-transition login-page">
    <style>
        footer {
            display: none !important;
        }
    </style>

    <div class="login-box text-center">


        <div class="card">
            <div class="card-header"><b>Reset Password</b></div>
            <div class="card-body">
                <form action="{{ route('reset.password.post') }}" method="POST">
                    @csrf
                    <input type="hidden" name="email" value="{{$email}}">
                    <div class="input-group mb-3">
                        <div class="input-group">
                            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password"id="password"  placeholder="Password"
                                autofocus>
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
                    <div class="input-group mb-3">
                        <div class="input-group">
                            <input type="password" id="password-confirm" class="form-control @error('password') is-invalid @enderror" name="password_confirmation" placeholder="Confirm Password"
                                autofocus>
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

                    <div class="form-group row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block"> Reset Password</button>
                        </div>
                    </div>


                </form>

            </div>
        </div>
    </div>

</body>


@include('Admin.layout.footer')
