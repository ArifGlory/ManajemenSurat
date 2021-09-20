<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerangkatDaerah extends Model
{
    use HasFactory;

    protected $table = 'tbl_opd';
    protected $primaryKey = 'id_opd';
    protected $fillable = [
        'nama_opd',
        'alias_opd',
        'alamat_opd',
        'email_opd',
        'notelepon_opd',
        'active',
        'created_by',
        'updated_by',
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
        'nama_opd' => 'Nama Perangkat Daerah',
        'alias_opd' => 'Alias Perangkat Daerah',
        'active' => 'Status Aktif',
    ];

}
