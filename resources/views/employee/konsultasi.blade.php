@extends('employee')
@section('employee')
<?php 
use App\Models\User;
?>



<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Konsultasi Baru</h6>
        </div>
        <div class="card-body">
       
            @foreach ($konsultasi as $item)
               <?php
               $id      = $item->id;
                $tema  = $item->tema;
                $created = $item->created_at;
                $pertanyaan = $item->pertanyaan;
                $idUser = $item->id_user;
                ?>

                <!-- Modal -->
            <div class="modal fade" id="tanggapi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tanggapi Pengajuan Konsultasi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                        <strong>
                        Anda akan menanggapi konsultasi ini!
                    </strong> <br>
                        Jika anda menanggapi konsultasi ini, maka hanya anda yang dapat mengakses sesi konsultasi ini!

                        <form action="/konsultasi/{{$id}}" method="POST">
                            @csrf
                        
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success " >Tanggapi</button>
                </form>
                    </div>
                </div>
                </div>
            </div>

                <div class="row">
                    <div class="col">
                        <h5  class="m-0 font-weight-bold text-primary">{{$tema}}</h5>
                    </div>
                    <div class="col">
                        <div align="right">

                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tanggapi">
                                Tanggapi
                            </button>
                           
                        </div>
                        
                    </div>
                </div>
                
                   
                    <small>{{$created}}</small>
                    <p class="m-0 font-weight-bold text-primary"><small>by : </small> {{ User::find($idUser)->name }}</p>
                    <p>{!!$pertanyaan!!}</p>
                    <hr>
                 
             @endforeach
           
        </div>
    </div>

  
</div>
@endsection