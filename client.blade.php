<?php

use App\Models\User;
?>
@auth
<?php
$user = User::find(auth()->user()->id);
?>
@endauth
<head>
   <style>
      .carousel-control-prev{
         text-decoration: none;
      }
      .carousel-control-next{
         text-decoration: none;
      }
   </style>
</head>

<section class="client_section layout_padding">
   <div class="container">
      <div class="heading_container heading_center">
         <h2>
            Customer's Testimonial
         </h2>
      </div>
      <div id="carouselExample3Controls" class="carousel slide" data-ride="carousel">
         <div class="carousel-inner">
            <div class="carousel-item active">
               <div class="box col-lg-10 mx-auto">
                  <div class="img_container">
                     <div class="img-box">
                        <div class="img_box-inner">
                           <img src="/product/avatar3.png" alt="">
                        </div>
                     </div>
                  </div>
                  <div class="detail-box">
                     <h5>
                        @if(Route::has('login'))
                        @auth
                        <?php echo ($user->name) ?>
                        @endauth
                        @endif
                     </h5>
                     <h6>
                        Customer
                     </h6>
                     <p>
                        Welcome to gion E-commerse website we offer vast varity of products to satisfy your need enjoy your stay.
                     </p>
                  </div>
               </div>
            </div>
            <div class="carousel-item">
               <div class="box col-lg-10 mx-auto">
                  <div class="img_container">
                     <div class="img-box">
                        <div class="img_box-inner">
                           <img src="/product/avatar3.png" alt="">
                        </div>
                     </div>
                  </div>
                  <div class="detail-box">
                     <h5>
                  @if(Route::has('login'))
                    @auth
                        <?php echo ($user->name) ?>
                    @endauth
                   @endif
                     </h5>
                     <h6>
                        Customer
                     </h6>
                     <p>
                       Welcome to gion E-commerse website we offer vast varity of products to satisfy your need enjoy your stay.
                     </p>
                  </div>
               </div>
            </div>
            <div class="carousel-item">
               <div class="box col-lg-10 mx-auto">
                  <div class="img_container">
                     <div class="img-box">
                        <div class="img_box-inner">
                           <img src="/product/avatar3.png" alt="">
                        </div>
                     </div>
                  </div>
                  <div class="detail-box">
                     <h5>
                   @if(Route::has('login'))
                     @auth
                        <?php echo ($user->name) ?>
                     @endauth
                   @endif
                      </h5>
                     <h6>
                        Customer
                     </h6>
                     <p>
                       Welcome to gion E-commerse website we offer vast varity of products to satisfy your need enjoy your stay.
                     </p>
                  </div>
               </div>
            </div>
         </div>
         <div class="carousel_btn_box">
            <a class="carousel-control-prev" href="#carouselExample3Controls" role="button" data-slide="prev">
               <i class="fa fa-long-arrow-left" aria-hidden="true"></i>
               <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExample3Controls" role="button" data-slide="next">
               <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
               <span class="sr-only">Next</span>
            </a>
         </div>
      </div>
   </div>
</section>