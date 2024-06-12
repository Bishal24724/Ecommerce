<x-header />
    <!-- Hero Section Begin -->
    <section class="hero">
        <div class="hero__slider owl-carousel">
            <div class="hero__items set-bg" data-setbg="img/hero/hero-1.jpg">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-5 col-lg-7 col-md-8">
                            <div class="hero__text">
                                <h6>Summer Collection</h6>
                                <h2>Fall - Summer Collections 2024</h2>
                                <p>A specialist label creating luxury essentials. Ethically crafted with an unwavering
                                commitment to exceptional quality.</p>
                                <a href="{{URL::to('shop')}}" class="primary-btn">Shop now <span class="arrow_right"></span></a>
                                <div class="hero__social">
                                    <a href="#"><i class="fa fa-facebook"></i></a>
                                    <a href="#"><i class="fa fa-twitter"></i></a>
                                    <a href="#"><i class="fa fa-pinterest"></i></a>
                                    <a href="#"><i class="fa fa-instagram"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hero__items set-bg" data-setbg="img/hero/hero-2.jpg">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-5 col-lg-7 col-md-8">
                            <div class="hero__text">
                                <h6>Summer Collection</h6>
                                <h2>Fall - Summer Collections 2024</h2>
                                <p>A specialist label creating luxury essentials. Ethically crafted with an unwavering
                                commitment to exceptional quality.</p>
                                <a href="{{URL::to('shop')}}" class="primary-btn">Shop now <span class="arrow_right"></span></a>
                                <div class="hero__social">
                                    <a href="#"><i class="fa fa-facebook"></i></a>
                                    <a href="#"><i class="fa fa-twitter"></i></a>
                                    <a href="#"><i class="fa fa-pinterest"></i></a>
                                    <a href="#"><i class="fa fa-instagram"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Section End -->

    <!-- Banner Section Begin -->
    <section class="banner spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 offset-lg-4">
                    <div class="banner__item">
                        <div class="banner__item__pic">
                            <img src="img/banner/banner-1.jpg" alt="">
                        </div>
                        <div class="banner__item__text">
                            <h2>Clothing Collections <br>2024</h2>
                            <a href="{{URL::to('shop')}}">Shop now</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="banner__item banner__item--middle">
                        <div class="banner__item__pic">
                            <img src="img/banner/banner-2.jpg" alt="">
                        </div>
                        <div class="banner__item__text">
                            <h2>Accessories</h2>
                            <a href="{{URL::to('shop')}}">Shop now</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="banner__item banner__item--last">
                        <div class="banner__item__pic mb">
                            <img src="img/banner/banner-3.jpg" alt="">
                        </div>
                        <div class="banner__item__text">
                            <h2>Shoes Summer <br>2024</h2>
                            <a href="{{URL::to('shop')}}">Shop now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Banner Section End -->

    <!-- Product Section Begin -->
    <section class="product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <ul class="filter__controls">
                        <li class="active" data-filter="*">Best Sellers</li>
                        <li data-filter=".new-arrivals">New Arrivals</li>
                        <li data-filter=".sale">Hot Sales</li>
                    </ul>
                </div>
            </div>
            <div class="row product__filter">
                @foreach ($allproducts as $item)
                <div class="col-lg-3 col-md-6 col-sm-6 col-md-6 col-sm-6 mix {{ $item->type }}">
                    <div class="product__item">
                        <div class="product__item__pic set-bg" data-setbg="{{URL::asset('uploads/products/'.$item->picture)}}">
                            <span class="label">{{ $item->type }}</span>
                            <ul class="product__hover">
                                <li><a href="{{URL::to('single/'.$item->id)}}"><img src="img/icon/search.png" alt=""></a></li>
                            
                        </div>
                        <div class="product__item__text">
                            <h6>{{$item->title}}</h6>
                            <a href="{{ URL::to('AddNewProduct')}}"  class="add-cart">+ Add To Cart</a>
                            <div class="rating">
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                            </div>
                            <h5>NRS {{$item->price}}</h5>
                           
                        </div>
                    </div>
                </div>
                @endforeach
                
               
            </div>
        </div>
    </section>
    <!-- Product Section End -->

    <!-- Categories Section Begin -->
    <section class="categories spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-2">
                    <div class="categories__text">
                        <h2>Clothings Hot <br /> <span>Shoe Collection</span> <br /> Accessories</h2>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="categories__hot__deal">
                        <img src="img/product-sale.png" alt="">
                        <div class="hot__deal__sticker">
                            <span>Sale Of</span>
                            <h5> NRS 800</h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 offset-lg-1">
                    <div class="categories__deal__countdown">
                        <span>Deal Of The Week</span>
                        <h2>Multi-pocket Chest Bag Black</h2>
                        <div class="categories__deal__countdown__timer" id="countdown">
                            <div class="cd-item">
                                <span>3</span>
                                <p>Days</p>
                            </div>
                            <div class="cd-item">
                                <span>1</span>
                                <p>Hours</p>
                            </div>
                            <div class="cd-item">
                                <span>50</span>
                                <p>Minutes</p>
                            </div>
                            <div class="cd-item">
                                <span>18</span>
                                <p>Seconds</p>
                            </div>
                        </div>
                        <a href="#" class="primary-btn">Shop now</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Categories Section End -->

    <!-- Instagram Section Begin -->
    <section class="instagram spad mb-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="instagram__pic">
                        <div class="instagram__pic__item set-bg" data-setbg="img/instagram/instagram-1.jpg"></div>
                        <div class="instagram__pic__item set-bg" data-setbg="img/instagram/instagram-2.jpg"></div>
                        <div class="instagram__pic__item set-bg" data-setbg="img/instagram/instagram-3.jpg"></div>
                        <div class="instagram__pic__item set-bg" data-setbg="img/instagram/instagram-4.jpg"></div>
                        <div class="instagram__pic__item set-bg" data-setbg="img/instagram/instagram-5.jpg"></div>
                        <div class="instagram__pic__item set-bg" data-setbg="img/instagram/instagram-6.jpg"></div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="instagram__text">
                        <h2>Instagram</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua.</p>
                        <h3>#Lyrics Fancy</h3>
                    </div>
                </div>
            </div>
        </div>
    </section>
   

    <!-- Testimonial Section -->
    <section class="testimonial spad">
        <div class="container">
          <div class="row">
            <div class="col-lg-12">
              <div class="section-title">
                <span>Testimonials</span>
                <h2>What Our Customer Say</h2>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-4">
              <div class="testimonial__item">
                <div class="testimonial__author__pic">
                  <img src="img/testimonial/feed2.jpg" alt="">
                </div>
                <div class="testimonial__author__text">
                  <p>"Amazing! The quality of Lyrics Fashion provide is unmeasurable. You never dissapointed by taking product and service from here"</p>
                  <h5>Roshan Karki</h5>
                  <span>Customer</span>
                </div>
              </div>
              
            </div>
            <div class="col-md-4">
                <div class="testimonial__item">
                  <div class="testimonial__author__pic">
                    <img src="img/testimonial/feed.jpg" alt="">
                  </div>
                  <div class="testimonial__author__text">
                    <p>"I bought product from here last year and still it's color and quality is not fade out."</p>
                    <h5>Binod Baskota</h5>
                    <span>Customer</span>
                  </div>
                </div>
                
              </div>
              <div class="col-md-4">
                <div class="testimonial__item">
                  <div class="testimonial__author__pic">
                    <img src="img/testimonial/feed3.jpg" alt="">
                  </div>
                  <div class="testimonial__author__text">
                    <p>"I request everyone for visit and buy clothes from lyrics fancy . "</p>
                    <h5>Sujan Chapagain</h5>
                    <span>Customer</span>
                  </div>
                </div>
                
              </div>
            </div>
        </div>
      </section>
<!-- Testimonial Section End -->
       
      


    <section class="contact spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="contact__text">
                        <div class="section-title">
                            <span>Information</span>
                            <h2>Contact Us</h2>
                            <p>As you might expect of a company that began as a high-end interiors contractor, we pay
                                strict attention.</p>
                        </div>
                        <ul>
                           
                            <li>
                                <h4>Haraiya</h4>
                                <p>Kanchan-3,Haraiya,Rupandehi <br>+9779800000000</p>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="contact__form">
                        @if (session()->has('message'))
                        <script>
                         swal.fire("", "{{ Session::get('message') }}", "success", {
                            button:true,
                  button: "OK",
                  timer:3000,
                });
                </script>
                @endif
                        <form action="{{ URL::to('contactUs')}}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6">
                                    <input type="text" placeholder="Name" name="fullname">
                                    @error('fullname')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                                </div>
                                <div class="col-lg-6">
                                    <input type="text" placeholder="Email" name="email">
                                    @error('email')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                                </div>
                                <div class="col-lg-12">
                                    <textarea placeholder="Message" name="message" ></textarea>
                                    @error('message')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                                    <input type="submit" value="Messsage Us" name="save" class="btn btn-success" id="">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

  

    <!-- Footer Section Begin -->
  <x-footer />