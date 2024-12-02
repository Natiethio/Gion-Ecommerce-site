<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Site Metas -->
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Check out</title>
    <link rel="shortcut icon" href="{{asset('images/favicon2.png')}}" type="">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="{{asset('css/font-awesome.min.css')}}" rel="stylesheet" />
    <link href="{{asset('home/css/style.css')}}" rel="stylesheet" />
    <link href="{{asset('home/css/responsive.css')}}" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('home/css/main.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
   <style>
    .span {
      color: red;
      margin-top: 10px;
    }
   </style>
    
</head>

<body>
    @include('home.header')
    <main class="main">
        <section class="mt-50 mb-50">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="divider mt-50 mb-50"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-25">
                            <h3 class="fs-4 fw-bold">Shipping Details</h3>
                        </div>
                        <form action="{{route('shipping')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <input type="text"  name="fname" placeholder="First name *" required>
                                <span class="span">@error('fname'){{$message}}@enderror</span>
                            </div>
                            <div class="form-group">
                                <input type="text" required="" name="lname" placeholder="Last name *">
                                <span class="span">@error('lname'){{$message}}@enderror</span>
                            </div>
                            <div class="form-group">
                                <input required="" type="number" name="phone" placeholder="Phone *">
                                <span class="span">@error('phone'){{$message}}@enderror</span>
                            </div>
                            <div class="form-group">
                                <input  type="number" name="phone2" placeholder="Phone2 (Optinal)">
                                <span class="span">@error('phone2'){{$message}}@enderror</span>
                            </div>
                            <div class="form-group">
                                <input required="" type="email" name="email" placeholder="Email address *">
                                <span class="span">@error('email'){{$message}}@enderror</span>
                            </div>
                            <div class="form-group">
                                <div class="custom_select">
                                    <select class="form-control select-active" name="city">
                                        <option value="">Select city...</option>
                                        <option value="Adama">Adama</option>
                                        <option value="Addis Abeba">Addis Abeba</option>
                                        <option value="Bahirdar">Bahirdar</option>
                                        <option value="Dessie">Dessie</option>
                                        <option value="Dire Dawa">Dire Dawa</option>
                                        <option value="Gondar">Gondar</option>
                                        <option value="Hawassa">Hawassa</option>
                                        <option value="Harer">Harer</option>
                                        <option value="Jigjiga">Jigjiga</option>
                                        <option value="Mekele">Mekele</option>
                                    </select>
                                    <span class="span">@error('city'){{$message}}@enderror</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <input required="" type="text" name="town" placeholder="Sub City / Town *">
                                <span class="span">@error('town'){{$message}}@enderror</span>
                            </div>
                            <div class="form-group">
                                <input required="" type="text" name="kebwor" placeholder="Kebele / Woreda *">
                                <span class="span">@error('kebwor'){{$message}}@enderror</span>
                            </div>
                            <div class="form-group">
                                <input type="text" name="pobox" placeholder="Postcode / ZIP (Optinal)">
                                <span class="span">@error('pobox'){{$message}}@enderror</span>
                            </div>
                            <div class="mb-20">
                                <h5>Additional Address Information</h5>
                            </div>
                            <div class="form-group mb-30">
                                <textarea rows="3" name="Addaddress" required="" placeholder="Please describe your address specifically"></textarea>
                                <span class="span">@error('Addaddress'){{$message}}@enderror</span>
                            </div>
                            <div class="payment_method">
                                <div class="mb-25">
                                    <h5>Payment</h5>
                                </div>
                                <div class="payment_option">
                                    <div class="custome-radio">
                                        <input class="form-check-input" required="" type="radio" name="payment_option" value="Cash on delivery" id="exampleRadios3">
                                        <label class="form-check-label" for="exampleRadios3" data-bs-toggle="collapse" data-target="#cashOnDelivery" aria-controls="cashOnDelivery">Cash On Delivery</label>
                                        <span class="span">@error('payment_option'){{$message}}@enderror</span>
                                    </div>
                                    <div class="custome-radio">
                                        <input class="form-check-input" required="" type="radio" name="payment_option" value="Card Payment" id="exampleRadios4">
                                        <label class="form-check-label" for="exampleRadios4" data-bs-toggle="collapse" data-target="#cardPayment" aria-controls="cardPayment">Card Payment</label>
                                        <span class="span">@error('payment_option'){{$message}}@enderror</span>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden"  name="total" placeholder="total" value="{{$total}}">
                            <button type="submit" class="btn btn-danger bg-danger text-white">Place Order</button>
                        </form>
                    </div>
                    <div class="col-md-6">
                        <div class="order_review">
                            <div class="mb-20">
                                <h4 class="fs-4 fw-bold">Your Orders</h4>
                            </div>
                            <div class="table-responsive order_table text-center">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th colspan="2">Product</th>
                                            <th>Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($carts as $cart)
                                          <tr>
                                            <td class="image product-thumbnail"><img src="{{asset('product/'.$cart->image)}}" alt="#"></td>
                                            <td>
                                                <h5><a href="product-details.html">{{$cart->product_title}}</a></h5> <span class="product-qty">x {{$cart->quantity}}</span>
                                            </td>
                                            <td>{{$cart->price}}</td>
                                          </tr>
                                        @endforeach
                                        
                                        <tr>
                                            <th>SubTotal</th>
                                            <td class="product-subtotal" colspan="2">{{$total}}<span class="text-warning">ETB</span></td>
                                        </tr>
                                        <tr>
                                            <th>Shipping</th>
                                            <td colspan="2"><em>Free Shipping</em></td>
                                        </tr>
                                        <tr>
                                            <th>Total</th>
                                            <td colspan="2" class="product-subtotal"><span class="font-xl text-brand fw-900">{{$total}}</span><span class="text-warning">ETB</span></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="bt-1 border-color-1 mt-30 mb-30"></div>

                            <!-- <a href="#" class="btn btn-fill-out btn-block mt-30">Place Order</a> -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>




    @include('home.footer')
    <!-- footer end -->

    <!-- jQery -->
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