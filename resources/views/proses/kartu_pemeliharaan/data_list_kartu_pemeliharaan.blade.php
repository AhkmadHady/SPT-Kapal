<table class="table w-auto table-bordered table-hover table-striped">
    <thead>
        <tr>
            <th class="ukuran_font" style="text-align: center;padding-top: 5px; padding-bottom: 5px; padding-left: 5px;">No</th> 
            <th class="ukuran_font" style="text-align: center;padding-top: 5px; padding-bottom: 5px; padding-left: 5px;">Cetak</th> 
            <th class="ukuran_font" style="text-align: center;padding-top: 5px; padding-bottom: 5px; padding-left: 5px;" >Kode Kartu</th>
            <th class="ukuran_font" style="text-align: center;padding-top: 5px; padding-bottom: 5px; padding-left: 5px;"> Komponen</th> 
            <th class="ukuran_font" style="text-align: center;padding-top: 5px; padding-bottom: 5px; padding-left: 5px;">Pelaksana</th>
            <th class="ukuran_font" style="text-align: center;padding-top: 5px; padding-bottom: 5px; padding-left: 5px;">JO</th>
            <th class="ukuran_font" style="text-align: center;padding-top: 5px; padding-bottom: 5px; padding-left: 5px;">Periode</th> 
            <th class="ukuran_font" style="text-align: center;padding-top: 5px; padding-bottom: 5px; padding-left: 5px;">Lokasi</th>
            <th class="ukuran_font" style="text-align: center;padding-top: 5px; padding-bottom: 5px; padding-left: 5px;">Action</th>
        </tr>
    </thead>
    <tbody>
        @php $no = 1; @endphp
        @if($pemeliharaan->count())
        @foreach($pemeliharaan as $datas)
            @php
                $count_data = countKodePemeliharaan($datas->kode_pemeliharaan);
            @endphp
            <tr>
                <td class="ukuran_font" style="text-align: center;padding-top: 5px; padding-bottom: 5px; padding-left: 5px;">{{$no}}</td> 
                <td class="ukuran_font" style="text-align: center;padding-top: 5px; padding-bottom: 5px; padding-left: 5px;">
                    <a class="dropdown-item ukuran_font" target="_blank" href="{{route('print_kartu_pemeliharaan',$datas->id)}}"><i class="fa fa-print mr-1"></i> Cetak</a>
                </td>   

                <td class="ukuran_font accordion-toggle collapsed" id="accordion1" data-toggle="collapse" data-parent="#accordion1" href="#collapse{{$datas->id}}" width="250px;" style="text-align: center;padding-top: 5px; padding-bottom: 5px; padding-left: 5px; color: blue" > {{$datas->kode_pemeliharaan}} </td> 

                <td class="ukuran_font" style="text-align: center;padding-top: 5px; padding-bottom: 5px; padding-left: 5px;">
                    @if ($count_data <1)
                        <span class="text-success">{{$datas->komponen}}</span>
                    @else 
                        <span>{{$datas->komponen}}</span>
                    @endif 
                </td> 

                <td class="ukuran_font" style="text-align: center;padding-top: 5px; padding-bottom: 5px; padding-left: 5px;">{{$datas->nama_pelaksana}}</td>  

                <td class="ukuran_font" style="text-align: center;padding-top: 5px; padding-bottom: 5px; padding-left: 5px;">{{$datas->jo}}</td> 

                <td class="ukuran_font" style="text-align: center;padding-top: 5px; padding-bottom: 5px; padding-left: 5px;">{{$datas->periode}}</td>  

                <td class="ukuran_font" style="text-align: center;padding-top: 5px; padding-bottom: 5px; padding-left: 5px;">{{$datas->nama_lokasi}}</td>

                <td> 
                    <div class="btn-group">
                        <button type="button" class="btn btn-secondary btn-sm">Pilih</button> 
                        <div class="btn-group">
                          <button type="button" class="btn btn-secondary btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
                          </button>
                          <div class="dropdown-menu">
                            <a class="dropdown-item ukuran_font" href="{{route('edit_kartu_pemeliharaan',$datas->id)}}"><i class="fa fa-edit mr-1"></i> Edit</a>

                            <a class="dropdown-item delete_pemeliharaan ukuran_font" data-set="delete_pemeliharaan" data-id="{{$datas->id}}" href="#"> <i class="fa fa-cut mr-1"></i> Delete</a>

                            <a class="dropdown-item ukuran_font" target="_blank" href="{{route('print_kartu_pemeliharaan',$datas->id)}}"><i class="fa fa-print mr-1"></i> Cetak</a>
 
                            @if ($count_data < 1)
                                @if($datas->rumus > 0)
                                <a class="dropdown-item ukuran_font generate_skedul" href="#" data-set="generate_skedul" data-kode="{{$datas->kode_pemeliharaan}}" data-tgl="{{$datas->tgl_mulai}}"><i class="fa fa-retweet mr-1"></i> Generate</a>
                                @else

                                @endif
                            @endif
                          </div>
                        </div>
                    </div> 
                </td> 
            </tr>
            <tr class="hide-table-padding">
                <td></td>
                <td colspan="12">
                    <div id="collapse{{$datas->id}}" class="collapse in p-3">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="ukuran_font">Uraian Pemeliharaan :</label>
                                     @php
                                        echo $datas->uraian_pemeliharaan;
                                    @endphp
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group"> 
                                    <label class="ukuran_font">Tindakan Pengamanan :</label>
                                    @php
                                        echo $datas->tindakan_pengamanan;
                                    @endphp
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group"> 
                                    <label class="ukuran_font">Prosedur :</label>
                                    @php
                                       echo $datas->prosedur;
                                    @endphp
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group"> 
                                    <label class="ukuran_font">Alat Kerja :</label>
                                    @php
                                       echo $datas->alat_kerja;
                                    @endphp
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
                <td colspan="12" align="center" class="ukuran_font"><span class="text-danger">Data kartu pemeliharaan tidak ditemukan</span></td>
            </tr>
        @endif
    </tbody>
</table>
<script>
    $('.delete_pemeliharaan').on('click', function(){
       $set = $(this).attr('data-set');
       if ($set == 'delete_pemeliharaan'){

             id  = $(this).attr('data-id');
             $('#id_hapus').val(id);  
             $('#hapus_data').modal('show');
       }
   });

   $('.generate_skedul').on('click', function(){
       $set = $(this).attr('data-set');
       if ($set == 'generate_skedul'){

             kode  = $(this).attr('data-kode');
             tgl  = $(this).attr('data-tgl');
             $('#kode_pemeliharaan').val(kode);  
             $('#tgl_mulai').val(tgl);  
             $('#generate_data').modal('show');
       }
   });
</script>