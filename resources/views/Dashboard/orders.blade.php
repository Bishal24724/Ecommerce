<x-adminheader title="Order" />
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
        
          <div class="row mb-4">
            <div class="col-lg-12">
              <div class="">
                  <a href="{{ URL::to('/admin')}}" class="text-black">Dashboard</a><span> >> </span>
                  <a href="{{ URL::to('/ourOrders')}}" class="text-black">Orders</a>
                  
              </div>
          </div>
         
          <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                    <p class="card-title mb-0">Our Orders</p>
                    <div class="row">
                      <div class="col">
                       
                    </div>
                   
                 
                  <div class="table-responsive">
                    <table id="myTable"  class="table table-striped table-borderless table-responsive">
                      <thead>
                        <tr>
                          <th>Customer</th>
                         
                          <th>Bill</th>
                          <th>Phone</th>
                          <th>Address</th>
                          <th>Order Status</th>
                          <th>Order Date </th>
                        <th>Delivered Date</th>
                          <th>Product</th>
                             
                          <th>View Map </th>
                           <th>Action</th>
                        </tr>  
                      </thead>
                      <tbody>
                      @php
                          $i=0;
                      @endphp
        
                        @foreach ($orders as $item)
                        @php
                        $i++;
                    @endphp
                        <tr>
                            <td>{{$item->fullname}}</td>
                            
                          
                            <td class="font-weight-bold">{{ $item->bill}}</td>
                            <td>{{ $item->phone}}</td>
                            <td>{{ $item->address}}</td>
                            <td class="font-weight-medium"><div class="badge badge-success">{{$item ->status}}</div></td>
                            <td class="font-weight-medium"><div class="badge badge-info">{{$item ->created_at}}</div></td>
                            <td class="font-weight-medium"><div class="badge badge-info">{{$item ->delivered_at}}</div></td>
                            
                            <td class="font-weight-small">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#updateModel{{ $i}}">
                                    Product
                                  </button>
                                  <div class="modal" id="updateModel{{ $i}}" >
                                    <div class="modal-dialog" role="document">
                                      <div class="modal-content">
            
                                        <div class="modal-header">
                                          <h5 class="modal-title" > Product </h5>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                          </button>
                                        </div>
                                        <div class="modal-body">
                                        <table class="table table-responsive">
                                            <thead>
                                                <tr>
                                                    <th>
                                                        Product
                                                    </th>
                                                    <th>
                                                        Picture
                                            
                                                    </th>
                                                    <th>
                                                        Price/Item
                                                    </th>
                                                    <th>
                                                    Quantity
                                                    </th>
                                                    <th>
                                                        Sub Total
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($orderItems as $oItem)
                                                @if($oItem->orderId==$item->id)
                                                <tr>
                                                    <td>
                                                      {{ $oItem->title}}
                                                    </td>
                                                    <td>
                                                      <img src="{{ URL::asset('uploads/products/'.$oItem->picture)}}"  width="100px">
                                                    </td>
                                                    <td>
                                                     NRS {{ $oItem->price}}
                                                    </td>
                                                    <td>
                                                      {{ $oItem->quantity}}
                                                    </td>
                                                    <td>
                                                      NRS {{ $oItem->quantity* $oItem->price}}
                                                    </td>
                                              </tr>
                                                @endif
                                               
                                                @endforeach
                       
                                            </tbody>
                                        </table>
                                        </div>
                                       
                                      </div>
                                    </div>
                                  </div>
                            </td>
        
                            <td  class="text-center">
                              <button type="button" class="btn fa-regular fa-eye "  style="cursor: pointer; color:blue;" data-toggle="modal" data-target="#mapModel{{ $i}}" onclick="initMap({{$item->longitude}},{{$item->latitude}})">
                              
                              </button>

                              <div class ="modal" id="mapModel{{ $i}}"  >
                                <div class="modal-dialog" role="document" >
                                    <div class="modal-content" >
                                      <div class="modal-header">
                                        <h5 class="modal-title">Map</h5>
                                      </div>
                                      <div class="modal-body" >
                                        <div id="map" style="width:100%; height:500px;"></div>
                                        </div>

                                    </div>
                                </div>
                              </div>




                            </td>
                            <td>
                                @if($item->status == 'Paid')
                                <a href="{{ URL::to('changeOrderStatus/Accepted/'.$item->id)}}" class="btn btn-success">Accept</a>
                                <a href="{{ URL::to('changeOrderStatus/Rejected/'.$item->id)}}" class="btn btn-danger">Reject</a>
                            @elseif($item->status == 'Accepted')
                                <a href="{{ URL::to('changeOrderStatus/Delivered/'.$item->id)}}" class="btn btn-success">Complete</a>
                            @elseif($item->status == 'Delivered')
                                Already Completed
                            @else
                                <a href="{{ URL::to('changeOrderStatus/Accepted/'.$item->id)}}" class="btn btn-success">Accept</a>
                            @endif
                            </td>
                        </tr>
                        @endforeach
                      
                       
                         
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          
          </div>
         


<script>



  function initMap(long,lat) {
      var map = new google.maps.Map(document.getElementById('map'), {
          center: { lng: long, lat: lat },
          zoom: 8,
      });

      var marker = new google.maps.Marker({
          position: {  lng: long,lat: lat },
          map: map,
      });

   
  }


 
</script>

<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC1KP1tF-W6uN3zd7uBmhJy-VFofp5U2UM"></script>      

       
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
  <x-adminfooter />