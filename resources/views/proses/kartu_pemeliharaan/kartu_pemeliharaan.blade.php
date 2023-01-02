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

@if (session('gagal'))
<div class="alert alert-danger alert-dismissible mb-2 mt-3" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    <div class="d-flex align-items-center">
        <i class="bx bx-like"></i>
        <span>
          {{ session('gagal') }}
        </span>
    </div>
</div>
@endif
<style>
    tr.hide-table-padding td {
  padding: 0;
}

.expand-button {
	position: relative;
}

.accordion-toggle .expand-button:after
{
  position: absolute;
  left:.75rem;
  top: 50%;
  transform: translate(0, -50%);
  content: '-';
}
.accordion-toggle.collapsed .expand-button:after
{
  content: '+';
}
</style>
<div class="row"> 
    <div class="col-md-12 mt-4">
        <div class="card card-outline card-info">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-5">
                        <h5 class="float-lef"> Kartu Pemeliharaan </h5>  
                        
                    </div>
                    <div class="col-md-7">  
                        @php
                            $id = Auth::user()->id;
                            $level_user = gelLevel($id);
                        @endphp
                        @if ($level_user->level == "Admin" )
                            <a class="btn btn-info btn-sm float-right" style="width: 230px;" href="{{route('create_kartu_pemeliharaan')}}"><i class="fa fa-plus"></i> Tambah Kartu Pemeliharaan</a>
                        @endif
                    </div>
                </div> 
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
                                            <input type="text" class="form-control ukuran_font" id="id_periode" name="id_periode">
                                            {{-- <select class="form-control ukuran_font select2" style="width: 100%;" name="id_periode" id="id_periode">
                                                <option value=""></option>
                                                @foreach ($periode as $datas)
                                                    <option value="{{$datas->periode}}">{{$datas->periode}}</option>
                                                @endforeach
                                            </select> --}}
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
                <div class="table-responsive mt-3" id="tabel_pemeliharaan">
                    <table class="table w-auto table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                                <th class="ukuran_font" style="text-align: center;padding-top: 5px; padding-bottom: 5px; padding-left: 5px;">No</th> 
                                <th class="ukuran_font" style="text-align: center;padding-top: 5px; padding-bottom: 5px; padding-left: 5px;">Cetak</th> 
                                <th class="ukuran_font" style="text-align: center;padding-top: 5px; padding-bottom: 5px; padding-left: 5px;" >Kode Kartu</th>
                                <th class="ukuran_font" style="text-align: center;padding-top: 5px; padding-bottom: 5px; padding-left: 5px;"> Komponen</th> 
                                <th class="ukuran_font" style="text-align: center;padding-top: 5px; padding-bottom: 5px; padding-left: 5px;"> Kelompok</th> 
                                <th class="ukuran_font" style="text-align: center;padding-top: 5px; padding-bottom: 5px; padding-left: 5px;"> Sub-Kelompok</th> 
                                <th class="ukuran_font" style="text-align: center;padding-top: 5px; padding-bottom: 5px; padding-left: 5px;"> Sistem</th> 
                                <th class="ukuran_font" style="text-align: center;padding-top: 5px; padding-bottom: 5px; padding-left: 5px;"> Sub-Sistem</th>
                                <th class="ukuran_font" style="text-align: center;padding-top: 5px; padding-bottom: 5px; padding-left: 5px;">Pelaksana</th> 
                                <th class="ukuran_font" style="text-align: center;padding-top: 5px; padding-bottom: 5px; padding-left: 5px;">JO</th>
                                <th class="ukuran_font" style="text-align: center;padding-top: 5px; padding-bottom: 5px; padding-left: 5px;">Periode</th> 
                                <th class="ukuran_font" style="text-align: center;padding-top: 5px; padding-bottom: 5px; padding-left: 5px;">Lokasi</th>
                                <th class="ukuran_font" style="text-align: center;padding-top: 5px; padding-bottom: 5px; padding-left: 5px;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $no = 1; @endphp
                            @if($pemeliharaan->count())
                            @foreach($pemeliharaan as $datas)
                                @php
                                    $count_data = countKodePemeliharaan($datas->kode_pemeliharaan);
                                @endphp
                                <tr>
                                    <td class="ukuran_font" style="text-align: center;padding-top: 5px; padding-bottom: 5px; padding-left: 5px;">{{$no}}</td> 
                                    <td class="ukuran_font" style="text-align: center;padding-top: 5px; padding-bottom: 5px; padding-left: 5px;">
                                        <a class="dropdown-item ukuran_font" target="_blank" href="{{route('print_kartu_pemeliharaan',$datas->id)}}"><i class="fa fa-print mr-1"></i> Cetak</a>
                                    </td>   

                                    <td class="ukuran_font accordion-toggle collapsed" id="accordion1" data-toggle="collapse" data-parent="#accordion1" href="#collapse{{$datas->id}}" width="250px;" style="text-align: center;padding-top: 5px; padding-bottom: 5px; padding-left: 5px; color: blue" > {{$datas->kode_pemeliharaan}} </td> 

                                    <td class="ukuran_font" style="text-align: center;padding-top: 5px; padding-bottom: 5px; padding-left: 5px;"> 
                                        @if ($count_data <1)
                                            <span class="text-success">{{$datas->komponen}}</span>
                                        @else 
                                            <span>{{$datas->komponen}}</span>
                                        @endif 
                                    </td> 

                                    <td class="ukuran_font" style="text-align: center;padding-top: 5px; padding-bottom: 5px; padding-left: 5px;">{{$datas->nama_pokok}}</td> 

                                    <td class="ukuran_font" style="text-align: center;padding-top: 5px; padding-bottom: 5px; padding-left: 5px;">{{$datas->nama_sub_pokok}}</td>  

                                    <td class="ukuran_font" style="text-align: center;padding-top: 5px; padding-bottom: 5px; padding-left: 5px;">{{$datas->nama_komponen_sistem}}</td> 

                                    <td class="ukuran_font" style="text-align: center;padding-top: 5px; padding-bottom: 5px; padding-left: 5px;">{{$datas->nama_komponen_sub_sistem}}</td> 

                                    <td class="ukuran_font" style="text-align: center;padding-top: 5px; padding-bottom: 5px; padding-left: 5px;">{{$datas->nama_pelaksana}}</td>  

                                    <td class="ukuran_font" style="text-align: center;padding-top: 5px; padding-bottom: 5px; padding-left: 5px;">{{$datas->jo}}</td> 

                                    <td class="ukuran_font" style="text-align: center;padding-top: 5px; padding-bottom: 5px; padding-left: 5px;">{{$datas->periode}}</td>  

                                    <td class="ukuran_font" style="text-align: center;padding-top: 5px; padding-bottom: 5px; padding-left: 5px;">{{$datas->nama_lokasi}}</td>

                                    <td> 
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-secondary btn-sm">Pilih</button> 
                    
                                            <div class="btn-group">
                                              <button type="button" class="btn btn-secondary btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                              </button>
                                              <div class="dropdown-menu">
                                                <a class="dropdown-item ukuran_font" href="{{route('edit_kartu_pemeliharaan',$datas->id)}}"><i class="fa fa-edit mr-1"></i> Edit</a>

                                                <a class="dropdown-item delete_pemeliharaan ukuran_font" data-set="delete_pemeliharaan" data-id="{{$datas->id}}" href="#"> <i class="fa fa-cut mr-1"></i> Delete</a>

                                                <a class="dropdown-item ukuran_font" target="_blank" href="{{route('print_kartu_pemeliharaan',$datas->id)}}"><i class="fa fa-print mr-1"></i> Cetak</a> 
                                                @if ($count_data < 1)
                                                    <a class="dropdown-item ukuran_font generate_skedul" href="#" data-set="generate_skedul" data-kode="{{$datas->kode_pemeliharaan}}" data-tgl="{{$datas->tgl_mulai}}"><i class="fa fa-retweet mr-1"></i> Generate</a>
                                                @endif
                                             
                                              </div>
                                            </div>
                                          </div> 
                                    </td> 
                                </tr>
                                <tr class="hide-table-padding">
                                    <td></td>
                                    <td colspan="12">
                                        <div id="collapse{{$datas->id}}" class="collapse in p-3">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="ukuran_font">Uraian Pemeliharaan :</label>
                                                        @php
                                                            echo $datas->uraian_pemeliharaan;
                                                        @endphp
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group"> 
                                                        <label class="ukuran_font">Tindakan Pengamanan :</label>
                                                        @php
                                                            echo $datas->tindakan_pengamanan;
                                                        @endphp
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group"> 
                                                        <label class="ukuran_font">Prosedur :</label>
                                                        @php
                                                           echo $datas->prosedur;
                                                        @endphp
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group"> 
                                                        <label class="ukuran_font">Alat Kerja :</label>
                                                        @php
                                                           echo $datas->alat_kerja;
                                                         @endphp
                                                    </div>
                                                </div>
                                            </div> 
                                        </div>
                                    </td>
                                </tr>
                            @php $no ++; @endphp
                            @endforeach
 
                            @else 
                                <tr>
                                    <td colspan="12" align="center" class="ukuran_font"><span class="text-danger">Data kartu pemeliharaan tidak ditemukan</span></td>
                                </tr>
                            @endif
                        </tbody>
                    </table>

                    @if ($paginate == 1)
                            {{$pemeliharaan->links()}}
                    @endif 
                </div> 
            </div>
        </div>
    </div>
    <div class="col-md-6">

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
            <form action="{{route('delete_kartu_pemeliharaan')}}" method="POST">
            @csrf
            <div class="modal-body">
                Apakah anda ingin menghapus data kartu pemeliharaan ?
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

<!-- Modal Konfirmasi Generate -->
<div class="modal fade text-left" id="generate_data" tabindex="-1" role="dialog" aria-labelledby="myModalLabel19" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel19">Konfirmasi</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="bx bx-x"></i>
                </button>
            </div>
            <form action="{{route('generate_manual')}}" method="POST">
            @csrf
            <div class="modal-body">
                Apakah anda ingin menggenerate skadul pemeliharaan ?
                <input type="hidden" id="kode_pemeliharaan" name="kode_pemeliharaan">
                <input type="hidden" id="tgl_mulai" name="tgl_mulai">
            </div>
            <div class="modal-footer"> 
                <button type="button" class="btn btn-light-secondary btn-sm" data-dismiss="modal">
                    <i class="bx bx-x d-block d-sm-none"></i>
                    <span class="d-sm-block d-none"><i class="bx bxs-x-circle"></i> Kembali</span>
                </button>
                <button type="submit" class="btn btn-primary ml-1 btn-sm">
                    <i class="bx bx-check d-block d-sm-none"></i>
                    <span class="d-sm-block d-none"><i class="fa fa-retweet"></i> Generate </span>
                </button> 
            </div>
            </form>
        </div>
    </div>
</div>
@endsection
@push('script')
<script type="text/javascript">
    $('.delete_pemeliharaan').on('click', function(){
       $set = $(this).attr('data-set');
       if ($set == 'delete_pemeliharaan'){

             id  = $(this).attr('data-id');
             $('#id_hapus').val(id);  
             $('#hapus_data').modal('show');
       }
   });

   $('.generate_skedul').on('click', function(){
       $set = $(this).attr('data-set');
       if ($set == 'generate_skedul'){

             kode  = $(this).attr('data-kode');
             tgl  = $(this).attr('data-tgl');
             $('#kode_pemeliharaan').val(kode);  
             $('#tgl_mulai').val(tgl);  
             $('#generate_data').modal('show');
       }
   });

    /*** pencarian komponen ***/ 
    $("#komponen").keyup(function(){ 
        $.ajax({
            headers:{
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                
            type     : "POST",
            url      : "{{route('pencarian_komponen')}}",
            cache    : false,
            datetype : "JSON", 
            data:{
                    'komponen': $('#komponen').val()
                }, 
                beforeSend: function(){
                    $("#loading_header").css('display','block'); 
                    $('#tabel_pemeliharaan').html(''); 
                },
                success: function(data){ 
                    $("#loading_header").css('display','none'); 
                    $('#tabel_pemeliharaan').html(''); 
                    $('#tabel_pemeliharaan').html(data);
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
                url      : "{{route('pencarian_kelompok')}}",
                cache    : false,
                datatype : "JSON",
                data:{
                        'id_komponen_pokok': $('#id_komponen_pokok').val(), 
                    },

                    beforeSend: function(){
                    $("#loading_header").css('display','block'); 
                    $('#tabel_pemeliharaan').html(''); 
                    },
                    success: function(data){ 
                        $("#loading_header").css('display','none'); 
                        $('#tabel_pemeliharaan').html(''); 
                        $('#tabel_pemeliharaan').html(data);
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
                 url      : "{{route('pencarian_subkelompok')}}",
                 cache    : false,
                 datatype : "JSON",
                 data:{
                         'id_komponen_sub_pokok': $('#id_komponen_sub_pokok').val(), 
                    },
 
                     beforeSend: function(){
                        $("#loading_header").css('display','block'); 
                        $('#tabel_pemeliharaan').html(''); 
                     },

                     success: function(data){ 
                        $("#loading_header").css('display','none'); 
                        $('#tabel_pemeliharaan').html(''); 
                        $('#tabel_pemeliharaan').html(data);
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
                 url      : "{{route('pencarian_sistem')}}",
                 cache    : false,
                 datatype : "JSON",
                 data:{
                         'id_sistem': $('#id_sistem').val(), 
                    },
 
                     beforeSend: function(){
                        $("#loading_header").css('display','block'); 
                        $('#tabel_pemeliharaan').html(''); 
                     },

                     success: function(data){ 
                        $("#loading_header").css('display','none'); 
                        $('#tabel_pemeliharaan').html(''); 
                        $('#tabel_pemeliharaan').html(data);
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
                 url      : "{{route('pencarian_subsistem')}}",
                 cache    : false,
                 datatype : "JSON",
                 data:{
                         'id_sub_sistem': $('#id_sub_sistem').val(), 
                    },
 
                     beforeSend: function(){
                        $("#loading_header").css('display','block'); 
                        $('#tabel_pemeliharaan').html(''); 
                     },

                     success: function(data){ 
                        $("#loading_header").css('display','none'); 
                        $('#tabel_pemeliharaan').html(''); 
                        $('#tabel_pemeliharaan').html(data);
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
                 url      : "{{route('pencarian_pelaksana')}}",
                 cache    : false,
                 datatype : "JSON",
                 data:{
                         'id_pelaksana': $('#id_pelaksana').val(), 
                    },
 
                     beforeSend: function(){
                        $("#loading_header").css('display','block'); 
                        $('#tabel_pemeliharaan').html(''); 
                     },

                     success: function(data){ 
                        $("#loading_header").css('display','none'); 
                        $('#tabel_pemeliharaan').html(''); 
                        $('#tabel_pemeliharaan').html(data);
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
                 url      : "{{route('pencarian_lokasi')}}",
                 cache    : false,
                 datatype : "JSON",
                 data:{
                         'id_lokasi': $('#id_lokasi').val(), 
                    },
 
                     beforeSend: function(){
                        $("#loading_header").css('display','block'); 
                        $('#tabel_pemeliharaan').html(''); 
                     },

                     success: function(data){ 
                        $("#loading_header").css('display','none'); 
                        $('#tabel_pemeliharaan').html(''); 
                        $('#tabel_pemeliharaan').html(data);
                     }
             });
        }); 

        /*** pencarian periode ***/ 
        $("#id_periode").keyup(function(){ 
             $.ajax({
                 headers:{
                         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                     },
 
                 type     : "POST",
                 url      : "{{route('pencarian_periode')}}",
                 cache    : false,
                 datatype : "JSON",
                 data:{
                         'id_periode': $('#id_periode').val(), 
                    },
 
                     beforeSend: function(){
                        $("#loading_header").css('display','block'); 
                        $('#tabel_pemeliharaan').html(''); 
                     },

                     success: function(data){ 
                        $("#loading_header").css('display','none'); 
                        $('#tabel_pemeliharaan').html(''); 
                        $('#tabel_pemeliharaan').html(data);
                     }
             });
        }); 
    }); 
</script>
@endpush
