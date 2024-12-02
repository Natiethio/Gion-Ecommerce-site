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
  <title>Contacts</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.6/dist/sweetalert2.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" integrity="sha512-b2QcS5SsA8tZodcDtGRELiGv5SaKSk1vDHDaQRda0htPYWZ6046lr3kJ5bAAQdpV2mmA/4v0wQF9MyU6/pDIAg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" type="text/css" href="{{asset('home/css/bootstrap.css')}}" /><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link href="{{asset('css/font-awesome.min.css')}}" rel="stylesheet" />
  <link href="{{asset('home/css/style.css')}}" rel="stylesheet" />
  <link href="{{asset('home/css/contact.css')}}" rel="stylesheet" />
  <link href="{{asset('home/css/responsive.css')}}" rel="stylesheet" />
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
    </style>
</head>

<body>
    <!-- Navigation -->
    @include('home.header')
    <section class='c-wrapper' style="margin-top:30px">
        <div class="paddings innerWidth flexCenter c-container">

            <div class="flexColStart c-left">
                <span class='orangeText'>Our contacts</span>
                <span class='primaryText'>Please Contact Us On</span>
                <span class='secondaryText2'>For any services and suggestion don't hesitate to
                    contact <br>us by the following platforms we are always standby to <br>serve you.</span>
                <div class="flexColStart contactModes">

                    <div class="flexStart row2">
                        <div class="flexColCenter mode">
                            <div class="flexStart">
                                <div class="flexCenter icon">
                                    <div class="d-flex justify-content-center align-items-center bg-light rounded-circle" style="width: 50px; height: 50px;">
                                        <i class="fa fa-phone text-danger" style="font-size: 30px;"></i>
                                    </div>
                                </div>
                                <div class="flexColStart detail">
                                    <span class='primaryText'>Call</span>
                                    <span class='secondaryText'>09-70-94-18-09</span>
                                </div>
                            </div>
                            <button type='button' class=" button">
                                Call Now
                            </button>
                        </div>


                        <div class="flexColCenter mode">
                            <div class="flexStart">
                                <div class="flexCenter icon">
                                <div class="d-flex justify-content-center align-items-center bg-light rounded-circle" style="width: 50px; height: 50px;">
                                        <i class="fa fa-instagram text-danger" style="font-size: 30px;"></i>
                                    </div>
                                </div>
                                <div class="flexColStart detail">
                                    <span class='primaryText'>Instagram</span>
                                    <span class='secondaryText'>09-70-94-18-09</span>
                                </div>
                            </div>
                            <div class=" button">
                                Chat Now
                            </div>
                        </div>
                    </div>

                    <div class="flexStart row2 ">
                        <div class="flexColCenter mode">
                            <div class="flexStart">
                                <div class="flexCenter icon">
                                <div class="d-flex justify-content-center align-items-center bg-light rounded-circle" style="width: 50px; height: 50px;">
                                        <i class="fa fa-facebook-square text-danger" style="font-size: 30px;"></i>
                                    </div>
                                </div>
                                <div class="flexColStart detail">
                                    <span class='primaryText'>Facebook</span>
                                    <span class='secondaryText'>09-70-94-18-09</span>
                                </div>
                            </div>
                            <button type='button ' class="button">
                                Chat Now
                            </button>
                        </div>


                        <div class="flexColCenter mode">
                            <div class="flexStart">
                                <div class="flexCenter icon">
                                <div class="d-flex justify-content-center align-items-center bg-light rounded-circle" style="width: 50px; height: 50px;">
                                        <i class="fa fa-twitter text-danger" style="font-size: 30px;"></i>
                                    </div>
                                </div>
                                <div class="flexColStart detail">
                                    <span class='primaryText'>Twitter</span>
                                    <span class='secondaryText'>09-70-94-18-09</span>
                                </div>
                            </div>
                            <button type='button' class=" button">
                                Twitt Now
                            </button>
                        </div>
                    </div>
                    <div class="flexStart row2 ">
                        <div class="flexColCenter mode">
                            <div class="flexStart">
                                <div class="flexCenter icon">
                                <div class="d-flex justify-content-center align-items-center bg-light rounded-circle" style="width: 50px; height: 50px;">
                                        <i class="fa fa-video-camera text-danger" style="font-size: 30px;"></i>
                                    </div>
                                </div>
                                <div class="flexColStart detail">
                                    <span class='primaryText'>Video Call</span>
                                    <span class='secondaryText'>09-70-94-18-09</span>
                                </div>
                            </div>
                            <button type='button ' class=" button">
                                Video Call Now
                            </button>
                        </div>


                        <div class="flexColCenter mode">
                            <div class="flexStart">
                                <div class="flexCenter icon">
                                <div class="d-flex justify-content-center align-items-center bg-light rounded-circle" style="width: 50px; height: 50px;">
                                        <i class="fa fa-commenting text-danger" style="font-size: 30px;"></i>
                                    </div>
                                </div>
                                <div class="flexColStart detail">
                                    <span class='primaryText'>Message</span>
                                    <span class='secondaryText'>09-70-94-18-09</span>
                                </div>
                            </div>
                            <button type='button' class=" button">
                                Message Now
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Right side -->
            <div class=" paddings2 c-right" style="padding-top:10px">
                <div class="image-container">
                    <img src="{{asset('images/contact121.png')}}" class="" alt="none" style=""/>
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
        toastr.info("{{ Session::get('info') }}", 'information!', {
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