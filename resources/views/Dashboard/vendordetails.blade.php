<x-adminheader title="Vendor" />
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
        
            <div class="row mb-5">
                <div class="col-lg-12">
                  <div class="">
                      <a href="{{ URL::to('/admin')}}" class="text-black">Dashboard</a><span> >> </span>
                      <a href="{{ URL::to('/vendordetail')}}" class="text-black">Vendor Details</a>
                      
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
                    <p class="card-title mb-2">Our Vendor</p>
                    <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#addNewModel">
                        Add New
                      </button>
                      
                      <div class="modal" id="addNewModel" >
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
  
                              <div class="modal-header">
                                <h5 class="modal-title" > Add Vendor </h5>
                               
                              
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                       
                            <div class="modal-body">
                            <form action="{{ URL::to('AddNewVendor')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <label for="">Title</label>
                            <input type="text" name="name" class="form-control mb-2" placeholder="Enter Vendor Name"required>
                            @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                            <label for="">Email</label>
                            <input type="email" name="email" class="form-control mb-2" placeholder="Enter Email Address" required>
                            @error('email')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <label for="">Phone</label>
                        <input type="text" name="phone" class="form-control mb-2" placeholder="Enter Phone Number" required>
                        @error('phone')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                            <label for="">Password</label>
                            <input type="password" name="password" class="form-control mb-2" placeholder="Enter password"required>
                            @error('password')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                            <label for="">Address</label>
                            <input type="text" name="address" class="form-control mb-2" required>
                            @error('address')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                          
                       <input type="submit" value="Save" name="save" class="btn btn-success" id="">
                       
                        </form>
                            </div>
                           
                          </div>
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
                    <table id="myTable" class=" table display table-striped table-borderless">
                      <thead>
                        <tr>
                          <th>Name</th>
                          <th>Address</th>
                          <th>Email</th>
                          <td>Phone</td>
                    
                          
                        
                          {{-- <th>Vendor</th> --}}
                           <th>Update</th>
                           <th>Delete</th>
                        </tr>  
                      </thead>
                      <tbody>
                      @php
                          $i=0;
                      @endphp
        
                        @foreach ($vendors as $item)
                        @php
                        $i++;
                    @endphp
                        <tr>
                            <td>{{$item->name}}</td>
                            <td>{{$item->address}}</td>
                            <td>{{$item->email}}</td>
                             <td>{{$item->phone}}</td>
                           
                            <td class="font-weight-small">
                                <button type="button" class="btn " data-toggle="modal" data-target="#updateModel{{ $i}}">
                                  <i class="fa-solid fa-pen-to-square" style="color: #0820f5;"> </i>
                                  </button>
                                  <div class="modal" id="updateModel{{ $i}}" >
                                    <div class="modal-dialog" role="document">
                                      <div class="modal-content">
            
                                        <div class="modal-header">
                                          <h5 class="modal-title" > update Vendor </h5>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                          </button>
                                        </div>
                                        <div class="modal-body">
                                        <form action="{{ URL::to('UpdateVendor')}}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <label for="">Title</label>
                                        <input type="text" name="name" value={{ $item->name }} class="form-control mb-2" placeholder="Enter Vendor Name"required>
                                        @error('name')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                        <label for="">Email</label>
                                        <input type="email" value="{{ $item->email}}" name="email" class="form-control mb-2" placeholder="Enter Email Address" required>
                                        @error('email')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                   
                                    <label for="">Phone</label>
                                    <input type="text" name="phone" value="{{ $item->phone}}" class="form-control mb-2" placeholder="Enter Phone Number" required>
                                    @error('phone')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                        <label for="">Address</label>
                                        <input type="text" name="address" value="{{$item->address}}" class="form-control mb-2" required>
                                        @error('address')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                    <input type="hidden" name="id" value="{{ $item->id}}"  id="">
                                   <input type="submit" value="Save" name="save" class="btn btn-success" id="">
                                   
                                    </form>
                                        </div>
                                       
                                      </div>
                                    </div>
                                  </div>
                            </td>
                            <td>
                              <a href="{{ URL::to('deleteVendor/'.$item->id)}}" class="btn">  <i class="fa-solid fa-trash" style="color: #e91313;"></i></a>
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