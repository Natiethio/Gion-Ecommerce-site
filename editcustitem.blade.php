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
          <h1>Update Item</h1>
          <form action="/updcust/{{$custpro->id}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="div_design">
              <label>Item Title:</label>
              <input class="input_col" type="text" name="title" placeholder="Enter Product Title" value="{{$custpro->title}}" /><br>
              <span class="span">@error('title'){{$message}}@enderror</span>
            </div>
            <div class="div_design">
              <label>Item Description:</label>
              <input class="input_col" type="text" name="description" placeholder="Enter Product Description" value="{{$custpro->description}}" /><br>
              <span class="span">@error('description'){{$message}}@enderror</span>
            </div>
            <!-- <div class="div_design">
              <label>Item Status:</label>
              <input class="input_col" type="text" name="status" placeholder="Enter Product Status" value="{{$custpro->status}}" /><br>
              <span class="span">@error('status'){{$message}}@enderror</span>
            </div> -->
            <div class="div_design">
              <label>Item Status:</label>
              <select class="input_col" name="status">
                @foreach($custstatus as $cust)
                <option value="{{$cust->status}}" {{$custpro->status == $cust->status ? 'selected' : ''}}>
                  {{$cust->status}}
                </option>
                @endforeach
              </select><br>
              <span class="span">@error('status'){{$message}}@enderror</span>
            </div>
            <div class="div_design">
              <label>Item Estimated Price:</label>
              <input class="input_col" type="number" name="price" placeholder="Enter Product Price" value="{{$custpro->price}}" /><br>
              <span class="span">@error('price'){{$message}}@enderror</span>
            </div>
            <!-- <div class="div_design">
              <label>Discount Price:</label>
              <input class="input_col" type="number" name="dis_price" placeholder="Enter Discount Price if Applay" value="{{$custpro->discount_price}}" /><br>
            </div> -->
            <div class="div_design">
              <label>Item Quantity:</label>
              <input class="input_col" type="number" min="0" name="quantity" placeholder="Enter Product Quantity" value="{{$custpro->quantity}}" /><br>
              <span class="span">@error('quantity'){{$message}}@enderror</span>
            </div>

            <div class="div_design">
              <label>Item Catagory:</label>
              <select class="input_col" name="catagory">
                @foreach($category as $cat)
                <option value="{{$cat->catagory_name}}" {{$custpro->category == $cat->catagory_name ? 'selected' : ''}}>
                  {{$cat->catagory_name}}
                </option>
                @endforeach
              </select><br>
              <span class="span">@error('catagory'){{$message}}@enderror</span>
            </div>
            <div class="div_design">
              <label>Current Item Image:</label>
              <img style="margin:auto" width="100" height="100" src="/custemersell/{{$custpro->image}}">
              <!-- <span class="span">@error('image'){{$message}}@enderror</span> -->
            </div>
            <div class="div_design">
              <label>Change Item Image(Optinal):</label>
              <input class="input_col" type="file" name="image"/><br>
              <!-- <span class="span">@error('image'){{$message}}@enderror</span> -->
            </div>
            <div class="div_design">
              <label>Item Verification:</label>
              <!-- <input class="input_col" type="text" name="verification" placeholder="Enter Item Verification" value="{{$custpro->verification}}" /><br> -->
              <select class="input_col" name="verification">
                 <!-- <option value="{{$custpro->verification}}" selected="">{{$custpro->verification}}</option> -->
                 <option value="Not Verified" {{$custpro->verification == "Not Verified" ? 'selected' : ''}}>Not Verified</option>
                 <option value="Verified" {{$custpro->verification == "Verified" ? 'selected' : ''}}>Verified</option>
              </select><br>
              <span class="span">@error('verification'){{$message}}@enderror</span>
            </div>
            <div class="div_design">
              <input type="submit" value="Update Seller Item" class="btn btn-primary">
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