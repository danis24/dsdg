<?php

namespace App\Services\Penduduk;

use App\Penduduk;

class PendudukService
{
    protected $penduduk;

    public function __construct()
    {
        $this->penduduk = new Penduduk;
    }

    public function browse()
    {
        return $this->penduduk->get();
    }

    public function getPendudukByNik($nik)
    {
        return $this->penduduk->where("nik", $nik)->first();
    }

    public function read($id)
    {
        return $this->penduduk->findOrFail($id);
    }

    public function store($payload)
    {
        return $this->penduduk->create($payload);
    }

    public function update($id, $payload)
    {
        $penduduk = $this->penduduk->find($id);
        return $penduduk->update($payload);
    }

    public function delete($id)
    {
        return $this->penduduk->destroy($id);
    }
}
