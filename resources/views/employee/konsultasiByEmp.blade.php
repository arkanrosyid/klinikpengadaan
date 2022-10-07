@extends('employee')

@section('employee')
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
                    ?>
                <h5><a href="/konsultasi/{{$id}}">{{$tema}}</a></h5>
                   <table class="table table-borderless">
                       <tbody>
                           <tr>
                               <td scope="row" style="width : 100px">Waktu </td>
                               <td> : {{Carbon\Carbon::parse($created)->translatedFormat('l, d-m-Y h:i')}}</td>
                               
                           </tr>
                           <tr>
                               <td scope="row">Pertanyaan</td>
                               <td>  :  <div class="m-0 ml-3" >
                                        <div class="m-2">
                                            {!!$pertanyaan!!}    
                                        </div>
                                    
                                   </div>
                                </td>
                              
                           </tr>
                       </tbody>
                   </table>
                  
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

                <h5><a href="/konsultasi/{{$id}}">{{$tema}}</a></h5>
                <table class="table table-borderless">
                    <tbody>
                        <tr>
                            <td scope="row" style="width : 100px">Waktu </td>
                            <td> : {{Carbon\Carbon::parse($created)->translatedFormat('l, d-m-Y h:i')}}</td>
                            
                        </tr>
                        <tr>
                            <td scope="row">Pertanyaan</td>
                            <td>  :  <div class="m-0 ml-3" style="border: solid 	#0275d8 1px;">
                                    <div class="m-2" >
                                        {!!$pertanyaan!!}    
                                    </div>
                                
                                </div>
                            </td>
                        
                        </tr>
                    </tbody>
                </table>
                <hr>

             @endforeach
           
                {{-- @foreach ($selesai as $item)
                   <?php
                   $id      = $item->id;
                    $tema  = $item->tema;
                    $created = $item->created_at;
                    $pertanyaan = $item->pertanyaan;
                    ?>
               
                   
                  
                    
                    <h5><a href="/konsultasi/{{$id}}}">{{$tema}}</a></h5>
                    <table class="table table-borderless">
                        <tbody>
                            <tr>
                                <td scope="row" style="width : 100px">Waktu </td>
                                <td> : {{Carbon\Carbon::parse($created)->translatedFormat('l, d-m-Y h:i')}}</td>
                                
                            </tr>
                            <tr>
                                <td scope="row">Pertanyaan</td>
                                <td>  :  <div class="m-0 ml-3" >
                                         <div class="m-2">
                                             {!!$pertanyaan!!}    
                                         </div>
                                     
                                    </div>
                                 </td>
                               
                            </tr>
                        </tbody>
                    </table>
                     <hr>
                 @endforeach --}}
               
            </div>
        </div>

      
</div>
@endsection