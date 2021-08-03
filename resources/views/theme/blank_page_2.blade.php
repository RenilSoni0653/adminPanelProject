<html>
    <head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js" integrity="sha512-37T7leoNS06R80c8Ulq7cdCDU5MNQBwlYoy1TX/WUsLFC2eYNqtKlV0QjH7r8JpG/S0GUMZwebnVFLPd6SU5yg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
            $(document).ready(function() {
                $('#formValidation').validate({
                    rules: {
                        fname: {
                            required: true,
                            minlength: 3
                        }, lname: {
                            required: true,
                            minlength: 3
                        }, email: {
                            function() {
                                $.atPos = $('#email').val().indexOf('@');
                                $.endPos = $('#email').val().indexOf('.');

                                if($.atPost <= 1 || $.endPos <= $.atPos) {
                                    $('#errEmail').html("<span style='color:red'>Enter Email-id correctly!!</span>");
                                } else {
                                    $('#errEmail').html('');
                                }
                            },
                        }, address: {
                            required: true,
                            minlength: 8
                        }, country: {
                            required: true,
                            minlength: 3
                        }, password: {
                            required: true,
                            minlength: 5
                        }, cpassword: {
                            required: function() {
                                $.pass = $('#password').val();
                                $.cpass = $('#cpassword').val();

                                if($.cpass == '') {
                                    return false;
                                } else {
                                    if($.cpass != $.pass) {
                                        $('.errCPass').html("<span style='color:red'>Password doesn't match</span>");   
                                    } else {
                                        $('.errCPass').html("<span style='color:red'>Credentials are correct</span>");
                                    }
                                }
                            }
                        }
                    }, messages: {
                        fname: {
                            required: "First name field is required"
                        }, lname: {
                            required: "Last name field is required"
                        }, email: {
                            email: "Email field is required"
                        }, address: {
                            required: "Address field is required"
                        }, country: {
                            required: "Country field is required"
                        }, password: {
                            required: "Password field is required"
                        }, cpassword: {
                            required: "Confirm Password field is required"
                        }
                    }
                });
            });
        </script>
        
        <style>
            .error {
                color: red;
            }
        </style>
    </head>

    <body>
        <div class="container pt-2 m-4">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="" id="formValidation">
                        <div class="form-group">
                            <label class="form-label mt-2 ml-3" for="name">Enter First - Name: </label>
                            <input type="text" class="form-control" name="fname" id="fname">
                            <div id="errFname"></div>
                            <span class="error"></span>
                        </div>

                        <div class="form-group">
                            <label class="form-label mt-2 ml-3" for="name">Enter Last - Name: </label>
                            <input type="text" class="form-control" name="lname" id="lname">
                            <div id="errLname"></div>
                            <span class="error"></span>
                        </div>

                        <div class="form-group">
                            <label class="form-label mt-2 ml-3" for="name">Enter Email: </label>
                            <input type="text" class="form-control" name="email" id="email">
                            <div id="errEmail"></div>
                        </div>

                        <div class="form-group">
                            <label class="form-label mt-3" for="password">Enter Address: </label>
                            <input type="text" class="form-control" name="address" id="address">
                            <div id="errAddress"></div>
                            <span class="error"></span>
                        </div>

                        <div class="form-group">
                            <label class="form-label mt-3" for="password">Enter Country: </label>
                            <input type="text" class="form-control" name="country" id="country">
                            <div id="errCountry"></div>
                            <span class="error"></span>
                        </div>

                        <div class="form-group">
                            <label class="form-label mt-3" for="password">Enter Password: </label>
                            <input type="password" class="form-control" name="password" id="password">
                            <div id="errPassword"></div>
                            <span class="error"></span>
                        </div>

                        <div class="form-group">
                            <label class="form-label mt-3" for="password">Enter Confirm Password: </label>
                            <input type="password" class="form-control" name="cpassword" id="cpassword">
                            <div id="errCPass"></span>
                            <span class="errCPass"></span>
                        </div>

                        <div id="allDetails"></div>
                        <span class="allDetails"></span>

                        <div class="form-group">
                            <button class="mt-3 mb-3 btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>
<!-- <script type="text/javascript">
            var divs = new Array();
            divs[0] = 'errFname';
            divs[1] = 'errLname';
            divs[2] = 'errEmail';
            divs[3] = 'errAddress';
            divs[4] = 'errCountry';
            divs[5] = 'errPassword';
            divs[6] = 'errCPass';

            var errors = new Array();
            errors[0] = "<span style='color:red'>Enter First-name correctly</span>";
            errors[1] = "<span style='color:red'>Enter Last-name correctly</span>";
            errors[2] = "<span style='color:red'>Enter Email-id correctly</span>";
            errors[3] = "<span style='color:red'>Enter Addresss correctly</span>";
            errors[4] = "<span style='color:red'>Enter Country correctly</span>";
            errors[5] = "<span style='color:red'>Enter Password</span>";
            errors[6] = "<span style='color:red'>Enter Confirm password</span>";

            var inputs = new Array();
            
            function myFunction() {
                inputs[0] = document.getElementById('fname').value;
                inputs[1] = document.getElementById('lname').value;
                inputs[2] = document.getElementById('email').value;
                inputs[3] = document.getElementById('address').value;
                inputs[4] = document.getElementById('country').value;
                inputs[5] = document.getElementById('password').value;
                inputs[6] = document.getElementById('cpassword').value;

                for(i in inputs) {
                    var input = inputs[i];
                    var error = errors[i];
                    var div = divs[i];

                    if(inputs[i] == 0) {
                        
                    } else if(inputs[i] == 1) {
                        document.getElementById(div).innerHTML = error;
                    } else if(i == 2) {
                        var atPos = inputs[i].indexOf('@');
                        var endPos = inputs[i].indexOf('.');

                        if(atPos < 1 || endPos <= atPos) {
                            document.getElementById('errEmail').innerHTML = error;    
                        } else {
                            document.getElementById(div).innerHTML = 'OK!!';
                        }
                    } else if(inputs[i] == 3) {
                        document.getElementById(div).innerHTML = error;
                    } else if(inputs[i] == 4) {
                        document.getElementById(div).innerHTML = error;
                    } else if(i == 6) {
                        var pass = document.getElementById('password').value;
                        var cpass = document.getElementById('cpassword').value;

                        if(cpass != pass) {
                            document.getElementById('errCPass').innerHTML = "Password doesn't match";
                        } else {
                            document.getElementById('errCPass').innerHTML = 'Password match!!';
                        }
                    } else {
                        document.getElementById(div).innerHTML = 'Ok!!';
                    }
                }
            }

            function FinalValidate() {
                var count = 0;
                for(i = 0; i < 7; i++) {
                    var error = errors[i];
                    var div = divs[i];

                    if(document.getElementById(div).innerHTML == 'Ok!!') {
                        count = count + 1;
                        if(count == 7) {
                            document.getElementById('allDetails').innerHTML = 'All Details are correct!!';
                        }
                    } else if(inputs[i] == '') {
                        document.getElementById('allDetails').innerHTML = error;
                    }
                }
            }
        </script> -->