@extends('layout.admin')
@section('content')
    <div class="col-md-12 col-sm-12  ">
        <div class="x_panel">
            <div class="x_title">
                <h2>Liệt Kê Đơn Hàng</h2>
                
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <table class="table table-striped" id="myTable">
                    <thead style="background: palegoldenrod">                       
                        <tr style="border: 1px solid lightgray;">
                            <th style="text-align: center">Mã Đơn</th>
                            <th style="text-align: center">Tên Người Đặt</th>
                            <th style="text-align: center">Tổng Giá Tiền</th>
                            <th style="text-align: center">Ngày Đặt</th>
                            <th style="text-align: center">Tình Trạng</th>
                            <th style="text-align: center">Chỉnh Bởi</th>
                            <th style="text-align: center">Thao Tác </th>
                        </tr>                  
                    </thead>
                    <tfoot style="background: palegoldenrod">                       
                        <tr style="border: 1px solid lightgray;">
                            <th style="text-align: center">Mã Đơn</th>
                            <th style="text-align: center">Tên Người Đặt</th>
                            <th style="text-align: center">Tổng Giá Tiền</th>
                            <th style="text-align: center">Ngày Đặt</th>
                            <th style="text-align: center">Tình Trạng</th>
                            <th style="text-align: center">Chỉnh Bởi</th>
                            <th style="text-align: center">Thao Tác </th>
                        </tr>                  
                    </tfoot>
                    <tbody style="text-align: center">
                        @foreach ($data as $data)
                        <tr style="border: 1px solid lightgray;">
                            <td style="font-size:18px;">{{$data->order_code}}</td>
                            <td style="font-size:20px;">{{$data->cus_name}}</td>
                            <td style="font-size:20px;">{{number_format($data->order_total,0,',',',')}}</td>
                            <td style="font-size:18px;">{{$data->order_date}}</td>
                            <td style="font-size:20px;">
                                @if($data->order_status == "0")
                                    <a href="{{url('/admin/order-status/'.$data->order_id)}}" class="btn btn-sm btn-primary">Đang Xử Lý</a>
                                @elseif($data->order_status == "1")
                                    <a href="{{url('/admin/order-status/'.$data->order_id)}}" class="btn btn-sm btn-success">Đã Giao Hàng</a>
                                @else
                                    <a href="{{url('/admin/order-status/'.$data->order_id)}}" class="btn btn-sm btn-danger">Đã Hủy Đơn</a>
                                @endif  
                            </td>
                            <td>
                                @if($data->order_staff == "0")
                                <button class="btn btn-sm btn-primary">Đơn Mới</button>
                                @else
                                <button class="btn btn-sm badge-warning">{{$data->Staff->name}}</button>
                                @endif

                            </td>  
                            <td>   
                                <a href="{{route('order.detail',$data->order_code)}}" class="btn btn-secondary"><i class="mdi mdi-eye" style="font-size: 28px; color: darkblue;"></i></a>
                                <a href="#" data-id="{{$data->order_code}}" data-delname="đơn hàng" data-path="/admin/order-del/" class="btn btn-secondary del"><i class="mdi mdi-delete" style="font-size: 28px; color: red;"></i></a>
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
@endsection
