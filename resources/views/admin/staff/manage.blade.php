@extends('layout.admin')
@section('add')
    <a class="nav-link btn btn-success create-new-button" href="{{route('staff.create')}}">+ Thêm Tài Khoản</a>
@stop()
@section('content')
    <div class="col-md-12 col-sm-12  ">
        <div class="x_panel">
            <div class="x_title">
                <h2>Danh Sách Tài Khoản</h2>
                
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <table class="table table-striped" id="myTable">
                    <thead style="background: palegoldenrod">                       
                        <tr style="border: 1px solid lightgray;">
                            <th style="text-align: center">Tên Nhân Viên</th>
                            <th style="text-align: center">Tài Khoản</th>
                            <th style="text-align: center">Số Điện Thoại</th>
                            <th style="text-align: center">Tài Khoản Được Cấp</th>
                            <th style="text-align: center">Xóa Tài Khoản</th>
                        </tr>                  
                    </thead>
                    <tfoot style="background: palegoldenrod">                       
                        <tr style="border: 1px solid lightgray;">
                            <th style="text-align: center">Tên Nhân Viên</th>
                            <th style="text-align: center">Tài Khoản</th>
                            <th style="text-align: center">Số Điện Thoại</th>
                            <th style="text-align: center">Tài Khoản Được Cấp</th>
                            <th style="text-align: center">Xóa Tài Khoản</th>
                        </tr>                  
                    </tfoot>
                    <tbody style="text-align: center">
                        @foreach ($data as $data)
                        <tr style="border: 1px solid lightgray;">
                            <td style="font-size:18px;">{{$data->name}}</td>
                            <td style="font-size:20px;">{{$data->email}}</td>
                            <td style="font-size:18px;">{{$data->phone}}</td>
                            <td style="font-size:20px;">
                                @if($data->role == "1")
                                    <a href="{{url('/admin/role-change/'.$data->id)}}" class="btn btn-sm btn-success">Quản Trị Viên</a>           
                                @else
                                    <a href="{{url('/admin/role-change/'.$data->id)}}" class="btn btn-sm badge-warning">Nhân Viên</a>
                                @endif  
                            </td>  
                            <td>   
                                <a href="#" data-id="{{$data->id}}" data-delname="{{$data->email}}" data-path="/admin/delstaff/" class="btn btn-secondary del"><i class="mdi mdi-delete" style="font-size: 28px; color: red;"></i></a>
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
