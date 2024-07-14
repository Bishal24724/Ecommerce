<x-header />
<!-- Header Section End -->

<!-- Shop Details Section Begin -->
<section class="shop-details">
    <div class="product__details__pic">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="product__details__breadcrumb">
                        <a href="{{ URL::to('/') }}">Home</a>
                        <a href="{{ URL::to('/shop') }}">Shop</a>
                        <span>Product Details</span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-3">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab">
                                <div class="product__thumb__pic set-bg" data-setbg="{{ URL::asset('uploads/products/'.$product->picture) }}"></div>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab">
                                <div class="product__thumb__pic set-bg" data-setbg="{{ URL::asset('uploads/products/'.$product->picture) }}"></div>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-6 col-md-9">
                    @if (session()->has('success'))
                    <script>
                        swal.fire("", "{{ Session::get('success') }}", "success", {
                            button: true,
                            button: "OK",
                            timer: 3000,
                        });
                    </script>
                    @endif
                    <div class="tab-content">
                        <div class="tab-pane active" id="tabs-1" role="tabpanel">
                            <div class="product__details__pic__item">
                                <img src="{{ URL::asset('uploads/products/'.$product->picture) }}" alt="">
                            </div>
                        </div>
                        <div class="tab-pane" id="tabs-2" role="tabpanel">
                            <div class="product__details__pic__item">
                                <img src="{{ URL::asset('uploads/products/'.$product->picture) }}" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="product__details__content">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-lg-8">
                    <div class="product__details__text">
                        <h4>{{ $product->title }}</h4>
                        <div class="rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star-o"></i>
                        </div>
                        <h3 class="price">NRS {{ $product->sizes->first()->rate }}</h3>
                        <p>{{ $product->description }}</p>
                        <h4 class="mb-2">Seller Name: {{ $vendor_name }}</h4>
                        <h4 class="mb-2">Seller Address: {{ $vendor_address }}</h4>
                        <div class="product__details__option">
                            <form action="{{ URL::to('addToCart') }}" method="POST">
                                @csrf
                                <div class="product__details__option__size">
                                    <span>Size:</span>
                                    @foreach ($product->sizes as $size)
                                    <label for="size_{{ $size->size }}">
                                        {{ $size->size }}
                                        <input type="radio" name="size" value="{{ $size->id }}" id="size_{{ $size->size }}" data-rate="{{ $size->rate }}" {{ $loop->first ? 'checked' : '' }} required>

                                    </label>
                                    @endforeach
                                </div>
                        </div>
                        <div class="product__details__cart__option">
                            <div class="quantity">
                                <input type="number" name="quantity" class="form-control" value="1" max="{{ $product->quantity }}" min="1">
                            </div>
                            <input type="hidden" name="id" value="{{ $product->id }}" />
                            <button type="submit" name="addToCart" class="primary-btn">add to cart</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Shop Details Section End -->

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const sizeRadios = document.querySelectorAll('input[name="size"]');
        const price = document.querySelector('.price');

        sizeRadios.forEach(radio => {
            radio.addEventListener('change', function() {
                const rate = this.getAttribute('data-rate');
                price.textContent = `NRS ${rate}`;
            });
        });
    });
</script>

<x-footer />
