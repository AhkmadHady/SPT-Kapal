<?php

namespace App\Http\Controllers\Proses;

use App\Models\Proses\Skedul;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input; 
use Illuminate\Contracts\Auth\User;
use App\Models\Master\KomponenLokasi;
use App\Models\Master\Pelaksana;
use App\Models\Master\KomponenPokok;
use App\Models\Master\KomponenSistem;
use App\Models\Master\KomponenSubPokok;
use App\Models\Master\KomponenSubSistem; 
use App\Models\Master\Periode; 
use App\Models\Proses\Pemeliharaan; 
use App\Models\Proses\PelaksanaanPemeliharaan; 
use Validator;
use Response;
use View;
use DB;
use File;
use Laravel\Ui\Presets\React;
use PDF; 
class PelaksanaanControllers extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /*** Index Pelaksanaan ***/
    public function index(Request $request)
    {
        $paginate = 1;
        $kelompok       = KomponenPokok::OrderBy('id','desc')->get();
        $subkelompok    = KomponenSubPokok::OrderBy('id','desc')->get();
        $sistem         = KomponenSistem::OrderBy('id','desc')->get();
        $subsistem      = KomponenSubSistem::OrderBy('id','desc')->get();
        $pelaksana      = Pelaksana::OrderBy('id','desc')->get();
        $periode        = Periode::OrderBy('id','desc')->get();
        $lokasi         = KomponenLokasi::OrderBy('id','desc')->get();

    	$pelaksanaan = DB::table('pelaksanaan_pemeliharaan as pp')
    	  				->leftjoin('skedul as sk','pp.id_skedul','=','sk.id')
                        ->leftjoin('kartu_pemeliharaan as kp','sk.kode_pemeliharaan','=','kp.kode_pemeliharaan')
                        ->leftjoin('komponen_pokok as komp','kp.id_komponen_pokok','=','komp.id')
                        ->leftjoin('komponen_sub_pokok as ksp','kp.id_komponen_sub_pokok','=','ksp.id')
                        ->leftjoin('komponen_sistem as ks','kp.id_sistem','=','ks.id')
                        ->leftjoin('komponen_sub_sistem as kss','kp.id_sub_sistem','=','kss.id')
                        ->leftjoin('pelaksana as pel','kp.id_pelaksana','=','pel.id')
                        ->leftjoin('lokasi as lok','kp.id_lokasi','=','lok.id') 
                        ->leftjoin('periode as per','kp.id_periode','=','per.id')
                        ->select('kp.tanggal','kp.kode_pemeliharaan','kp.id_komponen_pokok','kp.id_komponen_sub_pokok','kp.id_sistem','kp.id_sub_sistem','kp.id_pelaksana','kp.id_lokasi','kp.uraian_pemeliharaan','kp.tindakan_pengamanan','kp.prosedur','komp.kode_pokok','komp.nama_pokok','ksp.kode_sub_pokok','ksp.nama_sub_pokok','ks.kode_komponen_sistem','ks.nama_komponen_sistem','kss.kode_komponen_sub_sistem','kss.nama_komponen_sub_sistem','pel.nama_pelaksana','lok.nama_lokasi','kp.komponen','kp.alat_kerja','sk.id','kp.jo','per.periode','kp.tgl_mulai','sk.status','sk.tgl_skedul','pp.tgl_pelaksanaan','pp.catatan','pp.id as id_pelaksanaan')
                        ->OrderBy('pp.id','desc')
                        ->paginate(50);

    	return view('proses.pelaksanaan.pelaksanaan',compact('pelaksanaan','kelompok','subkelompok','sistem','subsistem','pelaksana','periode','lokasi','paginate'));
    }

    /*** Pencarian Pelaksanaan Kelompok ***/
    public function pencarianPelaksanaanKelompok(Request $request)
    {
        $pelaksanaan = DB::table('pelaksanaan_pemeliharaan as pp')
    	  				->leftjoin('skedul as sk','pp.id_skedul','=','sk.id')
                        ->leftjoin('kartu_pemeliharaan as kp','sk.kode_pemeliharaan','=','kp.kode_pemeliharaan')
                        ->leftjoin('komponen_pokok as komp','kp.id_komponen_pokok','=','komp.id')
                        ->leftjoin('komponen_sub_pokok as ksp','kp.id_komponen_sub_pokok','=','ksp.id')
                        ->leftjoin('komponen_sistem as ks','kp.id_sistem','=','ks.id')
                        ->leftjoin('komponen_sub_sistem as kss','kp.id_sub_sistem','=','kss.id')
                        ->leftjoin('pelaksana as pel','kp.id_pelaksana','=','pel.id')
                        ->leftjoin('lokasi as lok','kp.id_lokasi','=','lok.id') 
                        ->leftjoin('periode as per','kp.id_periode','=','per.id')
                        ->select('kp.tanggal','kp.kode_pemeliharaan','kp.id_komponen_pokok','kp.id_komponen_sub_pokok','kp.id_sistem','kp.id_sub_sistem','kp.id_pelaksana','kp.id_lokasi','kp.uraian_pemeliharaan','kp.tindakan_pengamanan','kp.prosedur','komp.kode_pokok','komp.nama_pokok','ksp.kode_sub_pokok','ksp.nama_sub_pokok','ks.kode_komponen_sistem','ks.nama_komponen_sistem','kss.kode_komponen_sub_sistem','kss.nama_komponen_sub_sistem','pel.nama_pelaksana','lok.nama_lokasi','kp.komponen','kp.alat_kerja','sk.id','kp.jo','per.periode','kp.tgl_mulai','sk.status','sk.tgl_skedul','pp.tgl_pelaksanaan','pp.catatan','pp.id as id_pelaksanaan')
                        ->where('kp.id_komponen_pokok','=',"{$request->id_komponen_pokok}")
                        ->OrderBy('pp.id','desc')
                        ->get();

    	return view('proses.pelaksanaan.data_list_pelaksanaan',compact('pelaksanaan'));
    } 

    /*** Pencarian Pelaksanaan SubKelompok ***/
    public function pencarianPelaksanaanSubKelompok(Request $request)
    {
        $pelaksanaan = DB::table('pelaksanaan_pemeliharaan as pp')
    	  				->leftjoin('skedul as sk','pp.id_skedul','=','sk.id')
                        ->leftjoin('kartu_pemeliharaan as kp','sk.kode_pemeliharaan','=','kp.kode_pemeliharaan')
                        ->leftjoin('komponen_pokok as komp','kp.id_komponen_pokok','=','komp.id')
                        ->leftjoin('komponen_sub_pokok as ksp','kp.id_komponen_sub_pokok','=','ksp.id')
                        ->leftjoin('komponen_sistem as ks','kp.id_sistem','=','ks.id')
                        ->leftjoin('komponen_sub_sistem as kss','kp.id_sub_sistem','=','kss.id')
                        ->leftjoin('pelaksana as pel','kp.id_pelaksana','=','pel.id')
                        ->leftjoin('lokasi as lok','kp.id_lokasi','=','lok.id') 
                        ->leftjoin('periode as per','kp.id_periode','=','per.id')
                        ->select('kp.tanggal','kp.kode_pemeliharaan','kp.id_komponen_pokok','kp.id_komponen_sub_pokok','kp.id_sistem','kp.id_sub_sistem','kp.id_pelaksana','kp.id_lokasi','kp.uraian_pemeliharaan','kp.tindakan_pengamanan','kp.prosedur','komp.kode_pokok','komp.nama_pokok','ksp.kode_sub_pokok','ksp.nama_sub_pokok','ks.kode_komponen_sistem','ks.nama_komponen_sistem','kss.kode_komponen_sub_sistem','kss.nama_komponen_sub_sistem','pel.nama_pelaksana','lok.nama_lokasi','kp.komponen','kp.alat_kerja','sk.id','kp.jo','per.periode','kp.tgl_mulai','sk.status','sk.tgl_skedul','pp.tgl_pelaksanaan','pp.catatan','pp.id as id_pelaksanaan')
                        ->where('kp.id_komponen_sub_pokok','=',"{$request->id_komponen_sub_pokok}")
                        ->OrderBy('pp.id','desc')
                        ->get();

    	return view('proses.pelaksanaan.data_list_pelaksanaan',compact('pelaksanaan'));
    } 

    /*** Pencarian Pelaksanaan Sistem ***/
    public function pencarianPelaksanaanSistem(Request $request)
    {
        $pelaksanaan = DB::table('pelaksanaan_pemeliharaan as pp')
    	  				->leftjoin('skedul as sk','pp.id_skedul','=','sk.id')
                        ->leftjoin('kartu_pemeliharaan as kp','sk.kode_pemeliharaan','=','kp.kode_pemeliharaan')
                        ->leftjoin('komponen_pokok as komp','kp.id_komponen_pokok','=','komp.id')
                        ->leftjoin('komponen_sub_pokok as ksp','kp.id_komponen_sub_pokok','=','ksp.id')
                        ->leftjoin('komponen_sistem as ks','kp.id_sistem','=','ks.id')
                        ->leftjoin('komponen_sub_sistem as kss','kp.id_sub_sistem','=','kss.id')
                        ->leftjoin('pelaksana as pel','kp.id_pelaksana','=','pel.id')
                        ->leftjoin('lokasi as lok','kp.id_lokasi','=','lok.id') 
                        ->leftjoin('periode as per','kp.id_periode','=','per.id')
                        ->select('kp.tanggal','kp.kode_pemeliharaan','kp.id_komponen_pokok','kp.id_komponen_sub_pokok','kp.id_sistem','kp.id_sub_sistem','kp.id_pelaksana','kp.id_lokasi','kp.uraian_pemeliharaan','kp.tindakan_pengamanan','kp.prosedur','komp.kode_pokok','komp.nama_pokok','ksp.kode_sub_pokok','ksp.nama_sub_pokok','ks.kode_komponen_sistem','ks.nama_komponen_sistem','kss.kode_komponen_sub_sistem','kss.nama_komponen_sub_sistem','pel.nama_pelaksana','lok.nama_lokasi','kp.komponen','kp.alat_kerja','sk.id','kp.jo','per.periode','kp.tgl_mulai','sk.status','sk.tgl_skedul','pp.tgl_pelaksanaan','pp.catatan','pp.id as id_pelaksanaan')
                        ->where('kp.id_sistem','=',"{$request->id_sistem}")
                        ->OrderBy('pp.id','desc')
                        ->get();

    	return view('proses.pelaksanaan.data_list_pelaksanaan',compact('pelaksanaan'));
    } 

    /*** Pencarian Pelaksanaan SubSistem ***/
    public function pencarianPelaksanaanSubSistem(Request $request)
    {
        $pelaksanaan = DB::table('pelaksanaan_pemeliharaan as pp')
    	  				->leftjoin('skedul as sk','pp.id_skedul','=','sk.id')
                        ->leftjoin('kartu_pemeliharaan as kp','sk.kode_pemeliharaan','=','kp.kode_pemeliharaan')
                        ->leftjoin('komponen_pokok as komp','kp.id_komponen_pokok','=','komp.id')
                        ->leftjoin('komponen_sub_pokok as ksp','kp.id_komponen_sub_pokok','=','ksp.id')
                        ->leftjoin('komponen_sistem as ks','kp.id_sistem','=','ks.id')
                        ->leftjoin('komponen_sub_sistem as kss','kp.id_sub_sistem','=','kss.id')
                        ->leftjoin('pelaksana as pel','kp.id_pelaksana','=','pel.id')
                        ->leftjoin('lokasi as lok','kp.id_lokasi','=','lok.id') 
                        ->leftjoin('periode as per','kp.id_periode','=','per.id')
                        ->select('kp.tanggal','kp.kode_pemeliharaan','kp.id_komponen_pokok','kp.id_komponen_sub_pokok','kp.id_sistem','kp.id_sub_sistem','kp.id_pelaksana','kp.id_lokasi','kp.uraian_pemeliharaan','kp.tindakan_pengamanan','kp.prosedur','komp.kode_pokok','komp.nama_pokok','ksp.kode_sub_pokok','ksp.nama_sub_pokok','ks.kode_komponen_sistem','ks.nama_komponen_sistem','kss.kode_komponen_sub_sistem','kss.nama_komponen_sub_sistem','pel.nama_pelaksana','lok.nama_lokasi','kp.komponen','kp.alat_kerja','sk.id','kp.jo','per.periode','kp.tgl_mulai','sk.status','sk.tgl_skedul','pp.tgl_pelaksanaan','pp.catatan','pp.id as id_pelaksanaan')
                        ->where('kp.id_sub_sistem','=',"{$request->id_sub_sistem}")
                        ->OrderBy('pp.id','desc')
                        ->get();

    	return view('proses.pelaksanaan.data_list_pelaksanaan',compact('pelaksanaan'));
    } 

    /*** Pencarian Pelaksanaan Pelaksana ***/
    public function pencarianPelaksanaanPelaksana(Request $request)
    {
        $pelaksanaan = DB::table('pelaksanaan_pemeliharaan as pp')
                            ->leftjoin('skedul as sk','pp.id_skedul','=','sk.id')
                        ->leftjoin('kartu_pemeliharaan as kp','sk.kode_pemeliharaan','=','kp.kode_pemeliharaan')
                        ->leftjoin('komponen_pokok as komp','kp.id_komponen_pokok','=','komp.id')
                        ->leftjoin('komponen_sub_pokok as ksp','kp.id_komponen_sub_pokok','=','ksp.id')
                        ->leftjoin('komponen_sistem as ks','kp.id_sistem','=','ks.id')
                        ->leftjoin('komponen_sub_sistem as kss','kp.id_sub_sistem','=','kss.id')
                        ->leftjoin('pelaksana as pel','kp.id_pelaksana','=','pel.id')
                        ->leftjoin('lokasi as lok','kp.id_lokasi','=','lok.id') 
                        ->leftjoin('periode as per','kp.id_periode','=','per.id')
                        ->select('kp.tanggal','kp.kode_pemeliharaan','kp.id_komponen_pokok','kp.id_komponen_sub_pokok','kp.id_sistem','kp.id_sub_sistem','kp.id_pelaksana','kp.id_lokasi','kp.uraian_pemeliharaan','kp.tindakan_pengamanan','kp.prosedur','komp.kode_pokok','komp.nama_pokok','ksp.kode_sub_pokok','ksp.nama_sub_pokok','ks.kode_komponen_sistem','ks.nama_komponen_sistem','kss.kode_komponen_sub_sistem','kss.nama_komponen_sub_sistem','pel.nama_pelaksana','lok.nama_lokasi','kp.komponen','kp.alat_kerja','sk.id','kp.jo','per.periode','kp.tgl_mulai','sk.status','sk.tgl_skedul','pp.tgl_pelaksanaan','pp.catatan','pp.id as id_pelaksanaan')
                        ->where('kp.id_pelaksana','=',"{$request->id_pelaksana}")
                        ->OrderBy('pp.id','desc')
                        ->get();

        return view('proses.pelaksanaan.data_list_pelaksanaan',compact('pelaksanaan'));
    } 

    /*** Pencarian Pelaksanaan Lokasi ***/
    public function pencarianPelaksanaanLokasi(Request $request)
    {
        $pelaksanaan = DB::table('pelaksanaan_pemeliharaan as pp')
                            ->leftjoin('skedul as sk','pp.id_skedul','=','sk.id')
                        ->leftjoin('kartu_pemeliharaan as kp','sk.kode_pemeliharaan','=','kp.kode_pemeliharaan')
                        ->leftjoin('komponen_pokok as komp','kp.id_komponen_pokok','=','komp.id')
                        ->leftjoin('komponen_sub_pokok as ksp','kp.id_komponen_sub_pokok','=','ksp.id')
                        ->leftjoin('komponen_sistem as ks','kp.id_sistem','=','ks.id')
                        ->leftjoin('komponen_sub_sistem as kss','kp.id_sub_sistem','=','kss.id')
                        ->leftjoin('pelaksana as pel','kp.id_pelaksana','=','pel.id')
                        ->leftjoin('lokasi as lok','kp.id_lokasi','=','lok.id') 
                        ->leftjoin('periode as per','kp.id_periode','=','per.id')
                        ->select('kp.tanggal','kp.kode_pemeliharaan','kp.id_komponen_pokok','kp.id_komponen_sub_pokok','kp.id_sistem','kp.id_sub_sistem','kp.id_pelaksana','kp.id_lokasi','kp.uraian_pemeliharaan','kp.tindakan_pengamanan','kp.prosedur','komp.kode_pokok','komp.nama_pokok','ksp.kode_sub_pokok','ksp.nama_sub_pokok','ks.kode_komponen_sistem','ks.nama_komponen_sistem','kss.kode_komponen_sub_sistem','kss.nama_komponen_sub_sistem','pel.nama_pelaksana','lok.nama_lokasi','kp.komponen','kp.alat_kerja','sk.id','kp.jo','per.periode','kp.tgl_mulai','sk.status','sk.tgl_skedul','pp.tgl_pelaksanaan','pp.catatan','pp.id as id_pelaksanaan')
                        ->where('kp.id_lokasi','=',"{$request->id_lokasi}")
                        ->OrderBy('pp.id','desc')
                        ->get();

        return view('proses.pelaksanaan.data_list_pelaksanaan',compact('pelaksanaan'));
    }
    
    /*** Pencarian Pelaksanaan Periode ***/
    public function pencarianPelaksanaanPeriode(Request $request)
    {
        $pelaksanaan = DB::table('pelaksanaan_pemeliharaan as pp')
                            ->leftjoin('skedul as sk','pp.id_skedul','=','sk.id')
                        ->leftjoin('kartu_pemeliharaan as kp','sk.kode_pemeliharaan','=','kp.kode_pemeliharaan')
                        ->leftjoin('komponen_pokok as komp','kp.id_komponen_pokok','=','komp.id')
                        ->leftjoin('komponen_sub_pokok as ksp','kp.id_komponen_sub_pokok','=','ksp.id')
                        ->leftjoin('komponen_sistem as ks','kp.id_sistem','=','ks.id')
                        ->leftjoin('komponen_sub_sistem as kss','kp.id_sub_sistem','=','kss.id')
                        ->leftjoin('pelaksana as pel','kp.id_pelaksana','=','pel.id')
                        ->leftjoin('lokasi as lok','kp.id_lokasi','=','lok.id') 
                        ->leftjoin('periode as per','kp.id_periode','=','per.id')
                        ->select('kp.tanggal','kp.kode_pemeliharaan','kp.id_komponen_pokok','kp.id_komponen_sub_pokok','kp.id_sistem','kp.id_sub_sistem','kp.id_pelaksana','kp.id_lokasi','kp.uraian_pemeliharaan','kp.tindakan_pengamanan','kp.prosedur','komp.kode_pokok','komp.nama_pokok','ksp.kode_sub_pokok','ksp.nama_sub_pokok','ks.kode_komponen_sistem','ks.nama_komponen_sistem','kss.kode_komponen_sub_sistem','kss.nama_komponen_sub_sistem','pel.nama_pelaksana','lok.nama_lokasi','kp.komponen','kp.alat_kerja','sk.id','kp.jo','per.periode','kp.tgl_mulai','sk.status','sk.tgl_skedul','pp.tgl_pelaksanaan','pp.catatan','kp.id_periode','pp.id as id_pelaksanaan')
                        ->where('per.periode','like',"%{$request->id_periode}%")
                        ->OrderBy('pp.id','desc')
                        ->get();

        return view('proses.pelaksanaan.data_list_pelaksanaan',compact('pelaksanaan'));
    } 

    /*** Pencarian Pelaksanaan Komponen ***/
    public function pencarianPelaksanaanKomponen(Request $request)
    {
        $pelaksanaan = DB::table('pelaksanaan_pemeliharaan as pp')
                            ->leftjoin('skedul as sk','pp.id_skedul','=','sk.id')
                        ->leftjoin('kartu_pemeliharaan as kp','sk.kode_pemeliharaan','=','kp.kode_pemeliharaan')
                        ->leftjoin('komponen_pokok as komp','kp.id_komponen_pokok','=','komp.id')
                        ->leftjoin('komponen_sub_pokok as ksp','kp.id_komponen_sub_pokok','=','ksp.id')
                        ->leftjoin('komponen_sistem as ks','kp.id_sistem','=','ks.id')
                        ->leftjoin('komponen_sub_sistem as kss','kp.id_sub_sistem','=','kss.id')
                        ->leftjoin('pelaksana as pel','kp.id_pelaksana','=','pel.id')
                        ->leftjoin('lokasi as lok','kp.id_lokasi','=','lok.id') 
                        ->leftjoin('periode as per','kp.id_periode','=','per.id')
                        ->select('kp.tanggal','kp.kode_pemeliharaan','kp.id_komponen_pokok','kp.id_komponen_sub_pokok','kp.id_sistem','kp.id_sub_sistem','kp.id_pelaksana','kp.id_lokasi','kp.uraian_pemeliharaan','kp.tindakan_pengamanan','kp.prosedur','komp.kode_pokok','komp.nama_pokok','ksp.kode_sub_pokok','ksp.nama_sub_pokok','ks.kode_komponen_sistem','ks.nama_komponen_sistem','kss.kode_komponen_sub_sistem','kss.nama_komponen_sub_sistem','pel.nama_pelaksana','lok.nama_lokasi','kp.komponen','kp.alat_kerja','sk.id','kp.jo','per.periode','kp.tgl_mulai','sk.status','sk.tgl_skedul','pp.tgl_pelaksanaan','pp.catatan','kp.id_periode','pp.id as id_pelaksanaan')
                        ->where('kp.komponen','like',"%{$request->komponen}%")
                        ->OrderBy('pp.id','desc')
                        ->get();

        return view('proses.pelaksanaan.data_list_pelaksanaan',compact('pelaksanaan'));
    } 

    /*** Pencarian Pelaksanaan Tgl Pelaksanaan ***/
    public function pencarianPelaksanaanWaktuPelaksanaan(Request $request)
    {
        $pelaksanaan = DB::table('pelaksanaan_pemeliharaan as pp')
                            ->leftjoin('skedul as sk','pp.id_skedul','=','sk.id')
                            ->leftjoin('kartu_pemeliharaan as kp','sk.kode_pemeliharaan','=','kp.kode_pemeliharaan')
                            ->leftjoin('komponen_pokok as komp','kp.id_komponen_pokok','=','komp.id')
                            ->leftjoin('komponen_sub_pokok as ksp','kp.id_komponen_sub_pokok','=','ksp.id')
                            ->leftjoin('komponen_sistem as ks','kp.id_sistem','=','ks.id')
                            ->leftjoin('komponen_sub_sistem as kss','kp.id_sub_sistem','=','kss.id')
                            ->leftjoin('pelaksana as pel','kp.id_pelaksana','=','pel.id')
                            ->leftjoin('lokasi as lok','kp.id_lokasi','=','lok.id') 
                            ->leftjoin('periode as per','kp.id_periode','=','per.id')
                            ->select('kp.tanggal','kp.kode_pemeliharaan','kp.id_komponen_pokok','kp.id_komponen_sub_pokok','kp.id_sistem','kp.id_sub_sistem','kp.id_pelaksana','kp.id_lokasi','kp.uraian_pemeliharaan','kp.tindakan_pengamanan','kp.prosedur','komp.kode_pokok','komp.nama_pokok','ksp.kode_sub_pokok','ksp.nama_sub_pokok','ks.kode_komponen_sistem','ks.nama_komponen_sistem','kss.kode_komponen_sub_sistem','kss.nama_komponen_sub_sistem','pel.nama_pelaksana','lok.nama_lokasi','kp.komponen','kp.alat_kerja','sk.id','kp.jo','per.periode','kp.tgl_mulai','sk.status','sk.tgl_skedul','pp.tgl_pelaksanaan','pp.catatan','kp.id_periode','pp.id as id_pelaksanaan')
                            ->where('pp.tgl_pelaksanaan','=',"{$request->tanggal}")
                            ->OrderBy('pp.id','desc')
                            ->get();

        return view('proses.pelaksanaan.data_list_pelaksanaan',compact('pelaksanaan'));
    } 

    /*** Delete Pelaksanaan ***/
    public function deletePelaksanaan(Request $request)
    {
    	$data_verifikasi = PelaksanaanPemeliharaan::where('id','=',"{$request->id_hapus}")->get()->first();
    	if (isset($data_verifikasi)) {
    		$id_skedul = $data_verifikasi->id_skedul;
    		Skedul::where('id','=',"{$id_skedul}")->update(['status' 	=> 0]);
    	}

        PelaksanaanPemeliharaan::where('id','=',"{$request->id_hapus}")->delete();
        
    	return redirect()->back()->with('info','Data pelaksanaan pemeliharaan berhasil dihapus');  
    }

    /*** Update Pelaksanaan Pemeliharaan ***/
    public function updatePelaksanaanPemeliharaan(Request $request)
    {
        $validasi = Validator::make($request->all(),[
            'id_skedul'       => 'required',
            'tgl_pelaksanaan' => 'required'
        ]);

        if ($validasi->fails())
        {
          
            return Response::Json(array('errors' => $validasi->getMessageBag()->toArray()));

        }else{
 
            PelaksanaanPemeliharaan::where('id','=',"{$request->id_pelaksanaan}")
                                    ->update([
                                        'tgl_pelaksanaan' =>$request->tgl_pelaksanaan,
                                        'catatan' =>$request->catatan
                                    ]); 

            return redirect()->back()->with('info','Data pemeliharaan komponen berhasil disimpan'); 
        }
    } 
 
    /*** Laporan Pelaksanaan ***/
    public function laporanPelaksanaan(Request $request)
    {
        $tanggal = date('Y-m-d');
        $pelaksanaan = DB::table('pelaksanaan_pemeliharaan as pp')
                        ->leftjoin('skedul as sk','pp.id_skedul','=','sk.id')
                        ->leftjoin('kartu_pemeliharaan as kp','sk.kode_pemeliharaan','=','kp.kode_pemeliharaan')
                        ->leftjoin('komponen_pokok as komp','kp.id_komponen_pokok','=','komp.id')
                        ->leftjoin('komponen_sub_pokok as ksp','kp.id_komponen_sub_pokok','=','ksp.id')
                        ->leftjoin('komponen_sistem as ks','kp.id_sistem','=','ks.id')
                        ->leftjoin('komponen_sub_sistem as kss','kp.id_sub_sistem','=','kss.id')
                        ->leftjoin('pelaksana as pel','kp.id_pelaksana','=','pel.id')
                        ->leftjoin('lokasi as lok','kp.id_lokasi','=','lok.id') 
                        ->leftjoin('periode as per','kp.id_periode','=','per.id')
                        ->leftjoin('jenis_perawatan as jp','kp.id_jenis_perawatan','=','jp.id')
                        ->select('kp.tanggal','kp.kode_pemeliharaan','kp.id_komponen_pokok','kp.id_komponen_sub_pokok','kp.id_sistem','kp.id_sub_sistem','kp.id_pelaksana','kp.id_lokasi','kp.uraian_pemeliharaan','kp.tindakan_pengamanan','kp.prosedur','komp.kode_pokok','komp.nama_pokok','ksp.kode_sub_pokok','ksp.nama_sub_pokok','ks.kode_komponen_sistem','ks.nama_komponen_sistem','kss.kode_komponen_sub_sistem','kss.nama_komponen_sub_sistem','pel.nama_pelaksana','lok.nama_lokasi','kp.komponen','kp.alat_kerja','sk.id','kp.jo','per.periode','kp.tgl_mulai','sk.status','sk.tgl_skedul','pp.tgl_pelaksanaan','pp.catatan','pp.id as id_pelaksanaan','jp.jenis_perawatan')
                        ->where('pp.tgl_pelaksanaan','=',"{$tanggal}")
                        ->OrderBy('pp.id','desc')
                        ->get();

    	return view('proses.laporan.laporan_pemeliharaan',compact('pelaksanaan'));
    }

    /*** Pencarian Data Laporan ***/
    public function pencarianLaporanPemeliharaan(Request $request)
    {
        if ($request->kategori =="ALL") {
            $pelaksanaan = DB::table('pelaksanaan_pemeliharaan as pp')
    	  				->leftjoin('skedul as sk','pp.id_skedul','=','sk.id')
                        ->leftjoin('kartu_pemeliharaan as kp','sk.kode_pemeliharaan','=','kp.kode_pemeliharaan')
                        ->leftjoin('komponen_pokok as komp','kp.id_komponen_pokok','=','komp.id')
                        ->leftjoin('komponen_sub_pokok as ksp','kp.id_komponen_sub_pokok','=','ksp.id')
                        ->leftjoin('komponen_sistem as ks','kp.id_sistem','=','ks.id')
                        ->leftjoin('komponen_sub_sistem as kss','kp.id_sub_sistem','=','kss.id')
                        ->leftjoin('pelaksana as pel','kp.id_pelaksana','=','pel.id')
                        ->leftjoin('lokasi as lok','kp.id_lokasi','=','lok.id') 
                        ->leftjoin('periode as per','kp.id_periode','=','per.id')
                        ->leftjoin('jenis_perawatan as jp','kp.id_jenis_perawatan','=','jp.id')
                        ->select('kp.tanggal','kp.kode_pemeliharaan','kp.id_komponen_pokok','kp.id_komponen_sub_pokok','kp.id_sistem','kp.id_sub_sistem','kp.id_pelaksana','kp.id_lokasi','kp.uraian_pemeliharaan','kp.tindakan_pengamanan','kp.prosedur','komp.kode_pokok','komp.nama_pokok','ksp.kode_sub_pokok','ksp.nama_sub_pokok','ks.kode_komponen_sistem','ks.nama_komponen_sistem','kss.kode_komponen_sub_sistem','kss.nama_komponen_sub_sistem','pel.nama_pelaksana','lok.nama_lokasi','kp.komponen','kp.alat_kerja','sk.id','kp.jo','per.periode','kp.tgl_mulai','sk.status','sk.tgl_skedul','pp.tgl_pelaksanaan','pp.catatan','pp.id as id_pelaksanaan','jp.jenis_perawatan')
                        ->where('pp.tgl_pelaksanaan','>=',"{$request->tanggal1}")
                        ->where('pp.tgl_pelaksanaan','<=',"{$request->tanggal2}")
                        ->OrderBy('pp.id','desc')
                        ->get();
        }else{

            $pelaksanaan = DB::table('pelaksanaan_pemeliharaan as pp')
                        ->leftjoin('skedul as sk','pp.id_skedul','=','sk.id')
                        ->leftjoin('kartu_pemeliharaan as kp','sk.kode_pemeliharaan','=','kp.kode_pemeliharaan')
                        ->leftjoin('komponen_pokok as komp','kp.id_komponen_pokok','=','komp.id')
                        ->leftjoin('komponen_sub_pokok as ksp','kp.id_komponen_sub_pokok','=','ksp.id')
                        ->leftjoin('komponen_sistem as ks','kp.id_sistem','=','ks.id')
                        ->leftjoin('komponen_sub_sistem as kss','kp.id_sub_sistem','=','kss.id')
                        ->leftjoin('pelaksana as pel','kp.id_pelaksana','=','pel.id')
                        ->leftjoin('lokasi as lok','kp.id_lokasi','=','lok.id') 
                        ->leftjoin('periode as per','kp.id_periode','=','per.id')
                        ->leftjoin('jenis_perawatan as jp','kp.id_jenis_perawatan','=','jp.id')
                        ->select('kp.tanggal','kp.kode_pemeliharaan','kp.id_komponen_pokok','kp.id_komponen_sub_pokok','kp.id_sistem','kp.id_sub_sistem','kp.id_pelaksana','kp.id_lokasi','kp.uraian_pemeliharaan','kp.tindakan_pengamanan','kp.prosedur','komp.kode_pokok','komp.nama_pokok','ksp.kode_sub_pokok','ksp.nama_sub_pokok','ks.kode_komponen_sistem','ks.nama_komponen_sistem','kss.kode_komponen_sub_sistem','kss.nama_komponen_sub_sistem','pel.nama_pelaksana','lok.nama_lokasi','kp.komponen','kp.alat_kerja','sk.id','kp.jo','per.periode','kp.tgl_mulai','sk.status','sk.tgl_skedul','pp.tgl_pelaksanaan','pp.catatan','pp.id as id_pelaksanaan','jp.jenis_perawatan')
                        ->where('pp.tgl_pelaksanaan','>=',"{$request->tanggal1}")
                        ->where('pp.tgl_pelaksanaan','<=',"{$request->tanggal2}")
                        ->where('jp.kategori','=',"{$request->kategori}")
                        ->OrderBy('pp.id','desc')
                        ->get();
        }
    	 
    	return view('proses.laporan.data_list_laporan_pemeliharaan',compact('pelaksanaan'));
    } 

    /*** Export Excel ***/
    public function exportExcel($tgl1,$tgl2,$kategori)
    {
        if ($kategori =="ALL") {
            $pelaksanaan = DB::table('pelaksanaan_pemeliharaan as pp')
    	  				->leftjoin('skedul as sk','pp.id_skedul','=','sk.id')
                        ->leftjoin('kartu_pemeliharaan as kp','sk.kode_pemeliharaan','=','kp.kode_pemeliharaan')
                        ->leftjoin('komponen_pokok as komp','kp.id_komponen_pokok','=','komp.id')
                        ->leftjoin('komponen_sub_pokok as ksp','kp.id_komponen_sub_pokok','=','ksp.id')
                        ->leftjoin('komponen_sistem as ks','kp.id_sistem','=','ks.id')
                        ->leftjoin('komponen_sub_sistem as kss','kp.id_sub_sistem','=','kss.id')
                        ->leftjoin('pelaksana as pel','kp.id_pelaksana','=','pel.id')
                        ->leftjoin('lokasi as lok','kp.id_lokasi','=','lok.id') 
                        ->leftjoin('periode as per','kp.id_periode','=','per.id')
                        ->leftjoin('jenis_perawatan as jp','kp.id_jenis_perawatan','=','jp.id')
                        ->select('kp.tanggal','kp.kode_pemeliharaan','kp.id_komponen_pokok','kp.id_komponen_sub_pokok','kp.id_sistem','kp.id_sub_sistem','kp.id_pelaksana','kp.id_lokasi','kp.uraian_pemeliharaan','kp.tindakan_pengamanan','kp.prosedur','komp.kode_pokok','komp.nama_pokok','ksp.kode_sub_pokok','ksp.nama_sub_pokok','ks.kode_komponen_sistem','ks.nama_komponen_sistem','kss.kode_komponen_sub_sistem','kss.nama_komponen_sub_sistem','pel.nama_pelaksana','lok.nama_lokasi','kp.komponen','kp.alat_kerja','sk.id','kp.jo','per.periode','kp.tgl_mulai','sk.status','sk.tgl_skedul','pp.tgl_pelaksanaan','pp.catatan','pp.id as id_pelaksanaan','jp.jenis_perawatan')
                        ->where('pp.tgl_pelaksanaan','>=',"{$tgl1}")
                        ->where('pp.tgl_pelaksanaan','<=',"{$tgl2}")
                        ->OrderBy('pp.id','desc')
                        ->get();
        }else{

            $pelaksanaan = DB::table('pelaksanaan_pemeliharaan as pp')
                        ->leftjoin('skedul as sk','pp.id_skedul','=','sk.id')
                        ->leftjoin('kartu_pemeliharaan as kp','sk.kode_pemeliharaan','=','kp.kode_pemeliharaan')
                        ->leftjoin('komponen_pokok as komp','kp.id_komponen_pokok','=','komp.id')
                        ->leftjoin('komponen_sub_pokok as ksp','kp.id_komponen_sub_pokok','=','ksp.id')
                        ->leftjoin('komponen_sistem as ks','kp.id_sistem','=','ks.id')
                        ->leftjoin('komponen_sub_sistem as kss','kp.id_sub_sistem','=','kss.id')
                        ->leftjoin('pelaksana as pel','kp.id_pelaksana','=','pel.id')
                        ->leftjoin('lokasi as lok','kp.id_lokasi','=','lok.id') 
                        ->leftjoin('periode as per','kp.id_periode','=','per.id')
                        ->leftjoin('jenis_perawatan as jp','kp.id_jenis_perawatan','=','jp.id')
                        ->select('kp.tanggal','kp.kode_pemeliharaan','kp.id_komponen_pokok','kp.id_komponen_sub_pokok','kp.id_sistem','kp.id_sub_sistem','kp.id_pelaksana','kp.id_lokasi','kp.uraian_pemeliharaan','kp.tindakan_pengamanan','kp.prosedur','komp.kode_pokok','komp.nama_pokok','ksp.kode_sub_pokok','ksp.nama_sub_pokok','ks.kode_komponen_sistem','ks.nama_komponen_sistem','kss.kode_komponen_sub_sistem','kss.nama_komponen_sub_sistem','pel.nama_pelaksana','lok.nama_lokasi','kp.komponen','kp.alat_kerja','sk.id','kp.jo','per.periode','kp.tgl_mulai','sk.status','sk.tgl_skedul','pp.tgl_pelaksanaan','pp.catatan','pp.id as id_pelaksanaan','jp.jenis_perawatan')
                        ->where('pp.tgl_pelaksanaan','>=',"{$tgl1}")
                        ->where('pp.tgl_pelaksanaan','<=',"{$tgl2}")
                        ->where('jp.kategori','<=',"{$kategori}")
                        ->OrderBy('pp.id','desc')
                        ->get();
        }

    	return view('proses.laporan.laporan_excel_pemeliharaan',compact('pelaksanaan'));
    }

    /*** Export PDF ***/
	public function exportPdf($tgl1,$tgl2,$kategori)
	{
        if ($kategori =="ALL") {
            $pelaksanaan = DB::table('pelaksanaan_pemeliharaan as pp')
    	  				->leftjoin('skedul as sk','pp.id_skedul','=','sk.id')
                        ->leftjoin('kartu_pemeliharaan as kp','sk.kode_pemeliharaan','=','kp.kode_pemeliharaan')
                        ->leftjoin('komponen_pokok as komp','kp.id_komponen_pokok','=','komp.id')
                        ->leftjoin('komponen_sub_pokok as ksp','kp.id_komponen_sub_pokok','=','ksp.id')
                        ->leftjoin('komponen_sistem as ks','kp.id_sistem','=','ks.id')
                        ->leftjoin('komponen_sub_sistem as kss','kp.id_sub_sistem','=','kss.id')
                        ->leftjoin('pelaksana as pel','kp.id_pelaksana','=','pel.id')
                        ->leftjoin('lokasi as lok','kp.id_lokasi','=','lok.id') 
                        ->leftjoin('periode as per','kp.id_periode','=','per.id')
                        ->leftjoin('jenis_perawatan as jp','kp.id_jenis_perawatan','=','jp.id')
                        ->select('kp.tanggal','kp.kode_pemeliharaan','kp.id_komponen_pokok','kp.id_komponen_sub_pokok','kp.id_sistem','kp.id_sub_sistem','kp.id_pelaksana','kp.id_lokasi','kp.uraian_pemeliharaan','kp.tindakan_pengamanan','kp.prosedur','komp.kode_pokok','komp.nama_pokok','ksp.kode_sub_pokok','ksp.nama_sub_pokok','ks.kode_komponen_sistem','ks.nama_komponen_sistem','kss.kode_komponen_sub_sistem','kss.nama_komponen_sub_sistem','pel.nama_pelaksana','lok.nama_lokasi','kp.komponen','kp.alat_kerja','sk.id','kp.jo','per.periode','kp.tgl_mulai','sk.status','sk.tgl_skedul','pp.tgl_pelaksanaan','pp.catatan','pp.id as id_pelaksanaan','jp.jenis_perawatan')
                        ->where('pp.tgl_pelaksanaan','>=',"{$tgl1}")
                        ->where('pp.tgl_pelaksanaan','<=',"{$tgl2}")
                        ->OrderBy('pp.id','desc')
                        ->get();
        }else{

            $pelaksanaan = DB::table('pelaksanaan_pemeliharaan as pp')
                        ->leftjoin('skedul as sk','pp.id_skedul','=','sk.id')
                        ->leftjoin('kartu_pemeliharaan as kp','sk.kode_pemeliharaan','=','kp.kode_pemeliharaan')
                        ->leftjoin('komponen_pokok as komp','kp.id_komponen_pokok','=','komp.id')
                        ->leftjoin('komponen_sub_pokok as ksp','kp.id_komponen_sub_pokok','=','ksp.id')
                        ->leftjoin('komponen_sistem as ks','kp.id_sistem','=','ks.id')
                        ->leftjoin('komponen_sub_sistem as kss','kp.id_sub_sistem','=','kss.id')
                        ->leftjoin('pelaksana as pel','kp.id_pelaksana','=','pel.id')
                        ->leftjoin('lokasi as lok','kp.id_lokasi','=','lok.id') 
                        ->leftjoin('periode as per','kp.id_periode','=','per.id')
                        ->leftjoin('jenis_perawatan as jp','kp.id_jenis_perawatan','=','jp.id')
                        ->select('kp.tanggal','kp.kode_pemeliharaan','kp.id_komponen_pokok','kp.id_komponen_sub_pokok','kp.id_sistem','kp.id_sub_sistem','kp.id_pelaksana','kp.id_lokasi','kp.uraian_pemeliharaan','kp.tindakan_pengamanan','kp.prosedur','komp.kode_pokok','komp.nama_pokok','ksp.kode_sub_pokok','ksp.nama_sub_pokok','ks.kode_komponen_sistem','ks.nama_komponen_sistem','kss.kode_komponen_sub_sistem','kss.nama_komponen_sub_sistem','pel.nama_pelaksana','lok.nama_lokasi','kp.komponen','kp.alat_kerja','sk.id','kp.jo','per.periode','kp.tgl_mulai','sk.status','sk.tgl_skedul','pp.tgl_pelaksanaan','pp.catatan','pp.id as id_pelaksanaan','jp.jenis_perawatan')
                        ->where('pp.tgl_pelaksanaan','>=',"{$tgl1}")
                        ->where('pp.tgl_pelaksanaan','<=',"{$tgl2}")
                        ->where('jp.kategori','<=',"{$kategori}")
                        ->OrderBy('pp.id','desc')
                        ->get();
        }       
   		$pdf = PDF::loadView('proses.laporan.laporan_pdf_pemeliharaan',compact('pelaksanaan','tgl1','tgl2'))->setPaper('a4','landscape')->setWarnings(false);

   			return $pdf->stream('laporan_pelaksanaan.pdf');
   			/*stream*/
   	}
   		 
}

