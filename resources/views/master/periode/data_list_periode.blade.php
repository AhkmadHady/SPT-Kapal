<table class="table table-bordered table-hover">
    <thead>
        <tr> 
            <th style="padding-top:5px; padding-left:5px; padding-right:5px; padding-bottom:5px; font-size: 14px">No</th>  
            <th style="padding-top:5px; padding-left:5px; padding-right:5px; padding-bottom:5px; font-size: 14px">Periode</th> 
            <th style="padding-top:5px; padding-left:5px; padding-right:5px; padding-bottom:5px; font-size: 14px" >Rumus (Hari)</th> 
            <th style="padding-top:5px; padding-left:5px; padding-right:5px; padding-bottom:5px; font-size: 14px">Keterangan</th>  
            <th style="padding-top:5px; padding-left:5px; padding-right:5px; padding-bottom:5px; width:88px; font-size: 14px">Aksi</th>  
        </tr>
    </thead>
    <tbody> 
        @php
            $no = 1;
        @endphp

        @if ($periode->count())
            @foreach ($periode as $datas)
                <tr>
                    <td class="ukuran_font" style="padding-top:5px; padding-left:5px; padding-right:5px; padding-bottom:5px; font-size: 14px">{{$no}} </td>  
                    <td class="ukuran_font" style="padding-top:5px; padding-left:5px; padding-right:5px; padding-bottom:5px; font-size: 14px">{{$datas->periode}}</td>  
                    <td class="ukuran_font" style="padding-top:5px; padding-left:5px; padding-right:5px; padding-bottom:5px; font-size: 14px">{{$datas->rumus}}</td>  
                    <td class="ukuran_font" style="padding-top:5px; padding-left:5px; padding-right:5px; padding-bottom:5px; font-size: 14px">{{$datas->keterangan}}</td>  
                    <td class="ukuran_font" style="padding-top:5px; padding-left:5px; padding-right:5px; padding-bottom:5px; font-size: 14px; width: 100px"> 
                        <div class="row">
                            <div class="col-sm">
                                <a class="btn btn-block bg-gradient-secondary btn-sm" title="Edit" href="{{route('edit_periode',$datas->id)}}"><i class="fa fa-edit"></i></a>

                            </div>
                            <div class="col-sm">
                                <a class="btn btn-block bg-gradient-danger btn-sm delete_periode" title="Delete" href="#" data-set="delete_periode" data-id="{{$datas->id}}"><i class="fa fa-cut"></i></a>
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
                    <td colspan="5" align="center"><span class="text-danger">Data periode tidak ditemukan</span></td>
                </tr>
        @endif 
    </tbody>
</table>
<script>
    $('.delete_periode').on('click', function(){
       $set = $(this).attr('data-set');
       if ($set == 'delete_periode'){

             id  = $(this).attr('data-id');
             $('#id_hapus').val(id);  
             $('#hapus_data').modal('show');
         
       }
    });
</script>