<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Penduduk extends Model
{
    protected $table = "penduduk";

    protected $fillable = [
        "id",
        "nik",
        "nama",
        "alamat",
        "rt",
        "rw",
        "umur",
        "foto",
        "tempat_lahir",
        "tanggal_lahir",
        "jenis_kelamin",
        "agama",
        "status_perkawinan",
        "pekerjaan"
    ];
}
