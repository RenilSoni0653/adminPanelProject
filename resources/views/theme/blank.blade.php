<html>
    <head>
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> -->
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    </head>

    <body>
        <div class="container">
            <form>
                @csrf
                <p id="demo"></p>
                <div class="form-group">
                    <label class="form-label">Enter Name: </label>
                        <input type="text" name="name" class="form-control">
                </div>
                <div class="form-group">
                    <label class="form-label">Enter Email: </label>
                        <input type="email" name="email" class="form-control">
                </div>
                <div class="form-group">
                    <label class="form-label">Enter Password: </label>
                        <input type="password" name="password" class="form-control">
                </div><br>
                <div class="form-control">
                    <button class="btn btn-primary" id="btn" name="btn">Submit</button>
                </div>
            </form>
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

            var name = $('input[name=name]').val();
            var email = $('input[name=email]').val();
            var password = $('input[name=password]').val();

            $.ajax({
                type: "POST",
                url: '{{ route('Test') }}',
                data: {name: name, email: email, password: password},
                success: function(data) {
                    $('#demo').append('Data is: ' + data);
                }
            });
        });
    });
</script>
