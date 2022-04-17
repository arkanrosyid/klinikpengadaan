@extends('home')

@section('css')

<style>
    
</style>
    
@endsection

@section('user')

<!-- Modal Selesai -->
<div class="modal fade" id="Selesai" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Langkah Terakhir</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="/selesaikan/{{$konsultasi['id']}}" method="post">
            @csrf
            <?php 
                $selesai = 'Selesai';
            ?>
            <input type="hidden" name="status" value="{{$selesai}}">
            
            Anda akan menyelesaikan sesi konsultasi ini. <br>
            Masukkan tanggapan anda tentang sesi konsultasi ini dengan kolom dibawah!

            <textarea type="text" name="tanggapan" id="tanggapan" class="form-control" placeholder=""  aria-describedby="helpId"> </textarea>
            <small id="helpId" class="text-muted">Help text</small>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-success mb-1" >Konsultasi Selesai</button>
        </form>
        </div>
      </div>
    </div>
  </div>


<!-- Modal Tatap Muka -->
<div class="modal fade" id="tatapMuka" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <form action="/konsultasi/tatapmuka" method="post">
            @csrf
                <label for="">Pilih tanggal tatap muka :</label>
            <input type="date" name="jadwal" id="jadwal" 
            class="form-control datepicker @error('jadwal') is-invalid @enderror "  value="{{old('jadwal')}}" >
            @error('jadwal')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
            <br>
            <input type="hidden" name="id" value="{{$konsultasi['id']}}">
            <label for="salary">Masukkan no telp yang bisa dihubungi :</label>
                <input type="text" id="phone" name="phone" class="form-control @error('phone') is-invalid @enderror" 
                oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                value="{{old('phone')}}"
                />
                @error('phone')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Ajukan</button>
        </form>
        </div>
      </div>
    </div>
  </div>


<?php 
         use App\Models\User;
         use App\Models\Employee;
?>
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Konsultasi Anda</h6>
        </div>
        <div class="card-body">
        
                    {{-- {{$user['name']}} --}}

                    <h5 style=" margin: 0">{{$konsultasi['tema']}}</h5>
                    <small>{{Carbon\Carbon::parse($konsultasi['created_at'])->format('l, d-m-Y h:i')}}</small>
                    <h6>
                    <small>by : </small>{{$user['name']}}
                    </h6>

                    <br>
                    
                    <p>{{$konsultasi['pertanyaan']}}</p>
                   
                    <br>
                    <hr>

                    {{--  --}}
                    @if ($konsultasi['status'] === 'Selesai'|| $konsultasi['status'] ==="Tatap Muka")



                    <div class="row">
                        <div class="col">
                            <h6 class="m-0 ml-3 font-weight-bold text-primary"> Diskusi</h6>
                        </div>
                        <div class="col">
                            <div align="right">
                                <h6 class="m-0 mr-3 font-weight-bold text-success"> {{$konsultasi['status']}}</h6>
                            </div>
                        </div>
                    </div>
                    <hr style="mt-0">
                    
                    <table width="100%" cellspacing="0" style="border:none;">

                        <thead>
                            <tr>
                                <th>
                                
                                </th>
                            </tr>
                        </thead>
                        
                    @else

                    <div class="row">
                        <div class="col">
                            <h6 class="m-0 ml-3 font-weight-bold text-primary"> Diskusi </h6>
                        </div>
                        <div class="col">
                            <div align="right">
                               
                           
                                                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#Selesai">
                                Selesaikan Konsultasi
                            </button>
                                                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tatapMuka">
                                Ajukan Tatap Muka
                            </button>

                            

                            </div>
                        </div>
                    </div>

                    <hr style="mt-0">
                    
                    <table width="100%" cellspacing="0" style="border:none;">

                        <thead>
                            <tr>
                                <th>
                                    <form action="/konsultasi/user/{{$konsultasi['id']}}" method="post">
                                        @csrf
                                        <div class="form-group" >
                                            <label for=""></label>
                                            <input type="hidden" name="id_user" value="{{Auth::guard()->user()->id}}">
                                            <input type="hidden" name="id_konsul" value="{{$konsultasi['id']}}">
                                            <textarea type="text" name="jawab" id="jawab" class="form-control" placeholder="" aria-describedby="helpId"> </textarea>
                                            <small id="helpId" class="text-muted">Help text</small>
                                        </div>
                                        <div align="right">
                                            <button type="submit" class="btn btn-primary mb-4" >Submit</button>
                                        </div>
                                       
                                    </form>
                                </th>
                            </tr>
                        </thead>
                    
                    @endif

                    {{--  --}}
                   
                  

                     @foreach ($pesan as $item)
                         
                     <?php
                   
                    $id = $item->id_user;
                    $created = $item->created_at;
                    $pertanyaan = $item->pertanyaan;
                    $who = $item->created_by;
                      ?>

                        <tbody>
                            <tr>
                                <td >
                                    <div class="card mb-4">

                                        <div class="card-header">
                                            <div>
                                                <table width="100%"  cellspacing="0" style="border:none;">

                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                              


                                                                @if ($who==='User')
                                                               
                                                                <?php 
                                                           
                                                                $user = User::find($id);  ?>
                                                                <small>by :</small> <strong> {{$username = $user['name']}}  </strong>
                                                                @else

                                                                <?php 
                                                           
                                                                $user = Employee::find($id);  ?>
                                                                <small>by :</small> <strong>  {{$username = $user['name']}} </strong>
                                                                @endif

                                                             
                                                              
                                                            </td>
                                                            <td>
                                                                
                                                            </td>
                                                            <td>
                                                                <div align="right">
                                                                    <small  class=" text-muted">{{Carbon\Carbon::parse($created)->format('l, d-m-Y h:i')}}</small>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                    
                                                </table>
                                          
                                               
                                            </div>
                                        </div>
                                        <div class="card-body">
                                           <p width ="100%">
                                               {{$pertanyaan}}
                                           </p>
                                        </div>
                                    </div>
                                </td>           
                            </tr>

                           
                        @endforeach   

                            
                           

                        </tbody>
                    </table>

                    
          
        </div>
    </div>

   

       
    
@endsection