
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
                <h5> Form Edit Sub-Kelompok </h5> 
            </div> 
            <div class="card-body pad">
                <form method="POST" action="{{route('update_subkelompok',$data_kelompok->id)}}">
                    @csrf
                   
                    <div class="form-group">
                        <label for="kode_sub_pokok" class="ukuran_font">Kode Sub-Kelompok</label>
                        <input type="text" class="form-control ukuran_font" value="{{$data_kelompok->kode_sub_pokok}}" name="kode_sub_pokok" id="kode_sub_pokok">
                         <span class="text-danger">{{$errors->first('kode_sub_pokok')}}</span>
                    </div>

                    <div class="form-group">
                        <label for="nama_sub_pokok" class="ukuran_font">Nama Sub-Kelompok</label>
                        <input type="text" class="form-control ukuran_font" value="{{$data_kelompok->nama_sub_pokok}}"  name="nama_sub_pokok" id="nama_sub_pokok">
                         <span class="text-danger">{{$errors->first('nama_sub_pokok')}}</span>
                    </div>

                    <div class="form-group">
                        <label for="email" class="ukuran_font">Keterangan</label>
                        <textarea class="form-control ukuran_font" id="keterangan" name="keterangan" valu="{{$data_kelompok->keterangan}}"> {{$data_kelompok->keterangan}} </textarea>
                    </div> 
                    <hr> 
                    <div class="row">
                        <div class="col-md-4">
                            <button type="submit" style="width:150px" class="btn btn-block bg-gradient-primary btn-sm"><i class="fa fa-save"></i>  Simpan </button>
                        </div>
                        <div class="col-md-4"> 
                            <a href="{{route('subkelompok')}}" style="width:150px" class="btn btn-block bg-gradient-secondary btn-sm"> <i class="fa fa-arrow-circle-left"></i> Kembali </a>
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