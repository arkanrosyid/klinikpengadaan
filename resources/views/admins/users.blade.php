@extends('admin')

@section('css')

    <!-- Custom styles for this page -->
  
@endsection

@section('admin')



<div class="container-fluid">

    @if (session('delete'))
    <div class="alert alert-success" role="alert">
        {{session('delete')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
      </div>
    @endif
    @if (session('success'))
    <div class="alert alert-success" role="alert">
        {{session('success')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
      </div>
    @endif

   

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Pegawai</h6>
        </div>
        <div class="card-body">

            <div align="right">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#exampleModal">
                Tambah Pegawai
                </button>
            </div>
  
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Tambah Data Pegawai</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="" method="post">
                @csrf
                <div class="form-group">
                  <label for="">Nama</label>
                  <input type="text"
                    class="form-control" name="nama" id="" aria-describedby="helpId" placeholder="">
                  <small id="helpId" class="form-text text-muted">Help text</small>
                </div>
                <div class="form-group">
                  <label for="">NIP</label>
                  <input type="text"
                    class="form-control" name="nip" id="" aria-describedby="helpId" placeholder="">
                  <small id="helpId" class="form-text text-muted">Help text</small>
                </div>
                <div class="form-group">
                  <label for="">Jabatan</label>
                  <input type="text"
                    class="form-control" name="jabatan" id="" aria-describedby="helpId" placeholder="">
                  <small id="helpId" class="form-text text-muted">Help text</small>
                </div>
                <div class="form-group">
                  <label for="">No Telpon</label>
                  <input type="text"
                    class="form-control" name="phone" id="" aria-describedby="helpId" placeholder="">
                  <small id="helpId" class="form-text text-muted">Help text</small>
                </div>
                <div class="form-group">
                  <label for="">E-mail</label>
                  <input type="text"
                    class="form-control" name="email" id="" aria-describedby="helpId" placeholder="">
                  <small id="helpId" class="form-text text-muted">Help text</small>
                </div>
                

            
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
       <button type="submit" class="btn btn-primary">Save</button>
        </form>
        </div>
      </div>
    </div>
  </div>
            
            <div class="table-responsive" width="80%">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                           
                            <th>Name</th>
                            <th>NIP</th>
                            <th>Email</th>
                            <th>Pengguna Sejak</th>
                            <th>Status </th>
                            <th>Aksi</th>
                        
                        
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            
                            <th>Name</th>
                            <th>NIP</th>
                            <th>Email</th>
                            <th>Pengguna Sejak</th>
                            <th>Status </th>
                            <th>Aksi</th>
                        
                        
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php $n = 1;?>
                        @foreach ($data2 as $employee)
                        
                        <tr>
                            <td>{{$n}}</td>
                            
                            <td>{{$employee['name']}}</td>
                            <td>{{$employee['nip']}}</td>
                            <td>{{$employee['email']}}</td>
                            <td>{{Carbon\Carbon::parse($employee['created_at'])->translatedFormat('l, d-m-Y h:i')}}</td>
                            <td>{{$employee['status']}}</td>
                            <td>
                                <a name="" id="" class="btn btn-info mb-1" href="pegawai/detail/{{$employee['id']}}" role="button">Detail</a>

                                <?php

                                    if($employee['status'] === 'Suspend'){
                                        ?> 
                                        <a name="" id="" class="btn btn-success mb-1" href="/admin/users/aktifkan/{{$employee['id']}}" role="button">Aktifkan</a> <?php
                                    
                                    }else {
                                        ?> 
                                           <a name="" id="" class="btn btn-danger mb-1" href="/admin/users/suspend/{{$employee['id']}}" role="button">Suspend</a>

                                         <?php
                                    }
                                ?>

                               
                             
                            </td>
                        </tr>
                            
                        <?php $n++ ;?>
                        @endforeach
        
        
                    
                    
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data User</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive" width="80%">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>NIP</th>
                            <th>Email</th>
                            <th>Pengguna Sejak</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        
                        
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                        
                            <th>Name</th>
                            <th>NIP</th>
                            <th>Email</th>
                            <th>Pengguna Sejak</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        
                        
                        </tr>
                    </tfoot>
                    <tbody>
        
                 
                             
                        <?php $n =1 ;?>
                        @foreach ($data as $users)
        
                        <tr>
                            <td>{{$n}}</td>
                            
                            <td>{{$users['name']}}</td>
                            <td>{{$users['nip']}}</td>
                            <td>{{$users['email']}}</td>
                            <td>{{Carbon\Carbon::parse($users['created_at'])->translatedFormat('l, d-m-Y h:i')}}</td>
                            <td>Aktif</td>
                            <td>
                                <a name="" id="" class="btn btn-info " href="users/detail/{{$users['id']}}" role="button">Detail</a>
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete{{$users['id']}}">
                                    Hapus
                                </button>
                               
                            </td>
                        </tr>

                        <!-- Modal -->
                        <div class="modal fade" id="delete{{$users['id']}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                
                                </div>
                                <div class="modal-body">
                                    
                                    Anda akan menghapus user dengan data : <br>
                                    <strong>
                                    Nama   &nbsp;: {{$users['name']}} <br>
                                    NIP    &ensp;: {{$users['nip']}} <br>
                                    E-mail &nbsp;: {{$users['email']}} <br>
                                </strong>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <a name="" id="" class="btn btn-danger" href="users/hapus/{{$users['id']}}" role="button">Hapus Data</a>
                                </div>
                                </div>
                            </div>
                        </div>
                                 
                        <?php $n++ ;?>
                        @endforeach
        
                    
                    
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

@endsection

@section('script')

    
@endsection


