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
                <h5> Form Edit Kartu Pemeliharaan </h5> 
            </div> 
            <div class="card-body pad">
                <form action="{{route('update_kartu_pemeliharaan',$pemeliharaan->id)}}" method="POST">
                @csrf
            
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="ukuran_font">Kode Pemeliharaan <span class="text-danger">*</span></label>
                            <input type="text" name="kode_pemeliharaan" value="{{$pemeliharaan->kode_pemeliharaan}}" id="kode_pemeliharaan" class="form-control ukuran_font" disabled>
                            <span class="text-danger">{{$errors->first('kode_pemeliharaan')}}</span>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="ukuran_font">Kelompok <span class="text-danger">*</span></label>
                            <select class="form-control ukuran_font select2" name="id_komponen_pokok" id="id_komponen_pokok">
                            <option value="{{$pemeliharaan->id_komponen_pokok}}">{{$pemeliharaan->nama_pokok}}</option>
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
                            <select class="form-control ukuran_font select2" name="id_komponen_sub_pokok" id="id_komponen_sub_pokok">
                                <option value="{{$pemeliharaan->id_komponen_sub_pokok}}">{{$pemeliharaan->nama_sub_pokok}}</option>
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
                            <select class="form-control ukuran_font select2" name="id_sistem" id="id_sistem">
                                <option value="{{$pemeliharaan->id_sistem}}">{{$pemeliharaan->nama_komponen_sistem}}</option>
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
                            <select class="form-control ukuran_font select2" name="id_sub_sistem" id="id_sub_sistem">
                                <option value="{{$pemeliharaan->id_sub_sistem}}">{{$pemeliharaan->nama_komponen_sub_sistem}}</option>

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
                            <select class="form-control ukuran_font select2" name="id_pelaksana" id="id_pelaksana">
                                <option value="{{$pemeliharaan->id_pelaksana}}">{{$pemeliharaan->nama_pelaksana}}</option>
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
                            <select class="form-control ukuran_font select2" name="id_lokasi" id="id_lokasi">
                                <option value="{{$pemeliharaan->id_lokasi}}">{{$pemeliharaan->nama_lokasi}}</option>

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
                            <select class="form-control ukuran_font select2" name="id_periode" id="id_periode">
                                <option value="{{$pemeliharaan->id_periode}}">{{$pemeliharaan->periode}}</option>
                                @foreach ($periode as $datas)
                                    <option value="{{$datas->id}}">{{$datas->periode}}</option>
                                @endforeach
                            </select>
                            <span class="text-danger">{{$errors->first('id_periode')}}</span>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="ukuran_font">Tanggal Mulai Pemeliharanaan<span class="text-danger">*</span></label>
                            <div class="input-group date" id="reservationdate" data-target-input="nearest">
                            <input type="text" class="form-control datetimepicker-input ukuran_font" data-target="#reservationdate" id="tgl_mulai" value="{{$pemeliharaan->tgl_mulai}}" name="tgl_mulai" datetimepicker="Y-m-d"/>
                                <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                            <span class="text-danger">{{$errors->first('tgl_mulai')}}</span>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="ukuran_font">Komponen <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" value="{{$pemeliharaan->komponen}}" id="komponen" name="komponen">
                            <span class="text-danger">{{$errors->first('komponen')}}</span>

                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="ukuran_font">Jenis Perawatan <span class="text-danger">*</span></label>
                            <select class="form-control ukuran_font select2" style="width: 100%;" name="id_jenis_perawatan" id="id_jenis_perawatan">
                                <option value="{{$pemeliharaan->id_jenis_perawatan}}">{{$pemeliharaan->jenis_perawatan}}</option>
                                @foreach ($perawatan as $datas)
                                    <option value="{{$datas->id}}">{{$datas->jenis_perawatan}}</option>
                                @endforeach
                            </select>
                            <span class="text-danger">{{$errors->first('id_jenis_perawatan')}}</span>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="ukuran_font">JO <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="jo" value="{{$pemeliharaan->jo}}" name="jo">
                            <span class="text-danger">{{$errors->first('jo')}}</span>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <label class="ukuran_font">Uraian Pemeliharaan <span class="text-danger">*</span></label>
                        <textarea class="textarea ukuran_font" name="uraian_pemeliharaan" id="uraian_pemeliharaan" placeholder="Place some text here" value="{{$pemeliharaan->uraian_pemeliharaan}}">{{$pemeliharaan->uraian_pemeliharaan}}</textarea>
                        <span class="text-danger">{{$errors->first('uraian_pemeliharaan')}}</span>
                    </div>

                    <div class="col-md-12">
                        <label class="ukuran_font">Tindakan Pengamanan <span class="text-danger">*</span></label>
                        <textarea class="textarea ukuran_font" name="tindakan_pengamanan" id="tindakan_pengamanan" placeholder="Place some text here" value="{{$pemeliharaan->tindakan_pengamanan}}"> {{$pemeliharaan->tindakan_pengamanan}} </textarea>
                        <span class="text-danger">{{$errors->first('tindakan_pengamanan')}}</span>
                    </div>

                    <div class="col-md-12">
                        <label class="ukuran_font">Prosedur <span class="text-danger">*</span></label>
                        <textarea class="textarea ukuran_font" name="prosedur" id="prosedur" placeholder="Place some text here" value="{{$pemeliharaan->prosedur}}"> {{$pemeliharaan->prosedur}} </textarea>
                        <span class="text-danger">{{$errors->first('prosedur')}}</span>
                    </div>

                    <div class="col-md-12">
                        <label class="ukuran_font">Alat Kerja <span class="text-danger">*</span></label>
                        <textarea class="textarea ukuran_font" name="alat_kerja" id="alat_kerja" placeholder="Place some text here" value="{{$pemeliharaan->alat_kerja}}"> {{$pemeliharaan->alat_kerja}} </textarea>
                        <span class="text-danger">{{$errors->first('alat_kerja')}}</span>
                        <hr>
                    </div>
                    
                    <div class="col-md-3">
                        <button type="submit" style="width:250px" class="btn btn-block bg-gradient-primary btn-sm"><i class="fa fa-save"></i>  Simpan & Generate Skedul</button>
                    </div>
                    <div class="col-md-2"> 
                        <a href="{{route('kartu_pemeliharaan')}}" style="width:150px" class="btn btn-block bg-gradient-secondary btn-sm"> <i class="fa fa-arrow-circle-left"></i> Kembali </a>
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