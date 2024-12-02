<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link rel="shortcut icon" href="{{asset('images/favicon2.png')}}" type="">
    <title>About</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.6/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" integrity="sha512-b2QcS5SsA8tZodcDtGRELiGv5SaKSk1vDHDaQRda0htPYWZ6046lr3kJ5bAAQdpV2mmA/4v0wQF9MyU6/pDIAg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" type="text/css" href="{{asset('home/css/bootstrap.css')}}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="{{asset('css/font-awesome.min.css')}}" rel="stylesheet" />
    <link href="{{asset('home/css/style.css')}}" rel="stylesheet" />
    <link href="{{asset('home/css/responsive.css')}}" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <style>
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
     .cardheight {
        height: 100%;
    }
    </style>
</head>

<body>
    <!-- Navigation -->
    @include('home.header')
    <!-- Hero Section -->
    <section class="hero bg-danger text-white text-center py-5" style="margin-top:40px">
        <div class="container">
            <h1 class="fs-5" style="font-size:20px">Welcome to Gion Ecommerse</h1>
            <p class="lead">Discover amazing products at affordable prices.</p>
            <a href="/full_product" class="btn btn-light btn-lg">Shop Now</a>
        </div>
    </section>

    <!-- Vision Section -->
    <section class="vision py-5">
        <div class="container text-center shadow py-4">
            <h2 class="pb-3" style="font-size:25px;font-style:bold"><i style="font-size:25px" class="fas fa-eye"></i> Our Vision</h2>
            <p> Transforming the online shopping experience, we envision becoming the
                ultimate destination for customers seeking a diverse range of high-quality
                products. With a commitment to exceptional service, We strive to make a positive
                impact by supporting local businesses and user by linking a seller to buyer, promoting sustainability, and giving back
                to our community. Embracing innovation, Join us as we redefine E-Commerce,
                unlocking endless possibilities for our customers.</p>
        </div>
    </section>

    <!-- Mission Section -->
    <section class="mission py-5">
        <div class="container text-center  shadow py-4">
            <h2 style="font-size:25px;font-style:bold" class="pb-3"><i class="fas fa-bullseye"></i> Our Mission</h2>
            <p> 
                Our mission is to make a positive impact while delivering convenience, trust, and fostering 
                long term relationships with our customers. We are dedicated to providing a seamless online shopping experience, 
                offering a diverse range of high quality products that cater to our customers' needs. 
                Committed to sustainability, we source from ethically conscious suppliers and promote responsible consumption. 
            </p>
        </div>
    </section>
    @include('home.why')
    <!-- Featured Products Section -->

    <section class="featured-products py-5">
    <div class="container">
        <h2 class="text-center mb-4" style="font-size:30px;font-weight:bold">Featured Products</h2>
        <div id="productCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3500">
            <div class="carousel-inner">
                @foreach($product->chunk(4) as $chunk)
                <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                    <div class="row">
                        @foreach($chunk as $prod)
                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <div class="card h-100">
                                <img src="/product/{{ $prod->image }}" style="max-width: 100%; height: 300px; object-fit: contain;" class="card-img-top pt-2" alt="Product">
                                <div class="card-body d-flex flex-column items-center">
                                    <h5 class="card-title">{{ $prod->title }}</h5>
                                    <p class="card-text flex-grow-1">{{ $prod->description }}</p>
                                    <form action="{{ route('product_detail') }}" method="get" class="mt-auto">
                                        @csrf
                                        <input type="hidden" name="productId" value="{{ $prod->id }}" />
                                        <button type="submit" class="btn btn-primary bg-primary text-white">Buy Now</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>



    <!-- Footer -->
    @include('home.footer')

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
            timeOut: 8000
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
            timeOut: 20000
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
            timeOut: 8000
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