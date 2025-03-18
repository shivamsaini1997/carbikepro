@extends('admin.layout.head')
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
            <div class="card-body login-card-body">
                <p class="login-box-msg">Reset Password</p>

                <form action="{{ route('forgetpasswordsubmit') }}" method="post">
                    @csrf
                    <div class="input-group mb-3">
                        <div class="input-group">
                            <input type="email" class="form-control @error('email') is-invalid @enderror" value="" name="email" placeholder="Email">
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



                    <div class="row">


                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block">Send Password Reset Link
                            </button>
                        </div>

                    </div>
                </form>

                <p class="mb-1">
                    <a href="{{route('login')}}">Login</a>
                </p>
                <p class="mb-0">
                </p>
            </div>

        </div>
    </div>

</body>


@include('admin.layout.footer')
