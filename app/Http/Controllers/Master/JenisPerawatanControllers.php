<?php

namespace App\Http\Controllers\Master;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Master\JenisPerawatan;
use Illuminate\Support\Facades\Input; 
use Illuminate\Contracts\Auth\User;
use App\Models\Master\KomponenLokasi;
use Validator;
use Response;
use View;
use DB;
use File;

class JenisPerawatanControllers extends Controller
{
    /*** Index jenis perawatan ***/ 
    public function index()
    {
        $perawatan = JenisPerawatan::OrderBy('id','desc')->get();
        return view('master.jenis_perawatan.jenis_perawatan',compact('perawatan'));
    }

    /*** Pencarian Jenis Perawatan ***/ 
    public function PencarianJenisPerawatan(Request $request)
    {
        $perawatan = JenisPerawatan::where('jenis_perawatan','like',"%{$request->pencarian}%")->get();
        return view('master.jenis_perawatan.data_jenis_perawatan',compact('perawatan'));
    }

    /*** Create Jenis Perawatan ***/
    public function createJenisPerawatan()
    {
        return view('master.jenis_perawatan.create_jenis_perawatan');
    }

     /*** Save Jenis Perawatan ***/
    public function saveJenisPerawatan(Request $request)
    {
        $validasi = Validator::make($request->all(), [
            'jenis_perawatan' => 'required|max:100'
        ]);
 
        if ($validasi->fails())
        {
            return redirect()->back()->withErrors($validasi->errors());
        }else{

            $input                     = new JenisPerawatan();
            $input->jenis_perawatan    = $request->jenis_perawatan;
            $input->keterangan         = $request->keterangan;
            $input->kategori           = $request->kategori;
            $input->save();
            return redirect()->back()->with('info','Data jenis perawatan berhasil disimpan');
        }
    }

    /*** Update Jenis Perawatan ***/
    public function updateJenisPerawatan(Request $request,$id)
    {
        $validasi = Validator::make($request->all(), [
            'jenis_perawatan' => 'required|max:50'
        ]);

        if ($validasi->fails())
        {
            return redirect()->back()->withErrors($validasi->errors());
        }else{

            JenisPerawatan::where('id','=',"{$id}")
                                ->update([
                                            'jenis_perawatan'   => $request->jenis_perawatan,
                                            'keterangan'        => $request->keterangan,
                                            'kategori'          => $request->kategori,
                                        ]);
                
            return redirect()->back()->with('info','Data jenis perawatan berhasil diupdate');
        }
    }
    
    /*** Edit Jenis Perawatan ***/
    public function editJenisPerawatan($id)
    {
        $perawatan = JenisPerawatan::where('id','=',"{$id}")->get()->first();
        return view('master.jenis_perawatan.edit_jenis_perawatan',compact('perawatan'));
    }

    /*** Delete Jenis Perawatan ***/
    public function deleteJenisPerawatan(Request $request)
    {
        JenisPerawatan::where('id','=',"{$request->id_hapus}")->delete();
        return redirect()->back()->with('info','Data jenis perawatan berhasil dihapus');
    }
}
