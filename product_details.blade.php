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
   <title>Detail</title>
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
   <link rel="stylesheet" type="text/css" href="{{asset('home/css/bootstrap.css')}}" />
   <link href="{{asset('css/font-awesome.min.css')}}" rel="stylesheet" />
   <link href="{{asset('home/css/style.css')}}" rel="stylesheet" />
   <link href="{{asset('home/css/responsive.css')}}" rel="stylesheet" />
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
   <style>
      .rating {
         display: inline-block;
         padding-bottom: 10px;
         font-size: 16px;
      }

      .star {
         color: black;
         display: inline-block;
         margin-right: 5px;
      }

      .yellow {
         color: #FFD700;
      }

      .black {
         color: black;
      }

      .toast-success {
         background-color: #094f07 !important;
         color: #fff !important;
         opacity: 1 !important;
      }

      .toast-error {
         background-color: #b91515 !important;
         color: #fff !important;
         opacity: 1 !important;
      }

      .toast-info {
         background-color: #0a617e !important;
         color: #fff !important;
         margin-top: 270px;
         opacity: 1 !important;
      }
   </style>
</head>

<body>
   @include('home.header')

   <div class="hero_area d-flex align-items-center justify-content-center">
      <div class="container">
         <div class="row justify-content-center">
            <div class="col-sm-4 col-md-8 col-lg-4">
               <div class="justify-content-center" style="margin-top:70px;margin-bottom:10px;width:50%;padding:20px;width:400px;border:1px solid gray; box-shadow: 2px 3px 9px rgba(0, 0, 0, 0.5);">
                  <div class="img-box" style="padding:20px">
                     <img src="{{asset('product/'. $product->image)}}" alt="" style="max-width: 100%; max-height: 100%; object-fit: contain;">
                  </div>
                  <div class="detail-box">
                     <h5>
                        {{$product->title}}
                     </h5>
                     @if($product->discount_price!=null)
                     <h6 style="color:red">

                        {{$product->discount_price}}<span style="color:orange">ETB</span>
                     </h6>
                     <h6 style="color:blue ;text-decoration:line-through;">

                        {{$product->price}}<span style="color:orange">ETB</span>
                     </h6>
                     @else
                     <h6 style="color:blue">

                        {{$product->price}}<span style="color:orange">ETB</span>
                     </h6>
                     @endif
                     <h6 style="font-style:Arial">Product Category:{{$product->category}}</h6>
                     <h6 style="font-style:Open Sans">Product Detail:{{$product->description}}</h6>
                     <h6 style="font-style:Roboto">Available Quantity:{{$product->quantity}}</h6>
                     <!-- <h6 style="padding-bottom:10px;font-style:Roboto">Ratings:</h6> -->
                     <div class="rating">
                        <span class="star" style="font-style:Roboto">Ratings:</span>
                        @for($i = 0 ; $i < 5 ; $i++) 
                          @if($i < $star) 
                             <span class="star yellow"><i class="fa fa-star" aria-hidden="true"></i></span>
                          @else
                             <span class="star black"><i class="fa fa-star" aria-hidden="true"></i></span>
                          @endif
                        @endfor
                     </div>

                     <div class="text-md-center d-flex justify-content-center">
                           <div class="d-flex flex-md-row align-items-center mt-3">
                              <form action="{{route('add_cartfull')}}" method="Post">
                                 @csrf
                                 <div class="input-group">
                                    <input type="hidden" name="productsId" value="{{$product->id}}" min="1">
                                    <input type="number" name="quantity" class="form-control" min="1" value="1" style="width: 150px; height: 48px;" placeholder="Quantity" required>
                                    <div class="input-group-append">
                                       <button type="" class="btn btn-outline-primary"><i class="fa fa-shopping-cart" aria-hidden="true"></i></button>
                                    </div>
                                 </div>
                              </form>
                              <form action="{{route('add_wishlistfull')}}" method="Post">
                                 @csrf
                                 <input type="hidden" name="productsId" value="{{$product->id}}" min="1">
                                 <button type="submit" class="btn btn-outline-dark ml-2" style="height:48px;"><i class="fa fa-heart" aria-hidden="true"></i></button>
                              </form>
                           </div>
                        </div>

                        <div class="text-md-center d-flex justify-content-center">
                           <div class="d-flex flex-md-row align-items-center mt-3">
                           <form action="{{route('store')}}">
                              <input type="hidden" name="productcategory" value="{{$product->category}}">
                              <button type="submit" class="btn btn-outline-success" style="margin-bottom:10px;">More</button>
                           </form>
                           <a href="{{url()->previous()}}" class="btn btn-outline-danger" style="margin-left: 10px; margin-bottom: 10px;">Back</a>
                           </div>
                        </div>
                  </div>
               </div>
            </div>
         </div>

      </div>
   </div>
   
      @include('home.footer')
      <!-- footer end -->

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
            timeOut: 10000
         });
      </script>
      @elseif(Session::has('failed'))
      <script>
         toastr.options = {
            "progressBar": true,
            "positionClass": "toast-top-right",
            "closeButton": true,
         }
         toastr.error("{{ Session::get('failed') }}", 'Error!', {
            timeOut: 17000
         });
      </script>
      @elseif(Session::has('info'))
      <script>
         toastr.options = {
            "progressBar": true,
            "positionClass": "toast-top-right",
            "closeButton": true,
         }
         toastr.info("{{ Session::get('info') }}", 'Information!', {
            timeOut: 18000
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

      <!-- jQery -->
      <script>
         function removeFlashMessage() {
            var flashMessage = document.getElementById('flash-message');
            if (flashMessage) {
               flashMessage.parentNode.removeChild(flashMessage);
            }
         }
      </script>
      <script src="{{asset('home/js/jquery-3.4.1.min.js')}}"></script>
      <!-- popper js -->
      <script src="{{asset('home/js/popper.min.js')}}"></script>
      <!-- bootstrap js -->
      <script src="{{asset('home/js/bootstrap.js')}}"></script>
      <!-- custom js -->
      <script src="{{asset('home/js/custom.js')}}"></script>
</body>

</html>