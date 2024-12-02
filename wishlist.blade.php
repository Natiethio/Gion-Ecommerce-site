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
   <title>Wish List</title>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
   <link rel="stylesheet" type="text/css" href="{{asset('home/css/bootstrap.css')}}" />
   <link href="{{asset('css/font-awesome.min.css')}}" rel="stylesheet" />
   <link href="{{asset('home/css/style.css')}}" rel="stylesheet" />
   <link href="{{asset('home/css/responsive.css')}}" rel="stylesheet" />
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
   <style>
     .center2 {
        margin: auto;
        margin-top: 30px;
        text-align: center;
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
    </style>

  <?php
    use Illuminate\Support\Facades\Session;
  ?>

</head>

<body>
  @include('home.header')
<section class="product_section layout_padding mt-3">
  @if(isset($wishlist) && $wishlist->count() > 0)
   <div class="container">
  
   @if(Session::has('Restore'))
      <?php
        $softdata = Session::get('Restore');
        $wishId =   $softdata['wishid'];
      ?>
       <div class="row justify-content-center">
         <div class="col-md-4 mb-4">
           <a href="{{url('restorewish', $wishId)}}" class ="btn btn-dark">Undo<i class="fa fa-undo" aria-hidden="true"></i></a>
        </div>
      </div>
      <div class="heading_container heading_center mt-20" style="padding-top:70px">
        <h2 class="des">Your <span style=" color:#fb4b57">Cart</span></h2>
      </div>
      <?php
        $softdata = Session::forget('Restore');
      ?>
      @endif
  @foreach($wishlist as $wish)
  <div class="card justify-content-between shadow mt-3">
    <div class="row m-3">
      <div class="col-md-3">
        <img src="{{asset('product/'. $wish->image)}}" width="60" height="60" class="img-fluid" alt="Product Image">
        <h4 class="product-name">{{$wish->product_name}}</h4>
      </div>
      <div class="col-md-2">
        <p class="product-price mt-4">{{$wish->price}} <span class="text-warning">ETB</span></p>
      </div>
      <div class="col-md-4">
        <form action="{{route('add_cartfull')}}" method="post" class="form mt-3">
          @csrf
          <div class="input-group">
            <input type="hidden" name="productsId" value="{{$wish->product_id}}" min="1" >
            <input type="number" name="quantity" class="form-control" min="1" value="1" placeholder="Quantity" required>
            <div class="input-group-append">
              <button type="submit" class="btn btn-success bg-success text-white">Add to <i class="fa fa-shopping-cart" aria-hidden="true"></i></button>
            </div>
          </div>
        </form>
      </div>
      <div class="col-md-3 d-flex align-items-center justify-content-end">
      <form action="{{route('delete_wish')}}" method="post">
        @csrf
        <input type="hidden" name="Wishid" value="{{$wish->id}}">
        <button type="submit"> <i class="fa fa-trash text-danger fs-2 m-3"></i></button>
      </form>
     </div>
    </div>
  </div>
  @endforeach
</div>

    @else
      <div class="d-flex justify-content-center message">
        <p class="fs-4">{{ $messagen }}</p>
      </div>
     <div class="center2">
      <a href="/full_product" class="btn btn-danger mb-3">Continue Shoping</a>
    </div>
    @endif

    </section>
    
@include('home.footer')
   <script>
      function removeFlashMessage() {
         var flashMessage = document.getElementById('flash-message');
         if (flashMessage) {
            flashMessage.parentNode.removeChild(flashMessage);
         }
      }
   </script>

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
      toastr.success("{{ Session::get('success') }}" ,'Success!' ,{timeOut:5000});
   </script>
   @elseif(Session::has('failed'))
    <script>
     toastr.options = {
         "progressBar": true,
         "positionClass": "toast-top-right",
         "closeButton": true,
      }
      toastr.error("{{ Session::get('failed') }}" ,'Error!' ,{timeOut:15000});
    </script>
     @elseif(Session::has('info'))
    <script>
        toastr.options = {
            "progressBar": true,
            "positionClass": "toast-top-right",
            "closeButton": true,
        }
        toastr.info("{{ Session::get('info') }}" ,'Information!' ,{timeOut:10000});
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

   <script src="{{asset('home/js/popper.min.js')}}"></script>
   <!-- bootstrap js -->
   <script src="{{asset('home/js/bootstrap.js')}}"></script>
   <!-- custom js -->
   <script src="{{asset('home/js/custom.js')}}"></script>

</body>
</html>