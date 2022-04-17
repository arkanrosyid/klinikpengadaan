@extends('admin')

@section('admin')

<?php 
    use App\Models\User;
    use App\Models\Employee;
?>
<div class="container-fluid">

    @if (session('reset'))
    <div class="alert alert-success" role="alert">
        {{session('reset')}}
      </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Laporan Konsultasi</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive" width="80%">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>User</th>
                            <th>NIP</th>
                            <th>Tema</th>
                            <th>Employee</th>
                            <th>NIP </th>
                            <th>Action</th>
                        
                        
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Date</th>
                            <th>User</th>
                            <th>NIP</th>
                            <th>Tema</th>
                            <th>Employee</th>
                            <th>NIP </th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>

                        @foreach ($laporan as $item)
                            <tr>
                                <?php
                                    $user = User::find($item['id_user']);      
                                ?>
                                <th> {{Carbon\Carbon::parse($item['created_at'])->format('l, d-m-Y')}} </th>
                                <th> {{$user['name']}}</th>
                                <th> {{$user['nip']}}</th>
                                <th>{{$item['tema']}}</th>

                                @if (isset($item['id_employee']))
                                <?php 
                                 $emp = Employee::find($item['id_employee']);
                                ?>

                                <th> {{$emp['name']}} </th>
                                <th> {{$emp['nip']}} </th>

                                @else
                                    <th>-</th>
                                    <th>-</th>
                                @endif
                                
                              <th>
                                  <a name="" id="" class="btn btn-info mb-1" href="laporan/{{$item['id']}}" role="button">Detail</a>
                                  
                                  @if ($item['status']==="Aktif" || $item['status']==="Tatap Muka" )
                                  <button type="button" class="btn btn-danger mb-1" data-bs-toggle="modal" data-bs-target="#reset{{$item['id']}}">
                                    Reset
                                  </button>
                                  @endif
                                 
                              </th>

                              <!-- Modal -->
                                <div class="modal fade" id="reset{{$item['id']}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                    
                                        </div>
                                        <div class="modal-body">
                                        Anda akan melepaskan hubungan antara pegawai dan laporan terkait dengan data pegawai : <br>
                                        @if (isset($item['id_employee']))
                                        <?php 
                                         $emp = Employee::find($item['id_employee']);
                                        ?>
                                        
                                        <strong>
        
                                         Nama &nbsp;: {{$emp['name']}} <br>
                                         NIP &emsp; : {{$emp['nip']}} 
                                        </strong>
                                        @else
                                        Nama &nbsp; : -  <br>
                                        NIP &emsp;  : -
                                        @endif


                                        </div>
                                        <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <a name="" id="" class="btn btn-danger" href="laporan/reset/{{$item['id']}}" role="button"> Reset</a>
                                      
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </tr>
                        @endforeach

                    </tbody>
        </div>
    </div>
@endsection