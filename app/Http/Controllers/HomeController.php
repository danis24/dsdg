<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Penduduk\PendudukService;
use App\Services\Riwayat\RiwayatService;
use App\Services\Users\UserService;

class HomeController extends Controller
{
    protected $penduduk;
    protected $riwayat;
    protected $user;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->penduduk = new PendudukService;
        $this->riwayat = new RiwayatService;
        $this->user = new UserService;

        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data = [
            "userCount" => $this->user->browse()->count(),
            "pendudukCount" => $this->penduduk->browse()->count(),
            "riwayatPendingCount" => $this->riwayat->countRiwayat(0),
            "riwayatSuccessCount" => $this->riwayat->countRiwayat(1)
        ];
        return view('home', compact('data'));
    }
}
