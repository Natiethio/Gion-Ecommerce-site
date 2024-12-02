<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use PDF;
use Illuminate\Support\Facades\Notification;
use App\Notifications\SendEmailNotification;
use App\Models\Catagory;
use App\Models\Product;
use App\Models\Order;
use App\Models\Comment;
use App\Models\Customersell;
use App\Models\Shipping;

class AdminController extends Controller
{
   public function view_catagory(){
      if(Auth::id()){
         // $data=Catagory::all();
         $data = Catagory::orderBy('catagory_name', 'asc')->get();
         return view('admin.catagory',['catagory'=>$data]);
      }
      else{
         return redirect('login');
      }
   
   }
   public function add_catagory(Request $req){
      if(Auth::id()){
           $validatecata=$req->validate([
            'catagory'=>'required|String|max:50'
           ]);
           $data=new Catagory();
           $data->catagory_name=$validatecata['catagory'];
           $data->save();
           $message="Catagory Added Successfully";
           return redirect('/view_catagory')->with('message',$message);
      }
      else{
         return redirect('login');
      } 
   }
   public function delete($id){
      $data=Catagory::find($id);
      $data->delete();
      $messagedel="Catagory Deleted Successfully";
      return redirect('/view_catagory')->with('message',$messagedel);
   }
   public function view_product(){
      if(Auth::id()){
         $catagory=Catagory::all();//notice that
         return view('admin.product',['catagory'=>$catagory]);//or ,compact('catagory)
      }
      else{
         return redirect('login');
      }
     
   }
   public function add_product(Request $req){
      if(Auth::id()){
      $validatepro=$req->validate([
         'title'=>'required|String|max:100',
         'description'=>'required|String|max:100',
         'price'=>'required|Integer|min:100',
         'quantity'=>'required|Integer|min:10',
         'catagory'=>'required|String',
         'image'=>'required'
      ]);
      $product=new Product();
      $product->title=$validatepro['title'];
      $product->description=$validatepro['description'];
      $product->product_status='New';
      $product->price=$validatepro['price'];
      $product->quantity=$validatepro['quantity'];
      $product->discount_price=$req->dis_price;
      $product->category=$validatepro['catagory'];
      $image=$validatepro['image'];
      // $imagename=$image->getClientOriginalName();//time() give image a unique name
      $imagename=time().'.'.$image->getClientOriginalExtension();
      $validatepro['image']->move('product', $imagename);//we will store image on product folder of the public directory
      $product->image=$imagename;
      $product->save();
      return redirect()->back()->with('message','Product Added Successfully');
   }
   else{
      return redirect('login');
   }
   }
   public function show_product(){
      if(Auth::id()){
      $productdata=Product::paginate(9);
      return view('admin.showproduct',['showproduct'=>$productdata]);
      }
      else{
         return redirect('login');
      }
   }
   public function view_customer(){
      if(Auth::id()){
      $productdata=Customersell::paginate(9);
      return view('admin.customerproduct',['product'=>$productdata]);
      }
      else{
         return redirect('login');
      }
   }
   public function searchpro(Request $req){
      if(Auth::id()){
      $searchtext=$req->search;
      $product=Product::where('title','LIKE',"%$searchtext%")
      ->orWhere('category','LIKE',"%$searchtext%")
      ->orWhere('price','LIKE',"%$searchtext%")
      ->orWhere('discount_price','LIKE',"%$searchtext%")->paginate(9);
      return view('admin.showproduct',['showproduct'=> $product]);
      }
      else{
         return redirect('login');
      }
  }
  public function searchcustpro(Request $req){
   if(Auth::id()){
   $searchtext=$req->search;
   $product=Customersell::where('title','LIKE',"%$searchtext%")
      ->orWhere('name','LIKE',"%$searchtext%")
      ->orWhere('email','LIKE',"%$searchtext%")
      ->orWhere('phone','LIKE',"%$searchtext%")
      ->orWhere('status','LIKE',"%$searchtext%")
      ->orWhere('verification','LIKE',"%$searchtext%")
      ->orWhere('category','LIKE',"%$searchtext%")
      ->orWhere('price','LIKE',"%$searchtext%")->paginate(9);
   return view('admin.customerproduct',['product'=> $product]);
   }
   else{
      return redirect('login');
   }
}
public function searchuser(Request $req)
{
    if(Auth::id()){
        $searchtext = $req->search;
        $users = User::where('usertype', 0)
            ->where(function ($query) use ($searchtext) {
                $query->where('name', 'LIKE', "%$searchtext%")
                    ->orWhere('email', 'LIKE', "%$searchtext%")
                    ->orWhere('phone', 'LIKE', "%$searchtext%")
                    ->orWhere('id', 'LIKE', "%$searchtext%")
                    ->orWhere('address', 'LIKE', "%$searchtext%");
            })
            ->paginate(9);
        return view('admin.users', ['users' => $users]);
    } else {
        return redirect('login');
    }
}
   public function Deletepro($id){
      $user=Product::where('id',$id)->first();
      if($user){
         $deldata=Product::find($id);
         $deldata->delete();
         return redirect()->back()->with('message','Product Deleted Successfully');
      }
      else{
         return redirect()->back()->with('message','Product Not Found');
      }
   }
   public function DeleteCustpro($id){
      $user=Customersell::where('id',$id)->first();
      if($user){
         $deldata=Customersell::find($id);
         $deldata->delete();
         return redirect()->back()->with('message','Product Deleted Successfully');
      }
      else{
         return redirect()->back()->with('message','Product Not Found');
      }
     
   }
   public function Deleteuser($id){
      $user=User::where('id',$id)->first();
      if($user){
         $deldata=User::find($id);
         $deldata->delete();
         return redirect()->back()->with('message','User Deleted Successfully');
      }
      else{
         return redirect()->back()->with('error','User Not Found');
      }
   }
   public function  EditPro($id){
      if(Auth::id()){
      $product = Product::find($id);
      $category = Catagory::all();
      $featuredproduct = Product::distinct('featured')->get('featured');
      $productstatus = Product::distinct('product_status')->get('product_status');
      return view('admin.editpro',compact('product', 'category', 'featuredproduct', 'productstatus'));
      }
      else{
         return redirect('login');
      }
   }
   public function  Editcust($id){
      if(Auth::id()){
      $custpro=Customersell::find($id);
      $custstatus = Customersell::distinct('status')->get('status');
      $category=Catagory::all();
      return view('admin.editcustitem',compact('custpro','category','custstatus'));
      }
      else{
         return redirect('login');
      }
   }
   public function Update(Request $req,$id){
      if(Auth::id()){
      $validatepro=$req->validate([
         'title'=>'required|String|max:100',
         'description'=>'required|String|max:100',
         'status'=>'required|String|max:100',
         'price'=>'required|Integer|min:100',
         'quantity'=>'required|Integer|min:10',
         'catagory'=>'required|String',
         'featured' => 'required|String',
      ]);
     $updpro=Product::find($id);
     $updpro->title=$validatepro['title'];
     $updpro->description=$validatepro['description'];
     $updpro->product_status=$validatepro['status'];
     $updpro->featured=$validatepro['featured'];
     $updpro->price=$validatepro['price'];
     $updpro->discount_price=$req->dis_price;
     $updpro->quantity=$validatepro['quantity'];
     $updpro->category=$validatepro['catagory'];
     $image=$req->image;
     if ($image) {//check if there is any image request
     $image=$req->image;
     $imagename=time().'.'.$image->getClientOriginalExtension();
     $req->image->move('product', $imagename);
     $updpro->image=$imagename;
     }
     else{
      $updpro->image= $updpro->image;//no image request or Admin don't want to change the product image continue as it is
     }
     $updpro->save();
     return redirect()->back()->with('message','Product Updated Successfully');
   }
   else{
      return redirect('login');
   }
    }
    public function Updcust(Request $req,$id){
      if(Auth::id()){
      $validatepro=$req->validate([
         'title'=>'required|String|max:100',
         'description'=>'required|String|max:150',
         'status'=>'required|String|max:100',
         'price'=>'required|Integer',
         'quantity'=>'required|Integer',
         'catagory'=>'required|String',
         'verification'=>'required|String'
      ]);
     $updpro=Customersell::find($id);
     $updpro->title=$validatepro['title'];
     $updpro->description=$validatepro['description'];
     $updpro->status=$validatepro['status'];
     $updpro->price=$validatepro['price'];
   //   $updpro->discount_price=$req->dis_price;
     $updpro->quantity=$validatepro['quantity'];
     $updpro->category=$validatepro['catagory'];
     $image=$req->image;
     if ($image) {//check if there is any image request
     $image=$req->image;
     $imagename=time().'.'.$image->getClientOriginalExtension();
     $req->image->move('product', $imagename);
     $updpro->image=$imagename;
     }
     else{
      $updpro->image= $updpro->image;//no image request or Admin don't want to change the product image continue as it is
     }
     $updpro->verification=$validatepro['verification'];
     $updpro->save();
     return redirect()->back()->with('message','Seller Item Updated Successfully');
   }
   else{
      return redirect('login');
   }
    }
    public function order()
{
    $data = Order::orderBy('id', 'desc')->get();

    return view('admin.order', ['orderdata' => $data]);
}
public function users(){
   $users = User::where('usertype',0)->paginate(9);
   return view('admin.users',compact('users'));
}
    public function Change($id){
       $data=Order::find($id);
       $data->delivery_status="Delivered";
       if($data->payment_status="Cash on delivery"){
         $data->payment_status='Paid';
       }
      $data->save();
       return redirect()->back();
    }
    public function print_pdf($id){
      if(Auth::id()){
       $order=Order::find($id);
       $pdf= PDF::loadView('admin.pdf',compact('order'));
       return $pdf->download('order_detail.pdf');
      }
      else{
         return redirect('login');
      }
    }
    public function send_email($id){
      $order=Order::find($id);
       return view('admin.email_info',['order'=>$order]);
    }
    public function send_user_email(Request $req,$id){
      $order=Order::find($id);
      $details=[
         'greeting'=>$req->greeting,
         'firstline'=> $req->firstline,
         'body'=> $req->body,
         'button'=> $req->button,
         'url'=> $req->url,
         'lastline'=> $req->lastline,
      ];
      Notification::send($order, new SendEmailNotification($details));//find email from the order table and send to that specific user 
      return redirect()->back()->with('message','Email Send Successfully!!');
    }
    public function searchdata(Request $req){
        $searchtext=$req->search;
        $order=Order::where('name','LIKE',"%$searchtext%")->orWhere('phone','LIKE',"%$searchtext%")
        ->orWhere('product_title','LIKE',"%$searchtext%")->orderBy('id', 'desc')->get();
        return view('admin.order',['orderdata'=> $order]);
    }
    public function comment(){
      $comment=Comment::orderBy('id','desc')->get();
      return view('admin.comment',['comment'=>$comment]);
    }
    public function deletecom($id){
       $comment=Comment::find($id);
       $comment->delete();
       return redirect()->back()->with('message','Comment Deleted Successfully');
    }

    public function shippingadmin(){

      $shipping = Shipping::orderBy('id','desc')->get();
      return view('admin.shipping',compact('shipping'));

    }

    public function searchship(Request $req){
      $id=$req->search;
      $shipping=Shipping::where('id',$id)->orderBy('id','desc')->get();
      return view('admin.shipping',['shipping' => $shipping]);
  }

  public function deleteodrshp($id){
    $check = Order::where('shipping_id',$id)->first();
    $ship = Shipping::where('id',$id)->first();
     if($check->delivery_status != 'Delivered'){
       return redirect()->back()->with('failed','Delete failed because the Customer is not yet delivered!');
     }
     else{
      $check->shipping_id = 'Deleted';
      $check->save();
      $ship->delete();
      return redirect()->back()->with('success','The shipping data is deleted successfully!');
     }
  }
}
