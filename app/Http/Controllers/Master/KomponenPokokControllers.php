<?php

namespace App\Http\Controllers\Master;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input; 
use Illuminate\Contracts\Auth\User;
use App\Models\Master\KomponenPokok;
use Validator;
use Response;
use View;
use DB;
use File;

class KomponenPokokControllers extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /*** Index Komponen Pokok ***/
    public function index()
    {
        $kelompok = KomponenPokok::OrderBy('id','desc')->get();
        return view('master.kelompok.kelompok',compact('kelompok'));
    }

    /*** Save Komponen Pokok ***/
    public function saveKomponenPokok(Request $request)
    {
    	$validasi = Validator::make($request->all(), [
			'kode_pokok' => 'required|max:35|unique:komponen_pokok',
			'nama_pokok' => 'required'
            ]);

        if ($validasi->fails())
        {
        	
            return redirect()->back()->withErrors($validasi->errors());

        }else{
				
			$input             = new KomponenPokok();
			$input->kode_pokok = $request->kode_pokok; 
			$input->nama_pokok = $request->nama_pokok; 
			$input->keterangan = $request->keterangan;   
            $input->save();
            return redirect()->back()->with('info','Data kelompok komponen berhasil disimpan');
        }
    }

    /*** Add Komponen Pokok ***/
    public function createKomponenPokok()
    {

        return view('master.kelompok.add_kelompok');
       
    }

    /*** pencarian kelompok ***/
    public function pencarianKelompok(Request $request)
    {
        $kelompok = KomponenPokok::OrderBy('id','desc')->where('nama_pokok','like',"%{$request->pencarian}%")->get();
        return view('master.kelompok.data_list_kelompok',compact('kelompok'));
    } 

    /*** Edit Kompnen Pokok ***/
    public function editKomponenPokok($id)
    {
    	 
    	$data_kelompok = KomponenPokok::where('id','=',"{$id}")->get()->first();
        if (isset($data_kelompok)) {
             return view('master.kelompok.edit_kelompok',compact('data_kelompok'));
        }else{
            abort(404);
        }

    }

    /*** Update Komponen Pokok ***/
    public function updateKompnenPokok(Request $request,$id)
    {
    	$validasi = Validator::make($request->all(), [
			'kode_pokok' => 'required|max:35',
			'nama_pokok' => 'required'
            ]);

        if ($validasi->fails())
        {
            return redirect()->back()->withErrors($validasi->errors());
        }else{

        		KomponenPokok::where('id','=',"{$id}")
        				->update([
									'kode_pokok' => $request->kode_pokok,
									'nama_pokok' => $request->nama_pokok, 
									'keterangan' => $request->keterangan
        						]);
 				 
                return redirect()->back()->with('info','Data kelompok komponen berhasil diupdate');
        }
    }

    /*** Delete Komponen Kelompok ***/
    public function deleteKomponenKelompok(Request $request)
    {
    	KomponenPokok::where('id','=',"{$request->id_hapus}")->delete();
        return redirect()->back()->with('info','Data kelompok berhasil dihapus');

    }
}
