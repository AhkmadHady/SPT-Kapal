<table class="table table-bordered table-hover">
    <thead>
        <tr> 
            <th style="padding-top:5px; padding-left:5px; padding-right:5px; padding-bottom:5px; font-size: 14px">No</th>  
            <th style="padding-top:5px; padding-left:5px; padding-right:5px; padding-bottom:5px; font-size: 14px">Pelaksana</th>  
            <th style="padding-top:5px; padding-left:5px; padding-right:5px; padding-bottom:5px; font-size: 14px">Keterangan</th>  
            <th style="padding-top:5px; padding-left:5px; padding-right:5px; padding-bottom:5px; width:90px; font-size: 14px">Aksi</th>   
        </tr>
    </thead>
    <tbody> 
        @php
            $no = 1;
        @endphp 
        @if ($pelaksana->count())
            @foreach ($pelaksana as $datas)
                <tr>
                    <td style="padding-top:5px; padding-left:5px; padding-right:5px; padding-bottom:5px; font-size: 14px">{{$no}} </td>  
                    <td style="padding-top:5px; padding-left:5px; padding-right:5px; padding-bottom:5px; font-size: 14px">{{$datas->nama_pelaksana}}</td>    
                    <td style="padding-top:5px; padding-left:5px; padding-right:5px; padding-bottom:5px; font-size: 14px">{{$datas->keterangan}}</td>  
                    <td style="padding-top:5px; padding-left:5px; padding-right:5px; padding-bottom:5px; font-size: 14px; width: 100px">
                        <div class="row">
                            <div class="col-sm">
                                <a class="btn btn-block bg-gradient-secondary btn-sm" title="Edit" href="{{route('edit_pelaksana',$datas->id)}}"><i class="fa fa-edit"></i> </a>
                            </div>
                            <div class="col-sm">
                                <a class="btn btn-block bg-gradient-danger btn-sm delete_pelaksana" href="#" data-set="delete_pelaksana" title="Delete" data-id="{{$datas->id}}"><i class="fa fa-cut"></i></a>
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
                    <td colspan="5" align="center">
                        <span class="text-danger">Data pelaksanan tidak ditemukan</span>
                    </td>
                </tr>
        @endif 
    </tbody>
</table>

<script>
    $('.delete_pelaksana').on('click', function(){
       $set = $(this).attr('data-set');
       if ($set == 'delete_pelaksana'){

             id  = $(this).attr('data-id');
             $('#id_hapus').val(id);  
             $('#hapus_data').modal('show');
         
       }
    });
</script>