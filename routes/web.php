<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/get-home', 'HomeController@jadwalSkedule')->name('get_home');
Route::group(['namespace' => 'Master'], function(){

    /*** Kelompok ***/
	Route::get('kelompok','KomponenPokokControllers@index')->name('kelompok');
	Route::get('kelompok/create-kelompok','KomponenPokokControllers@createKomponenPokok')->name('create_kelompok');
	Route::post('kelompok/save-kelompok','KomponenPokokControllers@saveKomponenPokok')->name('save_kelompok');
	Route::post('kelompok/pencarian-kelompok','KomponenPokokControllers@pencarianKelompok')->name('pencarian_kelompok_master');
	Route::post('kelompok/delete-kelompok','KomponenPokokControllers@deleteKomponenKelompok')->name('delete_kelompok');
	Route::get('kelompok/{id}/edit-kelompok','KomponenPokokControllers@editKomponenPokok')->name('edit_kelompok');
    Route::post('kelompok/{id}/update-kelompok','KomponenPokokControllers@updateKompnenPokok')->name('update_kelompok');
    
    /*** Sub Kelompok ***/
	Route::get('sub-kelompok','KomponenSubPokokControllers@index')->name('subkelompok');
	Route::get('sub-kelompok/create-subkelompok','KomponenSubPokokControllers@createSubKelompok')->name('create_subkelompok');
	Route::post('sub-kelompok/save-subkelompok','KomponenSubPokokControllers@saveSubKomponenPokok')->name('save_subkelompok');
	Route::post('sub-kelompok/pencarian-subkelompok','KomponenSubPokokControllers@pencarianSubkelompok')->name('pencarian_subkelompok_master');
	Route::post('sub-kelompok/delete-subkelompok','KomponenSubPokokControllers@deleteKomponenSubKelompok')->name('delete_subkelompok');
	Route::get('sub-kelompok/{id}/edit-subkelompok','KomponenSubPokokControllers@editSubKomponenPokok')->name('edit_subkelompok');
    Route::post('sub-kelompok/{id}/update-subkelompok','KomponenSubPokokControllers@updateKompnenSubPokok')->name('update_subkelompok');
     
    /*** Sistem ***/
	Route::get('sistem','KomponenSistemControllers@index')->name('sistem');
	Route::get('sistem/create-sistem','KomponenSistemControllers@createSistem')->name('create_sistem');
	Route::post('sistem/save-sistem','KomponenSistemControllers@saveSistem')->name('save_sistem');
	Route::post('sistem/pencarian-sistem','KomponenSistemControllers@pencarianSistem')->name('pencarian_sistem_master');
	Route::post('sistem/delete-sistem','KomponenSistemControllers@deleteSistem')->name('delete_sistem');
	Route::get('sistem/{id}/edit-sistem','KomponenSistemControllers@editSistem')->name('edit_sistem');
	Route::post('sistem/{id}/update-sistem','KomponenSistemControllers@updateSistem')->name('update_sistem');
	 
	/*** Sub Sistem ***/
	Route::get('sub-sistem','KomponenSubSistemControllers@index')->name('subsistem');
	Route::get('sub-sistem/create-subsistem','KomponenSubSistemControllers@createSubSistem')->name('create_subsistem');
	Route::post('sub-sistem/save-subsistem','KomponenSubSistemControllers@saveSubSistem')->name('save_subsistem');
	Route::post('sub-sistem/pencarian-subsistem','KomponenSubSistemControllers@pencarianSubSistem')->name('pencarian_subsistem_master');
	Route::post('sub-sistem/delete-subsistem','KomponenSubSistemControllers@deleteSubSistem')->name('delete_subsistem');
	Route::get('sub-sistem/{id}/edit-subsistem','KomponenSubSistemControllers@editSubSistem')->name('edit_subsistem');
	Route::post('sub-sistem/{id}/update-subsistem','KomponenSubSistemControllers@updateSubSistem')->name('update_subsistem');

	/*** Periode ***/
	Route::get('periode','PeriodeControllers@index')->name('periode');
	Route::get('periode/create-periode','PeriodeControllers@createPeriode')->name('create_periode');
	Route::post('periode/save-periode','PeriodeControllers@savePeriode')->name('save_periode');
	Route::post('periode/pencarian-periode','PeriodeControllers@pencarianPeriode')->name('pencarian_periode_master');
	Route::post('periode/delete-periode','PeriodeControllers@deletePeriode')->name('delete_periode');
	Route::get('periode/{id}/edit-periode','PeriodeControllers@editPeriode')->name('edit_periode');
	Route::post('periode/{id}/update-periode','PeriodeControllers@updatePeriode')->name('update_periode');
	
	/*** Lokasi Komponen ***/
	Route::get('lokasi-komponen','KomponenLokasiControllers@index')->name('lokasi');
	Route::get('lokasi-komponen/create-lokasi-komponen','KomponenLokasiControllers@createLokasi')->name('create_lokasi');
	Route::post('lokasi-komponen/save-lokasi-komponen','KomponenLokasiControllers@saveLokasi')->name('save_lokasi');
	Route::post('lokasi-komponen/pencarian-lokasi-komponen','KomponenLokasiControllers@pencarianLokasi')->name('pencarian_lokasi_master');
	Route::post('lokasi-komponen/delete-lokasi-komponen','KomponenLokasiControllers@deleteLokasi')->name('delete_lokasi');
	Route::get('lokasi-komponen/{id}/edit-lokasi-komponen','KomponenLokasiControllers@editLokasi')->name('edit_lokasi');
	Route::post('lokasi-komponen/{id}/update-lokasi-komponen','KomponenLokasiControllers@updateLokasi')->name('update_lokasi');
	 
	/*** Pelaksana ***/
    Route::get('pelaksana','PelaksanaControllers@index')->name('pelaksana');
	Route::get('pelaksana/create-pelaksana','PelaksanaControllers@createpelaksana')->name('create_pelaksana');
	Route::post('pelaksana/save-pelaksana','PelaksanaControllers@savepelaksana')->name('save_pelaksana');
	Route::post('pelaksana/cari-pelaksana','PelaksanaControllers@pencarianPelaksana')->name('cari_pelaksana');
	Route::post('pelaksana/delete-pelaksana','PelaksanaControllers@deletePelaksana')->name('delete_pelaksana');
	Route::get('pelaksana/{id}/edit-pelaksana','PelaksanaControllers@editpelaksana')->name('edit_pelaksana');
	Route::post('pelaksana/{id}/update-pelaksana','PelaksanaControllers@updatePelaksana')->name('update_pelaksana');
	 
	/*** Pengguna ***/
 	Route::get('pengguna','UserControllers@index')->name('pengguna');
 	Route::get('pengguna/create-pengguna','UserControllers@createPengguna')->name('add_pengguna');
    Route::post('pengguna/save-pengguna','UserControllers@savePengguna')->name('save_pengguna'); 
 	Route::post('pengguna/delete-pengguna','UserControllers@deletePengguna')->name('delete_pengguna');
 	Route::get('pengguna/{id}/edit-pengguna','UserControllers@editPengguna')->name('edit_pengguna');
 	Route::post('pengguna/{id}/update-pengguna','UserControllers@updatePengguna')->name('update_pengguna');

	/*** Jenis Perawatan ***/
	Route::get('jenis-perawatan','JenisPerawatanControllers@index')->name('jenis_perawatan');
	Route::post('jenis-perawatan/pencarian-perawatan','JenisPerawatanControllers@PencarianJenisPerawatan')->name('pencariaan_jenis_perawatan');
	Route::get('jenis-perawatan/create-jenis-perawatan','JenisPerawatanControllers@createJenisPerawatan')->name('create_jenis_perawatan');
	Route::post('jenis-perawatan/save-jenis-perawatan','JenisPerawatanControllers@saveJenisPerawatan')->name('save_jenis_perawatan');
	Route::post('jenis-perawatan/delete-jenis-perawatan','JenisPerawatanControllers@deleteJenisPerawatan')->name('delete_jenis_perawatan');

	Route::post('jenis-perawatan/{id}/update-jenis-perawatan','JenisPerawatanControllers@updateJenisPerawatan')->name('update_jenis_perawatan');

	Route::get('jenis-perawatan/{id}/edit-jenis-perawatan','JenisPerawatanControllers@editJenisPerawatan')->name('edit_jenis_perawatan');
});

Route::group(['namespace' => 'Proses'], function(){

	/*** Kartu Pemeliharaan ***/
	Route::get('kartu-pemeliharaan','KartuPemeliharaanControllers@index')->name('kartu_pemeliharaan');
	Route::post('kartu-pemeliharaan/pencarian-kartu-pemeliharaan-kelompok','KartuPemeliharaanControllers@pencarianKelompok')->name('pencarian_kelompok');
	Route::post('kartu-pemeliharaan/pencarian-kartu-pemeliharaan-subkelompok','KartuPemeliharaanControllers@pencarianSubKelompok')->name('pencarian_subkelompok');
	Route::post('kartu-pemeliharaan/pencarian-kartu-pemeliharaan-sistem','KartuPemeliharaanControllers@pencarianSistem')->name('pencarian_sistem');
	Route::post('kartu-pemeliharaan/pencarian-kartu-pemeliharaan-subsistem','KartuPemeliharaanControllers@pencarianSubSistem')->name('pencarian_subsistem');
	Route::post('kartu-pemeliharaan/pencarian-kartu-pemeliharaan-pelaksana','KartuPemeliharaanControllers@pencarianPelaksana')->name('pencarian_pelaksana');
	Route::post('kartu-pemeliharaan/pencarian-kartu-pemeliharaan-lokasi','KartuPemeliharaanControllers@pencarianLokasi')->name('pencarian_lokasi');
	Route::post('kartu-pemeliharaan/pencarian-kartu-pemeliharaan-periode','KartuPemeliharaanControllers@pencarianPeriode')->name('pencarian_periode');
	Route::post('kartu-pemeliharaan/pencarian-kartu-pemeliharaan-komponen','KartuPemeliharaanControllers@pencarianKomponen')->name('pencarian_komponen');
	Route::get('kartu-pemeliharaan/{id}/print-kartu-pemeliharaan','KartuPemeliharaanControllers@printKartuPemeliharaan')->name('print_kartu_pemeliharaan');
	
	Route::get('create-kartu-pemeliharaan','KartuPemeliharaanControllers@createKartuPemeliharaan')->name('create_kartu_pemeliharaan');
	Route::get('create-kartu-pemeliharaan/{id}/edit-kartu-pemeliharaan','KartuPemeliharaanControllers@editKartuPemeliharaan')->name('edit_kartu_pemeliharaan');
	Route::post('create-kartu-pemeliharaan/{id}/update-kartu-pemeliharaan','KartuPemeliharaanControllers@updateKartuPemeliharaan')->name('update_kartu_pemeliharaan'); 
	Route::post('create-kartu-pemeliharaan/save-kartu-pemeliharaan','KartuPemeliharaanControllers@saveKartuPemeliharaan')->name('save_kartu_pemeliharaan'); 
	Route::post('create-kartu-pemeliharaan/delete-kartu-pemeliharaan','KartuPemeliharaanControllers@deletePemeliharaan')->name('delete_kartu_pemeliharaan'); 
	Route::post('kartu-pemeliharaan/generate_manual','KartuPemeliharaanControllers@generateSkedulManual')->name('generate_manual');

	/*** Indeks Komponen ***/ 
	Route::get('kartu-pemeliharaan/indeks-komponen','KartuPemeliharaanControllers@indeksKomponen')->name('indeks_komponen');
	/*** Skedul ***/
	Route::get('skedul','SkedulControllers@index')->name('skedul');
	Route::post('skedul/pencarian-tanggal-skedul','SkedulControllers@pencarianTanggalSkedul')->name('pencarian_tanggal_skedul');
	 
	Route::post('skedul/pencarian-komponen-skedul','SkedulControllers@pencarianKomponenSkedul')->name('pencarian_kom_skedul');
	Route::post('skedul/pencarian-lokasi-skedul','SkedulControllers@pencarianLokasiSkedul')->name('pencarian_lok_skedul');
	Route::post('skedul/get-data-rumus-periode','SkedulControllers@getRumusPeriode')->name('get_rumus_periode');
	 
	Route::post('skedul/delete-skedul','SkedulControllers@deleteSkedul')->name('delete_skedul');
	Route::post('skedul/update-skedul','SkedulControllers@updatetanggalSkedul')->name('update_skedul'); 
	Route::post('skedul/save-jadwal-pemeliharaan','SkedulControllers@saveJadwalPemeliharaan')->name('save_jadwal_pemeliharaan'); 
	Route::get('kalender-pemeliharaan','SkedulControllers@jadwalSkedul')->name('kalender_skedul');
	Route::post('kalender-pemeliharaan/get-jadwal-skedul','SkedulControllers@getJadwalSkedul')->name('get_jadwal_skedul');
	Route::get('kalender-pemeliharaan/{tanggal}/get-komponen-skedul','SkedulControllers@getKomponenSkedulPemeliharaan')->name('get_komponen_skedul');
	Route::post('kalender-pemeliharaan/{tanggal}/get-form-pelaksanaan-pemeliharaan','SkedulControllers@getFormPelaksanaanPemeliharaan')->name('get_form_pelaksanaan'); 
	Route::post('kalender-pemeliharaan/{tanggal}/save-pelaksanaan-pemeliharaan','SkedulControllers@savePemeliharaanKomponen')->name('save_pemeliharaan_komponen');
	
	/*** Pelaksanaan Pemeliharaan ***/
	Route::get('pelaksanaan','PelaksanaanControllers@index')->name('pelaksanaan');
	Route::post('pelaksanaan/pencarian-pelaksanaan-kelompok','PelaksanaanControllers@pencarianPelaksanaanKelompok')->name('pencarian_pelaksanaan_kelompok');
	Route::post('pelaksanaan/pencarian-pelaksanaan-subkelompok','PelaksanaanControllers@pencarianPelaksanaanSubKelompok')->name('pencarian_pelaksanaan_subkelompok');
	Route::post('pelaksanaan/pencarian-pelaksanaan-sistem','PelaksanaanControllers@pencarianPelaksanaanSistem')->name('pencarian_pelaksanaan_sistem');
	Route::post('pelaksanaan/pencarian-pelaksanaan-subsistem','PelaksanaanControllers@pencarianPelaksanaanSubSistem')->name('pencarian_pelaksanaan_subsistem');
	Route::post('pelaksanaan/pencarian-pelaksanaan-pelaksana','PelaksanaanControllers@pencarianPelaksanaanPelaksana')->name('pencarian_pelaksanaan_pelaksana');
	Route::post('pelaksanaan/pencarian-pelaksanaan-lokasi','PelaksanaanControllers@pencarianPelaksanaanLokasi')->name('pencarian_pelaksanaan_lokasi');
	Route::post('pelaksanaan/pencarian-pelaksanaan-periode','PelaksanaanControllers@pencarianPelaksanaanPeriode')->name('pencarian_pelaksanaan_periode');
	Route::post('pelaksanaan/pencarian-pelaksanaan-komponen','PelaksanaanControllers@pencarianPelaksanaanKomponen')->name('pencarian_pelaksanaan_komponen');
	Route::post('pelaksanaan/pencarian-pelaksanaan-tglpelaksanaan','PelaksanaanControllers@pencarianPelaksanaanWaktuPelaksanaan')->name('pencarian_pelaksanaan_tglpelaksanaan');
	Route::post('pelaksanaan/delete-pelaksanaan','PelaksanaanControllers@deletePelaksanaan')->name('delete_pelaksanaan');
	Route::post('pelaksanaan/update-pelaksanaan','PelaksanaanControllers@updatePelaksanaanPemeliharaan')->name('update_pelaksanaan');

	/*** Laporan Pemeliharaan ***/ 
	Route::get('laporan-pemeliharaan','PelaksanaanControllers@laporanPelaksanaan')->name('laporan_pelaksanaan');
	Route::get('laporan-pemeliharaan/{tgl1}/{tgl2}/{kategori}/export-excel','PelaksanaanControllers@exportExcel');
	Route::get('laporan-pemeliharaan/{tgl1}/{tgl2}/{kategori}/export-pdf','PelaksanaanControllers@exportPdf');
	Route::post('laporan-pemeliharaan/pencarian-pemeliharaan','PelaksanaanControllers@pencarianLaporanPemeliharaan')->name('cari_laporan_pelaksanaan');

	/*** Kerusakan ***/
	Route::get('kerusakan','KerusakanControllers@indexKerusakan')->name('kerusakan');
	Route::get('kerusakan/add-kerusakan','KerusakanControllers@createKerusakan')->name('add_kerusakan');
	Route::post('kerusakan/save-kerusakan','KerusakanControllers@saveKerusakan')->name('save_kerusakan');
	Route::post('kerusakan/delete-kerusakan','KerusakanControllers@deleteKerusakan')->name('delete_kerusakan');
	Route::post('kerusakan/pencarian-kerusakan','KerusakanControllers@pencarianKomponen')->name('pencarian_kerusakan');
	Route::get('kerusakan/{id}/edit-kerusakan','KerusakanControllers@editKerusakan')->name('edit_kerusakan');
	Route::post('kerusakan/{id}/update-kerusakan','KerusakanControllers@updateKerusakan')->name('update_kerusakan');

	/*** Pemeliharaan Jam Putar ***/
	Route::get('pemeliharaan-jam-putar','PemeliharaanJamPutarControllers@pemaliharaanJamPutar')->name('jam_putar');
	Route::get('pemeliharaan-jam-putar/create-pemeliharaan-jam-putar','PemeliharaanJamPutarControllers@createPemeliharaanJamPutar')->name('create_jam_putar');
	Route::get('pemeliharaan-jam-putar/{id}/edit-pemeliharaan-jam-putar','PemeliharaanJamPutarControllers@editKerusakan')->name('edit_jam_putar');
	Route::post('pemeliharaan-jam-putar/{id}/update-pemeliharaan-jam-putar','PemeliharaanJamPutarControllers@updatePemeliharaanJamPutar')->name('update_jam_putar');
	Route::post('pemeliharaan-jam-putar/pencarian-komponen-pemeliharaan-jam-putar','PemeliharaanJamPutarControllers@pencarianKomponenPemeliharaanJamputar')->name('pencarian_komponen_pemeliharaan_putaran');
	Route::post('pemeliharaan-jam-putar/pencarian-periode-pemeliharaan-jam-putar','PemeliharaanJamPutarControllers@pencarianKomponenPemeliharaanJamputar')->name('pencarian_periode_pemeliharaan_putaran');
	Route::post('pemeliharaan-jam-putar/save-pemeliharaan-jam-putar','PemeliharaanJamPutarControllers@savePemeliharaanJamPutar')->name('save_pemeliharaan_jam_putar');
	Route::post('pemeliharaan-jam-putar/delete-pemeliharaan-jam-putar','PemeliharaanJamPutarControllers@deletePemeliharaanJamPutar')->name('delete_pemeliharaan_jam_putar');

	Route::post('pemeliharaan-jam-putar/get-hari-periode','PemeliharaanJamPutarControllers@cekPeriodeKomponen')->name('get_jumlah_hari_periode');
	Route::post('pemeliharaan-jam-putar/{id}/get-hari-periode','PemeliharaanJamPutarControllers@cekPeriodeKomponen')->name('get_jumlah_hari_periode_edit');
});	