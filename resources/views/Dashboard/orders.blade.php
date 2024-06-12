<x-adminheader title="Order" />
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
        
        
         
          <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                    <p class="card-title mb-0">Our Orders</p>
                   
                 
                  <div class="table-responsive">
                    <table class="table table-striped table-borderless">
                      <thead>
                        <tr>
                          <th>Customer</th>
                         
                          <th>Bill</th>
                          <th>Phone</th>
                          <th>Address</th>
                          <th>Order Status</th>
                          <th>Order Date </th>
                          <th>Product</th>
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
       
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
  <x-adminfooter />