@extends('admin')
@section('admin')
    <div class="container-fluid">

        @if (session()->has('success'))

        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{session('success')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
            
        @endif
      
        @if (session()->has('delete'))

        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{session('delete')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
            
        @endif
      

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Unit Kerja</h6>
            </div>
            <div class="card-body">
             <div class="m-3" align="right">

                
                        <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                        Tambah Unit Kerja
                    </button>
            </div>
                    
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Tambah Unit Kerja</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="modal-body">
                            <form action="/unit/tambah" method="POST">
                                @csrf
                            
                                <div class="form-group">
                                  <label for="">Nama Unit Kerja</label>
                                  <input type="text"
                                    class="form-control" name="unit" id="unit" aria-describedby="helpId" placeholder="">
                                  
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
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
                                <th>Created</th>
                                <th>Action</th>
                            
                            
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>No</th>            
                                <th>Name</th>
                                <th>Created</th>
                                <th>Action</th>
                            
                            
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php
                            $n= 1;    
                            ?>
                            @foreach ($unit as $item)
                                <tr>
                                    <td>{{$n++;}}</td>
                                    <td>{{$item['name'];}}</td>
                                    <td> {{Carbon\Carbon::parse($item['created_at'])->format('l, d-m-Y');}} </td>
                                    <td> 
                   

                                        <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete{{$item['id']}}">
                                                Delete
                                            </button>
                                            
                                            <!-- Modal -->
                                            <div class="modal fade" id="delete{{$item['id']}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Hapus Data</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                    </div>
                                                    <div class="modal-body">
                                                    Anda akan menghapus unit <strong>{{$item['name'];}}</strong> dari database!
                                                    </div>
                                                    <div class="modal-footer">
                                                        <form action="/unit/hapus/{{$item['id']}}" method="POST">
                                                            @csrf
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-danger">Lanjutkan</button>
                                                        </form>
                                                    </div>
                                                </div>
                                                </div>
                                            </div>
                                        
                                    </td>
                                </tr>
                            @endforeach


    
                        </tbody>

              
    </div>
    
@endsection