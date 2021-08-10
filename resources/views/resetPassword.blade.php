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

                                    <form class="user" action="{{ url('updatePassword') }}" method="POST">
                                    @csrf
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                                id="exampleInputPassword" aria-describedby="passwordHelp"
                                                placeholder="Enter new password" name="password">
                                                @error('password')
                                                    <div class="alert alert-danger">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                                id="exampleInputRePassword" placeholder="Enter confirm password" name="repassword">
                                                <div id="error"></div>
                                                @error('repassword')
                                                <div class="alert alert-danger">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                        </div>
                                        <button class="btn btn-primary btn-user btn-block">
                                            Reset
                                        </button>
                                        <input type="hidden" value="{{$email}}" name="email">
                                        <input type="hidden" value="{{$token}}" name="Token">
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
    #exampleInputPassword-error {
        padding-top: 8px;
        padding-left: 20px;
        font-size: 18px;
        color: red;        
    }
    #exampleInputPassword {
        width: 340px;        
    }
    #exampleInputRePassword-error {
        padding-top: 8px;
        padding-left: 20px;
        font-size: 18px;
        color: red;        
    }
    #exampleInputRePassword {
        width: 340px;        
    }
    #error {
        padding-left: 20px;
        color: red;
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
                    repassword : {
                        function() {
                            $.password = $('#exampleInputPassword').val();
                            $.rePassword = $('#exampleInputRePassword').val();

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