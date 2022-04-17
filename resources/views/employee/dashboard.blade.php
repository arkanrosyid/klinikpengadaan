@extends('employee')

@section('employee')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
      
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
                              <a href="konsultasi" 
                              class="text-xs font-weight-bold text-primary text-uppercase mb-1">  Konsultasi</a> </div>
                    
                      </div>
                      <div class="col-auto">
                      
                          
                      </div>
                  </div>
              </div>
          </div>
      </div>

      <!-- Earnings (Monthly) Card Example -->
      <div class="col-xl-3 col-md-6 mb-4">
          <div class="card border-left-primary shadow h-100 py-2">
              <div class="card-body">
                  <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                          <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                             <a href="employee/konsul"
                             class="text-xs font-weight-bold text-primary text-uppercase mb-1">Konsultasi Aktif</a> </div>
                          <div class="h5 mb-0 font-weight-bold text-gray-800"></div>
                      </div>
                      <div class="col-auto">
                      
                          
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
                             <a href="employee/konsul"
                            class="text-xs font-weight-bold text-success text-uppercase mb-1">Konsultasi Selesai</a> </div>
                          <div class="h5 mb-0 font-weight-bold text-gray-800"></div>
                      </div>
                      <div class="col-auto">
                       
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
                          <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                            <a href="http://multi.test/employee/tatapmuka"
                            class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Tatap Muka
                            </a>  
                            
                          </div>
                          <div class="row no-gutters align-items-center">
                              <div class="col-auto">
                                  <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"></div>
                              </div>
                             
                          </div>
                      </div>
                      <div class="col-auto">
                      
                      </div>
                  </div>
              </div>
          </div>
      </div>

     

  <!-- Content Row -->
@endsection