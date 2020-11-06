<table class="table w-auto table-bordered table-hover table-striped">
    <thead>
        <tr>
            <th class="ukuran_font">No</th> 
            <th class="ukuran_font">Action</th>
            <th class="ukuran_font">Kode Pemeliharaan</th>
            <th class="ukuran_font">Tanggal Skedul</th>
            <th class="ukuran_font">Tanggal Pelaksanaan</th> 
            <th class="ukuran_font">Nama Komponen</th>
            <th class="ukuran_font">Uraian Pemeliharaan</th>
            <th class="ukuran_font">Kode Kartu</th>
            <th class="ukuran_font">Kode Kelompok</th>
            <th class="ukuran_font">Nama Kelompok</th>
            <th class="ukuran_font">Kode Sub-Kelompok</th>
            <th class="ukuran_font">Nama Sub-Kelompok</th>
            <th class="ukuran_font">Kode Sistem</th>
            <th class="ukuran_font">Nama Sistem</th>
            <th class="ukuran_font">Kode Sub-Sistem</th>
            <th class="ukuran_font">Nama Sub-Sistem</th>
            <th class="ukuran_font">Pelaksana</th>
            <th class="ukuran_font">Tindakan Pengamanan</th>
            <th class="ukuran_font">Alat Kerja</th>
            <th class="ukuran_font">Prosedur</th>
            <th class="ukuran_font">Lokasi</th>
            <th class="ukuran_font">JO</th>
            <th class="ukuran_font">Periode</th>
            <th class="ukuran_font">Catatan Pelaksanaan</th> 
        </tr>
    </thead>
    <tbody>
        @php $no = 1; @endphp
        @if($pelaksanaan->count())
        @foreach($pelaksanaan as $datas)
            <tr>
                <td class="ukuran_font">{{$no}}</td>  
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
                <td class="ukuran_font">{{$datas->kode_pemeliharaan}}</td>
                <td class="ukuran_font">{{$datas->tgl_skedul}}</td>
                <td class="ukuran_font">{{$datas->tgl_pelaksanaan}}</td>
                <td class="ukuran_font">{{$datas->komponen}}</td>
                <td class="ukuran_font">  
                    @php
                        echo $datas->uraian_pemeliharaan;
                    @endphp
                </td>
                <td class="ukuran_font" width="250px;">{{$datas->kode_pemeliharaan}}</td>
                <td class="ukuran_font">{{$datas->kode_pokok}}</td>
                <td class="ukuran_font">{{$datas->nama_pokok}}</td>
                <td class="ukuran_font">{{$datas->kode_sub_pokok}}</td>
                <td class="ukuran_font">{{$datas->nama_sub_pokok}}</td> 
                <td class="ukuran_font">{{$datas->kode_komponen_sistem}}</td>
                <td class="ukuran_font">{{$datas->nama_komponen_sistem}}</td>
                <td class="ukuran_font">{{$datas->kode_komponen_sub_sistem}}</td>
                <td class="ukuran_font">{{$datas->nama_komponen_sub_sistem}}</td> 
                <td class="ukuran_font">{{$datas->nama_pelaksana}}</td> 
                <td class="ukuran_font"> 
                    @php
                        echo $datas->tindakan_pengamanan;
                    @endphp
                </td>
                <td class="ukuran_font"> 
                    @php
                        echo $datas->alat_kerja;
                    @endphp
                </td>
                <td class="ukuran_font"> 
                    @php
                        echo $datas->prosedur;
                    @endphp
                </td>
                <td class="ukuran_font">{{$datas->nama_lokasi}}</td>
                <td class="ukuran_font">{{$datas->jo}}</td> 
                <td class="ukuran_font">{{$datas->periode}}</td> 
                <td class="ukuran_font">{{$datas->catatan}}</td> 
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