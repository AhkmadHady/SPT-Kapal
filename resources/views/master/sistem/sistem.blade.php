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
                <h5> Daftar Sistem </h5> 
            </div> 
            <div class="card-body pad">
                <div class="pencarian_data">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="ukuran_font">Pencarian</label>
                                <input type="text" name="pencarian" id="pencarian" class="form-control ukuran_font" placeholder="Sistem ...">
                            </div>
                        </div>
                        <div class="col-md-6" style="margin-top: 16px">
                            <a class="btn btn-block bg-gradient-info btn-sm float-right mt-4" style="width: 150px;" href="{{route('create_sistem')}}"><i class="fa fa-plus"></i> Tambah Sistem</a>
                        </div>
                    </div> 
                </div>
                <div class="col-md-12" id="loading_header" style="display: none;" align="center">
                    <img src="{{asset('assets/loading.gif')}}" alt=""><br><span>Loading...</span>
                </div>
                <div class="table-responsive" id="tabel_kelompok">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr> 
                                <th style="padding-top:5px; padding-left:5px; padding-right:5px; padding-bottom:5px; font-size: 14px">No</th>  
                                <th style="padding-top:5px; padding-left:5px; padding-right:5px; padding-bottom:5px; font-size: 14px">Kode Sistem</th> 
                                <th style="padding-top:5px; padding-left:5px; padding-right:5px; padding-bottom:5px; font-size: 14px" >Nama Sistem</th> 
                                <th style="padding-top:5px; padding-left:5px; padding-right:5px; padding-bottom:5px; font-size: 14px">Keterangan</th>  
                                <th style="padding-top:5px; padding-left:5px; padding-right:5px; padding-bottom:5px; width:88px; font-size: 14px">Aksi</th>  
                            </tr>
                        </thead>
                        <tbody> 
                            @php
                                $no = 1;
                            @endphp
                    
                            @if ($sistem->count())
                                @foreach ($sistem as $datas)
                                    <tr>
                                        <td class="ukuran_font" style="padding-top:5px; padding-left:5px; padding-right:5px; padding-bottom:5px; font-size: 14px">{{$no}} </td>  
                                        <td class="ukuran_font" style="padding-top:5px; padding-left:5px; padding-right:5px; padding-bottom:5px; font-size: 14px">{{$datas->kode_komponen_sistem}}</td>  
                                        <td class="ukuran_font" style="padding-top:5px; padding-left:5px; padding-right:5px; padding-bottom:5px; font-size: 14px">{{$datas->nama_komponen_sistem}}</td>  
                                        <td class="ukuran_font" style="padding-top:5px; padding-left:5px; padding-right:5px; padding-bottom:5px; font-size: 14px">{{$datas->keterangan}}</td>  
                                        <td class="ukuran_font" style="padding-top:5px; padding-left:5px; padding-right:5px; padding-bottom:5px; font-size: 14px; width: 100px">
                                            <div class="row">
                                                <div class="col-sm">
                                                    <a class="btn btn-block bg-gradient-secondary btn-sm" title="Edit" href="{{route('edit_sistem',$datas->id)}}"><i class="fa fa-edit"></i> </a>
                                                </div>
                                                <div class="col-sm">
                                                    <a class="btn btn-block bg-gradient-danger btn-sm delete_sistem" title="Delete" href="#" data-set="delete_sistem" data-id="{{$datas->id}}"><i class="fa fa-cut"></i> </a>
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
                                        <td colspan="5" align="center"><span class="text-danger">Data sistem tidak ditemukan</span></td>
                                    </tr>
                            @endif 
                        </tbody>
                    </table>
                </div> 
            </div>
        </div>
    </div>
    <div class="col-md-6">

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
            <form action="{{route('delete_sistem')}}" method="POST">
            @csrf
            <div class="modal-body">
                Apakah anda ingin menghapus data sistem ?
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
    $('.delete_sistem').on('click', function(){
       $set = $(this).attr('data-set');
       if ($set == 'delete_sistem'){

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
            url      : "{{route('pencarian_sistem_master')}}",
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
</script>
@endpush
