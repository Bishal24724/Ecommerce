<x-vendorheader :notifications="$notifications" />
<!-- partial -->
<div class="main-panel">
  <div class="content-wrapper">
  
    <div class="row mb-4">
      <div class="col-lg-12">
        <div class="">
            <a href="{{ URL::to('/vendor')}}" class="text-black">Vendor</a><span> >> </span>
            <a href="{{ URL::to('/adminProducts')}}" class="text-black">Customer</a>
            
        </div>
    </div>
   
    <div class="row">
      <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            @if (session()->has('success'))
            <script>
             swal.fire("", "{{ Session::get('success') }}", "success", {
                button:true,
      button: "OK",
      timer:3000,
    });
    </script>
    @endif
              <p class="card-title mb-0">Our Customer</p>
             
           
            <div class="table-responsive">
              <table class="table table-striped table-borderless">
                <thead>
                  <tr>
                    <th>S.N</th>
                    <th>Full Name</th>
                    <th>Picture</th>
                    <th>Email</th>
                    <th>Type</th>
                    <th>Status</th>
                  
                     <th>Action</th>
                  </tr>  
                </thead>
                <tbody>
                @php
                    $i=0;
                @endphp
  
                  @foreach ($customers as $item)
                  @php
                  $i++;
              @endphp
                  <tr>
                      <td>{{ $i}}</td>
                      <td>{{$item->fullname}}</td>
                      <td><img src="{{URL::asset('uploads/profiles/'.$item->picture)}}" alt="img" width="100px" srcset=""></td>
                      <td>{{$item->email}}</td>
                      <td class="font-weight-bold">{{ $item->type}}</td>
                      <td class="font-weight-bold">{{ $item->status}}</td>
                     <td>
                        @if($item->status=="Active")
                        <a href="{{ URL::to('changeUserStatus/Blocked/'.$item->id)}}" class="btn btn-success">Block</a>   
                        @else
                        <a href="{{ URL::to('changeUserStatus/Active/'.$item->id)}}" class="btn btn-danger">Un-Block </a>
                       @endif
                
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
 
  <!-- content-wrapper ends -->
  <!-- partial:partials/_footer.html -->
<x-vendorfooter />