@extends('employee')
@section('employee')
    <div class="container-fluid">

       @if (session('gagal'))
       <div class="alert alert-danger" role="alert">
        {{session('gagal')}}
      </div>
       @endif
       <div class="card shadow mb-4 m-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Profil Pegawai</h6>
        </div>
        <div class="card-body">
            <table class="table">
                <tbody>
                    <form action="" method="post">
                        @csrf

                        <input type="hidden" name="id" value="{{$Data->id}}">
                    <tr>
                        <td scope="row">Nama</td>
                        <td style="min-width: 300px">
                              <input type="text" class="form-control @error('nama') is-invalid @enderror" 
                              name="nama" id="nama" aria-describedby="helpId" 
                              value="{{$Data->name}}" placeholder=""required>  
                        </td>
                   
                    </tr>
                    <tr>
                        <td scope="row">NIP</td>
                        <td style="min-width: 300px">
                              <input type="text" class="form-control @error('nip') is-invalid @enderror" 
                              name="nip" id="nip" aria-describedby="helpId" 
                              value="{{$Data->nip}}" placeholder=""required>  
                        </td>
                   
                    </tr>
                    <tr>
                        <td scope="row">Unit Kerja</td>
                        <td style="min-width: 300px">
                              <input type="text" class="form-control @error('unit') is-invalid @enderror" 
                              name="unit" id="disabledTextInput" aria-describedby="helpId" 
                              value="{{$Data->unit_kerja}}" placeholder="" disabled>  
                        </td>
                        
                    </tr>
                    <tr>
                        <td scope="row">Jabatan</td>
                        <td style="min-width: 300px">
                              <input type="text" class="form-control @error('jabatan') is-invalid @enderror" 
                              name="jabatan" id="jabatan" aria-describedby="helpId" 
                              value="{{$Data->jabatan}}" placeholder=""required>  
                        </td>
                   
                    </tr>
                    <tr>
                        <td scope="row">E-mail</td>
                        <td><input type="email" class="form-control @error('email') is-invalid @enderror" 
                            name="email" id="email" aria-describedby="helpId" 
                            value="{{$Data->email}}" placeholder="" required>  
                        </td>
                    <tr>
                        <td scope="row">No Telpon</td>
                        <td><input type="text" class="form-control @error('phone') is-invalid @enderror" 
                            name="phone" id="phone" aria-describedby="helpId" 
                            value="{{$Data->phone}}" placeholder="" required>  
                        </td>
                   
                    </tr>
                    <tr>
                        <td scope="row">Password</td>
                        <td>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" 
                            name="password" id="password" aria-describedby="helpId" 
                            placeholder="" required>
                        </td>
                   
                    </tr>
                </tbody>

                
            </table>
            <div align="right">
               <button type="submit" class="btn btn-success">Simpan Perubahan</button>
            </div>
            </form>
        </div>
    </div>
</div>
@endsection