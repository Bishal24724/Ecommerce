<x-header />

<!-- Header Section End -->


<section class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__text">
                    <h4>Shopping Cart</h4>
                    <div class="breadcrumb__links">
                        <a href="#">Home</a>
                        <a href="#">Shop</a>
                        <span>Shopping Cart</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



{{--- shown an checkout form and table if there is items in cart --}}

 @if (count($cartItems) > 0)  
<section class="shopping-cart spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="shopping__cart__table">
                    @if (session()->has('success'))
                    <script>
                        swal.fire("", "{{ Session::get('success') }}", "success", {
                            button: true,
                            button: "OK",
                            timer: 3000,
                        });
                    </script>
                    @endif

                    <table>
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $total = 0
                            @endphp
                            @foreach ($cartItems as $item)
                            <tr>
                                <td class="product__cart__item">
                                    <div class="product__cart__item__pic">
                                        <img src="{{ URL::asset('uploads/products/' . $item->picture) }}" alt="" width="100px" />
                                    </div>
                                    <div class="product__cart__item__text">
                                        <h6>{{ $item->title }}</h6>
                                        <h5>{{ $item->rate }}</h5>
                                    </div>
                                </td>
                                <td class="quantity__item">
                                    <form action="{{ URL::to('updateCart') }}" method="POST">
                                        @csrf
                                        <div class="quantity mb-1">
                                            <input type="number" class="form-control" min="1" max="{{ $item->pQuantity }}" name="quantity" value="{{ $item->quantity }}">
                                            @error('quantity')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <input type="hidden" name="id" value="{{ $item->id }}" />
                                        <input type="submit" value="update" name="update" class="btn btn-success btn-block" />
                                    </form>
                                </td>
                                <td class="cart__price">NRS {{ $item->rate * $item->quantity }}</td>
                                <td class="cart__close"><a href="{{ URL::to('deleteCartItem/' . $item->id) }}"><i class="fa fa-close"></i></a></td>
                            </tr>
                            @php
                            $total += ($item->rate * $item->quantity);
                            @endphp
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="row"></div>
            </div>
            <div class="col-lg-4">
                <div class="cart__total">
                    <h6>Cart total</h6>
                    <ul>
                        <li>Subtotal <span>NRS {{ $total }}</span></li>
                        <li>Total <span>NRS {{ $total }}</span></li>
                    </ul>
                    <form action="{{ URL::to('checkout') }}" onsubmit="return validate()">
                        @csrf
                        <input type="text" name="fullname" class="form-control mt-4" placeholder="Fullname" required>
                        <input type="text" name="phone" class="form-control mt-4" placeholder="Phone" required>
                        <input type="text" name="address" class="form-control mt-4" placeholder="Address" required>
                        <input type="hidden" name="bill" value="{{ $total }}" class="form-control mt-4">
                        <div class="map mt-3" id="map"></div>
                        
                       
                        <input type="hidden" name="lat" id="lat" class="form-control" value="">
                        <input type="hidden" name="lng" id="lng" class="form-control" value="">
                        <input type="submit" name="checkout" class="primary-btn mt-2 btn-success" value="Proceed to Checkout">
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>



@else


<section class="shopping-cart spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h4>There are no items in this cart...</h4>
                <a href="{{URL::to('shop')}}" class="btn mt-3 text-center btn-danger">Continue Shopping</a>
            </div>
        </div>
    </div>
</section>
@endif




<script>
    var long = document.getElementById('lng');
    var lat = document.getElementById('lat');
    var bill = document.querySelector('input[name="bill"]').value;

    function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
            center: { lat: 27.712751042291735, lng: 83.46465655872966 },
            zoom: 8
        });

        var marker = new google.maps.Marker({
            position: { lat: 27.712751042291735, lng: 83.46465655872966 },
            map: map
        });

        map.addListener('click', function (event) {
            var latitude = event.latLng.lat();
            var longitude = event.latLng.lng();

            long.value = longitude;
            lat.value = latitude;

            marker.setPosition(event.latLng);
        });
    }

    window.onload = initMap;

    function validate() {
        var long = document.getElementById('lng').value;
        var lat = document.getElementById('lat').value;
        var bill = document.querySelector('input[name="bill"]').value;

        if (!bill || bill === "0") {
            alert("You have an empty cart");
            return false;
        }

        if (!long || !lat) {
            alert('Please select your location on the map');
            return false;
        }
    }
</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC1KP1tF-W6uN3zd7uBmhJy-VFofp5U2UM"></script>

<x-footer />
