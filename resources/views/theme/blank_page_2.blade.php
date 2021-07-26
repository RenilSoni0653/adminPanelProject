<html>
    <head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script type="text/javascript">
            var divs = new Array();
            divs[0] = "errFirst";
            divs[1] = "errEmail";
            divs[2] = "errPassword";
            divs[3] = "errCPassword";

            var errors = new Array();
            errors[0] = "<span style='color:red'>Enter Name correctly!!</span>";
            errors[1] = "<span style='color:red'>Enter Email correctly!!</span>";
            errors[2] = "<span style='color:red'>Enter password correctly!!</span>";
            errors[3] = "<span style='color:red'>Enter confirm password correctly!!</span>";

            var inputs = new Array();

            function validate() {
                inputs[0] = document.getElementById('name').value;
                inputs[1] = document.getElementById('email').value;
                inputs[2] = document.getElementById('password').value;
                inputs[3] = document.getElementById('cpassword').value;

                for(i in inputs) {
                    var div = divs[i];
                    var errorMsg = errors[i];

                    if(inputs[i] == 0) {
                        document.getElementById(div).innerHTML = errorMsg;
                    } else if(i == 1) {
                        var atPos = inputs[i].indexOf('@');
                        var endPos = inputs[i].lastIndexOf('.');

                        if(atPos < 1 || endPos < atPos + 2 || endPos + 2 >= inputs[i].length) {
                            document.getElementById(div).innerHTML = "<span style='color:red'>Enter Email-id correctly!!</span>";
                        } else {
                            document.getElementById(div).innerHTML = "Correct!!";
                        }
                    } else if(i == 3) {
                        var first = document.getElementById('password').value;
                        var second = document.getElementById('cpassword').value;

                        if(second == first) {
                            document.getElementById(div).innerHTML = "Correct!!";
                            
                        } else {
                            document.getElementById('errCPassword').innerHTML = errorMsg;
                        }
                    } else {
                        document.getElementById(div).innerHTML = "Correct!!";
                    }
                }
            }

            function FinalValidation() {
                var count = 0;

                for(i = 0; i < 4; i++) {
                    var div = divs[i];
                    var errorMsg = errors[i];
                    var input = inputs[i];
                    
                    if(document.getElementById(div).innerHTML == 'Correct!!')
                        count = count + 1;
                    if(count == 4) {
                        document.getElementById('allDetails').innerHTML = "<br> All details are correct";
                    } else if(inputs[i] == ''){
                        document.getElementById('allDetails').innerHTML = '<br>'  + errorMsg;
                    }
                }
            }
        </script>
    </head>

    <body>
        <div class="container pt-2 m-4">
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <label class="form-label mt-2 ml-3" for="name">Enter Name: </label>
                        <input type="text" class="form-control" name="name" id="name" onkeyup="validate()">
                        <div id="errFirst"></div>
                    </div>

                    <div class="form-group">
                        <label class="form-label mt-3" for="email">Enter Email: </label>
                        <input type="email" class="form-control" name="email" id="email" onkeyup="validate()">
                        <div id="errEmail"></div>
                    </div>

                    <div class="form-group">
                        <label class="form-label mt-3" for="password">Enter Password: </label>
                        <input type="password" class="form-control" name="password" id="password" onkeyup="validate()">
                        <div id="errPassword"></div>
                    </dv>

                    <div class="form-group">
                        <label class="form-label mt-3" for="confirm-password">Enter Confirm Password: </label>
                        <input type="password" class="form-control" name="cpassword" id="cpassword" onkeyup="validate()">
                        <div id="errCPassword"></div>
                    </div>

                    <div id="allDetails" onkeyup="validate()"></div>

                    <div class="form-group">
                        <button class="mt-3 mb-3 btn btn-primary" onClick="validate(); FinalValidation();">Submit</button>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </body>
</html>