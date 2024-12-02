<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link rel="shortcut icon" href="{{asset('images/favicon2.png')}}" type="">
    <title>Detail</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('home/css/bootstrap.css')}}" />
    <link href="{{asset('css/font-awesome.min.css')}}" rel="stylesheet" />
    <link href="{{asset('home/css/style.css')}}" rel="stylesheet" />
    <link href="{{asset('home/css/responsive.css')}}" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <style>
        .rating {
            display: inline-block;
            padding-bottom: 10px;
            font-size: 16px;
        }

        .star {
            color: black;
            display: inline-block;
            margin-right: 5px;
        }

        .yellow {
            color: #FFD700;
        }

        .black {
            color: black;
        }

        .toast-success {
            background-color: #094f07 !important;
            color: #fff !important;
            opacity: 1 !important;
        }

        .toast-error {
            background-color: #b91515 !important;
            color: #fff !important;
            opacity: 1 !important;
        }

        .toast-info {
            background-color: #0a617e !important;
            color: #fff !important;
            opacity: 1 !important;
        }
    </style>
</head>

<body>
    @include('home.header')

    <!-- <div class="hero_area">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-sm-4 col md-8 col lg-4">

                    <div class="" style="margin-top:70px;margin-bottom:10px;width:50%;padding:20px;width:400px;border:1px solid gray; box-shadow: 2px 3px 9px rgba(0, 0, 0, 0.5);">

                        @if(session('message'))
                        <div class="alert alert-success" id="flash-message" role="alert" style="text-align:center">
                            {{ session('message') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close" onclick="removeFlashMessage()">
                                <span aria-hidden="true">X</span>
                            </button>
                        </div>
                        @elseif(session('Failed'))
                        <div class="alert alert-danger" id="flash-message" role="alert" style="text-align:center">
                            {{ session('Failed')}}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close" onclick="removeFlashMessage()">
                                <span aria-hidden="true">X</span>
                            </button>
                        </div>
                        @elseif(session('Noresult'))
                        <div class="alert alert-danger" id="flash-message" role="alert" style="text-align:center">
                            {{ session('Noresult') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close" onclick="removeFlashMessage()">
                                <span aria-hidden="true">X</span>
                            </button>
                        </div>
                        @endif
                        <div class="img-box" style="padding:20px">
                            <img src="/custemersell/{{$product->image}}" alt="" style="max-width: 100%; max-height: 100%; object-fit: contain;">
                        </div>
                        <div class="detail-box ">
                            <h5>
                                {{$product->title}}
                            </h5>
                            <h6 style="color:blue" class="pb-2">
                                {{$product->price}}<span style="color:orange">ETB</span>
                            </h6>
                            <h6 style="font-style:Open Sans">Product Detail:{{$product->description}}</h6>
                            <h6 style="font-style:Roboto">Available Quantity:{{$product->quantity}}</h6>
                           
                            <h6 style="font-style:Roboto">Seller Phone:<b>{{$product->phone}}</b></h6>
                            @if($product->optional_phone)
                            <h6 style="font-style:Roboto">Seller Optinal Phone:<b>{{$product->optional_phone}}</b></h6>
                            @endif
                            <h6 style="font-style:Roboto">Uploaded on:{{$product->created_at}}</h6>
                            <div id="messageInput" class=" mt-1">
                                <form action="{{url('send_seller_email',$product->id)}}" method="post">
                                    @csrf
                                    <div class="row no-gutters">
                                        <div class="col-md-8 pr-1">
                                            <input type="text" class="form-control" name="body" style="width:100%" placeholder="Email Seller">
                                        </div>
                                        <div class="col-md-4 pl-1">
                                            <button class="button btn btn-outline-primary rounded text-dark" type="submit">Send</button>
                                        </div>
                                    </div>
                                </form>
                                <form action="{{url('sendsms',$product->id)}}" method="post">
                                    @csrf
                                    <div class="row no-gutters">
                                        <div class="col-md-8 pr-1">
                                            <input type="text" class="form-control" name="body" style="width:100%" placeholder="Message Seller">
                                        </div>
                                        <div class="col-md-4 pl-1">
                                            <button class="button btn btn-outline-success rounded text-dark" type="submit">Send</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->

    <div class="hero_area d-flex align-items-center justify-content-center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-sm-4 col-md-8 col-lg-4">
                    <div class=" justify-content-center" style="margin-top:70px;margin-bottom:10px;width:50%;padding:20px;width:400px;border:1px solid gray; box-shadow: 2px 3px 9px rgba(0, 0, 0, 0.5);">
                        <div class="img-box" style="padding:20px">
                            <img src="/custemersell/{{$product->image}}" alt="" style="max-width: 100%; max-height: 100%; object-fit: contain;">
                        </div>
                        <div class="detail-box">
                            <h5>
                                {{$product->title}}
                            </h5>
                            <h6 style="color:blue" class="pb-2">
                                {{$product->price}}<span style="color:orange">ETB</span>
                            </h6>
                            <h6 style="font-style:Open Sans">Product Detail:{{$product->description}}</h6>
                            <h6 style="font-style:Roboto">Available Quantity:{{$product->quantity}}</h6>

                            <h6 style="font-style:Roboto">Seller Phone:<b>{{$product->phone}}</b></h6>
                            @if($product->optional_phone)
                            <h6 style="font-style:Roboto">Seller Optinal Phone:<b>{{$product->optional_phone}}</b></h6>
                            @endif
                            <h6 style="font-style:Roboto">Uploaded on:{{$product->created_at}}</h6>

                            <div class="text-md-center d-flex justify-content-center">
                                <div class="d-flex flex-md-row align-items-center mt-3">
                                    <form action="{{url('send_seller_email',$product->id)}}" method="post">
                                        @csrf
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="body" style="width:250px; height: 48px" placeholder="Email Seller" required>
                                            <div class="input-group-append">
                                                <button class="button btn btn-outline-primary  " type="submit">Send</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <div class="text-md-center d-flex justify-content-center">
                                <div class="d-flex flex-md-row align-items-center mt-3">
                                    <form action="{{url('sendsms',$product->id)}}" method="post">
                                        @csrf
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="body" style="width:250px; height: 48px" placeholder="Message Seller" required>
                                            <div class="input-group-append">
                                                <button class="button btn btn-outline-success" type="submit">Send</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('home.footer')
    <!-- footer end -->
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
        toastr.success("{{ Session::get('success') }}", 'Success!', {
            timeOut: 5000
        });
    </script>
    @elseif(Session::has('failed'))
    <script>
        toastr.options = {
            "progressBar": true,
            "positionClass": "toast-top-right",
            "closeButton": true,
        }
        toastr.error("{{ Session::get('failed') }}", 'Error!', {
            timeOut: 15000
        });
    </script>
    @elseif(Session::has('info'))
    <script>
        toastr.options = {
            "progressBar": true,
            "positionClass": "toast-top-right",
            "closeButton": true,
        }
        toastr.info("{{ Session::get('info') }}", 'Information!', {
            timeOut: 15000
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
    @elseif(Session::has('message'))
    <script>
        toastr.options = {
            "progressBar": true,
            "positionClass": "toast-top-right",
            "closeButton": true,
        }
        toastr.success("{{ Session::get('message') }}", 'Success!', {
            timeOut: 17000
        });
    </script>
    @elseif(Session::has('Failed'))
    <script>
        toastr.options = {
            "progressBar": true,
            "positionClass": "toast-top-right",
            "closeButton": true,
        }
        toastr.error("{{ Session::get('Failed') }}", 'Error!!', {
            timeOut: 17000
        });
    </script>
    @elseif(Session::has('Noresult'))
    <script>
        toastr.options = {
            "progressBar": true,
            "positionClass": "toast-top-right",
            "closeButton": true,
        }
        toastr.info("{{ Session::get('Noresult') }}", 'Information!', {
            timeOut: 17000
        });
    </script>
    @endif
    <!-- jQery -->
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