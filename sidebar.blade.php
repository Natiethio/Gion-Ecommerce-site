<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>


</head>


<body>
    <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <div class="sidebar-brand-wrapper d-flex align-items-center justify-content-center fixed-top">
            <a class="sidebar-brand brand-logo" href="/redirect"><img src="{{asset('images/logoadmin.png')}}" alt="logos" /></a>
            <a class="sidebar-brand brand-logo-mini" href="/redirect"></a>
            <button class="navbar-toggler d-lg-none" type="button" data-bs-tggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
        <div class="sidebar-body">
            <ul class="nav">
                <li class="nav-item profile">
                    <div class="profile-desc">
                        <div class="profile-pic">
                            <div class="count-indicator">
                                <img class="img-xs rounded-circle " src="/product/avatar3.png" alt="">
                                <span class="count bg-success"></span>
                            </div>
                            <div class="profile-name">
                                <h5 class="mb-0 font-weight-normal">admin</h5>
                                <span>Member</span>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="nav-item nav-category">
                    <span class="nav-link">Navigation</span>
                </li>
                <li class="nav-item menu-items">
                    <a class="nav-link" href="{{url('/redirect')}}">
                        <span class="menu-icon">
                            <i class="mdi mdi-speedometer"></i>
                        </span>
                        <span class="menu-title">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item menu-items">
                    <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                        <span class="menu-icon">
                            <i class="mdi mdi-laptop"></i>
                        </span>
                        <span class="menu-title">Products</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="collapse" id="ui-basic">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item"> <a class="nav-link" href="{{url('/view_product')}}">Add Products</a></li>
                            <li class="nav-item"> <a class="nav-link" href="{{url('/show_product')}}">Show Product</a></li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item menu-items">
                    <a class="nav-link" href="{{url('view_customer')}}">
                        <span class="menu-icon">
                            <i class="mdi mdi-watch"></i>
                        </span>
                        <span class="menu-title">Seller Item's</span>
                    </a>
                </li>
                <li class="nav-item menu-items">
                    <a class="nav-link" href="{{url('view_catagory')}}">
                        <span class="menu-icon">
                            <i class="mdi mdi-playlist-play"></i>
                        </span>
                        <span class="menu-title">Category</span>
                    </a>
                </li>
                <li class="nav-item menu-items">
                    <a class="nav-link" href="{{url('order')}}">
                        <span class="menu-icon">
                            <i class="mdi mdi-format-list-numbered icon-item"></i>
                        </span>
                        <span class="menu-title">Order</span>
                    </a>
                </li>
                <li class="nav-item menu-items">
                    <a class="nav-link" href="{{url('shippingadmin')}}">
                        <span class="menu-icon">
                            <i class="mdi mdi-car"></i>
                        </span>
                        <span class="menu-title">Shipping</span>
                    </a>
                </li>
                <li class="nav-item menu-items">
                    <a class="nav-link" href="{{url('normalusers')}}">
                        <span class="menu-icon">
                        <i class="mdi mdi-account"></i>
                        </span>
                        <span class="menu-title">Users</span>
                    </a>
                </li>
                <li class="nav-item menu-items">
                    <a class="nav-link" href="{{url('comment')}}">
                        <span class="menu-icon">
                            <i class="mdi mdi-comment-text-outline icon-item"></i>
                        </span>
                        <span class="menu-title">Comment</span>
                    </a>
                </li>
            </ul>
        </div>
    </nav>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-hfvrc5mWwXW+lYbOg5L4TM+UeX6NwvW9cY8W+AQ9VfCn+2zV9n5jGMAJw34l1+7rVQsJng6d3Q5pP2e6t/P6xg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/js/bootstrap.bundle.min.js" integrity="sha512-vZ8lV4/4Dn9ZzKmP6XbXbBpf8T/8CpBqRzCOdcvGxM5U7Pr5gV7mFZ4aQvmJiGz/9oTK4FwqWQ7O9u1kSOjwPg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>

</html>