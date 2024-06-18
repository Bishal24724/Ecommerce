<x-adminheader title="Products"/>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
        
        
         
          <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card"> 
                <div class="card-body">
<<<<<<< HEAD
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

=======
                 
                    <p class="card-title mb-0">Top Products</p>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addNewModel">
                        Add New
                      </button>
>>>>>>> e31fac9ad9f10a682d75292519a4f49c506267d2
                      <div class="modal" id="addNewModel" >
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">

                            <div class="modal-header">
<<<<<<< HEAD
                               <h5 class="modal-title" >Add New Product</h5> 
=======
                              <h5 class="modal-title" >Add New Product</h5>
>>>>>>> e31fac9ad9f10a682d75292519a4f49c506267d2
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                            <form action="{{ URL::to('AddNewProduct')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <label for="">Title</label>
                            <input type="text" name="title" class="form-control mb-2" placeholder="Enter Title"required>
                            @error('title')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                            <label for="">price</label>
                            <input type="text" name="price" class="form-control mb-2" placeholder="Enter Price (NRS)"required>
                            @error('price')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                            <label for="">Quantity</label>
                            <input type="text" name="quantity" class="form-control mb-2" placeholder="Enter Quantity"required>
                            @error('quantity')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                            <label for="">Picture</label>
                            <input type="file" name="file" class="form-control mb-2" required>
                            @error('file')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            <label for="">Description</label>
                            
                            <input type="text" name="description" class="form-control mb-2" placeholder="Enter Description"required>
                            @error('description')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                            <label for="">Category</label>
                           <select name="category" class="form-control mb-2 ">
                            <option value="">Select Category</option>
                           <option value="Accessories">Accessories</option>
                           <option value="Shoes">shoes</option>
                           <option value="Clothes">Clothes</option>
                            </select>
                            @error('category')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                            <label for="">Type</label>
                           <select name="type" class="form-control mb-2">
                            <option value="">Select Type</option>
                           <option value="Best Sellers">Best Sellers</option>
                           <option value="new-arrivals">New Arrivals</option>
                           <option value="new-arrivals">Sale</option>
                            </select>
                            @error('type')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
<<<<<<< HEAD
                        <label for="">Vendor</label>
                        <select name="vendor" class="form-control mb-2">
                          <option value="">Select Type</option>
                        @foreach ($vendor as $user)
                        <option value="{{$user->id}}">{{$user->name}}</option>
                            
                        @endforeach
                        
                         </select>
                         @error('vendor')
                         <div class="alert alert-danger">{{ $message }}</div>
                     @enderror
=======
>>>>>>> e31fac9ad9f10a682d75292519a4f49c506267d2

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
<<<<<<< HEAD
                    <table  id="myTable" class="table display table-striped table-borderless">
=======
                    <table class="table table-striped table-borderless">
>>>>>>> e31fac9ad9f10a682d75292519a4f49c506267d2
                      <thead>
                        <tr>
                          <th>Title</th>
                          <th>Picture</th>
                          <th>Price</th>
                          <th>Quantity</th>
                          <th>Category</th>
<<<<<<< HEAD
                          
                          <th>Type</th>
                          <th>Vendor</th>
                          {{-- <th>Update</th> --}}
=======
                          <th>Type</th>
                           <th>Update</th>
>>>>>>> e31fac9ad9f10a682d75292519a4f49c506267d2
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
                            <td class="font-weight-medium"><div class="badge badge-success">{{$item ->category}}</div></td>
                            <td class="font-weight-medium"><div class="badge badge-info">{{$item ->type}}</div></td>
<<<<<<< HEAD
                            <td class="font-weight-medium"><div class="badge badge-dark">{{ $item->vendor_name}}</td>
                         {{--   <td class="font-weight-small">
                            
=======
                            <td class="font-weight-small">
>>>>>>> e31fac9ad9f10a682d75292519a4f49c506267d2
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#updateModel{{ $i}}">
                                    Update
                                  </button>
                                  <div class="modal" id="updateModel{{ $i}}" >
                                    <div class="modal-dialog" role="document">
                                      <div class="modal-content">
            
                                        <div class="modal-header">
                                          <h5 class="modal-title" > update Product </h5>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                          </button>
                                        </div>
                                        <div class="modal-body">
                                        <form action="{{ URL::to('UpdateProduct')}}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <label for="">Title</label>
                                        <input type="text" name="title"  value="{{ $item->title}}" class="form-control mb-2" placeholder="Enter Title"required>
<<<<<<< HEAD
                                          @error('title')
                                          <div class="alert alert-danger">{{ $message }}</div>
                                              
                                          @enderror
                                        <label for="">price</label>
                                        <input type="text" name="price" value="{{ $item->price}}" class="form-control mb-2" placeholder="Enter Price (NRS)"required>
                                        @error('price')
                                            <div class="alert alert-danger">{{ $message}}</div>
                                            
                                        @enderror
                                        <label for="">Quantity</label>
                                        <input type="text" name="quantity" value="{{ $item->quantity}}"  class="form-control mb-2" placeholder="Enter Quantity"required>
                                        @error('quantity')
                                            <div class="alert alert-danger">
                                              {{ $message}}
                                            </div>
                                        @enderror
                                        <label for="">Photo</label>
                                        <input type="file" name="file" value="{{ $item->file}}"  class="form-control mb-2" >

                                        @error('file')
                                        <div class="alert alert-danger">
                                          {{ $message}}
                                        </div>
                                    @enderror

=======
                                        <label for="">price</label>
                                        <input type="text" name="price" value="{{ $item->price}}" class="form-control mb-2" placeholder="Enter Price (NRS)"required>
                                        <label for="">Quantity</label>
                                        <input type="text" name="quantity" value="{{ $item->quantity}}"  class="form-control mb-2" placeholder="Enter Quantity"required>
                                        <label for="">Picture</label>
                                        <input type="file" name="file" value="{{ $item->description}}"  class="form-control mb-2" >
                                        
>>>>>>> e31fac9ad9f10a682d75292519a4f49c506267d2
                                        <label for="">Description</label>

                                        <input type="text" name="description" value="{{ $item->description}}"  class="form-control mb-2" placeholder="Enter Description"required>
                                        
<<<<<<< HEAD
                                        @error('description')
                                        <div class="alert alert-danger">
                                          {{ $message}}
                                        </div>
                                    @enderror

=======
>>>>>>> e31fac9ad9f10a682d75292519a4f49c506267d2
                                        <label for="">Category</label>
                                       <select name="category" class="form-control mb-2 ">
                                        <option value="{{ $item->category}}" >{{ $item->category}}</option>
                                       <option value="Accessories">Accessories</option>
                                       <option value="Shoes">shoes</option>
                                       <option value="Clothes">Clothes</option>
                                        </select>
<<<<<<< HEAD
                                        
                                        @error('category')
                                        <div class="alert alert-danger">
                                          {{ $message}}
                                        </div>
                                    @enderror
=======
>>>>>>> e31fac9ad9f10a682d75292519a4f49c506267d2
                                        <label for="">Type</label>
                                       <select name="type" class="form-control mb-2">
                                        <option value="{{ $item->type}}">{{ $item->type}}</option>
                                       <option value="Best Sellers">Best Sellers</option>
                                       <option value="new-arrivals">New Arrivals</option>
                                       <option value="new-arrivals">Sale</option>
                                        </select>
<<<<<<< HEAD
                                           
                                        @error('type')
                                        <div class="alert alert-danger">
                                          {{ $message}}
                                        </div>
                                    @enderror
                                        <label for="">Vendor</label>
                                        <select name="vendor" class="form-control mb-2">
                                          <option value="">Select Type</option>
                                        @foreach ($vendor as $user)
                                        <option value="{{$user->id}}">{{$user->name}}</option>
                                            
                                        @endforeach
                                           
                                        @error('vendor')
                                        <div class="alert alert-danger">
                                          {{ $message}}
                                        </div>
                                    @enderror
=======
>>>>>>> e31fac9ad9f10a682d75292519a4f49c506267d2
                                    <input type="hidden" name="id" value="{{ $item->id}}"  id="">
                                   <input type="submit" value="Save" name="save" class="btn btn-success" id="">
                                   
                                    </form>
                                        </div>
                                       
                                      </div>
                                    </div>
                                  </div>
                            </td>
<<<<<<< HEAD
                            --}}
=======
>>>>>>> e31fac9ad9f10a682d75292519a4f49c506267d2
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
       
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
  <x-adminfooter />