<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <link rel="shortcut icon" href="{{asset('images/favicon2.png')}}" type="">
  <title>Cart</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.6/dist/sweetalert2.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" integrity="sha512-b2QcS5SsA8tZodcDtGRELiGv5SaKSk1vDHDaQRda0htPYWZ6046lr3kJ5bAAQdpV2mmA/4v0wQF9MyU6/pDIAg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" type="text/css" href="{{asset('home/css/bootstrap.css')}}" /><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link href="{{asset('css/font-awesome.min.css')}}" rel="stylesheet" />
  <link href="{{asset('home/css/style.css')}}" rel="stylesheet" />
  <link href="{{asset('home/css/responsive.css')}}" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
  <style>
    .center {
      margin: auto;
      width: 60%;
      text-align: center;
    }

    .center2 {
      margin: auto;
      margin-top: 30px;
      text-align: center;
    }

    .form {
      display: flex;
      justify-content: center;
      gap: 3px 4px;
    }

    .th_deg {
      font-size: 30px;
      padding: 5px;
      background: skyblue;
    }

    .des {
      font-size: 70px;
      padding-bottom: 70px;
      text-align: center;
    }

    .center .message {
      font-size: 30px;
      font-weight: 300;
    }

    .price {
      font-size: 20px;
      padding-top: 30px;
    }
    .toast-success {
       background-color:#094f07 !important; 
       color: #fff !important;
       opacity:1 !important;
       }
       .toast-error {
       background-color:#b91515 !important; 
       color: #fff !important; 
       opacity:1 !important;
       }
       .toast-info {
       background-color:#0a617e !important; 
       color: #fff !important; 
       opacity:1 !important;
       }

    .upd-but {
      height: 50px;
      width: 20px;
      color: white;

    }

    .fixed-image-size {
      width: 200px;
      height: auto;
      object-fit: cover;
    }

    .card-img-top {
      position: relative;
    }

    .card-img-top img {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
    }
  .modal-content {
    background-color: #fff;
  }
  .modal-body p{
    opacity:0.5;
    transition: opacity 0.3s ease-in-out;
  }
  .modal-body p:hover{
    opacity:1;
  }
</style>

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

 <?php
    use Illuminate\Support\Facades\Session;
  ?>
</head>

<body>
  <div class="hero_area">
    <!-- header section strats -->
    @include('home.header')
    <div class="center">
      <div class="heading_container heading_center" style="padding-top:70px">
        <h2 class="des">Your <span style=" color:#fb4b57">Cart</span></h2>
      </div>
      
      @if(Session::has('Restore'))
      <?php
        $softdata = Session::get('Restore');
        $cartId =   $softdata['cartid'];
      ?>
       <div class="row justify-content-center">
         <div class="col-md-4 mb-4">
           <a href="{{url('restorecart', $cartId)}}" class ="btn btn-dark">Undo<i class="fa fa-undo" aria-hidden="true"></i></a>
        </div>
      </div>
      <?php
        $softdata = Session::forget('Restore');
      ?>
      @endif
      
      @if(isset($cartpro) && $cartpro->count() > 0)

      
       <div class="row justify-content-center">
        @foreach($cartpro as $cart)
        <div class="col-md-4 mb-4">
          <div class="card shadow">
            <div class="card-img-top d-flex align-items-center justify-content-center" style="height: 200px;">
              <img src="/product/{{$cart->image}}" style="max-height: 100%; max-width: 100%; object-fit: contain;" alt="Product Image">
            </div>
            <div class="card-body">
              <h5 class="card-title">{{$cart->product_title}}</h5>
              <p class="card-text">{{$cart->price}} ETB</p>
              <form action="{{url('upd_cart',$cart->id)}}" method="post" class="form">
                @csrf
                <div class="input-group mb-3">
                  <input type="number" name="quantity" class="form-control"  min="1" value="{{$cart->quantity}}">
                  <div class="input-group-append">
                    <button type="submit" class="btn btn-outline-primary">Update</button>
                  </div>
                </div>
              </form>
              <a  class="btn btn-danger text-white" data-toggle="modal" data-target="#deleteCartModal{{ $cart->id }}">
                <i class="fa fa-trash" aria-hidden="true"></i>Cart
              </a>
            </div>
          </div>
        </div>
        <!-- Modal for deleting cart item -->
        <div class="modal fade" id="deleteCartModal{{ $cart->id }}" tabindex="-1" aria-labelledby="deleteCartModalLabel{{ $cart->id }}" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="deleteCartModalLabel{{ $cart->id }}">Delete Product from Cart</h5>
                <a type="button" class="close" style="opacity:1" data-dismiss="modal" aria-label="Close">
                  <span style="border-radius:3px;opacity:1;" aria-hidden="true" class="bg-danger text-white p-1 pt-1 fs-5">&times;</span>
               </button>
               <!-- <a class="close btn btn-danger btn-sm h-2" data-dismiss="modal" aria-label="Close">X</a> -->
              </div>
              <div class="modal-body">
                <p>Are you sure you want to delete this product from your cart?</p>
              </div>
              <div class="modal-footer">
                <a style="color:white" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <a href="{{ url('deletecart', $cart->id) }}" class="btn btn-danger">Delete</a>
              </div>
            </div>
          </div>
        </div>
        @endforeach
      </div>


      @else
      <div class="message">
        <p>{{ $messagen}}</p>
      </div>
        @endif
     </div>
    @if(isset($total) >0)
    <div class="center">
      <h1 class="price">Total Price(Before Shipping): {{$total}}<span style="color:orange">ETB</span></h1>
    </div>
    <div class="center2">
      <h1 style="font-size:25px;padding-bottom:15px;">Proceed to Order</h1>
      <?php
        Session::put('totalprice', [
          'total' => $total,
      ]);
      ?>
      <div class="d-flex justify-content-center">
        <div class="col-md-12">
          <!-- <a href="{{url('cash_order')}}" class="btn btn-danger mb-3">Cash on Delivery</a> -->
          <a href="{{url('checkout')}}" class="btn btn-danger mb-3">Check Out</a>
        </div>
        <!-- <div class="col-md-6">
         <form action="{{route('payoption')}}" method="get"> 
          @csrf
           <input type="hidden" name="total" value="{{$total}}">
           <button  type="submit" class="btn btn-danger bg-danger text-white mb-3">Pay Using Card</button>
         </form>
        </div> -->
      </div>
         <!-- <a href="{{route('payoption')}}" class="btn btn-danger mb-3">Pay Using Card</a> -->
    </div>
    @else
    <div class="center2">
      <a href="/full_product" class="btn btn-danger mb-3">Continue Shoping</a>
    </div>

    @endif

    <!-- end client section -->
    <!-- footer start -->
    @include('home.footer')
    <!-- footer end -->

    <!-- jQery -->
  <script src="{{asset('home/js/jquery-3.4.1.min.js')}}"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.min.js" integrity="sha512-WW8/jxkELe2CAiE4LvQfwm1rajOS8PHasCCx+knHG0gBHt8EXxS6T6tJRTGuDQVnluuAvMxWF4j8SNFDKceLFg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

      @if(Session::has('message'))
       <script>
         toastr.options = {
            "progressBar": true,
            "positionClass": "toast-top-right",
            "closeButton": true,
          }
         toastr.success("{{ Session::get('message') }}" ,'Success!' ,{timeOut:5000});
      </script>
        @elseif(Session::has('sellinfo'))
      <script>
        toastr.options = {
            "progressBar": true,
            "positionClass": "toast-top-right",
            "closeButton": true,
        }
        toastr.info("{{ Session::get('sellinfo') }}" ,'Information!' ,{timeOut:17000});
    </script>
     @endif

    <script>
      function removeFlashMessage() {
        var flashMessage = document.getElementById('flash-message');
        if (flashMessage) {
          flashMessage.parentNode.removeChild(flashMessage);
        }
      }
    </script>
    
    <!-- popper js -->
    <script src="{{asset('home/js/popper.min.js')}}"></script>
    <!-- bootstrap js -->
    <script src="{{asset('home/js/bootstrap.js')}}"></script>
    <!-- custom js -->
    <script src="{{asset('home/js/custom.js')}}"></script>
</body>

</html>