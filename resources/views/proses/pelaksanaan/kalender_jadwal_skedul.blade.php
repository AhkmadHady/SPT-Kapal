@extends('layouts.apps') 
@section('content')
@if (session('info'))
<div class="alert alert-success alert-dismissible mb-2 mt-3" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    <div class="d-flex align-items-center">
        <i class="bx bx-like"></i>
        <span>
          {{ session('info') }}
        </span>
    </div>
</div>
@endif
<div class="row"> 
    <div class="col-md-12 mt-4">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="home-tab"  href="{{route('kalender_skedul')}}" role="tab" aria-controls="home" aria-selected="true">Kalender Pemeliharaan</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="profile-tab"  href="{{route('skedul')}}" role="tab" aria-controls="profile" aria-selected="false">Daftar Jadwal Pemeliharaan</a>
            </li> 
            <li class="nav-item">
                <a class="nav-link" id="profile-tab"  href="{{route('pelaksanaan')}}" role="tab" aria-controls="profile" aria-selected="false">Daftar Pelaksanaan Pemeliharaan</a>
              </li> 
        </ul>
        <div class="card card-outline card-info mt-3">
            <div class="card-header">
                <h5> Kalender Pemeliharaan </h5> 
            </div> 
            <div class="card-body pad">  
                <div class="pencarian mt-3">
                    <form method="POST" action="{{route('get_jadwal_skedul')}}">
                        @csrf
                    
                    <div class="row">  
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="ukuran_font" for="username">Bulan</label>
                                <select class="form-control ukuran_font select2" name="bulan">
                                    <option value="<?php echo date('m'); ?>">
                                        <?php 
                                            $bulan = date('m');
                                            if ($bulan =='01') {
                                              echo "Januari";
                                            }else if ($bulan =='02') {
                                              echo "Februari";
                                            }else if ($bulan == '03') {
                                               echo "Maret";
                                            }else if ($bulan == '04') {
                                                echo "April";
                                            }else if ($bulan == '05') {
                                                echo "Mei";
                                            }else if ($bulan == '06') {
                                               echo "Juni";
                                            }else if ($bulan == '07') {
                                               echo "Juli";
                                            }else if ($bulan == '08') {
                                               echo "Agustus";
                                            }else if ($bulan == '09') {
                                              
                                            }
                                        ?>
                                    </option>
                                    <option value="01">Januari</option>
                                    <option value="02">Februari</option>
                                    <option value="03">Maret</option>
                                    <option value="04">April</option>
                                    <option value="05">Mei</option>
                                    <option value="06">Juni</option>
                                    <option value="07">Juli</option>
                                    <option value="08">Agustus</option>
                                    <option value="09">September</option>
                                    <option value="10">Oktober</option>
                                    <option value="11">November</option>
                                    <option value="12">Desember</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="ukuran_font" for="username">Tahun</label>
                                <input type="text" name="tahun" id="tahun" class="form-control ukuran_font" value="{{date('Y')}}">
                            </div>
                        </div>
                        <div class="col-md-4" style="margin-top: 32px;">
                            <button class="btn btn-block bg-gradient-info btn-sm" type="submit" style="width: 130px;"> <i class="fa fa-search"></i> Cari </button>
                        </div>
                    </div>
                    </form>
                </div>
                <div class="table-responsive" id="tabel_kelompok">
                        <?php 


                        if($bulan_ =='' OR $tahun_ ==''){
                            $hari   = date("d");
                            $bulan  = date ("m");
                            $tahun  = date("Y");

                        }else{
                            $hari   = date("d");
                            $bulan  = $bulan_;
                            $tahun  = $tahun_;

                        }
                        
                        $jumlahhari=date("t",mktime(0,0,0,$bulan,$hari,$tahun));
                        $bulan_tahun = $tahun."-".$bulan;
                        $dateNow = date('Y-m-d');
                    ?>
                    <table class="table nowrap table-bordered table-hover" >
                        <tr>
                            <td style="padding-top:5px; padding-left:5px; padding-right:5px; padding-bottom:5px; font-size: 14px" colspan="4" align="center"> <strong>
                                @if($bulan == "01")
                                    Januari
                                @elseif($bulan == "02")
                                    Februari
                                @elseif($bulan =="03")
                                    Maret
                                @elseif($bulan == "04")
                                    April
                                @elseif($bulan == "05")
                                    Mei
                                @elseif($bulan == "06")
                                    Juni
                                @elseif($bulan == "07")
                                    Juli
                                @elseif($bulan == "08")
                                    Agustus
                                @elseif($bulan == "09")
                                    September
                                @elseif($bulan == "10")
                                    Oktober
                                @elseif($bulan == "11")
                                    November
                                @elseif($bulan == "12")
                                    Desember
                                @endif
                            </strong>
                            </td>
                        <td style="padding-top:5px; padding-left:5px; padding-right:5px; padding-bottom:5px; font-size: 14px" colspan="3" align="center"> <strong> {{$tahun}} </strong></td>
                        </tr>
                    <tr bgcolor="#ADD8E6">
                        <td style="padding-top:5px; padding-left:5px; padding-right:5px; padding-bottom:5px; font-size: 14px" align=center> <strong> Minggu </strong></td>
                        <td style="padding-top:5px; padding-left:5px; padding-right:5px; padding-bottom:5px; font-size: 14px" align=center> <strong> Senin </strong></td>
                        <td style="padding-top:5px; padding-left:5px; padding-right:5px; padding-bottom:5px; font-size: 14px" align=center> <strong> Selasa </strong></td>
                        <td style="padding-top:5px; padding-left:5px; padding-right:5px; padding-bottom:5px; font-size: 14px" align=center> <strong> Rabu </strong></td>
                        <td style="padding-top:5px; padding-left:5px; padding-right:5px; padding-bottom:5px; font-size: 14px" align=center> <strong> Kamis </strong></td>
                        <td style="padding-top:5px; padding-left:5px; padding-right:5px; padding-bottom:5px; font-size: 14px" align=center> <strong> Jumat </strong></td>
                        <td style="padding-top:5px; padding-left:5px; padding-right:5px; padding-bottom:5px; font-size: 14px" align=center> <strong> Sabtu </strong></td>
                    </tr>

                        @php
                            $s = date ("w", mktime (0,0,0,$bulan,1,$tahun));
                        @endphp

                        @for ($ds=1;$ds<=$s;$ds++) 
                            <td></td>
                        @endfor

                        @for($d=1;$d<=$jumlahhari;$d++)
                            @if (date("w",mktime (0,0,0,$bulan,$d,$tahun)) == 0)
                                <tr>
                            @endif

                            @if ($dateNow == $bulan_tahun."$d")
                                @php
                                    $warna_bk = "#FDC3C3;"
                                @endphp
                            @else
                                @php
                                    $warna_bk = ""
                                @endphp
                            @endif

                            <td align=center valign="middle" style="background:<?php 
                                $tgl_now = date('d');

                                if ($tgl_now == $d) {
                                echo "#D1F9FC;";
                                }else{
                                    echo "";
                                }
                                $tanggal = $tahun.'-'.$bulan.'-'.$d;  
                            ?>"> 
                                <a class="btn btn-outline-info btn-sm" style="background-color: ;" href="{{route('get_komponen_skedul',$tanggal)}}" style="color: #000000;"> 
                                    <?php 

                                    
                                    $jumlah_kom = jumlahpemeliharaan($tanggal); 

                                    ?>
                                    @if ($jumlah_kom > 0)
                                        <span class="badge badge-danger badge-pill badge-round ml-1">{{$jumlah_kom}}</span>
                                    @endif
                                    <span style="font-size: 12px;"> {{$d}}</span> 
                                </a>  
                            </td>

                            @if(date("w",mktime (0,0,0,$bulan,$d,$tahun)) == 6) 
                            </tr>
                            @endif
                        @endfor
                </table>   
                </div> 
            </div>
        </div>
    </div> 
</div>   
@endsection
@push('script')
 
@endpush
