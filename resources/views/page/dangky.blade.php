@extends('master')
@section('content')
<div class="inner-header">
    <div class="container">
        <div class="pull-left">
            
        </div>
        <div class="pull-right">
            <div class="beta-breadcrumb">
                <a href="{{route('trangchu')}}">Trang chủ</a> / <span>Đăng kí</span>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>

<div class="container">
    <div id="content">
        
        <form action="{{route('dangky')}}" method="post" class="beta-form-checkout">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <div class="row">
                <div class="col-sm-3"></div>
                @if(count($errors)>0)
                    <div class="alert alert-danger">
                        @foreach($errors->all() as $err)
                        {{$err}}
                        @endforeach
                    </div>
                @endif
                @if(Session::has('thanhcong'))
    <div class="alert alert-success">{{ Session::get('thanhcong') }}</div>
    <script type="text/javascript">
        // Hiển thị thông báo trong 5 giây trước khi chuyển hướng
        setTimeout(function() {
            window.location.href = "{{ route('dangnhap') }}";
        }, 5000);
    </script>
@endif



                <div class="col-sm-6">
                    <h4>Đăng kí</h4>
                    <div class="space20">&nbsp;</div>
                    <div class="form-block">
                        <label for="email">Email*</label>
                        <input type="email" name="email" placeholder="Nhập email đăng ký" required>
                    </div>

                    <div class="form-block">
                        <label for="your_last_name">Họ và Tên*</label>
                        <input type="text" name="fullname" placeholder="Nhập đầy đủ họ tên" required>
                    </div>

                    <div class="form-block">
                        <label for="adress">Địa chỉ*</label>
                        <input type="text" name="address" placeholder="Nhập địa chỉ" required>
                    </div>
                    <div class="form-block">
                        <label for="phone">Số điện thoại*</label>
                        <input type="text" name="phone" placeholder="Nhập số liên lạc" required>
                    </div>
                    <div class="form-block">
                        <label for="password">Mật khẩu*</label>
                        <input type="password" name="password" placeholder="Nhập mật khẩu" required>
                    </div>
                    <div class="form-block">
                        <label for="password">Nhập lại mật khẩu*</label>
                        <input type="password" name="re_password" placeholder="Nhập lại mật khẩu" required>
                    </div>
                    <div class="form-block" style="padding-left: 200px">
                        <button type="submit" class="btn btn-primary" >Đăng ký</button>
                    </div>
                </div>
                <div class="col-sm-3"></div>
            </div>
        </form>
    </div> <!-- #content -->
</div> <!-- .container -->
@endsection