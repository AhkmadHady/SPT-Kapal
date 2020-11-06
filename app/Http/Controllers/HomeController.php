<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; 
use App\Models\Master\KomponenSistem; 
use App\Models\Proses\Skedul;
use App\Models\Proses\Pemeliharaan; 
use App\Models\Proses\PelaksanaanPemeliharaan; 
class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
 
    public function index()
    {
        $tahun          = date('Y');
        $komponen       = Pemeliharaan::GroupBy('komponen')->count();
        $sistem         = KomponenSistem::GroupBy('nama_komponen_sistem')->count();
        $skedul2         = Skedul::whereYear('tgl_skedul','=',"{$tahun}")->count();
        $pelaksanaan    = PelaksanaanPemeliharaan::whereYear('tgl_pelaksanaan','=',"{$tahun}")->count();

        $bulan_ = date('m');
        $tahun_ = date('Y');
  
        $skedul = Skedul::whereYear('tgl_skedul','=',"{$tahun_}")
                          ->whereMonth('tgl_skedul','=',"{$bulan_}")
                          ->get();

        return view('dashboard',compact('komponen','sistem','skedul','pelaksanaan','skedul2','bulan_','tahun_'));
    } 
   
}
