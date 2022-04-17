@extends('admin')
@section('admin')

<style>
    .borderless table {
    border-top-style: none;
    border-left-style: none;
    border-right-style: none;
    border-bottom-style: none;
}
</style>
<?php 
use App\Models\User;
use App\Models\Employee;
?>
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <a href="/admin/laporan" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"> Kembali</a>

    </div>
  
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Detail Laporan</h6>
        </div>
        <div class="card-body">
            <table class="table 
           table-borderless 
            ">
                <tbody>
                    <tr>
                        <td scope="row" >Dibuat Pada </td>
                        <td>: {{Carbon\Carbon::parse($Konsul->created_at)->format('l, d-m-Y')}}</td>
                     
                    </tr>
                    <tr>
                        <td scope="row">Tema </td>
                        <td>: {{$Konsul->tema}}</td>
                     
                    </tr>
                    <tr>
                        <td scope="row">Pertanyaan</td>
                        <td>: 
                        <div class="ml-2">{!!$Konsul->pertanyaan!!}</div></td>
                        
                    </tr>
                    <tr>
                        <td colspan="2">Pihak yang meminta konsultasi : </td>
                    </tr>
                    <tr>
                        <td scope="row">Nama</td>
                        <td>: {{$User->name}}</td>
                        
                    </tr>
                    <tr>
                        <td scope="row">Unit Kerja</td>
                        <td>: {{$Konsul->unit_kerja}}</td>
                        
                    </tr>
                    <tr>
                        <td scope="row">Jabatan</td>
                        <td>: {{$Konsul->jabatan}} </td>
                        
                    </tr>
                    <tr>
                        <td colspan="2">Pihak yang memberikan konsultasi : </td>
                    </tr>
                    <tr>
                        <td scope="row">Nama</td>
                        <td>:  
                             @if (!empty($Pegawai))
                            {{$Pegawai->name}}
                            @endif
                        </td>
                        
                    </tr>
                    <tr>
                        <td scope="row">Unit Kerja</td>
                        <td>: 
                            @if (!empty($Pegawai))
                                {{$Konsul->unit_employee}}
                            @endif
                        </td>
                        
                    </tr>
                    <tr>
                        <td scope="row">Jabatan</td>
                        <td>:
                            @if (!empty($Pegawai))  
                            {{$Konsul->jabatan_employee}}
                            @endif</td>
                        
                    </tr>

                    <tr>
                        <td colspan="2">Hasil Tanya Jawab :</td>
                    </tr>
                    <tr>
                        <table class="table ">
                            <thead>
                                <tr>
                                    <th style="
                                    width: 300px;
                                        ">Waktu</th>
                                    <th>Pengirim</th>
                                    <th>Tanya Jawab</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($Posts as $post)
                                    
                               
                                <tr>
                                    <td scope="row">{{Carbon\Carbon::parse($post->created_at)->format('l, d-m-Y H:i')}}</td>
                                    <td>
                                        @if ($post->created_by === "Employee")
                                            
                                            <?php 
                                            $emp= Employee::find($post->id_user);
                                            ?>
                                            Pegawai : {{$emp->name}}
                                            @else
                                             
                                            <?php 
                                            $usr = User::find($post->id_user);
                                            ?>
                                            Pengguna : {{$User->name}}
                                        @endif
                                    </td>
                                    <td style="min-width :300px; width : 650px">
                                        {!!$post->pertanyaan!!}
                                    </td>
                                </tr>
                                @endforeach
                             
                            </tbody>
                        </table>
                    </tr>

                </tbody>
            </table>     

          
    </div>


</div>


@endsection

