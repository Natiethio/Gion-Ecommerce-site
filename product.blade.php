<!DOCTYPE html>
<html lang="en">

<head>
  <title>Add Product</title>
  <!-- Required meta tags -->
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
      width:250px;
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

    .alert .close {
      margin-left:750px;
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
        <div class="div_center" >
          @if(session()->has('message'))
          <div class="alert alert-success" role="alert" id="flash-message">
            {{session()->get('message')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true" onclick="removeFlashMessage()">X</span>
          </div>
          @endif
          <script>
            function removeFlashMessage(){
              var flashMessage = document.getElementById('flash-message');
              if (flashMessage) {
                flashMessage.parentNode.removeChild(flashMessage);
              }
            }
          </script>
          <h1>Add product</h1>
          <form action="{{url('add_product')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="div_design">
              <label>Product Title:</label>
              <input class="input_col" type="text" name="title" placeholder="Enter Product Title" /><br>
              <span class="span">@error('title'){{$message}}@enderror</span>
            </div>
            <div class="div_design">
              <label>Product Description:</label>
              <input class="input_col" type="text" name="description" placeholder="Enter Product Description" /><br>
              <span class="span">@error('description'){{$message}}@enderror</span>
            </div>
            <div class="div_design">
              <label>Product Price:</label>
              <input class="input_col" type="number" name="price" placeholder="Enter Product Price" /><br>
              <span class="span">@error('price'){{$message}}@enderror</span>
            </div>
            <div class="div_design">
              <label>Discount Price:</label>
              <input class="input_col" type="number" name="dis_price" placeholder="Enter Discount Price if Applay" /><br>
            </div>
            <div class="div_design">
              <label>Product Quantity:</label>
              <input class="input_col" type="number" min="0" name="quantity" placeholder="Enter Product Quantity" /><br>
              <span class="span">@error('quantity'){{$message}}@enderror</span>
            </div>

            <div class="div_design">
              <label>Product Catagory:</label>
              <select class="input_col" name="catagory">
                <option value="" selected="">Select category</option>
                @foreach($catagory as $cat)
                <option value="{{$cat->catagory_name}}">{{$cat['catagory_name']}}</option>
                @endforeach
              </select><br>
              <span class="span">@error('catagory'){{$message}}@enderror</span>
            </div>
            <div class="div_design">
              <label>Product Image Here:</label>
              <input type="file" name="image" placeholder="Product Image" /><br>
              <!-- <span class="span">@error('image'){{$message}}@enderror</span> -->
            </div>
            <div class="div_design">
              <input type="submit" value="Add Product" class="btn btn-primary">
            </div>
          </form>
        </div>

      </div>
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    @include('admin.script')
    <!-- End custom js for this page -->
</body>

</html>