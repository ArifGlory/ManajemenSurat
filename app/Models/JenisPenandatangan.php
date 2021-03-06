<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JenisPenandatangan extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'tbl_jenis_ttd';
    protected $primaryKey = 'id_jenis_ttd';
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'jenis_ttd',
        'nama_pejabat',
        'nip_pejabat',
        'active',
        'id_user',
        'created_by',
        'updated_by',
        'deleted_at',
    ];

    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }


    public const UPDATED_AT = 'updated_at';
    public const CREATED_AT = 'created_at';


    public static $validationRule = [
        'active' => 'required',
    ];

    public static $attributeRule = [
        'jenis_ttd' => 'Jenis Penandatangan',
        'nama_pejabat' => 'Nama Pejabat',
        'nip_pejabat' => 'NIP Pejabat',
        'active' => 'Status Aktif',
    ];

}
