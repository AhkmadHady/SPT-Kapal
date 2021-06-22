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
                <h5> Form Tambah Kerusakan </h5> 
            </div> 
            <div class="card-body pad">
                <form method="POST" action="{{route('save_kerusakan')}}">
                    @csrf
                    <div class="form-group mb-50 col-md-6">
                        <label for="username" style="font-size: 15px;" class="ukuran_font">Tgl Kerusakan *</label>
                        <div class="input-group date" id="reservationdate" data-target-input="nearest">
                            <input type="text" class="form-control datetimepicker-input ukuran_font" data-target="#reservationdate" id="tgl_kerusakan" name="tgl_kerusakan" datetimepicker="Y-m-d"/>
                            <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                        <span class="text-danger">{{$errors->first('tgl_kerusakan')}}</span>
                    </div>

                    <div class="form-group">
                        <label for="nama_pokok" style="font-size:15px;" class="ukuran_font">Pelaksana *</label>
                        <select name="id_pelaksana" id="id_pelaksana" class="form-control select2">
                                <option value=""></option>
                            @foreach ($pelaksana as $datas)
                                <option value="{{$datas->id}}">{{$datas->nama_pelaksana}}</option>
                            @endforeach
                        </select>
                        <span class="text-danger">{{$errors->first('id_pelaksana')}}</span>
                    </div>

                    <div class="form-group mb-50">
                        <label for="username" style="font-size: 15px;" class="ukuran_font">Komponen *</label>
                        <input type="text" style="" class="form-control ukuran_font" id="komponen" name="komponen">
                        <span class="text-danger">{{$errors->first('komponen')}}</span>
                    </div>

                    <div class="form-group">
                        <label for="email" style="font-size: 15px;" class="ukuran_font">Keterangan</label>
                        <textarea name="detail_kerusakan" class="form-control" id="detail_kerusakan" cols="30" rows="5"></textarea> 
                    </div> 
                    <hr> 
                    <div class="row">
                        <div class="col-md-4">
                            <button type="submit" style="width:150px" class="btn btn-block bg-gradient-primary btn-sm"><i class="fa fa-save"></i>  Simpan </button>
                        </div>
                        <div class="col-md-4"> 
                            <a href="{{route('kelompok')}}" style="width:150px" class="btn btn-block bg-gradient-secondary btn-sm"> <i class="fa fa-arrow-circle-left"></i> Kembali </a>
                        </div>
                    </div> 
                </form> 
            </div>
        </div>
    </div>
    <div class="col-md-6">

    </div>
</div> 
@endsection