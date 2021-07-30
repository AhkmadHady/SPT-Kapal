<?php

namespace App\Http\Controllers\Proses;

use App\Models\Proses\Skedul;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Master\JenisPerawatan;
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
use App\Models\Proses\PemeliharaanJamPutar;
use Validator;
use Response;
use View;
use DB;
use File;
use Laravel\Ui\Presets\React;
use PDF; 

class SkedulControllers extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

	/*** Index ***/
    public function index()
    {
        $paginate = 1;
        $dateNow  = date('Y-m-d');
        $lokasi   = KomponenLokasi::OrderBy('id','desc')->get();
        $perawatan = JenisPerawatan::OrderBy('id','desc')->get();
        $skedul   = DB::table('kartu_pemeliharaan as kp')
                    ->leftjoin('skedul as sk','sk.kode_pemeliharaan','=','kp.kode_pemeliharaan')
                    ->leftjoin('lokasi as lok','kp.id_lokasi','=','lok.id') 
                    ->select ('sk.tgl_skedul','kp.kode_pemeliharaan','kp.komponen','lok.nama_lokasi','sk.id','sk.status')
                    ->where('sk.tgl_skedul','=',"{$dateNow}")
                    ->paginate(50);
        
        $komponen = Pemeliharaan::groupBy('kode_pemeliharaan','komponen','id')->select('id','komponen','kode_pemeliharaan')->get();

        return view('proses.skedul.skedule',compact('skedul','paginate','lokasi','komponen','perawatan'));
    }
 
    /*** Pencarian Skedul BY Tanggal ***/
    public function pencarianTanggalSkedul(Request $request)
    {
        $paginate = 1;
        $skedul   = DB::table('kartu_pemeliharaan as kp')
                    ->leftjoin('skedul as sk','sk.kode_pemeliharaan','=','kp.kode_pemeliharaan')
                    ->leftjoin('lokasi as lok','kp.id_lokasi','=','lok.id') 
                    ->select ('tgl_skedul','kp.kode_pemeliharaan','kp.komponen','lok.nama_lokasi','sk.id','sk.status')
                    ->where('sk.tgl_skedul','>=',"{$request->tanggal1}")
                    ->where('sk.tgl_skedul','<=',"{$request->tanggal2}")
                    ->get();
        
        return view('proses.skedul.data_list_skedul',compact('skedul','paginate'));
    }   

    /*** Pencarian Skedul BY Komponen ***/
    public function pencarianKomponenSkedul(Request $request)
    {
        
            if ($request->status == '2') {

                $paginate = 1;
                $skedul   = DB::table('kartu_pemeliharaan as kp')
                            ->leftjoin('skedul as sk','sk.kode_pemeliharaan','=','kp.kode_pemeliharaan')
                            ->leftjoin('lokasi as lok','kp.id_lokasi','=','lok.id') 
                            ->select ('tgl_skedul','kp.kode_pemeliharaan','kp.komponen','lok.nama_lokasi','sk.id','sk.status')
                            ->where('kp.komponen','=',"{$request->komponen}")
                           ->get();
            }

            if ($request->status == '1') {
                $paginate = 1;
                $skedul   = DB::table('kartu_pemeliharaan as kp')
                            ->leftjoin('skedul as sk','sk.kode_pemeliharaan','=','kp.kode_pemeliharaan')
                            ->leftjoin('lokasi as lok','kp.id_lokasi','=','lok.id') 
                            ->select ('tgl_skedul','kp.kode_pemeliharaan','kp.komponen','lok.nama_lokasi','sk.id','sk.status')
                            ->where('sk.status','=','1')
                            ->where('kp.komponen','=',"{$request->komponen}")
                           ->get();
            }
            
            if ($request->status == '0') {
                $paginate = 1;
                $skedul   = DB::table('kartu_pemeliharaan as kp')
                            ->leftjoin('skedul as sk','sk.kode_pemeliharaan','=','kp.kode_pemeliharaan')
                            ->leftjoin('lokasi as lok','kp.id_lokasi','=','lok.id') 
                            ->select ('tgl_skedul','kp.kode_pemeliharaan','kp.komponen','lok.nama_lokasi','sk.id','sk.status')
                            ->where('sk.status','=','0')
                            ->where('kp.komponen','=',"{$request->komponen}")
                           ->get();
            }

            if ($request->komponen =='') {
                $paginate = 1;
                $dateNow  = date('Y-m-d'); 
                $skedul   = DB::table('kartu_pemeliharaan as kp')
                            ->leftjoin('skedul as sk','sk.kode_pemeliharaan','=','kp.kode_pemeliharaan')
                            ->leftjoin('lokasi as lok','kp.id_lokasi','=','lok.id') 
                            ->select ('sk.tgl_skedul','kp.kode_pemeliharaan','kp.komponen','lok.nama_lokasi','sk.id','sk.status')
                            ->where('sk.tgl_skedul','=',"{$dateNow}")
                           ->get();
            }
            

            return view('proses.skedul.data_list_skedul',compact('skedul','paginate'));
    } 

    /*** Pencarian Skedul BY Lokasi ***/ 
    public function pencarianLokasiSkedul(Request $request)
    {
        
            if ($request->status == '2') {

                $paginate = 1;
                $skedul   = DB::table('kartu_pemeliharaan as kp')
                            ->leftjoin('skedul as sk','sk.kode_pemeliharaan','=','kp.kode_pemeliharaan')
                            ->leftjoin('lokasi as lok','kp.id_lokasi','=','lok.id') 
                            ->select ('tgl_skedul','kp.kode_pemeliharaan','kp.komponen','lok.nama_lokasi','sk.id','sk.status')
                            ->where('kp.id_lokasi','=',"{$request->lokasi}")
                            ->get();
            }

            if ($request->status == '1') {
                $paginate = 1;
                $skedul   = DB::table('kartu_pemeliharaan as kp')
                            ->leftjoin('skedul as sk','sk.kode_pemeliharaan','=','kp.kode_pemeliharaan')
                            ->leftjoin('lokasi as lok','kp.id_lokasi','=','lok.id') 
                            ->select ('tgl_skedul','kp.kode_pemeliharaan','kp.komponen','lok.nama_lokasi','sk.id','sk.status')
                            ->where('sk.status','=','1')
                            ->where('kp.id_lokasi','=',"{$request->lokasi}")
                            ->get();
            }
            
            if ($request->status == '0') {
                $paginate = 1;
                $skedul   = DB::table('kartu_pemeliharaan as kp')
                            ->leftjoin('skedul as sk','sk.kode_pemeliharaan','=','kp.kode_pemeliharaan')
                            ->leftjoin('lokasi as lok','kp.id_lokasi','=','lok.id') 
                            ->select ('tgl_skedul','kp.kode_pemeliharaan','kp.komponen','lok.nama_lokasi','sk.id','sk.status')
                            ->where('sk.status','=','0')
                            ->where('kp.id_lokasi','=',"{$request->lokasi}")
                            ->get();
            }

            if ($request->lokasi =='') {
                $paginate = 1;
                $dateNow  = date('Y-m-d'); 
                $skedul   = DB::table('kartu_pemeliharaan as kp')
                            ->leftjoin('skedul as sk','sk.kode_pemeliharaan','=','kp.kode_pemeliharaan')
                            ->leftjoin('lokasi as lok','kp.id_lokasi','=','lok.id') 
                            ->select ('sk.tgl_skedul','kp.kode_pemeliharaan','kp.komponen','lok.nama_lokasi','sk.id','sk.status')
                            ->where('sk.tgl_skedul','=',"{$dateNow}")
                            ->get();
            }
            
            return view('proses.skedul.data_list_skedul',compact('skedul','paginate'));
    } 

    /*** Delete Data Skedul Pemeliharaan ***/
    public function deleteSkedul(Request $request)
    {
        Skedul::where('id','=',"{$request->id_hapus}")->delete();
        PelaksanaanPemeliharaan::where('id_skedul','=',"{$request->id_hapus}")->delete();
        return redirect()->back()->with('info','Data skedul berhasil dihapus.'); 
    }

    /*** Update Tanggal Skedul ***/ 
    public function updatetanggalSkedul(Request $request)
    {
        Skedul::where('id','=',"{$request->id_skedul}")
              ->update([
                    'tgl_skedul' => $request->tgl_skedul_baru
              ]);
        
        return redirect()->back()->with('info','Data skedul berhasil diupdate.'); 
    } 

    /*** Jadwal Skedul ***/
    public function jadwalSkedul()
    {
        $bulan_ = date('m');
        $tahun_ = date('Y');

        $skedul = Skedul::whereYear('tgl_skedul','=',"{$tahun_}")
                        ->whereMonth('tgl_skedul','=',"{$bulan_}")
                        ->get();
                        
        return view('proses.pelaksanaan.kalender_jadwal_skedul',compact('skedul','bulan_','tahun_'));
    }

     /*** Get Jadwal Skedul ***/
    public function getJadwalSkedul(Request $request)
    {
         $bulan_ = $request->bulan;
         $tahun_ = $request->tahun;

         $skedul = Skedul::whereYear('tgl_skedul','=',"{$tahun_}")
                         ->whereMonth('tgl_skedul','=',"{$bulan_}")
                         ->get();
                         
         return view('proses.pelaksanaan.kalender_jadwal_skedul',compact('skedul','bulan_','tahun_'));
    }

    /*** Get Data Komponen Jadwal Pemeliharaan ***/
    public function getKomponenSkedulPemeliharaan($tanggal)
    {
        $komponen = DB::table('skedul as sk')
                        ->leftjoin('kartu_pemeliharaan as kp','sk.kode_pemeliharaan','=','kp.kode_pemeliharaan')
                        ->leftjoin('komponen_pokok as komp','kp.id_komponen_pokok','=','komp.id')
                        ->leftjoin('komponen_sub_pokok as ksp','kp.id_komponen_sub_pokok','=','ksp.id')
                        ->leftjoin('komponen_sistem as ks','kp.id_sistem','=','ks.id')
                        ->leftjoin('komponen_sub_sistem as kss','kp.id_sub_sistem','=','kss.id')
                        ->leftjoin('pelaksana as pel','kp.id_pelaksana','=','pel.id')
                        ->leftjoin('lokasi as lok','kp.id_lokasi','=','lok.id') 
                        ->leftjoin('periode as per','kp.id_periode','=','per.id')
                        ->select('kp.tanggal','kp.kode_pemeliharaan','kp.id_komponen_pokok','kp.id_komponen_sub_pokok','kp.id_sistem','kp.id_sub_sistem','kp.id_pelaksana','kp.id_lokasi','kp.uraian_pemeliharaan','kp.tindakan_pengamanan','kp.prosedur','komp.kode_pokok','komp.nama_pokok','ksp.kode_sub_pokok','ksp.nama_sub_pokok','ks.kode_komponen_sistem','ks.nama_komponen_sistem','kss.kode_komponen_sub_sistem','kss.nama_komponen_sub_sistem','pel.nama_pelaksana','lok.nama_lokasi','kp.komponen','kp.alat_kerja','sk.id','kp.jo','per.periode','kp.tgl_mulai','sk.status','sk.tgl_skedul','kp.id as id_kartu_pemeliharaan')
                        ->where('sk.tgl_skedul','=',"{$tanggal}")
                        ->get();

        $pelaksana      = Pelaksana::OrderBy('id','desc')->get();
        $tanggal = $tanggal;
        return view('proses.pelaksanaan.data_komponen_skedul',compact('komponen','tanggal','pelaksana'));
    }  

    /*** Save Kartu Pemeliharaan ***/
    public function savePemeliharaanKomponen(Request $request)
    {
         $validasi = Validator::make($request->all(),[
             'id_skedul'       => 'required',
             'tgl_pelaksanaan' => 'required'
         ]);
 
        if ($validasi->fails())
        {
            //  return redirect()->back()->withErrors($validasi->errors());
              return Response::Json(array('errors' => $validasi->getMessageBag()->toArray()));
 
        }else{

             /*** save pelaksanaan pemeliharaan ***/  
             $input                      = new PelaksanaanPemeliharaan(); 
             $input->id_skedul           = $request->id_skedul; 
             $input->id_pelaksana        = $request->id_pelaksana; 
             $input->tgl_pelaksanaan     = $request->tgl_pelaksanaan; 
             $input->catatan             = $request->catatan;  
             $input->save();

            /*** update status skedul ***/  
             Skedul::where('id','=',"{$request->id_skedul}")->update([ 'status' => 1 ]);

            /*** get data kode pemeliharaan ***/ 
            $data_kode_pemeliharaan  = Skedul::where('id','=',"{$request->id_skedul}")->get()->first();

            if (isset($data_kode_pemeliharaan)) {

                $kode_pemeliharaan_ = $data_kode_pemeliharaan->kode_pemeliharaan;

                /*** get status skedul ***/
                $data_status_skedul =  Skedul::where('kode_pemeliharaan','=',"{$kode_pemeliharaan_}")
                                              ->where('status','=','0')
                                              ->get()->first();

                if (isset($data_status_skedul)) {

                    return redirect()->back()->with('info','Data pelaksanaan pemeliharaan berhasi disimpan, skedul pemeliharaan komponen gagal di generate.'); 
                    
                }else{

                    /*** get tanggal max skedul ***/
                    $tgl_maksimal = Skedul::where('kode_pemeliharaan','=',"{$kode_pemeliharaan_}")
                            ->select(DB::raw('MAX(tgl_skedul) as tanggal'))
                            ->get()->first();
                    
                    if (isset($tgl_maksimal)) {

                       $tanggal_max_skedul = $tgl_maksimal->tanggal;
                       $tahun_skedul = date('Y',strtotime($tanggal_max_skedul));
 
                       $data_pemeliharaan = DB::table('kartu_pemeliharaan as kp') 
                       ->leftjoin('periode as per','kp.id_periode','=','per.id') 
                       ->select('kp.tanggal','kp.kode_pemeliharaan','kp.id_komponen_pokok','kp.id_komponen_sub_pokok','kp.id_sistem','kp.id_sub_sistem','kp.id_pelaksana','kp.id_lokasi','kp.uraian_pemeliharaan','kp.tindakan_pengamanan','kp.prosedur','kp.komponen','kp.alat_kerja','kp.id','kp.jo','kp.id_periode','per.periode','kp.tgl_mulai','kp.alat_kerja','per.rumus')
                       ->where('kp.kode_pemeliharaan','=',"{$kode_pemeliharaan_}")
                       ->OrderBy('kp.id','desc')->get()->first();

                        if (isset($data_pemeliharaan)) {
                         
                                $jml_hari         = $data_pemeliharaan->rumus;
                                $jml_hari_setahun = 365;

                                /*** Jika Priode lebih dari satu tahun ***/
                                if ($jml_hari > 365) {

                                        $cek_status = Skedul::where('status','=',0)->where('kode_pemeliharaan','=',"{$kode_pemeliharaan_}")->get()->first();
 
                                        if (isset($cek_status)) {
                                            return redirect()->back()->with('info','Data pelaksanaan pemeliharaan berhasi disimpan');  exit();
                                        }

                                        $jml_hari1         = $data_pemeliharaan->rumus ;
                                        $tgl_rumus         = $tahun_skedul.'-'.date('m-d',strtotime($tanggal_max_skedul));
                                        $tgl_mulai1        = date_create($tgl_rumus);
                                        
                                        date_add($tgl_mulai1, date_interval_create_from_date_string("$jml_hari1 days"));
                                        $tgl_service1 = date_format($tgl_mulai1, 'Y-m-d');

                                        $input                       = new Skedul();
                                        $input->kode_pemeliharaan    = $kode_pemeliharaan_; 
                                        $input->tgl_skedul           = $tgl_service1;  
                                        $input->tahun                = $tahun_skedul; 
                                        $input->status               = 0; 
                                        $input->save();
                                    
                                }elseif($jml_hari ==0){
                                    return redirect()->back()->with('info','Data pelaksanaan pemeliharaan berhasi disimpan');  exit();
                                }else{
                                    
                                    if ($jml_hari > $jml_hari_setahun) {

                                        $jml_skedul       = floor($jml_hari / $jml_hari_setahun);

                                    }else{

                                        $jml_skedul       = floor($jml_hari_setahun / $jml_hari);

                                    }



                                    for ($i=1; $i <= $jml_skedul; $i++) { 

                                        $jml_hari1         = $data_pemeliharaan->rumus * $i;
                                        $tgl_rumus         = $tahun_skedul.'-'.date('m-d',strtotime($tanggal_max_skedul));
                                        $tgl_mulai1        = date_create($tgl_rumus);
                                        
                                        date_add($tgl_mulai1, date_interval_create_from_date_string("$jml_hari1 days"));
                                        $tgl_service1 = date_format($tgl_mulai1, 'Y-m-d');

                                        $input                  = new Skedul();
                                        $input->kode_pemeliharaan  = $kode_pemeliharaan_; 
                                        $input->tgl_skedul         = $tgl_service1;  
                                        $input->tahun              = $tahun_skedul; 
                                        $input->status             = 0; 
                                        $input->save();
                                    }

                                } 
                        }  

                    }else{

                        return redirect()->back()->with('gagal','Data pelaksanaan pemeliharaan berhasil disimpan'); 
                    }

                }
            }
            return redirect()->back()->with('info','Data pemeliharaan komponen berhasil disimpan'); 
        }
    } 

    // save pemeliharaan 
    public function saveJadwalPemeliharaan(Request $request)
    {
        $datapemeliharaan = Pemeliharaan::where('id','=',"{$request->kode_pemeliharaan}")->first();
        $tahun = date('Y',strtotime($request->tgl_jadwal_baru_frm));
        $input   = new Skedul();
                $input->kode_pemeliharaan    = $datapemeliharaan->kode_pemeliharaan; 
                $input->tgl_skedul           = $request->tgl_jadwal_baru_frm;  
                $input->tahun                = $tahun; 
                $input->status               = 0; 
                $input->save();
        
        PemeliharaanJamPutar::create([
                'tgl_pemeliharaan'       => $request->get('tgl_jadwal_baru_frm'),
                'id_kartu_pemeliharaan'  => $request->get('kode_pemeliharaan'),
                'jml_putaran'            => $request->get('jam_putaran'),
        ]);

        return redirect()->back()->with('info','Data pemeliharaan komponen berhasil disimpan');               
    }

    // cek rumus periode
    public function getRumusPeriode(Request $request)
    {
        if ($request->id =='') {
            return response()->json(['message' => '1']);
        }else{
            $komponen  =  DB::table('kartu_pemeliharaan as kp')
                        ->leftjoin('periode as pr','kp.id_periode','=','pr.id')
                        ->leftjoin('jenis_perawatan as jp','kp.id_jenis_perawatan','=','jp.id')
                        ->where('kp.id','=',"{$request->id}")
                        ->select('pr.rumus')->get()->first();
            return response()->json(['message' => $komponen->rumus]);
        }
    }

}


