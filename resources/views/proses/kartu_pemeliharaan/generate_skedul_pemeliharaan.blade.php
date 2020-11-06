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
                <h5> Generate Skedul Pemeliharaan </h5> 
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
                                            <label class="ukuran_font">Kelompok <span class="text-danger">*</span></label>
                                            <select class="form-control ukuran_font select2" name="id_komponen_pokok" id="id_komponen_pokok" style="width: 100%;">
                                                <option value=""></option>
                                                @foreach ($kelompok as $datas)
                                                    <option value="{{$datas->id}}">{{$datas->nama_pokok}}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger">{{$errors->first('id_komponen_pokok')}}</span>
                                        </div>
                                    </div>
            
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="ukuran_font">Sub Kelompok <span class="text-danger">*</span></label>
                                            <select class="form-control ukuran_font select2" style="width: 100%;" name="id_komponen_sub_pokok" id="id_komponen_sub_pokok">
                                                <option value=""></option>
                                                @foreach ($subkelompok as $datas)
                                                    <option value="{{$datas->id}}">{{$datas->nama_sub_pokok}}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger">{{$errors->first('id_komponen_sub_pokok')}}</span>
                                        </div>
                                    </div>
            
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="ukuran_font">Sistem <span class="text-danger">*</span></label>
                                            <select class="form-control ukuran_font select2" style="width: 100%;" name="id_sistem" id="id_sistem">
                                                <option value=""></option>
                                                @foreach ($sistem as $datas)
                                                    <option value="{{$datas->id}}">{{$datas->nama_komponen_sistem}}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger">{{$errors->first('id_sistem')}}</span>
                                        </div>
                                    </div>
            
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="ukuran_font">Sub Sistem <span class="text-danger">*</span></label>
                                            <select class="form-control ukuran_font select2" style="width: 100%;" name="id_sub_sistem" id="id_sub_sistem">
                                                <option value=""></option>
                                                @foreach ($subsistem as $datas)
                                                    <option value="{{$datas->id}}">{{$datas->nama_komponen_sub_sistem}}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger">{{$errors->first('id_sub_sistem')}}</span>
                                        </div>
                                    </div>
            
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="ukuran_font">Pelaksana <span class="text-danger">*</span></label>
                                            <select class="form-control ukuran_font select2" style="width: 100%;" name="id_pelaksana" id="id_pelaksana">
                                                <option value=""></option>
                                                @foreach ($pelaksana as $datas)
                                                    <option value="{{$datas->id}}">{{$datas->nama_pelaksana}}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger">{{$errors->first('id_pelaksana')}}</span>
                                        </div>
                                    </div>
            
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="ukuran_font">Lokasi <span class="text-danger">*</span></label>
                                            <select class="form-control ukuran_font select2" style="width: 100%;" name="id_lokasi" id="id_lokasi">
                                                <option value=""></option>
                                                @foreach ($lokasi as $datas)
                                                    <option value="{{$datas->id}}">{{$datas->nama_lokasi}}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger">{{$errors->first('id_lokasi')}}</span>
                                        </div>
                                    </div>
            
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="ukuran_font">Periode <span class="text-danger">*</span></label>
                                            <select class="form-control ukuran_font select2" style="width: 100%;" name="id_periode" id="id_periode">
                                                <option value=""></option>
                                                @foreach ($periode as $datas)
                                                    <option value="{{$datas->id}}">{{$datas->periode}}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger">{{$errors->first('id_periode')}}</span>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label class="ukuran_font">Komponen <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="komponen" name="komponen">
                                            <span class="text-danger">{{$errors->first('komponen')}}</span>
                
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
                                <th style="padding-top:5px; padding-left:5px; padding-right:5px; padding-bottom:5px; font-size: 14px">Action</th> 
                                <th style="padding-top:5px; padding-left:5px; padding-right:5px; padding-bottom:5px; font-size: 14px" >Kode Pemeliharaan</th> 
                                <th style="padding-top:5px; padding-left:5px; padding-right:5px; padding-bottom:5px; font-size: 14px"> Komponen</th>   
                                <th style="padding-top:5px; padding-left:5px; padding-right:5px; padding-bottom:5px; font-size: 14px"> Periode</th>  
                                <th style="padding-top:5px; padding-left:5px; padding-right:5px; padding-bottom:5px; width:90px; font-size: 14px">Tanggal Mulai</th>  
                    
                            </tr>
                        </thead>
                        <tbody> 
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($pemeliharaan as $datas)
                                <tr>
                                    <td style="padding-top:5px; padding-left:5px; padding-right:5px; padding-bottom:5px; font-size: 14px">{{$no}}</td>
                                    <td style="padding-top:5px; padding-left:5px; padding-right:5px; padding-bottom:5px; font-size: 14px"> <button class="btn btn-sm btn-info"> <i class="fa fa-retweet"></i> Generate</button></td>
                                    <td style="padding-top:5px; padding-left:5px; padding-right:5px; padding-bottom:5px; font-size: 14px">{{$datas->kode_pemeliharaan}}</td>
                                    <td style="padding-top:5px; padding-left:5px; padding-right:5px; padding-bottom:5px; font-size: 14px">{{$datas->komponen}}</td>
                                    <td style="padding-top:5px; padding-left:5px; padding-right:5px; padding-bottom:5px; font-size: 14px">{{$datas->periode}}</td>
                                    <td style="padding-top:5px; padding-left:5px; padding-right:5px; padding-bottom:5px; font-size: 14px">{{$datas->tgl_mulai}}</td>
                                </tr>
                                @php
                                    $no ++;
                                @endphp
                            @endforeach
                        </tbody>
                    </table>
                </div> 
            </div>
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
            <form action="{{route('delete_subsistem')}}" method="POST">
                @csrf
                <div class="modal-body">
                    Apakah anda ingin menghapus data komponen sub-sistem ?
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
    $('.delete_subsistem').on('click', function(){
       $set = $(this).attr('data-set');
       if ($set == 'delete_subsistem'){

             id  = $(this).attr('data-id');
             $('#id_hapus').val(id);  
             $('#hapus_data').modal('show');
         
       }
   });

    /*** pencarian komponen ***/ 
    $("#komponen").keyup(function(){ 
        $.ajax({
            headers:{
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                
            type     : "POST",
            url      : "{{route('skedul_komponen')}}",
            cache    : false,
            datetype : "JSON", 
            data:{
                    'komponen': $('#komponen').val()
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

     /*** Get Data Sub Kelompok ***/
    $(document).ready(function(){
        $("#id_komponen_pokok").change(function(){ 
             
            $.ajax({
                headers:{
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },

                type     : "POST",
                url      : "{{route('skedul_kelompok')}}",
                cache    : false,
                datatype : "JSON",
                data:{
                        'id_komponen_pokok': $('#id_komponen_pokok').val(), 
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

        /*** pencarian sub kelompok ***/ 
        $("#id_komponen_sub_pokok").change(function(){ 
             
             $.ajax({
                 headers:{
                         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                     },
 
                 type     : "POST",
                 url      : "{{route('skedul_subkelompok')}}",
                 cache    : false,
                 datatype : "JSON",
                 data:{
                         'id_komponen_sub_pokok': $('#id_komponen_sub_pokok').val(), 
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

        /*** pencarian sistem ***/ 
        $("#id_sistem").change(function(){ 
             
             $.ajax({
                 headers:{
                         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                     },
 
                 type     : "POST",
                 url      : "{{route('skedul_sistem')}}",
                 cache    : false,
                 datatype : "JSON",
                 data:{
                         'id_sistem': $('#id_sistem').val(), 
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

         /*** pencarian subsistem ***/ 
        $("#id_sub_sistem").change(function(){ 
             
             $.ajax({
                 headers:{
                         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                     },
 
                 type     : "POST",
                 url      : "{{route('skedul_subsistem')}}",
                 cache    : false,
                 datatype : "JSON",
                 data:{
                         'id_sub_sistem': $('#id_sub_sistem').val(), 
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

          /*** pencarian pelaksana ***/ 
        $("#id_pelaksana").change(function(){ 
            $.ajax({
                headers:{
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
 
                 type     : "POST",
                 url      : "{{route('skedul_pelaksana')}}",
                 cache    : false,
                 datatype : "JSON",
                 data:{
                        'id_pelaksana': $('#id_pelaksana').val(), 
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

        /*** pencarian lokasi ***/ 
        $("#id_lokasi").change(function(){ 
            $.ajax({
                 headers:{
                         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                     },
 
                 type     : "POST",
                 url      : "{{route('skedul_lokasi')}}",
                 cache    : false,
                 datatype : "JSON",
                 data:{
                         'id_lokasi': $('#id_lokasi').val(), 
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

        /*** pencarian periode ***/ 
        $("#id_periode").change(function(){ 
             $.ajax({
                 headers:{
                         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                     },
 
                 type     : "POST",
                 url      : "{{route('pencarian_periode')}}",
                 cache    : false,
                 datatype : "JSON",
                 data:{
                        'id_periode': $('#skedul_periode').val(), 
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
    });  
</script>
@endpush
