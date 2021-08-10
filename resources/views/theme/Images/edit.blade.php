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
                    <h1 class="h3 md-2 text-gray-800">Edit Image(s)</h1>
    
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        @if(session()->has('success'))
                        <div class="card-header py-3">
                            <div class="alert alert-success">
                                {{ session()->get('success') }}
                            </div>
                        </div>
                        @endif
                        <img src="" id="img_edit" style="border-radius:35px; width:126px; height:126px; margin-right: 795px">
                                            
                        <form action="{{ url('images/'.$images->id.'/update') }}" method="POST" enctype="multipart/form-data" class="dropzone" id="dropzone">
                            @csrf
                            <div class="card-body"">
                                <div class="table-responsive">
                                        <div class="form-controller">
                                            <div class="dz-message">
                                                </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="form-group">
                            <button onClick="window.history.back();" class="btn btn-primary">Back</button>
                        </div>
                    <!-- /.container-fluid -->
                </div>
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
    @php
        $imageName = '/images/'.$images->name;
    @endphp

    <!-- Javascript for Dropzone -->
    <script type="text/javascript">
        Dropzone.options.dropzone = {
            init: function() {
                let myDropzone = this;

                // If the thumbnail is already in the right size on your server:
                let mockFile = { name: "{{ asset('moweb.png') }}", size: 12345 };
                let callback = null; // Optional callback when it's done
                let crossOrigin = null; // Added to the `img` tag for crossOrigin handling
                let resizeThumbnail = false; // Tells Dropzone whether it should resize the image first
                myDropzone.displayExistingFile(mockFile, "localhost:8000/moweb.png", callback, crossOrigin, resizeThumbnail);
            }
        }
    </script>
    <script>
        $(document).ready(function() {
           $(document).ready(function () {
               var printImageName = "<?php echo $imageName; ?>";
               var img = $('#img_edit').attr('src',printImageName);
           }); 
        });
    </script>
@endsection