<html>
    <head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <style>
        @media screen and (orientation: landscape), screen and (max-width: 500px) {
            #btn {
                border: 1px solid rgb(79, 185, 227);
            }
            #div1 {
                text-align: center;
            }
        }
    </style>
    </head>

    <body>
        <div class="container mt-4" style="border:1px solid">
            <div class="row pt-4">
            <form>
                @csrf
                <div class="form-group">
                    <label class="form-label">Enter Name: </label>
                        <input type="text" id="name" name="name" class="form-control">
                </div>
                <div class="form-group pt-4">
                    <label class="form-label">Enter Email: </label>
                        <input type="email" id="email" name="email" class="form-control">
                </div>
                <div class="form-group pt-4">
                    <label class="form-label">Enter Password: </label>
                        <input type="password" id="password" name="password" class="form-control">
                </div>
                <div class="form-group pt-4">
                    <label class="form-label">Select Number 1: </label>
                    <select name="sel1" id="sel1" style="width:1116px">
                        <option> ---------- Select Number 1 ---------- </option>                        
                        @foreach($data as $allData)
                            <option value="{{ $allData->id }}">{{ $allData->text }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group pt-4">
                    <label class="form-label">Select Number 2: </label>
                    <select name="sel2" id="sel2" style="width:1116px">                        
                    </select>
                </div>
                <div class="form-group pt-4">
                    <label class="form-label">Select Number 3: </label>
                    <select name="sel3" id="sel3" style="width:1116px">                        
                    </select>
                </div>
                <div class="form-group pt-4">
                    <button class="btn btn-primary" id="btn" name="btn">Submit</button>
                </div>
            </form>
            </div>
        </div>

        <div class="container mt-4 mb-4" style="border:1px solid">
            <div class="row">
                <p id="demo" style="padding:10px;"></p>
            </div>
        </div>

    </body>
</html>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
