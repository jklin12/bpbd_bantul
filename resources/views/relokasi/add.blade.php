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
                        <h1 class="h3 mb-0 text-gray-800">{{ $data['judul']}}</h1>
                    </div>

                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <div class="card shadow mb-4">

                        <div class="card-body">
                            <form role="form" id="form-bencana" action="{{ $data['route'] }}" method="POST">
                                @csrf
                                @foreach($data['arr_field'] as $kform => $form)
                                @if($form['form'])

                                @if($form['form_type'] == 'text')
                                <div class="form-group">
                                    <label for="size">{{ $form['form_label'] }}</label>
                                    <input type="text" class="form-control" id="f_{{$kform}}" name="{{ $kform }}" placeholder="{{ $form['form_label'] }} ">
                                </div>
                                @elseif($form['form_type'] == 'select')
                                <div class="form-group">
                                    <label for="size">{{ $form['form_label'] }}</label>
                                   
                                    <select class="custom-select mr-sm-2" id="f_{{$kform}}" name="{{$kform}}" value="{{ isset($form['filter_value']) &&  $form['filter_value']  ? $form['filter_value'] :"" }}">
                                        <option></option>
                                        @foreach ($form['keyvaldata'] as $kval => $vval)
                                        <option value="{{ $kval }}" {{ isset($vf['filter_value']) &&  $vf['filter_value'] == $kval ? "selected" :""  }}>{{ $vval }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @endif

                                @endif
                                @endforeach
                            </form>

                            <button type="submit" form="form-bencana" class="btn btn-primary mb-2">Simpan</button>
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
                        <span>Copyright &copy; BPBD 2021 </span>
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
    <script src="{{ asset('src/vendor/dropzone/dropzone.js') }}"></script>

    <!-- Page level custom scripts -->

    <script type="text/javascript">
        $(document).ready(function() {
            $('#nav-bencana').addClass('active');

        });
    </script>
</body>

</html>