<?php

namespace App\Http\Controllers\Master;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input; 
use Illuminate\Contracts\Auth\User;
use App\Models\Master\KomponenSistem;
use Validator;
use Response;
use View;
use DB;
use File;

class KomponenSistemControllers extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /*** Index ***/
    public function index()
    {
    	 $sistem = KomponenSistem::OrderBy('id','desc')->get();
         return view('master.sistem.sistem',compact('sistem'));
    }

    /*** pencarian sistem ***/
    public function pencarianSistem(Request $request)
    {
        $sistem = KomponenSistem::OrderBy('id','desc')->where('nama_komponen_sistem','like',"%{$request->pencarian}%")->get();
        return view('master.sistem.data_list_sistem',compact('sistem'));
    } 

    /*** Create Sistem ***/
    public function createSistem()
    {
    	return view('master.sistem.add_sistem');
    }

    /*** Edit Sistem ***/
    public function editSistem($id)
    {
    	  
		$sistem = KomponenSistem::OrderBy('id','desc')->get()->first();
			 
        if (isset($sistem)){

        	 return view('master.sistem.edit_sistem',compact('sistem'));

        }else{

            abort(404);

        }
    }

    /*** Save Sistem ***/
    public function saveSistem(Request $request)
    {
    	$validasi = Validator::make($request->all(), [
			'kode_komponen_sistem' => 'required|max:35|unique:komponen_sistem',
			'nama_komponen_sistem' => 'required'
            ]);

        if ($validasi->fails())
        {
        	
            return redirect()->back()->withErrors($validasi->errors());

        }else{
				
			$input                       = new KomponenSistem();
			$input->kode_komponen_sistem = $request->kode_komponen_sistem; 
			$input->nama_komponen_sistem = $request->nama_komponen_sistem;  
			$input->keterangan           = $request->keterangan;   
            $input->save();
            return redirect()->back()->with('info','Data komponen sistem berhasil disimpan');
        }
    }

    /*** Delete Sistem ***/
    public function deleteSistem(Request $request)
    {
    	KomponenSistem::where('id','=',"{$request->id_hapus}")->delete();
        return redirect()->back()->with('info','Data komponen sistem berhasil dihapus');

    }

    /*** Update Sistem ***/
    public function updateSistem(Request $request,$id)
    {
    	$validasi = Validator::make($request->all(), [
			'kode_komponen_sistem'    => 'required|max:35',
			'nama_komponen_sistem'    => 'required'
			]);

        if ($validasi->fails())
        {
            return redirect()->back()->withErrors($validasi->errors());
        }else{

        		KomponenSistem::where('id','=',"{$id}")
        				->update([
									'kode_komponen_sistem' => $request->kode_komponen_sistem,
									'nama_komponen_sistem' => $request->nama_komponen_sistem, 
									'keterangan'           => $request->keterangan
        						]);
 				
                return redirect()->back()->with('info','Data komponen sistem berhasil diupdate');
        }
    }
}
