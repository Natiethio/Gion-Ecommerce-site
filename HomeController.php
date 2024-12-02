<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Cart;
use App\Models\Catagory;
use App\Models\Comment;
use App\Models\Order;
use App\Models\Customersell;
use App\Models\Shipping;
use App\Models\Wishlist;
use Illuminate\Support\Facades\DB;
use App\Notifications\EmailSeller;
use Exception;
use App\Notifications\SendEmailNotification;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Session;
use Stripe;
use App\Notifications\SendTicketNumber;
use Carbon\Carbon;
use Stripe\Exception\ApiConnectionException;
use Stripe\Exception\CardException;
use PDF;

class HomeController extends Controller
{

  public function index()
  {
    $product = Product::where('product_status', 'New')->where('quantity', '>', 0)->paginate(9);
    $featuredpro = Product::where('featured', 'yes')->get();
    return view('home.userpage', compact('product', 'featuredpro'));
  }

  public function redirect()
  {
    $usertype = Auth::user()->usertype; //Auth method  easy way to autenticate user and manage the session 'user()' method return the currently autenticated user
    $name = Auth::user()->name;
    $user = Auth::user();
    if ($usertype == '1') {

      $currentYear = date('Y');
      $previousYear = $currentYear - 1;
      $twoYearsAgo = $currentYear - 2;
      $fiftenYearsAgo =  $currentYear - 15;

      $revenues = Order::selectRaw('SUM(price) as revenue, YEAR(created_at) as year, MONTH(created_at) as month')
        ->where('payment_status', 'Paid')
        ->whereYear('created_at', '>=', $twoYearsAgo)
        ->groupBy('year', 'month')
        ->get();

      $revenueData = [];
      $monthLabels = [];
      $yearLabels = [];
      // Loop through the revenue data and extract the revenue and month labels
      foreach ($revenues as $revenue) {
        $revenueData[] = $revenue->revenue;
        $monthLabels[] = date('F', mktime(0, 0, 0, $revenue->month, 1,));
        $yearLabels[] = date('Y', mktime(0, 0, 0, 1, 1, $revenue->year));
      }

      $revenuesyear = Order::selectRaw('SUM(price) as revenue, YEAR(created_at) as year')
        ->where('payment_status', 'Paid')
        ->whereYear('created_at', '>=', $fiftenYearsAgo)
        ->groupBy('year')
        ->get();

      $revenueDatayear = [];
      $yearLabelsyear = [];

      foreach ($revenuesyear as $revenueyear) {
        $revenueDatayear[] = $revenueyear->revenue;
        $yearLabelsyear[] = $revenueyear->year;
      }
      $orderItems = Order::select('product_id', 'product_title', 'eachquantity')
        ->where('payment_status', 'Paid')
        ->get();

      $quantityData = [];
      $productTitles = [];

      foreach ($orderItems as $item) {
        $productIds = explode(',', $item->product_id);
        $productTitles = explode(',', $item->product_title);
        $quantities = explode(',', $item->eachquantity);

        foreach ($productIds as $key => $productId) {
          $quantity = (int)$quantities[$key];

          $productKey = $productId . '_' . $productTitles[$key];

          if (!isset($quantityData[$productKey])) {
            $quantityData[$productKey] = $quantity;
          } else {
            $quantityData[$productKey] += $quantity;
          }

          if (!in_array($productTitles[$key], $productTitles)) {
            $productTitles[] = $productTitles[$key];
          }
        }
      }

      $orderedQuantities = array_values($quantityData);
      $productTitles = array_values($productTitles);

      $categoryCounts = Product::select('category', DB::raw('SUM(quantity) as total_quantity'))
        ->groupBy('category')
        ->get();

      $categoryPercentages = [];
      $categoryNames = [];

      $totalQuantity = $categoryCounts->sum('total_quantity');

      foreach ($categoryCounts as $categoryCount) {
        $categoryName = $categoryCount->category;
        $quantity = $categoryCount->total_quantity;

        $percentage = ($quantity / $totalQuantity) * 100;

        $categoryPercentages[] = $percentage;
        $categoryNames[] = $categoryName;
      }
      $products = Product::select('title', 'orderQuantity')
        ->get();

      $producteachTitles = $products->pluck('title')->toArray();
      $quantitieseach = $products->pluck('orderQuantity')->toArray();

      $product = Product::count();
      $order = Order::count();
      $customer = User::where('usertype', '0')->count();
      $admin = User::where('usertype', '1')->count();
      $revenue = Order::where('payment_status', 'Paid')->sum('price');
      $deliverd = Order::where('delivery_status', 'Delivered')->count();
      $comment = Comment::count();
      $processing = Order::where('delivery_status', 'Pending')
        ->orWhere('delivery_status', 'Processing')
        ->count();

      return view('admin.home', compact(
        'product',
        'order',
        'customer',
        'admin',
        'revenue',
        'deliverd',
        'processing',
        'comment',
        'revenueData',
        'monthLabels',
        'yearLabels',
        'currentYear',
        'previousYear',
        'revenueDatayear',
        'yearLabelsyear',
        'orderedQuantities',
        'productTitles',
        'categoryPercentages',
        'categoryNames',
        'producteachTitles',
        'quantitieseach'
      ));
    } else {
      $product = Product::where('quantity', '>', 0)->where('product_status', 'New')->paginate(9);
      $productfeatured = Product::where('featured', 'yes')->get();
      return view('home.userpage', ['product' => $product, 'featuredpro' => $productfeatured]);
    }
  }

  public function red()
  {
    return view('red');
  }

  public function full_product()
  {
    $product = Product::where('quantity', '>', 0)->paginate(9);
    $category = Catagory::orderBy('catagory_name', 'asc')->get();
    return view('home.fullproduct', ['product' => $product, 'category' => $category]);
  }

  public function seller_items()
  {
    if (Auth::user()) {
      $user = Auth::user();
      if ($user->address == null && $user->address == null) {
        return redirect('newl')->with('message', 'Let Us Finish Your Set Up First!!');
      } else {
        $currentUserId = Auth::id();
        $product = Customersell::where('quantity', '>', 0)
          ->where('verification', 'Verified')
          ->whereNotIn('user_id', [$currentUserId])
          ->paginate(9);
        $category = Catagory::all();
        return view('home.sellerfullproduct', ['product' => $product, 'category' => $category]);
      }
    } else {
      return redirect('login');
    }
  }

  public function category($name)
  {
    $product = Product::where('category', $name)->where('quantity', '>', 0)->paginate(9);
    $category = Catagory::all();
    return view('home.fullproduct', ['product' => $product, 'category' => $category]);
  }

  public function search_product(Request $req)
  {
    $category = Catagory::all();
    $searchtext = $req->search;
    $product = Product::where('title', 'LIKE', "%$searchtext%")
      ->orWhere('product_status', 'LIKE', "%$searchtext%")
      ->orWhere('category', 'LIKE', "$searchtext")
      ->orWhere('quantity', 'LIKE', "%$searchtext%")
      ->orWhere('price', 'LIKE', "%$searchtext%")
      ->orWhere('discount_price', 'LIKE', "%$searchtext%")->paginate(9);

    return view('home.fullproduct', ['product' => $product, 'category' => $category]);
  }

  public function search_seller_Item(Request $req)
  {
    $category = Catagory::all();
    $searchtext = $req->search;
    if ($searchtext) {
      $product = Customersell::where('title', 'LIKE', "%$searchtext%")
        ->orWhere('name', 'LIKE', "%$searchtext%")
        ->orWhere('title', 'LIKE', "%$searchtext%")
        ->orWhere('status', 'LIKE', "%$searchtext%")
        ->orWhere('category', 'LIKE', "$searchtext")
        ->orWhere('quantity', 'LIKE', "%$searchtext%")
        ->orWhere('price', 'LIKE', "%$searchtext%")->paginate(9);
      return view('home.sellerfullproduct', ['product' => $product, 'category' => $category]);
    } else {
      return redirect()->back()->with('Noresult', 'No Input Detected!!');
    }
  }

  public function product_details(Request $req)
  {
    $id = $req->productId;
    $product = Product::find($id);

    if ($product->orderQuantity > 35) {
      $star = 5;
    } else if ($product->orderQuantity <= 35 && $product->orderQuantity > 15) {
      $star = 4;
    } else if ($product->orderQuantity <= 15 && $product->orderQuantity > 5) {
      $star = 3;
    } else if ($product->orderQuantity <= 5 && $product->orderQuantity > 3) {
      $star = 2;
    } else if ($product->orderQuantity <= 3 && $product->orderQuantity > 1) {
      $star = 1;
    } else {
      $star = 0;
    }
    return view('home.product_details', ['product' => $product, 'star' => $star]);
  }

  public function product_detail($productId)
  {

    $id = $productId;
    $product = Product::find($id);
    return view('home.product_details', ['product' => $product]);
  }

  public function product_detailseller(Request $req)
  {

    $id = $req->sellid;
    $product = Customersell::find($id);
    return view('home.product_detailseller', ['product' => $product]);
  }

  public function store(Request $req)
  {

    $category = $req->productcategory;
    $product = Product::where('quantity', '>', 0)->where('category', $category)->get();
    return view('home.store', compact('product'));
  }

  public function add_cart(Request $req)
  {
    if (Auth::id()) {
      $id = $req->productsId;
      $user = Auth::user();
      if ($user->address == null && $user->address == null) {
        return redirect('newl')->with('message', 'Let Us Finish Your Set Up First!!');
      } else {
        $product = Product::find($id);
        if ($product->quantity < $req->quantity) {
          return redirect('/#product')->with('failed', "Sorry  We Dont Have Such Quantity For This Product in Our Store We only left {$product->quantity}. Please Visit us  Next Time!!");
        } else {
          $product_exist_id = Cart::where('product_id', $id)->where('user_id', $user->id)->get('id')->first();
          if ($product_exist_id != null) {
            $cartadd = Cart::find($product_exist_id)->first();
            $cartadd->quantity = $cartadd->quantity + $req->quantity;
            $quantity = $cartadd->quantity;
            if ($product->discount_price != null) {
              $cartadd->price = $product->discount_price * $quantity;
            } else {
              $cartadd->price = $product->price * $quantity;
            }
            $product->quantity = $product->quantity - $req->quantity; //inventary
            $cartadd->save();
            $product->save();
            return redirect('/#product')->with('success', 'Product Added To Cart Successfully');
          } else {
            $cart = new Cart();
            $cart->name = $user->name; //save name of the spacific user
            $cart->email = $user->email;
            $cart->phone = $user->phone;
            $cart->address = $user->address;
            $cart->user_id = $user->id;
            $cart->product_title = $product->title;
            $discount = $product->discount_price;
            if ($discount) {
              $cart->price = $product->discount_price * $req->quantity;
            } else {
              $cart->price = $product->price * $req->quantity;
            }
            $cart->quantity = $req->quantity;
            $cart->image = $product->image;
            $cart->product_id = $product->id;
            // $product->quantity = $product->quantity - $req->quantity; //inventary   nati
            // $product->save();
            $cart->save();
            return redirect('/#product')->with('success', 'Product Added To Cart Successfully');
          }
        }
      }
    } else {
      return redirect('login'); //path is creatd by laravel jetstream by default
    }
  }

  public function add_cartfull(Request $req)
  {
    if (Auth::id()) { // Auth::id() check if user logged in or not if user logged in
      $user = Auth::user(); //get all data af the logged in user
      if ($user->address == null && $user->address == null) {
        return redirect('newl')->with('message', 'Let Us Finish Your Set Up First!!');
      } else {
        $product = Product::find($req->productsId);
        if ($product->quantity < $req->quantity) {
          return redirect()->back()->with('failed', "Sorry  We Dont Have Such Quantity For This Product in Our Store We only left {$product->quantity}. Please Visit us  Next Time!!");
        } else {
          //if user already add the product previouslly and want to add it again it will update it not add it again
          $product_exist_id = Cart::where('product_id', $req->productsId)->where('user_id', $user->id)->get('id')->first();
          if ($product_exist_id != null) {
            $cartadd = Cart::find($product_exist_id)->first();
            $cartadd->quantity = $cartadd->quantity + $req->quantity;
            $quantity = $cartadd->quantity;
            if ($product->discount_price != null) {
              $cartadd->price = $product->discount_price * $quantity;
            } else {
              $cartadd->price = $product->price * $quantity;
            }
            // $product->quantity = $product->quantity - $req->quantity; //inventary nati
            $cartadd->save();
            // $product->save();
            return redirect()->back()->with('success', 'Product added to cart successfully');
          } else {
            $cart = new Cart();
            $cart->name = $user->name; //save name of the spacific user
            $cart->email = $user->email;
            $cart->phone = $user->phone;
            $cart->address = $user->address;
            $cart->user_id = $user->id;
            $cart->product_title = $product->title;
            $discount = $product->discount_price;
            if ($discount) {
              $cart->price = $product->discount_price * $req->quantity;
            } else {
              $cart->price = $product->price * $req->quantity;
            }
            $cart->quantity = $req->quantity;
            $cart->image = $product->image;
            $cart->product_id = $product->id;
            // $product->quantity = $product->quantity - $req->quantity; //inventary nati
            // $product->save();
            $cart->save();
            return redirect()->back()->with('success', 'Product added to cart successfully!!');
          }
        }
      }
    } else {
      return redirect('login'); //path is creatd by laravel jetstream by default
    }
  }

  public function show_wishlist()
  {

    Wishlist::where('deleted_at', '<', today())->forceDelete();

    $user = Auth::user();

    $wishlist = Wishlist::where('user_id', $user->id)->get();

    if ($wishlist->isEmpty()) {
      return view('home.wishlist', ['messagen' => 'Your Wish List is empty!']);
    } else {
      return view('home.wishlist', compact('wishlist'));
    }
  }

  public function add_wishlistfull(Request $req)
  {
    $id = $req->productsId;

    if (Auth::user()) {
      $user = Auth::user();

      $product = Product::where('id', $id)->first();

      $existwish = Wishlist::where('user_id', $user->id)->where('product_id', $id)->first();

      if ($existwish) {

        return redirect()->back()->with('info', 'Product  already exist on your wishlist');
      } else {

        $wishlist = new Wishlist();
        $wishlist->user_id = $user->id;
        $wishlist->product_id = $product->id;
        $wishlist->product_name = $product->title;
        $wishlist->image = $product->image;
        $wishlist->price = $product->price;
        $wishlist->save();

        return redirect()->back()->with('success', 'Product  added to wishlist successfully!!');
      }
    } else {
      return redirect('login');
    }
  }

  public function add_wishlist(Request $req)
  {
    $id = $req->productsId;
    if (Auth::user()) {
      $user = Auth::user();

      $product = Product::where('id', $id)->first();

      $existwish = Wishlist::where('user_id', $user->id)
        ->where('product_id', $id)
        ->where('deleted_at', null)
        ->first();

      if ($existwish) {

        return redirect('/#product')->with('info', 'Product  already exist on your wishlist');
      } else {

        $wishlist = new Wishlist();
        $wishlist->user_id = $user->id;
        $wishlist->product_id = $product->id;
        $wishlist->product_name = $product->title;
        $wishlist->image = $product->image;
        $wishlist->price = $product->price;
        $wishlist->save();

        return redirect('/#product')->with('success', 'Product added to wishlist successfully!!');
      }
    } else {
      return redirect('login');
    }
  }

  public function delete_wish(Request $req)
  {

    $user = Auth::user();
    $wish = Wishlist::where('id', $req->Wishid)->first();

    Session::put('Restore', [
      'wishid' =>  $wish->id,
    ]);

    $wish->delete();

    return redirect()->back()->with('success', 'Wish deleted successfully');
  }

  public function restorewish($wishid)
  {
    $data = Wishlist::withTrashed()->find($wishid);
    $data->restore();
    return redirect()->back()->with('success', 'The Wish Item Restored  Successfully!');
  }

  public function upd_cart(Request $req, $id)
  {
    $cart = Cart::find($id);
    $product = Product::find($cart->product_id);
    $prevquan = $cart->quantity;
    $net = $req->quantity - $prevquan;
    if ($net > $product->quantity) {
      if ($product->quantity == 0) {
        return redirect()->back()->with('failed', "Sorry  We Have Only the Specified Quantity For This Product Please Visit Us Next Time!!");
      }
      return redirect()->back()->with('failed', "Sorry  We Dont Have Such Quantity For This Product in Our Store You can only add up to  {$product->quantity} product");
    }
    $cart->quantity = $req->quantity;
    $quantity = $cart->quantity;
    if ($product->discount_price != null) {
      $cart->price = $product->discount_price * $quantity;
    } else {
      $cart->price = $product->price * $quantity;
    }
    // if ($net > 0) {
    //   $product->quantity -= $net;
    // } elseif ($net < 0) {
    //   $product->quantity += abs($net);
    // }
    // $product->save();
    $cart->save();
    return redirect()->back()->with('message', 'Your Cart is Updated Successfully');
  }

  // public function show_cart()
  // {
  //   if (Auth::id()) {
  //     Cart::where('deleted_at','<',today())->forceDelete();
  //     $user = Auth::user();
  //     $data = Cart::where('user_id', $user->id)->get();
  //     if ($data->isEmpty()) {
  //       return view('home.showcart', ['messagen' => 'Your cart is empty!']);
  //     } else {
  //       $total = Cart::where('user_id', $user->id)->sum('price');
  //       return view('home.showcart', ['cartpro' => $data, 'total' => $total]);
  //     }
  //   } else {
  //     return redirect('login');
  //   }
  // }
  public function show_cart()
  {
    if (Auth::id()) {
      $user = Auth::user();

      Cart::where('deleted_at', '<', Carbon::today())->forceDelete();

      $data = Cart::where('user_id', $user->id)->get();

      foreach ($data as $cartItem) { //notice that the get method get many model instance of this table so we can itterate over it 
        if ($cartItem->updated_at <  Carbon::now()->subDays(30)) {
          $product = Product::find($cartItem->product_id);
          if ($product) {
            $product->increment('quantity', $cartItem->quantity);
          }
          $cartItem->forceDelete();
        }
      }

      $data = Cart::where('user_id', $user->id)->get();

      if ($data->isEmpty()) {
        return view('home.showcart', ['messagen' => 'Your cart is empty!']);
      } else {
        $total = Cart::where('user_id', $user->id)->sum('price');
        return view('home.showcart', ['cartpro' => $data, 'total' => $total]);
      }
    } else {
      return redirect('login');
    }
  }
  public function show_order()
  {
    if (Auth::id()) {
      $user = Auth::user();
      $data = Order::where('user_id', $user->id)->get();
      return view('home.showorder', ['order' => $data]);
    } else {
      return redirect('login');
    }
  }

  public function deletecart($id)
  {
    Cart::where('deleted_at', '<', today())->forceDelete();

    $data = Cart::find($id);
    $data->delete(); //soft delete because SoftDelete included on Cart model data is not removed from the carts table and can be restored when needed
    // $data->forceDelete(); remove data permanently from carts table
    // $product = Product::find($data->product_id);
    // $product->quantity = $product->quantity + $data->quantity; //inventory  //nati
    // $product->save();

    Session::put('Restore', [
      'cartid' =>    $data->id,
    ]);

    return redirect()->back()->with('message', 'The Item Deleted From The Cart Successfully!');
  }

  public function restorecart($id)
  {

    $data = Cart::withTrashed()->find($id);
    $data->restore(); //soft delete because SoftDelete included on Cart model data is not removed from the carts table and can be restored when needed
    // // $data->forceDelete(); remove data permanently from carts table
    // $product = Product::find($data->product_id); //nati
    // $product->quantity = $product->quantity - $data->quantity; //inventory  //nati
    // $product->save();//nati
    return redirect()->back()->with('message', 'The Item Restored  Successfully!');
  }

  public function deletecartao($userid)
  {
    $data = Cart::where('user_id', $userid)->delete();
    return redirect()->back();
  }

  public function cash_order()
  {
    $user = Auth::user();
    $userid = $user->id;
    $date = Carbon::today();
    // $Ordernumber = mt_rand(1000000000, 9999999999);
    $Ordernumber = $this->generateUniqueOrderNumber();
    $data = Cart::where('user_id', $userid)->get();
    $total = Cart::where('user_id', $user->id)->sum('price');
    $totalquantity = Cart::where('user_id', $user->id)->sum('quantity');
    $cart_products = [];
    $cart_productid = [];
    $cart_productquantity = [];
    $cart_image = [];
    $order = new Order();
    $order->name = $data[0]->name;
    $order->email = $data[0]->email;
    $order->phone = $data[0]->phone;
    $order->address = $data[0]->address;
    $order->user_id = $data[0]->user_id;
    $order->date = $date;
    foreach ($data as $item) {
      $cart_products[] = $item->product_title . ' (' . $item->quantity . ')';
      $cart_productid[] = $item->product_id;
      $cart_productquantity[] = $item->quantity;
      $cart_image[] = $item->image;
      $product = Product::find($item->product_id);
      $product->orderQuantity += $item->quantity;
      $product->save();
    }

    $total_products = implode(', ', $cart_products);
    $productsid = implode(', ', $cart_productid);
    $productsquantity = implode(', ', $cart_productquantity);
    $productimg = implode(', ', $cart_image);
    $order->product_title = $total_products;
    $order->eachquantity = $productsquantity;
    $order->product_id = $productsid;
    $order->quantity = $totalquantity;
    $order->price = $total;
    $order->image = $productimg;
    $order->order_no = $Ordernumber;
    $order->payment_status = 'Cash on delivery';
    $order->delivery_status = 'Pending';
    $order->save();
    // $idorder = $order->id;

    // $this->print_pdf($order->id);
    if ($order->id) {
    Session::put('idorder');
    }

    Session::put('Orderdetail', [
      'Ordernumber' => $Ordernumber,
      // 'idorder' => $idorder,
      'butto' => 'QR Code',
      'url' => 'https://github.com/',
    ]);
    // if ($order->id) {
    //   // Saving was successful, store order details in the session
    //   Session::put('Orderdetail', [
    //       'Ordernumber' => $Ordernumber,
    //       // 'idorder' => $order->id,
    //       'butto' => 'QR Code',
    //       'url' => 'https://github.com/',
    //   ]);
    // }

    Cart::where('user_id', $userid)->delete();

    return redirect('/email');
  }
  public function print_pdf($id)
  {
    $order = Order::find($id);
    // $pdf = PDF::loadView('home.pdf', compact('order'));
    // return $pdf->download('order_detail.pdf');
  }
  public function stripe(Request $req)
  {
    $total = $req->total;
    $shipid = $req->shipid;
    return view('home.stripe', compact('total', 'shipid'));
  }
  public function payoption($total)
  {

    // $total = $req->total;
    
    return view('home.Paymethods', compact('total'));
  }
  public function chapa(Request $req)
  {
    $total = $req->total;
    $shipid = $req->shipid;
    return view('home.chapapage', compact('total', 'shipid'));
  }

 
  public function confirmchapapayment()
  {
    $user = Auth::user();
    $paymentParams = Session::get('payment_parameters');
    $shipid = $paymentParams['shipid'];
    Session::forget('payment_parameters');
    $Ordernumber = $this->generateUniqueOrderNumber();
    $userid = $user->id;
    $date = Carbon::today();
    $data = Cart::where('user_id', $userid)->get();
    $total = Cart::where('user_id', $user->id)->sum('price');
    $totalquantity = Cart::where('user_id', $user->id)->sum('quantity');
    $cart_products = [];
    $cart_productid = [];
    $cart_image = [];

    // Create and save the order
    $order = new Order();
    $order->name = $data[0]->name;
    $order->email = $data[0]->email;
    $order->phone = $data[0]->phone;
    $order->address = $data[0]->address;
    $order->user_id = $data[0]->user_id;
    $order->date = $date;

    foreach ($data as $item) {
      $cart_products[] = $item->product_title . ' (' . $item->quantity . ')';
      $cart_productid[] = $item->product_id;
      $cart_productquantity[] = $item->quantity;
      $cart_image[] = $item->image;

      // Update orderedQuantity in products table
      $product = Product::find($item->product_id);
      $product->quantity = $product->quantity - $item->quantity;   //nati
      $product->orderQuantity += $item->quantity;
      $product->save();
    }

    $total_products = implode(', ', $cart_products);
    $productsid = implode(', ', $cart_productid);
    $productsquantity = implode(', ', $cart_productquantity);
    $productimg = implode(', ', $cart_image);
    $order->product_title = $total_products;
    $order->eachquantity = $productsquantity;
    $order->product_id = $productsid;
    $order->quantity = $totalquantity;
    $order->price = $total;
    $order->image = $productimg;
    $order->order_no = $Ordernumber;
    $order->shipping_id = $shipid;
    $order->payment_status = 'Paid';
    $order->delivery_status = 'Processing';
    $order->save();
    $orderid = $order->id;//

    Session::put('Orderdetail', [
      'Orderid' => $orderid,
      'Shipid' => $shipid,
      'userid' => $userid, 
      'Ordernumber' => $Ordernumber,
      'button' => 'QR Code',
      'url' => 'https://github.com/',
    ]);

    Cart::where('user_id', $userid)->delete();

    return redirect('/email');
  }

  private function generateUniqueOrderNumber()
  {
    $Ordernumber = mt_rand(1000000000, 9999999999);

    // Check if the generated order number already exists in the orders table
    $exists = Order::where('order_no', $Ordernumber)->exists();

    // If the order number already exists, generate a new one recursively
    if ($exists) {
      return $this->generateUniqueOrderNumber();
    }

    return $Ordernumber;
  }

  public function stripePost(Request $request)
  {

    $total = $request->total;
    $shipid = $request->shipid;
    try {
      Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

      Stripe\Charge::create([
        "amount" => $total * 100,
        "currency" => "usd",
        "source" => $request->stripeToken,
        "description" => "Thanks For Payment"
      ]);
      // $Ordernumber = mt_rand(1000000000, 9999999999);
      $Ordernumber = $this->generateUniqueOrderNumber();
      
      $user = Auth::user(); //we  can get all information of the login user
      $userid = $user->id;
      $date = Carbon::today();
      $data = Cart::where('user_id', $userid)->get();
      $total = Cart::where('user_id', $user->id)->sum('price');
      $totalquantity = Cart::where('user_id', $user->id)->sum('quantity');
      $cart_products = [];
      $cart_productid = [];
      $cart_image = [];
      $order = new Order();
      $order->name = $data[0]->name;
      $order->email = $data[0]->email;
      $order->phone = $data[0]->phone;
      $order->address = $data[0]->address;
      $order->user_id = $data[0]->user_id;
      $order->date = $date;
      foreach ($data as $item) {
        $cart_products[] = $item->product_title . ' (' . $item->quantity . ')';
        $cart_productid[] = $item->product_id;
        $cart_productquantity[] = $item->quantity;
        $cart_image[] = $item->image;
        $product = Product::find($item->product_id);
        $product->quantity = $product->quantity - $item->quantity; //nati
        $product->orderQuantity += $item->quantity;
        $product->save();
      }
      $total_products = implode(', ', $cart_products);
      $productsid = implode(', ', $cart_productid);
      $productsquantity = implode(', ', $cart_productquantity);
      $productimg = implode(', ', $cart_image);
      $order->product_title = $total_products;
      $order->eachquantity = $productsquantity;
      $order->product_id = $productsid;
      $order->quantity = $totalquantity;
      $order->price = $total;
      $order->image = $productimg;
      $order->order_no = $Ordernumber;
      $order->shipping_id = $shipid;
      $order->payment_status = 'Paid';
      $order->delivery_status = 'Processing';
      $order->save();
      $orderid = $order->id;

      Session::put('Orderdetail', [
        'Orderid' => $orderid,
        'userid' => $userid, 
        'Shipid' => $shipid,
        'Ordernumber' =>   $Ordernumber,
        'button' => 'QR Code',
        'url' => 'https://github.com/',
      ]);

      Cart::where('user_id', $userid)->delete();

      return redirect('/email');
    } catch (ApiConnectionException $exception) {
      // Stripe API connection exception
      return redirect()->back()->with('failed', 'No internet connection. Please check your network.');
    } catch (CardException $exception) {
      // Stripe card exception
      return redirect()->back()->with('failed', 'Card error. Please check your card details and try again.');
    } catch (Exception $exception) {
      // Other general exceptions
      return redirect()->back()->with('failed', 'An error occurred. Please try again later.');
    }
  }

  public function checkout()
  {

    $user = Auth::user();
    $carts = Cart::where('user_id', $user->id)->get();
    $total = Cart::where('user_id', $user->id)->sum('price');
    return view('home.shipping', compact('carts', 'total'));
  }

  public function shipping(Request $req)
  {

    //unhandeled form resubmission issue

    $validator = $req->validate([
      'fname' => 'required|string|max:50',
      'lname' => 'required|string|max:50',
      'email' => 'required|email|max:100',
      'phone' => 'required|string|max:10',
      //'phone2' => 'string|max:10',
      'city' => 'required|string|max:50',
      'town' => 'required|string|max:50',
      'kebwor' => 'required|string|max:50',
      'pobox' => 'required|string|max:50',
      'Addaddress' => 'required|string|max:50',
      'payment_option' => 'required|string|max:50',
    ]);


    $total = $req->total;

    $shipping = new Shipping();
    $shipping->first_name = $validator['fname'];
    $shipping->last_name = $validator['lname'];
    $shipping->email = $validator['email'];
    $shipping->phone = $validator['phone'];
    if($req->phone2){
      $shipping->phone2 = $req->phone2;
    }
    else{
      $shipping->phone2 = null;
    }
    
    $shipping->city = $validator['city'];
    $shipping->town = $validator['town'];
    $shipping->kbl_wra = $validator['kebwor'];
    $shipping->pobox = $validator['pobox'];
    $shipping->add_address = $validator['Addaddress'];
    $shipping->save();
    $shipid = $shipping->id;


    if ($validator['payment_option'] === 'Cash on delivery') {
      $user = Auth::user();
      $userid = $user->id;
      $date = Carbon::today();
      // $Ordernumber = mt_rand(1000000000, 9999999999);
      $Ordernumber = $this->generateUniqueOrderNumber();
      $data = Cart::where('user_id', $userid)->get();
      $total = Cart::where('user_id', $user->id)->sum('price');
      $totalquantity = Cart::where('user_id', $user->id)->sum('quantity');
      $cart_products = [];
      $cart_productid = [];
      $cart_productquantity = [];
      $cart_image = [];
      $order = new Order();
      $order->name = $data[0]->name;
      $order->email = $data[0]->email;
      $order->phone = $data[0]->phone;
      $order->address = $data[0]->address;
      $order->user_id = $data[0]->user_id;
      $order->date = $date;
      foreach ($data as $item) {
        $cart_products[] = $item->product_title . ' (' . $item->quantity . ')';
        $cart_productid[] = $item->product_id;
        $cart_productquantity[] = $item->quantity;
        $cart_image[] = $item->image;
        $product = Product::find($item->product_id);
        $product->quantity = $product->quantity - $item->quantity;  //nati
        $product->orderQuantity += $item->quantity;
        $product->save();
      }
      $total_products = implode(', ', $cart_products);
      $productsid = implode(', ', $cart_productid);
      $productsquantity = implode(', ', $cart_productquantity);
      $productimg = implode(', ', $cart_image);
      $order->product_title = $total_products;
      $order->eachquantity = $productsquantity;
      $order->product_id = $productsid;
      $order->quantity = $totalquantity;
      $order->price = $total;
      $order->image = $productimg;
      $order->order_no = $Ordernumber;
      $order->shipping_id = $shipid;
      $order->payment_status = 'Cash on delivery';
      $order->delivery_status = 'Pending';
      $order->save();
      $orderid = $order->id;

      // $this->print_pdf($order->id);

      Session::put('Orderdetail', [
        'Ordernumber' => $Ordernumber,
        'userid' => $userid,  //nati
        'Orderid' =>  $orderid,
        'Shipid' => $shipid,
        'button' => 'QR Code',
        'url' => 'https://github.com/',
      ]);

      Cart::where('user_id', $userid)->delete();

      return redirect('/email');
    } elseif ($req->payment_option === 'Card Payment') {
      return view('home.Paymethods', compact('total', 'shipid'));
      // return redirect()->route('payment.methods');
    }
  }

  public function cancel_order($id)
  {
    $order = Order::find($id);
    $productIDs = ltrim($order->product_id, ',');
    $productIDs = explode(', ', $order->product_id);
    $quantities = explode(', ', $order->eachquantity);

    foreach ($productIDs as $key => $productID) {
      $product = Product::find($productID);
      if ($product) {
        $newQuantity = $product->quantity + $quantities[$key];
        $neworederquantity = $product->orderQuantity - $quantities[$key];
        $product->quantity = $newQuantity;
        $product->orderQuantity = $neworederquantity;
        $product->save();
      }
    }
    Shipping::where('id', $order->shipping_id)->delete();

    $order->delete();

    return redirect()->back()->with('message', 'You have successfully canceled your order.');
  }

  public function send_comment(Request $req)
  {
    if (Auth::id()) {
      $user = Auth::user();
      if ($user->address == null && $user->address == null) {
        return view('home.newlogin')->with('message', 'Let Us Finish Your Set Up First!!');
      }
      $post = new Comment();
      $post->name = $user->name;
      $post->user_id = $user->id;
      $post->comment = $req->comment;
      $post->save();
      return redirect('/#comment')->with('message', 'Thank You For Your Comment!!');
    }
  }

  public function contact()
  {
    return view('home.contact');
  }
  // public function about()
  // {
  //   $product = Product::all();
  //   return view('home.about', compact('product'));
  // }
  public function about()
  {
    $product = Product::where('featured', 'yes')->get();
    return view('home.about', compact('product'));
  }

  public function sell()
  {
    if (Auth::user()) {
      $user = Auth::user();
      if ($user->address == null && $user->address == null) {
        return redirect('newl')->with('message', 'Let Us Finish Your Set Up First!!');
      } else {
        $thirtyDaysAgo = Carbon::now()->subDays(60)->format('Y-m-d');
        $price = Order::where('user_id', $user->id)
          ->whereDate('date', '>=', $thirtyDaysAgo)
          ->sum('price');

        if ($price < 5000) {
          return redirect()->back()->with('sellinfo', 'To Sell your staffs you need a minimum transaction of 5000ETB for the last 2 months');
        } else {
          Session::put('infoseller', 'Please enter all required inputs and remember to put detailed description to attract more buyers for your items');
          $category = Catagory::all();
          return view('home.sell', ['category' => $category]);
        }
      }
    } else {
      return redirect('login');
    }
  }

  public function sellproduct(Request $req)
  {
    $user = Auth::user();
    $validatepro = $req->validate([
      'ItemDescription' => 'required|String',
      'ItemName' => 'required|String',
      'ItemQuantity' => 'required|Integer',
      'ItemPrice' => 'required|Integer',
      'ItemStatus' => 'required|String',
      'ItemPhoto' => 'required',
      'ItemCategory' => 'required|String',
      'optionalPhone' => 'nullable|digits:10',//optinal field can be left null
    ]);
    $cuspro = new Customersell();
    $cuspro->name = $user->name;
    $cuspro->user_id = $user->id;
    $cuspro->email = $user->email;
    $cuspro->phone = $user->phone;
    $cuspro->address = $user->address;
    $cuspro->title = $validatepro['ItemName'];
    $cuspro->description = $validatepro['ItemDescription'];
    $cuspro->category = $validatepro['ItemCategory'];
    $cuspro->quantity = $validatepro['ItemQuantity'];
    $cuspro->price = $validatepro['ItemPrice'];
    if ($req->optionalPhone) {
      $cuspro->optional_Phone = $req->optionalPhone;
    } else {
      $cuspro->optional_Phone = null;
    }
    $cuspro->status = $validatepro['ItemStatus'];
    $image = $validatepro['ItemPhoto'];
    $imagename = time() . '.' . $image->getClientOriginalExtension(); //time() give image a unique name
    $validatepro['ItemPhoto']->move('custemersell', $imagename); //we will store image on 'custemersell folder of the public directory
    $cuspro->image = $imagename;
    $cuspro->verification  = 'Not Verified';
    $cuspro->save();
    return redirect()->back()->with('message', 'If Verified We Will Contact You With Your Phone or Email.Thank You For Shopping With Us!!!');
  }
  public function send_seller_email(Request $req, $id)
  {
    $order = Customersell::find($id);
    $user = Auth::user();
    $email = $req->body;
    if ($email) {
      if ($user->id != $order->user_id) {
        $details = [
          'greeting' => 'Hi How Are You',
          'firstline' => 'I Am Gion E-Market User And I Have Seen You Item On Gion WebSite',
          'item' => 'Item name:' . " " . $order->title,
          'body' => $req->body,
          'lastline' => 'Please Respond on:' . " " . $user->email . " " . "or Use My Phone no:" . $user->phone . " " . 'As Much As Possible Good Buy',
        ];
        try {
          Notification::send($order, new EmailSeller($details)); // Find email from the order table and send to that specific user 
          return redirect()->back()->with('message', 'Email Sent Successfully');
        } catch (Exception $e) {
          return redirect()->back()->with('Failed', 'Failed to send email. Please check your internet connection and try again.');
        }
      } else {
        return redirect()->back()->with('Failed', 'You cannot email yourself!!');
      }
    } else {
      return redirect()->back()->with('Noresult', 'No Input Entered!!');
    }
  }

  # write a controller function which accept an http request and validates          
  public function fetchData(Request $req){
    $message   = $req->message;
    dd( $message);
    $data = ['message' => 'Data fetched successfully!' ];
    return response()->json([
      'status' => 200,
      'success' => "Successfull",
  ]);
  }    
}
