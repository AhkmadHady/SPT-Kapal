<?php

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input; 
use Illuminate\Contracts\Auth\User;
use App\Models\Master\KomponenLokasi;
use Validator;
use Response;
use View;
use DB;
use File;

class KomponenLokasiControllers extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /*** Index Komponen Lokasi ***/
    public function index()
    {
        $lokasi = KomponenLokasi::OrderBy('id','desc')->get();
        return view('master.lokasi.lokasi',compact('lokasi'));
    }

    /*** pencarian lokasi ***/ 
    public function pencarianLokasi(Request $request)
    {
        $lokasi = KomponenLokasi::where('nama_lokasi','like',"%{$request->pencarian}%")->get();
        return view('master.lokasi.data_list_lokasi',compact('lokasi'));
    }

    /*** Create Komponen Lokasi ***/
    public function createLokasi()
    {
        return view('master.lokasi.add_lokasi');
    }

    /*** Save Lokasi ***/
    public function saveLokasi(Request $request)
    {
    	$validasi = Validator::make($request->all(), [
			'nama_lokasi' => 'required|max:50'
        ]);

        if ($validasi->fails())
        {
            return redirect()->back()->withErrors($validasi->errors());
        }else{

            $input              = new KomponenLokasi();
            $input->nama_lokasi = $request->nama_lokasi; 
            $input->keterangan  = $request->keterangan; 
            $input->save();
            return redirect()->back()->with('info','Data lokasi komponen berhasil disimpan');
        }
    }

    /*** Update Lokasi ***/
    public function updateLokasi(Request $request,$id)
    {
        $validasi = Validator::make($request->all(), [
            'nama_lokasi' => 'required|max:50'
        ]);

        if ($validasi->fails())
        {
            return redirect()->back()->withErrors($validasi->errors());
        }else{

                KomponenLokasi::where('id','=',"{$id}")
                              ->update([
                                         'nama_lokasi' => $request->nama_lokasi,
                                         'keterangan'  => $request->keterangan
                                        ]);
              
                return redirect()->back()->with('info','Data lokasi komponen berhasil diupdate');
        }
    }

    /*** Edit Lokasi ***/
    public function editLokasi($id)
    {
        $lokasi = KomponenLokasi::where('id','=',"{$id}")->get()->first();
        return view('master.lokasi.edit_lokasi',compact('lokasi'));
    }

    /*** Delete Lokasi ***/
    public function deleteLokasi(Request $request)
    {
        KomponenLokasi::where('id','=',"{$request->id_hapus}")->delete();
        return redirect()->back()->with('info','Data lokasi komponen berhasil dihapus');
    }
}
