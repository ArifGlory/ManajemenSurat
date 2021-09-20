<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Disposisi;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Vinkla\Hashids\Facades\Hashids;

class DisposisiController extends Controller
{

    public function getpenerima(Request $request, $id)
    {
        //if ($request->ajax()) {
            $id_sm_fk = Hashids::decode($id)[0];

            $cekpenerima = Disposisi::where('id_sm_fk', $id_sm_fk)->orderBy('tgl_masuk', 'DESC')->first()->kepada;
            if($cekpenerima!='')
            {
                return $cekpenerima;
            }
            else{
                return '';
            }
       // }
    }

    public function destroy($id)
    {
        $this->destroyFunction($id, Disposisi::class, '', '', 'disposisi', '', '');
        if (true):
            return Respon('', true, 'Berhasil menghapus data', 200);
        else:
            return Respon('', false, 'Gagal menghapus data', 500);
        endif;
    }

    public function bulkDelete(Request $request)
    {
        $list_id = $request->input('id');
        foreach ($list_id as $id) {
            $this->destroyFunction($id, Disposisi::class, '', '', 'disposisi', '', '');
        }
        return Respon('', true, 'Berhasil menghapus beberapa data', 200);
    }

    public function create(Request $request)
    {
        $id_sm_fk = Hashids::decode($request->input('id_sm_fk'))[0];
        $tgl_masuk = $request->input('tgl_masuk');
        $penerima = $request->input('penerima');
        $kepada = $request->input('kepada');
        $catatan_disposisi = $request->input('catatan_disposisi');
        $status = $request->input('status');

        //validasi
        $data = [];
        $data['error_string'] = [];
        $data['inputerror'] = [];

        $rule = Disposisi::$validationRule;

        $validator = Validator::make($request->all(),
            $rule,
            [],
            Disposisi::$attributeRule,
        );


        if ($validator->fails()) {
            $errors = $validator->errors();
            foreach ($errors->messages() as $key => $value) {
                $data['inputerror'][] = $key;
                $data['error_string'][] = $value[0];
            }

            $data['status'] = false;
            if ($data['status'] === false) {
                echo json_encode($data);
                exit();
            }
        } else {
            $dataInput = [
                'id_sm_fk' => $id_sm_fk,
                'tgl_masuk' => DateTimeFormatDB($tgl_masuk),
                'penerima' => $penerima,
                'kepada' => $kepada,
                'catatan_disposisi' => $catatan_disposisi,
                'status' => $status,
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id,
            ];
            $data['status'] = true;
        }
        //simpan
        $insert = Disposisi::create($dataInput);
        if ($insert) {
            saveLogs('menambahkan data pada fitur disposisi');
            return Respon('', true, 'Berhasil input data', 200);
        } else {
            return Respon('', false, 'Gagal input data', 200);
        }
    }


    public function edit($id)
    {
        $checkData = Disposisi::find(Hashids::decode($id))[0];
        echo json_encode($checkData);
    }

    public function update($id, Request $request)
    {
        $idDecode = Hashids::decode($id)[0];
        $dataMaster = Disposisi::find($idDecode);
        $tgl_masuk = $request->input('tgl_masuk');
        $penerima = $request->input('penerima');
        $kepada = $request->input('kepada');
        $catatan_disposisi = $request->input('catatan_disposisi');
        $status = $request->input('status');
        //validasi
        $data = [];
        $data['error_string'] = [];
        $data['inputerror'] = [];

        $rule = Disposisi::$validationRule;
        $validator = Validator::make($request->all(),
            $rule,
            [],
            Disposisi::$attributeRule,
        );

        if ($validator->fails()) {
            $errors = $validator->errors();
            foreach ($errors->messages() as $key => $value) {
                $data['inputerror'][] = $key;
                $data['error_string'][] = $value[0];
            }
            $data['status'] = false;
            if ($data['status'] === false) {
                echo json_encode($data);
                exit();
            }
        } else {

            $dataUpdate = [
                'tgl_masuk' => DateTimeFormatDB($tgl_masuk),
                'penerima' => $penerima,
                'kepada' => $kepada,
                'catatan_disposisi' => $catatan_disposisi,
                'status' => $status,
            ];

            $data['status'] = true;
        }
        //simpan
        $update = $dataMaster->update($dataUpdate);
        if ($update) {
            saveLogs('mengubah data pada fitur disposisi');
            return Respon('', true, 'Berhasil input data', 200);
        } else {
            return Respon('', false, 'Gagal input data', 200);
        }
    }


}
