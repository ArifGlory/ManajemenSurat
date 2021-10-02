<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\JenisPenandatangan;
use App\Models\User;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Vinkla\Hashids\Facades\Hashids;

class JenisPenandatanganController extends Controller
{
    public function index()
    {
        $list_level_ttd = array('seketaris','kabag','direktur');
        $list_user = User::whereIn('level',$list_level_ttd)->get();

        return view('dashboard_page.jenis-penandatangan.index',compact('list_user'));
    }

    public function data(Request $request)
    {
        $data = JenisPenandatangan::select('tbl_jenis_ttd.*','users.username')
            ->leftJoin('users','users.id','=','tbl_jenis_ttd.id_user');
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('checkbox', function ($row) {
                $checkbox = '<input type="checkbox" value="' . Hashids::encode($row->id_jenis_ttd) . '" class="data-check">';
                return $checkbox;
            })
            ->editColumn('id_jenis_ttd', function ($row) {
                return Hashids::encode($row->id_jenis_ttd);
            })
            ->editColumn('active', function ($row) {
                $active = '<div class="'.getActive($row->active).' text-small font-600-bold"><i class="fas fa-circle"></i> '.getActiveTeks($row->active).'</div>';
                return $active;
            })
            ->addColumn('action', function ($row) {
                $btn = '<div class="btn-group" role="group" aria-label="First group">';
                $btn .= '<a href="javascript:void(0)" class="btn btn-sm btn-icon btn-success waves-effect clickable-edit" title="Edit"
                data-id_jenis_ttd="' . Hashids::encode($row->id_jenis_ttd) . '"
                data-jenis_ttd="' . $row->jenis_ttd . '"
                data-nama_pejabat="' . $row->nama_pejabat . '"
                data-nip_pejabat="' . $row->nip_pejabat . '"
                data-id_user="' . $row->id_user . '"
                data-active="' . $row->active . '"><i class="fa fa-edit"></i></button>';
                $btn .= '<a href="javascript:void(0)" onclick="deleteData(' . "'" . Hashids::encode($row->id_jenis_ttd) . "'" . ')" class="btn btn-sm btn-icon btn-danger waves-effect" title="Hapus"><i class="fa fa-trash"></i></button>';
                $btn .= '</div>';
                return $btn;
            })
            ->escapeColumns([])
            ->toJson();
    }

    public function destroy($id)
    {
        $this->destroyFunction($id, JenisPenandatangan::class, '', 'jenis_ttd', 'jenis penandatangan', '', '');
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
            $this->destroyFunction($id, JenisPenandatangan::class, '', 'jenis_ttd', 'jenis penandatangan', '', '');
        }
        return Respon('', true, 'Berhasil menghapus beberapa data', 200);
    }

    public function create(Request $request)
    {

        $active = $request->input('active');
        $jenis_ttd = $request->input('jenis_ttd');
        $nama_pejabat = $request->input('nama_pejabat');
        $nip_pejabat = $request->input('nip_pejabat');
        $id_user = $request->input('id_user');

        //validasi
        $data = [];
        $data['error_string'] = [];
        $data['inputerror'] = [];

        $rule = JenisPenandatangan::$validationRule;
        $rule['jenis_ttd'] = 'required|max:255|unique:tbl_jenis_ttd,jenis_ttd';
        $rule['nama_pejabat'] = 'required';
        $rule['nip_pejabat'] = 'required';

        $validator = Validator::make($request->all(),
            $rule,
            [],
            JenisPenandatangan::$attributeRule,
        );

       if($request->hasFile('cert')) {
           if($request->file('cert')->getClientMimeType() != 'application/x-x509-ca-cert' && in_array($request->file('cert')->getClientOriginalExtension(), ['crt', 'cer'])) {
               $data['inputerror'][] = 'cert';
               $data['error_string'][] = 'Cert file bukan berupa sertifikat.';
               echo json_encode($data);
               exit();
           }
       }

       if($request->hasFile('priv_key')) {
           if($request->file('priv_key')->getClientMimeType() != 'application/octet-stream' && in_array($request->file('priv_key')->getClientOriginalExtension(), ['key'])) {
                $data['inputerror'][] = 'priv_key';
                $data['error_string'][] = 'Cert file bukan berupa sertifikat.';
                echo json_encode($data);
                exit();
            }
        }
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
                'active' => $active,
                'jenis_ttd' => $jenis_ttd,
                'nama_pejabat' => $nama_pejabat,
                'nip_pejabat' => $nip_pejabat,
                'id_user' => $id_user,
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id,
            ];
            $data['status'] = true;
        }
        if($request->has('cert')) {
            $file_name = round(microtime(true) * 1000) . '.' . $request->file('cert')->getClientOriginalExtension();
            $dataInput['cert'] = Storage::putFileAs('cert', $request->file('cert'), $file_name, 'private');
        }
        if($request->has('priv_key')) {
            $file_name = round(microtime(true) * 1000) . '.' . $request->file('priv_key')->getClientOriginalExtension();
            $dataInput['priv_key'] = Storage::putFileAs('priv_key', $request->file('priv_key'), $file_name, 'private');
        }
        //simpan
        $insert = JenisPenandatangan::create($dataInput);
        if ($insert) {
            saveLogs('menambahkan data ' . $jenis_ttd . ' pada fitur kategori');
            return Respon('', true, 'Berhasil input data', 200);
        } else {
            return Respon('', false, 'Gagal input data', 200);
        }
    }


    public function edit($id)
    {
        $checkData = JenisPenandatangan::find(Hashids::decode($id))[0];
        echo json_encode($checkData);
    }

    public function update($id, Request $request)
    {

        $idDecode = Hashids::decode($id)[0];
        $dataMaster = JenisPenandatangan::find($idDecode);
        $active = $request->input('active');
        $jenis_ttd = $request->input('jenis_ttd');
        $id_user = $request->input('id_user');
        //validasi
        $data = [];
        $data['error_string'] = [];
        $data['inputerror'] = [];

        $rule = JenisPenandatangan::$validationRule;
        $rule['jenis_ttd'] = 'required|max:255|unique:tbl_jenis_ttd,jenis_ttd,' . $idDecode . ',id_jenis_ttd';
        $validator = Validator::make($request->all(),
            $rule,
            [],
            JenisPenandatangan::$attributeRule,
        );

        if($request->hasFile('cert')) {
            if($request->file('cert')->getClientMimeType() != 'application/x-x509-ca-cert' && in_array($request->file('priv_key')->getClientOriginalExtension(), ['crt', 'cer'])) {
                $data['inputerror'][] = 'cert';
                $data['error_string'][] = 'Cert file bukan berupa sertifikat.';
                echo json_encode($data);
                exit();
            }

            if ($dataMaster->cert != null && Storage::exists($dataMaster->cert)) {
                Storage::delete($dataMaster->cert);
            }
            $file_name = round(microtime(true) * 1000) . '.' . $request->file('cert')->getClientOriginalExtension();
            $fileCert = Storage::putFileAs('cert', $request->file('cert'), $file_name, 'private');
        }

        if($request->hasFile('priv_key')) {
            if($request->file('priv_key')->getClientMimeType() != 'application/octet-stream' && in_array($request->file('priv_key')->getClientOriginalExtension(), ['key'])) {
                $data['inputerror'][] = 'priv_key';
                $data['error_string'][] = 'Private Key file bukan berupa sertifikat.';
                echo json_encode($data);
                exit();
            }

            if ($dataMaster->priv_key != null && Storage::exists($dataMaster->priv_key)) {
                Storage::delete($dataMaster->priv_key);
            }
            $file_name = round(microtime(true) * 1000) . '.' . $request->file('priv_key')->getClientOriginalExtension();
            $filePrivCert = Storage::putFileAs('priv_key', $request->file('priv_key'), $file_name, 'private');
        }


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
                'active' => $active,
                'jenis_ttd' => $jenis_ttd,
                'id_user' => $id_user,
                'updated_by' => Auth::user()->id,
            ];
            if($request->hasFile('cert')) {
                $dataUpdate['cert'] = $fileCert;
            }
            if($request->hasFile('priv_key')) {
                $dataUpdate['priv_key'] = $filePrivCert;
            }
            $data['status'] = true;
        }
        //simpan
        $update = $dataMaster->update($dataUpdate);
        if ($update) {
            saveLogs('mengubah data ' . $jenis_ttd . ' pada fitur kategori');
            return Respon('', true, 'Berhasil input data', 200);
        } else {
            return Respon('', false, 'Gagal input data', 200);
        }
    }


}
