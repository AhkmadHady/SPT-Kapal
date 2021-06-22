@extends('layouts.apps') 
@section('content')
<style>
    tr.hide-table-padding td {
  padding: 0;
}

.expand-button {
	position: relative;
}

.accordion-toggle .expand-button:after
{
  position: absolute;
  left:.75rem;
  top: 50%;
  transform: translate(0, -50%);
  content: '-';
}
.accordion-toggle.collapsed .expand-button:after
{
  content: '+';
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
        <div class="card card-outline card-info">
            <div class="card-header">
                <h5> Laporan Pelaksanaan Pemeliharaan </h5> 
            </div> 
            <div class="card-body pad">
                <div class="pencarian_data"> 
                    <div class="row"> 
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="ukuran_font"> Tanggal </label>
                                <div class="input-group date" id="tanggal" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input ukuran_font" data-target="#tanggal" id="tgl_pertama" name="tgl_pertama" datetimepicker="Y-m-d"/>
                                    <div class="input-group-append" data-target="#tanggal" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div> 
                                <span class="text-danger" id="tgl1_er"></span>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="ukuran_font"> s/d Tanggal </label>
                                <div class="input-group date" id="tanggal2" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input ukuran_font" data-target="#tanggal2" id="tgl_kedua" name="tgl_kedua"/>
                                    <div class="input-group-append" data-target="#tanggal2" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div> 
                                <span class="text-danger" id="tgl2_er"></span>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="ukuran_font"> Kategori Jenis Perawatan </label>
                                 <select name="kategori" id="kategori" class="form-control">
                                     <option value="ALL">ALL</option>
                                     <option value="TERENCANA">TERENCANA</option>
                                     <option value="TIDAK TERENCANA">TIDAK TERENCANA</option>
                                 </select>
                                 <span class="text-danger" id="kategori_er"></span>
                            </div>
                        </div>

                        <div class="col-md-3" style="margin-top: 35px;">
                            <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                                <button type="button" class="btn btn-info btn-sm" onclick="cariPemeliharaan()">
                                    Cari
                                </button>
                                
                                <div class="btn-group" role="group">
                                    <button type="button" class="btn btn-block bg-gradient-info btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown" style="width: 125px;"> 
                                    Export Data
                                  </button>
                                  <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                    <form method="GET" id="export_excel">
                                        <a class="dropdown-item ukuran_font" onclick="exportExcelLaporan()" href="#">Excel</a>
                                    </form>

                                    <form method="GET" id="export_pdf">
                                        <a class="dropdown-item ukuran_font" onclick="exportPdf()" href="#">PDF</a> 
                                    </form>
                                  </div>
                                </div>
                            </div> 
                        </div>
                    </div> 
                </div>
                <hr>
                <div class="col-md-12" id="loading_header" style="display: none;" align="center">
                    <img src="{{asset('assets/loading.gif')}}" alt=""><br><span>Loading...</span>
                </div>
                <div class="table-responsive" id="tabel_pelaksanaan">
                    <table class="table w-auto table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                                <th class="ukuran_font">No</th>  
                                <th class="ukuran_font">Kode Pemeliharaan</th>
                                <th class="ukuran_font"> Skedul</th>
                                <th class="ukuran_font"> Pelaksanaan</th> 
                                <th class="ukuran_font"> Komponen</th>
                                <th class="ukuran_font">Pelaksana</th>  
                                <th class="ukuran_font">Lokasi</th>
                                <th class="ukuran_font">JO</th>
                                <th class="ukuran_font">Periode</th>
                                <th class="ukuran_font">Jenis&nbsp;Perawatan</th>
                                <th class="ukuran_font">Catatan</th> 
                            </tr>
                        </thead>
                        <tbody>
                            @php $no = 1; @endphp
                            @if($pelaksanaan->count())
                            @foreach($pelaksanaan as $datas)
                                <tr>
                                    <td class="ukuran_font">{{$no}}</td>   
                                    <td class="ukuran_font accordion-toggle collapsed" id="accordion1" data-toggle="collapse" data-parent="#accordion1" href="#collapse{{$datas->id}}" width="250px;" style="text-align: center;padding-top: 5px; padding-bottom: 5px; padding-left: 5px; color: blue" > {{$datas->kode_pemeliharaan}}</td>
                                    <td class="ukuran_font">{{$datas->tgl_skedul}}</td>
                                    <td class="ukuran_font">{{$datas->tgl_pelaksanaan}}</td>
                                    <td class="ukuran_font">{{$datas->komponen}}</td> 
                                    <td class="ukuran_font">{{$datas->nama_pelaksana}}</td>
                                    <td class="ukuran_font">{{$datas->nama_lokasi}}</td>
                                    <td class="ukuran_font">{{$datas->jo}}</td> 
                                    <td class="ukuran_font">{{$datas->periode}}</td> 
                                    <td class="ukuran_font">{{$datas->jenis_perawatan}}</td> 
                                    <td class="ukuran_font">{{$datas->catatan}}</td> 
                                </tr>
                    
                                <tr class="hide-table-padding">
                                    <td></td>
                                    <td colspan="12">
                                        <div id="collapse{{$datas->id}}" class="collapse in p-3">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="ukuran_font">Uraian Pemeliharaan :</label>
                                                        <p style="font-size: 12px;">   @php
                                                            echo $datas->uraian_pemeliharaan;
                                                        @endphp</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group"> 
                                                        <label class="ukuran_font">Tindakan Pengamanan :</label>
                                                        <p style="font-size: 12px;">   @php
                                                            echo $datas->tindakan_pengamanan;
                                                        @endphp</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group"> 
                                                        <label class="ukuran_font">Prosedur :</label>
                                                        <p style="font-size: 12px;">   @php
                                                           echo $datas->prosedur;
                                                        @endphp</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group"> 
                                                        <label class="ukuran_font">Alat Kerja :</label>
                                                        <p style="font-size: 12px;">   @php
                                                           echo $datas->alat_kerja;
                                                         @endphp</p>
                                                    </div>
                                                </div>
                                            </div> 
                                        </div>
                                    </td>
                                </tr>
                            @php $no ++; @endphp
                            @endforeach 
                            @else 
                                <tr>
                                    <td colspan="23" align="center" class="ukuran_font"><span class="text-danger">Data pelaksanaan pemeliharaan tidak ditemukan</span></td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div> 
            </div>
        </div>
    </div> 
</div> 
 
@endsection
@push('script')
<script type="text/javascript">
     
    /*** Pencarian Pemeliharaan BY Tanggal ***/ 
    function cariPemeliharaan(){
        $.ajax({
            headers:{
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                
            type     : "POST",
            url      : "{{route('cari_laporan_pelaksanaan')}}",
            cache    : false,
            datetype : "JSON", 
            data:{
                    'tanggal1': $('#tgl_pertama').val(),
                    'tanggal2': $('#tgl_kedua').val(),
                    'kategori': $('#kategori').val(),
                }, 
                beforeSend: function(){
                    $("#loading_header").css('display','block'); 
                    $('#tabel_pelaksanaan').html(''); 
                },
                success: function(data){ 
                    $("#loading_header").css('display','none'); 
                    $('#tabel_pelaksanaan').html(''); 
                    $('#tabel_pelaksanaan').html(data);
                }
        });
    }

    function exportExcelLaporan()
        {
            var tgl11 = $('#tgl_pertama').val();
            var tgl12 = $('#tgl_kedua').val();
            var kategori = $('#kategori').val();
            if (tgl11 == '') {
                $('#tgl1_er').html('Tanggal tidak boleh kosong.');
                return false;
            }else{
                $('#tgl1_er').html('');

            }

            if (tgl12 == '') {
                $('#tgl2_er').html('Tanggal tidak boleh kosong.');
                return false;
            }else{
                $('#tgl2_er').html('');

            }
           

            if (kategori == '') {
                $('#kategori_er').html('Kategori tidak boleh kosong.');
                return false;
            }else{
                $('#kategori_er').html('');

            }
           
            $('#export_excel').attr('action', 'laporan-pemeliharaan/'+tgl11+'/'+tgl12+'/'+kategori+'/export-excel');
            $('#export_excel').submit();
        }

        function exportPdf()
        {
            var tgl11 = $('#tgl_pertama').val();
            var tgl12 = $('#tgl_kedua').val();
            var kategori = $('#kategori').val();

            if (tgl11 == '') {
                $('#error_tgl1').html('Tanggal tidak boleh kosong.');
                return false;
            }else{
                $('#error_tgl1').html('');

            }

            if (tgl12 == '') {
                $('#error_tgl2').html('Tanggal tidak boleh kosong.');
                return false;
            }else{
                $('#error_tgl2').html('');
            }

            if (kategori == '') {
                $('#kategori_er').html('kategori tidak boleh kosong.');
                return false;
            }else{
                $('#kategori_er').html('');
            }

            $('#export_pdf').attr('action', 'laporan-pemeliharaan/'+tgl11+'/'+tgl12+'/'+kategori+'/export-pdf');
            $('#export_pdf').submit();
        }


</script>
@endpush
