@extends('layouts.apps') 
@section('content')
<style>
    .tabel_header{
        padding-top:5px; padding-left:5px; padding-right:5px; padding-bottom:5px; font-size: 14px
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
            <li class="nav-item ">
                <a class="nav-link active" id="profile-tab"  href="{{route('jam_putar')}}" role="tab" aria-controls="jam_putar" aria-selected="false">Pemeliharaan Jam Putar</a>
            </li> 
            <li class="nav-item">
                <a class="nav-link " id="profile-tab"  href="{{route('skedul')}}" role="tab" aria-controls="profile" aria-selected="false">Daftar Jadwal Pemeliharaan</a>
            </li> 
            <li class="nav-item">
              <a class="nav-link " id="profile-tab"  href="{{route('pelaksanaan')}}" role="tab" aria-controls="profile" aria-selected="false">Daftar Pelaksanaan Pemeliharaan</a>
            </li> 
        </ul>
        <div class="card card-outline card-info mt-3">
            <div class="card-header">
                <h5> Pemeliharaan Jam Putar </h5> 
            </div> 
            <div class="card-body pad">
               
                <div class="pencarian_data">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="username" style="font-size: 15px;" class="ukuran_font">Tgl Pemeliharaan</label>
                            <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                <input type="text" class="form-control datetimepicker-input ukuran_font" data-target="#reservationdate" id="tanggal1" name="tanggal1" datetimepicker="Y-m-d"/>
                                <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for="username" style="font-size: 15px;" class="ukuran_font">s/d Tgl Pemeliharaan</label>
                            <div class="input-group date" id="reservationdate2" data-target-input="nearest">
                                <input type="text" class="form-control datetimepicker-input ukuran_font" data-target="#reservationdate2" id="tanggal2" name="tanggal2" datetimepicker="Y-m-d"/>
                                <div class="input-group-append" data-target="#reservationdate2" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group" style="margin-top: 33px;">
                                 <button class="btn btn-block bg-gradient-info btn-sm" style="width: 130px;" onclick="pencarianPeriode()"><i class="fa fa-search"></i> Cari</button>
                            </div>
                        </div>
                    </div>
                    <div class="row"> 
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="ukuran_font">Pencarian</label>
                                <input type="text" name="pencarian" id="pencarian" class="form-control ukuran_font" placeholder="komponen ...">
                            </div>
                        </div>
                        <div class="col-md-6" style="margin-top: 16px">
                            <a class="btn btn-block bg-gradient-info btn-sm float-right mt-4" style="width: 200px;" href="{{route('create_jam_putar')}}"><i class="fa fa-plus"></i> Tambah Pemeliharaan</a>
                        </div>
                    </div> 
                </div>
                <div class="col-md-12" id="loading_header" style="display: none;" align="center">
                    <img src="{{asset('assets/loading.gif')}}" alt=""><br><span>Loading...</span>
                </div>
                <div class="table-responsive" id="tabel_kelompok">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr class="tabel_header"> 
                                <th>No</th>  
                                <th>Tgl Pemeliharaan</th> 
                                <th>Jenis Perawatan</th> 
                                <th>Nama Komponen</th> 
                                <th>Pelaksana</th>   
                                <th>Catatan</th>
                                <th style="padding-top:5px; padding-left:5px; padding-right:5px; padding-bottom:5px; width:110px; font-size: 14px">Aksi</th>   
                            </tr>
                        </thead>
                        <tbody>
                    
                            @php
                                $no = 1;
                            @endphp
                    
                            @if ($pemeliharaan->count())
                                @foreach ($pemeliharaan as $datas)
                                    <tr class="tabel_header">
                                        <td>{{$no}} </td>  
                                        <td>{{$datas->tgl_pemeliharaan}}</td>  
                                        <td>{{$datas->jenis_perawatan}}</td>  
                                        <td>{{$datas->komponen}}</td>  
                                        <td>{{$datas->nama_pelaksana}}</td>   
                                        <td>
                                             @if ($datas->rumus < 1)
                                             <span>Periode Pemeliharaan : {{$datas->jml_putaran}} </span>
                                             <br> 
                                             @endif
                                            
                                             <span>
                                                 {{$datas->catatan}}
                                             </span>
                                        </td>  
                                        <td>
                                            <div class="row">
                                                <div class="col-sm">
                                                    <a class="btn btn-block bg-gradient-secondary btn-sm" href="{{route('edit_jam_putar',$datas->id)}}" title="Edit"><i class="fa fa-edit"></i></a>
                                                </div>
                                                <div class="col-sm">
                                                    <a class="btn btn-block bg-gradient-danger btn-sm delete_kerusakan" href="#" data-set="delete_kerusakan" title="Delete" data-id="{{$datas->id}}"><i class="fa fa-cut"></i></a> 
                                                </div>
                                            </div> 
                                        </td>  
                                    </tr>
                                    @php
                                        $no ++;
                                    @endphp
                                @endforeach
                            @else 
                                    <tr>
                                        <td colspan="8" align="center"><span class="text-danger">Data pemeliharaan tidak terencana tidak ditemukan</span></td>
                                    </tr>
                            @endif 
                        </tbody>
                    </table>
                    {{$pemeliharaan->links()}}
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
            <form action="{{route('delete_pemeliharaan_jam_putar')}}" method="POST">
                @csrf
                <div class="modal-body">
                    Apakah anda ingin menghapus data pemeliharaan jam putaran ?
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
@endsection
@push('script')
<script type="text/javascript">
    $('.delete_kerusakan').on('click', function(){
       $set = $(this).attr('data-set');
       if ($set == 'delete_kerusakan'){ 
             id  = $(this).attr('data-id');
             $('#id_hapus').val(id);  
             $('#hapus_data').modal('show');
       }
   });

   $("#pencarian").keyup(function(){ 
        $.ajax({
            headers:{
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                
            type     : "POST",
            url      : "{{route('pencarian_komponen_pemeliharaan_putaran')}}",
            cache    : false,
            datetype : "JSON", 
            data:{
                    'pencarian': $('#pencarian').val()
                }, 
                beforeSend: function(){
                    $("#loading_header").css('display','block'); 
                    $('#tabel_kelompok').html(''); 
                },
                success: function(data){ 
                    $("#loading_header").css('display','none'); 
                    $('#tabel_kelompok').html(''); 
                    $('#tabel_kelompok').html(data);
                }
        });
    });  

    function pencarianPeriode()
    {
        $.ajax({
            headers:{
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                
            type     : "POST",
            url      : "{{route('pencarian_periode_pemeliharaan_putaran')}}",
            cache    : false,
            datetype : "JSON", 
            data:{
                    'tanggal1': $('#tanggal1').val(),
                    'tanggal2': $('#tanggal2').val()
                }, 
                beforeSend: function(){
                    $("#loading_header").css('display','block'); 
                    $('#tabel_kelompok').html(''); 
                },
                success: function(data){ 
                    $("#loading_header").css('display','none'); 
                    $('#tabel_kelompok').html(''); 
                    $('#tabel_kelompok').html(data);
                }
        });
    }
</script>
@endpush
