@extends('layouts.theme_app')

@section('content')
<style>
    #exampleInputEmail-error {
        padding-top: 8px;
        padding-left: 20px;
        font-size: 18px;
    }

    #exampleInputPassword-error {
        padding-top: 8px;
        padding-left: 20px;
        font-size: 18px;
    }

    #exampleInputEmail {
        width: 340px;
    }

    #exampleInputPassword {
        width: 340px;
    }

    .error {
        color: red;
    }
</style>
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
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
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

                                    <form class="user" action="{{ url('home') }}" method="POST">
                                    @csrf
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="Enter Email Address..." name="email">
                                                <div class="error"></div>
                                                @error('email')
                                                    <div class="alert alert-danger">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                                id="exampleInputPassword" placeholder="Password" name="pwd">
                                                <div class="error"></div>
                                                @error('password')
                                                    <div class="alert alert-danger">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Remember Me</label>
                                            </div>
                                        </div>
                                        <button class="btn btn-primary btn-user btn-block">
                                            Login
                                        </button>
                                        </form>
                                        <hr>
                                        <a href="{{ asset('theme/index.html') }}" class="btn btn-google btn-user btn-block">
                                            <i class="fab fa-google fa-fw"></i> Login with Google
                                        </a>
                                        <a href="index.html" class="btn btn-facebook btn-user btn-block">
                                            <i class="fab fa-facebook-f fa-fw"></i> Login with Facebook
                                        </a>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="{{ route('Forgot-password') }}">Forgot Password?</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="{{ route('register') }}">Create an Account!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
    
    <!-- Register jQuery-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js" integrity="sha512-37T7leoNS06R80c8Ulq7cdCDU5MNQBwlYoy1TX/WUsLFC2eYNqtKlV0QjH7r8JpG/S0GUMZwebnVFLPd6SU5yg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $('.user').validate({
                    rules: {
                        email : {
                            required: true,
                            email: true
                        },
                        pwd : {
                            required: true,
                        }
                    },
                    messages: {
                        email : {
                            required: "Enter valid email-id"
                        },
                        pwd : {
                            required: "Enter corerct password"
                        }
                    }
                });
            });
    </script>
@endsection('content')