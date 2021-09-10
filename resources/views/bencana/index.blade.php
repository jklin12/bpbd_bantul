<!DOCTYPE html>
<html lang="en">

<head>

    @include('partials.head')

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
                        <h1 class="h3 mb-0 text-gray-800">Data bencana</h1>
                        <a href="{{ route('addBencana') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Tambah Data</a>
                    </div>

                    @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                    @endif


                    <div class="card shadow mb-4">

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Deskripsi</th>
                                            <th>Kecamatan</th>
                                            <th>kelurahan</th>
                                            <th>Jenis</th>
                                            <th>Tanggal Input</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    @foreach ($bencana as $key => $b)
                                    <tbody>
                                        <tr>
                                            <td>{{ $key+1  }}</td>
                                            <td>{{ $b['deskripsi'] }}</td>
                                            <td>{{ $b['nama_kec']}}</td>
                                            <td>{{ $b['name_kel']}}</td>
                                            <td>{{ $b['type']}}</td>
                                            <td>{{ $b['created_at']}}</td>
                                            <th><a href="#" class="btn btn-success btn-circle">
                                                    <i class="fa fa-zoom-out"></i>
                                                </a></th>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            {!! $bencana->links() !!}
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

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    @include('modals.logout')

    <!-- Bootstrap core JavaScript-->
    @include('partials.js')

    <!-- Page level plugins -->
    <script src="{{ asset('src/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('src/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page level custom scripts -->

    <script type="text/javascript">
        $(document).ready(function() {
            $('#nav-bencana').addClass('active');
        });
    </script>
</body>

</html>