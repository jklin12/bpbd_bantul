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

                    </div>

                    @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                    @endif


                    <div class="card shadow mb-4">

                        <div class="card-body">
                            <div class="d-sm-flex align-items-center justify-content-between mb-3">
                                <a href="{{ route('addBencana') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Tambah Data
                                </a>

                                <div class="bd-example">
                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="collapse" data-target="#collapseFilter" aria-expanded="false" aria-controls="collapseFilter"><i class="fas fa-filter fa-sm text-white-50 mr-1"></i>Filter</button>
                                    <a href="{{route('bencana')}}" class="btn btn-secondary btn-sm"><i class="fas fa-redo fa-sm text-white-50 mr-1"></i>Reset</a>
                                    <button type="button" class="btn btn-success btn-sm"><i class="fas fa-print fa-sm text-white-50 mr-1"></i>Export</button>
                                </div>
                            </div>

                            <div class="collapse mb-3" id="collapseFilter">
                                <form action="" method="GET">
                                    <!-- start filter -->
                                    <div class="row">
                                        @if(isset($data['arr_field']))
                                        <div class="col-md-12">
                                            <h5 class="text-gray-800"> Pilih Data Filter</53>
                                        </div>
                                        @foreach($data['arr_field'] as $kf => $vf)
                                        @if(isset($vf['filter']) && $vf['filter'])
                                        <div class="col-md-2 r">
                                            @if(isset($vf['filter_label']) && $vf['filter_label'])
                                            {{$vf['filter_label']}} :
                                            @else
                                            {{$vf['label']}} :
                                            @endif
                                        </div>
                                        @endif
                                        @if($vf['filter_type'])
                                        <div class="col-md-4 mb-2 {{ $vf['filter_form_class'] }}">
                                            @if(isset($vf['filter_type']) && $vf['filter_type'] == 'text')
                                            <input type="text" name="filter[{{$kf}}]" id="f_{{$kf}}" class="form-control underline {{ $vf['filter_label_class']}}" />
                                            @elseif(isset($vf['filter_type']) && $vf['filter_type'] == 'select')
                                            <select class="custom-select mr-sm-2" id="f_{{$kf}}" name="filter[{{$kf}}]"  value="{{ isset($vf['filter_value']) &&  $vf['filter_value']  ? $vf['filter_value'] :"" }}" >
                                                <option></option>
                                                @foreach ($vf['keyvaldata'] as $kval => $vval)
                                                <option value="{{ $kval }}" {{ isset($vf['filter_value']) &&  $vf['filter_value'] == $kval ? "selected" :""  }}>{{ $vval }}</option>
                                                @endforeach
                                            </select>
                                            @elseif(isset($vf['filter_type']) && $vf['filter_type'] == 'date')
                                            <input type="text" class="form-control datepicker-default" id="f_{{$kf}}" placeholder="Select Date" name="filter[{{$kf}}]" value="{{ isset($vf['filter_value']) &&  $vf['filter_value']  ? $vf['filter_value'] :""  }}" />

                                            @endif
                                        </div>
                                        @endif
                                        @endforeach
                                        @endif
                                    </div>
                                    <!-- End filter -->

                                    <!-- start show column -->
                                    <div class="row mt-3">
                                        <div class="col-md-12">
                                            <h5 class="text-gray-800">Pilih Tampilan Kolom</h5>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" id="viewcolomall">
                                                <label class="form-check-label" for="viewcolomall">
                                                    Semua
                                                </label>
                                            </div>
                                        </div>
                                        @foreach($data['arr_field'] as $kfield => $vfield)
                                        @if(isset($vfield['kolom']) && $vfield['kolom'])
                                        <div class="col-md-2">
                                            <div class="form-check">
                                                <input class="form-check-input kolomviewcheckbox" type="checkbox" value="{{$kfield}}" name="viewcolom[{{ $kfield}}]" id="viewColumn_{{$kfield}}" @if(isset($vfield['table']) && $vfield['table'] ) {{ 'checked="checked"'}} @endif>
                                                <label class="form-check-label" for="viewColumn_{{$kfield}}">
                                                    {{$vfield['label']}}
                                                </label>
                                            </div>
                                        </div>
                                        @endif
                                        @endforeach
                                    </div>
                                    <!-- end show column -->

                                    <!-- start order data -->
                                    <div class="row mt-3">
                                        <div class="col-md-12">
                                            <h5 class="text-gray-800">Urutkan Berdasarkan</h5>
                                        </div>
                                        <div class="col-md-2 right pt5">
                                            Berdasarkan :
                                        </div>
                                        <div class="col-md-4">
                                            <select name="order" id="" class="chosen-select form-control">
                                                <option value=""></option>
                                                @foreach($data['arr_field'] as $kfield => $vfield)
                                                <option value="{{$kfield}}" {{ isset($data['order']) &&  $data['order'] == $kfield ? "selected" :""  }}> {{$vfield['label']}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-1 right pt5">
                                            Urutan :
                                        </div>
                                        <div class="col-md-2">
                                            <select name="by" id="" class="chosen-select form-control">
                                                <option value=""></option>
                                                <option value="ASC" {{ isset($data['by']) &&  $data['by'] == 'ASC' ? "selected" :""  }}>A - Z / Ascending</option>
                                                <option value="DESC" {{ isset($data['by']) &&  $data['by'] == 'DESC' ? "selected" :""  }}>Z - A / Descending</option>
                                            </select>
                                        </div>
                                        <div class="col-md-1 right pt5">
                                            Baris :
                                        </div>
                                        <div class="col-md-2">
                                            <input type="number" class="form-control " name="limit" value="{{ (isset($data['limit']) && $data['limit'] ? $data['limit'] : '') }}" min="1" />
                                        </div>
                                    </div>
                                    <!-- End order data-->

                                    <div class="d-sm-flex align-items-center justify-content-between mt-3">
                                        <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-danger" data-toggle="collapse" data-target="#collapseFilter" aria-expanded="false" aria-controls="collapseFilter"><i class="fas fa-cancel fa-sm text-white-50"></i> Batal
                                        </button>
                                        <button class="btn btn-primary btn-sm" type="submit"><i class="fas fa-search fa-sm text-white-50 mr-1"></i>Cari</button>
                                    </div>
                                </form>
                            </div>


                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            @foreach($data['arr_field'] as $key => $val)
                                            @if(isset($val['table']) && $val['table'])
                                            <th>{{ $val['label'] }}</th>
                                            @endif
                                            @endforeach
                                            <th></th>
                                        </tr>
                                    </thead>

                                    @foreach ($data['datas'] as $b)
                                    <tbody>
                                        <tr>
                                            <td>{{ ++$i  }}</td>
                                            @foreach($data['arr_field'] as $key => $val)
                                            @if(isset($val['table']) && $val['table'])
                                            @if($val['form_type'] == 'date')
                                            <td>{{ \Carbon\Carbon::parse($b[$key])->format('d, M Y h:i') }}</td>
                                            @elseif($val['form_type'] == 'select')
                                            <td>{{ $val['keyvaldata'][$b[$key]] }}</td>
                                            @else
                                            <td>{{ $b[$key]}}</td>
                                            @endif
                                            @endif
                                            @endforeach
                                            <th><a href="bencana/{{ $b['id']}}" class="btn btn-success btn-circle">
                                                    <i class="fa fa-search-plus"></i>
                                                </a>
                                            </th>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            {!! $data['datas']->links() !!}
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
    <script src="{{ asset('src/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.js') }}"></script>

    <!-- Page level custom scripts -->

    <script type="text/javascript">
        var handleDatepicker = function() {
            $('.datepicker-default').datepicker({
                todayHighlight: true,
                format: 'yyyy-mm-dd'
            });

        };

        var FormPlugins = function() {
            "use strict";
            return {
                //main function
                init: function() {
                    handleDatepicker();
                }
            };
        }();

        

        $(document).ready(function() {
            FormPlugins.init()
            $('#nav-bencana').addClass('active');
            $('#viewcolomall').on('change', function() {
                if (this.checked) {
                    $('.kolomviewcheckbox').attr("checked", "checked");
                } else {
                    $('.kolomviewcheckbox').removeAttr('checked');
                }
            })
        });
    </script>
</body>

</html>