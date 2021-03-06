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
                    <h1 class="h3 mb-2 text-gray-800">Tables</h1>
    
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <p><a href="{{ url('tables/create') }}" class="btn btn-primary btn-user">Add Data</a>  |  
                                <a href="{{ url('tables/trash') }}" class="btn btn-primary btn-user">Show Deleted Data</a></p>
                        </div>
                        
                        @if(session()->has('success'))
                            <div class="alert alert-success">
                                {{ session()->get('success') }}
                            </div>
                        @endif

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Position</th>
                                            <th>Office</th>
                                            <th>Age</th>
                                            <th>Start date</th>
                                            <th>Salary</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>

                                    <tfoot>
                                        <tr>
                                            <th>Name</th>
                                            <th>Position</th>
                                            <th>Office</th>
                                            <th>Age</th>
                                            <th>Start date</th>
                                            <th>Salary</th>
                                            <th>Actions</th>
                                        </tr>
                                    </tfoot>

                                    <tbody>
                                        @foreach($data as $allData)
                                            @if($allData->deleted_at == NULL)
                                                @if(auth()->user()->id == $allData->user_id)
                                                    <tr>
                                                        <td>{{ $allData->name }}</td>
                                                        <td>{{ $allData->position }}</td>
                                                        <td>{{ $allData->office }}</td>
                                                        <td>{{ $allData->age }}</td>
                                                        <td>{{ $allData->start_date }}</td>
                                                        <td>{{ $allData->salary }}</td>
                                                        <td>        
                                                            <form method="POST" action="{{ url('tables/'.$allData->id) }}">
                                                            @csrf
                                                                @method('DELETE')
                                                                    <a href="{{ url('tables/'.$allData->id.'/edit') }}" class="btn btn-primary" data-toggle="editButton" id="editButton" data-target="editButton">Edit</a> | 
                                                                    <button class="btn btn-primary" onClick="return confirm('Are you sure do you want to delete?')">Trash</button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @endif
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->

            <!-- Start of Modal Popup-->
            <div class="modal fade" id="mediumModal" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content" style="width:800px; margin-left:-100px">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="mediumBody" style="width:800px">
                        <div>
                            <!-- the result to be displayed apply here -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End of Modal Popup -->

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

    <!-- Script for Modal Popup -->
    <script>
        $('#editButton').click(function() {
            event.preventDefault();
            let href= $(this).attr('href');

            $.ajax({
                url: href,
                beforeSend: function() {
                    $('#loader').show();
                },
                success: function(result) {
                    $('#mediumModal').modal('show');
                    $('#mediumBody').html(result).show();
                },
                complete: function() {
                    $('#loader').hide();
                }
            });
        });
    </script>
@endsection