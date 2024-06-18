<x-header />

    <!-- Map Begin -->
   

    <!-- Contact Section Begin -->
    <section class="contact spad">
        <div class="container">
            <div class="row">
               
                <div class="col-lg-6 col-md-6 mx-auto">
                    <div class="section-title">
                        <h2>Login Account</h2>
                    </div>
                    <div class="contact__form">
                    

                        {{-- success message alert --}}
                        @if(session()->has('success'))
                           <div class="alert alert-success">
                            <p>{{ session()->get('success')}}</p>
                           </div>
                        @endif
                          {{-- error message alert --}}
                          @if(session()->has('error'))
                          <div class="alert alert-danger">
                           <p>{{ session()->get('error')}}</p>
                          </div>
                       @endif
                        <form action=" {{URL::to('loginUser')}}" method="POST">
                            @csrf
                            <div class="row">
                               
                                <div class="col-lg-12">
                                    <input type="email" name="email" placeholder="Email" value="{{ old('email') }}"  @error('email') is-invalid @enderror  required>
                                    @error('email')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                                </div>
                           
                                <div class="col-lg-12">
                                    <input type="password" placeholder="password" name="password"  required>
                                    @error('password')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                                </div>
                                
                                <div class="col-lg-12">
                                  
                                    <button type="submit" name="login" class="site-btn">Login</button>
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