@extends('layouts.apps') 
@section('content')
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
                <a class="nav-link" id="profile-tab"  href="{{route('skedul')}}" role="tab" aria-controls="profile" aria-selected="false">Daftar Jadwal Pemeliharaan</a>
              </li> 
            <li class="nav-item">
              <a class="nav-link active" id="profile-tab"  href="{{route('pelaksanaan')}}" role="tab" aria-controls="profile" aria-selected="false">Daftar Pelaksanaan Pemeliharaan</a>
            </li> 
        </ul>

        <div class="card card-outline card-info mt-3">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <h5 class="float-lef"> Pelaksanaan Pemeliharaan </h5>  
                    </div>
                    
                </div> 
            </div> 
            <div class="card-body pad"> 
              
                <div id="accordion" class="mt-3"> 
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
                                    {{-- <div class="col-md-4">
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
                                    </div> --}}
            
                                    {{-- <div class="col-md-4">
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
                                    </div> --}}
            
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="ukuran_font">Periode <span class="text-danger">*</span></label>
                                            <input type="text" name="id_periode" id="id_periode" class="form-control ukuran_font">
                                            {{-- <select class="form-control ukuran_font select2" style="width: 100%;" name="id_periode" id="id_periode">
                                                <option value=""></option>
                                                @foreach ($periode as $datas)
                                                    <option value="{{$datas->id}}">{{$datas->periode}}</option>
                                                @endforeach
                                            </select> --}}
                                            <span class="text-danger">{{$errors->first('id_periode')}}</span>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="ukuran_font">Komponen <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="komponen" name="komponen">
                                            <span class="text-danger">{{$errors->first('komponen')}}</span>
                
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="ukuran_font"> Tanggal Pelaksanaan </label>
                                            <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                                <input type="text" class="form-control datetimepicker-input ukuran_font" data-target="#reservationdate" id="tanggal" name="tanggal" datetimepicker="Y-m-d"/>
                                                <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
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
                <div class="table-responsive mt-3" id="tabel_pelaksanaan">
                    <table class="table w-auto table-bordered table-hover table-striped">
                        <thead> 
                            <tr>
                                <th class="ukuran_font" style="text-align: center;padding-top: 5px; padding-bottom: 5px; padding-left: 5px;">No</th>  
                                <th class="ukuran_font" style="text-align: center;padding-top: 5px; padding-bottom: 5px; padding-left: 5px;" >Kode Kartu</th>
                                <th class="ukuran_font" style="text-align: center;padding-top: 5px; padding-bottom: 5px; padding-left: 5px;"> Tgl SKedul</th> 
                                <th class="ukuran_font" style="text-align: center;padding-top: 5px; padding-bottom: 5px; padding-left: 5px;"> Tgl Pelaksanaan</th> 
                                <th class="ukuran_font" style="text-align: center;padding-top: 5px; padding-bottom: 5px; padding-left: 5px;"> Komponen</th> 
                              
                                <th class="ukuran_font" style="text-align: center;padding-top: 5px; padding-bottom: 5px; padding-left: 5px;">Pelaksana</th> 
                                <th class="ukuran_font" style="text-align: center;padding-top: 5px; padding-bottom: 5px; padding-left: 5px;">JO</th>
                                <th class="ukuran_font" style="text-align: center;padding-top: 5px; padding-bottom: 5px; padding-left: 5px;">Periode</th> 
                                <th class="ukuran_font" style="text-align: center;padding-top: 5px; padding-bottom: 5px; padding-left: 5px;">Lokasi</th>
                                <th class="ukuran_font" style="text-align: center;padding-top: 5px; padding-bottom: 5px; padding-left: 5px;">Catatan Pelaksanaan</th>
                                <th class="ukuran_font" style="text-align: center;padding-top: 5px; padding-bottom: 5px; padding-left: 5px;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $no = 1; @endphp
                            @if($pelaksanaan->count())
                            @foreach($pelaksanaan as $datas) 
                                <tr>
                                    <td class="ukuran_font" style="text-align: center;padding-top: 5px; padding-bottom: 5px; padding-left: 5px;">{{$no}}</td> 

                                    <td class="ukuran_font accordion-toggle collapsed" id="accordion1" data-toggle="collapse" data-parent="#accordion1" href="#collapse{{$datas->id_pelaksanaan}}" width="250px;" style="text-align: center;padding-top: 5px; padding-bottom: 5px; padding-left: 5px; color: blue" > {{$datas->kode_pemeliharaan}} </td> 

                                    <td class="ukuran_font">{{$datas->tgl_skedul}}</td>
                                    <td class="ukuran_font">{{$datas->tgl_pelaksanaan}}</td>

                                    <td class="ukuran_font" style="text-align: center;padding-top: 5px; padding-bottom: 5px; padding-left: 5px;">{{$datas->komponen}}</td>  
                                    <td class="ukuran_font" style="text-align: center;padding-top: 5px; padding-bottom: 5px; padding-left: 5px;">{{$datas->nama_pelaksana}}</td>  

                                    <td class="ukuran_font" style="text-align: center;padding-top: 5px; padding-bottom: 5px; padding-left: 5px;">{{$datas->jo}}</td> 

                                    <td class="ukuran_font" style="text-align: center;padding-top: 5px; padding-bottom: 5px; padding-left: 5px;">{{$datas->periode}}</td>  

                                    <td class="ukuran_font" style="text-align: center;padding-top: 5px; padding-bottom: 5px; padding-left: 5px;">{{$datas->nama_lokasi}}</td>
                                    <td class="ukuran_font">{{$datas->catatan}}</td> 

                                    <td> 
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-secondary btn-sm">Pilih</button> 
                                            <div class="btn-group">
                                              <button type="button" class="btn btn-secondary btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                              </button>
                                              <div class="dropdown-menu">
                                              <a class="dropdown-item ukuran_font edit_pelaksanaan" href="#" data-set="edit_pelaksanaan" data-id="{{$datas->id_pelaksanaan}}" data-catatan="{{$datas->catatan}}" data-idpelaksana="{{$datas->id_pelaksana}}" data-idskedul="{{$datas->id}}" data-tglpelaksanaan="{{$datas->tgl_pelaksanaan}}"><i class="fa fa-edit mr-1"></i> Edit</a>

                                                <a class="dropdown-item delete_pelaksanaan ukuran_font" data-set="delete_pelaksanaan" data-id="{{$datas->id_pelaksanaan}}" href="#"> <i class="fa fa-cut mr-1"></i> Delete</a>
                                               
                                              </div>
                                            </div>
                                        </div> 
                                    </td> 
                                </tr>

                                <tr class="hide-table-padding">
                                    <td></td>
                                    <td colspan="14">
                                        <div id="collapse{{$datas->id_pelaksanaan}}" class="collapse in p-3">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="ukuran_font">Uraian Pemeliharaan :</label>
                                                        <p style="font-size: 14px;">   @php
                                                            echo $datas->uraian_pemeliharaan;
                                                        @endphp</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group"> 
                                                        <label class="ukuran_font">Tindakan Pengamanan :</label>
                                                        <p style="font-size: 14px;">   @php
                                                            echo $datas->tindakan_pengamanan;
                                                        @endphp</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group"> 
                                                        <label class="ukuran_font">Prosedur :</label>
                                                        <p style="font-size: 14px;">   @php
                                                           echo $datas->prosedur;
                                                        @endphp</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group"> 
                                                        <label class="ukuran_font">Alat Kerja :</label>
                                                        <p style="font-size: 14px;">   @php
                                                           echo $datas->alat_kerja;
                                                         @endphp</p>
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
                                    <td colspan="24" align="center" class="ukuran_font"><span class="text-danger">Data pelaksanaan pemeliharaan tidak ditemukan</span></td>
                                </tr>
                            @endif
                        </tbody>
                    </table>

                    @if ($paginate == 1)
                            {{$pelaksanaan->links()}}
                    @endif 
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
            <form action="{{route('delete_pelaksanaan')}}" method="POST">
            @csrf
            <div class="modal-body">
                Apakah anda ingin menghapus data pelaksanaan pemeliharaan ?
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

{{-- Edit Pemeliharaan --}}  
<div class="modal fade" id="modal_pemeliharaan">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Form Edit Pelaksanaan Pemeliharaan Komponen</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
            <form action="{{route('update_pelaksanaan')}}" method="POST"> 
                @csrf
                <div class="modal-body" id="frm_pelaksanaan">
                    
                    <div class="form-group">
                        <label class="ukuran_font"> Tanggal Pemeliharaan</label>
                        <div class="input-group date" id="tgl_pelaksanaan_" data-target-input="nearest">
                        <input type="text" class="form-control datetimepicker-input ukuran_font" data-target="#tgl_pelaksanaan_" id="tgl_pelaksanaan" name="tgl_pelaksanaan"/>
                            
                            <div class="input-group-append" data-target="#tgl_pelaksanaan_" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div> 
                    </div>
                    
                    <div class="form-group">
                        <label class="ukuran_font"> Pelaksana</label>
                        <select name="id_pelaksana" id="id_pelaksana" class="form-control select2 ukuran_font">
                            @foreach ($pelaksana as $datas)
                                <option value="{{$datas->id}}">{{$datas->nama_pelaksana}}</option>
                            @endforeach
                        </select>
                        <input type="hidden" class="form-control ukuran_font" id="id_skedul" name="id_skedul">
                        <input type="hidden" class="form-control ukuran_font" id="id_pelaksanaan" name="id_pelaksanaan">
                    </div>
                    
                    <div class="form-group">
                        <label class="ukuran_font"> Catatan Pemeliharaan</label>
                        <textarea class="form-control ukuran_font" name="catatan" id="catatan" cols="30" rows="5"></textarea>
                    </div> 
                </div>
                <div class="modal-footer"> 
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-sm-block d-none"><i class="fa fa-times-circle"></i> Kembali</span>
                    </button>
                    <button type="submit" class="btn btn-primary ml-1 btn-sm" id="tes">
                        <i class="bx bx-check d-block d-sm-none"></i>
                        <span class="d-sm-block d-none"><i class="fa fa-save"></i> Simpan</span>
                    </button> 
                </div>
            </form>
        </div> 
    </div> 
</div>
@endsection
@push('script')
<script type="text/javascript">
    $('.edit_pelaksanaan').on('click', function(){
       $set = $(this).attr('data-set');
       if ($set == 'edit_pelaksanaan'){

            id                 = $(this).attr('data-id');
            catatan            = $(this).attr('data-catatan');
            idpelaksana        = $(this).attr('data-idpelaksana');
            idskedul           = $(this).attr('data-idskedul');
            tgl_pelaksanaan    = $(this).attr('data-tglpelaksanaan');

            $('#id_skedul').val(idskedul);  
            $('#tgl_pelaksanaan').val(tgl_pelaksanaan);  
            $('#id_pelaksana').val(idpelaksana);  
            $('#catatan').val(catatan);  
            $('#id_pelaksanaan').val(id);  
            $('#modal_pemeliharaan').modal('show');
       }
    });

    $('.delete_pelaksanaan').on('click', function(){
       $set = $(this).attr('data-set');
       if ($set == 'delete_pelaksanaan'){

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
            url      : "{{route('pencarian_pelaksanaan_komponen')}}",
            cache    : false,
            datetype : "JSON", 
            data:{
                    'komponen': $('#komponen').val()
                }, 
                beforeSend: function(){
                    $("#loading_header").css('display','block'); 
                    $('#tabel_pelaksanaan').html(''); 
                },
                success: function(data){ 
                    $("#loading_header").css('display','none'); 
                    $('#tabel_pelaksanaan').html(''); 
                    $('#tabel_pelaksanaan').html(data);
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
                url      : "{{route('pencarian_pelaksanaan_kelompok')}}",
                cache    : false,
                datatype : "JSON",
                data:{
                        'id_komponen_pokok': $('#id_komponen_pokok').val(), 
                    },

                    beforeSend: function(){
                    $("#loading_header").css('display','block'); 
                    $('#tabel_pelaksanaan').html(''); 
                    },
                    success: function(data){ 
                        $("#loading_header").css('display','none'); 
                        $('#tabel_pelaksanaan').html(''); 
                        $('#tabel_pelaksanaan').html(data);
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
                 url      : "{{route('pencarian_pelaksanaan_subkelompok')}}",
                 cache    : false,
                 datatype : "JSON",
                 data:{
                         'id_komponen_sub_pokok': $('#id_komponen_sub_pokok').val(), 
                    },
 
                     beforeSend: function(){
                        $("#loading_header").css('display','block'); 
                        $('#tabel_pelaksanaan').html(''); 
                     },

                     success: function(data){ 
                        $("#loading_header").css('display','none'); 
                        $('#tabel_pelaksanaan').html(''); 
                        $('#tabel_pelaksanaan').html(data);
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
                 url      : "{{route('pencarian_pelaksanaan_sistem')}}",
                 cache    : false,
                 datatype : "JSON",
                 data:{
                         'id_sistem': $('#id_sistem').val(), 
                    },
 
                     beforeSend: function(){
                        $("#loading_header").css('display','block'); 
                        $('#tabel_pelaksanaan').html(''); 
                     },

                     success: function(data){ 
                        $("#loading_header").css('display','none'); 
                        $('#tabel_pelaksanaan').html(''); 
                        $('#tabel_pelaksanaan').html(data);
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
                 url      : "{{route('pencarian_pelaksanaan_subsistem')}}",
                 cache    : false,
                 datatype : "JSON",
                 data:{
                         'id_sub_sistem': $('#id_sub_sistem').val(), 
                    },
 
                     beforeSend: function(){
                        $("#loading_header").css('display','block'); 
                        $('#tabel_pelaksanaan').html(''); 
                     },

                     success: function(data){ 
                        $("#loading_header").css('display','none'); 
                        $('#tabel_pelaksanaan').html(''); 
                        $('#tabel_pelaksanaan').html(data);
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
                 url      : "{{route('pencarian_pelaksanaan_pelaksana')}}",
                 cache    : false,
                 datatype : "JSON",
                 data:{
                         'id_pelaksana': $('#id_pelaksana').val(), 
                    },
 
                     beforeSend: function(){
                        $("#loading_header").css('display','block'); 
                        $('#tabel_pelaksanaan').html(''); 
                     },

                     success: function(data){ 
                        $("#loading_header").css('display','none'); 
                        $('#tabel_pelaksanaan').html(''); 
                        $('#tabel_pelaksanaan').html(data);
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
                        $('#tabel_pelaksanaan').html(''); 
                     },

                     success: function(data){ 
                        $("#loading_header").css('display','none'); 
                        $('#tabel_pelaksanaan').html(''); 
                        $('#tabel_pelaksanaan').html(data);
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
                 url      : "{{route('pencarian_pelaksanaan_periode')}}",
                 cache    : false,
                 datatype : "JSON",
                 data:{
                         'id_periode': $('#id_periode').val(), 
                    },
 
                     beforeSend: function(){
                        $("#loading_header").css('display','block'); 
                        $('#tabel_pelaksanaan').html(''); 
                     },

                     success: function(data){ 
                        $("#loading_header").css('display','none'); 
                        $('#tabel_pelaksanaan').html(''); 
                        $('#tabel_pelaksanaan').html(data);
                     }
             });
        }); 

         /*** pencarian tanggal pelaksanaan ***/ 
         $("#tanggal").blur(function(){ 
             $.ajax({
                 headers:{
                         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                     },
 
                 type     : "POST",
                 url      : "{{route('pencarian_pelaksanaan_tglpelaksanaan')}}",
                 cache    : false,
                 datatype : "JSON",
                 data:{
                         'tanggal': $('#tanggal').val(), 
                    },
 
                     beforeSend: function(){
                        $("#loading_header").css('display','block'); 
                        $('#tabel_pelaksanaan').html(''); 
                     },

                     success: function(data){ 
                        $("#loading_header").css('display','none'); 
                        $('#tabel_pelaksanaan').html(''); 
                        $('#tabel_pelaksanaan').html(data);
                     }
             });
        }); 
    }); 
</script>
@endpush
 
