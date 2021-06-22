<table class="table table-bordered table-hover">
    <thead>
        <tr> 
            <th style="padding-top:5px; padding-left:5px; padding-right:5px; padding-bottom:5px; font-size: 14px">No</th>  
            <th style="padding-top:5px; padding-left:5px; padding-right:5px; padding-bottom:5px; font-size: 14px">Jenis Perawatan</th>  
            <th style="padding-top:5px; padding-left:5px; padding-right:5px; padding-bottom:5px; font-size: 14px">Keterangan</th>  
            <th style="padding-top:5px; padding-left:5px; padding-right:5px; padding-bottom:5px; width:90px; font-size: 14px">Aksi</th>   
        </tr>
    </thead>
    <tbody> 
        @php
            $no = 1;
        @endphp
        @if ($perawatan->count())
            @foreach ($perawatan as $item)
                <tr>
                    <td>{{$no}}</td>
                    <td>{{$item->janis_perawatan}}</td>
                    <td>{{$item->keterangan}}</td>
                    <td>
                        <div class="row">
                            <div class="col-sm">
                                <a class="btn btn-block bg-gradient-secondary btn-sm" href="{{route('edit_kelompok',$item->id)}}" title="Edit"><i class="fa fa-edit"></i></a>
                            </div>
                            <div class="col-sm">
                                <a class="btn btn-block bg-gradient-danger btn-sm delete_komponen" href="#" data-set="delete_komponen" title="Delete" data-id="{{$item->id}}"><i class="fa fa-cut"></i></a> 
                            </div>
                        </div> 
                    </td>
                </tr>
            @endforeach
        @else 
                <tr>
                    <td colspan="4" class="text-center"><p class="text-danger">Data jenis perawatan tidak ditemukan</p></td>
                </tr>
        @endif
    </tbody>
</table>

<script>
    $('.delete_peratawan').on('click', function(){
       $set = $(this).attr('data-set');
       if ($set == 'delete_peratawan'){

             id  = $(this).attr('data-id');
             $('#id_hapus').val(id);  
             $('#hapus_data').modal('show');
         
       }
    });
</script>