@extends('home')
@section('user')

{{-- <script src="https://cdn.tiny.cloud/1/1ku4gck2tk6kbqnqsepmcsv4si387iviz9knmcxnxggpr59s/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script> --}}
<script src="{{asset('tinymce/tinymce.min.js')}}"></script>
<script>
  tinymce.init({
    selector: '#mytextarea'
  });
</script>

    <div class="container-fluid">
        @if (session()->has('success'))

        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{session('success');}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
            
        @endif
      

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary" align="center">Ajukan Konsultasi Baru</h6>
            </div>
            <div class="card-body">

                <form action="home" method="post">

                    @csrf
                    
              

                    <input type="hidden" name="id_user" value="{{ Auth::guard()->user()->id}}">
                <div class="form-group">
                  <label for="">Tema</label>
                  <select class="form-control @error('tema') is-invalid @enderror" id="tema" name="tema">
                    <option value="Perencanaan Pengadaan">Perencanaan Pengadaan</option>
                    <option value="Pemilihan Penyedia">Pemilihan Penyedia</option>
                    <option value="Pengelolan Kontrak">Pengelolan Kontrak</option>
                    <option value="Pengelolaan Swaklola">Pengelolaan Swaklola</option>
                 
                  </select>
                  <small id="helpId" class="form-text text-muted">Pilih Tema Konsultasi (Pilih Salah Satu)</small>
                </div>

                <div class="form-group">
                    <label for="pertanyaan">Pertanyaan</label>
                    <textarea class="form-control @error('pertanyaan') is-invalid @enderror" id="mytextarea" name="pertanyaan" rows="3" value="{{ old('pertanyaan') }}"></textarea>
                    <small id="helpId" class="form-text text-muted">Max 500 karakter</small>
                    </div>
                </div>
                
            
             <div class="btn mb-2 mr-2" align="right" >
                <button type="submit" class="btn btn-primary ">Submit</button>
            </div>

             </form>

            </div>
        </div>

    </div>

    
  

@endsection

@section('script')





@endsection