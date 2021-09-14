<!DOCTYPE html>
<html lang="en">

<head>

    @include('partials.head')
    <link href="{{ asset('src/vendor/dropzone/dropzone.css') }}" rel="stylesheet">
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        @include('partials.sidebar')
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                @include('partials.topbar')
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Detail Data </h1>

                        <div class="row">
                            <a href="{{ route('editBencana',$bencana['id'] )}}" class="d-none d-sm-inline-block btn btn-sm btn-success mr-3">
                                <i class="fas fa-edit fa-sm text-white-50"></i>
                                Edit
                            </a>
                            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-danger mr-3" data-toggle="modal" data-target="#modal-delete">
                                <i class="fas fa-trash fa-sm text-white-50"></i>
                                Hapus
                            </a>
                        </div>

                    </div>


                    @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                    @endif


                    <div class="card shadow mb-4">

                        <div class="card-body">
                            <div class="table-responsive" style="overflow-x: hidden;">
                                <table class="table table-borderless" id="dataTable" width="100%" cellspacing="0">
                                    <tbody>
                                        <tr>
                                            <td>Kecamatan</td>
                                            <td>:</td>
                                            <td>{{ $bencana['nama_kec'] }}</td>
                                        </tr>
                                        <tr>
                                            <td>Kelurahan</td>
                                            <td>:</td>
                                            <td>{{ $bencana['name_kel'] }}</td>
                                        </tr>
                                        <tr>
                                            <td>Alamat</td>
                                            <td>:</td>
                                            <td>{{ $bencana['alamat'] }}</td>
                                        </tr>
                                        </tr>
                                        <tr>
                                            <td>Jenis</td>
                                            <td>:</td>
                                            <td>{{ $bencana['type'] }}</td>
                                        </tr>
                                        <tr>
                                            <td>Ukuran</td>
                                            <td>:</td>
                                            <td>{{ $bencana['size'] }}</td>
                                        </tr>
                                        <tr>
                                            <td>Deskripsi</td>
                                            <td>:</td>
                                            <td>
                                                <p>{{ $bencana['deskripsi'] }}</p>
                                            </td>
                                        </tr>
                                        </tr>
                                        <tr>
                                            <td>Foto</td>
                                            <td>:</td>
                                            <td> </td>
                                        </tr>
                                    </tbody>
                                </table>

                            </div>
                            <div class="row">
                                @foreach($bencana['foto'] as $key => $b)
                                <div class="col-lg-1 col-md-2 col-3">
                                    <a href="#" class="d-block mb-4 img-btn" data-img="{{ '/files/'.$b }}">
                                        <img class="img-fluid img-thumbnail" src="{{ '/files/'.$b }}" alt="">
                                    </a>
                                </div>
                                @endforeach
                            </div>
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
                        <span>Copyright &copy; Your Website 2021</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- start modal imahe -->
    <div class="modal fade" id="modal-image" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <img class="d-block w-100" id="image-container" alt="First slide">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End modal image -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    @include('modals.logout')

    <!-- start modal delete-->
    <div class="modal" tabindex="-1" role="dialog" id="modal-delete">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Hapus Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Apakah anda yakin menghapus data  </p>
                </div>
                <div class="modal-footer">
                    <a href="{{ route('deleteBencana', $bencana['id']) }}" class="btn btn-primary">Simpan</a>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    @include('partials.js')

    <!-- Page level plugins -->
    <!-- Page level custom scripts -->

    <script type="text/javascript">
        $(document).ready(function() {
            $('#nav-bencana').addClass('active');
            $('.img-btn').on('click', function() {
                var img = $(this).data('img');
                $('#image-container').attr('src', img)
                $('#modal-image').modal('show')
            });

        });
    </script>
</body>

</html>