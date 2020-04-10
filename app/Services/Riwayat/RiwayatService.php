<?php

namespace App\Services\Riwayat;

use App\Riwayat;

class RiwayatService
{
    protected $riwayat;

    public function __construct()
    {
        $this->riwayat = new Riwayat;
    }

    public function browse()
    {
        return $this->riwayat->get();
    }

    public function read($id)
    {
        return $this->riwayat->findOrFail($id);
    }

    public function checkPengajuan($id)
    {
        return $this->riwayat->where("penduduk_id", $id)->where("status", 0)->first();
    }

    public function store($payload)
    {
        return $this->riwayat->create($payload);
    }

    public function update($id, $payload)
    {
        $penduduk = $this->riwayat->find($id);
        return $penduduk->update($payload);
    }

    public function countRiwayat($status)
    {
        return $this->riwayat->where("status", $status)->count();
    }
}
