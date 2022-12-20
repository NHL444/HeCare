
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
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Lịch sử mua hàng</h2>
                        
                        <div class="clearfix"></div>
                    </div>
                    <br>
                    <div class="x_content">
                        <table class="table table-striped">
                            <thead>                       
                                <tr style="border: 1px solid lightgray;">
                                    <th style="text-align: center">Mã Đơn</th>
                                    <th style="text-align: center">Ngày Đặt</th>
                                    <th style="text-align: center">Tình Trạng</th>
                                    <th style="text-align: center">Thao Tác </th>
                                </tr>                  
                            </thead>
                            <tbody style="text-align: center">
                                @foreach ($history as $data)
                                <tr style="border: 1px solid lightgray;">
                                    <td style="font-size:18px;">{{$data->order_code}}</td>
                                    <td style="font-size:18px;">{{$data->order_date}}</td>
                                    <td style="font-size:20px;">
                                        @if($data->order_status == "0")
                                            <h5 style="color: blue;">Đang xử lí</h5>
                                        @elseif($data->order_status == "1")
                                            <h5 style="color: green;">Đã Giao Hàng</h5>
                                        @elseif($data->order_status == "2")
                                            <h5 style="color: orange;">Hết hàng/Đơn Bị Hủy</h5>
                                        @else
                                            <h5 style="color: red;">Đã Hủy Đơn</h5>
                                        @endif  
                                    </td>  
                                    <td>   
                                        <a href="{{route('shop.historyview',$data->order_code)}}" class="btn btn-secondary"><i class="fas fa-eye" style="font-size: 28px; color: darkblue;"></i></a>
                                        <a href="" onclick="return confirm('Bạn có chắc muốn hủy đơn hàng này?')" class="btn btn-secondary"><i class="fas fa-times" style="font-size: 28px; color: red;"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    <br>
                        {{-- {!!$order->links("pagination::bootstrap-4")!!} --}}
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        <!-- Shop Product End -->
    </div>
</div>
@stop