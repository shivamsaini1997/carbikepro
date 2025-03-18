<x-footer-main templateName="footermain" />

<script>
    $(document).ready(function () {
    var path = "{{ route('autocomplete') }}"; 
    var baseUrl = "{{ url('/') }}"; 

    $('input.typeahead').typeahead({
        source: function (query, process) {
            return $.get(path, { query: query }, function (data) {
                var results = data.map(function (item) {
                    return { name: item.product_name };
                });
                return process(results.map(item => item.name)); 
            });
        },
        afterSelect: function (name) {
            $.get(path, { query: name }, function (data) {
                const selectedProduct = data.find(item => item.product_name === name);
                if (selectedProduct) {
                    // Convert product_name to lowercase and replace spaces with hyphens
                    const formattedProductName = selectedProduct.product_name
                        .toLowerCase()
                        .replace(/\s+/g, '-');
                    const productUrl = `${baseUrl}/products/${formattedProductName}`;
                    window.location.href = productUrl;
                }
            });
        }
    });

    $('#autokeyword').on('keydown', function (event) {
        if (event.key === "Enter") {
            var searchValue = $(this).val();
            if (searchValue) {
                // Convert searchValue to lowercase and replace spaces with hyphens
                const formattedSearchValue = searchValue
                    .toLowerCase()
                    .replace(/\s+/g, '-');
                window.location.href = `${baseUrl}/search?query=${formattedSearchValue}`;
            }
        }
    });
});


    
$(document).ready(function() {
    // Generate OTP
    $('#getOtpButton').on('click', function() {
        const email = $('input[name="email"]').val();
        $('#emailError').text('');

        $.ajax({
            url: "{{ route('generate.otp') }}",
            method: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                email: email
            },
            success: function(response) {
                $('.sussess-otp').text(response.message);
                $('.opt-box').show();
                $('#getOtpButton').hide();
            },
            error: function(xhr) {
                if (xhr.responseJSON && xhr.responseJSON.errors) {
                    $('#emailError').text(xhr.responseJSON.errors.email[0]);
                } else {
                    $('#emailError').text('Error generating OTP.');
                }
            }
        });
    });

    // Verify OTP
    $('#confirmOtpButton').on('click', function() {
        const email = $('input[name="email"]').val();
        const otp = $('input[name="otp"]').val();
        $('#otpError').text('');

        $.ajax({
            url: "{{ route('verify.otp') }}",
            method: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                email: email,
                otp: otp
            },
            success: function(response) {
                $('.sussess-otp-match').text(response.message);
                $('.hiddenemail').val(email);
            },
            error: function(xhr) {
                $('#otpError').text(xhr.responseJSON.errors?.otp || xhr.responseJSON
                    .error || 'Error verifying OTP.');
                $('.hiddenemail').val('');
            }
        });
    });

    // Register Form Submission with AJAX
    $('#registerForm').on('submit', function(e) {
        e.preventDefault();

        $('.text-danger').text(''); // Clear previous errors
        $('.sussess-register').text(''); // Clear success message

        $.ajax({
            url: "{{ route('users.register') }}",
            method: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                email: $('input[name="email"]').val(),
                phone: $('input[name="phone"]').val(),
                yourname: $('input[name="yourname"]').val(),
                password: $('input[name="password"]').val(),
            },
            success: function(response) {
                $('.sussess-register').text(response.message);
                $('#successModal').modal('show');
                $('#myModal').modal('hide');
                $('#registerForm')[0].reset();
            },
            error: function(xhr) {
                if (xhr.responseJSON && xhr.responseJSON.errors) {
                    if (xhr.responseJSON.errors.email) {
                        $('input[name="email"]').siblings('.text-danger').text(xhr
                            .responseJSON.errors.email[0]);
                    }
                    if (xhr.responseJSON.errors.phone) {
                        $('input[name="phone"]').siblings('.text-danger').text(xhr
                            .responseJSON.errors.phone[0]);
                    }
                    if (xhr.responseJSON.errors.yourname) {
                        $('input[name="yourname"]').siblings('.text-danger').text(xhr
                            .responseJSON.errors.yourname[0]);
                    }
                    if (xhr.responseJSON.errors.password) {
                        $('input[name="password"]').siblings('.text-danger').text(xhr
                            .responseJSON.errors.password[0]);
                    }
                } else {
                    $('#formerror').text('An error occurred. Please try again.');
                }
            }
        });
    });

    $('#successModal').on('click', '.btn-primary', function(e) {
        e.preventDefault();
        $('#successModal').modal('hide');

        $('#successModal').on('hidden.bs.modal', function() {
            $('#loginmodal').modal('show');
        });
    });

    $('#loginForm').on('submit', function (e) {
            e.preventDefault();
            $('.text-danger').text('');
            $.ajax({
                url: "{{ route('users.login') }}",
                method: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    emaillogin: $('input[name="emaillogin"]').val(),
                    passwordlogin: $('input[name="passwordlogin"]').val(),
                },
                success: function (response) {
                    $('.sussess-login').text(response.message);
                    sessionStorage.setItem('loginSuccessMessage', response.message);
                    $('#loginForm')[0].reset();
                    $('#loginmodal').modal('hide');
                    location.reload();
                },
                error: function (xhr) {
                    if (xhr.responseJSON && xhr.responseJSON.errors) {
                        if (xhr.responseJSON.errors.emaillogin) {
                            $('input[name="emaillogin"]').siblings('.text-danger').text(xhr.responseJSON.errors.emaillogin[0]);
                        }
                        if (xhr.responseJSON.errors.passwordlogin) {
                            $('input[name="passwordlogin"]').siblings('.text-danger').text(xhr.responseJSON.errors.passwordlogin[0]);
                        }
                    } else {
                        $('#formerror').text('Invalid credentials. Please try again.');
                    }
                }
            });
        });

    // Show login success message after login
    const loginMessage = sessionStorage.getItem('loginSuccessMessage');
    if (loginMessage) {
        toastr.success(loginMessage);
        sessionStorage.removeItem('loginSuccessMessage');
    }

    // Show logout success message if present in the session
    @if(session('message'))
        toastr.success('{{ session('message') }}');
    @endif

    @if(session('error'))
        toastr.error('{{ session('error') }}');
    @endif
            
});



</script>