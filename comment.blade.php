<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Comments</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('home/css/bootstrap.css')}}" />
    <link href="{{asset('home/css/responsive.css')}}" rel="stylesheet" />
    <!-- Required meta tags -->
    @include('admin.css')
    <style>
        body {
            background-color: black;
        }

        .table {
            background-color: black;
            color: white;
        }

        .table thead {
            border-bottom: 1px solid white;
        }

        .table tbody tr:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }
    </style>

    <title></title>
</head>

<body>
    <div class="container-scroller">
        @include('admin.sidebar')
        <!-- partial -->
        @include('admin.header')
        <div class="main-panel">
            <div class="content-wrapper">
                <div class="container">
        @if(session('message'))
          <div class="alert alert-success center" id="flash-message" role="alert">
            <div class="d-flex justify-content-evenly align-items-center">
              <div class="pl-5" style="padding-left:550px">
                {{ session('message') }}
              </div>
              <button type="button" class="closebtn" data-dismiss="alert" aria-label="Close" onclick="removeFlashMessage()">
                <span aria-hidden="true">X</span>
              </button>
            </div>
          </div>
          @endif

                    <table class="table">
                        <thead>
                            <tr>
                                <th class="fs-5">Name</th>
                                <th class="fs-5">Comment</th>
                                <th class="fs-5">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                          @foreach($comment as $comment)
                            <tr>
                                <td>{{$comment->name}}</td>
                                <td>{{$comment->comment}}</td>
                                <td>
                                <a  class="btn btn-danger text-white fs-3" href="{{url('deletecom',$comment->id)}}">
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                </a>
                                </td>
                            </tr>
                          @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>