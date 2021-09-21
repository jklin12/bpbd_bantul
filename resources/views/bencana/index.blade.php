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
                            <form class="mb-2" id="search-form">
                                <div class="form-row align-items-center">
                                    <div class="col-auto my-1">
                                        <label class="mr-sm-2" for="inlineFormCustomSelect">Kecamatan</label>
                                        <select class="custom-select mr-sm-2" id="inlineFormCustomSelect" name="kec">
                                            <option></option>
                                            @foreach ($data['kecamatan'] as $k)
                                            <option value="{{ $k['kecamatan_id'] }}" {{ isset($data['request']['kec']) &&  $k['kecamatan_id'] == $data['request']['kec'] ? "selected" :""  }}>{{ $k['name'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-auto my-1">
                                        <label class="mr-sm-2" for="inlineFormCustomSelect">Kelurahan</label>
                                        <select class="custom-select mr-sm-2" id="inlineFormCustomSelect" name="kel">
                                            <option></option>
                                            @foreach ($data['kelurahan'] as $k)
                                            <option value="{{ $k['kelurahan_id'] }}" {{ isset($data['request']['kel']) &&  $k['kelurahan_id'] == $data['request']['kel'] ? "selected" :""  }}>{{ $k['name'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-auto my-1">
                                        <label class="mr-sm-2" for="inlineFormCustomSelect">Jenis</label>
                                        <select class="custom-select mr-sm-2" id="inlineFormCustomSelect" name="jenis">
                                            <option></option>
                                            @foreach($data['jenis'] as $j)
                                            <option value="{{ $j['jenis_id'] }}" {{  isset($data['request']['jenis']) &&  $j['jenis_id'] == $data['request']['jenis'] ? "selected" : ""  }}>{{ $j['name']}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-auto my-1 pt-4">
                                        <button type="submit" id="searchbutton" class="btn btn-primary" form="search-form">Cari</button>
                                    </div>
                                </div>
                            </form>
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Deskripsi</th>
                                            <th>Kecamatan</th>
                                            <th>kelurahan</th>
                                            <th>Jenis</th>
                                            <th>Panjang</th>
                                            <th>Lebar</th>
                                            <th>Tinggi</th>
                                            <th>Tanggal Input</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    @foreach ($data['bencana'] as $key => $b)
                                    <tbody>
                                        <tr>
                                            <td>{{ $key+1  }}</td>
                                            <td>{{ $b['deskripsi'] }}</td>
                                            <td>{{ $b['nama_kec']}}</td>
                                            <td>{{ $b['name_kel']}}</td>
                                            <td>{{ $b['nama_jenis']}}</td>
                                            <td>{{ $b['panjang']}}</td>
                                            <td>{{ $b['lebar']}}</td>
                                            <td>{{ $b['tinggi']}}</td>
                                            <td>{{ \Carbon\Carbon::parse($b['created_at'] )->format('d, M Y H:i') }}</td>
                                            <th><a href="bencana/{{ $b['id']}}" class="btn btn-success btn-circle">
                                                    <i class="fa fa-search-plus"></i>
                                                </a></th>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            {!! $data['bencana']->links() !!}
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