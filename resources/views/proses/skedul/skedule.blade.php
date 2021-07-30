@extends('layouts.apps') 
@section('content')
@if (session('info'))
<div class="alert alert-success alert-dismissible mb-2 mt-3" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    <div class="d-flex align-items-center">
        <i class="bx bx-like"></i>
        <span>
          {{ session('info') }}
        </span>
    </div>
</div>
@endif
<div class="row"> 
    <div class="col-md-12 mt-4">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
              <a class="nav-link" id="home-tab"  href="{{route('kalender_skedul')}}" role="tab" aria-controls="home" aria-selected="true">Kalender Pemeliharaan</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" id="profile-tab"  href="{{route('skedul')}}" role="tab" aria-controls="profile" aria-selected="false">Daftar Jadwal Pemeliharaan</a>
              </li> 
            <li class="nav-item">
              <a class="nav-link " id="profile-tab"  href="{{route('pelaksanaan')}}" role="tab" aria-controls="profile" aria-selected="false">Daftar Pelaksanaan Pemeliharaan</a>
            </li> 
        </ul>
        <div class="card card-outline card-info mt-3">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <h5> Daftar Jadwal Pemeliharaan </h5> 
                    </div>
                    <div class="col-md-6">
                        <a class="btn btn-info btn-sm float-right" style="width: 230px;" href="#" data-toggle="modal" data-target="#modal_tambah_jadwal"><i class="fa fa-plus"></i> Tambah Jadwal</a>
                    </div>
                </div>
            </div>  
            <div class="card-body pad">
               
                <div id="accordion" class="mt-3"> 
                    <div class="card">
                        <div class="card-header" id="headingOne">
                            <div class="row">
                                <div class="col-md-6">
                                    <h5 class="mb-0"> 
                                        Pencarian 
                                    </h5>
                                </div> 
                            </div> 
                        </div>
                    
                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label class="ukuran_font">Status Jadwal <span class="text-danger">* </span></label>
                                            <select class="form-control ukuran_font select2" style="width: 100%;" name="status" id="status">
                                                <option value="0">Aktif</option>
                                                <option value="1">Tidak Aktif</option>
                                                <option value="2">Semua Status</option>
                                            </select>
                                            <span class="text-primary" style="font-size: 12px;" id="error_status">Pencarian Komponen dan Lokasi Harus Berdasarkan Status</span>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label class="ukuran_font"> Komponen </label>
                                            <input type="text" class="form-control" id="komponen" name="komponen">
                                            <span class="text-danger">{{$errors->first('komponen')}}</span>
                                        </div>
                                    </div>
            
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label class="ukuran_font">Lokasi </label>
                                            <select class="form-control ukuran_font select2" style="width: 100%;" name="id_lokasi" id="id_lokasi">
                                                <option value=""></option>
                                                @foreach ($lokasi as $datas)
                                                    <option value="{{$datas->id}}">{{$datas->nama_lokasi}}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger">{{$errors->first('id_lokasi')}}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label class="ukuran_font"> Tanggal Jadwal </label>
                                            <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                                <input type="text" class="form-control datetimepicker-input ukuran_font" data-target="#reservationdate" id="tanggal1" name="tanggal1" datetimepicker="Y-m-d"/>
                                                <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                </div>
                                            </div> 
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label class="ukuran_font"> s/d Tanggal Jadwal </label>
                                            <div class="input-group date" id="tanggal2" data-target-input="nearest">
                                                <input type="text" class="form-control datetimepicker-input ukuran_font" data-target="#tanggal2" id="tgl2" name="tgl2" datetimepicker="Y-m-d"/>
                                                <div class="input-group-append" data-target="#tanggal2" data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                </div>
                                            </div> 
                                        </div>
                                    </div> 
                                    <div class="col-md-2" style="margin-top: 34px">
                                        <button type="button" style="width:100px" onclick="pencarianTanggalSkedul()" class="btn btn-block bg-gradient-primary btn-sm"><i class="fa fa-search"></i>  Cari </button> 
                                    </div> 
                                </div> 
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12" id="loading_header" style="display: none;" align="center">
                    <img src="{{asset('assets/loading.gif')}}" alt=""><br><span>Loading...</span>
                </div>
                <div class="table-responsive" id="tabel_kelompok">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr> 
                                <th style="padding-top:5px; padding-left:5px; padding-right:5px; padding-bottom:5px; font-size: 14px">No</th>  
                                <th style="padding-top:5px; padding-left:5px; padding-right:5px; padding-bottom:5px; font-size: 14px">Tanggal Jadwal Pemeliharaan</th> 
                                <th style="padding-top:5px; padding-left:5px; padding-right:5px; padding-bottom:5px; font-size: 14px" >Kode Pemeliharaan</th> 
                                <th style="padding-top:5px; padding-left:5px; padding-right:5px; padding-bottom:5px; font-size: 14px">Komponen</th>  
                                <th style="padding-top:5px; padding-left:5px; padding-right:5px; padding-bottom:5px; font-size: 14px">Lokasi</th>  
                                <th style="padding-top:5px; padding-left:5px; padding-right:5px; padding-bottom:5px; font-size: 14px">Status</th>  
                                <th style="padding-top:5px; padding-left:5px; padding-right:5px; padding-bottom:5px; width:90px; font-size: 14px">Aksi</th>   
                            </tr>
                        </thead>
                        <tbody>
                    
                            @php
                                $no = 1;
                            @endphp
                    
                            @if ($skedul->count())
                                @foreach ($skedul as $datas)
                                    <tr>
                                        <td style="padding-top:5px; padding-left:5px; padding-right:5px; padding-bottom:5px; font-size: 14px">{{$no}} </td>  
                                        <td style="padding-top:5px; padding-left:5px; padding-right:5px; padding-bottom:5px; font-size: 14px">{{$datas->tgl_skedul}}</td>  
                                        <td style="padding-top:5px; padding-left:5px; padding-right:5px; padding-bottom:5px; font-size: 14px">{{$datas->kode_pemeliharaan}}</td>  
                                        <td style="padding-top:5px; padding-left:5px; padding-right:5px; padding-bottom:5px; font-size: 14px">{{$datas->komponen}}</td> 
                                        <td style="padding-top:5px; padding-left:5px; padding-right:5px; padding-bottom:5px; font-size: 14px">{{$datas->nama_lokasi}}</td>  
                                        <td style="padding-top:5px; padding-left:5px; padding-right:5px; padding-bottom:5px; font-size: 14px">
                                            @if ($datas->status ==0)
                                                <span class="text-success"> <strong> Aktif </strong></span>
                                            
                                            @else 
                                                <span class="text-danger"> <strong> Tidak Aktif </strong></span>
                                            @endif
                                        </td>  
                                        <td style="padding-top:5px; padding-left:5px; padding-right:5px; padding-bottom:5px; font-size: 14px">
                                        <a class="btn btn-block bg-gradient-secondary btn-sm edit_skedul" href="#" data-set="edit_skedul" data-id="{{$datas->id}}" data-tgl="{{$datas->tgl_skedul}}"><i class="fa fa-edit"></i> edit</a>
                    
                                            <a class="btn btn-block bg-gradient-danger btn-sm delete_skedul" href="#" data-set="delete_skedul" data-id="{{$datas->id}}"><i class="fa fa-cut"></i> delete</a>
                                        </td>  
                                    </tr>
                                    @php
                                        $no ++;
                                    @endphp
                                @endforeach
                            @else 
                                    <tr>
                                        <td colspan="7" align="center"><span class="text-danger">Data skedul pemeliharaan dengan tanggal sekarang tidak di temukan</span></td>
                                    </tr>
                            @endif 
                        </tbody>
                    </table>

                    @if ($paginate == 1)
                            {{$skedul->links()}}
                    @endif 
                </div> 
            </div>
        </div>
    </div> 
</div> 
 

{{-- Modeal Edit Skedul --}}  
<div class="modal fade" id="modal_edit">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Edit Tanggal Jadwal</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{route('update_skedul')}}" method="POST">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label class="ukuran_font" for="">Tangal Jadwal Pemeliharaan</label>
                    <input type="text" class="form-control ukuran_font" id="tgl_skedul_lama" name="tgl_skedul_lama" disabled>
                    <input type="hidden" class="form-control ukuran_font" id="id_skedul" name="id_skedul">
                </div>
                <div class="form-group">
                    <label class="ukuran_font"> Tanggal Jadwal Pemeliharaan Baru</label>
                    <div class="input-group date" id="tgl_skedul" data-target-input="nearest">
                        <input type="text" class="form-control datetimepicker-input ukuran_font" data-target="#tgl_skedul" id="tgl_skedul_baru" name="tgl_skedul_baru" datetimepicker="Y-m-d"/>
                        
                        <div class="input-group-append" data-target="#tgl_skedul" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div> 
                </div>
             </div>
            <div class="modal-footer">

                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">
                    <i class="bx bx-x d-block d-sm-none"></i>
                    <span class="d-sm-block d-none"><i class="fa fa-times-circle"></i> Kembali</span>
                </button>
                <button type="submit" class="btn btn-primary ml-1 btn-sm">
                    <i class="bx bx-check d-block d-sm-none"></i>
                    <span class="d-sm-block d-none"><i class="fa fa-save"></i> Simpan</span>
                </button>

            </div>
            </form>
      </div> 
    </div> 
</div>

{{-- modal tambah jadwal --}}
<div class="modal fade" id="modal_tambah_jadwal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Form Jadwal Pemeliharaan</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{route('save_jadwal_pemeliharaan')}}" method="POST">
            @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label class="ukuran_font" for="">Kode Pemeliharaan - Komponen</label>
                        <select name="kode_pemeliharaan" id="kode_pemeliharaan" class="form-control select2">
                            @foreach ($komponen as $item)
                                <option value="{{$item->id}}">{{$item->kode_pemeliharaan}} - {{$item->komponen}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-grop" id="form_putaran" style="display:none">
                        <label class="ukuran_font"> Jumlah Putaran </label>
                        <input type="text" class="form-control" id="jam_putaran" name="jam_putaran" value="0">
                    </div> 
                    <div class="form-group">
                        <label class="ukuran_font"> Tanggal Jadwal Pemeliharaan </label>
                        <div class="input-group date" id="tgl_jadwal_baru" data-target-input="nearest">
                            <input type="text" class="form-control datetimepicker-input ukuran_font" data-target="#tgl_jadwal_baru" id="tgl_jadwal_baru_frm" name="tgl_jadwal_baru_frm" datetimepicker="Y-m-d" value="{{date('Y-m-d')}}"/>
                            <div class="input-group-append" data-target="#tgl_jadwal_baru" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div> 
                    </div>
                </div>
                <div class="modal-footer"> 
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-sm-block d-none"><i class="fa fa-times-circle"></i> Kembali</span>
                    </button>
                    <button type="submit" class="btn btn-primary ml-1 btn-sm">
                        <i class="bx bx-check d-block d-sm-none"></i>
                        <span class="d-sm-block d-none"><i class="fa fa-save"></i> Simpan</span>
                    </button> 
                </div>
            </form>
      </div> 
    </div> 
</div>

<div class="modal fade text-left" id="" tabindex="-1" role="dialog" aria-labelledby="myModalLabel19" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-sm" role="document">
        <div class="modal-content modal-sm">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel19">Edit Tanggal Skedul</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="bx bx-x"></i>
                </button>
            </div>
            <form action="{{route('delete_skedul')}}" method="POST">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label class="ukuran_font" for="">Tangal Skedul</label>
                    <input type="text" class="form-control ukuran_font" id="tgl_skedul_lama" name="tgl_skedul_lama" disabled>
                    <input type="hidden" class="form-control ukuran_font" id="id_skedul" name="id_skedul">
                </div>
                <div class="form-group">
                    <label class="ukuran_font"> Tanggal Skedul Baru</label>
                    <div class="input-group date" id="tgl_skedul" data-target-input="nearest">
                        <input type="text" class="form-control datetimepicker-input ukuran_font" data-target="#tgl_skedul" id="tgl_skedul_baru" name="tgl_skedul_baru" datetimepicker="Y-m-d"/>
                        <div class="input-group-append" data-target="#tgl_skedul" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div> 
                </div>
            </div>
            <div class="modal-footer"> 
                <button type="button" class="btn btn-light-secondary btn-sm" data-dismiss="modal">
                    <i class="bx bx-x d-block d-sm-none"></i>
                    <span class="d-sm-block d-none"><i class="bx bxs-x-circle"></i> Kembali</span>
                </button>
                <button type="submit" class="btn btn-primary ml-1 btn-sm">
                    <i class="bx bx-check d-block d-sm-none"></i>
                    <span class="d-sm-block d-none"><i class="bx bx-trash"></i> Hapus </span>
                </button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Konfirmasi Hapus -->
<div class="modal fade text-left" id="hapus_data" tabindex="-1" role="dialog" aria-labelledby="myModalLabel19" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel19">Konfirmasi</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="bx bx-x"></i>
                </button>
            </div>
            <form action="{{route('delete_skedul')}}" method="POST">
            @csrf
            <div class="modal-body">
                Apakah anda ingin menghapus data skedul ?
                <input type="hidden" id="id_hapus" name="id_hapus">
             </div>
            <div class="modal-footer">

                <button type="button" class="btn btn-light-secondary btn-sm" data-dismiss="modal">
                    <i class="bx bx-x d-block d-sm-none"></i>
                    <span class="d-sm-block d-none"><i class="bx bxs-x-circle"></i> Kembali</span>
                </button>
                <button type="submit" class="btn btn-primary ml-1 btn-sm">
                    <i class="bx bx-check d-block d-sm-none"></i>
                    <span class="d-sm-block d-none"><i class="bx bx-trash"></i> Hapus </span>
                </button>

            </div>
            </form>
        </div>
    </div>
</div>
@endsection
@push('script')
<script type="text/javascript">
    $('.delete_skedul').on('click', function(){
       $set = $(this).attr('data-set');
       if ($set == 'delete_skedul'){

             id  = $(this).attr('data-id');
             $('#id_hapus').val(id);  
             $('#hapus_data').modal('show');
         
       }
    });

    $('.edit_skedul').on('click', function(){
       $set = $(this).attr('data-set');
       if ($set == 'edit_skedul'){

             id  = $(this).attr('data-id');
             tgl  = $(this).attr('data-tgl');

             $('#id_skedul').val(id);  
             $('#tgl_skedul_lama').val(tgl);
             $('#modal_edit').modal('show');

       }
    });

   
    /*** Pencarian Tanggal ***/
    function pencarianTanggalSkedul(){
        $.ajax({
            headers:{
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                
            type     : "POST",
            url      : "{{route('pencarian_tanggal_skedul')}}",
            cache    : false,
            datetype : "JSON", 
            data:{
                    'tanggal1': $('#tanggal1').val(),
                    'tanggal2': $('#tgl2').val()
                }, 
                beforeSend: function(){
                    $("#loading_header").css('display','block'); 
                    $('#tabel_kelompok').html(''); 
                },
                success: function(data){ 
                    $("#loading_header").css('display','none'); 
                    $('#tabel_kelompok').html(''); 
                    $('#tabel_kelompok').html(data);
                }
        });
    } 

    /*** Pencarian Skedul BY Komponen ***/
    $("#komponen").keyup(function(){ 
        $.ajax({
            headers:{
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                
            type     : "POST",
            url      : "{{route('pencarian_kom_skedul')}}",
            cache    : false,
            datetype : "JSON", 
            data:{
                    'status':   $('#status').val(),
                    'komponen': $('#komponen').val()
                }, 
                beforeSend: function(){
                    $("#loading_header").css('display','block'); 
                    $('#tabel_kelompok').html(''); 
                },
                success: function(data){ 
                    if (data.errors) {
                        if (data.errors.status) {
                            $('#error_status').html(data.errors.status);

                            $("#loading_header").css('display','none');  
                            $('#tabel_kelompok').html(data);
                        } 

                    }else {
                        $("#loading_header").css('display','none'); 
                        $('#tabel_kelompok').html(''); 
                        $('#tabel_kelompok').html(data);
                    }
                }
        });
    });  

    /*** Pencarian Skedul BY Lokasi ***/
    $("#id_lokasi").change(function(){ 
        $.ajax({
            headers:{
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                
            type     : "POST",
            url      : "{{route('pencarian_lok_skedul')}}",
            cache    : false,
            datetype : "JSON", 
            data:{
                    'status': $('#status').val(),
                    'lokasi': $('#id_lokasi').val()
                }, 
                beforeSend: function(){
                    $("#loading_header").css('display','block'); 
                    $('#tabel_kelompok').html(''); 
                },
                success: function(data){ 
                    if (data.errors) {
                        if (data.errors.status) {
                            $('#error_status').html(data.errors.status);

                            $("#loading_header").css('display','none');  
                            $('#tabel_kelompok').html(data);
                        } 

                    }else {
                        $("#loading_header").css('display','none'); 
                        $('#tabel_kelompok').html(''); 
                        $('#tabel_kelompok').html(data);
                    }
                }
        });
    });  

    $("#kode_pemeliharaan").change(function(){ 
        $.ajax({
            headers:{
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                
            type     : "POST",
            url      : "{{route('get_rumus_periode')}}",
            cache    : false,
            datetype : "JSON", 
            data:{ 
                    'id': $('#kode_pemeliharaan').val()
                }, 
                 
                success: function(data){ 
                    if (data.message > 0 ) {
                        $("#form_putaran").css('display','none'); 
                    }else{
                        $("#form_putaran").css('display','block'); 
                    }
                }
        });
    });  

   

</script>
@endpush
