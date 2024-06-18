<x-header />
       
    <!-- Header Section End -->

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>Shopping Cart</h4>
                        <div class="breadcrumb__links">
                            <a href="./index.html">Home</a>
                            <a href="./shop.html">Shop</a>
                            <span>Shopping Cart</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Shopping Cart Section Begin -->
    <section class="shopping-cart spad">
     
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="shopping__cart__table">
                        @if (session()->has('success'))
                        <script>
                         swal.fire("", "{{ Session::get('success') }}", "success", {
                            button:true,
                  button: "OK",
                  timer:3000,
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
                                    
                                    $total=0
                                @endphp
                                @foreach ($cartItems as $item)
                                    
                                
                                <tr>
                                    <td class="product__cart__item">
                                        <div class="product__cart__item__pic">
                                            <img src="{{URL::asset('uploads/products/'.$item->picture)}}" alt="" width="100px" />
                                           
                                        </div>
                                        <div class="product__cart__item__text">
                                            <h6>{{$item->title}}</h6>
                                            <h5>{{$item->price}}</h5>
                                        </div>
                                    </td>
                                    <td class="quantity__item">
                                        <form action="{{URL::to('updateCart')}}" method="POST">
                                             @csrf
                                        <div class="quantity mb-1">
                                            <input type="number" class="form-control" min="1" max="{{$item->pQuantity}}" name="quantity" value="{{$item->quantity}}">
                                            @error('quantity')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                        </div>
                                        <input type="hidden" name="id" value="{{ $item->id}}" />
                                        <input type="submit" value="update" name="update" class="btn btn-success btn-block" />
                                        
                                        </form>
                                    </td>
                                    <td class="cart__price">NRS {{$item->price * $item->quantity}}</td>
                                    <td class="cart__close"><a href="{{ URL::to('deleteCartItem/'.$item->id)}}"><i class="fa fa-close"></i></a></td>
                                </tr>
                                @php
                                    $total+=($item->price * $item->quantity);
                                @endphp
                                @endforeach
                              
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                       
                        
                    </div>
                </div>
                <div class="col-lg-4">
                   
                    <div class="cart__total">
                        <h6>Cart total</h6>
                        <ul>
                            <li>Subtotal   <span> NRS {{ $total }}</span></li>
                            <li>Total <span> NRS {{ $total}}</span></li>
                        </ul>
                        <form action="{{ URL::to('checkout')}}">
                            @csrf
                            <input type="text" name="fullname"  class="form-control mt-4" placeholder="Fullname" required>
                            <input type="text" name="phone" id="" class="form-control" mt-4  placeholder="Phone" required>
                            <input type="text" name="address" id="" class="form-control" mt-4 placeholder=" Address" required>
                            <input type="hidden" name="bill" value="{{ $total}}" class="form-control" mt-4 >
<<<<<<< HEAD
                             <input type="hidden" name="" value="" class="form-control" mt-4>
=======
>>>>>>> e31fac9ad9f10a682d75292519a4f49c506267d2
                            <input type="submit" name="checkout" class="primary-btn mt-2 btn-block" value="Proceed to Checkout" >
                        </form>
                       
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shopping Cart Section End -->

  <x-footer />