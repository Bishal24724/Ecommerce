<x-header />

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>Shop</h4>
                        <div class="breadcrumb__links">
                            <a href="./index.html">Home</a>
                            <span>Shop</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Shop Section Begin -->
    <section class="shop spad">
        <div class="container">
            <div class="row">
              
                <div class="col-lg-12">
                   
                    <div class="row">
                        @foreach ($allproducts as $item)
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="product__item">
                                <div class="product__item__pic set-bg" data-setbg="{{URL::asset('uploads/products/'.$item->picture)}}">
                                    <span class="label">{{ $item->type->tname }}</span>
                                    <ul class="product__hover">
                                       
                                        
                                       
                                        <li><a href="{{URL::to('single/'.$item->id)}}"><img src="img/icon/search.png" alt=""></a></li>
                                    </ul>
                                </div>
                                <div class="product__item__text">
                                    <h6>{{$item->title}}</h6>
                                    <a href="{{URL::to('single/'.$item->id)}}"class="add-cart">+ Add To Cart</a>
                                    <div class="rating">
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                    </div>

                                    {{-- calculating the min and max rate of a single product--}}
                                    @php
                                     $rates=$item->sizes->pluck('rate');
                                    $min_rates=$rates->min();
                                    $max_rates=$rates->max();
                                     @endphp                                                                                
                                    <h5> NRS {{ $min_rates}} - NRS {{ $max_rates}}</h5>
                                   
                                </div>
                            </div>
                        </div>
                        @endforeach
                        </div>
                        

               
                    <div class="row">
                        <div class="col>
                            <div class="product__pagination">
                                {{ $allproducts->links() }} 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
      <!-- Shop Section Begin -->
   
    <!-- Shop Section End -->
<x-footer />