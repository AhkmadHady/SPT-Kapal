<?php

namespace App\Http\Controllers\Master;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input; 
use Illuminate\Contracts\Auth\User;
use App\Models\Master\KomponenMaster;
use Validator;
use Response;
use View;
use DB;
use File;

class KomponenMasterControllers extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /*** Index ***/
    public function index()
    {
    	 
    	 $komponen = KomponenMaster::OrderBy('id','asc')->get();

         return view('master.komponen.komponen',compact('komponen'));
    }

     /*** pencarian komponen ***/
     public function pencarianKomponen(Request $request)
     {
         $komponen = KomponenMaster::OrderBy('id','asc')->where('nmkomponen','like',"%{$request->pencarian}%")->get();
         return view('master.komponen.data_list_komponen',compact('komponen'));
     } 
 
    /*** Create Komponen ***/
    public function createKomponen()
    {
    	return view('master.komponen.add_komponen');
    }
 
    /*** Edit Komponen ***/
    public function editKomponen($id)
    {
    	   
		$komponen =  KomponenMaster::where('id','=',"{$id}")->get()->first();

        if (isset($komponen)){

        	 return view('master.komponen.edit_komponen',compact('komponen'));

        }else{

            abort(404);

        }
    }
 
     /*** Save Sistem ***/
     public function saveKomponen(Request $request)
     {
         $validasi = Validator::make($request->all(), [
             'kdkomponen' => 'required|max:35|unique:komponen_master',
             'nmkomponen' => 'required'
             ]);
 
         if ($validasi->fails())
         {
             
             return redirect()->back()->withErrors($validasi->errors());
 
         }else{
                 
             $input                       = new KomponenMaster();
             $input->kdkomponen = $request->kdkomponen; 
             $input->nmkomponen = $request->nmkomponen;  
             $input->keterangan = $request->keterangan;   
             $input->save();
             return redirect()->back()->with('info','Data komponen berhasil disimpan');
         }
     }
 
     /*** Delete Sistem ***/
     public function deleteKomponen(Request $request)
     {
         KomponenMaster::where('id','=',"{$request->id_hapus}")->delete();
         return redirect()->back()->with('info','Data komponen berhasil dihapus');
 
     }
 
 /*** Update Komponen ***/
 public function updateKomponen(Request $request,$id)
 {
     $validasi = Validator::make($request->all(), [
         'kdkomponen'    => 'required|max:35',
         'nmkomponen'    => 'required'
         ]);

     if ($validasi->fails())
     {
         return redirect()->back()->withErrors($validasi->errors());
     }else{

             KomponenMaster::where('id','=',"{$id}")
                     ->update([
                                 'kdkomponen' => $request->kdkomponen,
                                 'nmkomponen' => $request->nmkomponen, 
                                 'keterangan' => $request->keterangan
                             ]);
              
             return redirect()->back()->with('info','Data komponen berhasil diupdate');
     }
 }

}
