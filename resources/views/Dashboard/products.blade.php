<x-adminheader title="Products"/>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
        
          <div class="row mb-4">
            <div class="col-lg-12">
              <div class="">
                  <a href="{{ URL::to('/admin')}}" class="text-black">Dashboard</a><span> >> </span>
                  <a href="{{ URL::to('/adminProducts')}}" class="text-black">Products</a>
                  
              </div>
          </div>
         
          <div class="row mt-3">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card"> 
                <div class="card-body">
                      <div class="error-danger">
                                 @if ($errors->any())
                                 <div class="alert alert-danger">
                                  
                                    @foreach ($errors->all() as $error)
                                    {{ $error }}
                                    <br>
                                    @endforeach
                                    
                                    </div>
                                  
                                    
                      </div>
                      @endif
                    <p class="card-title mb-0">Top Products</p>
                    {{--
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addNewModel">
                        Add New
                      </button>

                      --}}
                      

                    
                        </div>
                      </div>
                 
                  <div class="table-responsive">
                    @if (session()->has('success'))
                    <script>
                     swal.fire("", "{{ Session::get('success') }}", "success", {
                        button:true,
              button: "OK",
              timer:3000,
            });
            </script>
            @endif
                    <table  id="myTable" class="table display table-striped table-borderless">
                      <thead>
                        <tr>
                          <th>Title</th>
                          <th>Picture</th>
                          <th>Price</th>
                          <th>Quantity</th>
                          <th>Category</th>
                          
                          <th>Type</th>
                          <th>Vendor</th>
                          <th>Sizes</th>
                 <th>Rate</th>
                          
                           <th>Delete</th>
                        </tr>  
                      </thead>
                      <tbody>
                      @php
                          $i=0;
                      @endphp
        
                        @foreach ($products as $item)
                        @php
                        $i++;
                    @endphp
                        <tr>
                            <td>{{$item->title}}</td>
                            <td><img src="{{URL::asset('uploads/products/'.$item->picture)}}" alt="img" width="100px" srcset=""></td>
                            <td class="font-weight-bold">{{ $item->price}}</td>
                            <td>{{ $item->quantity}}</td>
                            <td class="font-weight-medium"><div class="badge badge-success">{{$item ->category->cname}}</div></td>
                            <td class="font-weight-medium"><div class="badge badge-info">{{$item ->type->tname}}</div></td>
                            <td class="font-weight-medium"><div class="badge badge-dark">{{ $item->vendor_name}}</td>
                              <td class="font-weight-bold">
                                @foreach ($item->sizes as $size)
                                <div class="mt-3">{{ $size->size }}</div>
                                @endforeach
                            </td>
                            <td class="font-weight-bold">
                              @foreach ($item->sizes as $size)
                              <div class="mt-3">{{ $size->rate }}</div>
                              @endforeach
                          </td>
                     
                            <td>
                              <a href="{{ URL::to('deleteProduct/'.$item->id)}}" class="btn btn-danger">Delete</a>
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
       

  <x-adminfooter />