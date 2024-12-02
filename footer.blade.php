<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" 
integrity="sha384-eZP+7I5CZLwVv9Yh5Se5QV8vFW3pEwBn6jDbO1u4JZQg1C+uZ0qOZ3YveOjG/Jf9" crossorigin="anonymous">
   <style>
 .widget_menu ul li a{
   text-decoration:none;
 }
 .widget_menu ul li a:hover{
   padding-left:9px;
   color:#f7444e;
   transition: 0.3s ease;
 }


 .social-media-links {
   display: flex;
   justify-content: space-between;
   margin-top: 10px;
}

.social-media-links a {
   display: inline-block;
   width: 30px;
   height: 30px;
   text-align: center;
   line-height: 30px;
   transition: background-color 0.3s, color 0.3s;
   margin-right: 1px; /* Adjust the margin to control the spacing */
}

.social-media-links a:last-child {
   margin-right: 0; /* Remove the margin for the last icon */
}

.social-media-links a:hover {
   background-color:white;
   color: black;
}
@media (max-width: 576px) {
   .social-media-links {
      justify-content: flex-start; /* Align icons to the start */
   }

   .social-media-links a {
      margin-right: 6px; /* Adjust the margin for smaller spacing */
   }
}

@media (max-width: 320px) {
   .social-media-links a {
      margin-right: 4px; /* Further reduce the margin for smaller spacing */
   }
}
   </style>
</head>
<section class="shadow">
<footer class="border" style="background-color:#f2f0f1">
   <div class="container">
      <div class="row">
         <div class="col-md-4">
            <div class="full">
               <div class="logo_footer">
                  <a href="/"><img width="210" src="{{asset('images/logocart.png')}}" alt="#" /></a>
               </div>
               <div class="information_f">
                  <p><strong>ADDRESS:</strong> Mexico K Building 1st floor</p>
                  <p><strong>TELEPHONE:</strong> +251970951608</p>
                  <p><strong>EMAIL:</strong> natman@gmail.com</p>
               </div>
            </div>
         </div>
         <div class="col-md-8">
            <div class="row">
               <div class="col-md-7">
                  <div class="row">
                     <div class="col-md-6">
                        <div class="widget_menu">
                           <h3>QUICK LINKS</h3>
                           <ul>
                              <li><a class="pb-3" href="/">Home</a></li>
                              <li><a class="pb-3" href="/full_product">Products</a></li>
                              <li><a class="pb-3" href="/about">About</a></li>
                              <li><a class="pb-3" href="/contact">Contact</a></li>
                           </ul>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="widget_menu">
                           <h3>EXTRA LINKS</h3>
                           <ul>
                              @if(Route::has('login'))
                              @auth
                                <li><a class="pb-3" href="/show_cart">Cart</a></li>
                                <li><a class="pb-3" href="/show_order">Order</a></li>
                                <li><a class="pb-3" href="{{url('show_wishlist')}}">Wish List</a></li>
                              @else
                              <li>
                                 <a class="pb-3" href="{{route('login')}}" id="logincss">Login</a>
                             </li>
                              <li><a class="pb-3" href="{{route('register')}}">Register</a></li>
                              @endauth
                              @endif
                           </ul>
                        </div>
                     </div>
                  </div>
               </div>
             
              <div class="col-lg-3 col-md-3 col-sm-5">
                  <div class="widget_menu">
                     <div class="footer-col">
                        <h3>Follow us</h3>
                        <div class="social-media-links">
                           <a href="#" class="rounded-circle bg-dark"><i class="fa fa-facebook text-white" aria-hidden="true"></i></a>
                           <a href="#" class="rounded-circle bg-dark"><i class="fa fa-twitter text-white" aria-hidden="true"></i></a>
                           <a href="#" class="rounded-circle bg-dark"><i class="fa fa-instagram text-white" aria-hidden="true"></i></a>
                           <a href="#" class="rounded-circle bg-dark"><i class="fa fa-linkedin text-white" aria-hidden="true"></i></a>
                        </div>
                        <div class="mt-3">
                                <p class="mb-20 wow fadeIn animated">Payment Gateways</p>
                                <img class="wow fadeIn animated" src="{{asset('images/payment-method.png')}}" style="height:30px" alt="">
                         </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>

   </div>
</footer>
<div class="cpy_">
   <p class="mx-auto">© 2023 All Rights Reserved By <a href="/">Gion</a><br>
   </p>
</div>
</section>
   </html>