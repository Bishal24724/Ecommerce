<x-vendorheader title="Home" :notifications="$notifications" />
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                 
                  <div class="col-md-12 grid-margin transparent">
                    <div class="row">
                      <div class="col-md-4 mb-4 stretch-card transparent" >
                        <div class="card bg-dark text-white text-center" onclick="window.location.href='{{ URL::to('vendorproducts') }}'">
                          <div class="card-body">
                            <p class="mb-4">Total Product</p>
                            <p class="fs-30 mb-2">{{ $totalproduct}}</p>
                          
                          </div>
                        </div>
                      </div>
                      <div class="col-md-4 mb-4 stretch-card transparent">
                        <div class="card card-dark-blue text-white text-center" onclick="window.location.href='{{ URL::to('vendorOrder') }}'">
                          <div class="card-body">
                            <p class="mb-4">Total Order</p>
                            <p class="fs-30 mb-2">{{ $totalorder}} </p>
                           
                          </div>
                        </div>
                        
                    </div>
                    <div class="col-md-4 mb-4 stretch-card transparent">
                        <div class="card bg-warning text-white text-center" onclick="window.location.href='{{ URL::to('vendorcategory') }}'">
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
                            <div class="card bg-success text-white text-center" onclick="window.location.href='{{ URL::to('vendorbrand') }}'">
                              <div class="card-body">
                                <p class="mb-4">Total Brand</p>
                                <p class="fs-30 mb-2">{{ $totalbrand}}</p>
                              
                              </div>
                            </div>
                            
                        </div>
                        <div class="col-md-4 mb-4 stretch-card transparent">
                            <div class="card bg-secondary text-white text-center" onclick="window.location.href='{{ URL::to('vendortype') }}'">
                              <div class="card-body">
                                <p class="mb-4">Total Type</p>
                                <p class="fs-30 mb-2">{{ $totaltype}}</p>
                              
                              </div>
                            </div>
                            
                        </div>
                     
                      </div>
                </div>
                <div class="col-md-12 grid-margin transparent">
                  <div class="row">
                    <div class="col-md-4 mb-4 stretch-card transparent">
                      <div class="card bg-info text-white text-center" onclick="window.location.href='{{ URL::to('vendorOrder') }}'">
                        <div class="card-body">
                          <p class="mb-4">Total Revenue</p>
                          <p class="fs-30 mb-2">NRS. {{ $totalrevenue}}</p>
                         
                        </div>
                      </div>
                    </div>

                    <div class="col-md-4 mb-4 stretch-card transparent">
                      <div class="card bg-danger text-white text-center" onclick="window.location.href='{{ URL::to('vendorOrder') }}'">
                        <div class="card-body">
                          <p class="mb-4">Total Pending Order</p>
                          <p class="fs-30 mb-2">{{ $totalpending}}</p>
                        
                        </div>
                      </div>
                      
                  </div>
                 
               
                </div>
          </div>
          <div class="row">
            <div class="col bg-warning">
                   <h4 class="text-center text-white pt-2 pb-2" style="font-size:20px;">Notification Message</h4>
            </div>
          </div>
          <div class="row">
          
          
            <div class="col-lg-12 card">
            <h9 class="card-header" id="notification"  style="font-size:30px;">Message</h9> 
             
              
               <div class="card-body">
               
                 <div class="table-responsive">
                   <table class="table table-striped table-borderless" id="myTable">
                     <thead>
                       <tr>
                         <th>#</th>
                         <th>Title</th>
                         <th>Message</th>
                         <th>Time</th>
                       </tr>
                     </thead>

                     <tbody>
                      @php
                                    $i=0;
                                    @endphp
                      @foreach($notification as $item)
                      @php
                                    $i++;
                                    @endphp
                      <tr>
                        <td>
                        @php
                             echo $i;
                        @endphp
                        </td>
                        <td>{{$item->title}}</td>
                        <td>{{$item->message}}</td>
                        <td>{{$item->created_at }}</td>
                      </tr>

                      @endforeach
                      </tbody>
                   </table>
                   </div>
                   
                   </div>
                  


           </div>
         


                </div>
              
            </div>
   

  <x-vendorfooter />