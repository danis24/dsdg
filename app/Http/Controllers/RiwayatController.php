<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\riwayat\RiwayatService;
use App\Services\penduduk\PendudukService;
use PDF;

class RiwayatController extends Controller
{
    protected $riwayat;
    protected $penduduk;

    public function __construct()
    {
        $this->riwayat = new RiwayatService;
        $this->penduduk = new PendudukService;
    }

    public function browse()
    {
        $riwayat = $this->riwayat->browse();
        return view('riwayat.browse', compact('riwayat'));
    }

    public function store(Request $request)
    {
        $request->validate([
            "penduduk_id" => "required",
        ]);

        $checkPengajuan = $this->riwayat->checkPengajuan($request->penduduk_id);

        if ($checkPengajuan  != null) {
            return response()->json([
                "status" => "exist"
            ]);
        }

        $pengajuan = $this->riwayat->store([
            "penduduk_id" => $request->penduduk_id,
            "nama_pengajuan" => "Pengajuan Surat Keterangan Tidak Mampu (SKTM)",
            "status" => 0
        ]);

        if ($pengajuan) {
            return response()->json([
                "status" => "success"
            ]);
        }
        return response()->json([
            "status" => "error"
        ]);
    }

    public function prints()
    {
        return view("prints");
    }

    public function check(Request $request)
    {
        $checkNik = $this->penduduk->getPendudukByNik($request->nik);
        if ($checkNik != null) {
            $checkPengajuan = $this->riwayat->checkPengajuan($checkNik->id);
            if ($checkPengajuan != null) {
                return response()->json([
                    "status" => "success",
                    "data" => [
                        "nama" => $checkPengajuan->penduduk->nama,
                        "nama_pengajuan" => $checkPengajuan->nama_pengajuan,
                        "tanggal" => $checkPengajuan->created_at
                    ]
                ]);
            }
            return response()->json([
                "status" => "error",
                "message" => "Tidak Ada Pengajuan yang Tersedia!"
            ]);
        }
        return response()->json([
            "status" => "error",
            "message" => "NIK Tidak Di Temukan !"
        ]);
    }

    public function generatePDF($nik)
    {
        $checkNik = $this->penduduk->getPendudukByNik($nik);
        if($checkNik != null){
            $checkPengajuan = $this->riwayat->checkPengajuan($checkNik->id);
            if ($checkPengajuan != null) {
                $data = [
                    "nama" => $checkPengajuan->penduduk->nama,
                    "tempat_lahir" => $checkPengajuan->penduduk->tempat_lahir,
                    "tanggal_lahir" => $checkPengajuan->penduduk->tanggal_lahir,
                    "jenis_kelamin" => $checkPengajuan->penduduk->jenis_kelamin,
                    "agama" => $checkPengajuan->penduduk->agama,
                    "status_perkawinan" => $checkPengajuan->penduduk->status_perkawinan,
                    "pekerjaan" => $checkPengajuan->penduduk->pekerjaan,
                    "alamat" => $checkPengajuan->penduduk->alamat."RT ".$checkPengajuan->penduduk->rt." RW ".$checkPengajuan->penduduk->alamat." Desa. Cibiru Wetan Kec. Cileunyi Kab. Bandung"
                ];
                $this->riwayat->update($checkPengajuan->id, [
                    "status" => 1
                ]);
                return PDF::loadHTML($this->resultHtml($data))->stream('download.pdf');
            }
            return response()->json([
                "status" => "error",
                "message" => "Tidak Ada Pengajuan yang Tersedia!"
            ]);
        }
        return response()->json([
            "status" => "error",
            "message" => "NIK Tidak Di Temukan !"
        ]);
    }

    public function resultHtml($data)
    {
        return view('pdf', compact('data'));
    }
}
