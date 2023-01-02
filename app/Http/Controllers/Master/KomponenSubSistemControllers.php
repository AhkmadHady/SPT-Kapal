<?php

namespace App\Http\Controllers\Master;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input; 
use Illuminate\Contracts\Auth\User;
use App\Models\Master\KomponenSistem;
use App\Models\Master\KomponenSubSistem;
use Validator;
use Response;
use View;
use DB;
use File;

class KomponenSubSistemControllers extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /*** Index ***/
    public function index()
    {
    	 
    	 $subsistem = KomponenSubSistem::OrderBy('id','desc')->get();

         return view('master.sub_sistem.sub_sistem',compact('subsistem'));
    }

    /*** pencarian data sub sistem ***/
    public function pencarianSubSistem(Request $request)
    {
        $subsistem = KomponenSubSistem::OrderBy('id','desc')->where('nama_komponen_sub_sistem','like',"%{$request->pencarian}%")->get();

        return view('master.sub_sistem.data_list_sub_sistem',compact('subsistem'));
    } 

    /*** Create Sub-Sistem ***/
    public function createSubSistem()
    { 
    	return view('master.sub_sistem.add_sub_sistem');
    }

    /*** Edit Sub-Sistem ***/
    public function editSubSistem($id)
    {
    	   
		$subsistem =  KomponenSubSistem::where('id','=',"{$id}")->get()->first();

        if (isset($subsistem)){

        	 return view('master.sub_sistem.edit_sub_sistem',compact('subsistem'));

        }else{

            abort(404);

        }
    }

      /*** Save Sub-Sistem ***/
    public function saveSubSistem(Request $request)
    {
    	$validasi = Validator::make($request->all(), [
			'kode_komponen_sub_sistem' => 'required|max:35|unique:komponen_sub_sistem',
			'nama_komponen_sub_sistem' => 'required'
            ]);

        if ($validasi->fails())
        {
        	
            return redirect()->back()->withErrors($validasi->errors());

        }else{
				
			$input                           = new KomponenSubSistem();
			$input->kode_komponen_sub_sistem = $request->kode_komponen_sub_sistem; 
			$input->nama_komponen_sub_sistem = $request->nama_komponen_sub_sistem;   
			$input->keterangan               = $request->keterangan;   
            $input->save();
            return redirect()->back()->with('info','Data sub-sistem sistem berhasil disimpan');
        }
    }

    /*** Delete Sub-Sistem ***/
    public function deleteSubSistem(Request $request)
    {
    	KomponenSubSistem::where('id','=',"{$request->id_hapus}")->delete();
        return redirect()->back()->with('info','Data komponen sub sistem berhasil dihapus');

    }

    /*** Update Sub-Sistem ***/
    public function updateSubSistem(Request $request,$id)
    {
    	$validasi = Validator::make($request->all(), [
			'kode_komponen_sub_sistem' => 'required|max:35',
			'nama_komponen_sub_sistem' => 'required'
			]);

        if ($validasi->fails())
        {
            return redirect()->back()->withErrors($validasi->errors());
        }else{

        		KomponenSubSistem::where('id','=',"{$id}")
        				->update([
									'kode_komponen_sub_sistem' => $request->kode_komponen_sub_sistem,
									'nama_komponen_sub_sistem' => $request->nama_komponen_sub_sistem, 
									'keterangan'               => $request->keterangan
        						]);
 				
                return redirect()->back()->with('info','Data komponen sub-sistem berhasil diupdate');
        }
    }
}
