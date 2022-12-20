@extends('layout.admin')
@section('add')
<a class="nav-link btn btn-success create-new-button" href="{{route('warehouse.add-receipt')}}">+ Lập Phiếu Mới</a>
@stop()
@section('content')
    <div class="col-md-12 col-sm-12  ">
        <div class="x_panel">
            <div class="x_title">
                <h2>Liệt Kê Phiếu Nhập</h2>
                
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <table class="table table-striped" id="myTable">
                    <thead style="background: palegoldenrod">                       
                        <tr style="border: 1px solid lightgray;">
                            <th style="text-align: center">Mã Đơn</th>
                            <th style="text-align: center">Tên Người Lập</th>
                            <th style="text-align: center">Tổng Giá Tiền</th>
                            <th style="text-align: center">Ngày Lập</th>
                            <th style="text-align: center">Tình Trạng</th>
                            <th style="text-align: center">Thao Tác </th>
                        </tr>                  
                    </thead>
                    <tfoot style="background: palegoldenrod">                       
                        <tr style="border: 1px solid lightgray;">
                            <th style="text-align: center">Mã Đơn</th>
                            <th style="text-align: center">Tên Người Lập</th>
                            <th style="text-align: center">Tổng Giá Tiền</th>
                            <th style="text-align: center">Ngày Lập</th>
                            <th style="text-align: center">Tình Trạng</th>
                            <th style="text-align: center">Thao Tác </th>
                        </tr>                  
                    </tfoot>
                    <tbody style="text-align: center">
                        @foreach ($receipt as $data)
                        <tr style="border: 1px solid lightgray;">
                            <td style="font-size:18px;">{{$data->wr_code}}</td>
                            <td style="font-size:20px;">{{$data->Staff->name}}</td>
                            <td style="font-size:20px;">{{$data->wr_total}}</td>
                            <td style="font-size:18px;">{{$data->wr_date}}</td>
                            <td style="font-size:20px;">
                                @if($data->wr_status == "0")
                                    <button class="btn btn-sm btn-primary">Chưa Duyệt</button>
                                @else
                                    <button class="btn btn-sm btn-danger">Đã Duyệt</button>
                                @endif  
                            </td>  
                           
                            <td>   
                                @if($data->wr_status == "1")
                                <a href="{{route('warehouse.detail',$data->wr_code)}}" class="btn btn-light"><i class="mdi mdi-eye text-primary"></i>Xem Chi Tiết</a>
                                @else
                                <a href="{{route('warehouse.detail',$data->wr_code)}}" class="btn btn-light"><i class="mdi mdi-eye text-primary"></i>Duyệt Phiếu</i></a>
                                <a href="#" data-id="{{$data->wr_id}}" data-delname="phiếu nhập hàng" data-path="/admin/warehouse-del/" class="btn btn-light del"><i class="mdi mdi-close text-danger"></i>Xóa</a>
                                @endif
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

