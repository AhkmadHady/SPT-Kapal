@extends('layouts.apps') 
@section('content')
@if (session('info'))
<div class="alert alert-success alert-dismissible mb-2 mt-3" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    <div class="d-flex align-items-center">
        <span>
          {{ session('info') }} &nbsp;&nbsp;&nbsp; <a href="{{route('kerusakan')}}"><i class="fa fa-plus"></i> Tambah Kerusakan</a>
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
<div class="row"> 
    <div class="col-md-12 mt-4">
        <div class="card card-outline card-info">
            <div class="card-header">
                <h5> Daftar Komponen </h5> 
            </div> 
            <div class="card-body pad">  
                <div class="row"> 
                    @if ($komponen->count())  
                        @foreach ($komponen as $datas) 
                            <div class="col-lg-3 col-6  ">  
                                <div class="small-box shadow rounded  @if($datas->status ==0) bg-info @else bg-secondary @endif">
                                    <div class="inner" style="height: 160px;"> 
                                        <p class="text-center text-bold">{{$datas->komponen}}</p>
                                        <hr>
                                        <span style="font-size: 13px;">Kode KP : {{$datas->kode_pemeliharaan}}</span><br>
                                        <span style="font-size: 13px;">Periode &nbsp; : {{$datas->periode}} </span><br>

                                        <span style="font-size: 13px;">Lokasi &nbsp;&nbsp;&nbsp; : {{$datas->nama_lokasi}}</span><br>
                                        <span style="font-size: 13px;">Status &nbsp;&nbsp;&nbsp; : @if ($datas->status ==0)
                                            Aktif
                                            @else 
                                            Tidak Aktif
                                        @endif </span>  
                                    </div> 
                                    <hr>
                                    <div class="row pl-1 pb-1 pr-1">
                                        <div class="col-md-6">
                                            @if ($datas->status ==0)
                                                <a href="#" class="btn btn-info btn-sm save_pemeliharaan ukuran_font" data-set="save_pemeliharaan" data-id="{{$datas->id}}" data-tgl="{{$datas->tgl_skedul}}" >Verifikasi Pelaksanaan <i class="fas fa-arrow-circle-right"></i></a>
                                            @else 
                                                <a href="#" class="btn btn-info btn-sm ukuran_font">Klick Pemeliharaan <i class="fas fa-arrow-circle-right"></i></a>
                                            @endif 
                                        </div>
                                        <div class="col-md-6">
                                            <a href="{{route('print_kartu_pemeliharaan',$datas->id_kartu_pemeliharaan)}}" class="btn btn-info btn-sm ukuran_font" target="_blank"> Cetak Kartu Pemeliharaan <i class="fas fa-print"></i></a>
                                        </div>
                                    </div>
                                   

                                   
                                </div>
                            </div> 
                        @endforeach
                    @else 
                        <div class="col-lg-12 col-6 text-center">  
                            <h5 class="text-danger">Tidak Ada Data Komponen Pemeliharaan </h5>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div> 
</div> 

{{-- Input Pemeliharaan --}}  
<div class="modal fade" id="modal_pemeliharaan">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Form Pelaksanaan Pemeliharaan Komponen</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
            <form action="{{route('save_pemeliharaan_komponen',$tanggal)}}" method="POST"> 
                @csrf
                <div class="modal-body" id="frm_pelaksanaan">
                    {{-- form perbaikan --}}
                    <div class="form-group">
                        <label class="ukuran_font" for="">Tangal Skedul</label>
                    <input type="text" class="form-control ukuran_font" id="tgl_skedul_lama" name="tgl_skedul_lama" disabled>
                    <input type="hidden" class="form-control ukuran_font" id="id_skedul" name="id_skedul">
                    </div>
                    <div class="form-group">
                        <label class="ukuran_font"> Tanggal Pemeliharaan</label>
                        <div class="input-group date" id="tgl_pelaksanaan_" data-target-input="nearest">
                             <input type="text" class="form-control datetimepicker-input ukuran_font" data-target="#tgl_pelaksanaan_" id="tgl_pelaksanaan" name="tgl_pelaksanaan" value="{{date('Y-m-d')}}"/> 
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
                        <span class="d-sm-block d-none"><i class="fa fa-save"></i> Simpan & Generate Skedul</span>
                    </button> 
                </div>
            </form>
      </div> 
    </div> 
</div>
  
@endsection
@push('script')
    <script type="text/javascript">
        $('.save_pemeliharaan').on('click', function(){
            $set = $(this).attr('data-set');
            if ($set == 'save_pemeliharaan'){

                    id   = $(this).attr('data-id');
                    tgl  = $(this).attr('data-tgl');

                    $('#id_skedul').val(id);  
                    $('#tgl_skedul_lama').val(tgl); 
                   $('#modal_pemeliharaan').modal('show'); 

            }
        }); 
    </script>
@endpush
