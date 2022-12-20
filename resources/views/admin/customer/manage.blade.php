@extends('layout.admin')
@section('content')
    <div class="col-md-12 col-sm-12  ">
        <div class="x_panel">
            <div class="x_title">
                <h2>Tài Khoản Khách</h2>
                
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <table class="table table-striped" id="myTable">
                    <thead style="background: palegoldenrod">                       
                        <tr style="border: 1px solid lightgray;">
                            <th style="text-align: center">Tên Khách Hàng</th>
                            <th style="text-align: center">Tài Khoản</th>
                            <th style="text-align: center">Số Đơn Đã Đặt</th>
                            <th style="text-align: center">Xóa Tài Khoản</th>
                        </tr>                  
                    </thead>
                    <tfoot style="background: palegoldenrod">                       
                        <tr style="border: 1px solid lightgray;">
                            <th style="text-align: center">Tên Khách Hàng</th>
                            <th style="text-align: center">Tài Khoản</th>
                            <th style="text-align: center">Số Đơn Đã Đặt</th>
                            <th style="text-align: center">Xóa Tài Khoản</th>
                        </tr>                  
                    </tfoot>
                    <tbody style="text-align: center">
                        @foreach ($data as $data)
                        <tr style="border: 1px solid lightgray;">
                            <td style="font-size:18px;">{{$data->cus_name}}</td>
                            <td style="font-size:20px;">{{$data->cus_email}}</td>
                            <td style="font-size:18px;">{{$data->orders->count()}} đơn</td>
                            <td>   
                                <a href="{{route('customer.del',$data->cus_id)}}" onclick="return confirm('Bạn có chắc muốn xóa đơn hàng này?')" class="btn btn-secondary"><i class="mdi mdi-delete" style="font-size: 28px; color: red;"></i></a>
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
