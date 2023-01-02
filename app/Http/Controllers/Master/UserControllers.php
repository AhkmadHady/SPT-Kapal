<?php

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input; 
use Illuminate\Contracts\Auth\User;
use App\Models\Master\UsersModel;
use Validator;
use Response;
use View;
use DB;
use File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;

class UserControllers extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

	/*** Index Pengguna ***/
    public function index()
    {
    	$pengguna = UsersModel::OrderBy('id','desc')->get();
    	return view('master.pengguna.pengguna',compact('pengguna'));
    }

    /*** Save Pengguna ***/
    public function savePengguna(Request $request)
    {
    	$validasi = Validator::make($request->all(), [
			'name'     => 'required',
			'email'    => 'required',
			'username' => 'required',
			'password' => 'required',
			'level'    => 'required',
			'kapal'    => 'required'
        ]);

        if ($validasi->fails())
        {
        	
            return redirect()->back()->withErrors($validasi->errors());

        }else{

			$input            = new UsersModel();
			$input->name      = $request->name; 
			$input->email     = $request->email; 
			$input->username  = $request->username; 
			$input->password  = Hash::make($request->password); 
			$input->password2 = $request->password;    
			$input->kapal     = $request->kapal;   
			$input->level     = $request->level;   
            $input->save();

            return redirect()->back()->with('info','Data pengguna berhasil disimpan');
        }
    } 

    /*** Create Pengguna ***/
    public function createPengguna()
    {
    	return view('master.pengguna.add_pengguna');
    }

    /*** Edit Pengguna ***/
    public function editPengguna($id)
    {
    	$data_user = UsersModel::where('id','=',"{$id}")->get()->first();

    	if (isset($data_user)) {

    		return view('master.pengguna.edit_pengguna',compact('data_user'));
    		 
    	}else{

    		abort(404);
    	}
    }

    /*** Update Pengguna ***/
    public function updatePengguna(Request $request,$id)
    {
    	$validasi = Validator::make($request->all(), [
			'name'     => 'required',
			'email'    => 'required',
			'username' => 'required',
			'password' => 'required',
			'level'    => 'required',
			'kapal'    => 'required'
        ]);

        if ($validasi->fails())
        {
        	
            return redirect()->back()->withErrors($validasi->errors());

        }else{

        	UsersModel::where('id','=',"{$id}")
        			  ->update([
										'name'      =>$request->name,
										'email'     =>$request->email,
										'username'  =>$request->username,
										'password2' =>$request->password,
										'level'     =>$request->level,
										'kapal'     =>$request->kapal,
										'password'  => Hash::make($request->password)
        			  		  ]);
 			 
            return redirect()->back()->with('info','Data pengguna berhasil diupdate');
        }
    }

    /*** Delete Pengguna ***/
    public function deletePengguna(Request $request)
    {
    	UsersModel::where('id','=',"{$request->id_hapus}")->delete();
    	return redirect()->back()->with('info','Data pengguna berhasil dihapus');
    }

}
