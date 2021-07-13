@extends('layouts.theme_app')

@section('content')
<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        @include('theme.sidebar')
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                @include('theme.topbar')
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Dropdown</h1>
    
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <p><!-- --></p>
                        </div>

                        @if(session()->has('success'))
                        <div class="alert alert-success">
                            {{ session()->get('success') }}
                        </div>
                        @endif
                        
                        <form method="POST" action="{{ url('dropdown/store/'.auth()->user()->id) }}">
                            @csrf
                            <div class="card-body">
                                <label for="country">Enter Country:  </label>
                                    <select id="country" name="country" class="form-control" style="width:250px">
                                        <option value="" selected disabled>Select Country</option>
                                            @foreach($countries as $key => $country)
                                                <option value="{{$country->id}}"> {{$country->name}}</option>
                                            @endforeach
                                    </select><br>

                                <label for="state">Select State:</label>
                                <select id="state" name="state" class="form-control"style="width:250px"></select><br>

                                <label for="city">Select City:</label>
                                <select id="city" name="city" class="form-control"style="width:250px"></select><br>

                                <div>
                                    <button class="btn btn-primary">Save</button>
                                </div>

                            </div>
                        </form>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2020</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Bootstrap core JavaScript-->
    <script src="{!! asset('theme/vendor/jquery/jquery.min.js') !!}"></script>
    <script src="{!! asset('theme/vendor/bootstrap/js/bootstrap.bundle.min.js') !!}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{!! asset('theme/vendor/jquery-easing/jquery.easing.min.js') !!}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{!! asset('theme/js/sb-admin-2.min.js') !!}"></script>

    <!-- Page level plugins -->
    <script src="{!! asset('theme/vendor/datatables/jquery.dataTables.min.js') !!}"></script>
    <script src="{!! asset('theme/vendor/datatables/dataTables.bootstrap4.min.js') !!}"></script>

    <!-- Page level custom scripts -->
    <script src="{!! asset('theme/js/demo/datatables-demo.js') !!}"></script>

    <!-- Script for dropdown -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript">
        $('#country').change(function() {
            var countryID = $(this).val();
            if(countryID) {
                $.ajax({
                    type: "GET",
                    url: "{{ url('dropdown/getStates') }}?country_id="+countryID,
                    success: function(res) {
                        if(res) {
                            $('#state').empty();
                            $('#state').append('<option>Select State</optiom>');
                            $.each(res, function(key, value) {
                                console.log(value.id);
                                $('#state').append('<option value="'+ value.id +'">'+ value.name +'</option>');
                            });
                        } else {
                            $('#state').empty();
                        }
                    }
                });
            } else {
                $('#state').empty();
                $('#city').empty();
            }
        
        $('#state').change(function() {
            var stateID = $(this).val();
            if(stateID) {
                $.ajax({
                    type: "GET",
                    url: "{{ url('dropdown/getCities') }}?state_id="+stateID,
                    success: function(res) {
                        if(res) {
                            $('#city').empty();
                            $('#city').append('<option>Select City</option>');
                            $.each(res, function(key, value) {
                                $('#city').append('<option value="'+ value.id +'">'+ value.name +'</option>');
                            });
                        } else {
                            $('#city').empty();
                        }
                    }
                });
            } else {
                $('#city').empty();
            }
        });
    });
    </script>
@endsection