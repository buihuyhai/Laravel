@extends('master')
@section('content')
<div class="inner-header">
    <div class="container">
        <div class="pull-left">
            <h6 class="inner-title">Đặt Hàng</h6>
        </div>
        <div class="pull-right">
            <div class="beta-breadcrumb">
                <a href="{{route('trangchu')}}">Trang chủ</a> / <span>Đặt hàng</span>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>

<div class="container">
    <div id="content">
        @if(Session::has('thongbao'))<div class="alert alert-success">{{Session::get('thongbao')}}</div>@endif
        <form action="{{route('dathang')}}" method="post" class="beta-form-checkout">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <div class="row">
                <div class="col-sm-6">
                    <h4>Thông tin khách hàng</h4>
                    <div class="space20">&nbsp;</div>

                    <div class="form-block">
                        <label for="your_first_name">Họ Tên*</label>
                        <input type="text" id="name" name = "fullname" placeholder="Nhập đầy đủ họ tên" required>
                    </div>
                    <div class="form-block">
                        <label for="your_first_name">Giới tính*</label>
                        <input  type="radio" class="input-radio" name="gender" value="Nam" checked="checked" style="width:10%">
                        <span style="padding-right: 20px">Nam</span>
                        <input  type="radio" class="input-radio" name="gender" value="Nu" checked="checked" style="width:10%">
                        <span>Nữ</span>
                    </div>
                    <div class="form-block">
                        <label for="adress">Địa chỉ*</label>
                        <input type="text" id="adress" name="address" placeholder="Nhập địa chỉ nhận hàng" required>
                    </div>
                    <div class="form-block">
                        <label for="email">Email address*</label>
                        <input type="email" id="email" name="email" placeholder="Nhập email" required>
                    </div>

                    <div class="form-block">
                        <label for="phone">Điện thoại*</label>
                        <input type="text" id="phone"  name="phone" placeholder="Nhập số điện thoại liên hệ" required>
                    </div>
                    
                    <div class="form-block">
                        <label for="notes">Ghi chú</label>
                        <textarea id="notes" name="note"></textarea>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="your-order">
                        <div class="your-order-head"><h5>Đơn hàng của bạn</h5></div>
                        <div class="your-order-body">
                            <div class="your-order-item">
                                <div>
                                    @if(Session::has('cart'))
                                    @foreach($product_cart as $cart)
                                <!--  one item	 -->
                                    <div class="media">
                                        <img width="35%" src="Source/image/product/{{$cart['item']['image']}}" alt="" class="pull-left">
                                        <div class="media-body">
                                            <p class="font-large">{{$cart['item']['name']}}</p><br>
                                            <span class="color-gray your-order-info">Đơn giá: {{number_format($cart['price']/$cart['qty'])}}đ</span>
                                            <span class="color-gray your-order-info">Số lượng: {{$cart['qty']}}</span>
                                        </div>
                                    </div>
                                <!-- end one item -->
                                    @endforeach
                                    @endif
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="your-order-item">
                                <div class="pull-left"><p class="your-order-f18">Tổng tiền:</p></div>
                                <div class="pull-right"><h5 class="color-black">@if(Session::has('cart')) {{number_format($totalPrice)}} @else 0 @endif đ</h5></div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                        <div class="your-order-head"><h5>Hình thức thanh toán</h5></div>
                        
                        <div class="your-order-body">
                            <ul class="payment_methods methods">
                                <li class="payment_method_bacs">
                                    <input id="payment_method_bacs" type="radio" class="input-radio" name="payment_method" value="COD" checked="checked" data-order_button_text="">
                                    <label for="payment_method_bacs">Thanh toán trực tiếp (COD)</label>
                                    <div class="payment_box payment_method_bacs" style="display: block;">
                                        Thu tiền khi giao hàng đến nơi.
                                    </div>						
                                </li>

                                <li class="payment_method_cheque">
                                    <input id="payment_method_cheque" type="radio" class="input-radio" name="payment_method" value="ATM" data-order_button_text="">
                                    <label for="payment_method_cheque">Chuyển khoản</label>
                                    <div class="payment_box payment_method_cheque" style="display: none;">
                                        Chuyển đến số tài khoản 1018157017 ngân hàng VCB.
                                    </div>						
                                </li>
                                
                                <li class="payment_method_paypal">
                                    <input id="payment_method_paypal" type="radio" class="input-radio" name="payment_method" value="paypal" data-order_button_text="Proceed to PayPal">
                                    <label for="payment_method_paypal">PayPal</label>
                                    <div class="payment_box payment_method_paypal" style="display: none;">
                                        Trả qua paypal.
                                    </div>						
                                </li>
                            </ul>
                        </div>

                        <div class="text-center"><button type="submit" class="beta-btn primary" href="#">Đặt Hàng <i class="fa fa-chevron-right"></i></button></div>
                    </div> <!-- .your-order -->
                </div>
            </div>
        </form>
    </div> <!-- #content -->
</div> <!-- .container -->
@endsection