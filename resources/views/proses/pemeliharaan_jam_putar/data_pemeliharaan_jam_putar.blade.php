<table class="table table-bordered table-hover">
    <thead>
        <tr class="tabel_header"> 
            <th>No</th>  
            <th>Tgl Pemeliharaan</th> 
            <th>Jenis Perawatan</th> 
            <th>Nama Komponen</th> 
            <th>Pelaksana</th>   
            <th>Catatan</th>
            <th style="padding-top:5px; padding-left:5px; padding-right:5px; padding-bottom:5px; width:110px; font-size: 14px">Aksi</th>   
        </tr>
    </thead>
    <tbody>

        @php
            $no = 1;
        @endphp

        @if ($pemeliharaan->count())
            @foreach ($pemeliharaan as $datas)
                <tr class="tabel_header">
                    <td>{{$no}} </td>  
                    <td>{{$datas->tgl_pemeliharaan}}</td>  
                    <td>{{$datas->jenis_perawatan}}</td>  
                    <td>{{$datas->komponen}}</td>  
                    <td>{{$datas->nama_pelaksana}}</td>   
                    <td>
                         @if ($datas->rumus < 1)
                         <span>Jumlah Putaran : {{$datas->jml_putaran}} </span>
                         <br> 
                         @endif
                        
                         <span>
                             {{$datas->catatan}}
                         </span>
                    </td>  
                    <td>
                        <div class="row">
                            <div class="col-sm">
                                <a class="btn btn-block bg-gradient-secondary btn-sm" href="{{route('edit_jam_putar',$datas->id)}}" title="Edit"><i class="fa fa-edit"></i></a>
                            </div>
                            <div class="col-sm">
                                <a class="btn btn-block bg-gradient-danger btn-sm delete_kerusakan" href="#" data-set="delete_kerusakan" title="Delete" data-id="{{$datas->id}}"><i class="fa fa-cut"></i></a> 
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
                    <td colspan="8" align="center"><span class="text-danger">Data pemeliharaan tidak terencana tidak ditemukan</span></td>
                </tr>
        @endif 
    </tbody>
</table>

<script>
    $('.delete_kerusakan').on('click', function(){
       $set = $(this).attr('data-set');
       if ($set == 'delete_kerusakan'){ 
             id  = $(this).attr('data-id');
             $('#id_hapus').val(id);  
             $('#hapus_data').modal('show');
       }
    });
</script>