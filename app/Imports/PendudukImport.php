<?php

namespace App\Imports;

use App\Penduduk;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class PendudukImport implements ToCollection
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $rows)
    {
        $collect = [];
        foreach ($rows as $key => $row)
        {
            if($key == 0){
                continue;
            }
            $collect[] = [
                "nik" => $row[0],
                "nama" => $row[1],
                "alamat" => $row[2],
                "rt" => $row[3],
                "rw" => $row[4],
                "umur" => $row[5],
                "tempat_lahir" => $row[6],
                "tanggal_lahir" => $row[7],
                "jenis_kelamin" => $row[8],
                "agama" => $row[9],
                "status_perkawinan" => $row[10],
                "pekerjaan" => $row[11]
            ];
        }
        return $collect;
    }
}
