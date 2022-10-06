@extends('home')

@section('css')

<style>
    
</style>
    
@endsection

@section('user')

<script src="{{asset('tinymce/tinymce.min.js')}}"></script>
<script>
  tinymce.init({
    selector: '#jawab'
  });
</script>
<?php 
         use App\Models\User;
         use App\Models\Employee;
?>

<?php 
     $idUs = Auth::guard()->user()->id;
?>

@if (  $konsultasi->id_user === $idUs)

    
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
          <h5 class="modal-title" id="exampleModalLabel">Ajukan Tatap Muka</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <form action="/konsultasi/tatapmuka" method="post">
            <strong>Anda akan mengajukan tatap muka ke pihak yang memberikan konsultasi! </strong> Silahkan pilih tanggal rencana konsultasi di kolom bawah ini.
            <br>
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
            <input type="hidden" name="id_emp" value="{{$konsultasi['id_employee']}}">
            
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



<div class="container-fluid">
    @if (session('success'))
    <div class="alert alert-success" role="alert">
        {{session('success')}}
    </div>
@endif
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Konsultasi Anda</h6>
        </div>
        <div class="card-body">

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
                               
                                
                                @if ($konsultasi['status'] === 'Baru')
                                
                                    
                                @else
                                                                                            <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#Selesai">
                                        Selesaikan Konsultasi
                                    </button>
                                                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tatapMuka">
                                        Ajukan Tatap Muka
                                    </button>

                                @endif
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
                                        </div>
                                        <div align="right">
                                            <button type="submit" class="btn btn-primary mb-4" >  Submit</button>
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
                        {!!$TM[0]->hasil!!}
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
                                                           
                                                                $user = User::find($id);?>
                                                                <small>Pengguna :</small> <strong> {{$username = $user['name']}}  </strong>
                                                                @else

                                                                <?php 
                                                           
                                                                $user = Employee::find($id);?>
                                                                <small>Pegawai :</small> <strong>  {{$username = $user['name']}} </strong>
                                                                @endif

                                                             
                                                              
                                                            </td>
                                                            <td>
                                                                
                                                            </td>
                                                            <td>
                                                                <div align="right">
                                                                    <small  class=" text-muted">{{Carbon\Carbon::parse($created)->translatedFormat('l, d-m-Y h:i')}}</small>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                    
                                                </table>
                                          
                                               
                                            </div>
                                        </div>
                                        <div class="card-body">
                                           <p width ="100%">
                                               {!! $pertanyaan !!}
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
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-danger">Konsultasi Tertutup</h6>
               
    
            </div>
            <div class="card-body">
                <strong>
                    Konsultasi yang anda akses bukanlah milik anda!</strong> anda tidak dapat mengkases konsultasi ini!
                    <br>
             
                <br>
                <a name="" id="" class="btn btn-danger" href="/konsultasi/user" role="button">Kembali</a>
              <br>
    
    </div>
    </div>
           

@endif
   

    
@endsection