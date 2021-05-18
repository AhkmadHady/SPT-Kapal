<table class="table table-bordered table-hover">
    <thead>
        <tr> 
            <th style="padding-top:5px; padding-left:5px; padding-right:5px; padding-bottom:5px; font-size: 14px">No</th>  
            <th style="padding-top:5px; padding-left:5px; padding-right:5px; padding-bottom:5px; font-size: 14px">Tgl Kerusakan</th> 
            <th style="padding-top:5px; padding-left:5px; padding-right:5px; padding-bottom:5px; font-size: 14px" >Komponen</th> 
            <th style="padding-top:5px; padding-left:5px; padding-right:5px; padding-bottom:5px; font-size: 14px">Pelaksana</th>  
            <th style="padding-top:5px; padding-left:5px; padding-right:5px; padding-bottom:5px; font-size: 14px">Detail Kerusakan</th>  
            <th style="padding-top:5px; padding-left:5px; padding-right:5px; padding-bottom:5px; width:90px; font-size: 14px">Aksi</th>   
        </tr>
    </thead>
    <tbody>

        @php
            $no = 1;
        @endphp

        @if ($kerusakan->count())
            @foreach ($kerusakan as $datas)
                <tr>
                    <td style="padding-top:5px; padding-left:5px; padding-right:5px; padding-bottom:5px; font-size: 14px">{{$no}} </td>  
                    <td style="padding-top:5px; padding-left:5px; padding-right:5px; padding-bottom:5px; font-size: 14px">{{$datas->tgl_kerusakan}}</td>  
                    <td style="padding-top:5px; padding-left:5px; padding-right:5px; padding-bottom:5px; font-size: 14px">{{$datas->komponen}}</td>  
                    <td style="padding-top:5px; padding-left:5px; padding-right:5px; padding-bottom:5px; font-size: 14px">{{$datas->nama_pelaksana}}</td>  
                    <td style="padding-top:5px; padding-left:5px; padding-right:5px; padding-bottom:5px; font-size: 14px">{{$datas->detail_kerusakan}}</td>  
                    <td style="padding-top:5px; padding-left:5px; padding-right:5px; padding-bottom:5px; font-size: 14px">
                        <div class="row">
                            <div class="col-sm">
                            <a class="btn btn-block bg-gradient-secondary btn-sm" href="{{route('edit_kerusakan',$datas->id)}}" title="Edit"><i class="fa fa-edit"></i></a>
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
                    <td colspan="6" align="center"><span class="text-danger">Data kerusakan tidak ditemukan</span></td>
                </tr>
        @endif 
    </tbody>
</table>