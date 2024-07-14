<x-vendorheader   />
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
        
        
         
          <div class="row">
            <div class="col-12 col-md-6  mx-auto grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                    <p class="card-title mb-0">My Profile</p>
                    <div class="contact__form">
                      @if (session()->has('success'))
                      <script>
                       swal.fire("", "{{ Session::get('success') }}", "success", {
                          button:true,
                button: "OK",
                timer:3000,
              });
              </script>
              @endif
                        <img src="{{URL::asset('uploads/profiles/'.$user->picture)}}" class="mx-auto d-block mb-2" width='200px' alt="">
                        <form action=" {{URL::to('updateUser')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6">
                                    <input type="text" name="fullname" class="form-control mb-2" placeholder="fullname" value="{{ $user->fullname}}" required>
                                    @error('fullname')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                </div>
                                <div class="col-lg-6">
                                    <input type="email" name="email" class="form-control  mb-2" placeholder="Email"value="{{ $user->email}}"  required>
                                    @error('email')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                </div>
                                <div class="col-lg-12">
                                    <input type="file" class="form-control  mb-2" name="file" >
                                    @error('file')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                </div>
                                <div class="col-lg-12">
                                    <input type="text" class="form-control  mb-2" placeholder=" New Password"   name="password" >
                                    @error('password')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                </div>
                                
                                <div class="col-lg-12">
                                   
                                    <button type="submit" name="register" class="btn btn-info">Save Change</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    
                </div>
              </div>
            </div>
          
          </div>
       
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
  <x-adminfooter />