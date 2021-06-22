<table class="table w-auto table-bordered table-hover table-striped">
    <thead>
        <tr>
            <th class="ukuran_font">No</th>  
            <th class="ukuran_font">Kode Pemeliharaan</th>
            <th class="ukuran_font"> Skedul</th>
            <th class="ukuran_font">Pelaksanaan</th> 
            <th class="ukuran_font">Komponen</th>
            <th class="ukuran_font">Pelaksana</th>  
            <th class="ukuran_font">Lokasi</th>
            <th class="ukuran_font">JO</th>
            <th class="ukuran_font">Periode</th>
            <th class="ukuran_font">Jenis&nbsp;Perawatan</th>

            <th class="ukuran_font">Catatan</th> 
        </tr>
    </thead>
    <tbody>
        @php $no = 1; @endphp
        @if($pelaksanaan->count())
        @foreach($pelaksanaan as $datas)
            <tr>
                <td class="ukuran_font">{{$no}}</td>   
                <td class="ukuran_font accordion-toggle collapsed" id="accordion1" data-toggle="collapse" data-parent="#accordion1" href="#collapse{{$datas->id}}" width="250px;" style="text-align: center;padding-top: 5px; padding-bottom: 5px; padding-left: 5px; color: blue" >{{$datas->kode_pemeliharaan}}</td>
                <td class="ukuran_font">{{$datas->tgl_skedul}}</td>
                <td class="ukuran_font">{{$datas->tgl_pelaksanaan}}</td>
                <td class="ukuran_font">{{$datas->komponen}}</td> 
                <td class="ukuran_font">{{$datas->nama_pelaksana}}</td>
                <td class="ukuran_font">{{$datas->nama_lokasi}}</td>
                <td class="ukuran_font">{{$datas->jo}}</td> 
                <td class="ukuran_font">{{$datas->periode}}</td> 
                <td class="ukuran_font">{{$datas->jenis_perawatan}}</td> 
                <td class="ukuran_font">{{$datas->catatan}}</td> 
            </tr>

            <tr class="hide-table-padding">
                <td></td>
                <td colspan="12">
                    <div id="collapse{{$datas->id}}" class="collapse in p-3">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="ukuran_font">Uraian Pemeliharaan :</label>
                                    <p style="font-size: 12px;">   @php
                                        echo $datas->uraian_pemeliharaan;
                                    @endphp</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group"> 
                                    <label class="ukuran_font">Tindakan Pengamanan :</label>
                                    <p style="font-size: 12px;">   @php
                                        echo $datas->tindakan_pengamanan;
                                    @endphp</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group"> 
                                    <label class="ukuran_font">Prosedur :</label>
                                    <p style="font-size: 12px;">   @php
                                       echo $datas->prosedur;
                                    @endphp</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group"> 
                                    <label class="ukuran_font">Alat Kerja :</label>
                                    <p style="font-size: 12px;">   @php
                                       echo $datas->alat_kerja;
                                     @endphp</p>
                                </div>
                            </div>
                        </div> 
                    </div>
                </td>
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