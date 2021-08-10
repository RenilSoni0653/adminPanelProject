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
                    <h1 class="h3 mb-2 text-gray-800">Add Data</h1>
    
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <form method="POST" id="formValidate" action="{{ route('tables.store') }}">
                            @csrf
                            <!-- User Form -->    
                            <label>Name: </label>
                            <input type="text" class="form-control form-control-user" id="exampleName" aria-describedby="nameHelp" placeholder="Enter name" name="name"><br>
                            @error('name')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror

                            <label>Position: </label>
                            <input type="text" class="form-control form-control-user" id="examplePosition" aria-describedby="positionHelp" placeholder="Enter position" name="position"><br>
                            @error('position')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror

                            <label>Office: </label>
                            <input type="text" class="form-control form-control-user" id="exampleOffice" aria-describedby="officeHelp" placeholder="Enter office location" name="office"><br>
                            @error('office')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror

                            <label>Age: </label>
                            <input type="number" class="form-control form-control-user" id="exampleAge" aria-describedby="ageHelp" placeholder="Enter age" name="age"><br>
                            @error('age')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror

                            <label>Start date: </label>
                            <input type="date" class="form-control form-control-user" id="exampleDate" aria-describedby="dateHelp" placeholder="Populate today's date" name="start_date"><br>
                            @error('start_date')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror

                            <label>Salary: </label>
                            <input type="text" class="form-control form-control-user" id="exampleSalary" aria-describedby="salaryHelp" placeholder="Enter Salary" name="salary"><br>
                            @error('salary')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror

                            <div class="card-header py-3">
                                <input type="hidden" name="id" value="{{ auth()->user()->id }}">
                                <button class="btn btn-primary btn-user">Add Data</button> | 
                                <a href="{{ url('tables/index') }}" class="btn btn-primary btn-user">Back</a>
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

    <!-- jQuery Validations -->
    <style>
        #exampleName {
            width: 100%;
            font-size: 20px;
        }
        #exampleName-error {
            padding-top: 8px;
            padding-left: 5px;
            font-size: 16px;
            color: red;
        }
        #examplePosition {
            width: 100%;
            font-size: 20px;
        }
        #examplePosition-error {
            padding-top: 8px;
            padding-left: 5px;
            font-size: 16px;
            color: red;
        }
        #exampleOffice {
            width: 100%;
            font-size: 20px;
        }
        #exampleOffice-error {
            padding-top: 8px;
            padding-left: 5px;
            font-size: 16px;
            color: red;
        }
        #exampleAge {
            width: 100%;
            font-size: 20px;
        }
        #exampleAge-error {
            padding-top: 8px;
            padding-left: 5px;
            font-size: 16px;
            color: red;
        }
        #exampleDate {
            width: 100%;
            font-size: 20px;
        }
        #exampleDate-error {
            padding-top: 8px;
            padding-left: 5px;
            font-size: 16px;
            color: red;
        }
        #exampleSalary {
            width: 100%;
            font-size: 20px;
        }
        #exampleSalary-error {
            padding-top: 8px;
            padding-left: 5px;
            font-size: 16px;
            color: red;
        }
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js" integrity="sha512-37T7leoNS06R80c8Ulq7cdCDU5MNQBwlYoy1TX/WUsLFC2eYNqtKlV0QjH7r8JpG/S0GUMZwebnVFLPd6SU5yg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#formValidate').validate({
                rules: {
                    name: {
                        required: true
                    },
                    position: {
                        required: true
                    },
                    office: {
                        required: true
                    },
                    age: {
                        required: true
                    },
                    start_date: {
                        required: true
                    },
                    salary: {
                        required: true
                    }
                },
                messages: {
                    name: {
                        required: "Name input field is missing"
                    },
                    position: {
                        required: "Position input field is missing"
                    },
                    office: {
                        required: "Office input field is missing"
                    },
                    age: {
                        required: "Age input field is missing"
                    },
                    start_date: {
                        required: "Start date input field is missing"
                    },
                    salary: {
                        required: "Salary input field is missing"
                    }
                }
            });            
        });
    </script>
@endsection