<x-header />

    <!-- Map Begin -->
   

    <!-- Contact Section Begin -->
    <section class="contact spad">
        <div class="container">
            <div class="row">
               
                <div class="col-lg-6 col-md-6 mx-auto">
                   
                        <div class="section-title">
                            <h2>Create New Account</h2>
                        </div>
                    <div class="contact__form">
                        <form action=" {{URL::to('registerUser')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6">
                                    <input type="text" name="fullname" placeholder="fullname" required>
                                    @error('fullname')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                                </div>
                                <div class="col-lg-6">
                                    <input type="email" name="email" placeholder="Email" required>
                                    @error('email')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                                </div>
                                <div class="col-lg-12">
                                    <input type="file"  name="file" required>
                                    @error('file')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                                </div>
                                <div class="col-lg-12">
                                    <input type="password" placeholder="password" name="password" required>
                                    @error('password')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                                </div>
                                
                                <div class="col-lg-12">
                                   
                                    <button type="submit" name="register" class="site-btn">Signup</button>
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