<?php

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input; 
use Illuminate\Contracts\Auth\User;
use App\Models\Master\KomponenPokok;
use App\Models\Master\KomponenSubPokok;
use Validator;
use Response;
use View;
use DB;
use File;

class KomponenSubPokokControllers extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /*** Index ***/
    public function index()
    {
    	 $data_subkelompok = KomponenSubPokok::OrderBy('id','asc')->get();

         return view('master.sub_kelompok.sub_kelompok',compact('data_subkelompok'));
    }

    /*** pencarian subkelompok ***/ 
    public function pencarianSubkelompok(Request $request)
    {
        $data_subkelompok = KomponenSubPokok::OrderBy('id','asc')->where('nama_sub_pokok','like',"%{$request->pencarian}%")->get(); 
        return view('master.sub_kelompok.data_list_sub_kelompok',compact('data_subkelompok'));
    }

    /*** Create Sub Kelompok Komponenn ***/
    public function createSubKelompok()
    { 
    	return view('master.sub_kelompok.add_subkelompok');
    }

     /*** Edit Sub Kelompok Komponen ***/
    public function editSubKomponenPokok($id)
    {
    	   
			$data_kelompok =  KomponenSubPokok::where('id','=',"{$id}")->get()->first();
        if (isset($data_kelompok)) {
             return view('master.sub_kelompok.edit_sub_kelompok',compact('data_kelompok'));
        }else{
            abort(404);
        }

    }

    /*** Save Sub Kelompok Komponen ***/
    public function saveSubKomponenPokok(Request $request)
    {
    	$validasi = Validator::make($request->all(), [
			'kode_sub_pokok'    => 'required|max:35|unique:komponen_sub_pokok',
			'nama_sub_pokok'    => 'required'
            ]);

        if ($validasi->fails())
        {
        	
            return redirect()->back()->withErrors($validasi->errors());

        }else{
				
			$input                    = new KomponenSubPokok();
			$input->kode_sub_pokok    = $request->kode_sub_pokok; 
			$input->nama_sub_pokok    = $request->nama_sub_pokok;  
			$input->keterangan        = $request->keterangan;   
            $input->save();
            return redirect()->back()->with('info','Data sub-kelompok komponen berhasil disimpan');
        }
    }

    /*** Delete Komponen Sub-Kelompok ***/
    public function deleteKomponenSubKelompok(Request $request)
    {
    	KomponenSubPokok::where('id','=',"{$request->id_hapus}")->delete();
        return redirect()->back()->with('info','Data sub-kelompok berhasil dihapus');

    }

     /*** Update Komponen Sub-Kelompok ***/
    public function updateKompnenSubPokok(Request $request,$id)
    {
    	$validasi = Validator::make($request->all(), [
			'kode_sub_pokok'    => 'required|max:35',
			'nama_sub_pokok'    => 'required'
            ]);

        if ($validasi->fails())
        {
            return redirect()->back()->withErrors($validasi->errors());
        }else{

        		KomponenSubPokok::where('id','=',"{$id}")
        				->update([
									'kode_sub_pokok'    => $request->kode_sub_pokok,
									'nama_sub_pokok'    => $request->nama_sub_pokok,  
									'keterangan'        => $request->keterangan
        						]);
 				 
                return redirect()->back()->with('info','Data sub-kelompok komponen berhasil diupdate');
        }
    }
}
