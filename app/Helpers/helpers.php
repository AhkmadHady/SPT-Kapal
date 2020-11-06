<?php 

	function statusGenerate($id_skedul)
	{
		$tahun = date('Y');
		$count = App\Models\Proses\Skedul::where('id_perencanaan','=',"{$id_skedul}")
										  ->where('tahun','=',"{$tahun}")->count();
		return $count;
	}

	function statusSkedul($id_skedul)
	{
		$tahun = date('Y');
		$count = App\Models\Proses\Skedul::where('id_perencanaan','=',"{$id_skedul}")
										  ->where('status','=',0)->count();
		return $count;
	}

	function indeksKelompok()
	{
		$indeks_komponen = DB::table('kartu_pemeliharaan as kp')
						   ->leftjoin('komponen_pokok as kompok','kp.id_komponen_pokok','=','kompok.id')
						   ->select('kompok.kode_pokok','kompok.nama_pokok','kp.id_komponen_pokok')
						   ->GroupBy('kompok.kode_pokok','kompok.nama_pokok','kp.id_komponen_pokok')
						   ->get();

		return $indeks_komponen;
	}

	function indeksSubKelompok($id_kelompok)
	{
		$indeks_subkelompok = DB::table('kartu_pemeliharaan as kp')
						   ->leftjoin('komponen_sub_pokok as subpok','kp.id_komponen_sub_pokok','=','subpok.id')
						   ->select('subpok.kode_sub_pokok','subpok.nama_sub_pokok','kp.id_komponen_sub_pokok')
						   ->where('kp.id_komponen_pokok','=',"{$id_kelompok}")
						   ->GroupBy('subpok.kode_sub_pokok','subpok.nama_sub_pokok','kp.id_komponen_sub_pokok')
						   ->get();

		return $indeks_subkelompok;
	}

	function indeksSistem($id_kelompok)
	{
		$indeks_sistem = DB::table('kartu_pemeliharaan as kp')
						   ->leftjoin('komponen_sistem as sis','kp.id_sistem','=','sis.id')
						   ->select('sis.kode_komponen_sistem','sis.nama_komponen_sistem','kp.id_sistem')
						   ->where('kp.id_komponen_sub_pokok','=',"{$id_kelompok}")
						   ->GroupBy('sis.kode_komponen_sistem','sis.nama_komponen_sistem','kp.id_sistem')
						   ->get();

		return $indeks_sistem;
	}

	function indeksSubSistem($id_sistem)
	{
		$indeks_subsistem = DB::table('kartu_pemeliharaan as kp')
						   ->leftjoin('komponen_sub_sistem as subsis','kp.id_sub_sistem','=','subsis.id')
						   ->select('subsis.kode_komponen_sub_sistem','subsis.nama_komponen_sub_sistem','kp.id_sub_sistem')
						   ->where('kp.id_sistem','=',"{$id_sistem}")
						   ->GroupBy('subsis.kode_komponen_sub_sistem','subsis.nama_komponen_sub_sistem','kp.id_sub_sistem')
						   ->get();

		return $indeks_subsistem;
	}

	function indeksKomponen($id_subsistem)
	{
		$indeks_subkelompok = DB::table('kartu_pemeliharaan as kp') 
						   ->leftjoin('lokasi as lok','kp.id_lokasi','=','lok.id')
						   ->select('kp.komponen','kp.kode_pemeliharaan','lok.nama_lokasi')
						   ->where('kp.id_sub_sistem','=',"{$id_subsistem}")
						   ->GroupBy('kp.komponen','kp.kode_pemeliharaan','lok.nama_lokasi')
						   ->get();

		return $indeks_subkelompok;
	}

	function jumlahpemeliharaan($tanggal)
	{
	   $data =	App\Models\Proses\Skedul::where('tgl_skedul','=',"{$tanggal}")->where('status','=','0')->count();
	   return $data;
	}

	function countKodePemeliharaan($kode)
	{
	   $data =	App\Models\Proses\Skedul::where('kode_pemeliharaan','=',"{$kode}")->count();
	   return $data;
	}

	function gelLevel($id)
	{
		$id_user = Auth::user()->id;
		$data = App\Models\Master\UsersModel::where('id','=',"{$id_user}")->select('level')->get()->first();
		return $data;
	}

	

 ?>