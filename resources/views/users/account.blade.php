@extends('home')
@section('user')
<div class="container-fluid">
    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{session('success')}}
        </div>
    @endif
    
       <!-- Basic Card Example -->
       <div class="card shadow mb-4 m-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Profil User</h6>
        </div>
        <div class="card-body">
            <table class="table">
                <tbody>
                    <tr>
                        <td scope="row">Nama</td>
                        <td style="min-width: 300px">: {{ $Data->name}}</td>
                   
                    </tr>
                    <tr>
                        <td scope="row">NIP</td>
                        <td style="min-width: 300px">: {{ $Data->nip}}</td>
                   
                    </tr>
                    <tr>
                        <td scope="row">Unit Kerja</td>
                        <td style="min-width: 300px">: {{ $unit->name}}</td>
                   
                    </tr>
                    <tr>
                        <td scope="row">Jabatan</td>
                        <td style="min-width: 300px">: {{ $Data->jabatan}}</td>
                   
                    </tr>
                    <tr>
                        <td scope="row">E-mail</td>
                        <td>: {{ $Data->email}}</td>
                   
                    </tr>
                    <tr>
                        <td scope="row">No Telpon</td>
                        <td>: {{ $Data->phone}}</td>
                   
                    </tr>
                
                    <tr>
                        <td scope="row">Tanggal Buat</td>
                        <td>: {{ Carbon\Carbon::parse($Data->created_at)
                        ->translatedFormat('l, d-m-Y H:i:s')}}</td>
                   
                    </tr>

                    <tr>
                        <td scope="row">Terakhir Update</td>
                        <td>: {{ Carbon\Carbon::parse($Data->updated_at)
                        ->translatedFormat('l, d-m-Y H:i:s')}}</td>
                   
                    </tr>
                </tbody>

                
            </table>
            <div align="right">
                <a name="" id="" class="btn btn-info" href="account/edit" role="button">Edit Profil</a>
            </div>
        </div>
    </div>
</div>

@endsection