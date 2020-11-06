<table class="table table-bordered table-hover">
    <thead>
        <tr> 
            <th style="padding-top:5px; padding-left:5px; padding-right:5px; padding-bottom:5px; font-size: 14px">No</th>  
            <th style="padding-top:5px; padding-left:5px; padding-right:5px; padding-bottom:5px; font-size: 14px">Kode Kelompok</th> 
            <th style="padding-top:5px; padding-left:5px; padding-right:5px; padding-bottom:5px; font-size: 14px" >Nama Kelompok</th> 
            <th style="padding-top:5px; padding-left:5px; padding-right:5px; padding-bottom:5px; font-size: 14px">Keterangan</th>  
            <th style="padding-top:5px; padding-left:5px; padding-right:5px; padding-bottom:5px; width:90px; font-size: 14px">Aksi</th>  

        </tr>
    </thead>
    <tbody>

        @php
            $no = 1;
        @endphp

        @if ($kelompok->count())
            @foreach ($kelompok as $datas)
                <tr>
                    <td style="padding-top:5px; padding-left:5px; padding-right:5px; padding-bottom:5px; font-size: 14px">{{$no}}</td>  
                    <td style="padding-top:5px; padding-left:5px; padding-right:5px; padding-bottom:5px; font-size: 14px">{{$datas->kode_pokok}}</td>  
                    <td style="padding-top:5px; padding-left:5px; padding-right:5px; padding-bottom:5px; font-size: 14px">{{$datas->nama_pokok}}</td>  
                    <td style="padding-top:5px; padding-left:5px; padding-right:5px; padding-bottom:5px; font-size: 14px">{{$datas->keterangan}}</td>  
                    <td style="padding-top:5px; padding-left:5px; padding-right:5px; padding-bottom:5px; font-size: 14px">
                        <div class="row">
                            <div class="col-sm">
                                <a class="btn btn-block bg-gradient-secondary btn-sm" href="{{route('edit_kelompok',$datas->id)}}" title="Edit"><i class="fa fa-edit"></i></a>
                            </div>
                            <div class="col-sm">
                                <a class="btn btn-block bg-gradient-danger btn-sm delete_komponen" href="#" data-set="delete_komponen" title="Delete" data-id="{{$datas->id}}"><i class="fa fa-cut"></i></a> 
                            </div>
                        </div> 
                    </td>  
                </tr>
            @endforeach
        @else 
                <tr>
                    <td colspan="5" align="center"><span class="text-danger">Data kelompok tidak ditemukan</span></td>
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