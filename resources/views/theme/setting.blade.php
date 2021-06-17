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
                    <h1 class="h3 mb-2 text-gray-800">Account Information</h1>
    
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                        <!-- -->
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ url('account/'.auth()->user()->id) }}">
                            @csrf
                            @method('DELETE')

                            <!-- User Form -->    
                            <label>Name : </label>
                            <input type="text" class="form-control form-control-user" id="exampleName" aria-describedby="nameHelp" placeholder="Enter name" name="username" value="{{ $record->fname }}" readonly><br>
                            @error('username')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror

                            <label>Email-id : </label>
                            <input type="text" class="form-control form-control-user" id="exampleEmail" aria-describedby="emailHelp" placeholder="Enter email-id" name="email" value="{{ $record->email }}" readonly><br>
                            @error('email')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror

                            <div class="card-header py-3">
                                <input type="hidden" name="id" value="{{ auth()->user()->id }}">
                                <button class="btn btn-danger btn-user" onClick="ConfirmDelete()">Delete Account</button>
                            </div>

                        </form>
                        <!-- End of User Form -->
                        </div>
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

    <!-- Delete confirmation script -->
    <script>
        function ConfirmDelete() {
            var x = confirm('Are you sure to delete account?');
            if(x) {
                return true;
            } else {
                return false;
            }
        }
    </script>
@endsection