<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Script for maps-->
    
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <link rel="stylesheet" type="text/css" href="./style.css" />
    <script src="./index.js"></script>

    <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDq6XC1QCQ8YBLcurvas6jaMY62Mg_jCSU&callback=initMap&libraries=&v=weekly"
      async
    ></script>

    <script>
        let map;

        function initMap() {
        map = new google.maps.Map(document.getElementById("map"), {
            center: { lat: -34.397, lng: 150.644 },
            zoom: 5,
        });
        }
    </script>

    <style>
        /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
        #map {
            height: 100%;
        }

        /* Optional: Makes the sample page fill the window. */
        html,
        body {
            height: 100%;
            margin: 0;
            padding: 0;
        }
    </style>
    <!-- end script of maps -->

    <!-- starting of editor -->
        <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
        <script>
        tinymce.init({ 
                selector:'textarea'
            });
        </script>
    <!-- End of Editor -->

    <!-- SB 2 admin panel -->
    
    <link href="{!! asset('theme/vendor/fontawesome-free/css/all.min.css') !!}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <!-- End of SB 2 admin panel-->

    <!-- start script of dropzone-->
    
  <!-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>  
    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.0.1/min/dropzone.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.2.0/min/dropzone.min.js"></script> -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/dropzone.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/min/dropzone.min.css">
    
    <script type="text/javascript">
    $(document).ready(function() {
        Dropzone.options.dropzone =
         {
            maxFilesize: 12,
            acceptedFiles: ".jpeg,.jpg,.png,.gif",
            addRemoveLinks: true,

            renameFile: function(file) {
                var name = file.name;
                
                $.ajax ({
                    url: '{{ url("images/upload/store") }}',
                    method: 'POST',
                    data: {'name':name},
                    dataType: 'JSON',
                    contentType:'multipart/form-data',
                    processData: false,
                    success: function (file, response) {
                        console.log("File has been successfully stored!!");
                    }
                });
            }  
        };
    });
    </script>

    <!-- End of dropzone -->

    <!-- Custom styles for this template-->
    <link href="{!! asset('theme/css/sb-admin-2.min.css') !!}" rel="stylesheet">

    <!-- End of SB 2 admin panel -->

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- SB 2 adminPanel-->
    <link href="{!! asset('theme/vendor/fontawesome-free/css/all.min.css') !!}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{!! asset('theme/css/sb-admin-2.min.css') !!}" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="{!! asset('theme/vendor/datatables/dataTables.bootstrap4.min.css') !!}" rel="stylesheet">
    
    <!-- End of SB 2 adminPanel-->

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <main class="py-4">
        @yield('content')
    </main>
</body>
</html>
