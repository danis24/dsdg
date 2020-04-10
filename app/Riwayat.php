<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Riwayat extends Model
{
    protected $table = "riwayat";

    protected $fillable = [
        'penduduk_id',
        'nama_pengajuan',
        'status'
    ];

    public function penduduk()
    {
        return $this->belongsTo('App\Penduduk');
    }
}
