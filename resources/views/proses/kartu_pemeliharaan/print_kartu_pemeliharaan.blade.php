<!DOCTYPE html>
<html>
<head>
	<link rel="shortcut icon" type="image/x-icon" href="{{asset('assets/gambar/logo_tni_al.ico')}}">
	<title>SPT Kapal</title>

<style type="text/css">
    /* NOTA */
html {margin: 0;padding: 0;}
body {
  margin: 0.4cm;
  padding: 0;
  font-family:"Times New Roman", Times, serif;
  text-rendering: optimizeLegibility;
  font-size: 15px;
  color:#333;
}

.headerImage { height:1cm; }

#mainpage {display:block;width:100%;}
#mainpage > div { margin-bottom:4px; }

.col5 { width:5%!important; }
.col10 { width:10%!important; }
.col15 { width:15%!important; }
.col20 { width:20%!important; }
.col25 { width:25%!important; }
.col30 { width:30%!important; }
.col45 { width:45%!important; }
.col50 { width:300px!important; }
.col55 { width:55%!important; }
.col60 { width:60%!important; }

small { font-size:10px; }

h1, h2, h3, h4, h5 { margin:0;padding:0;text-transform:uppercase; }
h1 { font-size: 16px!important; }

.center { text-align:center; }
.right { text-align:right; }

.note { font-size:16px; }
.arial { font-family:Arial, "Helvetica", sans-serif; }
.odd {
    background-color: #EFF4F9;
}

/*table-style*/
table {
  width:100%;
    border-collapse: collapse;
  margin: 0;
  padding: 0;
}
.po-list td.signature { text-align:left;padding-top:10px;padding-bottom:10px; }
table > tbody { font-family:Arial, "Helvetica", sans-serif;font-size:13px; }
table > tbody > td { padding-top:6px;padding-bottom:6px; }

table.rows-list {
  border:1px solid #555555;
}
table.rows-list thead {
  border-bottom:1px solid #555555;
}
table.rows-list th {
  padding:3px;
  font-size:12px;
  text-transform:uppercase;
}
table.rows-list td {
    font-weight: normal;
    padding:3px;
    color: #444;
}
table.rows-list th,
table.rows-list td {border-right:1px solid #555555;}

/* PO table */
table.po-list { border:1; }
table.po-list th,
table.po-list td {
  padding:3px;
  border-width:1px 1px 1px 1px;
  border-style:solid;
  border-color:#555555;
  font-size:12px!important;
  font-family:Arial, "Helvetica", sans-serif!important;
  vertical-align:top;
}
td.notop { border-top:0!important; }
td.nobottom { border-bottom:0!important; }
td.noright { border-right:0!important; }
td.noleft { border-left:0!important; }
td.bbottom { border-bottom:1px solid #555555!important; }
td.bright { border-right:1px solid #555555!important; }
td.bleft { border-right:1px solid #555555!important; }
td.btop { border-right:1px solid #555555!important; }
td > small { font-size:10px; }

table.po-list > tbody > tr + tr {border-bottom:1px solid #555555;}
td.white { border-bottom:0!important; }

.signature { float:left;text-align:center; }
.signature > .title { font-weight:bold;text-transform:uppercase;margin-bottom:50px; }
.signature > span:before { content: "(";padding-right:10px; }
.signature > span:after { content: ")";padding-left:10px; }

td.iso { padding:0!important; }
table.iso { float:left;border:1px solid #555555; }
table.iso td { padding:0 3px;font-size:10px; }

.poContent { float:left;border:1px solid #555555; }
</style>
</head>
<body>
	<div class="container" style="margin-left: 10px">
		<div class="header" id="header">
			
		</div>
		<div class="body" id="body">
			<div class="header" align="center">
				<h5>KARTU PEMELIHARAAN</h5>
				<h5>{{ Auth::user()->kapal }}</h5>
			</div>
			<div class="tabel">
				<table class="po-list" border="1">
				<tbody>
				<tr>
					<td ><strong>SISTEM</strong></td>
					<td><strong>KOMPONEN</strong></td>
					<td colspan="2" class="bright"><strong>KODE KP</strong></td>
				</tr>
				<tr>
					<td>{{$pemeliharaan->nama_komponen_sistem}}</td>
					<td>{{$pemeliharaan->komponen}}</td>
					<td colspan="2">{{$pemeliharaan->kode_pemeliharaan}}</td>
				</tr>
				<tr>
					<td><strong>SUB SISTEM</strong></td>
					<td><strong>WAKTU</strong></td>
					<td><strong>PELAKSANA</strong></td>
					<td>&nbsp;<strong>J.O</strong></td>
				</tr>
				<tr>
					<td>{{$pemeliharaan->nama_komponen_sub_sistem}}</td>
				<td>{{$pemeliharaan->ket_periode}}</td>
					<td>{{$pemeliharaan->nama_pelaksana}}</td>
					<td>{{$pemeliharaan->jo}}</td>
				</tr>
				<tr>
					<td colspan="4" style="background-color: #F9F6E4"><strong>URAIAN PEMELIHARAAN</strong></td>
				</tr>
				<tr>
					<td colspan="4" height="110px"><?php echo $pemeliharaan->uraian_pemeliharaan; ?></td>
				</tr>
				<tr>
					<td colspan="4" style="background-color: #F9F6E4"><strong>TINDAKAN PENGAMANAN</strong></td>
				</tr>
				<tr>
					<td colspan="4" height="45px"><?php echo $pemeliharaan->tindakan_pengamanan; ?></td>
				</tr>
				<tr>
					<td colspan="4" style="background-color: #F9F6E4"><strong>ALAT ALAT KERJA, SUCAD,MAT,ALAT UKUR</strong></td>
				</tr>
				<tr >
					<td colspan="4" height="45px"><?php echo $pemeliharaan->alat_kerja; ?></td>
				</tr>
				<tr>
					<td colspan="4" style="background-color: #F9F6E4"><strong>PROSEDUR</strong></td>
				</tr>
				<tr>
					<td colspan="4" height="235px"><?php echo $pemeliharaan->prosedur; ?></td>
				</tr >
				<tr class="bbottom">
					<td style="background-color: #F9F6E4" colspan="3"><strong>LOKASI</strong></td>
					<td style="background-color: #F9F6E4" class="bright"><strong>TANGGAL</strong></td>
				</tr>
				<tr>
					<td colspan="3" class="bbottom bright">{{$pemeliharaan->nama_lokasi}}</td>
					<td class="bbottom bright"></td>
				</tr>
				</tbody>
			</table>
			</div> 
		</div>		
	</div>
</body>
</html>