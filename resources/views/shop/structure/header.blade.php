<div class="container-fluid">
        
    <div class="row align-items-center py-3 px-xl-5" style="background: black">
        <div class="col-lg-3 d-none d-lg-block">
            <a href="" class="text-decoration-none">
                <h1 class="m-0 display-5 font-weight-semi-bold" style="color: springgreen;"><span class="text-primary font-weight-bold border px-3 mr-1">HeCare</span >Shop</h1>
            </a>
        </div>
        <div class="col-lg-6 col-6 text-left">
            <form action="{{url('/shop/search')}}" method="GET">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Nhập Tên Sản Phẩm Cần Tìm" name="key">
                    <div class="input-group-append" type="submit">
                        <button class="input-group-text bg-transparent text-primary" type="submit">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>
            <div id="showli"></div>
        </div>
        <div class="col-lg-3 col-6 text-right">
            <a href="" class="btn border">
                <i class="fas fa-heart text-primary"></i>
                <span class="badge">0</span>
            </a>
            <a href="{{asset('cart/show')}}" class="btn border">
                <i class="fas fa-shopping-cart text-primary"></i>
                <span class="badge">{{Cart::content()->count()}}</span>
            </a>
        </div>
    </div>
</div>