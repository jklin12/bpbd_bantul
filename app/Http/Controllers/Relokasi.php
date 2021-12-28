<?php

namespace App\Http\Controllers;

use App\Models\MRelokasi;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\Export;
use App\Models\MKecamatan;
use App\Models\MKelurahan;
use Illuminate\Support\Facades\DB;
use PDF;
use Validator;

class Relokasi extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $export = $request['export'] ? $request['export'] : null;
        $tittle = 'Data Relokasi';
        $subTittle = '';
        $limit = 25;
        $by = isset($request['by']) && $request['by'] ? $request['by'] : 'ASC';
        $order = isset($request['order']) && $request['order'] ? $request['order'] : 'created_at';

        $arrFiled = $this->arrField();

        if (isset($request['limit']) && $request['limit']) {
            $limit = $request['limit'];
        }

        if ($export) {
            $limit = 1000;
            $request['export'] = $export;
            $dates =  isset($request['filter']['date']) && $request['filter']['date'] ? $request['filter']['date']  : date('Y-m-d');
            $subTittle = "Per Tanggal " . \Carbon\Carbon::parse($dates)->isoFormat('d, MMMM  Y');
        }

        $where = [];
        $like = [];
        $filter = isset($request['filter']) && $request['filter'] ?  $request['filter'] : [];
        if ($filter) {
            foreach ($filter as $key => $value) {
                if ($value) {
                    $dfil = $arrFiled[$key];
                    $nkfil = $key;
                    $isivalue =  '';

                    if (isset($arrFiled[$key]['filter_table']) && $arrFiled[$key]['filter_table']) {
                        $nkfil = $arrFiled[$key]['filter_table'] . '.' . $key;
                    }
                    $arrFiled[$key]['filter_value'] = $value;
                    if ($dfil['filter_type'] == 'text') {
                        $value = trim(strip_tags($key));
                        $isivalue =  $value;
                        $like[] = array($nkfil, $value, 'both');
                    } else {
                        $isivalue =  ((isset($arrFiled[$key]['keyvaldata'][$value]) and $arrFiled[$key]['keyvaldata'][$value]) ? $arrFiled[$key]['keyvaldata'][$value] : '');
                        $where[] = array($nkfil, $value);
                    }
                }
            }
        }


        if (isset($request['viewcolom']) && $request['viewcolom']) {
            $viewcolom = $request['viewcolom'];
            foreach ($arrFiled as $kvc => $vvc) {

                if (in_array($kvc, $viewcolom)) {
                    $arrFiled[$kvc]['table'] = 1;
                } else {
                    $arrFiled[$kvc]['table'] = 0;
                }
            }
        }

        $relokasi = MRelokasi::query();

        foreach ($where as $key => $value) {
            $relokasi = $relokasi->where($value[0], $value[1]);
        }

        $relokasi = $relokasi->select('relokasi_id', 'relokasi_tanggal', 'relokasi_name', 'relokasi_asal', 'relokasi_luas', 'relokasi_jumlah_jiwa', 'relokasi_status_tanah', 'relokasi_sarana_prasarana', 'lokasi_relokasi', 'relokasi_keterangan','kelurahan_asal','kecamatan_asal','kecamatan_relokasi','kelurahan_relokasi');

        if ($by == 'ASC') {
            $relokasi->orderBy($order);
        } else {
            $relokasi->orderByDesc($order);
        }

        $relokasi = $relokasi->paginate($limit)->withQueryString();

        $data = [
            'tittle' => $tittle,
            'sub_tittle' => $subTittle,
            'datas' => $relokasi,
            'arr_field' => $arrFiled,
            'request' => $request->all(),
            'limit' => $limit,
            'order' => $order,
            'by' => $by
        ];

        if ($export && $export == 'pdf') {

            $pdf = PDF::loadView('export.pdf', compact('data'))->setPaper('a4', 'landscape');
            return $pdf->download($tittle . '_' . $subTittle . '.pdf');
        } elseif ($export && $export == 'excel') {
            return Excel::download(new Export($data), 'users.xlsx');
        } else {
            return view('relokasi.index', compact('data'))
                ->with('i', (request()->input('page', 1) - 1) * 5);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'judul' => 'Tambah Data Relokasi',
            'arr_field' => $this->arrField(),
            'route' => route('relokasi.store')
        ];
        return view('relokasi.add', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $rules = [
            'relokasi_tanggal'     => 'required|date',
            'relokasi_name'  => 'required',
            'relokasi_asal'  => 'required',
            'relokasi_luas'  => 'required',
            'relokasi_jumlah_jiwa'  => 'required',
            'relokasi_status_tanah'  => 'required',
            'relokasi_sarana_prasarana'  => 'required',
            'relokasi_lokasi'  => 'required',
            'relokasi_keterangan'  => 'required',

        ];

        $messages = [
            'relokasi_tanggal.required'    => 'Tanggal wajib diisi',
            'relokasi_tanggal.date'    => 'Tanggal Tidak Valid',
            'relokasi_name.required'    => 'Nama wajib diisi',
            'relokasi_asal.required'    => 'Asal wajib diisi',
            'relokasi_luas.required'    => 'Luas  wajib diisi',
            'relokasi_jumlah_jiwa.required'    => 'Jumlah Jiwa wajib diisi',
            'relokasi_status_tanah.required'    => 'Status Tanah wajib diisi',
            'relokasi_sarana_prasarana.required'    => 'Sarana Prasarana wajib diisi',
            //'relokasi_lokasi.required'    => 'Lokasi wajib diisi',
            'relokasi_keterangan.required'    => 'Keterangan wajib diisi',

        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all);
        }

        $insert = MRelokasi::create($request->all());
        $insertID = DB::getPdo()->lastInsertId();

        if ($insert) {
            return redirect()->route('relokasi.index')
                ->with('success', 'Tambah Data Berhasil');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $rules = [
            'relokasi_tanggal'     => 'required|date',
            'relokasi_name'  => 'required',
            'relokasi_asal'  => 'required',
            'relokasi_luas'  => 'required',
            'relokasi_jumlah_jiwa'  => 'required',
            'relokasi_status_tanah'  => 'required',
            'relokasi_sarana_prasarana'  => 'required',
            'relokasi_lokasi'  => 'required',
            'relokasi_keterangan'  => 'required',

        ];

        $messages = [
            'relokasi_tanggal.required'    => 'Tanggal wajib diisi',
            'relokasi_tanggal.date'    => 'Tanggal Tidak Valid',
            'relokasi_name.required'    => 'Nama wajib diisi',
            'relokasi_asal.required'    => 'Asal wajib diisi',
            'relokasi_luas.required'    => 'Luas  wajib diisi',
            'relokasi_jumlah_jiwa.required'    => 'Jumlah Jiwa wajib diisi',
            'relokasi_status_tanah.required'    => 'Status Tanah wajib diisi',
            'relokasi_sarana_prasarana.required'    => 'Sarana Prasarana wajib diisi',
            //'relokasi_lokasi.required'    => 'Lokasi wajib diisi',
            'relokasi_keterangan.required'    => 'Keterangan wajib diisi',

        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all);
        }

        $update = MRelokasi::find($id)
            ->update($request->all());


        if ($update) {
            return redirect()->route('relokasi.index')
                ->with('success', 'Edit Data Berhasil');
        } else {
            return redirect()->route('relokasi.index')
                ->with('error', 'Edit Data gagal');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(MRelokasi $relokasi)
    {
        $relokasi->delete();

        return redirect()->route('relokasi.index')
            ->with('success', 'Hapus Data Relokasi berhasil .');
    }

    private function arrField()
    {

        $kecamatan = MKecamatan::all();
        $kecVal = arr_filter($kecamatan, 'kecamatan_id', 'name');


        $kelurahan = MKelurahan::all();
        $kelVal = arr_filter($kelurahan, 'kelurahan_id', 'name');

        $arrFiled = [
            'relokasi_tanggal' => [
                'table' => 1,
                'hidecolom' => 0,
                'label' => 'Tanggal Relokasi',
                'form' => 1,
                'form_label' => 'Tanggal Relokasi',
                'form_type' => 'text',
                'filter' => 0,
                'filter_table' => '',
                'filter_label' => 'Tanggal Relokasi',
                'filter_type' => 'date',
                'filter_label_class' => '',
                'filter_form_class' => '',
                'filter_value' => '',
                'keyvaldata' => '',
                'kolom' => 1,
                'sort' => 1,
            ],
            'relokasi_name' => [
                'table' => 1,
                'hidecolom' => 0,
                'label' => 'Nama Peneria ',
                'form' => 1,
                'form_label' => 'Nama Penerima ',
                'form_type' => 'text',
                'filter' => 1,
                'filter_table' => '',
                'filter_label' => 'Kecamatan ',
                'filter_type' => 'text',
                'filter_label_class' => '',
                'filter_form_class' => '',
                'filter_value' => '',
                'keyvaldata' => '',
                'kolom' => 1,
                'sort' => 1,
            ],
            'kecamatan_asal' => [
                'table' => 1,
                'hidecolom' => 0,
                'label' => 'Kecamatan Asal ',
                'form' => 1,
                'form_label' => 'Kecamatan Asal ',
                'form_type' => 'select',
                'filter' => 1,
                'filter_table' => '',
                'filter_label' => 'Kecamatan Asal',
                'filter_type' => 'select',
                'filter_label_class' => '',
                'filter_form_class' => '',
                'filter_value' => '',
                'keyvaldata' => $kecVal,
                'kolom' => 1,
                'sort' => 1,
            ],
            'kelurahan_asal' => [
                'table' => 1,
                'hidecolom' => 0,
                'label' => 'Kelurahan Asal',
                'form' => 1,
                'form_label' => 'Kelurahan Asal',
                'form_type' => 'select',
                'filter' => 1,
                'filter_table' => '',
                'filter_label' => 'Kelurahan Asal',
                'filter_type' => 'select',
                'filter_label_class' => '',
                'filter_form_class' => '',
                'filter_value' => '',
                'keyvaldata' => $kelVal,
                'kolom' => 1,
                'sort' => 1,
            ],
            'relokasi_asal' => [
                'table' => 1,
                'hidecolom' => 0,
                'label' => 'Alamat Asal ',
                'form' => 1,
                'form_label' => 'Alamat Asal ',
                'form_type' => 'text',
                'filter' => 1,
                'filter_table' => '',
                'filter_label' => 'Alamat Asal ',
                'filter_type' => 'text',
                'filter_label_class' => '',
                'filter_form_class' => '',
                'filter_value' => '',
                'keyvaldata' => '',
                'kolom' => 1,
                'sort' => 1,
            ],
            'relokasi_luas' => [
                'table' => 1,
                'hidecolom' => 0,
                'label' => 'Luas Wilayah ',
                'form' => 1,
                'form_label' => 'Luas Wilayah ',
                'form_type' => 'text',
                'filter' => 1,
                'filter_table' => '',
                'filter_label' => 'Luas Wilayah ',
                'filter_type' => 'text',
                'filter_label_class' => '',
                'filter_form_class' => '',
                'filter_value' => '',
                'kolom' => 1,
                'sort' => 1,
            ],
            'relokasi_jumlah_jiwa' => [
                'table' => 1,
                'hidecolom' => 0,
                'label' => 'Jumlah Jiwa ',
                'form' => 1,
                'form_label' => 'Jumlah Jiwa ',
                'form_type' => 'text',
                'filter' => 1,
                'filter_table' => '',
                'filter_label' => 'Jumlah Jiwa ',
                'filter_type' => 'text',
                'filter_label_class' => '',
                'filter_form_class' => '',
                'filter_value' => '',
                'keyvaldata' => '',
                'kolom' => 1,
                'sort' => 1,
            ],
            'relokasi_status_tanah' => [
                'table' => 1,
                'hidecolom' => 0,
                'label' => 'Satatus Tanah',
                'form' => 1,
                'form_label' => 'Satatus Tanah',
                'form_type' => 'text',
                'filter' => 0,
                'filter_table' => '',
                'filter_label' => 'Satatus Tanah',
                'filter_type' => '',
                'filter_label_class' => '',
                'filter_form_class' => '',
                'filter_value' => '',
                'keyvaldata' => '',
                'kolom' => 1,
                'sort' => 1,
            ],
            'relokasi_sarana_prasarana' => [
                'table' => 1,
                'hidecolom' => 0,
                'label' => 'Sarana Prasarana',
                'form' => 1,
                'form_label' => 'Sarana Prasarana',
                'form_type' => 'text',
                'filter' => 1,
                'filter_table' => '',
                'filter_label' => 'Sarana Prasarana',
                'filter_type' => 'text',
                'filter_label_class' => '',
                'filter_form_class' => '',
                'filter_value' => '',
                'keyvaldata' => '',
                'kolom' => 1,
                'sort' => 1,
            ],
            'kecamatan_relokasi' => [
                'table' => 1,
                'hidecolom' => 0,
                'label' => 'Kecamatan Relokasi ',
                'form' => 1,
                'form_label' => 'Kecamatan Relokasi ',
                'form_type' => 'select',
                'filter' => 1,
                'filter_table' => '',
                'filter_label' => 'Kecamatan Relokasi',
                'filter_type' => 'select',
                'filter_label_class' => '',
                'filter_form_class' => '',
                'filter_value' => '',
                'keyvaldata' => $kecVal,
                'kolom' => 1,
                'sort' => 1,
            ],
            'kelurahan_relokasi' => [
                'table' => 1,
                'hidecolom' => 0,
                'label' => 'Kelurahan Relokasi',
                'form' => 1,
                'form_label' => 'Kelurahan Relokasi',
                'form_type' => 'select',
                'filter' => 1,
                'filter_table' => '',
                'filter_label' => 'Kelurahan Relokasi',
                'filter_type' => 'select',
                'filter_label_class' => '',
                'filter_form_class' => '',
                'filter_value' => '',
                'keyvaldata' => $kelVal,
                'kolom' => 1,
                'sort' => 1,
            ],
            'lokasi_relokasi' => [
                'table' => 1,
                'hidecolom' => 0,
                'label' => 'Lokasi Relokasi',
                'form' => 1,
                'form_label' => 'Lokasi Relokasi',
                'form_type' => 'text',
                'filter' => 0,
                'filter_table' => '',
                'filter_label' => 'Lokasi Relokasi',
                'filter_type' => '',
                'filter_label_class' => '',
                'filter_form_class' => '',
                'filter_value' => '',
                'keyvaldata' => '',
                'kolom' => 1,
                'sort' => 1,
            ],
            'relokasi_keterangan' => array(
                'table' => 1,
                'hidecolom' => 0,
                'label' => 'Keterangan ',
                'form' => 1,
                'form_label' => 'Keterangan ',
                'type' => 'text',
                'form_type' => 'text',
                'filter' => 1,
                'filter_table' => '',
                'filter_label' => 'Keterangan ',
                'filter_type' => 'text',
                'filter_label_class' => '',
                'filter_form_class' => '',
                'filter_value' => '',
                'keyvaldata' => '',
                'kolom' => 1,
                'sort' => 1,
            ),
            'created_at' => array(
                'table' => 1,
                'hidecolom' => 0,
                'label' => 'Tanggal ',
                'form' => 1,
                'form_label' => 'Tanggal ',
                'type' => 'date',
                'form_type' => 'date',
                'filter' => 1,
                'filter_table' => '',
                'filter_label' => 'Tanggal ',
                'filter_type' => 'date',
                'filter_label_class' => '',
                'filter_form_class' => '',
                'filter_value' => '',
                'keyvaldata' => '',
                'kolom' => 1,
                'sort' => 1,
            ),

        ];

        return $arrFiled;
    }
}
