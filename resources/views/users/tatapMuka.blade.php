@extends('home')
@section('user')

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
                           <td><a href="user/{{$id}}"> {{$tema;}}</a></td>
                           <td> <p style="  word-break: break-word; max-width: 400px;">{!!$pertanyaan;!!} </p> </td>

                        @foreach ($jadwal as $i)
                          <?php 
                          $idJadwal = $i->id;
                          $time =$i->tanggal;
                          $status = $i->status;
                          
                          ?>
                       
                           <td>{{Carbon\Carbon::parse($time)->format('l, d-m-Y')}} </td>
                           <td> 
                               <?php 
                                if($status === "Menunggu Konfirmasi"){
                                  echo ' <button class="btn btn-secondary btn-sm"disabled="disabled" style="width :150px !important;">Menunggu Konfirmasi</button>';
                                }else if($status === "Ajukan Ulang"){
                                    echo '      <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#ajukan'.$id.'" style="width :150px !important;">
                                                Ajukan Ulang Jadwal
                                                </button>';
                                    ?>

                                    <div class="modal fade" id="ajukan{{$id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Ajukan Ulang Jadwal</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="/konsultasi/tatapmuka/ajukanulang/{{$idJadwal}}" method="post">
                                                 @csrf
                                                        <label for="">Pilih tanggal tatap muka :</label>
                                                    <input type="date" name="jadwal" id="jadwal" 
                                                    class="form-control datepicker @error('jadwal') is-invalid @enderror "  value="{{old('jadwal')}}" >
                                                    @error('jadwal')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                    <input type="hidden" name="idJadwal" value="{{$idJadwal}}">
                                            
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
                                }else if($status === "Disetujui"){
                                    ?>
                                    
                                     <a name="" id="" class="btn btn-success btn-sm" href="/tatapmuka/user/cetaktiket/{{$idJadwal}}" role="button" style="width :150px !important;">Cetak Tiket</a>
                                     <?php
                                    }else{
                                    echo "Selesai";
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