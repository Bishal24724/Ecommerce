<x-adminheader  title="Message"/>


<div class="main-panel">
    <div class="content-wrapper">
        <div class="row mb-4">
            <div class="col-lg-12">
                <div class="">
                    <a href="£" class="text-black">Admin</a><span> >> </span>
                    <a href="£" class="text-black">Message</a>
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
                        <p class="card-title mb-3">All Message</p>
                          <br>
                       
                        <button type="button" class=" btn btn-success fa-sharp fa-solid fa-plus mb-3" data-toggle="modal" val data-target="#addNewModel">
                          New Message
                        </button>

                        <!-- Add New Product Modal -->
                        <div class="modal" id="addNewModel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title"> <i class="fa-solid fa-plus" style="color:rgb(56, 21, 250)"></i>Add Message</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ URL::to('AddNewMessage')}}" method="POST">
                                            @csrf
                                            <label for="">Title</label>
                                            <input type="text" name="title" class="form-control mb-2" placeholder="Enter Title" required>
                                            @error('title')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                            
                                            <label for="">Vendor</label>
                                            <br>
                                            <select name="vendor" id="vendor" value="" class="form-control mb-2">
                                                <option value="all" class="form-control">All vendor</option>
                                            @foreach ($vendors as $vendor)
                                                  <option value="{{ $vendor->email}}" class="form-control">{{$vendor ->name}}</option>
                                            @endforeach
                                            </select>
                                            @error('vendor')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                            <br>
                                           <label for="">Message </label> 
                                            <textarea name="message" class="form-control mb-2" placeholder="Enter Message"
                                            required></textarea>
                                            @error('message')
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
                                       <th>Message</th>
                                       <th>Created at</th>
                                  
                                        <th>Update</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $i=0;
                                    @endphp

                                    @foreach ($notification as $item)
                                    @php
                                    $i++;
                                    @endphp
                                    <tr>
                                        <td>@php
                                            echo $i;
                                        @endphp             
                                        <td>{{$item->title}}</td>
                                        <td>{{$item->message}}</td>
                                        <td class="text-center ">{{$item->created_at}}</td>
                                       
                                        
                                                  
                                        </td>
                                        <td class="font-weight-small">
                                            <button type="button" class="btn" data-toggle="modal" data-target="#updateModel{{ $i}}">
                                              <i class="fa-solid fa-pen-to-square" style="color: #4611e7;"> </i>
                                            </button>
                                            <div class="modal" id="updateModel{{ $i}}" >
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Update Type</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{ URL::to('updateMessage')}}" method="POST">
                                                                @csrf
                                                                <label for="">Title</label>
                                                                <input type="text" name="title" value="{{ $item->title}}" class="form-control mb-2" placeholder="Enter Message" required>
                                                                @error('name')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                                @enderror

                                                                <label for="">Message</label>
                                                                <input type="text" name="message" value="{{ $item->message}}" class="form-control mb-2" placeholder="Enter Message" required>
                                                                @error('name')
                                                                <div class="alert alert-danger">{{ $message }}</div>
                                                                @enderror

                                                               
                    
                                                               <label for="Vendor">Vendor</label>
                                                             <select name="vendor" id="vendor" value="all">All Vendor</select>

                                                                
                                                               

                                                                <input type="hidden" name="id" value="{{ $item->id}}" id="">
                                                                <input type="submit" value="Save" name="save" class="btn btn-success mt-4" id="">
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <a href="{{ URL::to('deleteMessage/'.$item->id)}}" class="btn"><i class="fa-solid fa-trash-can"  style="color: red;"></i></a>
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