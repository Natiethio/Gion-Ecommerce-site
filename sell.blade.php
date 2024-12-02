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
  <title>Sell Your Staffs</title>
  <link rel="stylesheet" type="text/css" href="{{asset('home/css/bootstrap.css')}}" />
  <link href="{{asset('css/font-awesome.min.css')}}" rel="stylesheet" />
  <link href="{{asset('home/css/style.css')}}" rel="stylesheet" />
  <link href="{{asset('home/css/responsive.css')}}" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
  <style>
    /* .body {
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      height: 1000px;
      margin: 0;
    }
*/
    .form-container {
      margin-top: 80px;
      margin-bottom: 60px; 
      width: 400px;
      padding: 20px;
      border: 1px solid #ccc;
      border-radius: 5px;
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
    .form-container input,
    .form-container textarea,
    .form-container select {
      margin-bottom: 10px;
    } 
  </style>
   <?php
     use Illuminate\Support\Facades\Session;
   ?>
</head>
<body>
  <div class="hero_area">
    <!-- header section strats -->
   
    @include('home.header')
   
    <div class="center">
    <!-- @if(session('message'))
         <div class="alert alert-success d-flex justify-content-center" id="flash-message" role="alert" style="text-align:center;width:900px;margin-top:100px;margin-left:270px">
              {{session('message')}}
            <button type="button" class="close ml-5" data-dismiss="alert" aria-label="Close" onclick="removeFlashMessage()">
               <span aria-hidden="true">X</span>
            </button>
         </div>
    @endif -->
      <div class="body d-flex justify-content-center">
       <div class="form-container shadow">
    <form action="{{url('/sellproduct')}}" method="post" enctype="multipart/form-data">
      @csrf
      <div class="form-group">
        <label for="ItemName">Item Name</label>
        <input type="text" class="form-control" name="ItemName" placeholder="Enter Item Name">
        <span class="span" style="color:red">@error('ItemName'){{$message}}@enderror</span>
      </div>
      <div class="form-group">
        <label for="ItemDescription">Item Description</label>
        <textarea class="form-control" name="ItemDescription" rows="3" placeholder="Enter Item description enter more detail to attract more attention"></textarea>
        <span class="span" style="color:red">@error('ItemDescription'){{$message}}@enderror</span>
      </div>
      <div class="form-group">
        <label for="ItemQuantity">Item Quantity</label>
        <input type="number" class="form-control" min="1" name="ItemQuantity" placeholder="Enter Item quantity">
        <span class="span" style="color:red">@error('ItemQuantity'){{$message}}@enderror</span>
      </div>
      <div class="form-group">
        <label for="ItemStatus">Condition</label>
        <select class="form-control" name="ItemStatus">
          <option>Select Status</option>
          <option value="New">New</option>
          <option value="Slightly Used">Slightly Used</option>
          <option value="Used">Used</option>
        </select>
        <span  style="color:red">@error('ItemStatus'){{$message}}@enderror</span>
      </div>
      <div class="form-group">
        <label for="ItemCategory">Category</label>
        <select class="form-control" name="ItemCategory">
        <option value="" selected="">Select category</option>
          @foreach($category as $category)
            <option value="{{$category->catagory_name}}">{{$category->catagory_name}}</option>
          @endforeach
        </select>
        <span  style="color:red">@error('ItemCategory'){{$message}}@enderror</span>
      </div>
      <div class="form-group">
        <label for="ItemPhoto">Item Photo(High Quality Recommended)</label>
        <input type="file" class="form-control-file" name="ItemPhoto">
        <span class="span" style="color:red">@error('ItemPhoto'){{$message}}@enderror</span>
      </div>
      <div class="form-group">
        <label for="optionalPhone">Optional Phone</label>
        <input type="number" class="form-control" min="1" name="optionalPhone" placeholder="Enter optional phone if any">
      </div>
      <div class="form-group">
        <label for="ItemPrice">Item Price</label>
        <input type="number" class="form-control" name="ItemPrice" min="1" placeholder="Enter Item price">
        <span class="span" style="color:red">@error('ItemPrice'){{$message}}@enderror</span>
      </div>
      <input type="submit" class="btn btn-primary" value="Submit">
    </form>
  </div>
   </div>
  </div>
  @include('home.footer')
  <script src="{{asset('home/js/jquery-3.4.1.min.js')}}"></script>

   <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.min.js" integrity="sha512-WW8/jxkELe2CAiE4LvQfwm1rajOS8PHasCCx+knHG0gBHt8EXxS6T6tJRTGuDQVnluuAvMxWF4j8SNFDKceLFg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

   <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

      @if(Session::has('infoseller'))
       <script>
         toastr.options = {
            "progressBar": true,
            "positionClass": "toast-top-right",
            "closeButton": true,
          }
         toastr.info("{{ Session::get('infoseller') }}" ,'Information!' ,{timeOut:15000});
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
  </div>
</body>
<script src="home/js/jquery-3.4.1.min.js"></script>
<!-- popper js -->
<script src="home/js/popper.min.js"></script>
<!-- bootstrap js -->
<script src="home/js/bootstrap.js"></script>
<!-- custom js -->
<script src="home/js/custom.js"></script>
</html>