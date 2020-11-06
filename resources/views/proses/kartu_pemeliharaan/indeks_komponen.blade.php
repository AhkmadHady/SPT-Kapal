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
        <div class="card card-outline card-info">
            <div class="card-header">
                <h5> Indeks Komponen </h5> 
            </div> 
            <div class="card-body pad"> 
                <div class="mb-3 ukuran_font">
                    <span><span class="" style="background-color: #2CCFDD;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span> &nbsp;&nbsp;&nbsp; Kelompok</span>
                      &nbsp;&nbsp;&nbsp;
                     <span><span class="" style="background-color: #FA7A7B;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span> &nbsp;&nbsp;&nbsp; Sub Kelompok</span>
                      &nbsp;&nbsp;&nbsp;
                     <span><span class="" style="background-color: #7BA3F1;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span> &nbsp;&nbsp;&nbsp; Sistem</span>
                       &nbsp;&nbsp;&nbsp;
                     <span><span class="" style="background-color: #6DE3A8;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span> &nbsp;&nbsp;&nbsp; Sub Sistem</span>
                     &nbsp;&nbsp;&nbsp;
                     <span><span class="" style="background-color: #566D86;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span> &nbsp;&nbsp;&nbsp; Komponen</span>
                </div>
                <div class="table-responsive" id="tabel_kelompok">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                
                                <th class="ukuran_font">Kode Peralatan</th>
                                <th class="ukuran_font">Kelompok/SubPok/Sistem/SubSistem/Komponen</th>
                                <th class="ukuran_font">Lokasi</th>
                            </tr>
                        </thead>
                        <tbody>
                           
                            @foreach($data_kelompok as $datas_komponen)
                                <!-- kelompok -->
                                <tr>
                                     
                                    <td class="ukuran_font"><span class="text-info">{{$datas_komponen->kode_pokok}}</span></td>
                                    <td class="ukuran_font"><span class="text-info">{{$datas_komponen->nama_pokok}}</span></td>
                                    <td class="ukuran_font"></td>
                                </tr>
                                @php $sub_pok = indeksSubKelompok($datas_komponen->id_komponen_pokok);
                                     
                                @endphp

                                 @foreach($sub_pok as $datas_subpok)
                                 <!-- sub kelompok -->
                                    <tr>
                                         
                                        <td class="ukuran_font"><span class="text-danger">{{$datas_subpok->kode_sub_pokok}}</span></td>
                                        <td class="ukuran_font"><span class="text-danger">{{$datas_subpok->nama_sub_pokok}}</span></td>
                                        <td class="ukuran_font"></td>
                                    </tr>

                                     @php $sistem_kom = indeksSistem($datas_subpok->id_komponen_sub_pokok); 
                                         
                                     @endphp

                                     @foreach($sistem_kom as $datas_sistem)
                                        <!-- sistem -->
                                        <tr>
                                             
                                            <td class="ukuran_font"><span class="text-primary">{{$datas_sistem->kode_komponen_sistem}}</span></td>
                                            <td class="ukuran_font"><span class="text-primary">{{$datas_sistem->nama_komponen_sistem}}</span></td>
                                            <td class="ukuran_font"></td>
                                        </tr>

                                        @php $subsistem = indeksSubSistem($datas_sistem->id_sistem);
                                            
                                        @endphp

                                        @foreach($subsistem as $datas_subsistem)
                                            <!-- sub sistem -->
                                            <tr> 
                                                <td class="ukuran_font"><span class="text-success">{{$datas_subsistem->kode_komponen_sub_sistem}}</span></td>
                                                <td class="ukuran_font"><span class="text-success">{{$datas_subsistem->nama_komponen_sub_sistem}}</span></td>
                                                <td class="ukuran_font"></td>
                                            </tr> 
                                            @php $komponen = indeksKomponen($datas_subsistem->id_sub_sistem); 
                                            @endphp
                                            @foreach($komponen as $datas) 
                                                    <tr>
                                                        <td class="ukuran_font"><span >{{$datas->kode_pemeliharaan}}</span></td>
                                                        <td class="ukuran_font"><span>{{$datas->komponen}}</span></td>
                                                        <td class="ukuran_font"><span>{{$datas->nama_lokasi}}</span></td>
                                                    </tr> 
                                            @endforeach 
                                              
                                        @endforeach
                                        
                                    @endforeach  
                                     
                                 @endforeach  
                                 
                            @endforeach
                        </tbody>
                    </table>
                </div> 
            </div>
        </div>
    </div> 
</div>  
@endsection
@push('script')
<script type="text/javascript">
    
</script>
@endpush
