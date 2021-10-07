<?php

namespace App\Http\Controllers;

use App\Exports\Export;
use Illuminate\Http\Request;
use App\Models\MBencana;
use App\Models\Mjenis;
use App\Models\MKecamatan;
use App\Models\MKelurahan;
use PDF; 
use Maatwebsite\Excel\Facades\Excel;


class Bencana extends Controller
{
    public function index($export = null, Request $request)
    {
        $tittle = 'Data bencana';
        $subTittle = '';
        $limit = 5;
        $by = isset($request['by']) && $request['by'] ? $request['by'] : 'ASC';
        $order = isset($request['order']) && $request['order'] ? $request['order'] : 'created_at';
        $arrFiled = $this->arrField();

        if (isset($request['limit']) && $request['limit']) {
            $limit = $request['limit'];
        }

        if ($export) {
            $limit = 1000;
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


        $bencana = MBencana::query();
        $bencana = MBencana::query();
        if (isset($request['kec']) && $request['kec'] != '') {
            $bencana = $bencana->where('t_bencana.kecamatan', $request['kec']);
        }
        foreach ($where as $key => $value) {
            $bencana = $bencana->where($value[0], $value[1]);
        }

        $bencana = $bencana->select('kecamatan', 'deskripsi', 'type', 'panjang', 'lebar', 'tinggi', 'created_at', 'type', 'kelurahan');

        if ($by == 'ASC') {
            $bencana->orderBy($order);
        } else {
            $bencana->orderByDesc($order);
        }

        $bencana = $bencana->paginate($limit)->withQueryString();

        $data = [
            'tittle' => $tittle,
            'sub_tittle' => $subTittle,
            'datas' => $bencana,
            'arr_field' => $arrFiled,
            'request' => $request->all(),
            'limit' => $limit,
            'order' => $order,
            'by' => $by
        ];

        if ($export && $export == 'pdf') {
            $pdf = PDF::loadView('export.pdf', compact('data'))->setPaper('a4', 'landscape');
            return $pdf->download($tittle . '_' . $subTittle . '.pdf');
        } elseif ($export && $export == 'exel') {
            return Excel::download(new Export($data), 'users.xlsx');
        } else {
            return view('bencana.index', compact('data'))
                ->with('i', (request()->input('page', 1) - 1) * 5);
        }
    }
 

    private function arrField()
    {

        $kecamatan = MKecamatan::all();
        $kecVal = arr_filter($kecamatan, 'kecamatan_id', 'name');

        $jenis = Mjenis::all();
        $jenisVal = arr_filter($jenis, 'jenis_id', 'name');

        $kelurahan = MKelurahan::all();
        $kelVal = arr_filter($kelurahan, 'kelurahan_id', 'name');

        $arrFiled = [
            'deskripsi' => [
                'table' => 1,
                'hidecolom' => 0,
                'label' => 'Deskripsi',
                'form' => 1,
                'form_label' => 'Deskripsi',
                'form_type' => 'area',
                'filter' => 0,
                'filter_table' => '',
                'filter_label' => 'Deskripsi',
                'filter_type' => '',
                'filter_label_class' => '',
                'filter_form_class' => '',
                'filter_value' => '',
                'keyvaldata' => '',
                'kolom' => 1,
                'sort' => 1,
            ],
            'kecamatan' => [
                'table' => 1,
                'hidecolom' => 0,
                'label' => 'Kecamatan ',
                'form' => 1,
                'form_label' => 'Kecamatan ',
                'form_type' => 'select',
                'filter' => 1,
                'filter_table' => '',
                'filter_label' => 'Kecamatan ',
                'filter_type' => 'select',
                'filter_label_class' => '',
                'filter_form_class' => '',
                'filter_value' => '',
                'keyvaldata' => $kecVal,
                'kolom' => 1,
                'sort' => 1,
            ],
            'kelurahan' => [
                'table' => 1,
                'hidecolom' => 0,
                'label' => 'Kelurahan ',
                'form' => 1,
                'form_label' => 'Kelurahan ',
                'form_type' => 'select',
                'filter' => 1,
                'filter_table' => '',
                'filter_label' => 'Kelurahan ',
                'filter_type' => 'select',
                'filter_label_class' => '',
                'filter_form_class' => '',
                'filter_value' => '',
                'keyvaldata' => $kelVal,
                'kolom' => 1,
                'sort' => 1,
            ],
            'type' => [
                'table' => 1,
                'hidecolom' => 0,
                'label' => 'Jenis ',
                'form' => 1,
                'form_label' => 'Jenis ',
                'form_type' => 'select',
                'filter' => 1,
                'filter_table' => '',
                'filter_label' => 'Jenis ',
                'filter_type' => 'select',
                'filter_label_class' => '',
                'filter_form_class' => '',
                'filter_value' => '',
                'keyvaldata' => $jenisVal,
                'kolom' => 1,
                'sort' => 1,
            ],
            'panjang' => [
                'table' => 1,
                'hidecolom' => 0,
                'label' => 'Panjang',
                'form' => 1,
                'form_label' => 'Panjang',
                'form_type' => 'text',
                'filter' => 0,
                'filter_table' => '',
                'filter_label' => 'Panjang',
                'filter_type' => '',
                'filter_label_class' => '',
                'filter_form_class' => '',
                'filter_value' => '',
                'keyvaldata' => '',
                'kolom' => 1,
                'sort' => 1,
            ],
            'lebar' => [
                'table' => 1,
                'hidecolom' => 0,
                'label' => 'Lebar',
                'form' => 1,
                'form_label' => 'Lebar',
                'form_type' => 'text',
                'filter' => 0,
                'filter_table' => '',
                'filter_label' => 'Lebar',
                'filter_type' => '',
                'filter_label_class' => '',
                'filter_form_class' => '',
                'filter_value' => '',
                'keyvaldata' => '',
                'kolom' => 1,
                'sort' => 1,
            ],
            'tinggi' => [
                'table' => 1,
                'hidecolom' => 0,
                'label' => 'Tinggi',
                'form' => 1,
                'form_label' => 'Tinggi',
                'form_type' => 'text',
                'filter' => 0,
                'filter_table' => '',
                'filter_label' => 'Tinggi',
                'filter_type' => '',
                'filter_label_class' => '',
                'filter_form_class' => '',
                'filter_value' => '',
                'keyvaldata' => '',
                'kolom' => 1,
                'sort' => 1,
            ],
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

    public function add(Request $request)
    {
        $method = $request->method();
        $kecamatan = MKecamatan::all();
        $jenis = Mjenis::all();

        if ($request->isMethod('post')) {

            $img = '';
            if (is_array($request['images'])) {
                foreach ($request['images'] as $key => $value) {
                    $img .= $value . ',';
                }
            }

            $request['foto'] = $img;

            $insert = MBencana::create($request->all());

            if ($insert) {
                return redirect()->route('bencana')
                    ->with('success', 'Tambah Data Berhasil');
            }
        }

        $data = [
            'kecamatan' => $kecamatan,
            'jenis' => $jenis
        ];

        return view('bencana.add', compact('data'));
    }

    public function edit($id, Request $request)
    {
        $bencana = MBencana::select('t_kecamatan.name as nama_kec', 't_kelurahan.name as name_kel', 't_kecamatan.kecamatan_id', 't_bencana.*')
            ->leftJoin('t_kecamatan', 't_bencana.kecamatan', '=', 't_kecamatan.kecamatan_id')
            ->leftJoin('t_kelurahan', 't_bencana.kelurahan', '=', 't_kelurahan.kelurahan_id')
            ->where('id', $id)
            ->orderByDesc('created_at')
            ->first();

        $kecamatan = MKecamatan::all();
        $jenis = Mjenis::all();
        $kelurahan = MKelurahan::where('kecamatan_id', $bencana['kecamatan_id'])->get();

        if ($request->isMethod('post')) {

            $update = MBencana::find($id)
                ->update($request->all());
            if ($update) {
                return redirect()->route('bencanaDetail', $id)
                    ->with('success', 'Edit Data Berhasil');
            }
        }

        $data = [
            'kecamatan'  => $kecamatan,
            'kelurahan' => $kelurahan,
            'bencana' => $bencana,
            'jenis' => $jenis
        ];

        return view('bencana.edit', compact('data'));
    }

    public function delete($id)
    {
        $delete = MBencana::find($id)
            ->delete();
        if ($delete) {
            return redirect()->route('bencana')
                ->with('success', 'Hapus Data Berhasil');
        }
    }

    public function detail($id)
    {
        $bencana = MBencana::select('t_kecamatan.name as nama_kec', 't_kelurahan.name as name_kel', 't_bencana.*', 't_jenis.name as jenis_bencana')
            ->leftJoin('t_kecamatan', 't_bencana.kecamatan', '=', 't_kecamatan.kecamatan_id')
            ->leftJoin('t_kelurahan', 't_bencana.kelurahan', '=', 't_kelurahan.kelurahan_id')
            ->leftJoin('t_jenis', 't_bencana.type', '=', 't_jenis.jenis_id')
            ->where('id', $id)
            ->orderByDesc('created_at')
            ->first();
        $foto = explode(',', $bencana['foto']);
        $bencana['foto'] = $foto;

        return view('bencana.detail', compact('bencana'));
    }

    public function getKelurahan($id)
    {
        $kelurahan = MKelurahan::where('kecamatan_id', $id)->get();


        echo json_encode($kelurahan);
    }
}
