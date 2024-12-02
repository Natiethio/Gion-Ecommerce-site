<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <base href="/public">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  @include('admin.css')
  <style>
    .div_center {
      text-align: center;
      padding-top: 40px;
    }

    .div_center h1 {
      font-size: 40px;
      padding-bottom: 40px;
    }

    .input_col {
      color: black;
      width: 250px;
      padding-bottom: 20px;
    }

    label {
      display: inline-block;
      width: 200px;
      margin-left: 1px;
      /* vertical-align: top; */
      text-align: left;
    }

    .div_design {
      padding-bottom: 15px;
    }

    .span {
      color: red;
      margin-top: 10px;
    }

    .center {
      text-align: center;
    }

    .center .closebtn {
      margin-left: auto;
    }


    /* .alert:hover .close {
      display: block;
      margin-left:900px;
    } */
  </style>
</head>

<body>
  <div class="container-scroller">
    <!-- partial:partials/_sidebar.html -->
    @include('admin.sidebar')
    <!-- partial -->
    @include('admin.header')
    <!-- partial -->
    <div class="main-panel">
      <div class="content-wrapper">
        <div class="div_center">
          @if(session('message'))
          <div class="alert alert-success center" id="flash-message" role="alert">
            <div class="d-flex justify-content-evenly align-items-center">
              <div class="pl-5" style="padding-left:380px">
                {{ session('message') }}
              </div>
              <button type="button" class="closebtn" data-dismiss="alert" aria-label="Close" onclick="removeFlashMessage()">
                <span aria-hidden="true">X</span>
              </button>
            </div>
          </div>
          @endif
          <script>
            function removeFlashMessage() {
              var flashMessage = document.getElementById('flash-message');
              if (flashMessage) {
                flashMessage.parentNode.removeChild(flashMessage);
              }
            }
          </script>
          <h1>Update product</h1>
          <form action="/updpro/{{$product->id}}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="div_design">
              <label>Product Title:</label>
              <input class="input_col" type="text" name="title" placeholder="Enter Product Title" value="{{$product->title}}" /><br>
              <span class="span">@error('title'){{$message}}@enderror</span>
            </div>
            <div class="div_design">
              <label>Product Description:</label>
              <input class="input_col" type="text" name="description" placeholder="Enter Product Description" value="{{$product->description}}" /><br>
              <span class="span">@error('description'){{$message}}@enderror</span>
            </div>
            <div class="div_design">
              <label>Product Status:</label>
              <select class="input_col" name="status">
                @foreach($productstatus as $prostatus)
                <option value="{{$prostatus->product_status}}" {{$product->product_status == $prostatus->product_status ? 'selected' : ''}}>
                  {{$prostatus->product_status}}
                </option>
                @endforeach
              </select><br>
              <span class="span">@error('status'){{$message}}@enderror</span>
            </div>

            <div class="div_design">
              <label>Featured:</label>
              <select class="input_col" name="featured">
                @foreach($featuredproduct as $fud)
                <option value="{{$fud->featured}}" {{$product->featured == $fud->featured ? 'selected' : ''}}>
                  {{$fud->featured}}
                </option>
                @endforeach
              </select><br>
              <span class="span">@error('featured'){{$message}}@enderror</span>
            </div>
            
            <div class="div_design">
              <label>Product Price:</label>
              <input class="input_col" type="number" name="price" placeholder="Enter Product Price" value="{{$product->price}}" /><br>
              <span class="span">@error('price'){{$message}}@enderror</span>
            </div>
            <div class="div_design">
              <label>Discount Price:</label>
              <input class="input_col" type="number" name="dis_price" placeholder="Enter Discount Price if Applay" value="{{$product->discount_price}}" /><br>
            </div>
            <div class="div_design">
              <label>Product Quantity:</label>
              <input class="input_col" type="number" min="0" name="quantity" placeholder="Enter Product Quantity" value="{{$product->quantity}}" /><br>
              <span class="span">@error('quantity'){{$message}}@enderror</span>
            </div>

            <div class="div_design">
              <label>Product Catagory:</label>
              <select class="input_col" name="catagory">
                @foreach($category as $cat)
                <option value="{{$cat->catagory_name}}" {{$product->category == $cat->catagory_name ? 'selected' : ''}}>
                  {{$cat->catagory_name}}
                </option>
                @endforeach
              </select><br>
              <span class="span">@error('catagory'){{$message}}@enderror</span>
            </div>
            <div class="div_design">
              <label>Current Product Image:</label>
              <img style="margin:auto" width="100" height="100" src="/product/{{$product->image}}">
              <!-- <span class="span">@error('image'){{$message}}@enderror</span> -->
            </div>
            <div class="div_design">
              <label>Change Product Image Here:</label>
              <input type="file" name="image" placeholder="Product Image" /><br>
              <!-- <span class="span">@error('image'){{$message}}@enderror</span> -->
            </div>
            <div class="div_design">
              <input type="submit" value="Update Product" class="btn btn-primary">
            </div>
          </form>
        </div>

      </div>
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    @include('admin.script')
    <!-- End custom js for this page -->
    <script src="{{asset('home/js/jquery-3.4.1.min.js')}}"></script>
    <!-- popper js -->
    <script src="{{asset('home/js/popper.min.js')}}"></script>
    <!-- bootstrap js -->
    <script src="{{asset('home/js/bootstrap.js')}}"></script>
    <!-- custom js -->
    <script src="{{asset('home/js/custom.js')}}"></script>
</body>

</html>