<?php

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input; 
use Illuminate\Contracts\Auth\User;
use App\Models\Master\Pelaksana;
use Validator;
use Response;
use View;
use DB;
use File;

class PelaksanaControllers extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
    }
    /*** Index Pelaksana ***/
    public function index()
    {
    	$pelaksana = Pelaksana::OrderBy('id','desc')->get();
    	return view('master.pelaksana.pelaksana',compact('pelaksana'));
    }

    /*** pencarian pelaksana ***/
    public function pencarianPelaksana(Request $request)
    {
        $pelaksana = Pelaksana::where('nama_pelaksana','like',"%{$request->pencarian}%")->OrderBy('id','desc')->get();
    	return view('master.pelaksana.data_list_pelaksana',compact('pelaksana'));
    } 

    /*** Create Pelaksana ***/
    public function createPelaksana()
    {
    	return view('master.pelaksana.add_pelaksana');

    }

    /*** Edit Pelaksana ***/
    public function editPelaksana($id)
    {
    	$pelaksana = Pelaksana::where('id','=',"{$id}")->get()->first();
    	if (isset($pelaksana)) {
    		 
    		return view('master.pelaksana.edit_pelaksana',compact('pelaksana'));

    	}else{

    		abort(404);
    	}
    }

    /*** Save Pelaksana ***/
    public function savePelaksana(Request $request)
    {
    	$validasi = Validator::make($request->all(), [
			'nama_pelaksana'    => 'required|max:90'
		 
        ]);

        if ($validasi->fails())
        {
            return redirect()->back()->withErrors($validasi->errors());
        }else{

				$input                 = new Pelaksana();
				$input->nama_pelaksana = $request->nama_pelaksana;   
				$input->keterangan     = $request->keterangan; 
				$input->save();
                return redirect()->back()->with('info','Data pelaksana berhasil disimpan');
        }
    }

    /*** Update Pelaksana ***/
    public function updatePelaksana(Request $request,$id)
    {
    	$validasi = Validator::make($request->all(), [
			'nama_pelaksana'    => 'required|max:90'
		 
        ]);

        if ($validasi->fails())
        {
            return redirect()->back()->withErrors($validasi->errors());
        }else{

        		Pelaksana::where('id','=',"$id")
        				->update([
							'nama_pelaksana' 	=> $request->nama_pelaksana,
							'keterangan'	 	=> $request->keterangan
						]);

                return redirect()->back()->with('info','Data pelaksana berhasil diupdate');
        }
    }

    /*** Delete Pelaksana ***/
    public function deletePelaksana(Request $request)
    {
    	Pelaksana::where('id','=',"{$request->id_hapus}")->delete();
        return redirect()->back()->with('info','Data pelaksana berhasil dihapus');

    }
}
