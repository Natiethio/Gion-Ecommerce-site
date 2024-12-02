<!DOCTYPE html>
<html>

<head>
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
   <style>
      .nav-link a:hover {
         color: orange;
      }
      .nav-its .nav-lks .item-count {
         position: relative;
         display: inline-block;
         background-color: #f7444e;
         color: #fff;
         border-radius: 50%;
         width: 20px;
         height: 20px;
         text-align: center;
         line-height: 20px;
         font-size: 20px;
         margin-left: 1px;
         vertical-align: top;
        
      }
      .nav-its .nav-lks .item-count sup {
         position: relative;
         font-size: 15px;
         top: -0.1em;
         /* Adjust the vertical position as needed */
      }
   </style>
</head>
<header class="header_section">
   <?php
      use App\Models\Cart;
      use App\Models\Wishlist;
   ?>
   @auth
   <?php
    $cartItemCount = Cart::where('user_id', auth()->user()->id)->count();
    $wishItemCount = Wishlist::where('user_id', auth()->user()->id)->count();
   ?>
   @endauth

   <div class="container">
      <nav class="navbar navbar-expand-lg custom_nav-container fixed-top bg-white p-3 shadow">
         <a class="navbar-brand" href="/"><img width="250" src="{{asset('images/logocart.png')}}" alt="#" /></a>
         <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class=""> </span>
         </button>
         <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav">

               @if(Route::has('login'))
               @auth

               <li class="nav-item ">
                  <a class="nav-link" href="/">Home <span class="sr-only"></span></a>
               </li>

               <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="productsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                     Products
                  </a>
                  <div class="dropdown-menu" aria-labelledby="productsDropdown">
                     <a class="dropdown-item" href="{{ url('full_product') }}">Store Products</a>
                     <a class="dropdown-item" href="{{ url('seller_items') }}">Seller Items</a>
                  </div>
               </li>

               <li class="nav-item">
                  <a class="nav-link" href="{{url('show_order')}}">Order</i></a>
               </li>

               <!-- <li class="nav-item">
                  <a class="nav-link fs-5" href="{{url('show_cart')}}"><i class="fa fa-shopping-cart" aria-hidden="true"></i>(<span style="color:#f7444e"><?php echo $cartItemCount; ?></span>)</a>
               </li>

               <li class="nav-item">
                  <a class="nav-link fs-5" href="{{url('show_wishlist')}}"><i class="fa fa-heart" aria-hidden="true"></i>(<span style="color:#f7444e"><?php echo $wishItemCount; ?></span>)</a> 
               </li> -->

               <li class="nav-item nav-its">
                  <a class="nav-link nav-lks fs-5" href="{{url('show_cart')}}"><i class="fa fa-shopping-cart" aria-hidden="true"></i><span class="item-count" style="background-color:#f7444e"><sup><?php echo $cartItemCount; ?></sup></span></a>
               </li>

               <li class="nav-item nav-its">
                  <a class="nav-link nav-lks fs-5" href="{{url('show_wishlist')}}"><i class="fa fa-heart" aria-hidden="true"></i><span class="item-count" style="background-color:#f7444e"><sup><?php echo $wishItemCount; ?></sup></span></a>
               </li>

               <li class="nav-item">
                  <a class="nav-link" href="{{url('sell')}}">Sell</a>
                  <!-- <a class="nav-link" href="#" data-toggle="modal" data-target="#sellModal">Sell</a> -->
               </li>

               <li class="nav-item">
                  <x-app-layout>

                  </x-app-layout>
               </li>
               @else

               <li class="nav-item ">
                  <a class="nav-link" href="/">Home<span class="sr-only"></span></a>
               </li>

               <li class="nav-item">
                  <a class="nav-link" href="{{url('full_product')}}">Products</a>
               </li>

               <li class="nav-item">
                  <a class="nav-link" href="{{url('about')}}">About</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" href="{{url('contact')}}">Contact</a>
               </li>


               <li class="nav-item mb-1">
                  <a class="btn btn-danger" style="width:85px" href="{{route('login')}}" id="logincss">Login</a>
               </li>

               <li class="nav-item">
                  <a class="btn btn-primary" href="{{route('register')}}">Register</a>
               </li>



               @endauth
               @endif
               <!-- <i class="fa fa-search" aria-hidden="true" style="margin-right:10px;margin-top:10px;margin-left:70px;"></i> -->
            </ul>
         </div>
      </nav>
   </div>
</header>

</html>