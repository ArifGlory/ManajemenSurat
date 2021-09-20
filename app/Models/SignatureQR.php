<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SignatureQR extends Model
{
    use HasFactory;

    protected $table = 'tbl_qrsignature';
    protected $primaryKey = 'id';
    protected $fillable = [
        'tgl',
        'judul',
        'qrcode',
        'id_opd_fk',
        'nomor_surat',
        'created_by',
        'updated_by',
    ];

    public function scopePerangkat($query)
    {
        return $query->join('tbl_opd', 'id_opd', '=', 'id_opd_fk')
            ->select(['tbl_qrsignature.*', 'nama_opd']);
    }

    public const UPDATED_AT = 'updated_at';
    public const CREATED_AT = 'created_at';


    public static $validationRule = [
        'tgl' => 'required',
        'judul' => 'required',
        'id_opd_fk' => 'required',
    ];

    public static $attributeRule = [
        'tgl' => 'Tanggal Signature',
        'judul' => 'Judul',
        'id_opd_fk' => 'Pilih Perangkat Daerah',
        'qrcode' => 'QRCODE',
    ];

}
