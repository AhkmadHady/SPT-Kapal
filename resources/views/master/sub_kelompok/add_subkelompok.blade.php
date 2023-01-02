
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
                <h5> Form Tambah Sub-Kelompok </h5> 
            </div> 
            <div class="card-body pad">
                <form method="POST" action="{{route('save_subkelompok')}}">
                    @csrf 
                    <div class="form-group">
                        <label class="ukuran_font" for="kode_sub_pokok">Kode Sub-Kelompok</label>
                        <input type="text" class="form-control"  name="kode_sub_pokok" id="kode_sub_pokok">
                         <span class="text-danger">{{$errors->first('kode_sub_pokok')}}</span>
                    </div>
                
                    <div class="form-group">
                        <label class="ukuran_font" for="nama_sub_pokok">Nama Sub-Kelompok</label>
                        <input type="text" class="form-control"  name="nama_sub_pokok" id="nama_sub_pokok">
                         <span class="text-danger">{{$errors->first('nama_sub_pokok')}}</span>
                    </div>
                
                    <div class="form-group">
                        <label class="ukuran_font" for="email">Keterangan</label>
                        <textarea class="form-control" id="keterangan" name="keterangan"></textarea>
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