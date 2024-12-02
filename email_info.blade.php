<!DOCTYPE html>
<html lang="en">

<head>
  <style>
    .email {
      padding-left: 35%;
      padding-top: 30px;
    }

    label {
      display: inline-block;
      width: 150px;
      font-size: 15px;
      font-weight: bold;
    }

    form {
      margin-top: 20px;
    }

    .input {
      color: black;
    }
  </style>
  <base href="/public">
  <!-- Required meta tags -->
  @include('admin.css')
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
          <button type="button" class="close pl-5" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true" onclick="removeFlashMessage()">X</span>
        </div>
        @endif

        <h1 style="text-align:center;font-size:25px">Send email to:{{$order->email}}</h1>
        <form action="{{url('send_user_email',$order->id)}}" method="post">
          @csrf
          <div class="email">
            <label>Email Greeting:</label>
            <input class="input" type="text" name="greeting">
          </div>
          <div class="email">
            <label>Email Firstline:</label>
            <input class="input" type="text" name="firstline">
          </div>
          <div class="email">
            <label>Email Body:</label>
            <input class="input" type="text" name="body">
          </div>
          <div class="email">
            <label>Email Button:</label>
            <input class="input" type="text" name="button">
          </div>
          <div class="email">
            <label>Email url:</label>
            <input class="input" class="input" type="text" name="url">
          </div>
          <div class="email">
            <label>Email Lastline:</label>
            <input class="input" type="text" name="lastline">
          </div>
          <div class="email">
            <input type="submit" value="Send Email" class="btn btn-primary">
          </div>
        </form>
      </div>
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    @include('admin.script')
    <script>
      function removeFlashMessage() {
        var flashMessage = document.getElementById('flash-message');
        if (flashMessage) {
          flashMessage.parentNode.removeChild(flashMessage);
        }
      }
    </script>
    <!-- End custom js for this page -->
</body>

</html>