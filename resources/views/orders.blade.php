<x-header />

    <!-- Map Begin -->
   

    <!-- Contact Section Begin -->
    <section class="contact spad">
        <div class="container">
            <div class="row">
               
                <div class="col-lg-8 col-md-8 mx-auto">
                   
                        <div class="section-title">

                            <h2>My ORDER HISTORY</h2>
                        </div>
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>S.N</th>
                                    <th>Total Bill</th>
                                    <th>Name</th>
                                    <th>Address</th>
                                    <th>Phone</th>
                                    <th>Status</th>
                                    <th>Order Date</th>
                                    <th>View Products</th>
                                    <th>Invoice/ Bill</th>

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
                                        <td>
                                            {{$i}}

                                        </td>
                                        <td>
                                            {{$item->bill}}
                                        </td>
                                        <td>
                                            {{$item->fullname}}
                                        </td>
                                        <td>
                                            {{$item->address}}
                                        </td>
                                        <td>
                                            {{$item->phone}}
                                        </td>
                                        <td>
                                            {{ $item->status}}
                                        </td>
                                        <td>
                                            {{ $item->created_at}}
                                        </td>
                                              <td>
                                                <!-- Button to Open the Modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal{{ $i}}">
    Products
  </button>
  
  <!-- The Modal -->
  <div class="modal" id="myModal{{ $i}}">
    <div class="modal-dialog">
      <div class="modal-content">
  
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">All Products</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
  
        <!-- Modal body -->
        <div class="modal-body">
         <table class="table">
            <thead>
                <tr>
                    <th>
                        Product
                    </th>
                    <th>
                        Quantity
                    </th>
                    <th>
                        Price
                    </th>
                    <th>
                        Subtotal
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $product)
                     @if ($item->id ==$product->orderId)
                         
                  
                    <tr>
                        <td>
                            <img src="{{ URL::asset('uploads/products'.$product->picture)}}" width="100px" alt="" srcset="">
                            {{ $product->title }}
                        </td>
                        <td>
                            {{ $product->quantity }}

                        </td>
                        <td>
                            {{ $product->price }}
                        </td>
                        <td>
                            {{ $product->price * $product->quantity }}
                        </td>
                    </tr>
                    @endif
                @endforeach
            </tbody>
         </table>
        </div>
  
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
  
      </div>
    </div>
  </div>
                                              </td>
                                              <td> 
                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myinvoice{{ $i}}">
                                                    Invoice
                                                  </button>
                                                  <div class="modal" id="myinvoice{{ $i}}">
                                                    <div class="modal-dialog">
                                                      <div class="modal-content">
                                                  
                                                        <!-- Modal Header -->
                                                        <div class="modal-header">
                                                          <h4 class="modal-title">Invoice</h4>
                                                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        </div>
                                                  
                                                        <!-- Modal body -->
                                                        <div class="modal-body">
                                                             <div class="row">
                                                                <div class="col-12">
                                                                    <div class="row">
                                                                        <div class="col-lg-12 col-md-12">
                                                                               <p class="text-center mb-0">Lyrics Fancy</p>
                                                                               <p class="text-center mb-0">Kanchan-03,Haraiya </p>
                                                                               <p class="text-center">Kathmandu,Nepal </p>
                                                                               <hr>
                                                                               
                                                                        </div>
                                                                        </div>
                                                                           <div class="row">
                                                                            <div class="col-md-12">
                                                                                 <div class="float-left"> Invoice No: {{$item->id}}</div> {{-- Invoice no as Order No --}}
                                                                                  <div class="float-right">Date: {{now()->format('d-m-Y')}}</div>
                                                                            </div>
                                                                           </div>
                                                                        <div class="row">
                                                                            <div class="col-lg-12 col-md-12">
                                                                                <table class="table table-striped">
                                                                                    <thead>
                                                                                        <tr>
                                                                                            <th>
                                                                                                Product
                                                                                            </th>
                                                                                            <th>
                                                                                                Quantity
                                                                                            </th>
                                                                                            <th>
                                                                                                Price
                                                                                            </th>
                                                                                            <th>
                                                                                                Subtotal
                                                                                            </th>
                                                                                        </tr>
                                                                                    </thead>
                                                                                    <tbody>
                                                                                        @foreach ($items as $product)
                                                                                             @if ($item->id ==$product->orderId)
                                                                                                 
                                                                                          
                                                                                            <tr>
                                                                                                <td>
                                                                                                    <img src="{{ URL::asset('uploads/products'.$product->picture)}}" width="100px" alt="" srcset="">
                                                                                                    {{ $product->title }}
                                                                                                </td>
                                                                                                <td>
                                                                                                    {{ $product->quantity }}
                                                                        
                                                                                                </td>
                                                                                                <td>
                                                                                                    NRS. {{ $product->price }}
                                                                                                </td>
                                                                                                <td>
                                                                                                    {{ $product->price * $product->quantity }}
                                                                                                </td>
                                                                                            </tr>
                                                                                            @endif
                                                                                        @endforeach
                                                                                    </tbody>
                                                                                 </table>
                                                                            </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row d-flex">
                                                                    
                                                                    <div class="col-12 justify-content-end">
                                                                        <table>
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td>Sub Total</td>
                                                                                        <td> NRS. {{ $item->bill}}</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                       <td>Vat</td>
                                                                                    <td>
                                                                                       NRS. {{ $item->vat}}
                                                                                    </td>

                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>Total</td>
                                                                                        <td>
                                                                                            NRS. {{ $item->total}}
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                        </table>
                                                                    </div>

                                                                   
                                                                </div>
                                              
                                                             </div>
                                                             
                                                             
                                                             {{--
                                                         <table class="table">
                                                            <thead>
                                                                <tr>
                                                                    <th>
                                                                        Product
                                                                    </th>
                                                                    <th>
                                                                        Quantity
                                                                    </th>
                                                                    <th>
                                                                        Price
                                                                    </th>
                                                                    <th>
                                                                        Subtotal
                                                                    </th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($items as $product)
                                                                     @if ($item->id ==$product->orderId)
                                                                         
                                                                  
                                                                    <tr>
                                                                        <td>
                                                                            <img src="{{ URL::asset('uploads/products'.$product->picture)}}" width="100px" alt="" srcset="">
                                                                            {{ $product->title }}
                                                                        </td>
                                                                        <td>
                                                                            {{ $product->quantity }}
                                                
                                                                        </td>
                                                                        <td>
                                                                            {{ $product->price }}
                                                                        </td>
                                                                        <td>
                                                                            {{ $product->price * $product->quantity }}
                                                                        </td>
                                                                    </tr>
                                                                    @endif
                                                                @endforeach
                                                            </tbody>
                                                         </table>

                                                         --}}
                                                        </div>
                                                  
                                                        <!-- Modal footer -->
                                                        <div class="modal-footer">
                                                            <button class="btn btn-primary float-right">Print</button>
                                                          <button type="button" class="btn btn-danger float-left" data-dismiss="modal">Close</button>
                                                        </div>
                                                  
                                                      </div>
                                                    </div>
                                                  </div>
                                              </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                
                </div>
            </div>
        </div>
    </section>
    <!-- Contact Section End -->

  <x-footer />