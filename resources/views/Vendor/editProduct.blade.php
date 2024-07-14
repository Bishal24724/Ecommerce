<x-vendorheader />
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row mb-4">
            <div class="col-lg-12">
                <div class="">
                    <a href="{{ URL::to('/vendor') }}" class="text-black">Dashboard</a><span> >> </span>
                    <a href="{{ URL::to('/edit/'.$product->id) }}" class="text-black">Edit</a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-header">{{ __('Edit Product') }}</div>
                        <div class="card-body">
                            <form action="{{ URL::to('vproductUpdate/'.$product->id) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="">Title</label>
                                    <input type="text" name="title" value="{{ $product->title }}" class="form-control mb-2" placeholder="Enter Title" required>
                                    @error('title')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="">price</label>
                                    <input type="text" name="price" value="{{ $product->price }}" class="form-control mb-2" placeholder="Enter Price (NRS)" required>
                                    @error('price')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="">Quantity</label>
                                    <input type="text" name="quantity" value="{{ $product->quantity }}" class="form-control mb-2" placeholder="Enter Quantity" required>
                                    @error('quantity')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="">Photo</label>
                                    <input type="file" name="file" class="form-control mb-2">
                                    @error('file')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="">Description</label>
                                    <input type="text" name="description" value="{{ $product->description }}" class="form-control mb-2" placeholder="Enter Description" required>
                                    @error('description')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="">Category</label>
                                    <select name="category" class="form-control mb-2">
                                        <option value="{{ $product->category }}">{{ $product->category }}</option>
                                        <option value="Accessories">Accessories</option>
                                        <option value="Shoes">Shoes</option>
                                        <option value="Clothes">Clothes</option>
                                    </select>
                                    @error('category')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="">Type</label>
                                    <select name="type" class="form-control mb-2">
                                        <option value="{{ $product->type }}">{{ $product->type }}</option>
                                        <option value="Best Sellers">Best Sellers</option>
                                        <option value="new-arrivals">New Arrivals</option>
                                        <option value="new-arrivals">Sale</option>
                                    </select>
                                    @error('type')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <input type="submit" value="Update" class="btn btn-success">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<x-vendorfooter />
