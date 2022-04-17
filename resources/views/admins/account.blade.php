@extends('admin')
@section('admin')
<div class="container-fluid">
    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{session('success')}}
        </div>
    @endif
       <!-- Basic Card Example -->
       <div class="card shadow mb-4 m-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Profil Admin</h6>
        </div>
        <div class="card-body">
            <table class="table">
                <tbody>
                    <tr>
                        <td scope="row">Nama</td>
                        <td style="min-width: 300px">: {{ Auth::guard('admin')->user()->name}}</td>
                   
                    </tr>
                    <tr>
                        <td scope="row">E-mail</td>
                        <td>: {{ Auth::guard('admin')->user()->email}}</td>
                   
                    </tr>
                    <tr>
                        <td scope="row">Tanggal Buat</td>
                        <td>: {{ Carbon\Carbon::parse(Auth::guard('admin')->user()->created_at)
                        ->format('l, d-m-Y H:i:s')}}</td>
                   
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