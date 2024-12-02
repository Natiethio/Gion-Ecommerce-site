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
  <title>Order</title>
  <link rel="stylesheet" type="text/css" href="{{asset('home/css/bootstrap.css')}}" />
  <link href="{{asset('css/font-awesome.min.css')}}" rel="stylesheet" />
  <link href="{{asset('home/css/responsive.css')}}" rel="stylesheet" />
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
      transition: opacity 0.5s ease-in-out;
    }

    .modal-body:hover {
      opacity: 1;
    }

    .closebtn {
      margin-left: 600px;
    }
    .close{
      opacity:0.8;
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
        <h1 class="title_deg">All Orders</h1>
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-md-8">
              <div class="card bg-dark text-light mb-4">
                <div class="card-body">
                  <form action="{{url('search')}}" method="get" class="d-flex align-items-center justify-content-center">
                    @csrf
                    <input style="color:black; background-color: white;" type="text" name="search" placeholder="Search Order" class="form-control mr-2">
                    <input type="submit" value="Search" class="btn btn-outline-primary">
                  </form>
                </div>
              </div>
              @if(isset($orderdata) && count($orderdata)>0)
              <div class="card bg-dark text-light">
                <div class="card-body">
                  @foreach($orderdata as $order)
                  <div class="card mb-3">
                    <div class="card-body">
                      <h5 class="card-title">Customer: {{$order->name}}</h5>
                      <p class="card-text">Email: {{$order->email}}</p>
                      <p class="card-text">Address: {{$order->address}}</p>
                      <p class="card-text">Phone: {{$order->phone}}</p>
                      <p class="card-text">Products: {{$order->product_title}}</p>
                      <p class="card-text">Product Id: {{$order->product_id}}</p>
                      <p class="card-text">Total Price: {{$order->price}}</p>
                      <p class="card-text">Shipping id: {{$order->shipping_id}}</p>
                      <p class="card-text">Payment Status: {{$order->payment_status}}</p>
                      <p class="card-text">Delivery Status: {{$order->delivery_status}}</p>
                      <div class="d-flex justify-content-between align-items-center">
                        <div>
                          @if($order->delivery_status=="Pending" || $order->delivery_status=="Processing")
                          <!-- <a class="btn btn-primary mr-2" href="{{url('change',$order->id)}}" onclick="return confirm('Are You Sure The Customer Is Delivered?')">Deliver</a> -->
                          <a class="btn btn-primary text-white mr-2" data-toggle="modal" data-target="#confirmDeleteModal{{$order->id}}">
                            Deliver
                          </a>
                          @else
                          <p style="color:green">Delivered</p>
                          @endif
                          <a href="{{url('print_pdf',$order->id)}}" class="btn btn-secondary mr-2">Print Receipt</a>
                        </div>
                        <div>
                          <a href="{{url('send_email',$order->id)}}" class="btn btn-info">Send Email</a>
                        </div>
                      </div>
                      @php
                      $orderDate = \Carbon\Carbon::parse($order->created_at);
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
                    </div>
                  </div>
                  <div class="modal fade" id="confirmDeleteModal{{$order->id}}" tabindex="-1" aria-labelledby="confirmDeleteModal{{$order->id}}Label" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content bg-white text-dark">
                        <div class="modal-header">
                          <h5 class="modal-title" id="confirmDeleteModal{{$order->id}}Label">Deliver Product</h5>
                            <a type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span style="border-radius:5px;opacity:1;" aria-hidden="true" class="bg-danger text-white p-1 pt-1">&times;</span>
                            </button>
                            <!-- <a class="close btn btn-danger btn-sm h-2" data-dismiss="modal" aria-label="Close">X</a> -->
                        </div>
                        <div class="modal-body text-center">
                          <p>Are You Sure The Customer Is Delivered?</p>
                        </div>
                        <div class="modal-footer">
                          <a style="color: white;" class="btn btn-danger" data-dismiss="modal">Close</a>
                          <a href="{{ url('change', $order->id) }}" class="btn btn-success">Yes</a>
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
                  <p class="card-text">Search data not Found!</p>
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
    <!-- popper js -->
    <script src="{{asset('home/js/popper.min.js')}}"></script>
    <!-- bootstrap js -->
    <script src="{{asset('home/js/bootstrap.js')}}"></script>
    <!-- custom js -->
    <script src="{{asset('home/js/custom.js')}}"></script>
    <!-- End custom js for this page -->
</body>

</html>