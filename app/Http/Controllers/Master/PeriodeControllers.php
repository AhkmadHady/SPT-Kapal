<?php

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input; 
use Illuminate\Contracts\Auth\User;
use App\Models\Master\Periode;
use Validator;
use Response;
use View;
use DB;
use File;

class PeriodeControllers extends Controller
{

     public function __construct()
    {
        $this->middleware('auth');
    }
    /*** Index ***/
    public function index()
    {
    	$periode = Periode::OrderBy('id','desc')->get();
    	return view('master.periode.periode',compact('periode'));

    }

    /*** pencarian periode ***/
    public function pencarianPeriode(Request $request)
    {
        $periode = Periode::where('periode','like',"%{$request->pencarian}%")->get();
    	return view('master.periode.data_list_periode',compact('periode'));
    } 

    /*** Create Periode ***/
    public function createPeriode()
    {
    	return view('master.periode.add_periode');
    }

    /*** Edit Periode ***/
    public function editPeriode($id)
    {
    	$periode = Periode::where('id','=',"{$id}")->get()->first();
    	if (isset($periode)) {
     	
	    	return view('master.periode.edit_periode',compact('periode'));

	    }else{
	    	
	    	abort(404);

	    }
    }

    /*** Save Periode ***/
    public function savePeriode(Request $request)
    {
    	$validasi = Validator::make($request->all(), [
			'periode'    => 'required|max:30'
		 
        ]);

        if ($validasi->fails())
        {
            return redirect()->back()->withErrors($validasi->errors());
        }else{

				$input             = new Periode();
				$input->periode    = $request->periode; 
				$input->rumus      = $request->rumus; 
				$input->keterangan = $request->keterangan; 
				$input->save();
                return redirect()->back()->with('info','Data periode berhasil disimpan');
        }
    }

    /*** Update Periode ***/
    public function updatePeriode(Request $request,$id)
    {
    	$validasi = Validator::make($request->all(), [
			'periode'    => 'required|max:30' 
        ]);

        if ($validasi->fails())
        {
            return redirect()->back()->withErrors($validasi->errors());
        }else{

        		Periode::where('id','=',"{$id}")
        					->update([
										'periode'    => $request->periode,
										'rumus'      => $request->rumus,
										'keterangan' => $request->keterangan
        							]);
 
                return redirect()->back()->with('info','Data periode berhasil diupdate');
        }
    }

    /*** Delete Periode ***/
    public function deletePeriode(Request $request)
    {
    	Periode::where('id','=',"{$request->id_hapus}")->delete();
        return redirect()->back()->with('info','Data periode berhasil dihapus');

    }
}

