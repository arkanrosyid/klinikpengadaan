@extends('employee')
@section('employee')

<script src="{{asset('tinymce/tinymce.min.js')}}"></script>
<script>
  tinymce.init({
    selector: '#jawab'
  });
</script>

<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tatap Muka</h6>
        </div>
        <div class="card-body">
            
               <table class="table">
                   <thead>
                       <tr>
                           <th>No</th>
                           <th>Tema</th>
                           <th>Pertanyaan</th>
                           <th>Jadwal</th>
                           <th>Status</th>
                           <th>Action</th>
                       </tr>
                   </thead>
                   <tbody>

            <?php
                $n=1;
                use Illuminate\Support\Facades\DB;
                ?>
       
            @foreach ($tatapM as $item)
               <?php
                $id      = $item->id;
                $tema  = $item->tema;
               
                $pertanyaan = $item->pertanyaan;
                $jadwal= DB::table('tatap_mukas')->where('id_konsultasi',$id)->get();

                
            
                ?>

               
   
        
                       <tr>
                           <td scope="row">{{$n++;}}</td>
                           <td><a href="/employee/tatapmuka/{{$id}}"> {{$tema;}}</a></td>
                           <td> <p style="  word-break: break-word; max-width: 400px;">{!!$pertanyaan;!!} </p> </td>

                        @foreach ($jadwal as $i)
                          <?php 
                          $time =$i->tanggal;
                          $status = $i->status;
                          ?>
                       
                           <td>{{Carbon\Carbon::parse($time)->translatedFormat('l, d-m-Y')}} </td>
                           <td> 
                               {{$status}}
                           </td>
                           <td>
                               <?php 
                                if($status === "Menunggu Konfirmasi"){
                                    ?>
                                  <button type="button" class="btn btn-info btn-sm mb-2" style="width :130px !important;" data-toggle="modal" data-target="#ajukanUlang{{$id}}">Ajukan Ulang</button>
                                 <button type="button" class="btn btn-primary btn-sm mb-2" style="width :130px !important;" data-toggle="modal" data-target="#Setujui{{$id}}">Setujui</button>

                                 <!-- Modal Ajukan-->
                                <div class="modal fade" id="ajukanUlang{{$id;}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Ajukan Ulang</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        Anda akan meminta pengguna mengajukan ulang jadwal tatap muka
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <a name="" id="" class="btn btn-primary" href="/employee/tatapmuka/ajukan/{{$id}}" role="button">Ajukan Ulang</a>
                                    </div>
                                    </div>
                                </div>
                                </div>
                                 <!-- Modal -->
                                <div class="modal fade" id="Setujui{{$id;}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Setujui</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        Anda akan menyetujui jadwal tatap muka pada  {{Carbon\Carbon::parse($time)->translatedFormat('l, d-M-Y')}}
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <a name="" id="" class="btn btn-primary" href="/employee/tatapmuka/setujui/{{$id}}" role="button">Setujui</a>
                                    </div>
                                    </div>
                                </div>
                                </div>
                                  <?php
                                }else if($status === "Ajukan Ulang"){
                                    ?>
                                       <button type="button" class="btn btn-info btn-sm mb-2" style="width :130px !important;" data-toggle="modal" data-target="#ajukanUlang{{$id}}">Ajukan Ulang</button>
                                       <button type="button" class="btn btn-primary btn-sm mb-2" style="width :130px !important;" data-toggle="modal" data-target="#Setujui{{$id}}">Setujui</button>
      
                                       <!-- Modal Ajukan -->
                                      <div class="modal fade" id="ajukanUlang{{$id;}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                      <div class="modal-dialog" role="document">
                                          <div class="modal-content">
                                          <div class="modal-header">
                                              <h5 class="modal-title" id="exampleModalLabel">Pengajuan Ulang</h5>
                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true">&times;</span>
                                              </button>
                                          </div>
                                          <div class="modal-body">
                                            Anda akan meminta pengguna untuk melakukan pengajuan ulang jadwal tatap muka 
                                          </div>
                                          <div class="modal-footer">
                                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                              <a name="" id="" class="btn btn-primary" href="/employee/tatapmuka/ajukan/{{$id}}" role="button">Ajukan Ulang</a>
                                          </div>
                                          </div>
                                      </div>
                                      </div>
                                       <!-- Modal -->
                                      <div class="modal fade" id="Setujui{{$id;}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                      <div class="modal-dialog" role="document">
                                          <div class="modal-content">
                                          <div class="modal-header">
                                              <h5 class="modal-title" id="exampleModalLabel">Setujui Jadwal</h5>
                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true">&times;</span>
                                              </button>
                                          </div>
                                          <div class="modal-body">
                                            Anda akan menyetujui jadwal tatap muka pada {{Carbon\Carbon::parse($time)->translatedFormat('l, d-M-Y')}}
                                          </div>
                                          <div class="modal-footer">
                                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                              <a name="" id="" class="btn btn-primary" href="/employee/tatapmuka/setujui/{{$id}}" role="button">Setujui</a>
                                          </div>
                                          </div>
                                      </div>
                                      </div>
                                    <?php
                                }else if($status === "Disetujui"){ ?>

                                    <button type="button" class="btn btn-info btn-sm mb-2" style="width :130px !important;" data-toggle="modal" data-target="#jadwalUlang{{$id}}">Jadwalkan Ulang</button>
                                    <button type="button" class="btn btn-success btn-sm mb-2" style="width :130px !important;" data-toggle="modal" data-target="#Selesaikan{{$id}}">Selesaikan</button>
                                 <!-- Modal -->
                                 <div class="modal fade" id="jadwalUlang{{$id;}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Jadwalkan Ulang</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            Anda akan meminta pengguna untuk melakukan penjadwalan ulang tatap muka
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <a name="" id="" class="btn btn-primary" href="/employee/tatapmuka/ajukan/{{$id}}" role="button">Jadwalkan Ulang</a>
                                        </div>
                                        </div>
                                    </div>
                                    </div>
                                     <!-- Modal -->
                                    <div class="modal fade" id="Selesaikan{{$id;}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Selesaikan Tatap Muka</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                           Inputkan hasil dari konsultasi secara tatap muka pada kolom dibawah.
                                            <form action="/employee/tatapmuka/selesesikan" method="POST">
                                            @csrf

                                                <input type="hidden" name="id" value="{{$id}}">
                                                <div class="form-group">
                                                  
                                                  <textarea class="form-control" name="hasil" id="jawab" rows="5"></textarea>
                                                </div>
                                            

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                          <button type="submit" class="btn btn-primary">Selesaikan</button>
                                        </form>
                                        </div>
                                        </div>
                                    </div>
                                    </div>
                               <?php
                                }
                                ?>
                               
                            </td>
                         @endforeach
                        </tr>
                             
             @endforeach
                         
                      
                   </tbody>
               </table>
         
           
        </div>
    </div>

</div>
    
@endsection