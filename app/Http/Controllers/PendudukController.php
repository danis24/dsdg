<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\penduduk\PendudukService;
use Maatwebsite\Excel\Facades\Excel;
use App\imports\PendudukImport;
use App\exports\PendudukExport;
use Session;

class PendudukController extends Controller
{
    protected $penduduk;

    public function __construct()
    {
        $this->penduduk = new PendudukService;
    }

    public function browse()
    {
        $penduduk = $this->penduduk->browse();
        return view('penduduk.browse', compact('penduduk'));
    }

    public function read($id)
    {
        $penduduk = $this->penduduk->read($id);
        return view('penduduk.detail', compact('penduduk'));
    }

    public function add()
    {
        return view('penduduk.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            "nik" => "required",
            "nama" => "required",
            "alamat" => "required",
            "rt" => "required",
            "rw" => "required",
            "umur" => "required",
            "image" => "required|image|mimes:jpeg,png,jpg,gif,svg|max:2048",
        ]);
        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('images'), $imageName);
        $penduduk = $this->penduduk->store([
            "nik" => $request->nik,
            "nama" => $request->nama,
            "alamat" => $request->alamat,
            "rt" => $request->rt,
            "rw" => $request->rw,
            "umur" => $request->umur,
            "tempat_lahir" => $request->tempat_lahir,
            "tanggal_lahir" => $request->tanggal_lahir,
            "jenis_kelamin" => $request->jenis_kelamin,
            "agama" => $request->agama,
            "status_perkawinan" => $request->status_perkawinan,
            "pekerjaan" => $request->pekerjaan,
            "foto" => $imageName
        ]);
        if ($penduduk) {
            return redirect()->route('penduduk.index')->with('success', 'Data Berhasil di Simpan');
        }
        return redirect()->route('penduduk.index')->with('failed', 'Data Gagal di Simpan');
    }

    public function edit($id)
    {
        $penduduk = $this->penduduk->read($id);
        return view('penduduk.edit', compact('penduduk'));
    }

    public function update($id, Request $request)
    {
        $request->validate([
            "nik" => "required",
            "nama" => "required",
            "alamat" => "required",
            "rt" => "required",
            "rw" => "required",
            "umur" => "required",
        ]);

        $penduduk = $this->penduduk->update($id, [
            "nik" => $request->nik,
            "nama" => $request->nama,
            "alamat" => $request->alamat,
            "rt" => $request->rt,
            "rw" => $request->rw,
            "umur" => $request->umur,
            "tempat_lahir" => $request->tempat_lahir,
            "tanggal_lahir" => $request->tanggal_lahir,
            "jenis_kelamin" => $request->jenis_kelamin,
            "agama" => $request->agama,
            "status_perkawinan" => $request->status_perkawinan,
            "pekerjaan" => $request->pekerjaan,
        ]);
        if ($penduduk) {
            return redirect()->route('penduduk.index')->with('success', 'Data Berhasil di Update');
        }
        return redirect()->route('penduduk.index')->with('failed', 'Data Gagal di Update');
    }

    public function export()
    {
        return Excel::download(new PendudukExport(), 'penduduk.xlsx');
    }

    public function import()
    {
        return view('penduduk.import');
    }

    public function importExcel(Request $request)
    {
		$this->validate($request, [
			'file' => 'required|mimes:csv,xls,xlsx'
		]);
		$file = $request->file('file');
		$file_name = rand().$file->getClientOriginalName();
		$file->move('file_penduduk',$file_name);
        // $collect = Excel::import(new PendudukImport, public_path('/file_penduduk/'.$file_name));
        $collections = Excel::toArray(new PendudukImport, public_path('/file_penduduk/'.$file_name));
        foreach($collections as $key => $rows){
            foreach($rows as $k => $row){
                if($k == 0){
                    continue;
                }
                if($row[0] == null){
                    continue;
                }
                if($row[1] == null){
                    continue;
                }
                $this->penduduk->store([
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
                ]);
            }
        }
		Session::flash('sukses','Data Penduduk Berhasil Diimport!');
		return redirect('/penduduk');
    }

    public function delete(Request $request)
    {
        $penduduk = $this->penduduk->delete($request->id);
        if ($penduduk) {
            return response()->json([
                "status" => "success"
            ]);
        }
        return response()->json([
            "status" => "failed"
        ]);
    }

    public function check(Request $request)
    {
        $request->validate([
            "nik" => "required"
        ]);
        $check = $this->penduduk->getPendudukByNik($request->nik);
        if ($check != null) {
            return response()->json([
                "status" => "success",
                "data" => $check
            ]);
        } else {
            return response()->json([
                "status" => "error"
            ]);
        }
    }
}
