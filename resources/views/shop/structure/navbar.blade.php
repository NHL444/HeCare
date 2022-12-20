<div class="container-fluid mb-5">
    <div class="row border-top px-xl-5">
        <div class="col-lg-3 d-none d-lg-block">
            <a class="btn shadow-none d-flex align-items-center justify-content-between bg-primary text-white w-100" data-toggle="collapse" href="#navbar-vertical" style="height: 65px; margin-top: -1px; padding: 0 30px;">
                <h6 class="m-0" style="font-weight: bold;">Danh Mục Sản Phẩm</h6>
                <i class="fa fa-angle-down text-dark"></i>
            </a>
            <nav class="collapse show navbar navbar-vertical navbar-light align-items-start p-0 border border-top-0 border-bottom-0" id="navbar-vertical">
                <div class="navbar-nav w-100 overflow-hidden" style="height: 300px">
                    @foreach($catename as $val)
                    <div class="nav-item dropdown">
                        @if($val->cate_parent==0)
                        <a class="nav-link" href="{{asset('shop/category/'.$val->cate_id.'/'.$val->cate_slug.'.html')}}" data-toggle="dropdown">{{$val->cate_name}}<i class="fa fa-angle-down float-right mt-1"></i></a>
                            @foreach($catename as $key => $g)
                            @if( $val->cate_id == $g->cate_parent)
                            <div class="dropdown-menu position-absolute bg-secondary border-0 rounded-0 w-100 m-0">
                                @foreach($catename as $key => $data)
                                    @if($data->cate_parent==$val->cate_id)
                                        <a class="dropdown-item" href="{{asset('shop/category/'.$data->cate_id.'/'.$data->cate_slug.'.html')}}"><i class="fa fa-angle-right float-left mt-1"></i>&nbsp;{{$data->cate_name}}</a>
                                    @endif
                                @endforeach     
                            </div>                                              
                             @endif
                        @endforeach 
                        @endif
                    </div>
                    @endforeach
                </div>
            </nav>
        </div>
        <div class="col-lg-9">
            <nav class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-0">
                <a href="" class="text-decoration-none d-block d-lg-none">
                    <h1 class="m-0 display-5 font-weight-semi-bold"><span class="text-primary font-weight-bold border px-3 mr-1">E</span>Shopper</h1>
                </a>
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                    <div class="navbar-nav mr-auto py-0">
                        <a href="{{route('shop.homepage')}}" class="nav-item nav-link active">Trang Chủ</a>
                        <a href="{{route('shop.shopping')}}" class="nav-item nav-link">Shop</a>
                        <?php 
                        $cus_id= Session::get('cus_id');
                        $ship_id= Session::get('ship_id');
                        if($cus_id!=NULL && $ship_id==NULL){
                        ?>
                            <a href="{{route('shop.checkform')}}" class="nav-item nav-link">Thanh Toán</a>
                        <?php }elseif($cus_id!=NULL && $ship_id!=NULL){ ?>
                            <a href="{{route('shop.payment')}}" class="nav-item nav-link">Thanh Toán</a>
                        <?php }else{ ?>
                            <a href="{{route('shop.logincheck')}}" class="nav-item nav-link">Thanh Toán</a>
                        <?php } ?>
                        <a href="{{route('home.index')}}" class="nav-item nav-link">Kiến Thức</a>                     
                    </div>
                    <div class="navbar-nav ml-auto py-0">

                        <?php 
                        $cus_id= Session::get('cus_id');
                        $cus_name= Session::get('cus_name');
                        if($cus_id!=NULL){
                        ?>
                            <a href="{{route('shop.history')}}" class="nav-item nav-link">Lịch Sử Mua Hàng</a>
                            <div class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">{{$cus_name}}</a>
                                <div class="dropdown-menu rounded-0 m-0">
                                    <a href="{{route('shop.profile')}}" class="dropdown-item">Hồ Sơ</a>                                 
                                    <a href="{{route('shop.logout')}}" class="dropdown-item">Đăng Xuất</a>
                                </div>
                            </div>
                        
                        <?php }else{ ?>
                            <a href="{{route('shop.logincheck')}}" class="nav-item nav-link">Đăng Nhập</a>
                        <?php } ?>
                    </div>
                </div>
            </nav>
            @yield('banner')
        </div>
    </div>
</div>