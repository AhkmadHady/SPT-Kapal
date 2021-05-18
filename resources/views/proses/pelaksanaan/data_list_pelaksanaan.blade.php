<table class="table w-auto table-bordered table-hover table-striped">
    <thead> 
        <tr>
            <th class="ukuran_font" style="text-align: center;padding-top: 5px; padding-bottom: 5px; padding-left: 5px;">No</th>  
            <th class="ukuran_font" style="text-align: center;padding-top: 5px; padding-bottom: 5px; padding-left: 5px;" >Kode Kartu</th>
            <th class="ukuran_font" style="text-align: center;padding-top: 5px; padding-bottom: 5px; padding-left: 5px;"> Tgl SKedul</th> 
            <th class="ukuran_font" style="text-align: center;padding-top: 5px; padding-bottom: 5px; padding-left: 5px;"> Tgl Pelaksanaan</th> 
            <th class="ukuran_font" style="text-align: center;padding-top: 5px; padding-bottom: 5px; padding-left: 5px;"> Komponen</th> 
           
            <th class="ukuran_font" style="text-align: center;padding-top: 5px; padding-bottom: 5px; padding-left: 5px;">Pelaksana</th> 
            <th class="ukuran_font" style="text-align: center;padding-top: 5px; padding-bottom: 5px; padding-left: 5px;">JO</th>
            <th class="ukuran_font" style="text-align: center;padding-top: 5px; padding-bottom: 5px; padding-left: 5px;">Periode</th> 
            <th class="ukuran_font" style="text-align: center;padding-top: 5px; padding-bottom: 5px; padding-left: 5px;">Lokasi</th>
            <th class="ukuran_font" style="text-align: center;padding-top: 5px; padding-bottom: 5px; padding-left: 5px;">Catatan Pelaksanaan</th>
            <th class="ukuran_font" style="text-align: center;padding-top: 5px; padding-bottom: 5px; padding-left: 5px;">Action</th>
        </tr>
    </thead>
    <tbody>
        @php $no = 1; @endphp
        @if($pelaksanaan->count())
        @foreach($pelaksanaan as $datas) 
            <tr>
                <td class="ukuran_font" style="text-align: center;padding-top: 5px; padding-bottom: 5px; padding-left: 5px;">{{$no}}</td> 
                <td class="ukuran_font accordion-toggle collapsed" id="accordion1" data-toggle="collapse" data-parent="#accordion1" href="#collapse{{$datas->id_pelaksanaan}}" width="250px;" style="text-align: center;padding-top: 5px; padding-bottom: 5px; padding-left: 5px; color: blue" > {{$datas->kode_pemeliharaan}} </td> 
                <td class="ukuran_font">{{$datas->tgl_skedul}}</td>
                <td class="ukuran_font">{{$datas->tgl_pelaksanaan}}</td>
                <td class="ukuran_font" style="text-align: center;padding-top: 5px; padding-bottom: 5px; padding-left: 5px;">{{$datas->komponen}}</td> 
                <td class="ukuran_font" style="text-align: center;padding-top: 5px; padding-bottom: 5px; padding-left: 5px;">{{$datas->nama_pelaksana}}</td>  
                <td class="ukuran_font" style="text-align: center;padding-top: 5px; padding-bottom: 5px; padding-left: 5px;">{{$datas->jo}}</td> 
                <td class="ukuran_font" style="text-align: center;padding-top: 5px; padding-bottom: 5px; padding-left: 5px;">{{$datas->periode}}</td>  
                <td class="ukuran_font" style="text-align: center;padding-top: 5px; padding-bottom: 5px; padding-left: 5px;">{{$datas->nama_lokasi}}</td>
                <td class="ukuran_font">{{$datas->catatan}}</td> 

                <td> 
                    <div class="btn-group">
                        <button type="button" class="btn btn-secondary btn-sm">Pilih</button> 
                        <div class="btn-group">
                          <button type="button" class="btn btn-secondary btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
                          </button>
                          <div class="dropdown-menu">
                          <a class="dropdown-item ukuran_font edit_pelaksanaan" href="#" data-set="edit_pelaksanaan" data-id="{{$datas->id_pelaksanaan}}" data-catatan="{{$datas->catatan}}" data-idpelaksana="{{$datas->id_pelaksana}}" data-idskedul="{{$datas->id}}" data-tglpelaksanaan="{{$datas->tgl_pelaksanaan}}"><i class="fa fa-edit mr-1"></i> Edit</a>

                            <a class="dropdown-item delete_pelaksanaan ukuran_font" data-set="delete_pelaksanaan" data-id="{{$datas->id_pelaksanaan}}" href="#"> <i class="fa fa-cut mr-1"></i> Delete</a>
                           
                          </div>
                        </div>
                    </div> 
                </td> 
            </tr>

            <tr class="hide-table-padding">
                <td></td>
                <td colspan="14">
                    <div id="collapse{{$datas->id_pelaksanaan}}" class="collapse in p-3">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="ukuran_font">Uraian Pemeliharaan :</label>
                                    <p style="font-size: 14px;">   @php
                                        echo $datas->uraian_pemeliharaan;
                                    @endphp</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group"> 
                                    <label class="ukuran_font">Tindakan Pengamanan :</label>
                                    <p style="font-size: 14px;">   @php
                                        echo $datas->tindakan_pengamanan;
                                    @endphp</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group"> 
                                    <label class="ukuran_font">Prosedur :</label>
                                    <p style="font-size: 14px;">   @php
                                       echo $datas->prosedur;
                                    @endphp</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group"> 
                                    <label class="ukuran_font">Alat Kerja :</label>
                                    <p style="font-size: 14px;">   @php
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
                <td colspan="24" align="center" class="ukuran_font"><span class="text-danger">Data pelaksanaan pemeliharaan tidak ditemukan</span></td>
            </tr>
        @endif
    </tbody>
</table>
 
<script>

$('.edit_pelaksanaan').on('click', function(){
       $set = $(this).attr('data-set');
       if ($set == 'edit_pelaksanaan'){

            id                 = $(this).attr('data-id');
            catatan            = $(this).attr('data-catatan');
            idpelaksana        = $(this).attr('data-idpelaksana');
            idskedul           = $(this).attr('data-idskedul');
            tgl_pelaksanaan    = $(this).attr('data-tglpelaksanaan');

            $('#id_skedul').val(idskedul);  
            $('#tgl_pelaksanaan').val(tgl_pelaksanaan);  
            $('#id_pelaksana').val(idpelaksana);  
            $('#catatan').val(catatan);  
            $('#id_pelaksanaan').val(id);  
            $('#modal_pemeliharaan').modal('show');
       }
    });

    $('.delete_pelaksanaan').on('click', function(){
       $set = $(this).attr('data-set');
       if ($set == 'delete_pelaksanaan'){

             id  = $(this).attr('data-id');
             $('#id_hapus').val(id);  
             $('#hapus_data').modal('show');
         
       }
    });

    
</script>