<html>
    <head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

    
    <style>
        @media screen and (orientation: landscape), screen and (max-width: 500px) {
            #btn {
                border: 1px solid rgb(79, 185, 227);
            }
            #div1 {
                text-align: center;
            }
        }
        
        .error {
            color: red;
        }

    </style>
    </head>

    <body>
        <div class="container mt-4" style="border:1px solid">
            <p align="center">HAPPY COFFEE CENTER</p>
                <div class="form-group">
                    <label for="selForCoffee" class="form-label">Select Coffee cup size: </label>
                        <select class="form-control js-example-basic-multiple" id="selCoffee" name="selCoffee[]" multiple="multiple">
                            <option name="small" value="100"> Small</option>
                            <option name="medium" value="200"> Medium</option>
                            <option name="large" value="300"> Large</option>
                        </select>
                        <div id="success"></div>
                </div>

                <label class="form-label">Enter Quantity: </label>
                <form id="FormValidate">
                    @csrf
                    <div class="form-group">
                        <input type="number" class="form-control" id="qty" name="qty">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Total Amount: </label>
                    </div>
                    <div class="form-group mb-4">
                        <input type="text" class="form-control" id="calMoney" readonly>
                    </div>
                </form>
            </div>
        </body>
    </html>

    <script type="text/javascript">
        $(document).ready(function() {

            $('#selCoffee').change(function() {
                var CoffeeName = $('#selCoffee').val();
                $.ajax({
                    type: "POST",
                    url: '{{ route('blank_page_1.addData') }}?type=' + CoffeeName,

                    success: function(res) {
                        $('#success').append('Data send successfully');
                    }
                });
            });

            $('.js-example-basic-multiple').select2({
                placeholder: 'Select type of Coffee',
                maximumSelectionLength: 5
            });
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#selForCoffee').change(function() {
                var count = $('#selForCoffee').val();
                $('#qty').change(function() {
                    var qty = $('#qty').val();

                    if(qty < 1 || qty > 5) {
                        $('#FormValidate').validate({
                            rules: {
                                qty : {
                                    min: 1,
                                    max: 5,
                                    required: true
                                }
                            },
                            messages: {
                                qty: {
                                    required: "Invalid Quantity"
                                }
                            }
                        });
                        $('#calMoney').val('NaN');
                    } else if(qty >= 1 || qty <= 5) {
                        var FinalPrice = count * qty;
                        $('#calMoney').val(FinalPrice);
                    }
                });
            });
        });
    </script>

    <script type="text/javascript">
        $.ajaxSetup({
            headers: { 
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function() {
            $('#btn').click(function(e) {
                e.preventDefault();

                var name = $('#name').val();
                var email = $('#email').val();
                var password = $('#password').val();

                var num1 = $('#sel1').children("option").filter(':selected').text();
                var num2 = $('#sel2').children("option").filter(':selected').text();
                var num3 = $('#sel3').children("option").filter(':selected').text();

                $.ajax({
                    type: "POST",
                    url: "{{ route('Test') }}",
                    success: function(res) {
                        $('#demo').html('Name: ' + name + '<br>' + 'Email: ' + email + '<br>' + 'Password: ' + password
                        + '<br>' + 'Number 1: ' + num1 + '<br>' + 'Number 2: ' + num2 + '<br>' + 'Number 3: ' + num3);
                    }
                });
            });
        });

        $(document).ready(function() {
            $('#sel1').change(function() {
                var id = $('#sel1').val();
                $.ajax({
                    type: "POST",
                    url: "{{ route('blank_page_1') }}?id= " + id,
                    success: function(res) {
                        if(res) {
                            $('#sel2').empty();
                            $('#sel3').empty();
                            $('#sel2').append('<option> ---------- Select Number 2 ---------- </option>');
                            $.each(res, function(key, value) {
                                $('#sel2').append('<option value="' + value.id + '">'+ value.text +'</option>');
                                $('#sel3').empty();
                            });
                        } else {
                            $('#sel2').empty();
                            $('#sel3').empty();
                        }
                    }
                });
            });

            $('#sel2').change(function() {
                var id = $('#sel2').val();
                $.ajax({
                    type: "POST",
                    url: "{{ route('blank_page_2') }}?id= " + id,
                    success: function(res) {
                        if(res) {
                            $('#sel3').empty();
                            $('#sel3').append('<option> ---------- Select Number 3 ---------- </option>');
                            $.each(res, function(key, value) {
                                $('#sel3').append('<option value="' + value.id + '">'+ value.text +'</option>');
                            });
                        } else {
                            $('#sel3').empty();
                        }
                    }
                });
            });
        });
    </script>