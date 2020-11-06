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
                <h5> Form Tambah Sistem </h5> 
            </div> 
            <div class="card-body pad"> 
                <form method="POST" action="{{route('save_sistem')}}">
                    @csrf
                    <div class="form-group">
                        <label class="ukuran_font" for="kode_komponen_sistem">Kode Sistem</label>
                        <input type="text" class="form-control ukuran_font"  name="kode_komponen_sistem" id="kode_komponen_sistem">
                         <span class="text-danger">{{$errors->first('kode_komponen_sistem')}}</span>
                    </div>

                    <div class="form-group">
                        <label class="ukuran_font" for="nama_komponen_sistem">Nama Sistem</label>
                        <input type="text" class="form-control ukuran_font"  name="nama_komponen_sistem" id="nama_komponen_sistem">
                        <span class="text-danger">{{$errors->first('nama_komponen_sistem')}}</span>
                    </div>

                    <div class="form-group">
                        <label class="ukuran_font" for="email">Keterangan</label>
                        <textarea class="form-control ukuran_font" id="keterangan" name="keterangan"></textarea>
                    </div> 
                    <hr> 
                    <div class="row">
                        <div class="col-md-4">
                            <button type="submit" style="width:150px" class="btn btn-block bg-gradient-primary btn-sm"><i class="fa fa-save"></i> Simpan </button>
                        </div>
                        <div class="col-md-4"> 
                            <a href="{{route('sistem')}}" style="width:150px" class="btn btn-block bg-gradient-secondary btn-sm"> <i class="fa fa-arrow-circle-left"></i> Kembali </a>
                        </div>
                    </div> 
                </form>
                <hr> 
            </div>
        </div>
    </div>
    <div class="col-md-6">

    </div>
</div> 
@endsection