

{{-- Register form --}}
<div class="b-modal">
    <div class="modal fade in" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="myModalLabel">Register</h4>
                </div>
                <div class="modal-body login-card-body">
                    <div class="login-box">
                        <div class="card">
                            <div class="card-body login-card-body">
                                <form id="otpForm" action="" method="post">
                                    <div class="col-12">
                                        <p class="text-success sussess-otp"></p>
                                        <div class="form-group mb-2">
                                            <label for="">Email</label>
                                            <input type="email" class="form-control email-register" name="email"
                                                placeholder="Email" required>
                                            <span class="text-danger mb-2" id="emailError"></span>

                                            @error('email')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="input-group form-group mb-2">
                                            <button type="button" id="getOtpButton"
                                                class="btn btn-primary btn-block">Get OTP</button>
                                        </div>
                                    </div>

                                    <div class="opt-box" style="display: none">
                                        <label for="">Enter OTP</label>
                                        <div class="col-12" style="display: flex;">
                                            <div class="input-group mb-5">
                                                <input type="tel" class="form-control" name="otp"
                                                    placeholder="Enter OTP" maxlength="6" pattern="\d{6}"
                                                    title="Please enter a 6-digit OTP" required>
                                                <span class="text-danger mb-2" id="otpError"></span>
                                                @error('otp')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="input-group" style="padding: 0px 10px">
                                                <button type="button" id="confirmOtpButton"
                                                    class="btn btn-primary btn-block">Confirm</button>
                                            </div>
                                        </div>
                                        <p class="text-success sussess-otp-match"></p>
                                    </div>
                                </form>

                                <form id="registerForm" action="#" method="post">
                                    <input type="hidden" name="email" class="hiddenemail" value="">
                                    <div class="col-12 mb-5">
                                        <div class="form-group mb-2 text-start">
                                            <label for="">Your Mobile</label>
                                            <input type="tel"
                                                class="form-control @error('phone') is-invalid @enderror"
                                                value="" name="phone"
                                                oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"placeholder="Your Mobile">
                                            <span class="text-danger mb-2">
                                                @error('phone')
                                                    {{ $message }}
                                                @enderror
                                            </span>

                                        </div>
                                    </div>
                                    <div class="col-12 mb-5">
                                        <div class="form-group mb-2 text-start">
                                            <label for="">Your Name</label>
                                            <input type="text"
                                                class="form-control @error('yourname') is-invalid @enderror"
                                                value="" name="yourname" placeholder="Your Name">
                                            <span class="text-danger mb-2">
                                                @error('yourname')
                                                    {{ $message }}
                                                @enderror
                                            </span>

                                        </div>
                                    </div>
                                    <div class="col-12 mb-5">
                                        <div class="form-group mb-2 text-start">
                                            <label for="">Password</label>
                                            <input type="password"
                                                class="form-control @error('password') is-invalid @enderror"
                                                value="" name="password" placeholder="Password">
                                            <span class="text-danger mb-2">
                                                @error('password')
                                                    {{ $message }}
                                                @enderror

                                            </span>
                                        </div>
                                    </div>
                                    <div class="input-group text-center" style="    margin: auto;">
                                        <button type="submit" id="registerFormButton"
                                            class="btn btn-primary btn-block">Submit</button>
                                    </div>
                                    <p class="text-success sussess-register"></p>
                                    {{-- <span class="text-danger mb-2" id="formerror"></span> --}}
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- Bootstrap Modal for Registration Success -->
<div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header" style="    padding-bottom: 30px;">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body text-center">
                <h2 class="modal-title" id="successModalLabel"><b>Thank You!</b></h2>
                <p class="sussess-register">Registration successful! Thank you for signing up.</p>
                <p>Click below to login and get started.</p>
                <a href="#" type="button" data-target="#loginmodal" data-toggle="modal"
                    class="btn btn-primary">Login</a>
            </div>

        </div>
    </div>
</div>

{{-- login  --}}
<div class="b-modal">
    <div class="modal fade in" id="loginmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="myModalLabel">Login</h4>
                </div>
                <div class="modal-body login-card-body">
                    <div class="login-box">
                        <div class="card">
                            <div class="card-body login-card-body">
                                <form id="loginForm" action="" method="post">
                                    <span class="text-danger" id="formerror"></span>
                                    <p class="text-success sussess-login"></p>
                                    <div class="col-12">
                                        <div class="form-group mb-2">
                                            <label for="emailpass">Your Email</label>
                                            <input type="email" class="form-control email-register" name="emaillogin" placeholder="Your Email">
                                            <span class="text-danger"></span>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group mb-2">
                                            <label for="passwordlogin">Password</label>
                                            <input type="password" class="form-control" name="passwordlogin" placeholder="Password">
                                            <span class="text-danger"></span>
                                        </div>
                                    </div>
                                    <p><a href="#">Forgot Password?</a></p>
                                    <div class="input-group" style="padding: 0px 10px; margin: auto;">
                                        <button type="submit" id="loginuser" class="btn btn-primary btn-block">Login</button>
                                    </div>
                                </form>
                                
                                
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> --}}
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script> --}}


</script>

