<!DOCTYPE html>
<html lang="en">

<head>
  <link rel="stylesheet" type="text/css" href="{{asset('home/css/bootstrap.css')}}" />
  <link href="{{asset('css/font-awesome.min.css')}}" rel="stylesheet" />
  <link href="{{asset('home/css/responsive.css')}}" rel="stylesheet" />
  <!-- Required meta tags -->
  @include('admin.css')
  <style>
    .div_center {
      text-align: center;
      padding-top: 40px;
    }

    .div_center h1 {
      font-size: 40px;
      padding-bottom: 40px;
    }

    .center {
      margin: auto;
      width: 80%;
      height: 150px;
      text-align: center;
      margin-top: 30px;
      border: 3px solid white;
    }

    .img_size {
      width: 250px;
      height: 150px;
    }

    th {
      font-size: 20px;
      border: 3px solid white;
    }

    tr {
      border: 3px solid white;
    }

    td {
      border: 3px solid white;
      width: 250px;
      height: 150px
    }

    .tb_head {
      background: rgb(0, 217, 255);
    }

    .alert .close {
      margin-left: 750px;
    }

    .object-fit-cover {
      object-fit: cover;
    }

    @media (max-width: 768px) {
      .card-img-top {
        height: 200px;
        max-height: 250px;
      }
    }

    @media (max-width: 576px) {
      .card-img-top {
        height: 150px;
        max-height: 200px;
      }
    }

    .modal-body p {
      font-size: 20px;
      color: #000000;
      opacity: 0.9;
      transition: opacity 0.3s ease-in-out;
    }

    .modal-body p:hover {
      opacity: 1;
    }
  </style>
  <title>All Products</title>
</head>

<body>
  <div class="container-scroller">
    <!-- partial:partials/_sidebar.html -->
    @include('admin.sidebar')
    <!-- partial -->
    @include('admin.header')
    <!-- partial -->
    <div class="main-panel">
      <div class="content-wrapper">
        @if(session()->has('message'))
        <div class="alert alert-success" id="flash-message" role="alert">
          {{session()->get('message')}}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true" onclick="removeFlashMessage()">X</span>
        </div>
        @endif
        <script>
          function removeFlashMessage() {
            var flashMessage = document.getElementById('flash-message');
            if (flashMessage) {
              flashMessage.parentNode.removeChild(flashMessage);
            }
          }
        </script>
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-md-8">
              <div class="card bg-dark text-light mb-4">
                <h1 class="text-center fs-1">All Sellers Products</h1>
                <div class="card-body d-flex align-items-center justify-content-center">
                  <form action="{{url('searchcustpro')}}" method="get" class="ml-3">
                    @csrf
                    <div class="input-group">
                      <input style="color:black; background-color: white;" type="text" name="search" placeholder="Search Product" class="form-control">
                      <div class="input-group-append">
                        <input type="submit" value="Search" class="btn btn-outline-primary">
                      </div>
                    </div>
                  </form>
                </div>
              </div>
              @if(isset($product) && count($product)>0)
              <div class="row">
                @foreach($product as $pro)
                <div class="col-xl-4 col-sm-6 mb-4">
                  <div class="card h-100">
                    <p class="card-text">Seller Name: <span style="font-size:15px;font-weight:bold">{{$pro->name}}</span></p>
                    <p class="card-text">Seller Id: {{$pro->user_id}}</p>
                    <div class="card-img-top d-flex align-items-center justify-content-center" style="height: 250px; max-height: 300px;">
                      <img src="/custemersell/{{$pro->image}}" style="max-height: 100%; max-width: 100%; object-fit: contain;" alt="Product Image">
                    </div>
                    <div class="card-body d-flex flex-column" style="gap: 7px;">
                      <p class="card-text">Email: {{$pro->email}}</p>
                      <p class="card-text">Phone: {{$pro->phone}}</p>
                      <p class="card-text">Phone 2: {{$pro->optional_phone}}</p>
                      <p class="card-text">Address: {{$pro->address}}</p>
                      <p class="card-text">Item: <span style="font-size:15px;font-weight:bold">{{$pro->title}}</span></p>
                      <p class="card-text">Description: {{$pro->description}}</p>
                      <p class="card-text">Item Status: {{$pro->status}}</p>
                      <p class="card-text">Category: {{$pro->category}}</p>
                      <p class="card-text">Price: {{$pro->price}}</p>
                      @if($pro->quantity <= 10 && $pro->quantity > 0) <p class="card-text">Quantity: <span style="color:red">{{$pro->quantity}}</span></p>
                        @elseif($pro->quantity == 0)<p class="card-text text-warning">Unavilable</p>
                        @else
                        <p class="card-text">Quantity: <span style="color:rgb(25, 233, 6);">{{$pro->quantity}}</span></p>
                        @endif
                        <div class="d-flex justify-content-between align-items-center mt-auto">
                          @if($pro->verification=='Verified')
                          <div>
                          <p class="card-text text-primary mb-0">{{$pro->verification}}</p>
                          </div>
                          @else
                          <div>
                          <p class="card-text text-danger">{{$pro->verification}}</p>
                          </div>
                          @endif
                        </div>
                        <div class="d-flex justify-content-between align-items-center mt-auto">
                          <div>
                            <!-- <a onclick="return confirm('Do You really Want To Delete This Product?')" class="btn btn-danger mr-2" href={{"deletepro/".$pro->id}}>Delete</a> -->
                            <a class="btn btn-danger  text-white" data-toggle="modal" data-target="#deleteProductModal{{$pro->id }}">Delete</a>
                            <a class="btn btn-success" href="{{url('editcust',$pro->id)}}">Edit</a>
                          </div>
                        </div>
                    </div>
                  </div>
                </div>
                <!-- Modal for deleting product item -->
                <div class="modal fade" id="deleteProductModal{{$pro->id }}" tabindex="-1" aria-labelledby="deleteProductModalLabel{{$pro->id }}" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content bg-white text-dark">
                      <div class="modal-header">
                        <h5 class="modal-title" id="deleteProductModalLabel{{ $pro->id }}">Delete Product Items</h5>
                        <a type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span style="border-radius:5px;opacity:1;" aria-hidden="true" class="bg-danger text-white p-1 pt-1">&times;</span>
                          </button>
                          <!-- <a class="close btn btn-danger btn-sm h-2" data-dismiss="modal" aria-label="Close">X</a> -->
                      </div>
                      <div class="modal-body text-center">
                        <p>Are you sure you want to delete this Seller Item?</p>
                      </div>
                      <div class="modal-footer">
                        <a style="color: white;" class="btn btn-success" data-dismiss="modal">Close</a>
                        <a href="{{ url('deletecustpro', $pro->id) }}" class="btn btn-danger">Delete</a>
                      </div>
                    </div>
                  </div>
                </div>
                @endforeach
              </div>
              @else
              <div class="card bg-dark text-light">
                <div class="card-body">
                  <p class="card-text">Search result not found!</p>
                </div>
              </div>
              @endif
            </div>

          </div>
          <span style="padding-top:20px">
            {!!$product->withQueryString()->links('pagination::bootstrap-5')!!}
          </span>
        </div>
      </div>

    </div>

  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  @include('admin.script')
  <!-- End custom js for this page -->
  <script src="home/js/jquery-3.4.1.min.js"></script>
  <!-- popper js -->
  <script src="home/js/popper.min.js"></script>
  <!-- bootstrap js -->
  <script src="home/js/bootstrap.js"></script>
  <!-- custom js -->
  <script src="home/js/custom.js"></script>
</body>

</html>