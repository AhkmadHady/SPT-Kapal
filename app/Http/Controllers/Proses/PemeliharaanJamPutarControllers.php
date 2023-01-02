<?php

namespace App\Http\Controllers\Proses;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Master\Pelaksana;
use App\Models\Proses\Pemeliharaan;
use App\Models\Proses\PemeliharaanJamPutar;
use Illuminate\Support\Facades\Input; 
use Illuminate\Contracts\Auth\User;
use Validator;
use Response;
use View;
use DB;
use File;
use PDF; 

class PemeliharaanJamPutarControllers extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //pemeliaharaan jam putar
    public function pemaliharaanJamPutar()
    {
        $pemeliharaan = DB::table('service_putaran as sp')
                            ->leftjoin('kartu_pemeliharaan as kp','sp.id_kartu_pemeliharaan','=','kp.id')
                            ->leftjoin('pelaksana as pl','sp.id_pelaksana','=','pl.id')
                            ->leftjoin('periode as pr','kp.id_periode','=','pr.id')
                            ->leftjoin('jenis_perawatan as jp','kp.id_jenis_perawatan','=','jp.id')
                            ->select('sp.tgl_pemeliharaan','sp.id_kartu_pemeliharaan','sp.jml_putaran','kp.id_pelaksana','sp.catatan','kp.komponen','pl.nama_pelaksana','kp.kode_pemeliharaan','sp.id','pr.rumus','jp.jenis_perawatan')
                            ->OrderBy('sp.id','desc')
                            ->paginate(25);

        return view('proses.pemeliharaan_jam_putar.pemeliharaan_jam_putar',compact('pemeliharaan'));
    }
    
    // pencarian periode pemeliharaan jam putar
    public function pencarianPemeliharaanJamPutar(Request $request)
    {
        $pemeliharaan = DB::table('service_putaran as sp')
                            ->leftjoin('kartu_pemeliharaan as kp','sp.id_kartu_pemeliharaan','=','kp.id')
                            ->leftjoin('pelaksana as pl','sp.id_pelaksana','=','pl.id')
                            ->leftjoin('periode as pr','kp.id_periode','=','pr.id')
                            ->leftjoin('jenis_perawatan as jp','kp.id_jenis_perawatan','=','jp.id')
                            ->select('sp.tgl_pemeliharaan','sp.id_kartu_pemeliharaan','sp.jml_putaran','kp.id_pelaksana','sp.catatan','kp.komponen','pl.nama_pelaksana','kp.kode_pemeliharaan','sp.id','pr.rumus','jp.jenis_perawatan')
                            ->where('sp.tgl_pemeliharaan','>=',"{$request->tanggal1}")
                            ->where('sp.tgl_pemeliharaan','<=',"{$request->tanggal2}") 
                            ->get();
        
        return view('proses.pemeliharaan_jam_putar.data_pemeliharaan_jam_putar',compact('pemeliharaan'));
    }

    // pencarian komponen pemeliharaan jam putar
    public function pencarianKomponenPemeliharaanJamputar(Request $request)
    {
    
        $pemeliharaan = DB::table('service_putaran as sp')
                        ->leftjoin('kartu_pemeliharaan as kp','sp.id_kartu_pemeliharaan','=','kp.id')
                        ->leftjoin('pelaksana as pl','sp.id_pelaksana','=','pl.id')
                        ->leftjoin('periode as pr','kp.id_periode','=','pr.id')
                        ->leftjoin('jenis_perawatan as jp','kp.id_jenis_perawatan','=','jp.id')
                        ->select('sp.tgl_pemeliharaan','sp.id_kartu_pemeliharaan','sp.jml_putaran','kp.id_pelaksana','sp.catatan','kp.komponen','pl.nama_pelaksana','kp.kode_pemeliharaan','sp.id','pr.rumus','jp.jenis_perawatan')
        ->where('kp.komponen','like',"%{$request->pencarian}%")
        ->orwhere('jp.jenis_perawatan','like',"%{$request->pencarian}%")
        ->get();

        return view('proses.pemeliharaan_jam_putar.data_pemeliharaan_jam_putar',compact('pemeliharaan'));
    }

    // create pemeliharaan jam putar
    public function createPemeliharaanJamPutar()
    {
        $komponen  =  DB::table('kartu_pemeliharaan as kp')
                        ->leftjoin('periode as pr','kp.id_periode','=','pr.id')
                        ->leftjoin('jenis_perawatan as jp','kp.id_jenis_perawatan','=','jp.id')
                        ->select('komponen','periode','kp.id')->get();

        $pelaksana = Pelaksana::all();
        return view('proses.pemeliharaan_jam_putar.create_pemeliharaan_jam_putar',compact('pelaksana','komponen'));
    }

    // delete pemeliharaan jam putar
    public function deletePemeliharaanJamPutar(Request $request)
    {
        PemeliharaanJamPutar::where('id','=',"{$request->id_hapus}")->delete();
        return redirect()->route('jam_putar')->with('info','Data pemeliharaan berhasil dihapus');
    }

    // save pemeliharaan jam putar
    public function savePemeliharaanJamPutar(Request $request)
    {
        $validasi = Validator::make($request->all(), [
            'tgl_pemeliharaan'          => 'required',
            'id_kartu_pemeliharaan'     => 'required',
            'id_pelaksana'              => 'required', 
        ]);

        if ($validasi->fails())
        {
            return redirect()->back()->withErrors($validasi->errors());
            /* return Response::Json(array('errors' => $validasi->getMessageBag()->toArray()));*/

        }else{
                $input                          = new PemeliharaanJamPutar();
                $input->tgl_pemeliharaan        = $request->tgl_pemeliharaan;
                $input->id_kartu_pemeliharaan   = $request->id_kartu_pemeliharaan;
                $input->id_pelaksana            = $request->id_pelaksana;
                $input->jml_putaran             = $request->jml_putaran;
                $input->catatan                 = $request->catatan;
                $input->save();
                return redirect()->route('jam_putar')->with('info','Data pemeliharaan berhasil disimpan');
        }
    }

    // update pemeliharaan jam putar
    public function updatePemeliharaanJamPutar(Request $request, $id)
    {
        $validasi = Validator::make($request->all(), [
            'tgl_pemeliharaan'          => 'required',
            'id_kartu_pemeliharaan'     => 'required',
            'id_pelaksana'              => 'required', 
        ]);

        if ($validasi->fails())
        {
            return redirect()->back()->withErrors($validasi->errors());
            /* return Response::Json(array('errors' => $validasi->getMessageBag()->toArray()));*/

        }else{

            PemeliharaanJamPutar::where('id','=',"{$id}")->update([
                                            'tgl_pemeliharaan' => $request->tgl_pemeliharaan,
                                            'id_kartu_pemeliharaan' => $request->id_kartu_pemeliharaan,
                                            'id_pelaksana' => $request->id_pelaksana,
                                            'jml_putaran' => $request->jml_putaran
                                            ]);
                 
            return redirect()->route('jam_putar')->with('info','Data pemeliharaan berhasil diupdate');
        }
    }

    // edit pemeliharaan jam putar
    public function editKerusakan($id)
    {
        $pemeliharaan_putaran = DB::table('service_putaran as sp')
                            ->leftjoin('kartu_pemeliharaan as kp','sp.id_kartu_pemeliharaan','=','kp.id')
                            ->leftjoin('pelaksana as pl','sp.id_pelaksana','=','pl.id')
                            ->leftjoin('periode as pr','kp.id_periode','=','pr.id')
                            ->leftjoin('jenis_perawatan as jp','kp.id_jenis_perawatan','=','jp.id')
                            ->select('sp.tgl_pemeliharaan','sp.id_kartu_pemeliharaan','sp.jml_putaran','kp.id_pelaksana','sp.catatan','kp.komponen','pl.nama_pelaksana','kp.kode_pemeliharaan','sp.id','pr.rumus','jp.jenis_perawatan','pr.periode')
                            ->where('sp.id','=',"{$id}")
                            ->get()->first();

        $komponen  =  DB::table('kartu_pemeliharaan as kp')
                            ->leftjoin('periode as pr','kp.id_periode','=','pr.id')
                            ->leftjoin('jenis_perawatan as jp','kp.id_jenis_perawatan','=','jp.id')
                            ->where('jp.kategori','=',"TIDAK TERENCANA")
                            ->select('komponen','periode','kp.id')->get();
                        
        $pelaksana = Pelaksana::all();

        $id_service = $id;
        if (isset($pemeliharaan_putaran)) {
            return view('proses.pemeliharaan_jam_putar.edit_pemeliharaan_jam_putaran',compact('pelaksana','pemeliharaan_putaran','id_service','komponen'));
        }else{
            abort(404);
        } 
    }

    // cek periode komponen
    public function cekPeriodeKomponen(Request $request)
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
