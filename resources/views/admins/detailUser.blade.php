@extends('admin')
@section('admin')
   <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <a href="/admin/users" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"> Kembali</a>

        </div>
    
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Detail {{$title}}</h6>
            </div>
            <div class="card-body">

                @if ($title === "Pegawai")
                    
                <table class="table">
                    <tbody>
                        <tr>
                            <td scope="row">Nama</td>
                            <td style="min-width : 300px">: {{$User->name}}</td>
                         
                        </tr>
                        <tr>
                            <td scope="row">NIP</td>
                            <td>: {{$User->nip}}</td>
                           
                        </tr>
                        <tr>
                            <td scope="row">Unit Kerja</td>
                            <td>: {{$User->unit_kerja}}</td>
                           
                        </tr>
                        <tr>
                            <td scope="row">Jabatan</td>
                            <td>: {{$User->jabatan}}</td>
                           
                        </tr>
                        <tr>
                            <td scope="row">E-mail</td>
                            <td>: {{$User->email}}</td>
                           
                        </tr>
                        <tr>
                            <td scope="row">No Telpon</td>
                            <td>: {{ $User->phone}}</td>
                       
                        </tr>
                        <tr>
                            <td scope="row">Pengguna Sejak</td>
                            <td>: {{ Carbon\Carbon::parse($User->created_at)->translatedFormat('l, d-m-Y h:i')}}</td>
                           
                        </tr>
                        <tr>
                            <td scope="row">Perubahan Terakhir</td>
                            <td>: {{ Carbon\Carbon::parse($User->updated_at)->translatedFormat('l, d-m-Y h:i')}}</td>
                           
                        </tr>
                        <tr>
                            <td scope="row">Status</td>
                            <td>: {{$User->status}}</td>
                           
                        </tr>
                  
                    </tbody>
                </table>

                <div align="right">
                <?php

                if($User['status'] === 'Suspend'){
                    ?> 
                    <a name="" id="" class="btn btn-success mb-1" href="/admin/users/aktifkan/{{$User['id']}}" role="button">Aktifkan</a> <?php
                
                }else {
                    ?> 
                       <a name="" id="" class="btn btn-danger mb-1" href="/admin/users/suspend/{{$User['id']}}" role="button">Suspend</a>

                     <?php
                }
            ?>
        </div>
                @else
                <table class="table">
                    <tbody>
                        <tr>
                            <td scope="row">Nama</td>
                            <td style="min-width : 300px">: {{$User->name}}</td>
                         
                        </tr>
                        <tr>
                            <td scope="row">NIP</td>
                            <td>: {{$User->nip}}</td>
                           
                        </tr>
                        <tr>
                            <td scope="row">Unit Kerja</td>
                            <td>: {{$unit->name}}</td>
                           
                        </tr>
                        <tr>
                            <td scope="row">Jabatan</td>
                            <td>: {{$User->jabatan}}</td>
                           
                        </tr>
                        <tr>
                            <td scope="row">E-mail</td>
                            <td>: {{$User->email}}</td>
                           
                        </tr>
                        <tr>
                            <td scope="row">No Telpon</td>
                            <td>: {{ $User->phone}}</td>
                       
                        </tr>
                        <tr>
                            <td scope="row">Pengguna Sejak</td>
                            <td>: {{ Carbon\Carbon::parse($User->created_at)->translatedFormat('l, d-m-Y h:i')}}</td>
                           
                        </tr>
                        <tr>
                            <td scope="row">Perubahan Terakhir</td>
                            <td>: {{ Carbon\Carbon::parse($User->updated_at)->translatedFormat('l, d-m-Y h:i')}}</td>
                           
                        </tr>
                      
                  
                    </tbody>
                </table>
                <div align="right">
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete{{$User['id']}}">
                    Hapus
                </button>
                </div>

                  <!-- Modal -->
                  <div class="modal fade" id="delete{{$User['id']}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Hapus User</h5>
                        
                        </div>
                        <div class="modal-body">
                            
                            Anda akan menghapus user dengan data : <br>
                            <strong>
                            Nama   &nbsp;: {{$User['name']}} <br>
                            NIP    &ensp;: {{$User['nip']}} <br>
                            E-mail &nbsp;: {{$User['email']}} <br>
                        </strong>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <a name="" id="" class="btn btn-danger" href="users/hapus/{{$User['id']}}" role="button">Hapus Data</a>
                        </div>
                        </div>
                    </div>
                </div>
                         
                @endif

            </div>
        </div>
    </div>
@endsection