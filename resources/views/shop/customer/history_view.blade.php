
@extends('layout.shop')
@section('title', 'Shop')
@section('content')
    @section('banner')
        <div class="container-fluid bg-secondary mb-5">
            <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
                <h1 class="font-weight-semi-bold text-uppercase mb-3">Khách Hàng</h1>
                <div class="d-inline-flex">
                    <p class="m-0"><a href="">Trang Chủ</a></p>
                    <p class="m-0 px-2">-</p>
                    <p class="m-0">Khách hàng</p>
                </div>
            </div>
        </div>
    @endsection
<!-- Page Header End -->


<!-- Shop Start -->
<div class="container-fluid pt-5">
    <div class="row px-xl-5">

        <div class="col-lg-3 col-md-12">

            <div class="border-bottom mb-4 pb-4">
                <h5 class="font-weight-semi-bold mb-4">Lọc Giá</h5>
                <form>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input" checked id="price-all">
                        <label class="custom-control-label" for="price-all">Mức Giá</label>
                        <span class="badge border font-weight-normal">1000</span>
                    </div>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input" id="price-1">
                        <label class="custom-control-label" for="price-1">0 - 100.000</label>
                        <span class="badge border font-weight-normal">150</span>
                    </div>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input" id="price-2">
                        <label class="custom-control-label" for="price-2">100.000 - 500.000</label>
                        <span class="badge border font-weight-normal">295</span>
                    </div>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input" id="price-3">
                        <label class="custom-control-label" for="price-3">500.000 - 1.000.000</label>
                        <span class="badge border font-weight-normal">246</span>
                    </div>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input" id="price-4">
                        <label class="custom-control-label" for="price-4">>1.000.000</label>
                        <span class="badge border font-weight-normal">145</span>
                    </div>
                </form>
            </div>

            <div class="border-bottom mb-4 pb-4">
                <h5 class="font-weight-semi-bold mb-4">Thương Hiệu</h5>
                @foreach($brand as $val)
                <div class="custom-control d-flex align-items-center justify-content-between mb-3">
                    <input type="checkbox" class="custom-control-input">
                    <label class="custom-control-label">{{$val->br_name}}</label>
                </div>
                @endforeach
            </div>
         
        </div>
   

        <!-- Shop Product Start -->
        <div class="col-lg-9 col-md-12">
            <div class="col-md-12 col-sm-12  ">
                <div class="x_panel">
                    <div class="x_title" style="color: black;">
                        <h3>Thông Tin Vận Chuyển</h3>
                        
                        <div class="clearfix"></div>
                    </div>
                    <br>
                    <div class="x_content">
                        <table class="table table-striped">
                            <thead style="border: 1px solid lightgray; ">                       
                                <tr style="text-align: center;">
                                    <th style="font-size:20px;">Tên Người Nhận</th>
                                    <th style="font-size:20px;">Số Điện Thoại</th>
                                    <th style="font-size:20px;">Địa chỉ giao hàng</th>
                                </tr>                  
                            </thead>
                            <tbody style="text-align: center">
                                <tr style="border: 1px solid lightgray;">
                                    <td style="font-size:18px;">{{$ship->ship_name}}</td>
                                    <td style="font-size:18px;">{{$ship->ship_phone}}</td>
                                    <td style="font-size:18px;">{{$ship->ship_address}}, {{$ship->Commune->commune_name}}, {{$ship->District->district_name}}, {{$ship->Province->province_name}}</td>
        
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <br>
            <div class="col-md-12 col-sm-12  ">
                <div class="x_panel">
                    <div class="x_title">
                        <h3>Danh Sách Giỏ Hàng</h3>
                        
                        <div class="clearfix"></div>
                    </div>
                    <br>
                    <div class="x_content">
                        <table class="table table-striped">
                            <thead style="border: 1px solid lightgray; font-size:20px;">                       
                                <tr style="text-align: center;">
                                    <th style="font-size:20px;">Tên Sản Phẩm</th>
                                    <th style="font-size:20px;">Số Lượng</th>
                                    <th style="font-size:20px;">Giá </th>
                                    <th style="font-size:20px;">Tổng</th>
                                </tr>                 
                            </thead>
                            <tbody style="text-align: center">
                                
                                @foreach ($cart as $data)
                                <tr style="border: 1px solid lightgray;" >
                                    <td style="font-size:18px;">{{$data->odl_proname}}</td>
                                    <td style="font-size:18px;">{{$data->odl_qty}}</td>
                                    <td style="font-size:18px;">{{number_format($data->odl_price,0,',',',')}}</td>
                                    <td style="font-size:18px;">{{number_format($data->odl_price*$data->odl_qty,0,',',',')}}</td>        
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    <br>
                    <div class="total-data" style="text-align: right; font-size:18px;padding-right: 20px;">
                        <h5 style="color:green;"><strong  style="color: black;">Phí Vận Chuyển: </strong>{{number_format($data->order_fee,0,',',',').' '.'VND'}}</h5>
                        <h5 style="color:green;"><strong  style="color: black;">Tổng Tiền: </strong>{{number_format($data->order_total,0,',',',').' '.'VND'}}</h5>
                        <h5 style="color: green;"><strong style="color: black;">Hình Thức Thanh Toán: </strong>{{$pay->pay_method}}</h5>
                    </div>
                    <a href="{{route('shop.history')}}" class="btn btn-primary"><i class="fas fa-back"></i> Quay Lại</a>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
    </div>
</div>
@stop