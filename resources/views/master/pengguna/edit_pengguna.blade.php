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
                <h5> Form Edit Pengguna </h5> 
            </div> 
            <div class="card-body pad">
                <form method="POST" action="{{route('update_pengguna',$data_user->id)}}">
                    @csrf
                    <div class="form-group mb-50">
                        <label for="username" style="font-size: 15px;" class="ukuran_font">Nama <span class="text-danger">*</span></label>
                    <input type="text" style="" class="form-control ukuran_font" id="name" value="{{$data_user->name}}" name="name">
                         <span class="text-danger">{{$errors->first('name')}}</span>
                    </div>

                    <div class="form-group">
                        <label for="nama_pokok" style="font-size:15px;" class="ukuran_font">Email <span class="text-danger">*</span></label>
                        <input type="text" class="form-control ukuran_font"  name="email" value="{{$data_user->email}}" id="email">
                        <span class="text-danger">{{$errors->first('email')}}</span>
                    </div>

                    <div class="form-group">
                        <label for="nama_pokok" style="font-size:15px;" class="ukuran_font">Username <span class="text-danger">*</span></label>
                        <input type="text" class="form-control ukuran_font"  name="username" value="{{$data_user->username}}" id="username">
                        <span class="text-danger">{{$errors->first('username')}}</span>
                    </div>

                    <div class="form-group">
                        <label for="nama_pokok" style="font-size:15px;" class="ukuran_font">Password <span class="text-danger">*</span></label>
                        <input type="password" class="form-control ukuran_font" value="{{$data_user->password2}}" name="password" id="password">
                        <span class="text-danger">{{$errors->first('password')}}</span>
                    </div>

                    <div class="form-group">
                        <label for="nama_pokok" style="font-size:15px;" class="ukuran_font">Kapal <span class="text-danger">*</span></label>
                        <input type="text" class="form-control ukuran_font" name="kapal" id="kapal" value="{{$data_user->kapal}}">
                        <span class="text-danger">{{$errors->first('kapal')}}</span>
                    </div> 

                    <div class="form-group">
                        <label for="nama_pokok" style="font-size:15px;" class="ukuran_font">Level <span class="text-danger">*</span></label>
                        <select name="level" id="level" class="form-control select2">
                        <option value="{{$data_user->level}}">{{$data_user->level}}</option>
                            <option value="Admin">Admin</option>
                            <option value="User">User</option>
                        </select>
                        <span class="text-danger">{{$errors->first('level')}}</span>
                    </div>
                    <hr> 
                    <div class="row">
                        <div class="col-md-4">
                            <button type="submit" style="width:150px" class="btn btn-block bg-gradient-primary btn-sm"><i class="fa fa-save"></i>  Simpan </button>
                        </div>
                        <div class="col-md-4"> 
                            <a href="{{route('pengguna')}}" style="width:150px" class="btn btn-block bg-gradient-secondary btn-sm"> <i class="fa fa-arrow-circle-left"></i> Kembali </a>
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