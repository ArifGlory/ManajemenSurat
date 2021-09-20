<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KodeQR extends Model
{
    use HasFactory;

    protected $table = 'tbl_qrcode';
    protected $primaryKey = 'id_qr';
    protected $fillable = [
        'no_surat',
        'tgl_surat',
        'id_opd_fk',
        'kepada',
        'lampiran',
        'perihal',
        'id_jenis_ttd_fk',
        'berkas',
        'qrcode',
        'created_by',
        'updated_by',
    ];

    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }

    public function scopeTahun($query)
    {
        return $query->distinct("YEAR(tgl_surat)")->selectRaw("YEAR(tgl_surat) as tahun");
    }

    public function scopeJumlahtahun($query)
    {
        return $query->distinct("YEAR(tgl_surat)")->selectRaw("YEAR(tgl_surat) as tahun");
    }

    public const UPDATED_AT = 'updated_at';
    public const CREATED_AT = 'created_at';


    public static $validationRule = [
        'tgl_surat' => 'required',
        'id_opd_fk' => 'required',
        'kepada' => 'required',
        'lampiran' => 'required',
        'perihal' => 'required',
        'id_jenis_ttd_fk' => 'required',
    ];

    public static $attributeRule = [
        'no_surat' => 'No Surat',
        'tgl_surat' => 'Tgl Surat',
        'id_opd_fk' => 'Pilih Perangkat Daerah',
        'kepada' => 'Tujuan Kepada',
        'lampiran' => 'Jumlah Lampiran',
        'perihal' => 'Perihal Surat',
        'id_jenis_ttd_fk' => 'Jenis Tanda Tangan',
        'berkas' => 'Berkas',
    ];

    public function scopeOpd($query)
    {
        return $query->join('tbl_opd', 'id_opd', '=', 'id_opd_fk')->join('tbl_jenis_ttd', 'id_jenis_ttd','=','id_jenis_ttd_fk')
            ->select(['tbl_qrcode.*', 'nama_opd', 'jenis_ttd']);
    }

}
