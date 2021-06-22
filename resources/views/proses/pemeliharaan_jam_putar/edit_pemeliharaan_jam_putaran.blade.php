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
    <div class="col-md-6 mt-4">
        <div class="card card-outline card-info">
            <div class="card-header">
                <h5> Form Pemeliharaan Jam Putar </h5> 
            </div> 
            <div class="card-body pad">
                <form method="POST" action="{{route('update_jam_putar',$id_service)}}">
                    @csrf
                    <div class="form-group mb-50 col-md-6">
                        <label for="username" style="font-size: 15px;" class="ukuran_font">Tgl Pemeliharaan</label>
                        <div class="input-group date" id="reservationdate" data-target-input="nearest">
                            <input type="text" class="form-control datetimepicker-input ukuran_font" data-target="#reservationdate" id="tgl_pemeliharaan" name="tgl_pemeliharaan" datetimepicker="Y-m-d" value="{{$pemeliharaan_putaran->tgl_pemeliharaan}}"/>
                            <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                        <span class="text-danger">{{$errors->first('tgl_pemeliharaan')}}</span>
                    </div>
                    <div class="form-group">
                        <label for="nama_pokok" style="font-size:15px;" class="ukuran_font">Nama Komponen</label>
                        <select name="id_kartu_pemeliharaan" id="id_kartu_pemeliharaan" class="form-control select2">
                            <option value="{{$pemeliharaan_putaran->id_kartu_pemeliharaan}}">{{$pemeliharaan_putaran->komponen}} - {{$pemeliharaan_putaran->periode}}</option>
                            @foreach ($komponen as $datas)
                                <option value="{{$datas->id}}">{{$datas->komponen}} - {{$datas->periode}}</option>
                            @endforeach
                        </select>
                        <span class="text-danger">{{$errors->first('id_kartu_pemeliharaan')}}</span>
                    </div> 
                    <div class="form-group">
                        <label for="nama_pokok" style="font-size:15px;" class="ukuran_font">Pelaksana</label>
                        <select name="id_pelaksana" id="id_pelaksana" class="form-control select2">
                            <option value="{{$pemeliharaan_putaran->id_pelaksana}}">{{$pemeliharaan_putaran->nama_pelaksana}}</option>
                            @foreach ($pelaksana as $datas)
                                <option value="{{$datas->id}}">{{$datas->nama_pelaksana}}</option>
                            @endforeach
                        </select>
                        <span class="text-danger">{{$errors->first('id_pelaksana')}}</span>
                    </div> 
                    @if ($pemeliharaan_putaran->rumus < 1)
                        <div class="form-group mb-50" id="frm_jam_putar" style="display: block">
                            <label for="username" style="font-size: 15px;" class="ukuran_font">Jumlah Putaran</label>
                            <input type="text" style="" class="form-control ukuran_font" id="jml_putaran" name="jml_putaran" value="{{$pemeliharaan_putaran->jml_putaran}}">
                            <span class="text-danger">{{$errors->first('jml_putaran')}}</span>
                        </div> 
                    @else 
                        <div class="form-group mb-50" id="frm_jam_putar" style="display: none">
                            <label for="username" style="font-size: 15px;" class="ukuran_font">Jumlah Putaran</label>
                            <input type="text" style="" class="form-control ukuran_font" id="jml_putaran" name="jml_putaran">
                            <span class="text-danger">{{$errors->first('jml_putaran')}}</span>
                        </div> 
                    @endif
                   
                    <div class="form-group">
                        <label for="email" style="font-size: 15px;" class="ukuran_font">Catatan</label>
                        <textarea name="catatan" class="form-control" id="catatan" cols="30" rows="5" value="{{$pemeliharaan_putaran->catatan}}">{{$pemeliharaan_putaran->catatan}}</textarea> 
                    </div> 
                    <hr> 
                    <div class="row">
                        <div class="col-md-4">
                            <button type="submit" style="width:150px" class="btn btn-block bg-gradient-primary btn-sm"><i class="fa fa-save"></i>  Simpan </button>
                        </div>
                        <div class="col-md-4"> 
                            <a href="{{route('jam_putar')}}" style="width:150px" class="btn btn-block bg-gradient-secondary btn-sm"> <i class="fa fa-arrow-circle-left"></i> Kembali </a>
                        </div>
                    </div> 
                </form> 
            </div>
        </div>
    </div> 
</div> 
@endsection
@push('script')
<script type="text/javascript"> 
    $("#id_kartu_pemeliharaan").change(function(){ 
         $.ajax({
             headers:{
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 },
                 
             type     : "POST",
             url      : "{{route('get_jumlah_hari_periode_edit',$id_service)}}",
             cache    : false,
             datetype : "JSON", 
             data:{
                     'id': $('#id_kartu_pemeliharaan').val()
                 }, 
 
                 
                 success: function(data){ 
                     if (data.message ==='0') {
                         $("#frm_jam_putar").css('display','block'); 
                     }else{
                         $("#frm_jam_putar").css('display','none'); 
 
                     }
                 }
         });
    });   
 </script>
 @endpush