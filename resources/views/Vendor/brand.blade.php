<x-vendorheader :notifications="$notifications" />
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row mb-4">
            <div class="col-lg-12">
                <div class="">
                    <a href="{{ URL::to('/vendor')}}" class="text-black">Vendor</a><span> >> </span>
                    <a href="{{ URL::to('/vendorbrand')}}" class="text-black">Brand</a>
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
                        <p class="card-title mb-2">All Brand</p>
                       
                        <button type="button" class=" btn btn-success fa-sharp fa-solid fa-plus" data-toggle="modal" val data-target="#addNewModel">
                          New Product
                        </button>

                        <!-- Add New Product Modal -->
                        <div class="modal" id="addNewModel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title"> <i class="fa-solid fa-plus" style="color:rgb(56, 21, 250)"></i>Add Brand</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ URL::to('AddNewBrand')}}" method="POST">
                                            @csrf
                                            <label for="">Name</label>
                                            <input type="text" name="name" class="form-control mb-2" placeholder="Enter Brand" value="{{ old('name') }}"  @error('name') is-invalid @enderror required>
                                            @error('name')
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
                                    button: true,
                                    button: "OK",
                                    timer: 3000,
                                });
                            </script>
                            @endif
                            <table id="myTable" class="table display table-striped table-borderless">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                       
                                       
                                        <th>Update</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $i=0;
                                    @endphp

                                    @foreach ($brands as $item)
                                    @php
                                    $i++;
                                    @endphp
                                    <tr>
                                        <td>@php
                                            echo $i;
                                        @endphp             
                                        <td>{{$item->bname}}</td>
                                       
                                        
                                                  
                                        </td>
                                        <td class="font-weight-small">
                                            <button type="button" class="btn" data-toggle="modal" data-target="#updateModel{{ $i}}">
                                              <i class="fa-solid fa-pen-to-square" style="color: #440cec;"> </i>
                                            </button>
                                            <div class="modal" id="updateModel{{ $i}}" >
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Update Brand</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{ URL::to('UpdateBrand')}}" method="POST">
                                                                @csrf
                                                                <label for="">Title</label>
                                                                <input type="text" name="name" value="{{ $item->bname}}" class="form-control mb-2" placeholder="Enter Brand Name" required>
                                                                @error('name')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                                @enderror

                                                               
                    
                                                               
                                                                
                                                               

                                                                <input type="hidden" name="id" value="{{ $item->id}}" id="">
                                                                <input type="submit" value="Save" name="save" class="btn btn-success mt-4" id="">
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <a href="{{ URL::to('deleteBrand/'.$item->id)}}" class="btn"><i class="fa-solid fa-trash-can" style="color: red;"></i></a>
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

        

        <x-vendorfooter />
