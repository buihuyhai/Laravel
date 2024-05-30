@extends('master')
@section('content')
<div class="inner-header">
    <div class="container">
        <div class="pull-left">
            <h6 class="inner-title">Sản Phẩm {{$sanpham->name}}</h6>
        </div>
        <div class="pull-right">
            <div class="beta-breadcrumb font-large">
                <a href="{{ route('trangchu') }}">Trang chủ</a> / <span>Chi tiết sản phẩm</span>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>

<div class="container">
    <div id="content">
        <div class="row">
            <div class="col-sm-9">

                <div class="row">
                    <div class="col-sm-4">
                        <img src="Source/image/product/{{$sanpham->image}}" alt="">
                    </div>
                    <div class="col-sm-8">
                        <div class="single-item-body">
                            <p class="single-item-title"><h3>{{$sanpham->name}}</h3></p>
                            <p class="single-item-price">
                            @if($sanpham->promotion_price==0)
                                <span class="flash-sale">{{number_format($sanpham->unit_price)}}đ</span>
                            @elseif($sanpham->promotion_price>=0)
                                <span class="flash-del">{{number_format($sanpham->unit_price)}}đ</span>
                                <span class="flash-sale">{{number_format($sanpham->promotion_price)}}đ</span>
                            @endif
                            </p>
                        </div>

                        <div class="clearfix"></div>
                        <div class="space20">&nbsp;</div>

                        <div class="single-item-desc">
                            <p>{{$sanpham->description}}</p>
                        </div>
                        <div class="space20">&nbsp;</div>

                        <p>Lựa chọn:</p>
                        <form action="{{ route('themgiohang', $sanpham->id) }}" method="get">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <input type="hidden" name="from_page" value="product_detail">
                           <select class="wc-select" name="quantity">
                                                        <option value="">Số lượng</option>
                                                        @for ($i = 1; $i <= 100; $i++)
                                                            <option value="{{ $i }}">{{ $i }}</option>
                                                        @endfor
                                                    </select>
                            <button type="submit" class="add-to-cart"><i class="fa fa-shopping-cart"></i></button>
                        </form>                       
                    </div>
                </div>

                <div class="space40">&nbsp;</div>
                <div class="woocommerce-tabs">
                    <ul class="tabs">
                        <li><a href="#tab-description">Mô tả</a></li>
                        <li><a href="#tab-reviews">Nhận xét (0)</a></li>
                    </ul>

                    <div class="panel" id="tab-description">
                        <p>{{$sanpham->description}}</p>
                    </div>
                    <div class="panel" id="tab-reviews">
                        <p>Không có nhận xét nào</p>
                    </div>
                </div>
                <div class="space50">&nbsp;</div>
                <div class="beta-products-list">
                    <h4>Sản phẩm tương tự</h4>

                    <div class="row">
                        @foreach($sptuongtu as $sptt)
                        <div class="col-sm-4">
                            <div class="single-item">
                                @if($sptt->promotion_price!=0)
                            <div class="ribbon-wrapper"><div class="ribbon sale">Sale</div></div>
                        @endif
                                <div class="single-item-header">
                                    <a href="#"><img src="Source/image/product/{{$sptt->image}}" alt="" height="200px"></a>
                                </div>
                                <div class="single-item-body">
                                    <p class="single-item-title">{{$sptt->name}}</p>
                                    <p class="single-item-price">
                                        @if($sptt->promotion_price==0)
                                        <span class="flash-sale">{{number_format($sptt->unit_price)}}đ</span>
                                        @elseif($sptt->promotion_price>=0)
                                        <span class="flash-del">{{number_format($sptt->unit_price)}}đ</span>
                                        <span class="flash-sale">{{number_format($sptt->promotion_price)}}đ</span>
                                        @endif
                                    </p>
                                </div>
                                <div class="single-item-caption">
                                    <a class="add-to-cart pull-left" href="{{route('themgiohang',$sptt->id)}}"><i class="fa fa-shopping-cart"></i></a>
                                    <a class="beta-btn primary" href="{{route('chitietsanpham',$sptt->id)}}">Chi tiết <i class="fa fa-chevron-right"></i></a>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        
                    </div>
                    <div class="row">{{$sptuongtu->links()}}</div>
                </div> <!-- .beta-products-list -->
            </div>
            <div class="col-sm-3 aside">
                <div class="widget">
                    <h3 class="widget-title">Bán chạy nhất</h3>
                    <div class="widget-body">
                        <div class="beta-sales beta-lists">
                            <div class="media beta-sales-item">
                                <a class="pull-left" href="#"><img src="Source/assets/dest/images/products/sales/5.png" alt=""></a>
                                <div class="media-body">
                                    Bánh gì đó tui cũm chịu
                                    <span class="beta-sales-price">111,111đ</span>
                                </div>
                            </div>
                            <div class="media beta-sales-item">
                                <a class="pull-left" href="#"><img src="Source/assets/dest/images/products/sales/6.png" alt=""></a>
                                <div class="media-body">
                                    Bánh trứng
                                    <span class="beta-sales-price">180,000đ</span>
                                </div>
                            </div>
                            <div class="media beta-sales-item">
                                <a class="pull-left" href="#"><img src="Source/assets/dest/images/products/sales/7.png" alt=""></a>
                                <div class="media-body">
                                    Bánh trứng sữa
                                    <span class="beta-sales-price">80,000đ</span>
                                </div>
                            </div>
                            <div class="media beta-sales-item">
                                <a class="pull-left" href="#"><img src="Source/assets/dest/images/products/sales/8.png" alt=""></a>
                                <div class="media-body">
                                    Bánh pizza
                                    <span class="beta-sales-price">100,000đ</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- best sellers widget -->
                <div class="widget">
                    <h3 class="widget-title">Sản phẩm mới</h3>
                    <div class="widget-body">
                        <div class="beta-sales beta-lists">
                            <div class="media beta-sales-item">
                                <a class="pull-left" href="#"><img src="Source/assets/dest/images/products/sales/1.png" alt=""></a>
                                <div class="media-body">
                                    Bánh sinh nhật dâu
                                    <span class="beta-sales-price">120,000đ</span>
                                </div>
                            </div>
                            <div class="media beta-sales-item">
                                <a class="pull-left" href="#"><img src="Source/assets/dest/images/products/sales/2.png" alt=""></a>
                                <div class="media-body">
                                    Bánh sinh nhật hồng
                                    <span class="beta-sales-price">150,000đ</span>
                                </div>
                            </div>
                            <div class="media beta-sales-item">
                                <a class="pull-left" href="#"><img src="Source/assets/dest/images/products/sales/3.png" alt=""></a>
                                <div class="media-body">
                                    Bánh Doremon
                                    <span class="beta-sales-price">200,000đ</span>
                                </div>
                            </div>
                            <div class="media beta-sales-item">
                                <a class="pull-left" href="#"><img src="Source/assets/dest/images/products/sales/4.png" alt=""></a>
                                <div class="media-body">
                                    Bánh nướng
                                    <span class="beta-sales-price">20,000đ</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- best sellers widget -->
            </div>
        </div>
    </div> <!-- #content -->
</div> <!-- .container -->
@endsection