<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Register</title>
    <style>
        #exampleFirstName-error {
            padding-top: 8px;
            padding-left: 20px;
            font-size: 18px;
            color: red;        
        }
        
        #exampleFirstName {
            width: 100%
        }

        #exampleLastName-error {
            padding-top: 8px;
            padding-left: 20px;
            font-size: 18px;
            color: red;        
        }

        #exampleLastName {
            width: 100%
        }
        
        #exampleInputEmail-error {
            padding-top: 8px;
            padding-left: 20px;
            font-size: 18px;
            color: red;        
        }

        #exampleInputEmail {
            width: 100%;        
        }
        
        #exampleInputPassword-error {
            padding-top: 8px;
            padding-left: 20px;
            font-size: 18px;
            color: red;        
        }

        #exampleInputPassword {
            width: 100%;        
        }
        
        #exampleRepeatPassword-error {
            padding-top: 8px;
            padding-left: 20px;
            font-size: 18px;
            color: red;        
        }
        #re_password_error {
            padding-top: 8px;
            padding-left: 20px;
            font-size: 18px;
            color: red;
        }
    </style>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('theme/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('theme/css/sb-admin-2.min.css') }}" rel="stylesheet">
</head>

<body class="bg-gradient-primary">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                                @error('re-password')
                                    {{ $message }}
                                @enderror
                            </div>

                            <form class="user" id="register_user" method="POST" action="{{ url('account') }}">
                                @csrf
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" name="first_name" aria-describedby="firstNameHelp" class="form-control form-control-user" id="exampleFirstName"
                                            placeholder="First Name">
                                            @error('first_name')
                                                <div class="alert alert-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                    </div>
                                    
                                    <div class="col-sm-6">
                                        <input type="text" name="last_name" class="form-control form-control-user" id="exampleLastName"
                                            placeholder="Last Name">
                                            @error('last_name')
                                                    <div class="alert alert-danger">
                                                        {{ $message }}
                                                    </div>
                                            @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="email" name="email" class="form-control form-control-user" id="exampleInputEmail"
                                        placeholder="Email Address">
                                        @error('email')
                                            <div class="alert alert-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" name="password" class="form-control form-control-user"
                                            id="exampleInputPassword" placeholder="Password">
                                            @error('password')
                                                <div class="alert alert-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" name="re_password" class="form-control form-control-user"
                                            id="exampleRepeatPassword" placeholder="Repeat Password">
                                            <div id="re_password_error"></div>
                                    </div>
                                </div>
                                <button class="btn btn-primary btn-user btn-block">
                                    Register Account
                                </button>
                                </form>
                                <hr>
                                <a href="index.html" class="btn btn-google btn-user btn-block">
                                    <i class="fab fa-google fa-fw"></i> Register with Google
                                </a>
                                <a href="index.html" class="btn btn-facebook btn-user btn-block">
                                    <i class="fab fa-facebook-f fa-fw"></i> Register with Facebook
                                </a>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="{{ route('login') }}">Already have an account? Login!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('theme/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('theme/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('theme/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('theme/js/sb-admin-2.min.js') }}"></script>

    <!-- Register jQuery-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js" integrity="sha512-37T7leoNS06R80c8Ulq7cdCDU5MNQBwlYoy1TX/WUsLFC2eYNqtKlV0QjH7r8JpG/S0GUMZwebnVFLPd6SU5yg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $('.user').validate({
                    rules: {
                        first_name : {
                            required: true
                        },
                        last_name : {
                            required: true
                        },
                        email : {
                            required: true,
                            email: true
                        },
                        password : {
                            required: true
                        },
                        re_password: {
                            function() {
                                $.password = $('#exampleInputPassword').val();
                                $.rePassword = $('#exampleRepeatPassword').val();

                                if($.password != $.rePassword) {
                                    $('#re_password_error').html("Password doesn't match");
                                } else {
                                    $('#re_password_error').html('');
                                }
                            }                            
                        }
                    },
                    messages: {
                        first_name : {
                            required: "First Name is missing"
                        },
                        last_name : {
                            required: "Last Name is missing"
                        },
                        email : {
                            required: "Email id is missing"
                        },
                        password : {
                            required: "Password is missing"
                        }
                    }
                });
            });
    </script>
</body>

</html>