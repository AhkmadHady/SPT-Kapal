@extends('layouts.apps')
@section('content')

<div class="row mt-3">
    <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
            <div class="row">
                <div class="col-md-8">
                    <h3> &nbsp; {{$komponen}}</h3> 
                    <p>&nbsp; Kerusakan</p>
                </div>
                <div class="col-md-4">
                    <img src="{{asset('assets/gambar/electric-motor.png')}}" width="100%"> 
                </div>
            </div>
        <a href="{{route('kerusakan')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div> 

    <div class="col-lg-3 col-6"> 
        <div class="small-box bg-danger">
            <div class="row">
                <div class="col-md-8">
                    <h3> &nbsp; {{$autstanding}}</h3> 
                    <p>&nbsp; Outstanding Skedul</p>
                </div>
                <div class="col-md-4">
                    <img src="{{asset('assets/gambar/plan.png')}}" width="100%"> 
                </div>
            </div>
        <a href="{{route('skedul')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div> 

    <div class="col-lg-3 col-6">  
        <div class="small-box bg-warning">
            <div class="row">
                <div class="col-md-8">
                    <h3> &nbsp; {{$skedul2}}</h3> 
                    <p>&nbsp; Skedul</p>
                </div>
                <div class="col-md-4">
                    <img src="{{asset('assets/gambar/calendar.png')}}" width="100%"> 
                </div>
            </div>
        <a href="{{route('skedul')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div> 

    <div class="col-lg-3 col-6"> 
        <div class="small-box bg-success">
            <div class="row">
                <div class="col-md-8">
                    <h3> &nbsp; {{$pelaksanaan}}</h3> 
                    <p>&nbsp; Pelaksanaan</p>
                </div>
                <div class="col-md-4">
                    <img src="{{asset('assets/gambar/gear.png')}}" width="100%"> 
                </div>
            </div>
        <a href="{{route('pelaksanaan')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>  
</div>  

<div class="row">
    <div class="col-md-12">
        <div class="col-md-12 mt-4">
            <div class="card card-outline card-info">
                <div class="card-header">
                    <h5> Kalender Skedul Pemeliharaan </h5> 
                </div> 
                <div class="card-body pad"> 
                  
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
</div>
@endsection