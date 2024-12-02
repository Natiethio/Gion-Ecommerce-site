<!DOCTYPE html>
<html>

<head>
    <!-- Basic -->
    <!-- <base href="/public"> -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Site Metas -->
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Order</title>
    <link rel="shortcut icon" href="{{asset('images/favicon2.png')}}" type="">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="{{asset('css/font-awesome.min.css')}}" rel="stylesheet" />
    <link href="{{asset('home/css/style.css')}}" rel="stylesheet" />
    <link href="{{asset('home/css/responsive.css')}}" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">


    <style>
        .center {
            margin-top: 30px;
            margin-left: 200px;
            width: 70%;
            padding: 30px;
            text-align: center;
        }

        .des {
            font-size: 70px;
            text-align: center;
        }

        .img_size {
            width: 250px;
            height: 150px;
        }

        h1 span .order {
            color: "#fb4b57";
        }

        .message {
            font-size: 30px;
            font-weight: 300;
        }

        .modal-body {
            font-size: 23px;
            font-weight: bold;
            text-align: center;
            opacity: 0.5;
            transition: opacity 0.3s;
        }

        .modal-body p {
            margin-bottom: 3px;
            transition: opacity 0.3s ease-in-out;
        }

        .modal-body:hover {
            opacity: 0.8;
        }

        .closebtn {
            margin-left: 600px;

        }

        .toast-success {
            background-color: #094f07 !important;
            color: #fff !important;
            opacity:1 !important;
        }

        .toast-error {
            background-color: #b91515 !important;
            color: #fff !important;
            opacity:1 !important;
        }

        .toast-info {
            background-color: #0a617e !important;
            color: #fff !important;
            opacity:1 !important;
        }
    </style>
</head>

<body>
    <div class="hero_area">
        @include('home.header')
        <div class="heading_container heading_center m-5" style="padding-top:30px ">
            <h2 class="pl-5">Your <span style=" color:#fb4b57">Orders</span></h2>
        </div>

        @if(isset($order) && $order->count()>0)
        <div class="container ">

            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>Product Title</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th class="w-3 mr-0">Payment Status</th>
                            <th>Delivery Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    @foreach($order as $order)
                    <tr>
                        <td style="font-size:13px">{{$order->product_title}}</td>
                        <td>{{$order->quantity}}</td>
                        <td>{{$order->price}}</td>
                        <td>{{$order->payment_status}}</td>
                        <td>{{$order->delivery_status}}</td>
                        @if($order->delivery_status=="Pending")
                         <td>
                           <div class="d-flex gap-2 align-items-center">
                                <a class="btn btn-danger text-white" data-toggle="modal" data-target="#confirmDeleteModal{{$order->id}}">
                                  <i class="fa fa-times" aria-hidden="true"></i>
                                </a>
                                <a  data-bs-toggle="tooltip" data-bs-placement="right" title="Download Reciept" href="{{url('print_pdfuser',$order->id)}}" class="btn btn-primary mr-2"><i class="fa fa-download" aria-hidden="true"></i></a>
                            </div>
                         </td>
                        @else
                        <td>
                          <div class="d-flex gap-2 align-items-center">
                            <p style="color:blue">Paid</p>
                            <a  data-bs-toggle="tooltip" data-bs-placement="right" title="Download Reciept" href="{{url('print_pdfuser',$order->id)}}" class="btn btn-primary mr-2"><i class="fa fa-download" aria-hidden="true"></i></a>
                          </div>
                        </td>
                        @endif
                    </tr>
                    <!-- Modal -->
                    <div class="modal fade" id="confirmDeleteModal{{$order->id}}" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModal{{$order->id}}Label" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="confirmDeleteModal{{$order->id}}Label">Confirm Cancel Order</h5>
                                    <a type="button" class="close" style="opacity:1" data-dismiss="modal" aria-label="Close">
                                        <span style="border-radius:3px;opacity:1;" aria-hidden="true" class="bg-danger text-white p-1 pt-1 fs-5">&times;</span>
                                        </button>
                                </div>
                                <div class="modal-body">
                                    <p>Are you sure you want to cancel this order?</p>
                                </div>
                                <div class="modal-footer">
                                    <a style="color: white;" class="btn btn-secondary" data-dismiss="modal">Close</a>
                                    <a href="{{url('cancel_order',$order->id)}}" class="btn btn-danger">Cancel Order</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </table>
            </div>
        </div>

        @else
        <div class="text-center message">
            <p>No Order Yet!</p>
            <a href="/full_product" class="btn btn-danger mb-3">Continue Shoping</a>
        </div>
        @endif


        @include('home.footer')

    </div>
    <script src="{{asset('home/js/jquery-3.4.1.min.js')}}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.min.js" integrity="sha512-WW8/jxkELe2CAiE4LvQfwm1rajOS8PHasCCx+knHG0gBHt8EXxS6T6tJRTGuDQVnluuAvMxWF4j8SNFDKceLFg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    @if(Session::has('message'))
    <script>
        toastr.options = {
            "progressBar": true,
            "positionClass": "toast-top-right",
            "closeButton": true,
        }
        toastr.success("{{ Session::get('message') }}", 'Success!', {
            timeOut: 5000
        });
    </script>
    @elseif(Session::has('sellinfo'))
    <script>
        toastr.options = {
            "progressBar": true,
            "positionClass": "toast-top-right",
            "closeButton": true,
        }
        toastr.info("{{ Session::get('sellinfo') }}", 'Information!', {
            timeOut: 17000
        });
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

    <!-- popper js -->
    <script src="{{asset('home/js/popper.min.js')}}"></script>
    <!-- bootstrap js -->
    <script src="{{asset('home/js/bootstrap.js')}}"></script>
    <!-- custom js -->
    <script src="{{asset('home/js/custom.js')}}"></script>
</body>

</html>