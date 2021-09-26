<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DisposisiSuratKeluar extends Model
{
    use HasFactory;

    protected $table = 'detail_surat_keluar';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_surat_keluar',
        'tgl_masuk',
        'kepada',
        'catatan_disposisi',
        'status_disposisi',
        'created_by',
        'updated_by',
    ];


    public const UPDATED_AT = 'updated_at';
    public const CREATED_AT = 'created_at';


    public static $validationRule = [
        'tgl_masuk' => 'required',
        'kepada' => 'required',
        'status_disposisi' => 'required',
    ];

    public static $attributeRule = [
        'tgl_masuk' => 'Tanggal Masuk Surat',
        'kepada' => 'Pejabat / Perangkat Daerah',
        'status_disposisi' => 'Status Disposisi',
    ];

//    public function scopeSuratmasuk($query)
//    {
//        return $query->leftJoin('tbl_opd', 'id_opd', '=', 'kepada')
//            ->leftJoin('tbl_opd', 'id_opd', '=', 'penerima')
//            ->select(['detail_surat_masuk.*', 'nama_opd as kepada_opd']);
//    }

}
