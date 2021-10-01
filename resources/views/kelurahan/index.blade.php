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
                        <h1 class="h3 mb-0 text-gray-800">Data Kelurahan</h1>
                    </div>

                    @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                    @endif

                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif



                    <div class="card shadow mb-4">

                        <div class="card-body">
                            <form class="form-inline" method="POST" action="{{ route('kelurahan.store') }}">
                                @csrf
                                <select class="custom-select mb-2  mr-sm-2" id="inlineFormCustomSelect" name="kecamatan_id">
                                    <option selected>Pilih kecamatan</option> 
                                    @foreach ($data['kecamatan'] as $key => $c)
                                    <option value="{{ $c['kecamatan_id'] }}">{{ $c['name'] }}</option>
                                    @endforeach
                                </select>
                                <label class="sr-only" for="inlineFormInputName2">Nama kelurahan</label>
                                <input type="text" class="form-control mb-2 mr-sm-2" id="inlineFormInputName2" name="name" placeholder="nama kelurahan">


                                <button type="submit" class="btn btn-primary mb-2">Simpan</button>
                            </form>
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th scope="row">#</th>
                                            <th>Nama Kecamatan</th>
                                            <th>Nama Kelurahan</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    @foreach ($data['kelurahan'] as $key => $b)
                                    <tbody>
                                        <tr>
                                            <td scope="row">{{ $key+1  }}</td>
                                            <td>{{ $b['name_kecamatan'] }}</td>
                                            <td>{{ $b['name_kelurahan'] }}</td>
                                            <th>
                                                <a href="javascript:;" class="btn btn-success btn-circle" data-toggle="modal" data-target="#editModal" data-name="{{ $b['name_kelurahan'] }}" data-action="{{ route('kelurahan.update', $b['kelurahan_id'])}}">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <a href="javascript:;" class="btn btn-danger btn-circle" data-toggle="modal" data-target="#deleteModal" data-name="{{ $b['name_kelurahan'] }}" data-action="{{ route('kelurahan.destroy', $b['kelurahan_id'])}}">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                            </th>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            {!! $data['kelurahan']->links() !!}
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
                        <span>Copyright &copy; BPBD 2021  </span>
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

    <!-- start edit modal -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">New message</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form-edit" method="POST" action="">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="edit-name" class="col-form-label">Nama kelurahan:</label>
                            <input type="text" class="form-control" id="edit-name" name="name">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" form="form-edit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End edit modal -->

    <!-- start delete modal-->
    <div class="modal fade" tabindex="-1" role="dialog" id="deleteModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Hapus Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" id="delete-form" method="POST">
                        @csrf
                        @method('DELETE')
                    </form>
                    <p>Hapus data <strong id="delete-name"></strong></p>
                </div>
                <div class="modal-footer">
                    <button type="submit" form="delete-form" class="btn btn-danger">Hapus</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">batal</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End delete modal-->

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
            $('#nav-master').addClass('active');
            $('#nav-kelurahan').addClass('active');
            $('#collapseTwo').addClass('show')

            $('#editModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget)
                var name = button.data('name')
                var action = button.data('action')
                var modal = $(this)

                modal.find('.modal-title').text('Edit data ' + name)
                modal.find('.modal-body #edit-name').val(name)
                modal.find('#form-edit').attr('action', action)

            })

            $('#deleteModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget)
                var name = button.data('name')
                var action = button.data('action')
                var modal = $(this)

                modal.find('.modal-body #delete-name').val(name)
                modal.find('#delete-form').attr('action', action)

            })
        });
    </script>
</body>

</html>