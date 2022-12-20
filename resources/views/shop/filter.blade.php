
        <?php if($product==NULL){?>
            Không tìm thấy sản phẩm phù hợp!
        <?php } else{ ?>
        @include('shop.structure.searchfor')
        
        @foreach($product as $val)
        <div class="col-lg-4 col-md-6 col-sm-12 pb-1">
            <div class="card product-item border-0 mb-4">
                <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                    <img class="img-fluid w-100" src="/image/{{$val->pro_image}}" alt="">
                </div>
                <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                    <h6 class="text-truncate mb-3" style="font-size: 20px; color:red;">{{$val->pro_name}}</h6>
                    <div class="d-flex justify-content-center">
                        <h6 style="font-size: 20px; font-weight:bold;">{{number_format($val->pro_sell,0,',',',')}}</h6>
                        {{-- <h6 class="text-muted ml-2"><del>$123.00</del></h6> --}}
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-between bg-light border">
                    <a href="{{asset('/shop/detail/'.$val->pro_id)}}" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>Xem Chi Tết</a>
                    <a href="{{asset('cart/add/'.$val->pro_id)}}" class="btn btn-sm text-dark p-0"><i class="fas fa-shopping-cart text-primary mr-1"></i>Thêm Vào Giỏ Hàng</a>
                </div>
            </div>
        </div>
        @endforeach
        <div class="col-12 pb-1 ">
            {!!$product->links("pagination::bootstrap-4")!!}
        </div>
        <?php }?>
