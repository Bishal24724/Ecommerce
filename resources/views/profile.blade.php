<x-header />

    <!-- Map Begin -->
   

    <!-- Contact Section Begin -->
    <section class="contact spad">
        <div class="container">
            <div class="row">
               
                <div class="col-lg-6 col-md-6 mx-auto">
                   
                        <div class="section-title">

                            <h2>My Account</h2>
                        </div>
                    <div class="contact__form">
                        @if(session()->has('success'))
                        <div class="alert alert-success">
                         <p>{{ session()->get('success')}}</p>
                        </div>
                     @endif
                        <img src="{{URL::asset('uploads/profiles/'.$user->picture)}}" class="mx-auto d-block mb-2" width='200px' alt="">
                        <form action=" {{URL::to('updateUser')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6">
                                    <input type="text" name="fullname" placeholder="fullname" value="{{ $user->fullname}}" required>
                                    @error('fullname')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                                </div>
                                <div class="col-lg-6">
                                    <input type="email" name="email" placeholder="Email"value="{{ $user->email}}"  required>
                                    @error('email')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                </div>
                                <div class="col-lg-12">
                                    <input type="file"  name="file" >
                                    @error('file')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                                </div>
                                <div class="col-lg-12">
                                    <input type="text" placeholder="password"value="{{ $user->password}}"  name="password" required>
                                    @error('password')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                </div>
                                
                                <div class="col-lg-12">
                                   
                                    <button type="submit" name="register" class="site-btn">Save Change</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Contact Section End -->

  <x-footer />