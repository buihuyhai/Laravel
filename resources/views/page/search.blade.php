@extends('master')
@section('content')
<div class="container">
    <div id="content" class="space-top-none">
    <div class="main-content">
    <div class="space60">&nbsp;</div>
    <div class="row">
        <div class="col-sm-12">
            <div class="beta-products-list">
                <h4>Tìm Kiếm</h4>
                <div class="beta-products-details">
                    <p class="pull-left">Tìm thấy {{count($product)}} sản phẩm</p>
                    <div class="clearfix"></div>
                </div>
    
                <div class="row">
                @foreach($product as $new)
                <div class="col-sm-3">
                    <div class="single-item">
                        @if($new->promotion_price!=0)
                            <div class="ribbon-wrapper"><div class="ribbon sale">Sale</div></div>
                        @endif
                        <div class="single-item-header">
                            <a href="{{route('chitietsanpham',$new->id)}}"><img src="Source/image/product/{{$new->image}}" alt="" height="200px"></a>
                        </div>
                        <div class="single-item-body">
                            <p class="single-item-title">{{$new->name}}</p>
                            <p class="single-item-price">
                                @if($new->promotion_price==0)
                                <span class="flash-sale">{{number_format($new->unit_price)}}đ</span>
                                @elseif($new->promotion_price>=0)
                                <span class="flash-del">{{number_format($new->unit_price)}}đ</span>
                                <span class="flash-sale">{{number_format($new->promotion_price)}}đ</span>
                                @endif
                            </p>
                        </div>
                        <div class="single-item-caption">
                            <a class="add-to-cart pull-left" href="{{route('themgiohang',$new->id)}}"><i class="fa fa-shopping-cart"></i></a>
                            <a class="beta-btn primary" href="{{route('chitietsanpham',$new->id)}}" style="margin-bottom: 5px">Chi tiết <i class="fa fa-chevron-right"></i></a>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
                    @endforeach
                </div>
                
            </div> <!-- .beta-products-list -->
    
            <div class="space50">&nbsp;</div>
        </div>
    </div>
    </div>
    </div> 
</div><!-- end section with sidebar and main content -->
@endsection