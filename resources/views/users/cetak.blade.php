<?php 
     $idUs = Auth::guard()->user()->id;
?>

@if (  $k->id_user === $idUs)

<!doctype html>
<html lang="en">
  <head>
    <title>Tiket Konsultasi Tatap Muka Pengadaan Barang dan Jasa</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>

    <style>
        @page { size: auto;  margin: 0mm; }
        page {
      background: white;
      display: block;
      margin: 0 auto;
      margin-bottom: 0.5cm;
      box-shadow: 0 0 0.5cm rgba(0,0,0,0.5);
    }
    page[size="A4"] {  
      width: 21cm;
      height: 29.7cm; 
    }
    table{
        border-block : 1px;
    }
    tr {
   line-height: 8px;
   min-height: 8px;
   height: 8px;

   }
   @media print {
   
    .page[size="A4"] {
    margin: 0;
    box-shadow: 0;
    width: 210mm;
    height: 297mm;
  }
  .noPrint{
        display:none;
    }
    }
    </style>
    <div class="container-fluid">
      
    <page size="A4" class="printableArea">
    
        <br>
 

        <div align="center">
        <h5>FORMULIR KONSULTASI PENGADAAN BARANG/JASA</h5>
        <br>
      
        <div class="container-fluid">
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <td >Tanggal Konsultasi</td>
                    <td style="min-width: 250px">{{ Carbon\Carbon::parse($tM['tanggal'])->format('l, d-m-Y')}}</td>
                </tr>
               
                <tr>
                    <td>Lokasi Konsultasi</td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="2"> Pihak yang meminta konsultasi:</td>
                </tr>
                <tr>
                    <td>Nama</td>
                    <td>{{$u['name']}}</td>
                </tr>
                <tr>
                    <td>Unit Kerja</td>
                    <td>{{$k['unit_kerja']}} </td>
                </tr>
                <tr>
                    <td>Jabatan</td>
                    <td>{{$k['jabatan']}} </td>
                </tr>
                <tr>
                    <td>Tema konsultasi</td>
                    <td>{{$k['tema']}} </td>
                </tr>
                <tr>
                    <td colspan="2">Pihak yang memberikan konsultasi:</td>
              
                </tr>
                <tr>
                    <td>Nama</td>
                    <td>{{$e['name']}} </td>
                </tr>
                <tr>
                    <td>Jabatan</td>
                    <td></td>
                </tr>
                <tr>
                    <td>Unit Kerja</td>
                    <td>UKPBJ</td>
                </tr>
            </tbody>

        </table >
        {{--  --}}
      <div align="left">
        <table class="table table-bordered">
            <tbody>
                <tr style="   line-height: 15px;
                min-height: 15px;
                height: 15px;">
                    <td >
                   <h6> Pertanyaan konsultasi</h6>
                 
                    <p> 
                        {{$k['pertanyaan']}}
                    </p>
                    </td>
                    
                    </tr>
                <tr style=" 
                min-height: 180px;
                height: 180px;">
                    <td >
                   <h6>Konsep Rekomendasi/Saran</h6>
                     
                    </td>
                    
                    </tr>
              
            </tbody>
        </table>

        <table class="table table-bordered">
            <tbody>
                <tr
                style=" 
                min-height: 150px;
                height: 150px;">
                  
                    <td>Pihak yang berkonsultasi</td>
                    <td>Pihak yang memberikan konsultasi</td>
                </tr>
                <tr
                style=" 
                min-height: 150px;
                height: 150px;">
                  
                    <td>Mengetahui, <br>
                        <br>
                    Atasan langsung(jika diperlukan)</td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </div>
    </div>
        </div>
    </page>
    <div class="mt-3 mb-3 noPrint" align="center">
        <button type="button" class="btn btn-primary" onclick="window.print();return false;">Print</button>
    </div>
    
</div>
      
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>
@else

@endif