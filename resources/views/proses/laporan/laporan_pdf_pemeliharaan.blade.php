<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Pelaksanaan Pemeliharaan</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('assets/gambar/logo_tni_al.ico')}}">
</head>
<style type="text/css">
    html {margin: 0;padding: 0;}
    body {
    margin: 0.4cm;
    padding: 0;
    font-family:"Times New Roman", Times, serif;
    text-rendering: optimizeLegibility;
    font-size: 12px;
    color:#333;
    }

    table {
    width:100%;
    border-collapse: collapse;
    margin: 0;
    padding: 0;
    }

    table, th, td {
    border: 1px solid black;
    }
</style>
<body>
    <div class="head">
        <h5>Laporan Pelaksanaan Pemeliharaan</h5>
        <h5>Tanggal : {{$tgl1}} s/d {{$tgl2}}</h5>
    </div>

    <div class="body">
        <table>
            <thead>
                <tr>
                    <th class="ukuran_font">No</th>  
                    <th class="ukuran_font">Kode Pemeliharaan</th>
                    <th class="ukuran_font">Tgl Skedul</th>
                    <th class="ukuran_font">Tgl Pelaksanaan</th> 
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
    </div> 
</body>
</html>