<!DOCTYPE html>
<html>

<head>
    <!-- Basic -->
    <!-- <base href="/public"> -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link rel="shortcut icon" href="{{asset('images/favicon2.png')}}" type="">
    <title>Payment</title>
    <link rel="stylesheet" type="text/css" href="{{asset('home/css/bootstrap.css')}}" />
    <link href="{{asset('css/font-awesome.min.css')}}" rel="stylesheet" />
    <link href="{{asset('home/css/style.css')}}" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <style>
        .toast-success {
            background-color: #094f07 !important;
            color: #fff !important;
        }

        .toast-error {
            background-color: #b91515 !important;
            color: #fff !important;
        }

        .toast-info {
            background-color: #0a617e !important;
            color: #fff !important;
        }

        .hero_area {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .hero_area .row {
            justify-content: center;
        }

        @media(max-width: 991px) {
            .new {
                margin-bottom: 25px;
                margin-left: 105px;
            }

            .hero_area .row {
                align-content: center;
            }
        }

        @media(min-width: 992px) {
            .hero_area .container {
                display: flex;
                flex-direction: column;
                align-items: stretch;
            }
        }
    </style>
   
</head>
<body>
    <div class="hero_area">
        @include('home.header')
        <div class="heading_container heading_center head" style="margin-top:-150px;margin-bottom:30px">
            <h2 class="des">Payment <span style=" color:#fb4b57">Options</span></h2>
        </div>
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-lg-2">
                    <form action="{{route('chapa')}}" method="get">
                        @csrf
                        <input type="hidden" name="total" value="{{$total}}">
                        <input type="hidden" name="shipid" value="{{$shipid}}">
                        <button type="submit" class="card shadow new" style="width: 150px; height: 100px; display: flex; align-items: center; justify-content: center;">
                            <img src="{{asset('images/chapa_logo.png')}}" alt="Chapa Logo" style="max-width: 100%; max-height: 100%; object-fit: contain;">
                        </button>
                    </form>
                    <!-- <a href="{{ url('chapa', $total)}}" class="card shadow new" style="width: 150px; height: 100px; display: flex; align-items: center; justify-content: center;">
                        <img src="{{asset('images/chapa_logo.png')}}" alt="Chapa Logo" style="max-width: 100%; max-height: 100%; object-fit: contain;">
                    </a> -->
                </div>
                <div class="col-lg-2">
                    <form action="{{route('stripe')}}" method="get">
                        @csrf
                        <input type="hidden" name="total" value="{{$total}}">
                        <input type="hidden" name="shipid" value="{{$shipid}}">
                        <button type="submit" class="card shadow new" style="width: 150px; height: 100px; display: flex; align-items: center; justify-content: center;">
                            <img src="{{asset('images/stripe_logo.png')}}" alt="Stripe Logo" style="max-width: 100%; max-height: 100%; object-fit: contain;">
                        </button>
                    </form>
                    <!-- <a href="{{ url('stripe',$total)}}" class="card shadow new" style="width: 150px; height: 100px; display: flex; align-items: center; justify-content: center;">
                        <img src="{{asset('images/stripe_logo.png')}}" alt="Chapa Logo" style="max-width: 100%; max-height: 100%; object-fit: contain;">
                    </a> -->
                </div>
            </div>
        </div>
    </div>
    <div style="margin-top:-150px">
        @include('home.footer')
    </div>

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
    @endif
    <!-- popper js -->
    <script src="{{asset('home/js/popper.min.js')}}"></script>
    <!-- bootstrap js -->
    <script src="{{asset('home/js/bootstrap.js')}}"></script>
    <!-- custom js -->
    <script src="{{asset('home/js/custom.js')}}"></script>
</body>

</html>