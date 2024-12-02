<!DOCTYPE html>
<html lang="en">

<head>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <!-- Required meta tags -->
  @include('admin.css')
  <style>
    .div_center {
      text-align: center;
      padding-top: 40px;
    }

    .div_center h2 {
      font-size: 40px;
      padding-bottom: 40px;
    }

    .input_color {
      color: black;
    }

    .success {
      color: green;
    }

    .center {
      margin: auto;
      width: 50%;
      text-align: center;
      margin-top: 30px;
      border: 3px solid white;
    }

    tr {
      border: 3px solid white;
    }

    td {
      border: 3px solid white;
    }

    th {
      border: 3px solid white;
      font-size: 20px;
      /* background: rgb(0, 217, 255); */
    }

    .alert .close {
      margin-left: 750px;
    }

    .modal-body p{
      font-size: 20px;
      color: #000000;
      opacity: 0.5;
      transition: opacity 0.3s ease-in-out;
    }

    .modal-body p:hover {
      opacity: 1;
    }
  </style>
  <title>Category</title>
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
        @if(session('message'))
        <div class="alert alert-success" id="flash-message" role="alert">
          {{ session('message') }}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true" onclick="removeFlashMessage()">X</span>
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
        <div class="div_center">
          <h2>Add Catagory</h2>
          <form action="/add_catagory" method="post">
            @csrf
            <input class="input_color" type="text" name="catagory" placeholder="Enter catagory name">
            <span style="color:red">@error('catagory'){{$message}}@enderror</span>
            <input type="submit" class="btn btn-primary" name="submit" value="Add Catagory" />
          </form>
        </div>

        <table class="center">
          <tr>
            <th class="bg-primary">Catagory_Name</th>
            <th class="bg-primary">Action</th>
          </tr>
          @foreach($catagory as $cat)
          <tr>
            <td>{{$cat['catagory_name']}}</td>
            <td>
              <a class="btn btn-danger" data-toggle="modal" data-target="#confirmDeleteModal{{$cat->id}}">Delete</a>
            </td>
          </tr>
          <!--Model-->
          <div class="modal fade" id="confirmDeleteModal{{$cat->id}}" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModal{{$cat->id}}Label" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content bg-white text-dark">
                <div class="modal-header">
                  <h5 class="modal-title" id="confirmDeleteModal{{$cat->id}}Label">Confirm Cancel Category</h5>
                  <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span style="font-size:25px" aria-hidden="true">&times;</span>
                                    </button> -->
                  <a class="close btn btn-danger btn-sm float-right delete" data-dismiss="modal" aria-label="Close">X</a>
                </div>
                <div class="modal-body text-center">
                  <p>Are you sure you want to delete this category?</p>
                </div>
                <div class="modal-footer">
                  <a style="color: white;" class="btn btn-success" data-dismiss="modal">Close</a>
                  <a href="{{url('delete',$cat->id)}}" class="btn btn-danger">Delete</a>
                </div>
              </div>
            </div>
          </div>
          @endforeach
        </table>
      </div>
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    @include('admin.script')
    <!-- End custom js for this page -->
    <script src="home/js/jquery-3.4.1.min.js"></script>
    <!-- popper js -->
    <script src="home/js/popper.min.js"></script>
    <!-- bootstrap js -->
    <script src="home/js/bootstrap.js"></script>
    <!-- custom js -->
    <script src="home/js/custom.js"></script>
</body>

</html>