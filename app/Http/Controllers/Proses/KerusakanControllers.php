<?php

namespace App\Http\Controllers\Proses;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input; 
use Illuminate\Contracts\Auth\User;
use Validator;
use Response;
use View;
use DB;
use File;
use PDF; 
use App\Models\Proses\Kerusakan;
use App\Models\Master\Pelaksana;

class KerusakanControllers extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // index
    public function indexKerusakan()
    {   
        $kerusakan = DB::table('kerusakan as a')
                        ->leftjoin('pelaksana as b','a.id_pelaksana','=','b.id')
                        ->select('a.tgl_kerusakan','a.komponen','a.id_pelaksana','a.detail_kerusakan','b.nama_pelaksana','a.id')
                        ->get();
        return view('proses.kerusakan.kerusakan',compact('kerusakan'));
    }

    // pencarian data komponen
    public function pencarianKomponen(Request $request)
    {   
        $kerusakan = DB::table('kerusakan as a')
                        ->leftjoin('pelaksana as b','a.id_pelaksana','=','b.id')
                        ->select('a.tgl_kerusakan','a.komponen','a.id_pelaksana','a.detail_kerusakan','b.nama_pelaksana','a.id')
                        ->where('a.komponen','LIKE',"%{$request->pencarian}%")
                        ->get();
        return view('proses.kerusakan.data_list_kerusakan',compact('kerusakan'));
    }

    // create kerusakan
    public function createKerusakan()
    {
        $pelaksana = Pelaksana::all();
        return view('proses.kerusakan.create_kerusakan',compact('pelaksana'));
    }

    // edit kerusakan
    public function editKerusakan($id)
    {
        $kerusakan = DB::table('kerusakan as a')
                        ->leftjoin('pelaksana as b','a.id_pelaksana','=','b.id')
                        ->select('a.tgl_kerusakan','a.komponen','a.id_pelaksana','a.detail_kerusakan','b.nama_pelaksana','a.id')
                        ->where('a.id','=',"{$id}")
                        ->get()->first();

        $pelaksana = Pelaksana::all();

        if (isset($kerusakan)) {
            return view('proses.kerusakan.edit_kerusakan',compact('kerusakan','pelaksana','id'));
        }else{
            abort(404);
        } 
    }

    // save kerusakan 
    public function saveKerusakan(Request $request)
    {
        $validasi = Validator::make($request->all(), [
            'tgl_kerusakan'     => 'required',
            'komponen'          => 'required',
            'id_pelaksana'      => 'required',
            'detail_kerusakan'  => 'required'
        ]);

        if ($validasi->fails())
        {
            return redirect()->back()->withErrors($validasi->errors());
            /* return Response::Json(array('errors' => $validasi->getMessageBag()->toArray()));*/

        }else{
                $input                      = new Kerusakan();
                $input->tgl_kerusakan       = $request->tgl_kerusakan;
                $input->komponen            = $request->komponen;
                $input->id_pelaksana        = $request->id_pelaksana;
                $input->detail_kerusakan    = $request->detail_kerusakan;
                $input->save();
                return redirect()->route('kerusakan')->with('info','Data kerusakan berhasil disimpan');
        }
    }

    // update kerusakan
    public function updateKerusakan(Request $request,$id)
    {
        $validasi = Validator::make($request->all(), [
            'tgl_kerusakan'     => 'required',
            'komponen'          => 'required',
            'id_pelaksana'      => 'required',
            'detail_kerusakan'  => 'required'
        ]);

        if ($validasi->fails())
        {
            return redirect()->back()->withErrors($validasi->errors());
            /* return Response::Json(array('errors' => $validasi->getMessageBag()->toArray()));*/

        }else{

            Kerusakan::where('id','=',"{$id}")->update([
                                            'tgl_kerusakan' => $request->tgl_kerusakan,
                                            'komponen' => $request->komponen,
                                            'id_pelaksana' => $request->id_pelaksana,
                                            'detail_kerusakan' => $request->detail_kerusakan
                                            ]);
                 
            return redirect()->route('kerusakan')->with('info','Data kerusakan berhasil diupdate');
        }
    }

    // delete kerusakan
    public function deleteKerusakan(Request $request)
    {
        Kerusakan::where('id','=',"{$request->id_hapus}")->delete();
        return redirect()->route('kerusakan')->with('info','Data kerusakan berhasil dihapus');

    }
}
