<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratMasuk extends Model
{
    use HasFactory;

    protected $table = 'tbl_surat_masuk';
    protected $primaryKey = 'id';
    protected $fillable = [
        'pengirim',
       // 'penerima',
        'no_surat',
        'tgl_surat',
        //'tgl_masuk',
        'perihal',
        'berkas',
        'qrcode',
        'created_by',
        'updated_by',
    ];

    public const UPDATED_AT = 'updated_at';
    public const CREATED_AT = 'created_at';


    public static $validationRule = [
        'pengirim' => 'required',
        //'penerima' => 'required',
        'no_surat' => 'required',
        'tgl_surat' => 'required',
        //'tgl_masuk' => 'required',
        'perihal' => 'required',
    ];

    public static $attributeRule = [
        'pengirim' => 'Pengirim',
        //'penerima' => 'Penerima',
        'no_surat' => 'No Surat',
        'tgl_surat' => 'Tanggal Surat',
       // 'tgl_masuk' => 'Tanggal Masuk',
        'perihal' => 'Perihal',
        'berkas' => 'Berkas',
        'qrcode' => 'Kode QR',
    ];



}
