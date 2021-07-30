<table class="table table-bordered table-hover">
    <thead>
        <tr> 
            <th style="padding-top:5px; padding-left:5px; padding-right:5px; padding-bottom:5px; font-size: 14px">No</th>  
            <th style="padding-top:5px; padding-left:5px; padding-right:5px; padding-bottom:5px; font-size: 14px">Tanggal Jadwal Pemeliharaan</th> 
            <th style="padding-top:5px; padding-left:5px; padding-right:5px; padding-bottom:5px; font-size: 14px" >Kode Pemeliharaan</th> 
            <th style="padding-top:5px; padding-left:5px; padding-right:5px; padding-bottom:5px; font-size: 14px">Komponen</th>  
            <th style="padding-top:5px; padding-left:5px; padding-right:5px; padding-bottom:5px; font-size: 14px">Lokasi</th>  
            <th style="padding-top:5px; padding-left:5px; padding-right:5px; padding-bottom:5px; font-size: 14px">Status</th>  
            <th style="padding-top:5px; padding-left:5px; padding-right:5px; padding-bottom:5px; width:90px; font-size: 14px">Aksi</th>   
        </tr>
    </thead>
    <tbody>

        @php
            $no = 1;
        @endphp

        @if ($skedul->count())
            @foreach ($skedul as $datas)
                <tr>
                    <td style="padding-top:5px; padding-left:5px; padding-right:5px; padding-bottom:5px; font-size: 14px">{{$no}} </td>  
                    <td style="padding-top:5px; padding-left:5px; padding-right:5px; padding-bottom:5px; font-size: 14px">{{$datas->tgl_skedul}}</td>  
                    <td style="padding-top:5px; padding-left:5px; padding-right:5px; padding-bottom:5px; font-size: 14px">{{$datas->kode_pemeliharaan}}</td>  
                    <td style="padding-top:5px; padding-left:5px; padding-right:5px; padding-bottom:5px; font-size: 14px">{{$datas->komponen}}</td> 
                    <td style="padding-top:5px; padding-left:5px; padding-right:5px; padding-bottom:5px; font-size: 14px">{{$datas->nama_lokasi}}</td>  
                    <td style="padding-top:5px; padding-left:5px; padding-right:5px; padding-bottom:5px; font-size: 14px">
                    @if ($datas->status ==0)
                       <span class="text-success"> <strong> Aktif </strong></span>
                      
                    @else 
                         <span class="text-danger"> <strong> Tidak Aktif </strong></span>
                    @endif
                    </td>  
                    <td style="padding-top:5px; padding-left:5px; padding-right:5px; padding-bottom:5px; font-size: 14px">
                        <a class="btn btn-block bg-gradient-secondary btn-sm edit_skedul" href="#" data-set="edit_skedul" data-id="{{$datas->id}}" data-tgl="{{$datas->tgl_skedul}}"><i class="fa fa-edit"></i> edit</a>
                    

                        <a class="btn btn-block bg-gradient-danger btn-sm delete_skedul" href="#" data-set="delete_skedul" data-id="{{$datas->id}}"><i class="fa fa-cut"></i> delete</a>
                    </td>  
                </tr>
                @php
                    $no ++;
                @endphp
            @endforeach
        @else 
                <tr>
                    <td colspan="7" align="center"><span class="text-danger">Data skedul pemeliharaan tidak ditemukan</span></td>
                </tr>
        @endif 
    </tbody>
</table>
 
<script>
    $('.delete_skedul').on('click', function(){
       $set = $(this).attr('data-set');
       if ($set == 'delete_skedul'){

             id  = $(this).attr('data-id');
             $('#id_hapus').val(id);  
             $('#hapus_data').modal('show');
         
       }
    });

    $('.edit_skedul').on('click', function(){
       $set = $(this).attr('data-set');
       if ($set == 'edit_skedul'){

             id  = $(this).attr('data-id');
             tgl  = $(this).attr('data-tgl');

             $('#id_skedul').val(id);  
             $('#tgl_skedul_lama').val(tgl);
             $('#modal_edit').modal('show');

       }
    });
</script>