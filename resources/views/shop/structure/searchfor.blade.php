<div class="col-12 pb-1">
    <div class="d-flex align-items-center justify-content-between mb-4">
        <form action="{{url('/shop/search')}}" method="GET">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Sản phẩm cần tìm" name="key">
                <div class="input-group-append">
                    <button class="input-group-text bg-transparent text-primary" type="submit">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
            </div>
        </form>
        <div class="dropdown ml-4">
            <button class="btn border dropdown-toggle" type="button" id="triggerId" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                        Lọc
                    </button>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="triggerId">
                <a class="dropdown-item" href="{{route('shop.discount')}}">Đang Khuyến Mãi</a>
                <a class="dropdown-item" href="{{route('shop.selling')}}">Mới Nhất</a>
                <a class="dropdown-item" href="{{route('shop.selling')}}">Bán Chạy</a>
            </div>
        </div>
    </div>
    @if(\Session::has('success'))
                <div class="succWrap"><strong>Thành Công</strong>: {{ \Session::get('success') }}&nbsp;<a href="{{asset('cart/show')}}"><i class="fas fa-shopping-cart text-primary">&nbsp;</i>Đến Giỏ Hàng.</a></div>
             @endif
</div>