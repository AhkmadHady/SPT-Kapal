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
        <div class="card card-outline card-info">
            <div class="card-header">
                <h5> Daftar Skedul Pemeliharaan </h5> 
            </div> 

            
            <div class="card-body pad">
                <div id="accordion"> 
                    <div class="card">
                        <div class="card-header" id="headingOne">
                            <h5 class="mb-0">
                            <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne"> <i class="fa fa-search"></i>
                                Pencarian
                            </button>
                            </h5>
                        </div>
                    
                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="ukuran_font">Status Skedul <span class="text-danger">* </span></label>
                                            <select class="form-control ukuran_font select2" style="width: 100%;" name="status" id="status">
                                                <option value="0">Aktif</option>
                                                <option value="1">Tidak Aktif</option>
                                                <option value="2">Semua Status</option>
                                            </select>
                                            <span class="text-primary" style="font-size: 12px;" id="error_status">Pencarian Komponen dan Lokasi Harus Berdasarkan Status</span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="ukuran_font"> Komponen </label>
                                            <input type="text" class="form-control" id="komponen" name="komponen">
                                            <span class="text-danger">{{$errors->first('komponen')}}</span>
                                        </div>
                                    </div>
            
                                    <div class="col-md-4">
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
                                </div>
                                <div class="row"> 
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="ukuran_font"> Tanggal Skedul </label>
                                            <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                                <input type="text" class="form-control datetimepicker-input ukuran_font" data-target="#reservationdate" id="tanggal" name="tanggal" datetimepicker="Y-m-d"/>
                                                <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                </div>
                                            </div> 
                                        </div>
                                    </div>
            
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="ukuran_font"> Tahun Skedul </label>
                                            <div class="input-group" data-target-input="nearest">
                                                <input type="text" class="form-control ukuran_font" id="tahun" name="tahun" datetimepicker="Y-m-d"/>
                                                <div class="input-group-append" data-toggle="datetimepicker">
                                                    <div class="input-group-text" onclick="pencarianTahunSkedul()"> <i class="fa fa-search"></i> &nbsp; Cari </div>
                                                </div>
                                            </div> 
                                        </div>
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
                                <th style="padding-top:5px; padding-left:5px; padding-right:5px; padding-bottom:5px; font-size: 14px">Tanggal Skedul Pemeliharaan</th> 
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
          <h5 class="modal-title">Edit Tanggal Skedul</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{route('update_skedul')}}" method="POST">
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

    /*** Pencarian Tahun ***/
    function pencarianTahunSkedul(){
        $.ajax({
            headers:{
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                
            type     : "POST",
            url      : "{{route('pencarian_tahun_skedul')}}",
            cache    : false,
            datetype : "JSON", 
            data:{
                    'tahun': $('#tahun').val()
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

    /*** Pencarian Skedul BY Tanggal ***/ 
    $("#tanggal").blur(function(){ 
        $.ajax({
            headers:{
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                
            type     : "POST",
            url      : "{{route('pencarian_tanggal_skedul')}}",
            cache    : false,
            datetype : "JSON", 
            data:{
                    'tanggal': $('#tanggal').val()
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
    });  

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

</script>
@endpush
