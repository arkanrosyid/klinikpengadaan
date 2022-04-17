@extends('employee')
@section('employee')
<?php 
use App\Models\User;
?>
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Konsultasi Aktif</h6>
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

                <h5  class="m-0 font-weight-bold text-primary"> <a href="/konsultasi/{{$id}}">  {{$tema}} </a></h5>
                   
                    <small>{{$created}}</small>
                    <p class="m-0 font-weight-bold text-primary"><small>by : </small> {{ User::find($idUser)->name }}</p>
                    <p>{{$pertanyaan}}</p>
                    <hr>
                 
             @endforeach
           
        </div>
    </div>
   

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-success">Konsultasi Selesai</h6>
        </div>
        <div class="card-body">
       
            @foreach ($selesai as $item)
               <?php
               $id      = $item->id;
                $tema  = $item->tema;
                $created = $item->created_at;
                $pertanyaan = $item->pertanyaan;
                $idUser = $item->id_user;
                ?>

                <h5  class="m-0 font-weight-bold text-primary"> <a href="/konsultasi/{{$id}}">  {{$tema}} </a></h5>
                   
                    <small>{{$created}}</small>
                    <p class="m-0 font-weight-bold text-primary"><small>by : </small> {{ User::find($idUser)->name }}</p>
                    <p>{{$pertanyaan}}</p>
                    <hr>
                 
             @endforeach
           
        </div>
    </div>

  
</div>
@endsection