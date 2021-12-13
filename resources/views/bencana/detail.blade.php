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


                    @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                    @endif
                    <ul class="nav nav-pills mb-2" id="tabs-title-region-nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" role="tab" href="#block-simple-text-1" aria-selected="false" aria-controls="block-simple-text-1" id="block-simple-text-1-tab">Data Bencana</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" role="tab" href="#block-simple-text-2" aria-selected="false" aria-controls="block-simple-text-2" id="block-simple-text-2-tab">Data Perbaikan</a>
                        </li>


                    </ul>

                    <div class="card shadow mb-4">

                        <div class="card-body">
                            <div class="tab-content">

                                <div id="block-simple-text-1" class="tab-pane active block block-layout-builder block-inline-blockqfcc-blocktype-simple-text" role="tabpanel" aria-labelledby="block-simple-text-1-tab">
                                    <div class="table-responsive" style="overflow-x: hidden;">
                                        <div class="d-sm-flex align-items-center justify-content-between mb-4">
                                            <h1 class="h3 mb-0 text-gray-800">Detail Bencana </h1>

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
                                        <table class="table table-borderless" id="dataTable" width="100%" cellspacing="0">
                                            <tbody>
                                                <tr class="d-flex">
                                                    <td class="col-2">Kecamatan</td>
                                                    <td>:</td>
                                                    <td>{{ $bencana['nama_kec'] }}</td>
                                                </tr>
                                                <tr class="d-flex">
                                                    <td class="col-2">Kelurahan</td>
                                                    <td>:</td>
                                                    <td>{{ $bencana['name_kel'] }}</td>
                                                </tr>
                                                <tr class="d-flex">
                                                    <td class="col-2">Alamat</td>
                                                    <td>:</td>
                                                    <td>{{ $bencana['alamat'] }}</td>
                                                </tr>
                                                <tr class="d-flex">
                                                    <td class="col-2">Latitude</td>
                                                    <td>:</td>
                                                    <td>{{ $bencana['latitude'] }}</td>
                                                </tr>
                                                <tr class="d-flex">
                                                    <td class="col-2">Longitude</td>
                                                    <td>:</td>
                                                    <td>{{ $bencana['longitude'] }}</td>
                                                </tr>
                                                <tr class="d-flex">
                                                    <td class="col-2">Jenis</td>
                                                    <td>:</td>
                                                    <td>{{ $bencana['jenis_bencana'] }}</td>
                                                </tr>
                                                <tr class="d-flex">
                                                    <td class="col-2">Ukuran PanjangxLebarxTinggi</td>
                                                    <td>:</td>
                                                    <td>{{ $bencana['panjang'].'x'.$bencana['lebar'].'x'.$bencana['tinggi'].' M' }}</td>
                                                </tr>
                                                <tr class="d-flex">
                                                    <td class="col-2">Deskripsi</td>
                                                    <td>:</td>
                                                    <td>
                                                        <p>{{ $bencana['deskripsi'] }}</p>
                                                    </td>
                                                </tr>
                                                </tr>
                                                <tr class="d-flex">
                                                    <td class="col-2">Foto</td>
                                                    <td>:</td>
                                                    <td> </td>
                                                </tr>
                                            </tbody>
                                        </table>

                                    </div>
                                    <div class="row">
                                        @foreach($bencana['foto'] as $key => $b)
                                        <div class="col-lg-1 col-md-2 col-2">
                                            <a href="#" class="d-block mb-4 img-btn" data-img="{{ '/files/'.$b->foto_name }}">
                                                <img class="img-fluid img-thumbnail" src="{{ '/files/'.$b->foto_name }}" alt="">
                                            </a>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div id="block-simple-text-2" class="tab-pane  block block-layout-builder block-inline-blockqfcc-blocktype-simple-text" role="tabpanel" aria-labelledby="block-simple-text-2-tab">
                                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                                        <h1 class="h3 mb-0 text-gray-800">Detail Perbaikan </h1>

                                        <div class="row">
                                            <a href="{{ route('addPebaikan',$bencana['id'] )}}" class="d-none d-sm-inline-block btn btn-sm btn-primary mr-3">
                                                <i class="fas fa-plus fa-sm text-white-50"></i>
                                                Tambah
                                            </a>
                                            @if(isset($bencana['perbaikan']))

                                            @endif
                                        </div>


                                    </div>


                                    @if(!isset($bencana['perbaikan']))
                                    <div class="alert alert-warning" role="alert">
                                        Data perbaikan belum ada
                                    </div>
                                    @else
                                    <table class="table" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <th>No.</th>
                                            <th>Status</th>
                                            <th>Keterangan</th>
                                            <th class="w-50">Foto</th>
                                            <th colspan="2" class="text-center col-lg2 ">Aksi</th>
                                        </thead>
                                        <tbody>
                                            @foreach($bencana['perbaikan'] as $key => $data)
                                            <tr>
                                                <td>{{ $key+1}}</td>
                                                <td>{{ $bencana['arr_status'][$data['status']] }}</td>
                                                <td>{{ $data['deskripsi'] }}</td>
                                                <td>
                                                    <div class="row">
                                                        @foreach($data['foto'] as $key => $b)
                                                        <div class="col-lg-1 col-md-2 col-2">
                                                            <a href="#" class="d-block mb-4 img-btn" data-img="{{ '/files/'.$b }}">
                                                                <img class="img-fluid img-thumbnail" src="{{ '/files/'.$b }}" alt="">
                                                            </a>
                                                        </div>
                                                        @endforeach
                                                    </div>
                                                </td>
                                                <td class="text-center"> <a href="{{ route('editBencana',$bencana['id'] )}}" class="d-none d-sm-inline-block btn btn-sm btn-success mr-3">
                                                        <i class="fas fa-edit fa-sm text-white-50"></i>
                                                        Edit
                                                    </a></td>
                                                <td class="text-center">
                                                    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-danger mr-3" data-toggle="modal" data-target="#modal-delete">
                                                        <i class="fas fa-trash fa-sm text-white-50"></i>
                                                        Hapus
                                                    </a>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                    @endif
                                </div>
                            </div>


                            <a href="{{ route('bencana')}}" class="d-none d-sm-inline-block btn btn-sm btn-success mr-3">
                                <i class="fas fa-arrow-left fa-sm text-white-50"></i>
                                kembali
                            </a>
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
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
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
                    <p>Apakah anda yakin menghapus data </p>
                </div>
                <div class="modal-footer">
                    <a href="{{ route('deleteBencana', $bencana['id']) }}" class="btn btn-danger">Hapus</a>
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
            var tabsActions = function(element) {
                this.element = $(element);

                this.setup = function() {
                    if (this.element.length <= 0) {
                        return;
                    }
                    this.init();
                    // Update after resize window.
                    var resizeId = null;
                    $(window).resize(function() {
                        clearTimeout(resizeId);
                        resizeId = setTimeout(() => {
                            this.init()
                        }, 50);
                    }.bind(this));
                };

                this.init = function() {

                    // Add class to overflow items.
                    this.actionOverflowItems();
                    var tabs_overflow = this.element.find('.overflow-tab');

                    // Build overflow action tab element.
                    if (tabs_overflow.length > 0) {
                        if (!this.element.find('.overflow-tab-action').length) {
                            var tab_link = $('<a>')
                                .addClass('nav-link')
                                .attr('href', '#')
                                .attr('data-toggle', 'dropdown')
                                .text('...')
                                .on('click', function(e) {
                                    e.preventDefault();
                                    $(this).parents('.nav.nav-tabs').children('.nav-item.overflow-tab').toggle();
                                });

                            var overflow_tab_action = $('<li>')
                                .addClass('nav-item')
                                .addClass('overflow-tab-action')
                                .append(tab_link);

                            // Add hide to overflow tabs when click on any tab.
                            this.element.find('.nav-link').on('click', function(e) {
                                $(this).parents('.nav.nav-tabs').children('.nav-item.overflow-tab').hide();
                            });
                            this.element.append(overflow_tab_action);
                        }

                        this.openOverflowDropdown();
                    } else {
                        this.element.find('.overflow-tab-action').remove();
                    }
                };

                this.openOverflowDropdown = function() {
                    var overflow_sum_height = 0;
                    var overflow_first_top = 41;

                    this.element.find('.overflow-tab').hide();
                    // Calc top position of overflow tabs.
                    this.element.find('.overflow-tab').each(function() {
                        var overflow_item_height = $(this).height() - 1;
                        if (overflow_sum_height === 0) {
                            $(this).css('top', overflow_first_top + 'px');
                            overflow_sum_height += overflow_first_top + overflow_item_height;
                        } else {
                            $(this).css('top', overflow_sum_height + 'px');
                            overflow_sum_height += overflow_item_height;
                        }

                    });
                };

                this.actionOverflowItems = function() {
                    var tabs_limit = this.element.width() - 100;
                    var count = 0;

                    // Calc tans width and add class to any tab that is overflow.
                    for (var i = 0; i < this.element.children().length; i += 1) {
                        var item = $(this.element.children()[i]);
                        if (item.hasClass('overflow-tab-action')) {
                            continue;
                        }

                        count += item.width();
                        if (count > tabs_limit) {
                            item.addClass('overflow-tab');
                        } else if (count < tabs_limit) {
                            item.removeClass('overflow-tab');
                            item.show();
                        }
                    }
                };
            };

            var tabsAction = new tabsActions('.layout--tabs .nav-tabs-wrapper .nav-tabs');
            tabsAction.setup();
        });
    </script>
</body>

</html>