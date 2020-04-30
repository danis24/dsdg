<?php

namespace App\Exports;

use App\Penduduk;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PendudukExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Penduduk::all();
    }

    public function headings(): array
    {
        return [
            'Id',
            'Nik',
            'Nama',
            'Alamat',
            'RT',
            'RW',
            'Umur',
            'Tempat Lahir',
            'Tanggal Lahir',
            'Jenis Kelamin',
            'Agama',
            'Status Perkawinan',
            'Pekerjaan',
            'Foto',
            'Created At',
            'Updated At',
        ];
    }
}
