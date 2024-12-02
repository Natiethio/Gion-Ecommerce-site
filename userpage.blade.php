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
  <title>Home</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.6/dist/sweetalert2.min.css">
  <!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="{{asset('home/css/bootstrap.css')}}" />
  <!-- font awesome style -->
  <link href="{{asset('css/font-awesome.min.css')}}" rel="stylesheet" />
  <!-- Custom styles for this template -->
  <link href="{{asset('home/css/style.css')}}" rel="stylesheet" />
  <link href="{{asset('home/css/responsive.css')}}" rel="stylesheet" />

  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
  <?php

  use Illuminate\Support\Facades\Session;
  ?>

</head>
<style>
  .bold-ticket {
    font-weight: bold;
  }
  
</style>

<body>

  @if (Session::has('ordernumber'))
  <script>
    swal({
      title: "Gion E-Market",
      text: "{{ Session::get('paysuccess') }}\n\n Order reference number: {{ Session::get('ordernumber') }}",
      // text: "{!! Session::get('paysuccess') !!}\n\n Ticket reference number:\n\n <span class='bold-ticket'>{{ Session::get('ordernumber') }}</span>\n\n Ticket reference number:\n\n <b>{{ Session::get('ordernumber') }}</b>",
      icon: "success",
      buttons: {
        confirm: {
          text: "OK",
          value: true,
          visible: true,
          className: "btn btn-success",
          closeModal: true
        }
      },
      html: true
    });
  </script>
  @elseif(Session::has('error'))
  <script>
    swal({
      title: "Gion E-Market",
      text: "{{ Session::get('error') }}", 
      icon: "error",
      buttons: {
        confirm: {
          text: "OK",
          value: true,
          visible: true,
          className: "btn btn-danger",
          closeModal: true
        }
      },
      html: true
    });
    </script>
  @endif

  <?php
  Session::forget('paysuccess');

  Session::forget('ordernumber');

  Session::forget('error');
  ?>

  <div class="hero_area">
    <!-- header section strats -->
    <div id="category">
      @include('home.header')
    </div>
    <!-- end header section -->
    <!-- slider section -->
    @include('home.slider2')
    <!-- end slider section -->
  </div>
  <!-- why section -->
  @include('home.why')
  <!-- end why section -->

  <!-- arrival section -->
  @include('home.new_arival')
  <!-- end arrival section -->

  <!-- product section -->
  <div id="product">
    @include('home.product')<!-- because it include product the product.blade.php can access the data forwarded from the controller-->
  </div>
  @include('home.featured')
  <!-- end product section -->
  <!-- @include('home.subscribe') -->

  @if(Route::has('login'))
  @auth
  <div id="comment">
    @include('home.comment')
  </div>
  @endauth
  @endif
  <!-- subscribe section -->

  <!-- end subscribe section -->
  <!-- client section -->
  @if(Route::has('login'))
  @auth
  @include('home.client')
  @endauth
  @endif
  <!-- end client section -->
  <!-- footer start -->
  @include('home.footer')
  <!-- footer end -->
  <!-- jQery -->
  <!-- jQery -->

  <script src="home/js/jquery-3.4.1.min.js"></script>

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
      timeOut: 10000
    });
  </script>
  @elseif(Session::has('message'))
  <script>
    toastr.options = {
      "progressBar": true,
      "positionClass": "toast-top-left",
      "closeButton": true,
    }
    toastr.success("{{ Session::get('message') }}", 'Success!', {
      timeOut: 5000
    });
  </script>
  @elseif(Session::has('failed'))
  <script>
    toastr.options = {
      "progressBar": true,
      "positionClass": "toast-top-left",
      "closeButton": true,
    }
    toastr.error("{{ Session::get('failed') }}", 'Error!', {
      timeOut: 17000
    });
  </script>
  @elseif(Session::has('info'))sellinfo
  <script>
    toastr.options = {
      "progressBar": true,
      "positionClass": "toast-top-right",
      "closeButton": true,
    }
    toastr.info("{{ Session::get('info') }}", 'Information!', {
      timeOut: 15000
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


  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.min.js" integrity="sha512-WW8/jxkELe2CAiE4LvQfwm1rajOS8PHasCCx+knHG0gBHt8EXxS6T6tJRTGuDQVnluuAvMxWF4j8SNFDKceLFg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

  <script src="{{ asset('home/js/app.js') }}"></script>
  <!-- popper js -->
  <script src="{{asset('home/js/popper.min.js')}}"></script>
  <!-- bootstrap js -->
  <script src="{{asset('home/js/bootstrap.js')}}"></script>
  <!-- custom js -->
  <script src="{{asset('home/js/custom.js')}}"></script>
</body>

</html>