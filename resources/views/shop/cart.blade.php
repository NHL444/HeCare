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



    <div class="container-fluid pt-5">
        <div class="row px-xl-5">
            @if(Cart::content()->count())
                <div class="col-lg-8 table-responsive mb-5">
                    <table class="table table-bordered text-center mb-0">
                        <thead class="bg-secondary text-dark">
                            <tr>
                                <th>Tên Sản Phẩm</th>
                                <th>Giá</th>
                                <th>Số Lượng</th>
                                <th>Tổng</th>
                                <th>Xóa</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cart as $data)
                            <tr>
                                <td style="text-align:left;"><img src="/image/{{$data->options ->img}}" alt="" style="width:50px;"> {{$data->name}}</td>
                                <td class="align-middle">{{number_format($data->price,0,',',',')}}</td>
                                <td class="align-middle">
                                    <div class="input-group quantity mx-auto" style="width: 100px;">
                                        <form action="{{URL::to('cart/update')}}" method="POST">
                                        @csrf
                                            <input type="text" class="quantity" name="quantity" value="{{$data->qty}}" size="2" style="text-align: center;">
                                            <input type="hidden" value="{{$data->rowId}}" name="rowId_cart" class="form-control">
                                            <input type="submit" value="Cập Nhật" name="update_qty" class="btn btn-default">
                                            {{-- <input type="text" class="form-control form-control-sm bg-secondary text-center" value="1"> --}}
                                        </form>
                                    </div>
                                </td>
                                <td class="align-middle">{{number_format($data->price*$data->qty,0,',',',')}}</td>
                                <td class="align-middle"><a href="{{asset('cart/delete/'.$data->rowId)}}"><i class="fa fa-times"></i></a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <a href="{{asset('cart/delete/all')}}" class="btn btn-block btn-primary my-3 py-3">Xóa Hết</a>                  
                </div>
                <div class="col-lg-4">
                    <div class="card border-secondary mb-5">
                        <div class="card-header bg-secondary border-0">
                            <h4 class="font-weight-semi-bold m-0">Tổng Mua</h4>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-3 pt-1">
                                <h6 class="font-weight-medium">Đơn Giá</h6>
                                <h6 class="font-weight-medium">{{$ptotal.' '.'VND'}}</h6>
                            </div>
                            <div class="d-flex justify-content-between">
                                <h6 class="font-weight-medium">Phí Vận Chuyển</h6>
                                <h6 class="font-weight-medium">{{number_format(Session::get('fee'),0,',',',')}} VND</h6>
                            </div>
                        </div>
                        <div class="card-footer border-secondary bg-transparent">
                            <div class="d-flex justify-content-between mt-2">
                                <h5 class="font-weight-bold">Tạm Tính</h5>
                                <h5 class="font-weight-bold">{{number_format($total,0,',',',')}} VND</h5>
                            </div>

                            {{-- Thanh Toán --}}
                            <?php 
                            $cus_id= Session::get('cus_id');
                            $ship_id= Session::get('ship_id');
                            if($cus_id!=NULL && $ship_id==NULL){
                            ?>
                                <a href="{{route('shop.checkform')}}" class="btn btn-block btn-primary my-3 py-3">Thanh Toán</a>
                            <?php }elseif($cus_id!=NULL && $ship_id!=NULL){ ?>
                                <a href="{{route('shop.payment')}}" class="btn btn-block btn-primary my-3 py-3">Thanh Toán</a>
                            <?php }else{ ?>
                                <a href="{{route('shop.logincheck')}}" class="btn btn-block btn-primary my-3 py-3">Thanh Toán</a>
                            <?php } ?>
                            
                            {{-- Kết Thúc --}}
                            <a href="{{route('shop.shopping')}}" class="btn btn-block btn-primary my-3 py-3">Tiếp Tục Mua Hàng</a>
                        </div>
                    </div>
                </div>
            @else
                <div class="col-lg-12 table-responsive mb-5">
                    <table class="table table-bordered text-center mb-0">
                        <thead class="bg-secondary text-dark">
                            <tr>
                                <th>Tên Sản Phẩm</th>
                                <th>Giá</th>
                                <th>Số Lượng</th>
                                <th>Tổng</th>
                                <th>Xóa</th>
                            </tr>
                        </thead>  
                    <div class="alert alert-warning">Giỏ Hàng Trống. <a href="{{route('shop.shopping')}}"> Tiếp Tục Mua Sắm</a></div>
                @endif
        </div>
    </div>

@stop




    <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>

