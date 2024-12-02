<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <link rel="shortcut icon" href="home/images/favicon.png" type="">
  <title>Shipping</title>
  <link rel="stylesheet" type="text/css" href="{{asset('home/css/bootstrap.css')}}" />
  <link href="{{asset('css/font-awesome.min.css')}}" rel="stylesheet" />
  <link href="{{asset('home/css/responsive.css')}}" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
   

     
  <!-- Required meta tags -->
  @include('admin.css')

  <style>
    .title_deg {
      text-align: center;
      margin: auto;
      font-size: 42px;
      padding-bottom: 30px;
    }

    table {
      text-align: center;
    }

    .img_size {
      width: 250px;
      height: 150px;
    }

    th {
      font-size: 20px;
      border: 3px solid white;
      background: rgb(0, 217, 255);
    }

    tr {
      border: 3px solid white;
    }

    td {
      border: 3px solid white;
      width: 250px;
      height: 150px
    }

    .modal-body {
      font-size: 23px;
      font-weight: bold;
      text-align: center;
      opacity: 0.9;
      transition: opacity 0.3s;
    }

    .modal-body p {
      margin-bottom: 3px;
      font-size: 20px;
      font-weight: bold;
      transition: opacity 0.3s ease-in-out;
    }

    .modal-body:hover {
      opacity: 1;
    }

    .closebtn {
      margin-left: 600px;
    }
    .close{
        opacity: 1;
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
    use App\Models\Shipping;
  ?>

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
        <h1 class="title_deg">All Shippings</h1>
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-md-8">
              <div class="card bg-dark text-light mb-4">
                <div class="card-body">
                  <form action="{{route('searchship')}}" method="get" class="d-flex align-items-center justify-content-center">
                    @csrf
                    <input style="color:black; background-color: white;" type="number" name="search" placeholder="Enter Shipping Id" class="form-control mr-2">
                    <input type="submit" value="Search" class="btn btn-outline-primary">
                  </form>
                </div>
              </div>
              @if(isset($shipping) && count($shipping)>0)
              <div class="card bg-dark text-light">
                <div class="card-body">
                  @foreach($shipping as $ship)
                  <div class="card mb-3">
                    <div class="card-body">
                      <h5 class="card-title">Ship Id: {{$ship->id}}</h5>
                      <p class="card-text" style="font-size:15px">Ship To: {{$ship->first_name}} {{$ship->last_name}}</p>
                      <p class="card-text" style="font-size:15px">Email: {{$ship->email}}</p>
                      <p class="card-text" style="font-size:15px">Phone: {{$ship->phone}}</p>
                      <p class="card-text" style="font-size:15px">Phone 2: {{$ship->phone2}}</p>
                      <p class="card-text" style="font-size:15px">City: {{$ship->city}}</p>
                      <p class="card-text" style="font-size:15px">Town: {{$ship->town}}</p>
                      <p class="card-text" style="font-size:15px">Kebele/Wereda: {{$ship->kbl_wra}}</p>
                      <p class="card-text" style="font-size:15px">Pobox: {{$ship->pobox}}</p>
                      <p class="card-text" style="font-size:15px">Address: {{$ship->add_address}}</p>
                    
                      @php
                      $orderDate = \Carbon\Carbon::parse($ship->created_at);
                      $today = \Carbon\Carbon::today();
                      $daysDifference = $today->diffInDays($orderDate);
                      $timeElapsed = $orderDate->diffForHumans();
                      @endphp
                      <p class="card-text">
                        Order Date:
                        @if($orderDate->isToday())
                        Today, {{$orderDate->format('d M Y')}} ({{$timeElapsed}})
                        @else
                        {{$daysDifference}} day(s) ago ({{$orderDate->format('d M Y')}})
                        @endif
                      </p>

                      <div class="d-flex justify-content-between align-items-center">
                        <div>
                          <a class="btn btn-danger text-white mr-2" data-toggle="modal" data-target="#confirmDeleteModal{{$ship->id}}">
                            Delete
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>

                   <div class="modal fade" id="confirmDeleteModal{{$ship->id}}" tabindex="-1" aria-labelledby="confirmDeleteModal{{$ship->id}}Label" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content bg-white text-dark">
                        <div class="modal-header">
                          <h5 class="modal-title" id="confirmDeleteModal{{$ship->id}}Label">Delete Shipping Data</h5>
                            <a type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span style="border-radius:5px;opacity:1;" aria-hidden="true" class="bg-danger text-white p-1 pt-1">&times;</span>
                            </button>
                           
                        </div>
                        <div class="modal-body text-center">
                          <p>Are You Sure The Customer Is Delivered?</p>
                        </div>
                        <div class="modal-footer">
                          <a style="color: white;" class="btn btn-danger" data-dismiss="modal">Close</a>
                          <a href="{{ url('deleteodrshp', $ship->id) }}" class="btn btn-success">Yes</a>
                        </div>
                      </div>
                    </div>
                  </div> 

                  @endforeach
                </div>
              </div>
              @else
              <div class="card bg-dark text-light">
                <div class="card-body">
                  <p class="card-text">Search data not found!</p>
                </div>
              </div>
              @endif
            </div>
          </div>
        </div>


      </div>
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    @include('admin.script')
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
        toastr.info("{{ Session::get('info') }}" ,'Information!' ,{timeOut:12000});
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
    <!-- popper js -->
    <script src="{{asset('home/js/popper.min.js')}}"></script>
    <!-- bootstrap js -->
    <script src="{{asset('home/js/bootstrap.js')}}"></script>
    <!-- custom js -->
    <script src="{{asset('home/js/custom.js')}}"></script>
    <!-- End custom js for this page -->
</body>

</html>