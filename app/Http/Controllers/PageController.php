<?php

namespace App\Http\Controllers;

use App\Http\Controllers\PageController;
use Illuminate\Http\Request;
use App\Models\Slide;
use App\Models\Product;
use App\Models\ProductType;
use App\Models\Cart;
use App\Models\Customer;
use App\Models\Bill;
use App\Models\BillDetail;
use App\Models\User;
use Hash;
use Auth;
use Session;



class PageController extends Controller
{
    public function getIndex(){
        $slide=Slide::all();
        $newproduct =Product::where('new',1)->paginate(4);
        $saleproduct=Product::where('promotion_price','<>',0)->paginate(4);
        return view('page.trangchu',compact('slide','newproduct','saleproduct'));
    }
    public function getloaisp($type){
        $sptheoloai=Product::where('id_type',$type)->paginate(9);
        $loai=ProductType::all();
        $lsp=ProductType::where('id',$type)->first();

        return view('page.loaisanpham',compact('sptheoloai','loai','lsp'));
    }
    public function getchitietsp(Request $req){
        $sanpham=Product::where('id',$req->id)->first();
        $sptuongtu=Product::where('id_type',$sanpham->id_type)->paginate(3);
        return view('page.chitietsanpham',compact('sanpham','sptuongtu'));
    }
    public function getlienhe(){
        return view('page.lienhe');
    }
    public function getgioithieu(){
        return view('page.gioithieu');
    }
    public function getaddtocart(Request $req, $id) {
        $product = Product::find($id);
        $quantity = 1; // Số lượng mặc định khi thêm từ trang chủ
    
        // Kiểm tra nếu có tham số 'quantity' từ request và đó là từ trang chi tiết sản phẩm
        if ($req->has('quantity') && $req->from_page == 'product_detail') {
            $quantity = $req->quantity;
        }
    
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->add($product, $id, $quantity);
    
        Session::put('cart', $cart);
        return redirect()->back();
    }
    
    public function getdeletecart($id){
        $oldCart=Session::has('cart')?Session::get('cart'):null;
        $cart=new Cart($oldCart);
        $cart->removeItem($id);
        if(count($cart->items)>0){
            Session::put('cart',$cart);
        }else{
            Session::forget('cart');

        }
        return redirect()->back();
    }
    public function getReduceByOne($id) {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->reduceByOne($id);
    
        if (count($cart->items) > 0) {
            Session::put('cart', $cart);
        } else {
            Session::forget('cart');
        }
    
        return redirect()->back();
    }
    public function getdathang(){
        if(Session::has('cart')){
            $oldCart=Session::get('cart');
            $cart=new Cart($oldCart);
            return view('page.dathang',['product_cart'=>$cart->items,'totaPrice'=>$cart->totalPrice,'totalQty'=>$cart->totalQty]);
        }else{
            return view('page.dathang');
        }
    }

    public function postdathang(Request $req){
        $cart = Session::get('cart');

        $customer = new Customer;
        $customer->name=$req->fullname;
        $customer->gender=$req->gender;
        $customer->email=$req->email;
        $customer->address=$req->address;
        $customer->phone_number=$req->phone;
        $customer->note=$req->note;
        $customer->save();

        $bill=new Bill;
        $bill->id_customer=$customer->id;
        $bill->date_order=date('Y-m-d');
        $bill->total=$cart->totalPrice;
        $bill->payment=$req->payment_method;
        $bill->note=$req->note;
        $bill->save();

        foreach($cart->items as $key=>$value){
            $bill_detail=new BillDetail;
            $bill_detail->id_bill=$bill->id;
            $bill_detail->id_product=$key;
            $bill_detail->quantity=$value['qty'];
            $bill_detail->unit_price=$value['price']/$value['qty'];
            $bill_detail->save();
        }
        Session::forget('cart');
        return redirect()->back()->with('thongbao',"Đặt hàng thành công!");
    }
    
    public function getsignup(){
        return view('page.dangky');
    }
    public function getlogin(){
        return view('page.dangnhap');
    }

    public function postlogin(Request $req){
        $this->validate($req,[
            'email'=>'required|email',
            'password'=>'required|min:6|max:20'
        ],[
            'email.required'=>'Vui lòng nhập email',
            'email.email'=>'Email không đúng định dạng',
            'password.required'=>'Vui lòng nhập mật khẩu',
            'password.min'=>'Mật khẩu ít nhất 6 kí tự',
            'password.max'=>'Mật khẩu không quá 20 kí tự'
        ]);
    
        $credentials = ['email' => $req->email, 'password' => $req->password];
    
        if(Auth::attempt($credentials)) {
            return redirect()->route('trangchu')->with(['flag'=>'success','message'=>'Đăng nhập thành công!']);
        } else {
            // Nếu đăng nhập không thành công, quay trở lại trang đăng nhập với thông báo lỗi
            return redirect()->back()->withErrors([
                'error' => 'Email hoặc mật khẩu không chính xác!'
            ])->withInput();
        }
    }
    
    


    public function postsignup(Request $req){
        $this -> validate($req,[
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|max:20',
            'fullname' => 'required',
            're_password' => 'required|same:password'
        ], 
        [
            'email.required' => 'Vui lòng nhập email',
            'email.email' => 'Không đúng định dạng email',
            'email.unique' => 'Email đã được sử dụng',
            'password.required' => 'Vui lòng nhập mật khẩu',
            'password.min' => 'Mật khẩu không ít hơn 6 kí tự',
            'password.max' => 'Mật khẩu không quá 20 kí tự',
            're_password.same' => 'Mật khẩu không trùng khớp'
        ]);
        $user=new User();
        $user->full_name=$req->fullname;
        $user->email=$req->email;
        $user->password=Hash::make($req->password);
        $user->phone=$req->phone;
        $user->address=$req->address;
        $user->save();
    
        Session::flash('thanhcong', 'Tạo tài khoản thành công');

    // Trả về view đăng ký với thông báo
    return view('page.dangky')->with('thanhcong', 'Tạo tài khoản thành công');
    }
    public function getlogout(){
        Auth::logout();
        return redirect()->route('trangchu');
    }
    public function getsearch(Request $req){
        $product=Product::where('name','like','%'.$req->key.'%')
                            ->orWhere('unit_price',$req->key)
                            ->get();
        return view('page.search',compact('product'));
    }
}
