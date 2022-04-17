@extends('admin')

@section('admin')
    <div class="container-fluid">
              <!-- Page Heading -->
              <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                {{-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                        class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> --}}
            </div>

            <!-- Content Row -->
            <div class="row">

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                       Total Pengguna Sistem</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{$user}}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-fw fa-users fa-2x text-gray-300"></i>
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                      Total Pegawai aktif</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{$pegawai}}
                                        </div>
                                        
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-fw fa-users fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-info shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Konsultasi
                                    </div>
                                    <div class="row no-gutters align-items-center">
                                        <div class="col-auto">
                                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{$konsul}}</div>
                                        </div>
                                      
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-fw fa-copy  fa-2x text-gray-300"></i>
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pending Requests Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                        Konsultasi Aktif</div>
                                        <div class="row no-gutters align-items-center">  
                                    <div class="col-auto">
                                    <div class="h5 mb-0 font-weight-bold text-gray-800 mr-2">{{$aktif}} </div>
                                </div>
                                    <div class="col">
                                        <div class="progress progress-sm mr-2">
                                            <?php 
                                            if (!empty($aktif) && !empty($konsul)){
                                                $persen = $aktif/$konsul*100;
                                            
                                            ?>
                                            
                                            <div class="progress-bar bg-info" role="progressbar"
                                                style="width: {{$persen}}%" aria-valuenow="{{$aktif}}" aria-valuemin="{{$konsul}}"
                                                aria-valuemax="100"></div>
                                            <?php }else {
                                                
                                                ?>
                                                <div class="progress-bar bg-info" role="progressbar"
                                                style="width:0%" aria-valuenow="{{$aktif}}" aria-valuemin="{{$konsul}}"
                                                aria-valuemax="100"></div>
                                                 <?php
                                            }
                                            
                                            ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                               
                                <div class="col-auto">
                                 
                                    <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content Row -->

          
    </div>
@endsection