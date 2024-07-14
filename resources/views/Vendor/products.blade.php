<x-vendorheader :notifications="$notifications" />
<style>
    .table td img, .jsgrid .jsgrid-table td img
    {
        width: 100px;
    height: 100px;
    border-radius: 0%;
    }
    </style>
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row mb-4">
            <div class="col-lg-12">
                <div class="">
                    <a href="{{ URL::to('/admin')}}" class="text-black">Vendor</a><span> >> </span>
                    <a href="{{ URL::to('/adminProducts')}}" class="text-black">products</a>
                </div>
            </div>
        </div>

        <div class="row">
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
                            @endif
                        </div>
                        <p class="card-title mb-2">All Products</p>
                       
                        
                        <button type="button" class="btn btn-success fa-sharp fa-solid fa-plus mb-5 " data-toggle="modal" val data-target="#addNewModel">
                          New Product
                        </button>
                       

                        
                        <!-- Add New Product Modal -->
                        <div class="modal" id="addNewModel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title"> <i class="fa-solid fa-plus" style="color:rgb(56, 21, 250);"></i>Add Product</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ URL::to('AddNewProduct')}}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <label for="">Title</label>
                                            <input type="text" name="title" class="form-control mb-2" placeholder="Enter Title" value="{{ old('title') }}"  @error('title') is-invalid @enderror required>
                                            @error('title')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror

                                            <label for="">Price</label>
                                            <input type="text" name="price" class="form-control mb-2" placeholder="Enter Price (NRS)" value="{{old('price')}}" @error('price') is-invalid @enderror required>
                                            @error('price')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror

                                            <label for="">Quantity</label>
                                            <input type="text" name="quantity" class="form-control mb-2" placeholder="Enter Quantity" value="{{ old('quantity')}}" @error('quantity')
                                                
                                            @enderror required>
                                            @error('quantity')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror

                                            <label for="">Picture</label>
                                            <input type="file" name="file" class="form-control mb-2" id="file" required>
                                            @error('file')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                            <div id="imagePreview" style="display:none; max-width: 100%; height: auto;"> </div>

                                            <label for="">Description</label>
                                            <input type="text" name="description" class="form-control mb-2" placeholder="Enter Description" required>
                                            @error('description')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror

                                            <label for="">Category</label>
                                            <select name="category" class="form-control mb-2" id="select2" required>
                                                @foreach($categories as $item)
                                                <option value="{{$item->id}}">{{$item->cname }}</option>
                                                @endforeach
                                            </select>
                                            @error('category')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                            <br>

                                            <label for="">Type</label>
                                            <select name="type" class="form-control mb-2 " id="type" required>
                                                <option value="">Select Type</option>
                                                @foreach ($types as $item)
                                                <option value="{{ $item->id}}"> {{$item->tname }}</option> 
                                                @endforeach
                                            </select>
                                            @error('type')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                            <br>

                                            <label for="brand">Brand</label>
                                            <select name="brand" class="form-control mb-4" id="brand" required>
                                               
                                                @foreach ($brands as $item)
                                                <option value="{{ $item->id }}" data-tokens="{{$item->bname }}" > {{$item->bname }}</option> 
                                                @endforeach
                                            </select>
                                            @error('brand')
                                            <div class="alert alert-danger">{{$message}}</div>
                                            @enderror
                                            <br>
                                            <br>
                
                                            <label for="">Sizes and Rates</label>
                                            <div id="sizeRateContainer"></div>
                                            <button type="button" id="addSizeRateBtn" class="btn btn-secondary mx-2 mb-3">Add Size</button>
                                               <br>
                                            <input type="submit" value="Save" name="save" class="btn btn-success mt-4">
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            @if (session()->has('success'))
                            <script>
                                swal.fire("", "{{ Session::get('success') }}", "success", {
                                    button: true,
                                    button: "OK",
                                    timer: 3000,
                                });
                            </script>
                            @endif
                            <table id="myTable" class="table display table-striped table-borderless">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Picture</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Category</th>
                                        <th>Type</th>
                                        <th>Brand</th>
                                        <th>Sizes</th>
                                        <th>Rates</th>
                                        <th>View Product</th>
                                        <th>Update</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $i=0;
                                    @endphp

                                    @foreach($products as $item)
                                    @php
                                    $i++;
                                    @endphp
                                    <tr>
                                        <td>{{$item->title}}</td>
                                        <td><img src="{{URL::asset('uploads/products/'.$item->picture)}}" alt="img" width="100px"></td>
                                        <td class="font-weight-bold">{{ $item->price}}</td>
                                        <td>{{ $item->quantity}}</td>
                                        <td class="font-weight-medium">
                                            <div class="badge badge-success">{{$item->category->cname}}</div>
                                        </td>
                                        <td class="font-weight-medium">
                                            <div class="badge badge-info">{{$item ->type->tname}}</div>
                                        </td>
                                        <td class="font-weight-medium">
                                            <div class="badge badge-primary">{{$item ->brand->bname}}</div>
                                        </td>
                                        <td class="font-weight-bold">
                                            @if ($item->sizes && $item->sizes->count() > 0)

                                            @foreach ($item->sizes as $size)
                                            <div class="mt-3">{{ $size->size }}</div>
                                            @endforeach
                                            @endif
                                        </td>
                                        <td class="font-weight-bold">
                                            @if ($item->sizes && $item->sizes->count() > 0)
                                            @foreach ($item->sizes as $size)
                                            <div class="mt-3">{{ $size->rate }}</div>
                                            @endforeach
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{route('products.view',$item->id)}}" class="btn fa-light fa-eye" style="color: #0e429a;"></a>
                                        </td>

                                        {{-- View Only file 
                                        <td>
                                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#viewModel{{ $i}}">
                                                View
                                            </button>
                                            <div class="modal" id="viewModel{{ $i}}">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Product</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="">
                                                                @csrf
                                                                <label for="">Title</label>
                                                                <input type="text" name="title" value="{{ $item->title}}" class="form-control mb-2" readonly />
                                                           

                                                                <label for="">Price</label>
                                                                <input type="text" name="price" value="{{ $item->price}}" class="form-control mb-2" readonly />
                                                              

                                                                <label for="">Quantity</label>
                                                                <input type="text" name="quantity" value="{{ $item->quantity}}" class="form-control mb-2" readonly />
                                                             

                                                                <label for="">Picture</label>
                                                                <input type="file" name="file" class="form-control mb-2">
                                                        

                                                                <label for="">Description</label>
                                                                <input type="text" name="description" value="{{ $item->description}}" class="form-control mb-2" readonly />
                                                            
                                                                <label for="">Category</label>
                                                                <select name="category" class="form-control mb-2" disabled>
                                                                    @foreach($categories as $item)
                                                                    <option value="{{$item->id}}">{{$item->cname}}</option>
                                                                    @endforeach 
                                                                </select>
           
                                                                <label for="">Type</label>
                                                                <select name="type" class="form-control mb-2" disabled>
                                                                    @foreach($types as $item)
                                                                    <option value="{{$item->id}}">{{$item->tname}}</option>
                                                                    @endforeach
                                                                </select>
                                                             

                                                                <label for="">Brand</label>
                                                                <select name="brand" class="form-control mb-2" disabled>
                                                                    @foreach($brands as $item)
                                                                    <option value="{{$item->id}}">{{$item->bname}}</option>
                                                                    @endforeach     
                                                                </select>
                                                             
                                                                @if ($item->sizes && $item->sizes->count() > 0)
                                                                @foreach ($item->sizes as $size)
                                                                <div class="mt-3">
                                                                    <input type="text" class="form-control mb-2" value="{{ $size->size }}" readonly>
                                                                    <input type="text" class="form-control mb-2" value="{{ $size->rate }}" readonly>
                                                                </div>
                                                                @endforeach
                                                                @endif
                                                                
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        --}}
                                        <td class="font-weight-small">
                                            <button type="button" class="btn" data-toggle="modal" data-target="#updateModel{{ $i}}">
                                              <i class="fa-solid fa-pen-to-square" style="color: #0820f5;"> </i>
                                            </button>
                                           <div class ="modal" id="updateModel{{ $i}}" >
                                                <div class="modal-dialog" role="document" >
                                                    <div class="modal-content" >
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Update Product</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{ URL::to('UpdateProduct') }}" method="POST" enctype="multipart/form-data">
                                                                @csrf
                                                                <label for="title">Title</label>
                                                                <input type="text" name="title" value="{{ $item->title }}" class="form-control mb-2" />
                                                                  <br>
                                                                <label for="price">Price</label>
                                                                <input type="text" name="price" value="{{ $item->price }}" class="form-control mb-2" />
                                                                <br>
                                                                <label for="quantity">Quantity</label>
                                                                <input type="text" name="quantity" value="{{ $item->quantity }}" class="form-control mb-2" />
                                                                 <br>
                                                                <label for="file">Picture</label>
                                                                <input type="file" id="ufile" name="file" class="form-control mb-2">
                                                                <div id="imageWatch" style="display:none; max-width: 100%; height:100%;"> </div>
                                                                <br>
                                                                <label for="description">Description</label>
                                                                <input type="text" name="description" value="{{ $item->description }}" class="form-control mb-2" />
                                                                 <br>
                                                                <label for="category">Category</label>
                                                                <select name="category" class="form-control mb-2" id="ucategory">
                                                                    @foreach($categories as $category)
                                                                        <option value="{{ $category->id }}" @if($category->id == $item->category_id) selected @endif>{{ $category->cname }}</option>
                                                                    @endforeach
                                                                </select>
                                        
                                                                <label for="type">Type</label>
                                                                <select name="type" class="form-control mb-2" id="utype">
                                                                    @foreach($types as $type)
                                                                        <option value="{{ $type->id }}" @if($type->id == $item->type_id) selected @endif>{{ $type->tname }}</option>
                                                                    @endforeach
                                                                </select>
                                                                   <br>
                                                                <label for="brand">Brand</label>
                                                                <select name="brand" class="form-control mb-2" id="ubrand">
                                                                    @foreach($brands as $brand)
                                                                        <option value="{{ $brand->id }}" @if($brand->id == $item->brand_id) selected @endif>{{ $brand->bname }}</option>
                                                                    @endforeach
                                                                </select>
                                                                  <br>
                                                                  <br>
                                                                <label for="sizeRate">Sizes and Rates</label>
                                                                <div id="updateSizeRateContainer{{ $i }}">
                                                                    @if ($item->sizes && $item->sizes->count() > 0)
                                                                        @foreach ($item->sizes as $size)
                                                                            <div class="d-flex mb-2">
                                                                                <input type="text" name="sizes[]" value="{{ $size->size }}" class="form-control mx-2" placeholder="Size" required>
                                                                                <input type="text" name="rates[]" value="{{ $size->rate }}" class="form-control mx-2" placeholder="Rate" required>
                                                                            </div>
                                                                        @endforeach
                                                                    @endif
                                                                </div>
                                                                <button type="button" class="btn btn-secondary mx-2 mb-3" onclick="addUpdateSizeRate({{ $i }})">Add Size</button>
                                        
                                                                <input type="hidden" name="id" value="{{ $item->id }}">
                                                                
                                                                <br>
                                                                <br>
                                                                <hr style="border:1px solid black;">
                                                                <input type="submit" class="btn btn-success mt-4" value="Save">
                                                                <br>
                                                            </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                          
                                        </td>
                                        <td>
                                            <a href="{{ url('deleteProduct/'.$item->id) }}">
                                                <button type="button" class="btn"><i class="fa-solid fa-trash-can" style="color: red;"></i></button>
                                            </a>
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
    </div>
</div>


<script type="text/javascript">


    document.addEventListener('DOMContentLoaded', function() {
        let addSizeRateBtn = document.getElementById('addSizeRateBtn');
        let sizeRateContainer = document.getElementById('sizeRateContainer');

        addSizeRateBtn.addEventListener('click', function() {
            let sizeRateDiv = document.createElement('div');
            sizeRateDiv.classList.add('d-flex', 'mb-2');

            let sizeInput = document.createElement('input');
            sizeInput.type = 'text';
            sizeInput.name = 'sizes[]';
            sizeInput.classList.add('form-control', 'mx-2');
            sizeInput.placeholder = 'Size';
            sizeInput.required = true;

            let rateInput = document.createElement('input');
            rateInput.type = 'text';
            rateInput.name = 'rates[]';
            rateInput.classList.add('form-control', 'mx-2');
            rateInput.placeholder = 'Rate';
            rateInput.required = true;

            sizeRateDiv.appendChild(sizeInput);
            sizeRateDiv.appendChild(rateInput);

            sizeRateContainer.appendChild(sizeRateDiv);
        });
    });
    function addUpdateSizeRate(index) {
    let sizeRateContainer = document.getElementById('updateSizeRateContainer' + index);

    let sizeRateDiv = document.createElement('div');
    sizeRateDiv.classList.add('d-flex', 'mb-2');

    let sizeInput = document.createElement('input');
    sizeInput.type = 'text';
    sizeInput.name = 'sizes[]';
    sizeInput.classList.add('form-control', 'mx-2');
    sizeInput.placeholder = 'Size';
    sizeInput.required = true;

    let rateInput = document.createElement('input');
    rateInput.type = 'text';
    rateInput.name = 'rates[]';
    rateInput.classList.add('form-control', 'mx-2');
    rateInput.placeholder = 'Rate';
    rateInput.required = true;

    sizeRateDiv.appendChild(sizeInput);
    sizeRateDiv.appendChild(rateInput);

    sizeRateContainer.appendChild(sizeRateDiv);
}

  
// file or photo preview while updating form


document.getElementById('file').addEventListener("change",function(){
    var reader=new FileReader();
    reader.onload= function(e){
        var imagePreview= document.getElementById("imagePreview");
        imagePreview.innerHTML = '<img src="' + e.target.result + '" width="200px" height="200px" class="d-flex justify-content-center" alt="Image" />';
         imagePreview.style.display = 'block'; 
    };
    reader.readAsDataURL(this.files[0]);
});

//preview image while updating

/*
document.getElementById('ufile').addEventListener("change",function(){
    var reader=new FileReader();
    reader.onload= function(e){
        var imageWatch= document.getElementById("imageWatch");
        imageWatch.innerHTML = '<img src="' + e.target.result + '" width="150px" height="150px"  style="margin-left:100px;"  alt="Image" />';
         imageWatch.style.display = 'block'; 
    };
    reader.readAsDataURL(this.files[0]);

})
    */
    document.getElementById('ufile').addEventListener("change", function() {
        if (this.files && this.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                var imagePreview = document.getElementById("imageWatch");
                imagePreview.innerHTML = '<img src="' + e.target.result + '" width="150px" height="150px"  style="margin-left:100px;"  alt="Image" />';
                imagePreview.style.display = 'block'; 
            };
            reader.readAsDataURL(this.files[0]);
        }
    });


</script>

<x-vendorfooter />