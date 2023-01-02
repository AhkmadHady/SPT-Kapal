<table class="table table-bordered table-hover">
    <thead>
        <tr> 
            <th style="padding-top:5px; padding-left:5px; padding-right:5px; padding-bottom:5px; font-size: 14px">No</th>  
            <th style="padding-top:5px; padding-left:5px; padding-right:5px; padding-bottom:5px; font-size: 14px">Kode Komponen</th> 
            <th style="padding-top:5px; padding-left:5px; padding-right:5px; padding-bottom:5px; font-size: 14px" >Nama Komponen</th> 
            <th style="padding-top:5px; padding-left:5px; padding-right:5px; padding-bottom:5px; font-size: 14px">Keterangan</th>  
            <th style="padding-top:5px; padding-left:5px; padding-right:5px; padding-bottom:5px; width:90px; font-size: 14px">Aksi</th>  

        </tr>
    </thead>
    <tbody>

        @php
            $no = 1;
        @endphp

        @if ($komponen->count())
            @foreach ($komponen as $datas)
                <tr>
                    <td class="ukuran_font" style="padding-top:5px; padding-left:5px; padding-right:5px; padding-bottom:5px; font-size: 14px">{{$no}} </td>  
                    <td class="ukuran_font" style="padding-top:5px; padding-left:5px; padding-right:5px; padding-bottom:5px; font-size: 14px">{{$datas->kdkomponen}}</td>  
                    <td class="ukuran_font" style="padding-top:5px; padding-left:5px; padding-right:5px; padding-bottom:5px; font-size: 14px">{{$datas->nmkomponen}}</td>  
                    <td class="ukuran_font" style="padding-top:5px; padding-left:5px; padding-right:5px; padding-bottom:5px; font-size: 14px">{{$datas->keterangan}}</td>  
                    <td class="ukuran_font" style="padding-top:5px; padding-left:5px; padding-right:5px; padding-bottom:5px; font-size: 14px">
                        <div class="row">
                            <div class="col-sm">
                                <a class="btn btn-block bg-gradient-secondary btn-sm" title="Edit" href="{{route('edit_komponen',$datas->id)}}"><i class="fa fa-edit"></i></a>

                            </div>
                            <div class="col-sm">
                                <a class="btn btn-block bg-gradient-danger btn-sm delete_komponen" href="#" data-set="delete_komponen" title="Delete" data-id="{{$datas->id}}"><i class="fa fa-cut"></i></a> 
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
                    <td colspan="5" align="center"><span class="text-danger">Data komponen tidak ditemukan</span></td>
                </tr>
        @endif 
    </tbody>
</table>

<script>
    $('.delete_komponen').on('click', function(){
       $set = $(this).attr('data-set');
       if ($set == 'delete_komponen'){

             id  = $(this).attr('data-id');
             $('#id_hapus').val(id);  
             $('#hapus_data').modal('show');
         
       }
   });
</script>