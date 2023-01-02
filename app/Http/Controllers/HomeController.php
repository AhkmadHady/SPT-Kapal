<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; 
use App\Models\Master\KomponenSistem;
use App\Models\Proses\Kerusakan;
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
        $tanggal        = date('Y-m-d');
        $komponen       = Kerusakan::select('komponen')->count();

        $autstanding    = Skedul::whereYear('tgl_skedul','=',"{$tahun}")->where('tgl_skedul','<',"{$tanggal}")->where('status','=',0)->count();

        $skedul2        = Skedul::whereYear('tgl_skedul','=',"{$tahun}")->where('status','=',0)->count();
        $pelaksanaan    = PelaksanaanPemeliharaan::whereYear('tgl_pelaksanaan','=',"{$tahun}")->count();

        $bulan_ = date('m');
        $tahun_ = date('Y');
  
        $skedul = Skedul::whereYear('tgl_skedul','=',"{$tahun_}")
                          ->whereMonth('tgl_skedul','=',"{$bulan_}")
                          ->get();

        return view('dashboard',compact('komponen','autstanding','skedul','pelaksanaan','skedul2','bulan_','tahun_'));
    } 

    // get data periode skedul
    public function jadwalSkedule(Request $request)
    {
        $tahun          = date('Y');
        $tanggal        = date('Y-m-d');
        $komponen       = Kerusakan::select('komponen')->count();

        $autstanding    = Skedul::whereYear('tgl_skedul','=',"{$tahun}")->where('tgl_skedul','<',"{$tanggal}")->where('status','=',0)->count();

        $skedul2        = Skedul::whereYear('tgl_skedul','=',"{$tahun}")->where('status','=',0)->count();
        $pelaksanaan    = PelaksanaanPemeliharaan::whereYear('tgl_pelaksanaan','=',"{$tahun}")->count();

        $bulan_ = $request->bulan;
        $tahun_ = $request->tahun;
  
        $skedul = Skedul::whereYear('tgl_skedul','=',"{$tahun_}")
                          ->whereMonth('tgl_skedul','=',"{$bulan_}")
                          ->get();
        
                          return view('dashboard',compact('komponen','autstanding','skedul','pelaksanaan','skedul2','bulan_','tahun_'));
        
    }
}
