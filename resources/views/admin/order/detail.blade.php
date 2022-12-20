@extends('layout.admin')
@section('add')
    <a class="nav-link btn btn-warning create-new-button" href="{{route('order.index')}}"><<< Trang Đơn Hàng</a>
@stop()
<style>   
    .x_title , .total-data {
        background: #edf55f;

    }
    .x_title h2{
        padding-top:10px; 
        
    }
</style>
@section('content')
    <div class="col-md-12 col-sm-12  ">
        <div class="x_panel">
            <div class="x_title">
                <h2>Tài Khoản Thực Hiện Mua</h2>
                
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <table class="table table-striped">
                    <thead style="border: 1px solid lightgray; ">                       
                        <tr style="text-align: center;">
                            <th style="font-size:20px;">Tên Tài Khoản</th>
                            <th style="font-size:20px;">Email</th>
                            <th style="font-size:20px;">Số Điện Thoại</th>
                        </tr>                  
                    </thead>
                    <tbody style="text-align: center">
                        <tr style="border: 1px solid lightgray;">
                            <td style="font-size:18px;">{{$data->cus_name}}</td>
                            <td style="font-size:18px;">{{$data->cus_email}}</td>
                            <td style="font-size:18px;">{{$data->cus_phone}}</td>

                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <br>
    <div class="col-md-12 col-sm-12  ">
        <div class="x_panel">
            <div class="x_title" style="color: black;">
                <h2>Thông Tin Vận Chuyển</h2>
                
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <table class="table table-striped">
                    <thead style="border: 1px solid lightgray; ">                       
                        <tr style="text-align: center;">
                            <th style="font-size:20px;">Tên Người Nhận</th>
                            <th style="font-size:20px;">Số Điện Thoại</th>
                            <th style="font-size:20px;">Địa chỉ Giao</th>
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
                <h2>Danh Sách Giỏ Hàng</h2>
                
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <table class="table table-striped">
                    <thead style="border: 1px solid lightgray; font-size:20px;">                       
                        <tr style="text-align: center;">
                            <th style="font-size:20px;">Tên Sản Phẩm</th>
                            <th style="font-size:20px;">Tồn Kho</th>
                            <th style="font-size:20px;">Số Lượng</th>
                            <th style="font-size:20px;">Giá </th>
                            <th style="font-size:20px;">Tổng Tiền</th>
                        </tr>                 
                    </thead>
                    <tbody style="text-align: center">
                        
                        @foreach ($cart as $data)
                        <tr style="border: 1px solid lightgray;" >
                            <td style="font-size:18px;">{{$data->odl_proname}}</td>
                            <td style="font-size:20px;" class="warning_{{$data->odl_pro}}">{{$data->Product()->first()->pro_qty}}</td>
                            <td style="font-size:18px;">
                                <input type="number" class="order_qty_{{$data->odl_pro}}" name="quantity" value="{{$data->odl_qty}}" name="qty" style="text-align:center;">
                                <input type="hidden" class="order_stock_{{$data->odl_pro}}" value="{{$data->Product->pro_qty}}">
                                <input type="hidden" name="order_pro_id" value="{{$data->odl_pro}}">
                            </td>
                            <td style="font-size:18px;">{{number_format($data->odl_price,0,',',',')}}</td>
                            <td style="font-size:18px;">{{number_format($data->odl_price*$data->odl_qty,0,',',',')}}</td>        
                        </tr>
                        @endforeach
                        <tr>
                            
                            <td colspan="3">
                            @foreach($code as $val)
                                @if($val->order_status==0)
                                <form >
                                    @csrf
                                    <select class="form-control order_status" style="border: 1px solid;  font-weight:bold; height:50px;">
                                        <option id="{{$val->order_id}}" style="color: blue;" selected value="0">Chưa xử lý</option>
                                        <option id="{{$val->order_id}}" value="1">Đã đưa đến nơi vận chuyển</option>
                                    </select>
                                </form>
                                @elseif($val->order_status==1)
                                <form>
                                    @csrf
                                    <select class="form-control order_status" style="border: 1px solid; font-weight:bold; height:50px;">
                                        <option id="{{$val->order_id}}" style="color: green;" selected value="1">Đã đưa đến nơi vận chuyển</option>
                                        <option id="{{$val->order_id}}" value="2">Hủy đơn - Tạm giữ</option>
                                    </select>
                                </form>
                                @else
                                <form>
                                    @csrf
                                    <select class="form-control order_status" style="border: 1px solid; font-weight:bold; height:50px;">
                                        <option id="{{$val->order_id}}" value="1">Đã đưa đến nơi vận chuyển</option>
                                        <option id="{{$val->order_id}}" selected value="2">Hủy đơn - Tạm giữ</option>
                                    </select>
                                </form>
                                @endif
                                @endforeach
                        </td>
                        </tr>
                    </tbody>
                </table>
            <br>
            <div class="total-data" style="text-align: right; font-size:18px;padding-right: 20px;">
                <h3 style="color:red;"><strong  style="color: black;">Phí Vận Chuyển: </strong>{{number_format($data->order_fee,0,',',',').' '.'VND'}}</h3>
                <h3 style="color:red;"><strong  style="color: black;">Tổng Tiền: </strong>{{number_format($data->order_total,0,',',',').' '.'VND'}}</h3>
                <h3 style="color: red;"><strong style="color: black;">Hình Thức Thanh Toán: </strong>{{$pay->pay_method}}</h3>
            </div>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
@endsection
