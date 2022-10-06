@extends('employee')


@section('employee')

<script src="{{asset('tinymce/tinymce.min.js')}}"></script>
<script>
    tinymce.init({
    selector: '#jawab'
    });
</script>

<?php 
         use App\Models\User;
         use App\Models\Employee;

        $idUs = Auth::guard('employee')->user()->id;
?>

@if ( $konsultasi->id_employee === $idUs)

<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Konsultasi Anda</h6>
        </div>
        <div class="card-body">
        
                    {{-- {{$user['name']}} --}}
                    <table class="table table-borderless">
                  
                        <tbody>
                            <tr>
                                <td scope="row" style="width : 300px;">Tanggal </td>
                                <td>: {{Carbon\Carbon::parse($konsultasi->created)->translatedFormat('l, d-m-Y h:i')}}</td>
                            </tr>
                            <tr>
                                <td scope="row">Tema</td>
                                <td>: {{$konsultasi->tema}}</td>
                            </tr>
                            <tr>
                                <td scope="row">Pertanyaan</td>
                                <td>: 
                                   <div class="ml-3">
                                    {!! $konsultasi->pertanyaan !!} 
                                    </div> </td>
                            </tr>
                            <tr>
                                <td colspan="2">Pihak yang meminta konsultasi :</td>
                            </tr>
                            <tr>
                                <td scope="row">Nama</td>
                                <td>: {{$user->name}} </td>
                            </tr>
                            <tr>
                                <td scope="row">Unit Kerja</td>
                                <td>: {{$konsultasi->unit_kerja}}</td>
                            </tr>
                            <tr>
                                <td scope="row">Jabatan</td>
                                <td>: {{$user->jabatan}}</td>
                            </tr>
                            <tr>
                                <td colspan="2">Pihak yang memberikan konsultasi :</td>
                            </tr>
                            @if (!empty($emp))
    
                                <tr>
                                    <td scope="row">Nama</td>
                                    <td>: {{$emp->name}}</td>
                                </tr>
                                <tr>
                                    <td scope="row">Unit Kerja</td>
                                    <td>: {{$emp->unit_kerja}}</td>
                                </tr>
                                <tr>
                                    <td scope="row">Jabatan</td>
                                    <td>: {{$emp->jabatan}}</td>
                                </tr>
                                
                            @else
                                <tr>
                                    <td scope="row">Nama</td>
                                    <td>: </td>
                                </tr>
                                <tr>
                                    <td scope="row">Unit Kerja</td>
                                    <td>: </td>
                                </tr>
                                <tr>
                                    <td scope="row">Jabatan</td>
                                    <td>:</td>
                                </tr>
                                
                            @endif
                            
    
              
                        </tbody>
                    </table>
                    <hr>
                    @if ($konsultasi['status'] === 'Selesai' || $konsultasi['status'] ==="Tatap Muka")



                    <div class="row">
                        <div class="col">
                            <h6 class="m-0 ml-3 font-weight-bold text-primary"> Diskusi</h6>
                        </div>
                        <div class="col">
                            <div align="right">
                                <h6 class="m-0 mr-3 font-weight-bold text-success">{{$konsultasi['status']}}</h6>
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
                           
                        </div>
                    </div>

                    <hr style="mt-0">
                    
                    <table width="100%" cellspacing="0" style="border:none;">

                        <thead>
                            <tr>
                                <th>
                                    <form action="/konsultasi/send/{{$konsultasi['id']}}" method="post">
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
                   
                      @if (!empty($TM) && !empty($TM[0]->hasil))
                          
                     
                    <div class="card mb-4">

                    <div class="card-header">
                        <div  class="font-weight-bold text-success">
                     <strong >Hasil Tatap Muka</strong>
                    </div>   
                    </div>
                    <div class="card-body">
<<<<<<< Updated upstream
                        {!! $TM[0]->hasil!!}
=======
                        {!!$TM[0]->hasil!!}
>>>>>>> Stashed changes
                    </div>
                </div>
                @endif  

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
                                                                <small>Pengguna :</small> <strong> {{$username = $user['name']}}  </strong>
                                                                @else

                                                                <?php 
                                                           
                                                                $user = Employee::find($id);  ?>
                                                                <small>Pegawai :</small> <strong>  {{$username = $user['name']}} </strong>
                                                                @endif

                                                             
                                                              
                                                            </td>
                                                            <td>
                                                                
                                                            </td>
                                                            <td>
                                                                <div align="right">
<<<<<<< Updated upstream
                                                                    <small  class=" text-muted">{{Carbon\Carbon::parse($created)->translatedFormat('l, d-m-Y h:i')}}</small>
=======
                                                                    <small  class=" text-muted">{{Carbon\Carbon::parse($created)->format('l, d-m-Y h:i')}}</small>
>>>>>>> Stashed changes
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                    
                                                </table>
                                          
                                               
                                            </div>
                                        </div>
                                        <div class="card-body">
                                           <p width ="100%">
                                               {!!$pertanyaan!!}
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

@else

@endif

   

       
    
@endsection