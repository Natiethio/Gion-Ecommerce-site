<!DOCTYPE html>
<html>

<head>
    <!-- Basic -->
    <!-- <base href="/public"> -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Site Metas -->
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link rel="shortcut icon" href="{{asset('images/favicon2.png')}}" type="">
    <title>Payment</title>
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" type="text/css" href="{{asset('home/css/bootstrap.css')}}" />
    <!-- Font Awesome style -->
    <link href="{{asset('css/font-awesome.min.css')}}" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="{{asset('home/css/style.css')}}" rel="stylesheet" />
    <!-- Responsive style -->
    <link href="{{asset('home/css/responsive.css')}}" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <style>
    .hero_area {
            display: flex;
            flex-direction: column;
            padding-top: 150px;
            height: 100vh;
        }
        .hero_area .row {
            justify-content: center;
        }
        @media(max-width: 991px) {
           .new {
            margin-bottom: 25px;
            margin-left: 115px;
           }
        }
        @media(max-width:768px) {
           .new {
            margin-bottom: 25px;
            margin-left: -25px;
           }
        }
           @media(max-width:360px) {
           .new {
            margin-bottom: 25px;
            margin-left: 90px;
           }
        }
        @media(max-width:390px) {
           .new {
            margin-bottom: 25px;
            margin-left: 105px;
           }
        }
        @media(max-width:412px) {
           .new {
            margin-bottom: 25px;
            margin-left: 109px;
           }
        }
      .toast-success {
       background-color:#094f07 !important; 
       color: #fff !important;
       }
       .toast-error {
       background-color:#b91515 !important; 
       color: #fff !important;
       }
       .toast-info {
       background-color:#0a617e !important; 
       color: #fff !important; 
       }

  </style>
</head>
<?php
   use App\Models\Cart;
?>
@auth
<?php
   $cartItemCount = Cart::where('user_id', auth()->user()->id)->count();
?>
@endauth
<body>
    <div class="hero_area">
        @include('home.header')
        <div class="container">
        <!-- @if(session('Failed'))
            <div class="alert alert-danger" id="flash-message" role="alert" style="text-align:center">
                {{ session('Failed')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close" onclick="removeFlashMessage()">
                    <span aria-hidden="true">X</span>
                </button>
            </div>
        @endif -->
            <div class="row align-items-center justify-content-center">
                <div class="col-lg-2 col-md-2">
                    <div class="card shadow new" style="width: 150px; height: 100px;">
                        <img src="{{asset('images/chapa_logo.png')}}" class="card-img-top pt-3" alt="Chapa Logo" style="max-width: 100%; max-height: 100%; object-fit: contain;">
                    </div>
                </div>
                <div class="col-lg-2">
                @if($cartItemCount!==0)
                    <h3 class="mb-3 text-center">Pay By Chapa: {{$total}}</h3>
                    <form method="POST" action="{{ route('pay')}}" id="paymentForm">
                        @csrf
                        <input type="submit" value="Buy" class="btn btn-primary" />
                        <input type="hidden" name="total" value="{{$total}}">
                        <input type="hidden" name="shipid" value="{{$shipid}}">
                    </form>
                @endif
                </div>
            </div>
        </div>
    </div>
    <div style="margin-top:-150px">
        @include('home.footer')
    </div>

<script src="{{asset('home/js/jquery-3.4.1.min.js')}}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.min.js" integrity="sha512-WW8/jxkELe2CAiE4LvQfwm1rajOS8PHasCCx+knHG0gBHt8EXxS6T6tJRTGuDQVnluuAvMxWF4j8SNFDKceLFg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

@if(Session::has('success'))
<script>
    toastr.options = {
        "progressBar": true,
        "positionClass": "toast-top-right",
        "closeButton": true,
    }
    toastr.success("{{ Session::get('success') }}", 'Success!', {
        timeOut: 8000
    });
</script>
@elseif(Session::has('Failed'))
<script>
    toastr.options = {
        "progressBar": true,
        "positionClass": "toast-top-right",
        "closeButton": true,
    }
    toastr.error("{{ Session::get('Failed') }}", 'Error!', {
        timeOut: 20000
    });
</script>
@elseif(Session::has('info'))
<script>
    toastr.options = {
        "progressBar": true,
        "positionClass": "toast-top-right",
        "closeButton": true,
    }
    toastr.info("{{ Session::get('info') }}", 'information!', {
        timeOut: 8000
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

    <script src="{{asset('home/js/jquery-3.4.1.min.js')}}"></script>
    <!-- popper js -->
    <script src="{{asset('home/js/popper.min.js')}}"></script>
    <!-- bootstrap js -->
    <script src="{{asset('home/js/bootstrap.js')}}"></script>
    <!-- custom js -->
    <script src="{{asset('home/js/custom.js')}}"></script>
</body>

</html>