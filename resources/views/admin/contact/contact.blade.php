@extends('layout.admin')
@section('content')
    <div class="col-md-12 col-sm-12  ">
        <div class="x_panel">
            <div class="x_title">
                <h2>Phản Hồi Từ Khách</h2>                
                <div class="clearfix"></div>
            </div>
            @if(\Session::has('success'))
                <div class="succWrap"><strong>Thành Công</strong>: {{ \Session::get('success') }}</div>
            @endif
            <div class="x_content">
                <table class="table table-striped" id="myTable">
                    <thead style="background: palegoldenrod">                       
                        <tr style="border: 1px solid lightgray;">
                            <th style="text-align: center">Khách Hàng</th>
                            <th style="text-align: center">Email</th>
                            <th style="text-align: center">Số Điện Thoại</th>
                            <th style="text-align: center">Nội Dung</th>
                            <th style="text-align: center">Trạng Thái</th>
                            <th style="text-align: center">Xóa</th>
                        </tr>                  
                    </thead>
                    <tfoot style="background: palegoldenrod">                       
                        <tr style="border: 1px solid lightgray;">
                            <th style="text-align: center">Khách Hàng</th>
                            <th style="text-align: center">Email</th>
                            <th style="text-align: center">Số Điện Thoại</th>
                            <th style="text-align: center">Nội Dung</th>
                            <th style="text-align: center">Trạng Thái</th>
                            <th style="text-align: center">Xóa</th>
                        </tr>                  
                    </tfoot>
                    <tbody style="text-align: center">
                        @foreach ($cont as $data)
                        <tr style="border: 1px solid lightgray;">
                            <td style="font-size:20px;">{{$data->cont_name}}</td>
                            <td style="font-size:20px;">{{$data->cont_email}}</td>
                            <td style="font-size:20px;">{{$data->cont_phone}}</td>
                            <td style="font-size:20px;">{{$data->cont_content}}</td>
                            <td>
                            @if($data->cont_status == 1)
                                <a href="{{url('/admin/cont-status/'.$data->cont_id)}}" class="btn btn-sm btn-success">Đã Xem</a>
                            @else 
                                <a href="{{url('/admin/cont-status/'.$data->cont_id)}}" class="btn btn-sm btn-danger">Xác Nhận</a>
                            @endif  
                            </td>                            
                            <td>
                                <a href="{{route('cont.contdel',$data->cont_id)}}" onclick="return confirm('Bạn có chắc muốn xóa ?')" class="btn btn-secondary"><i class="mdi mdi-delete" style="font-size: 28px; color: red;"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
@endsection
