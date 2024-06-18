<x-vendorheader />
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <p class="card-title mb-0">Vendor Orders</p>
                        <div class="table-responsive">
                            <table id="myTable" class="table  display table-striped table-borderless">
                                <thead>
                                    <tr>
                                        <th>Customer Name</th>
                                        <th>Phone</th>
                                        <th>Address</th>
                                 
                                        <th>Order Date</th>
                                        <th>Product</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i = 0;
                                    @endphp
                                    @foreach ($orders as $item)
                                        @php
                                            $i++;
                                        @endphp
                                        <tr>
                                            <td>{{ $item->fullname }}</td>
                                            <td class="font-weight-bold">{{ $item->phone }}</td>
                                            <td>{{ $item->address }}</td>
                                           
                                            <td class="font-weight-medium">
                                                <div class="badge badge-info">{{ $item->created_at }}</div>
                                            </td>
                                            <td class="font-weight-small">
                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#updateModel{{ $i }}">
                                                    Product
                                                </button>
                                                <div class="modal" id="updateModel{{ $i }}">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Product</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <table class="table table-responsive">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>Product</th>
                                                                            <th>Picture</th>
                                                                            <th>Price/Item</th>
                                                                            <th>Quantity</th>
                                                                            <th>Sub Total</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @foreach ($orderItems as $oItem)
                                                                            @if ($oItem->orderId == $item->id)
                                                                                <tr>
                                                                                    <td>{{ $oItem->title }}</td>
                                                                                    <td>
                                                                                        <img src="{{ URL::asset('uploads/products/' . $oItem->picture) }}" width="100px">
                                                                                    </td>
                                                                                    <td>NRS {{ $oItem->price }}</td>
                                                                                    <td>{{ $oItem->quantity }}</td>
                                                                                    <td>NRS {{ $oItem->quantity * $oItem->price }}</td>
                                                                                </tr>
                                                                            @endif
                                                                        @endforeach
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<x-vendorfooter />
