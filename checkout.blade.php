<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link rel="shortcut icon" href="{{asset('images/favicon2.png')}}" type="">
    <title>Check Out</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.6/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" integrity="sha512-b2QcS5SsA8tZodcDtGRELiGv5SaKSk1vDHDaQRda0htPYWZ6046lr3kJ5bAAQdpV2mmA/4v0wQF9MyU6/pDIAg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" type="text/css" href="{{asset('home/css/bootstrap.css')}}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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

     .order-container {
       margin-top: 80px;
       margin-bottom: 60px; 
       width: 400px;
       padding: 20px;
       border: 1px solid #ccc;
       border-radius: 5px;
    }

    .order-container select {
       margin-bottom: 10px;
    } 

    .price {
      font-size: 20px;
      padding-top: 30px;
    }

    </style>
</head>

<body>
  
<div class="hero_area">
    <!-- header section strats -->
   @include('home.header')

       <div class="center">
         <div class="body d-flex justify-content-center">
           <div class="order-container shadow">
               <div class="row justify-content-center">
                  <div class="row">
                     <div class="col-md-6">
                         <h3>Name</h3>
                     </div>
                     <div class="col-md-3">
                         <h3>Quantity</h3>
                    </div>
                    <div class="col-md-3">
                         <h3>Price</h3>
                    </div>
                  </div>
                  <hr style="font-size:20px;font-weight:bold">
                 @for($i=0; $i<30; $i++)

                   <div class="col-md-7">
                       <p>Samsung</p>
                   </div>
                   <div class="col-md-2">
                       <p><span>X</span>3</p>
                   </div>
                   <div class="col-md-3">
                       <p>18000</p>
                   </div>
                   <hr>
                   
                @endfor
              
               </div>
            </div>
      </div>
      </div>
    <div class="center">
      <h1 class="price">Total Price:18000<span style="color:orange">ETB</span></h1>
    </div>
    <div class="center2">
      <h1 style="font-size:25px;padding-bottom:15px;">Proceed to Order</h1>
      
      <div class="d-flex justify-content-center">
        <div class="col-md-8">
          <a href="{{url('cash_order')}}" class="btn btn-danger mb-3">Cash On Delivery</a>
        </div>
        <div class="col-md-6">
         <form action="{{route('payoption')}}" method="get"> 
          @csrf
           <input type="hidden" name="total" value="">
           <button  type="submit" class="btn btn-danger bg-danger text-white mb-3">Pay Using Card</button>
         </form>
        </div>
      </div>
         <!-- <a href="{{route('payoption')}}" class="btn btn-danger mb-3">Pay Using Card</a> -->
    </div>
  
    @include('home.footer')
  </div>

  

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
        toastr.success("{{ Session::get('message') }}", 'Success!', {
            timeOut: 5000
        });
    </script>
    @elseif(Session::has('sellinfo'))
    <script>
        toastr.options = {
            "progressBar": true,
            "positionClass": "toast-top-right",
            "closeButton": true,
        }
        toastr.info("{{ Session::get('sellinfo') }}", 'Information!', {
            timeOut: 17000
        });
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