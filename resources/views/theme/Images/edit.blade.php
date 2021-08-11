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
                                            
                        <form action="{{ url('images/'.$images->id.'/update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                                <div class="needsclick dropzone" id="document-dropzone"></div>
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

    <!-- Script for Dropzone -->
    <script>
        var uploadedDocumentMap = {};
        var imageId = "<?php echo $images->id; ?>";

        Dropzone.options.documentDropzone = {
            url: '{{ route('images.update') }}?id=' + imageId,
            maxFilesize: 5,
            addRemoveLinks: true,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            data: {
                id: imageId
            },
            removedfile: function (file) {
                file.previewElement.remove();
                var name = '';
                if (typeof file.file_name !== 'undefined') {
                    name = file.file_name;
                } else {
                    name = uploadedDocumentMap[file.name];
                }
            },
            init: function () {
                var imgName = "<?php echo $images->name ?>";
                var myDropzone = this;
                var mockFile = { name: imgName , size: 12345 };
                
                if(imgName == '') {
                    return false;
                }
                else {
                    myDropzone.options.addedfile.call(myDropzone, mockFile);
                    myDropzone.options.thumbnail.call(myDropzone, mockFile, '/images/' + imgName);
                }
            }
        };
    </script>
@endsection