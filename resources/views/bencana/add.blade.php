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
                        <h1 class="h3 mb-0 text-gray-800">Tambah Data bencana</h1>
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
                            <form role="form" id="form-bencana" action="{{ route('doAddBencana') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Kecamatan </label>
                                    <select class="form-control" id="select-kec" name="kecamatan">
                                        <option value="">Pilih kecamatan</option>
                                        @foreach ($data['kecamatan'] as $k)
                                        <option value="{{ $k['kecamatan_id'] }}">{{ $k['name'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Kelurahan </label>
                                    <select class="form-control" id="select-kel" name="kelurahan">
                                        <option value="">Pilih Kelurahan</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="desc">Deskripsi</label>
                                    <textarea class="form-control" id="desc" rows="3" name="deskripsi"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="jenis">Jenis</label>
                                    <select class="form-control" id="jenis" name="type">
                                        <option>1</option>
                                        @foreach($data['jenis'] as $j)
                                        
                                        <option value="{{ $j['jenis_id'] }}">{{ $j['name']}}</option>
                                        @endforeach 
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="size">Ukuran</label>
                                    <div class="row">
                                        <div class="col-sm">
                                            Panjang :
                                        </div>
                                        <div class="col-sm">
                                            <input type="text" class="form-control" id="p" name="panjang" placeholder="panjang">
                                        </div>
                                        <div class="col-sm">
                                            Lebar :
                                        </div>
                                        <div class="col-sm">
                                            <input type="text" class="form-control" id="l" name="lebar" placeholder="lebar">
                                        </div>
                                        <div class="col-sm">
                                            Tinggi :
                                        </div>
                                        <div class="col-sm">
                                            <input type="text" class="form-control" id="t" name="tinggi" placeholder="tinggi">
                                        </div>
                                    </div>

                                </div>
                                <div class="form-group">
                                    <label for="size">Alamat</label>
                                    <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Alamat ">
                                </div>
                                <div id="images">

                                </div>
                            </form>
                            <div class="form-group">
                                <label for="size">Foto</label>
                                <form action="/file-upload" class="dropzone mb-2">
                                    <div class="fallback">
                                        <input name="file" type="file" multiple />
                                    </div>
                                </form>
                            </div>

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
        var CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute("content");

        Dropzone.autoDiscover = false;
        var myDropzone = new Dropzone(".dropzone", {
            maxFilesize: 3, // 3 mb
            acceptedFiles: ".jpeg,.jpg,.png,",
            init: function() {
                this.on('success', function(file, resp) {
                    var data = JSON.parse(resp);
                    var el = '<input type="hidden" name="images[]" value="' + data['name'] + '">'
                    $('#images').append(el);
                });

            },
        });
        myDropzone.on("sending", function(file, xhr, formData) {
            formData.append("_token", CSRF_TOKEN);
        });

        $(document).ready(function() {
            $('#nav-bencana').addClass('active');
            $('#select-kec').on('change', function() {
                var id = this.value;
                var el = "";

                $.ajax({
                    url: "/getKelurahan/" + id,
                    success: function(result) {
                        var data = JSON.parse(result);
                        $.each(data, function(key, value) {
                            //alert(key + ": " + value);
                            el += '<option value="' + value['kelurahan_id'] + '">' + value['name'] + '</option>';
                        });

                        $('#select-kel').html(el)
                    }
                });
            })
        });
    </script>
</body>

</html>