@php
    header("Content-type: application/vnd-ms-excel");
    header("Content-Disposition: attachment; filename=laporan_pelaksanaan.xls");

@endphp 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <table class="table w-auto table-bordered table-hover table-striped">
        <thead>
            <tr>
                <th class="ukuran_font">No</th>  
                <th class="ukuran_font">Kode Pemeliharaan</th>
                <th class="ukuran_font">Tanggal Skedul</th>
                <th class="ukuran_font">Tanggal Pelaksanaan</th> 
                <th class="ukuran_font">Nama Komponen</th>
                <th class="ukuran_font">Pelaksana</th>  
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
                    <td class="ukuran_font">{{$datas->kode_pemeliharaan}}</td>
                    <td class="ukuran_font">{{$datas->tgl_skedul}}</td>
                    <td class="ukuran_font">{{$datas->tgl_pelaksanaan}}</td>
                    <td class="ukuran_font">{{$datas->komponen}}</td> 
                    <td class="ukuran_font">{{$datas->nama_pelaksana}}</td>
                    <td class="ukuran_font">{{$datas->nama_lokasi}}</td>
                    <td class="ukuran_font">{{$datas->jo}}</td> 
                    <td class="ukuran_font">{{$datas->periode}}</td> 
                    <td class="ukuran_font">{{$datas->catatan}}</td> 
                </tr> 
            @php $no ++; @endphp
            @endforeach 
            @else 
                <tr>
                    <td colspan="23" align="center" class="ukuran_font"><span class="text-danger">Data pelaksanaan pemeliharaan tidak ditemukan</span></td>
                </tr>
            @endif
        </tbody>
    </table>
</body>
</html>