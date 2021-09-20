<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Image;
use Vinkla\Hashids\Facades\Hashids;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function deleteFile($path, $namaFile)
    {
        if (file_exists($path . '/' . $namaFile) && $namaFile) :
            unlink($path . '/' . $namaFile);
        endif;
    }

    public function destroyBerkas($id, $model, $nameFile, $path, $paththumb)
    {
        $idDecode = Hashids::decode($id);
        $dataMaster = $model::find($idDecode)[0];
        if ($dataMaster) :
            if ($nameFile != ''):
                if ($path != '') :
                    $this->deleteFile($path, $dataMaster[$nameFile]);
                endif;
                if ($paththumb != '') :
                    $this->deleteFile($paththumb, $dataMaster[$nameFile]);
                endif;
            endif;
        else :
            return false;
        endif;
    }

    public function destroyFunction($id, $model, $nameFile, $field, $fitur, $path, $paththumb)
    {
        $idDecode = Hashids::decode($id);
        $dataMaster = $model::find($idDecode)[0];
        if ($dataMaster) :
            if ($nameFile != ''):
                if ($path != '') :
                    $this->deleteFile($path, $dataMaster[$nameFile]);
                endif;
                if ($paththumb != '') :
                    $this->deleteFile($paththumb, $dataMaster[$nameFile]);
                endif;
            endif;
            saveLogs('menghapus data ' . $dataMaster[$field] . ' pada fitur ' . $fitur);
            $delete = $model::destroy($idDecode);
            if ($delete) :
                return true;
            else :
                return false;
            endif;
        else :
            return false;
        endif;
    }

    // $this->activeFunction($id, BadanUsaha::class, $mode, $teks, 'badan_nama', 'badan_active', 'badan_updated_by', 'badan usaha');
    public function activeFunction($id, $model, $mode, $teks, $namaField, $fieldActive, $fieldUpdatedBy, $fitur)
    {
        $idDecode = Hashids::decode($id)[0];
        $dataMaster = $model::find($idDecode);
        if ($dataMaster) :
            saveLogs($teks . $dataMaster[$namaField] . ' pada fitur ' . $fitur);
            $dataUpdate = [
                $fieldActive => $mode,
                $fieldUpdatedBy => Auth::user()->id,
            ];
            //simpan perubahan
            $update = $dataMaster->update($dataUpdate);
            if ($update) :
                return true;
            else :
                return false;
            endif;
        else :
            return false;
        endif;
    }

    public function uploadImage($image, $path, $paththumb)
    {
        $nameFile = round(microtime(true) * 1000) . '.' . $image->getClientOriginalExtension();
        //thumbnail
        if ($paththumb != ''):
            $img = Image::make($image->path());
            $img->resize(100, 100, function ($constraint) {
                $constraint->aspectRatio();
            })->save($paththumb . '/' . $nameFile);
        endif;
        $image->move($path . '/', $nameFile);
        return $nameFile;
    }

    public function uploadFile($file, $path)
    {
        $nameFile = round(microtime(true) * 1000) . '.' . $file->getClientOriginalExtension();
        $file->move($path . '/', $nameFile);
        return $nameFile;
    }
}
