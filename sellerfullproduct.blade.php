<!DOCTYPE html>
<html lang="en">
<!-- Basic -->

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link rel="shortcut icon" href="{{asset('images/favicon2.png')}}" type="">
    <title>Seller's Product</title>
    <link rel="stylesheet" type="text/css" href="{{asset('home/css/bootstrap.css')}}" />
    <link href="{{asset('css/font-awesome.min.css')}}" rel="stylesheet" />
    <link href="{{asset('home/css/style.css')}}" rel="stylesheet" />
    <link href="{{asset('home/css/responsive.css')}}" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        .category {
            margin-right: 12px;
            margin-bottom: 30px;
        }


        .my-button {
            box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.4);
        }

        .fa-map-marker {
            color: white;
            border: 2px solid black;
        }

        .button :hover {
            color: white;
        }

        .container .send {
            border-radius: 1px;
            color: white;
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
    <section class="product_section layout_padding">
        <div class="container">
            <div class="heading_container heading_center">
                <h2>
                    Seller's <span>products</span>
                </h2>
            </div>
            <div class="row justify-content-center">
                <form action="{{ url('search_seller_Item') }}" method="get" class="col-lg-6 col-md-8 col-sm-10">
                    @csrf
                    <div class="input-group">
                        <input type="text" name="search" class="form-control form-control-lg" placeholder="Search for products" aria-label="Search for products">

                        <div class="input-group-append">
                            <button class="btn btn-lg  bg-dark text-white" type="submit">Search</button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- @if(session('message'))
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
            @endif -->
            <div class="row">
                @foreach($product as $products)
                <div class="col-sm-6 col-md-4 col-lg-4">
                    <div class="box shadow">
                        <div class="option_container">
                            <div class="options">
                                <form action="{{route('product_detailseller')}}" method="get">
                                    @csrf
                                    <input type="hidden" name="sellid" value="{{$products->id}}">
                                    <button type="submit" class="option1 mb-3 p-2 " style="width:190px;border-radius:50px"> Product Detail</button>
                                </form>

                                <div class="row">
                                    <div class="col-md-12">
                                        <a href="#" class="btn btn-primary" style="width:100px" data-toggle="collapse" data-target="#messageInput">
                                            Message
                                        </a>
                                        <div id="messageInput" class="collapse mt-1">
                                            <form action="{{url('sendsms',$products->id)}}" method="post">
                                                @csrf
                                                <!-- <div class="row no-gutters">
                                                    <div class="col-md-8 pr-1">
                                                        <input type="text" name="message" class="form-control" style="width:200px" placeholder="Message Seller">
                                                    </div>
                                                    <div class="col-md-4 pl-1">
                                                        <button class="button btn btn-outline-primary rounded text-dark" type="submit">Send</button>
                                                    </div>
                                                </div> -->
                                                <div class="input-group">
                                                    <input type="text" name="message" class="form-control" style="width:200px" placeholder="Message Seller" required>
                                                    <div class="input-group-append">
                                                        <button type="" class="btn btn-outline-primary">Send</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <a href="#" class="btn btn-success" style="width:100px" data-toggle="collapse" data-target="#emailInput">
                                            Email
                                        </a>
                                        <div id="emailInput" class="collapse mt-1">
                                            <form action="{{url('send_seller_email',$products->id)}}" method="post">
                                                @csrf
                                                <div class="input-group">
                                                    <input type="text" name="body" class="form-control" style="width:75%" placeholder="Email Seller">
                                                    <div class="input-group-append">
                                                        <button class="btn btn-outline-success" type="submit">Send</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- </form> -->
                            </div>
                        </div>
                        <div class="img-box">
                            <img src="/custemersell/{{$products->image}}" alt="">
                        </div>
                        <div class="detail-box">
                            <h5>
                                {{$products->title}}
                            </h5>

                            <h6 style="color:blue">
                                {{$products->price}}<span style="color:orange">ETB</span>
                            </h6>

                        </div>
                    </div>
                </div>
                @endforeach

            </div>
            <span style="padding-top:20px">
                {!!$product->withQueryString()->links('pagination::bootstrap-5')!!}
            </span>
    </section>

    @include('home.footer')

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
    @elseif(Session::has('Failed'))
    <script>
        toastr.options = {
            "progressBar": true,
            "positionClass": "toast-top-right",
            "closeButton": true,
        }
        toastr.error("{{ Session::get('Failed') }}", 'Error!', {
            timeOut: 15000
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
            timeOut: 15000
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

    <script src="{{asset('home/js/popper.min.js')}}"></script>
    <!-- bootstrap js -->
    <script src="{{asset('home/js/bootstrap.js')}}"></script>
    <!-- custom js -->
    <script src="{{asset('home/js/custom.js')}}"></script>
</body>

</html>