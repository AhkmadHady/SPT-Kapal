<table class="table table-bordered table-hover">
    <thead>
        <tr> 
            <th style="padding-top:5px; padding-left:5px; padding-right:5px; padding-bottom:5px; font-size: 14px">No</th>  
            <th style="padding-top:5px; padding-left:5px; padding-right:5px; padding-bottom:5px; font-size: 14px">Kode Sub-Kelompok</th> 
            <th style="padding-top:5px; padding-left:5px; padding-right:5px; padding-bottom:5px; font-size: 14px" >Nama Sub-Kelompok</th> 
            <th style="padding-top:5px; padding-left:5px; padding-right:5px; padding-bottom:5px; font-size: 14px">Keterangan</th>  
            <th style="padding-top:5px; padding-left:5px; padding-right:5px; padding-bottom:5px; width:90px; font-size: 14px">Aksi</th>   
        </tr>
    </thead>
    <tbody>

        @php
            $no = 1;
        @endphp

        @if ($data_subkelompok->count())
            @foreach ($data_subkelompok as $datas)
                <tr>
                    <td style="padding-top:5px; padding-left:5px; padding-right:5px; padding-bottom:5px; font-size: 14px">{{$no}} </td>  
                    <td style="padding-top:5px; padding-left:5px; padding-right:5px; padding-bottom:5px; font-size: 14px">{{$datas->kode_sub_pokok}}</td>  
                    <td style="padding-top:5px; padding-left:5px; padding-right:5px; padding-bottom:5px; font-size: 14px">{{$datas->nama_sub_pokok}}</td>  
                    <td style="padding-top:5px; padding-left:5px; padding-right:5px; padding-bottom:5px; font-size: 14px">{{$datas->keterangan}}</td>  
                    <td style="padding-top:5px; padding-left:5px; padding-right:5px; padding-bottom:5px; font-size: 14px">
                        <div class="row">
                            <div class="col-sm">
                                <a class="btn btn-block bg-gradient-secondary btn-sm" href="{{route('edit_subkelompok',$datas->id)}}" title="Edit"><i class="fa fa-edit"></i> </a>
                            </div>
                            <div class="col-sm">
                                <a class="btn btn-block bg-gradient-danger btn-sm delete_subkelompok" href="#" data-set="delete_subkelompok" title="Delete" data-id="{{$datas->id}}"><i class="fa fa-cut"></i></a> 
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
                    <td colspan="5" align="center"><span class="text-danger">Data sub-kelompok tidak ditemukan</span></td>
                </tr>
        @endif 
    </tbody>
</table>

<script>
     $('.delete_subkelompok').on('click', function(){
       $set = $(this).attr('data-set');
       if ($set == 'delete_subkelompok'){

             id  = $(this).attr('data-id');
             $('#id_hapus').val(id);  
             $('#hapus_data').modal('show');
         
       }
   });
</script>