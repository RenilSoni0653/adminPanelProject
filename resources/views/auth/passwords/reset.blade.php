@extends('layouts.theme_app')

@section('content')
<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Reset Your Password</h1>
                                    </div>
                                    @if(session()->has('success'))
                                    <div class="alert alert-success">
                                        {{ session()->get('success') }}
                                    </div>
                                    @elseif(session()->get('error'))
                                    <div class="alert alert-danger">
                                        <div>{{ session()->get('error') }}</div>
                                    </div>
                                    @endif
                                        <form method="POST" class="user" action="{{ url('password/reset') }}">
                                            @csrf
                                            <input type="hidden" name="token" value="{{ $token }}">
                                            <input type="hidden" name="email" value="{{ $email }}">
                                            <div class="form-group row">
                                                <div class="col-md-6">
                                                    <input id="password" placeholder="Enter Password" type="password" style="border-radius:20px; width:340px;"  class="form-control @error('password') is-invalid @enderror" name="password" >
                                                    @error('password')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <div class="col-md-6">
                                                    <input id="password-confirm" placeholder="Enter Confirm Password" style="border-radius:20px; width:340px;" type="password" class="form-control" name="password_confirmation">
                                                    <div id="error" style="color:red"></div>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group mb-0">
                                                <button type="submit" style="border-radius: 20px; width: 340px;" class="btn btn-primary">
                                                    {{ __('Reset Password') }}
                                                </button>
                                            </div>
                                        </form>
                                        <hr>
                                        <a href="{{ asset('theme/index.html') }}" class="btn btn-google btn-user btn-block">
                                            <i class="fab fa-google fa-fw"></i> Login with Google
                                        </a>
                                        <a href="index.html" class="btn btn-facebook btn-user btn-block">
                                            <i class="fab fa-facebook-f fa-fw"></i> Login with Facebook
                                        </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
    #password-error {
        padding-top: 8px;
        padding-left: 20px;
        font-size: 16px;
        color: red;
    }
    #password {
        font-size: 16px;
    }
    #password-confirm {
        font-size: 16px;
    }
    </style>

    <!-- Forgot-password jQuery-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js" integrity="sha512-37T7leoNS06R80c8Ulq7cdCDU5MNQBwlYoy1TX/WUsLFC2eYNqtKlV0QjH7r8JpG/S0GUMZwebnVFLPd6SU5yg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript">
    $(document).ready(function() {
        $('.user').validate({
            rules: {
                password : {
                    required: true,
                },
                password_confirmation : {
                    function() {
                        $.password = $('#password').val();
                        $.rePassword = $('#password-confirm').val();

                        if($.password != $.rePassword) {
                            $('#error').html("Password doesn't match");
                        } else {
                            $('#error').html('');
                        }
                    }
                }
            },
            messages: {
                password: {
                    required : 'Password is missing'
                }
            }
        });
    });
    </script>
@endsection('content')