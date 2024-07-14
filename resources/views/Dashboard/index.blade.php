<x-adminheader title="Home" />
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                 
                  <div class="col-md-12 grid-margin transparent">
                    <div class="row">
                      <div class="col-md-4 mb-4 stretch-card transparent" >
                        <div class="card bg-dark text-white text-center" onclick="window.location.href='{{ URL::to('adminProducts') }}'">
                          <div class="card-body">
                            <p class="mb-4">Total Product</p>
                            <p class="fs-30 mb-2">{{ $totalproduct}}</p>
                          
                          </div>
                        </div>
                      </div>
                      <div class="col-md-4 mb-4 stretch-card transparent">
                        <div class="card card-dark-blue text-white text-center" onclick="window.location.href='{{ URL::to('ourOrders') }}'">
                          <div class="card-body">
                            <p class="mb-4">Total Order</p>
                            <p class="fs-30 mb-2">{{ $totalorder}} </p>
                           
                          </div>
                        </div>
                        
                    </div>
                    <div class="col-md-4 mb-4 stretch-card transparent">
                        <div class="card bg-warning text-white text-center" >
                          <div class="card-body">
                            <p class="mb-4">Total Category</p>
                            <p class="fs-30 mb-2">{{ $totalcategory}}</p>
                         
                          </div>
                        </div>
                        
                    </div>
                    {{--}}
                    <div class="row">
                      <div class="col-md-4 mb-4 mb-lg-0 stretch-card transparent">
                        <div class="card card-light-blue">
                          <div class="card-body">
                            <p class="mb-4">Number of Meetings</p>
                            <p class="fs-30 mb-2">34040</p>
                            <p>2.00% (30 days)</p>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-4 stretch-card transparent">
                        <div class="card card-light-danger">
                          <div class="card-body">
                            <p class="mb-4">Number of Clients</p>
                            <p class="fs-30 mb-2">47033</p>
                            <p>0.22% (30 days)</p>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-4 stretch-card transparent">
                        <div class="card card-light-danger">
                          <div class="card-body">
                            <p class="mb-4">Number of Clients</p>
                            <p class="fs-30 mb-2">47033</p>
                            <p>0.22% (30 days)</p>
                          </div>
                        </div>
                      </div>
                    </div>
                    --}}
                  </div>
                  <div class="col-md-12 grid-margin transparent">
                        <div class="row">
                          <div class="col-md-4 mb-4 stretch-card transparent">
                            <div class="card bg-info text-white text-center">
                              <div class="card-body">
                                <p class="mb-4">Total Customer</p>
                                <p class="fs-30 mb-2">{{ $totalcustomer}}</p>
                               
                              </div>
                            </div>
                          </div>
                          <div class="col-md-4 mb-4 stretch-card transparent">
                            <div class="card bg-success text-white text-center" >
                              <div class="card-body">
                                <p class="mb-4">Total Brand</p>
                                <p class="fs-30 mb-2">{{ $totalbrand}}</p>
                              
                              </div>
                            </div>
                            
                        </div>
                        <div class="col-md-4 mb-4 stretch-card transparent">
                            <div class="card bg-secondary text-white text-center" >
                              <div class="card-body">
                                <p class="mb-4">Total Type</p>
                                <p class="fs-30 mb-2">{{ $totaltype}}</p>
                              
                              </div>
                            </div>
                            
                        </div>
                     
                      </div>
                </div>
         
          </div>

              <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                          .card
                          <div class="card-body">
                           
                            <div class="card-header">
                              <p class="header-title">
                                  
                              </p>
                            </div>
                             
                </div>

         

                </div>
            </div>
   

  <x-vendorfooter />