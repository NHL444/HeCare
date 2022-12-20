@extends('layout.shop')
@section('title', 'Shop')
@section('content')
@section('banner')
    <div id="header-carousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active" style="height: 410px;">
                <img class="img-fluid" src="/shop/img/wheyban.jpg" alt="Image">
                <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                    <div class="p-3" style="max-width: 700px;">
                        <h4 class="text-light text-uppercase font-weight-medium mb-3">THÁNG 12 VUI VẺ</h4>
                        <h3 class="display-4 text-white font-weight-semi-bold mb-4">MUA SẮM THẢ GA</h3>
                        <a href="" class="btn btn-light py-2 px-3">MUA NGAY</a>
                    </div>
                </div>
            </div> 
            <div class="carousel-item" style="height: 410px;">
                <img class="img-fluid" src="/shop/img/sport.jpg" alt="Image" >
                <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                    <div class="p-3" style="max-width: 700px;">
                        <h4 class="text-light text-uppercase font-weight-medium mb-3">THÁNG 12 VUI VẺ</h4>
                        <h3 class="display-4 text-white font-weight-semi-bold mb-4">PHỤ KIỆN MỚI NHẤT</h3>
                        <a href="" class="btn btn-light py-2 px-3">MUA NGAY</a>
                    </div>
                </div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#header-carousel" data-slide="prev">
            <div class="btn btn-dark" style="width: 45px; height: 45px;">
                <span class="carousel-control-prev-icon mb-n2"></span>
            </div>
        </a>
        <a class="carousel-control-next" href="#header-carousel" data-slide="next">
            <div class="btn btn-dark" style="width: 45px; height: 45px;">
                <span class="carousel-control-next-icon mb-n2"></span>
            </div>
        </a>
    </div>
@endsection
    <!-- Page Header End -->


    <!-- Shop Detail Start -->
    <div class="container-fluid py-5">
        <div class="row px-xl-5">
            <div class="col-lg-5 pb-5">
                <div id="product-carousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner border">
                       
                        <div class="carousel-item active">
                            <img class="w-100 h-100" src="/image/{{$item->pro_image}}" alt="Image">
                        </div>
                    
                        @foreach($near as $gl)
                        <div class="carousel-item">
                            <img class="w-100 h-100" src="/gallery/{{$gl->gl_image}}" alt="Image">
                        </div>
                        @endforeach
                    </div>
                    <a class="carousel-control-prev" href="#product-carousel" data-slide="prev">
                        <i class="fa fa-2x fa-angle-left text-dark"></i>
                    </a>
                    <a class="carousel-control-next" href="#product-carousel" data-slide="next">
                        <i class="fa fa-2x fa-angle-right text-dark"></i>
                    </a>
                </div>
            </div>

            <div class="col-lg-7 pb-5">
                <h3 class="font-weight-semi-bold" style="color:red;">{{$item->pro_name}}</h3>
                
                <h3 class="font-weight-semi-bold mb-4">{{number_format($item->pro_sell,0,',',',')}}</h3>
                @if(($item->pro_qty) > 1)
                    <div class="badge badge-success mb-2">Còn Hàng</div>
                    <h5 class="mb-4"><strong>Tồn Kho: </strong>{{$item->pro_qty}}</h5>
                    <h5 class="mb-4"><strong>Đã Bán: </strong>{{$item->pro_sold}}</h5>
                @else
                    <div class="badge badge-danger mb-2">Hết Hàng</div>
                @endif
                <p class="mb-4">{{$item->pro_descript}}</p>
                {{-- <div class="d-flex mb-3">
                    <p class="text-dark font-weight-medium mb-0 mr-3">Sizes:</p>
                    <form>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" class="custom-control-input" id="size-1" name="size">
                            <label class="custom-control-label" for="size-1">XS</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" class="custom-control-input" id="size-2" name="size">
                            <label class="custom-control-label" for="size-2">S</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" class="custom-control-input" id="size-3" name="size">
                            <label class="custom-control-label" for="size-3">M</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" class="custom-control-input" id="size-4" name="size">
                            <label class="custom-control-label" for="size-4">L</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" class="custom-control-input" id="size-5" name="size">
                            <label class="custom-control-label" for="size-5">XL</label>
                        </div>
                    </form>
                </div> --}}
    
                <form action="{{route('shop.addfromdetail')}}" method="post">
                    @csrf
                    <div class="d-flex align-items-center mb-4 pt-2">
                        <div class="input-group quantity mr-3" style="width: 130px;">
                            <div class="input-group-btn">
                                <a class="btn btn-primary btn-minus" >
                                <i class="fa fa-minus"></i>
                                </a>
                            </div>
                            <input type="text" name="quantity" class="form-control bg-secondary text-center" value="1">
                            <div class="input-group-btn">
                                <button class="btn btn-primary btn-plus">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <input type="hidden" name="pro_id" value="{{$item->pro_id}}">
                        <button type="submit" class="btn btn-primary px-3"><i class="fa fa-shopping-cart mr-1"></i>Thêm Vào Giỏ Hàng</button>
                    </div>
                </form>
                @if (session('warn'))
                    <div class="alert alert-warning" style="color: red;">
                    <strong>{{ session('warn') }}</strong> 
                    </div>
                @endif
                <div class="d-flex mb-3">
                    @if($star>0)
                    <div id="rate">({{$star}})</div>
                    <p class="pt-1"> ({{round($star,1)}} sao)</p>
                    @else
                    Chưa có đánh giá cho sản phẩm này!
                    @endif
                </div>
                <div class="d-flex pt-2">
                    <p class="text-dark font-weight-medium mb-0 mr-2">Share on:</p>
                    <div class="d-inline-flex">
                        <a class="text-dark px-2" href="">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a class="text-dark px-2" href="">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a class="text-dark px-2" href="">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a class="text-dark px-2" href="">
                            <i class="fab fa-pinterest"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row px-xl-5">
            <div class="col">
                <div class="nav nav-tabs justify-content-center border-secondary mb-4">
                    <a class="nav-item nav-link active" data-toggle="tab" href="#tab-pane-1">Mô Tả</a>
                    <a class="nav-item nav-link" data-toggle="tab" href="#tab-pane-3">Đánh Giá ({{$comment}})</a>
                </div>
                <div class="tab-content" style="width: 80%; margin: auto;">
                    <div class="tab-pane fade show active" id="tab-pane-1" style="text-align:justify;">
                        <h4 class="mb-3"><strong>Mô Tả Sản Phẩm</strong></h4>
                       {!!$item->pro_content!!}
                    </div>

                    <div class="tab-pane fade" id="tab-pane-3">
                        <div class="row">
                       
                            <div class="col-md-6">
                               
                                <form>
                                    @csrf
                                    <input type="hidden" name="comment_product" class="comment_product" value="{{$item->pro_id}}">
                                    <div id="comment"></div>
                                
                            </form>
                            </div>
                       
                            <div class="col-md-6">
                                <h4 class="mb-4">Đánh giá sản phẩm</h4>
                                <p>Đánh giá hiện tại *: {{number_format($star,1,',',',')}} sao</p>
                                <div class="d-flex my-3">
                                    <p class="mb-0 mr-2">Đánh giá của bạn * :</p>
                                    <form action="{{route('shop.rating')}}" method="POST" id="saverating">
                                        @csrf
                                    <?php 
                                        $cus_id= Session::get('cus_id');
                                        if($cus_id!=NULL){
                                        ?>
                                           <div id="rateYo"></div>
                                        <?php }else{ ?>
                                            <div id="warning"></div>
                                        <?php } ?>
                                       
                                            <div class="form-group">                           
                                                <input type="hidden" class="form-control" name="rating_vote" id="rating">
                                                <input type="hidden" class="form-control" name="rating_pro" value={{$item->pro_id}}>
                                                <input type="hidden" class="form-control" name="rating_cus" value={{Session::get('cus_id')}}>
                                            </div>
                                        </form>
                                    
                                </div>
                                <form>
                                    @csrf
                                    <div class="form-group">
                                        <label for="message">Nội Dung Đánh Giá</label>
                                        <textarea id="message" cols="30" rows="5" class="form-control message"></textarea>
                                    </div>
                                    {{-- <div class="form-group">
                                        <label for="name">Bạn Là Ai?</label> --}}
                                        <input type="hidden" class="form-control name" id="name" value={{Session::get('cus_id')}}>
                                    {{-- </div> --}}
                                    <?php 
                                        $cus_id= Session::get('cus_id');
                                        if($cus_id!=NULL){
                                        ?>
                                    <div class="form-group mb-0">
                                        <input type="button" value="Xác Nhận" class="btn btn-primary px-3 send-comment">
                                    </div>
                                    <div class="success"></div>
                                    <?php }else{ ?>
                                    <div><a href="{{route('shop.logincheck')}}">Hãy đăng nhập để đánh giá sản phẩm</a></div>
                                    <?php }?>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Shop Detail End -->


    <!-- Products Start -->
    <div class="container-fluid py-5">
        <div class="text-center mb-4">
            <h2 class="section-title px-5"><span class="px-2">Sản Phẩm Tương Tự</span></h2>
        </div>
        <div class="row px-xl-5">
            <div class="col">
                <div class="owl-carousel related-carousel">
                    @foreach($related as $val)
                    <div class="card product-item border-0">
                        <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                            <img class="img-fluid w-100" src="/image/{{$val->pro_image}}" alt="">
                        </div>
                        <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                            <h6 class="text-truncate mb-3">{{$val->pro_name}}</h6>
                            <div class="d-flex justify-content-center">
                                <h6 style="font-size: 20px; font-weight:bold;">{{number_format($val->pro_sell,0,',',',')}}</h6>
                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-between bg-light border">
                            <a href="{{asset('/shop/detail/'.$val->pro_id)}}" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>Xem Chi Tiết</a>
                            <a href="{{asset('cart/add/'.$val->pro_id)}}" class="btn btn-sm text-dark p-0"><i class="fas fa-shopping-cart text-primary mr-1"></i>Thêm Vào Giỏ Hàng</a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>
@stop()
@section('js')
<script>
    $(function () {
        let avgStar = '{{$star}}';
        $("#rateYo").rateYo({
            rating: avgStar,
            starWidth: "20px",
            spacing: "10px"
            }).on("rateyo.set", function (e, data) {
                $('#rating').val(data.rating);
                $('#saverating').submit();
        });
        $("#rate").rateYo({
            rating: avgStar,
            starWidth: "20px",
            spacing: "10px"
            });
        $("#warning").rateYo({
            rating: avgStar,
            starWidth: "20px",
            spacing: "10px"
            }).on("rateyo.set", function (e, data) {
                alert("Bạn chưa đăng nhập, để đánh giá vui lòng đăng nhập.");
        });
          
    });
</script>
@stop()