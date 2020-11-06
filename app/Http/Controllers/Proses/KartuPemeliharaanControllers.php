<?php

namespace App\Http\Controllers\Proses;

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
use App\Models\Proses\Skedul;  
use App\Models\Proses\PelaksanaanPemeliharaan; 
use Validator;
use Response;
use View;
use DB;
use File;
use PDF; 

class KartuPemeliharaanControllers extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /*** index kartu pemeliharaan ***/
    public function index()
    {
        $kelompok       = KomponenPokok::OrderBy('id','desc')->get();
        $subkelompok    = KomponenSubPokok::OrderBy('id','desc')->get();
        $sistem         = KomponenSistem::OrderBy('id','desc')->get();
        $subsistem      = KomponenSubSistem::OrderBy('id','desc')->get();
        $pelaksana      = Pelaksana::OrderBy('id','desc')->get();
        $periode        = Periode::OrderBy('id','desc')->get();
        $lokasi         = KomponenLokasi::OrderBy('id','desc')->get();
        $paginate       = 1;

        $pemeliharaan   = DB::table('kartu_pemeliharaan as kp')
                        ->leftjoin('komponen_pokok as komp','kp.id_komponen_pokok','=','komp.id')
                        ->leftjoin('komponen_sub_pokok as ksp','kp.id_komponen_sub_pokok','=','ksp.id')
                        ->leftjoin('komponen_sistem as ks','kp.id_sistem','=','ks.id')
                        ->leftjoin('komponen_sub_sistem as kss','kp.id_sub_sistem','=','kss.id')
                        ->leftjoin('pelaksana as pel','kp.id_pelaksana','=','pel.id')
                        ->leftjoin('lokasi as lok','kp.id_lokasi','=','lok.id') 
                        ->leftjoin('periode as per','kp.id_periode','=','per.id') 
                        ->select('kp.tanggal','kp.kode_pemeliharaan','kp.id_komponen_pokok','kp.id_komponen_sub_pokok','kp.id_sistem','kp.id_sub_sistem','kp.id_pelaksana','kp.id_lokasi','kp.uraian_pemeliharaan','kp.tindakan_pengamanan','kp.prosedur','komp.kode_pokok','komp.nama_pokok','ksp.kode_sub_pokok','ksp.nama_sub_pokok','ks.kode_komponen_sistem','ks.nama_komponen_sistem','kss.kode_komponen_sub_sistem','kss.nama_komponen_sub_sistem','pel.nama_pelaksana','lok.nama_lokasi','kp.komponen','kp.alat_kerja','kp.id','kp.jo','per.periode','kp.tgl_mulai')
                        ->OrderBy('kp.kode_pemeliharaan','asc')->paginate(25);

        return view('proses.kartu_pemeliharaan.kartu_pemeliharaan',compact('paginate','pemeliharaan','kelompok','subkelompok','sistem','subsistem','pelaksana','periode','lokasi'));
    } 

    /*** Create Kartu Pemeliharaan ***/
    public function createKartuPemeliharaan()
    {
        $kelompok       = KomponenPokok::OrderBy('id','desc')->get();
        $subkelompok    = KomponenSubPokok::OrderBy('id','desc')->get();
        $sistem         = KomponenSistem::OrderBy('id','desc')->get();
        $subsistem      = KomponenSubSistem::OrderBy('id','desc')->get();
        $pelaksana      = Pelaksana::OrderBy('id','desc')->get();
        $periode        = Periode::OrderBy('id','desc')->get();
        $lokasi         = KomponenLokasi::OrderBy('id','desc')->get();

        return view('proses.kartu_pemeliharaan.create_kartu_pemeliharaan',compact('kelompok','subkelompok','sistem','subsistem','lokasi','periode','pelaksana'));
    } 

    /*** Save Kartu Pemeliharaan ***/
    public function saveKartuPemeliharaan(Request $request)
    {
        $validasi = Validator::make($request->all(), [
            'kode_pemeliharaan'     => 'required|max:45|unique:kartu_pemeliharaan',
            'id_komponen_pokok'     => 'required',
            'id_komponen_sub_pokok' => 'required',
            'id_sistem'             => 'required',
            'id_sub_sistem'         => 'required',
            'id_pelaksana'          => 'required',
            'id_lokasi'             => 'required',
            'komponen'              => 'required',
            'uraian_pemeliharaan'   => 'required',
            'tindakan_pengamanan'   => 'required',
            'prosedur'              => 'required',
            'id_periode'            => 'required',
            'tgl_mulai'             => 'required',
            'alat_kerja'            => 'required'
        ]);

        if ($validasi->fails())
        {
            return redirect()->back()->withErrors($validasi->errors());
            /* return Response::Json(array('errors' => $validasi->getMessageBag()->toArray()));*/

        }else{
                $tahun_skedul = date('Y',strtotime($request->tgl_mulai));
                
                /*** Save Pemeliharaan ***/ 
                $input                        = new Pemeliharaan();
                $input->kode_pemeliharaan     = $request->kode_pemeliharaan; 
                $input->id_komponen_pokok     = $request->id_komponen_pokok; 
                $input->id_komponen_sub_pokok = $request->id_komponen_sub_pokok; 
                $input->id_sistem             = $request->id_sistem; 
                $input->id_sub_sistem         = $request->id_sub_sistem; 
                $input->id_pelaksana          = $request->id_pelaksana; 
                $input->id_lokasi             = $request->id_lokasi; 
                $input->komponen              = $request->komponen; 
                $input->uraian_pemeliharaan   = $request->uraian_pemeliharaan; 
                $input->tindakan_pengamanan   = $request->tindakan_pengamanan; 
                $input->prosedur              = $request->prosedur; 
                $input->id_periode            = $request->id_periode; 
                $input->tgl_mulai             = $request->tgl_mulai; 
                $input->alat_kerja            = $request->alat_kerja; 
                $input->jo                    = $request->jo; 
                $input->save();

                /*** PROSES GENERATE SKEDUL ***/ 

                /*** Get Data Kartu Pemeliharaan ***/
                $data_pemeliharaan = DB::table('kartu_pemeliharaan as kp') 
                                        ->leftjoin('periode as per','kp.id_periode','=','per.id') 
                                        ->select('kp.tanggal','kp.kode_pemeliharaan','kp.id_komponen_pokok','kp.id_komponen_sub_pokok','kp.id_sistem','kp.id_sub_sistem','kp.id_pelaksana','kp.id_lokasi','kp.uraian_pemeliharaan','kp.tindakan_pengamanan','kp.prosedur','kp.komponen','kp.alat_kerja','kp.id','kp.jo','kp.id_periode','per.periode','kp.tgl_mulai','kp.alat_kerja','per.rumus')
                                        ->where('kp.kode_pemeliharaan','=',"{$request->kode_pemeliharaan}")
                                        ->OrderBy('kp.id','desc')->get()->first();

                if (isset($data_pemeliharaan)) {
                    
                    /*** Get Data Skedul ***/
                    $data_skedul = Skedul::where('kode_pemeliharaan','=',"{$request->kode_pemeliharaan}")->count();
                  //  dd($data_skedul);

                    if ($data_skedul > 0) {

                        return redirect()->back()->with('gagal','Skedul perencanaan pemeliharaan sudah ada dalam database dengan kode yang sama');  

                    } else { 

                            $jml_hari         = $data_pemeliharaan->rumus;
                            $jml_hari_setahun = 365;

                            /*** Jika Priode lebih dari satu tahun ***/
                            if ($jml_hari > 365) {

                                    $cek_status = Skedul::where('status','=',0)->where('kode_pemeliharaan','=',"{$request->kode_pemeliharaan}")->get()->first();

                                    
                                    
                                    if (isset($cek_status)) {
                                        return redirect()->back()->with('gagal','Skedul perencanaan pemeliharaan sudah ada dalam database');  exit();
                                    }

                                    $jml_hari1         = $data_pemeliharaan->rumus ;
                                    $tgl_rumus         = $tahun_skedul.'-'.date('m-d',strtotime($data_pemeliharaan->tgl_mulai));
                                    $tgl_mulai1        = date_create($tgl_rumus);
                                    
                                    date_add($tgl_mulai1, date_interval_create_from_date_string("$jml_hari1 days"));
                                    $tgl_service1 = date_format($tgl_mulai1, 'Y-m-d');

                                    $input                       = new Skedul();
                                    $input->kode_pemeliharaan    = $request->kode_pemeliharaan; 
                                    $input->tgl_skedul           = $tgl_service1;  
                                    $input->tahun                = $tahun_skedul; 
                                    $input->status               = 0; 
                                    $input->save();
                                
                            }else{
                                
                                if ($jml_hari > $jml_hari_setahun) {

                                    $jml_skedul       = floor($jml_hari / $jml_hari_setahun);

                                }else{

                                    $jml_skedul       = floor($jml_hari_setahun / $jml_hari);

                                }

  

                                for ($i=1; $i <= $jml_skedul; $i++) { 

                                    $jml_hari1         = $data_pemeliharaan->rumus * $i;
                                    $tgl_rumus         = $tahun_skedul.'-'.date('m-d',strtotime($data_pemeliharaan->tgl_mulai));
                                    $tgl_mulai1        = date_create($tgl_rumus);
                                    
                                    date_add($tgl_mulai1, date_interval_create_from_date_string("$jml_hari1 days"));
                                    $tgl_service1 = date_format($tgl_mulai1, 'Y-m-d');

                                    $input                  = new Skedul();
                                    $input->kode_pemeliharaan  = $request->kode_pemeliharaan; 
                                    $input->tgl_skedul         = $tgl_service1;  
                                    $input->tahun              = $tahun_skedul; 
                                    $input->status             = 0; 
                                    $input->save();
                                }

                            }
                        return redirect()->route('kartu_pemeliharaan')->with('info','Data kartu pemeliharaan berhasil disimpan');
                        } 
                }    
        }
    }

    /*** Generate Manual Skedul ***/
    public function generateSkedulManual(Request $request)
    {
            $tahun_skedul = date('Y',strtotime($request->tgl_mulai));
                /*** Get Data Kartu Pemeliharaan ***/
                $data_pemeliharaan = DB::table('kartu_pemeliharaan as kp') 
                                        ->leftjoin('periode as per','kp.id_periode','=','per.id') 
                                        ->select('kp.tanggal','kp.kode_pemeliharaan','kp.id_komponen_pokok','kp.id_komponen_sub_pokok','kp.id_sistem','kp.id_sub_sistem','kp.id_pelaksana','kp.id_lokasi','kp.uraian_pemeliharaan','kp.tindakan_pengamanan','kp.prosedur','kp.komponen','kp.alat_kerja','kp.id','kp.jo','kp.id_periode','per.periode','kp.tgl_mulai','kp.alat_kerja','per.rumus')
                                        ->where('kp.kode_pemeliharaan','=',"{$request->kode_pemeliharaan}")
                                        ->OrderBy('kp.id','desc')->get()->first();

                if (isset($data_pemeliharaan)) {
                    
                    /*** Get Data Skedul ***/
                    $data_skedul = Skedul::where('kode_pemeliharaan','=',"{$request->kode_pemeliharaan}")->count();
                  //  dd($data_skedul);

                    if ($data_skedul > 0) {

                        return redirect()->back()->with('gagal','Skedul perencanaan pemeliharaan sudah ada dalam database dengan kode yang sama');  

                    } else { 

                            $jml_hari         = $data_pemeliharaan->rumus;
                            $jml_hari_setahun = 365;

                            /*** Jika Priode lebih dari satu tahun ***/
                            if ($jml_hari > 365) {

                                    $cek_status = Skedul::where('status','=',0)->where('kode_pemeliharaan','=',"{$request->kode_pemeliharaan}")->get()->first();

                                    
                                    
                                    if (isset($cek_status)) {
                                        return redirect()->back()->with('gagal','Skedul perencanaan pemeliharaan sudah ada dalam database');  exit();
                                    }

                                    $jml_hari1         = $data_pemeliharaan->rumus ;
                                    $tgl_rumus         = $tahun_skedul.'-'.date('m-d',strtotime($data_pemeliharaan->tgl_mulai));
                                    $tgl_mulai1        = date_create($tgl_rumus);
                                    
                                    date_add($tgl_mulai1, date_interval_create_from_date_string("$jml_hari1 days"));
                                    $tgl_service1 = date_format($tgl_mulai1, 'Y-m-d');

                                    $input                       = new Skedul();
                                    $input->kode_pemeliharaan    = $request->kode_pemeliharaan; 
                                    $input->tgl_skedul           = $tgl_service1;  
                                    $input->tahun                = $tahun_skedul; 
                                    $input->status               = 0; 
                                    $input->save();
                                
                            }else{
                                
                                if ($jml_hari > $jml_hari_setahun) {

                                    $jml_skedul       = floor($jml_hari / $jml_hari_setahun);

                                }else{

                                    $jml_skedul       = floor($jml_hari_setahun / $jml_hari);

                                }

  

                                for ($i=1; $i <= $jml_skedul; $i++) { 

                                    $jml_hari1         = $data_pemeliharaan->rumus * $i;
                                    $tgl_rumus         = $tahun_skedul.'-'.date('m-d',strtotime($data_pemeliharaan->tgl_mulai));
                                    $tgl_mulai1        = date_create($tgl_rumus);
                                    
                                    date_add($tgl_mulai1, date_interval_create_from_date_string("$jml_hari1 days"));
                                    $tgl_service1 = date_format($tgl_mulai1, 'Y-m-d');

                                    $input                  = new Skedul();
                                    $input->kode_pemeliharaan  = $request->kode_pemeliharaan; 
                                    $input->tgl_skedul         = $tgl_service1;  
                                    $input->tahun              = $tahun_skedul; 
                                    $input->status             = 0; 
                                    $input->save();
                                }

                            }
                        return redirect()->route('kartu_pemeliharaan')->with('info','Data kartu pemeliharaan berhasil di generate');
                        } 
                }    
    }

    /*** Edit Kartu Pemeliharaan ***/
    public function editKartuPemeliharaan($id)
    {
        $pemeliharaan = DB::table('kartu_pemeliharaan as kp')
                    ->leftjoin('komponen_pokok as komp','kp.id_komponen_pokok','=','komp.id')
                    ->leftjoin('komponen_sub_pokok as ksp','kp.id_komponen_sub_pokok','=','ksp.id')
                    ->leftjoin('komponen_sistem as ks','kp.id_sistem','=','ks.id')
                    ->leftjoin('komponen_sub_sistem as kss','kp.id_sub_sistem','=','kss.id')
                    ->leftjoin('pelaksana as pel','kp.id_pelaksana','=','pel.id')
                    ->leftjoin('lokasi as lok','kp.id_lokasi','=','lok.id')
                    ->leftjoin('periode as per','kp.id_periode','=','per.id') 
                    ->select('kp.tanggal','kp.kode_pemeliharaan','kp.id_komponen_pokok','kp.id_komponen_sub_pokok','kp.id_sistem','kp.id_sub_sistem','kp.id_pelaksana','kp.id_lokasi','kp.uraian_pemeliharaan','kp.tindakan_pengamanan','kp.prosedur','komp.kode_pokok','komp.nama_pokok','ksp.kode_sub_pokok','ksp.nama_sub_pokok','ks.kode_komponen_sistem','ks.nama_komponen_sistem','kss.kode_komponen_sub_sistem','kss.nama_komponen_sub_sistem','pel.nama_pelaksana','lok.nama_lokasi','kp.komponen','kp.alat_kerja','kp.id','kp.jo','kp.id_periode','per.periode','kp.tgl_mulai','kp.alat_kerja')
                    ->where('kp.id','=',"{$id}")
                    ->OrderBy('kp.id','desc')->get()->first();

        if (isset($pemeliharaan)) {

            $kelompok       = KomponenPokok::OrderBy('id','desc')->get();
            $subkelompok    = KomponenSubPokok::OrderBy('id','desc')->get();
            $sistem         = KomponenSistem::OrderBy('id','desc')->get();
            $subsistem      = KomponenSubSistem::OrderBy('id','desc')->get();
            $pelaksana      = Pelaksana::OrderBy('id','desc')->get();
            $periode        = Periode::OrderBy('id','desc')->get();
            $lokasi         = KomponenLokasi::OrderBy('id','desc')->get();

            return view('proses.kartu_pemeliharaan.edit_kartu_pemeliharaan',compact('kelompok','subkelompok','sistem','subsistem','lokasi','periode','pelaksana','pemeliharaan'));
        
        }else{

            abort(404);
        }
    } 

    /*** Update Kartu Pemeliharaan ***/
    public function updateKartuPemeliharaan(Request $request,$id)
    {
        $validasi = Validator::make($request->all(), [
            
            'id_komponen_pokok'     => 'required',
            'id_komponen_sub_pokok' => 'required',
            'id_sistem'             => 'required',
            'id_sub_sistem'         => 'required',
            'id_pelaksana'          => 'required',
            'id_lokasi'             => 'required',
            'komponen'              => 'required',
            'uraian_pemeliharaan'   => 'required',
            'tindakan_pengamanan'   => 'required',
            'prosedur'              => 'required',
            'id_periode'            => 'required',
            'tgl_mulai'             => 'required',
            'alat_kerja'            => 'required'
        ]);

        if ($validasi->fails())
        {
                return redirect()->back()->withErrors($validasi->errors());
            /* return Response::Json(array('errors' => $validasi->getMessageBag()->toArray()));*/

        }else{
                $tahun_skedul = date('Y',strtotime($request->tgl_mulai));
                
                Pemeliharaan::where('id','=',"{$id}")
                            ->update([
                                        'id_komponen_pokok'     => $request->id_komponen_pokok,
                                        'id_komponen_sub_pokok' => $request->id_komponen_sub_pokok,
                                        'id_sistem'             => $request->id_sistem,
                                        'id_sub_sistem'         => $request->id_sub_sistem,
                                        'id_pelaksana'          => $request->id_pelaksana,
                                        'id_lokasi'             => $request->id_lokasi,
                                        'komponen'              => $request->komponen,
                                        'uraian_pemeliharaan'   => $request->uraian_pemeliharaan,
                                        'tindakan_pengamanan'   => $request->tindakan_pengamanan,
                                        'prosedur'              => $request->prosedur,
                                        'id_periode'            => $request->id_periode,
                                        'tgl_mulai'             => $request->tgl_mulai,
                                        'alat_kerja'            => $request->alat_kerja,
                                        'jo'                    => $request->jo
                                    ]);

                return redirect()->route('kartu_pemeliharaan')->with('info','Data kartu pemeliharaan berhasil disimpan'); 
        }
    } 

    /*** Print Kartu Pemeliharaan ***/
    public function printKartuPemeliharaan($id)
    {
        $pemeliharaan = DB::table('kartu_pemeliharaan as kp')
                    ->leftjoin('komponen_pokok as komp','kp.id_komponen_pokok','=','komp.id')
                    ->leftjoin('komponen_sub_pokok as ksp','kp.id_komponen_sub_pokok','=','ksp.id')
                    ->leftjoin('komponen_sistem as ks','kp.id_sistem','=','ks.id')
                    ->leftjoin('komponen_sub_sistem as kss','kp.id_sub_sistem','=','kss.id')
                    ->leftjoin('pelaksana as pel','kp.id_pelaksana','=','pel.id')
                    ->leftjoin('lokasi as lok','kp.id_lokasi','=','lok.id')
                    ->leftjoin('periode as per','kp.id_periode','=','per.id') 
                    ->select('kp.tanggal','kp.kode_pemeliharaan','kp.id_komponen_pokok','kp.id_komponen_sub_pokok','kp.id_sistem','kp.id_sub_sistem','kp.id_pelaksana','kp.id_lokasi','kp.uraian_pemeliharaan','kp.tindakan_pengamanan','kp.prosedur','komp.kode_pokok','komp.nama_pokok','ksp.kode_sub_pokok','ksp.nama_sub_pokok','ks.kode_komponen_sistem','ks.nama_komponen_sistem','kss.kode_komponen_sub_sistem','kss.nama_komponen_sub_sistem','pel.nama_pelaksana','lok.nama_lokasi','kp.komponen','kp.alat_kerja','kp.id','kp.jo','kp.id_periode','per.periode','kp.tgl_mulai','kp.alat_kerja','per.keterangan as ket_periode')
                        ->where('kp.id','=',"{$id}")
                        ->OrderBy('kp.id','desc')->get()->first();
        if (isset($pemeliharaan)) {
            $pdf = PDF::loadView('proses.kartu_pemeliharaan.print_kartu_pemeliharaan',compact('pemeliharaan'))->setPaper('a5', 'portrait')->setWarnings(false);
            return $pdf->stream('Kartu_Pemeliharaan.pdf');

        /*	return view('proses.pemeliharaan.print_kartu_pemeliharaan',compact('pemeliharaan'));*/
        }else{
            abort(404);
        }
    }

    /*** Delete Kartu Pemeliharaan ***/
    public function deletePemeliharaan(Request $request)
    {
        $data_kartu = Pemeliharaan::where('id','=',"{$request->id_hapus}")->get()->first();
        if (isset($data_kartu)) {
           $kode_pemeliharaan = $data_kartu->kode_pemeliharaan;
        }else{
            $kode_pemeliharaan = '';
        }

        $get_skedule = Skedul::where('kode_pemeliharaan','=',"{$kode_pemeliharaan}")->get();
        foreach ($get_skedule as $datas) {
            PelaksanaanPemeliharaan::where('id_skedul','=',"{$datas->id}")->delete();
        }

        Pemeliharaan::where('id','=',"{$request->id_hapus}")->delete(); 
        Skedul::where('kode_pemeliharaan','=',"{$kode_pemeliharaan}")->delete();

        return redirect()->back()->with('info','Data kartu pemeliharaan berhasil dihapus');
    }

    /*** Pencarian Kartu Pemeliharaan - Kelompok ***/
    public function pencarianKelompok(Request $request)
    {
        $pemeliharaan = DB::table('kartu_pemeliharaan as kp')
                    ->leftjoin('komponen_pokok as komp','kp.id_komponen_pokok','=','komp.id')
                    ->leftjoin('komponen_sub_pokok as ksp','kp.id_komponen_sub_pokok','=','ksp.id')
                    ->leftjoin('komponen_sistem as ks','kp.id_sistem','=','ks.id')
                    ->leftjoin('komponen_sub_sistem as kss','kp.id_sub_sistem','=','kss.id')
                    ->leftjoin('pelaksana as pel','kp.id_pelaksana','=','pel.id')
                    ->leftjoin('lokasi as lok','kp.id_lokasi','=','lok.id') 
                    ->leftjoin('periode as per','kp.id_periode','=','per.id') 
                    ->select('kp.tanggal','kp.kode_pemeliharaan','kp.id_komponen_pokok','kp.id_komponen_sub_pokok','kp.id_sistem','kp.id_sub_sistem','kp.id_pelaksana','kp.id_lokasi','kp.uraian_pemeliharaan','kp.tindakan_pengamanan','kp.prosedur','komp.kode_pokok','komp.nama_pokok','ksp.kode_sub_pokok','ksp.nama_sub_pokok','ks.kode_komponen_sistem','ks.nama_komponen_sistem','kss.kode_komponen_sub_sistem','kss.nama_komponen_sub_sistem','pel.nama_pelaksana','lok.nama_lokasi','kp.komponen','kp.alat_kerja','kp.id','kp.jo','per.periode','kp.tgl_mulai')
                    ->where('kp.id_komponen_pokok','=',"{$request->id_komponen_pokok}")
                    ->OrderBy('kp.kode_pemeliharaan','asc')->get();

       return view('proses.kartu_pemeliharaan.data_list_kartu_pemeliharaan',compact('pemeliharaan'));
    } 

    /*** Pencarian Kartu Pemeliharaan - SubKelompok ***/
    public function pencarianSubKelompok(Request $request)
    {
        $pemeliharaan = DB::table('kartu_pemeliharaan as kp')
                    ->leftjoin('komponen_pokok as komp','kp.id_komponen_pokok','=','komp.id')
                    ->leftjoin('komponen_sub_pokok as ksp','kp.id_komponen_sub_pokok','=','ksp.id')
                    ->leftjoin('komponen_sistem as ks','kp.id_sistem','=','ks.id')
                    ->leftjoin('komponen_sub_sistem as kss','kp.id_sub_sistem','=','kss.id')
                    ->leftjoin('pelaksana as pel','kp.id_pelaksana','=','pel.id')
                    ->leftjoin('lokasi as lok','kp.id_lokasi','=','lok.id') 
                    ->leftjoin('periode as per','kp.id_periode','=','per.id') 
                    ->select('kp.tanggal','kp.kode_pemeliharaan','kp.id_komponen_pokok','kp.id_komponen_sub_pokok','kp.id_sistem','kp.id_sub_sistem','kp.id_pelaksana','kp.id_lokasi','kp.uraian_pemeliharaan','kp.tindakan_pengamanan','kp.prosedur','komp.kode_pokok','komp.nama_pokok','ksp.kode_sub_pokok','ksp.nama_sub_pokok','ks.kode_komponen_sistem','ks.nama_komponen_sistem','kss.kode_komponen_sub_sistem','kss.nama_komponen_sub_sistem','pel.nama_pelaksana','lok.nama_lokasi','kp.komponen','kp.alat_kerja','kp.id','kp.jo','per.periode','kp.tgl_mulai')
                    ->where('kp.id_komponen_sub_pokok','=',"{$request->id_komponen_sub_pokok}")
                    ->OrderBy('kp.kode_pemeliharaan','asc')->get();

       return view('proses.kartu_pemeliharaan.data_list_kartu_pemeliharaan',compact('pemeliharaan'));
    } 

    /*** Pencarian Kartu Pemeliharaan - Sistem ***/
    public function pencarianSistem(Request $request)
    {
        $pemeliharaan = DB::table('kartu_pemeliharaan as kp')
                    ->leftjoin('komponen_pokok as komp','kp.id_komponen_pokok','=','komp.id')
                    ->leftjoin('komponen_sub_pokok as ksp','kp.id_komponen_sub_pokok','=','ksp.id')
                    ->leftjoin('komponen_sistem as ks','kp.id_sistem','=','ks.id')
                    ->leftjoin('komponen_sub_sistem as kss','kp.id_sub_sistem','=','kss.id')
                    ->leftjoin('pelaksana as pel','kp.id_pelaksana','=','pel.id')
                    ->leftjoin('lokasi as lok','kp.id_lokasi','=','lok.id') 
                    ->leftjoin('periode as per','kp.id_periode','=','per.id') 
                    ->select('kp.tanggal','kp.kode_pemeliharaan','kp.id_komponen_pokok','kp.id_komponen_sub_pokok','kp.id_sistem','kp.id_sub_sistem','kp.id_pelaksana','kp.id_lokasi','kp.uraian_pemeliharaan','kp.tindakan_pengamanan','kp.prosedur','komp.kode_pokok','komp.nama_pokok','ksp.kode_sub_pokok','ksp.nama_sub_pokok','ks.kode_komponen_sistem','ks.nama_komponen_sistem','kss.kode_komponen_sub_sistem','kss.nama_komponen_sub_sistem','pel.nama_pelaksana','lok.nama_lokasi','kp.komponen','kp.alat_kerja','kp.id','kp.jo','per.periode','kp.tgl_mulai')
                    ->where('kp.id_sistem','=',"{$request->id_sistem}")
                    ->OrderBy('kp.kode_pemeliharaan','asc')->get();

       return view('proses.kartu_pemeliharaan.data_list_kartu_pemeliharaan',compact('pemeliharaan'));
    } 

    /*** Pencarian Kartu Pemeliharaan - SubSistem ***/
    public function pencarianSubSistem(Request $request)
    {
        $pemeliharaan = DB::table('kartu_pemeliharaan as kp')
                    ->leftjoin('komponen_pokok as komp','kp.id_komponen_pokok','=','komp.id')
                    ->leftjoin('komponen_sub_pokok as ksp','kp.id_komponen_sub_pokok','=','ksp.id')
                    ->leftjoin('komponen_sistem as ks','kp.id_sistem','=','ks.id')
                    ->leftjoin('komponen_sub_sistem as kss','kp.id_sub_sistem','=','kss.id')
                    ->leftjoin('pelaksana as pel','kp.id_pelaksana','=','pel.id')
                    ->leftjoin('lokasi as lok','kp.id_lokasi','=','lok.id') 
                    ->leftjoin('periode as per','kp.id_periode','=','per.id') 
                    ->select('kp.tanggal','kp.kode_pemeliharaan','kp.id_komponen_pokok','kp.id_komponen_sub_pokok','kp.id_sistem','kp.id_sub_sistem','kp.id_pelaksana','kp.id_lokasi','kp.uraian_pemeliharaan','kp.tindakan_pengamanan','kp.prosedur','komp.kode_pokok','komp.nama_pokok','ksp.kode_sub_pokok','ksp.nama_sub_pokok','ks.kode_komponen_sistem','ks.nama_komponen_sistem','kss.kode_komponen_sub_sistem','kss.nama_komponen_sub_sistem','pel.nama_pelaksana','lok.nama_lokasi','kp.komponen','kp.alat_kerja','kp.id','kp.jo','per.periode','kp.tgl_mulai')
                    ->where('kp.id_sub_sistem','=',"{$request->id_sub_sistem}")
                    ->OrderBy('kp.kode_pemeliharaan','asc')->get();

       return view('proses.kartu_pemeliharaan.data_list_kartu_pemeliharaan',compact('pemeliharaan'));
    } 

    /*** Pencarian Kartu Pemeliharaan - Pelaksana ***/
    public function pencarianPelaksana(Request $request)
    {
        $pemeliharaan = DB::table('kartu_pemeliharaan as kp')
                    ->leftjoin('komponen_pokok as komp','kp.id_komponen_pokok','=','komp.id')
                    ->leftjoin('komponen_sub_pokok as ksp','kp.id_komponen_sub_pokok','=','ksp.id')
                    ->leftjoin('komponen_sistem as ks','kp.id_sistem','=','ks.id')
                    ->leftjoin('komponen_sub_sistem as kss','kp.id_sub_sistem','=','kss.id')
                    ->leftjoin('pelaksana as pel','kp.id_pelaksana','=','pel.id')
                    ->leftjoin('lokasi as lok','kp.id_lokasi','=','lok.id') 
                    ->leftjoin('periode as per','kp.id_periode','=','per.id') 
                    ->select('kp.tanggal','kp.kode_pemeliharaan','kp.id_komponen_pokok','kp.id_komponen_sub_pokok','kp.id_sistem','kp.id_sub_sistem','kp.id_pelaksana','kp.id_lokasi','kp.uraian_pemeliharaan','kp.tindakan_pengamanan','kp.prosedur','komp.kode_pokok','komp.nama_pokok','ksp.kode_sub_pokok','ksp.nama_sub_pokok','ks.kode_komponen_sistem','ks.nama_komponen_sistem','kss.kode_komponen_sub_sistem','kss.nama_komponen_sub_sistem','pel.nama_pelaksana','lok.nama_lokasi','kp.komponen','kp.alat_kerja','kp.id','kp.jo','per.periode','kp.tgl_mulai')
                    ->where('kp.id_pelaksana','=',"{$request->id_pelaksana}")
                    ->OrderBy('kp.kode_pemeliharaan','asc')->get();

       return view('proses.kartu_pemeliharaan.data_list_kartu_pemeliharaan',compact('pemeliharaan'));
    } 

     /*** Pencarian Kartu Pemeliharaan - Lokasi ***/
     public function pencarianLokasi(Request $request)
     {
         $pemeliharaan = DB::table('kartu_pemeliharaan as kp')
                     ->leftjoin('komponen_pokok as komp','kp.id_komponen_pokok','=','komp.id')
                     ->leftjoin('komponen_sub_pokok as ksp','kp.id_komponen_sub_pokok','=','ksp.id')
                     ->leftjoin('komponen_sistem as ks','kp.id_sistem','=','ks.id')
                     ->leftjoin('komponen_sub_sistem as kss','kp.id_sub_sistem','=','kss.id')
                     ->leftjoin('pelaksana as pel','kp.id_pelaksana','=','pel.id')
                     ->leftjoin('lokasi as lok','kp.id_lokasi','=','lok.id') 
                     ->leftjoin('periode as per','kp.id_periode','=','per.id') 
                     ->select('kp.tanggal','kp.kode_pemeliharaan','kp.id_komponen_pokok','kp.id_komponen_sub_pokok','kp.id_sistem','kp.id_sub_sistem','kp.id_pelaksana','kp.id_lokasi','kp.uraian_pemeliharaan','kp.tindakan_pengamanan','kp.prosedur','komp.kode_pokok','komp.nama_pokok','ksp.kode_sub_pokok','ksp.nama_sub_pokok','ks.kode_komponen_sistem','ks.nama_komponen_sistem','kss.kode_komponen_sub_sistem','kss.nama_komponen_sub_sistem','pel.nama_pelaksana','lok.nama_lokasi','kp.komponen','kp.alat_kerja','kp.id','kp.jo','per.periode','kp.tgl_mulai')
                     ->where('kp.id_lokasi','=',"{$request->id_lokasi}")
                     ->OrderBy('kp.kode_pemeliharaan','asc')->get();
 
        return view('proses.kartu_pemeliharaan.data_list_kartu_pemeliharaan',compact('pemeliharaan'));
     } 
    
    /*** Pencarian Kartu Pemeliharaan - periode ***/
    public function pencarianPeriode(Request $request)
    {
        $pemeliharaan = DB::table('kartu_pemeliharaan as kp')
                    ->leftjoin('komponen_pokok as komp','kp.id_komponen_pokok','=','komp.id')
                    ->leftjoin('komponen_sub_pokok as ksp','kp.id_komponen_sub_pokok','=','ksp.id')
                    ->leftjoin('komponen_sistem as ks','kp.id_sistem','=','ks.id')
                    ->leftjoin('komponen_sub_sistem as kss','kp.id_sub_sistem','=','kss.id')
                    ->leftjoin('pelaksana as pel','kp.id_pelaksana','=','pel.id')
                    ->leftjoin('lokasi as lok','kp.id_lokasi','=','lok.id') 
                    ->leftjoin('periode as per','kp.id_periode','=','per.id') 
                    ->select('kp.tanggal','kp.kode_pemeliharaan','kp.id_komponen_pokok','kp.id_komponen_sub_pokok','kp.id_sistem','kp.id_sub_sistem','kp.id_pelaksana','kp.id_lokasi','kp.uraian_pemeliharaan','kp.tindakan_pengamanan','kp.prosedur','komp.kode_pokok','komp.nama_pokok','ksp.kode_sub_pokok','ksp.nama_sub_pokok','ks.kode_komponen_sistem','ks.nama_komponen_sistem','kss.kode_komponen_sub_sistem','kss.nama_komponen_sub_sistem','pel.nama_pelaksana','lok.nama_lokasi','kp.komponen','kp.alat_kerja','kp.id','kp.jo','per.periode','kp.tgl_mulai','kp.id_periode')
                    ->where('per.periode','like',"%{$request->id_periode}%")
                    ->OrderBy('kp.kode_pemeliharaan','asc')->get();

       return view('proses.kartu_pemeliharaan.data_list_kartu_pemeliharaan',compact('pemeliharaan'));
    } 

    /*** Pencarian Kartu Pemeliharaan - komponen ***/
    public function pencarianKomponen(Request $request)
    {
        if ($request->komponen =='') {
            $pemeliharaan = DB::table('kartu_pemeliharaan as kp')
                        ->leftjoin('komponen_pokok as komp','kp.id_komponen_pokok','=','komp.id')
                        ->leftjoin('komponen_sub_pokok as ksp','kp.id_komponen_sub_pokok','=','ksp.id')
                        ->leftjoin('komponen_sistem as ks','kp.id_sistem','=','ks.id')
                        ->leftjoin('komponen_sub_sistem as kss','kp.id_sub_sistem','=','kss.id')
                        ->leftjoin('pelaksana as pel','kp.id_pelaksana','=','pel.id')
                        ->leftjoin('lokasi as lok','kp.id_lokasi','=','lok.id') 
                        ->leftjoin('periode as per','kp.id_periode','=','per.id') 
                        ->select('kp.tanggal','kp.kode_pemeliharaan','kp.id_komponen_pokok','kp.id_komponen_sub_pokok','kp.id_sistem','kp.id_sub_sistem','kp.id_pelaksana','kp.id_lokasi','kp.uraian_pemeliharaan','kp.tindakan_pengamanan','kp.prosedur','komp.kode_pokok','komp.nama_pokok','ksp.kode_sub_pokok','ksp.nama_sub_pokok','ks.kode_komponen_sistem','ks.nama_komponen_sistem','kss.kode_komponen_sub_sistem','kss.nama_komponen_sub_sistem','pel.nama_pelaksana','lok.nama_lokasi','kp.komponen','kp.alat_kerja','kp.id','kp.jo','per.periode','kp.tgl_mulai')
                        ->OrderBy('kp.kode_pemeliharaan','asc')->paginate(25);
        }else{
 
         $pemeliharaan = DB::table('kartu_pemeliharaan as kp')
                        ->leftjoin('komponen_pokok as komp','kp.id_komponen_pokok','=','komp.id')
                        ->leftjoin('komponen_sub_pokok as ksp','kp.id_komponen_sub_pokok','=','ksp.id')
                        ->leftjoin('komponen_sistem as ks','kp.id_sistem','=','ks.id')
                        ->leftjoin('komponen_sub_sistem as kss','kp.id_sub_sistem','=','kss.id')
                        ->leftjoin('pelaksana as pel','kp.id_pelaksana','=','pel.id')
                        ->leftjoin('lokasi as lok','kp.id_lokasi','=','lok.id') 
                        ->leftjoin('periode as per','kp.id_periode','=','per.id') 
                        ->select('kp.tanggal','kp.kode_pemeliharaan','kp.id_komponen_pokok','kp.id_komponen_sub_pokok','kp.id_sistem','kp.id_sub_sistem','kp.id_pelaksana','kp.id_lokasi','kp.uraian_pemeliharaan','kp.tindakan_pengamanan','kp.prosedur','komp.kode_pokok','komp.nama_pokok','ksp.kode_sub_pokok','ksp.nama_sub_pokok','ks.kode_komponen_sistem','ks.nama_komponen_sistem','kss.kode_komponen_sub_sistem','kss.nama_komponen_sub_sistem','pel.nama_pelaksana','lok.nama_lokasi','kp.komponen','kp.alat_kerja','kp.id','kp.jo','per.periode','kp.tgl_mulai','kp.id_periode')
                        ->where('kp.komponen','Like',"%{$request->komponen}%")->get();
        }
        
        return view('proses.kartu_pemeliharaan.data_list_kartu_pemeliharaan',compact('pemeliharaan'));
    } 

    /*** Indeks Komponen ***/
    public function indeksKomponen()
    {
        $data_kelompok = indeksKelompok();
        return view('proses.kartu_pemeliharaan.indeks_komponen',compact('data_kelompok'));
    } 
 
}
