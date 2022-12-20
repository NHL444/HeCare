@extends('layout.admin')
@section('add')
    <a class="nav-link btn btn-success create-new-button" data-toggle="modal" data-target="#myKey">+ Thêm Danh Mục</a>
@stop()
@section('content')
    <div class="col-md-12 col-sm-12  ">
        <div class="x_panel">
                {{-- Modal --}}
                <div class="modal fade" id="myKey" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Thêm Danh Mục Mới</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <div class="modal-body">
                            @include('admin.category.create')
                        
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                        </div>
                    </div>
                    </div>
                </div>
            <div class="x_title">
                <h2>Tất Cả Danh Mục</h2>
                
                <div class="clearfix"></div>
            </div>
            @if(\Session::has('success'))
                <div class="succWrap"><strong>Thành Công</strong>: {{ \Session::get('success') }}</div>
            @endif
            <div class="x_content">
                <table class="table table-striped" id="myTable" >
                    <thead style="background: palegoldenrod">                       
                        <tr style="border: 1px solid lightgray;">
                            <th>Tên Danh Mục</th>
                            <th>Thuộc Danh Mục</th>
                            <th>Số Sản Phẩm</th>
                            <th style="text-align: center">Thao Tác</th>
                        </tr>                  
                    </thead>
                    <tfoot style="background: palegoldenrod">                       
                        <tr style="border: 1px solid lightgray;">
                            <th>Tên Danh Mục</th>
                            <th>Thuộc Danh Mục</th>
                            <th>Số Sản Phẩm</th>
                            <th style="text-align: center">Thao Tác</th>
                        </tr>                  
                    </tfoot>
                    <tbody>
                        @foreach ($dis as $data)
                        <tr style="border: 1px solid lightgray;">
                            <td style="font-size:20px;">{{$data->cate_name}}</td>
                            <td style="font-size:20px;">
                                    @foreach($all as $val)
                                        @if($val->cate_id==$data->cate_parent)
                                        <a href="{{route('category.getcate',$val->cate_id)}}" style="text-decoration:none; color:black;">{{$val->cate_name}}  <i class="mdi mdi-pen"></i></a>
                                        @endif
                                    @endforeach
                            </td>
                            <td style="font-size:20px;">{{$data->Products->count()}}</td>
                            {{-- <td><img src="/photonews/{{$data->photo}}" style="width: 150px; height: 80px; border-radius: 10%;"/></td> --}}
                            <td  style="text-align: center">
                                <a href="{{route('category.getcate',$data->cate_id)}}" class="btn btn-secondary"><i class="mdi mdi-pen" style="font-size: 28px; color: darkblue;"></i></a>
                                <a href="#"data-id="{{$data->cate_id}}" data-delname="{{$data->cate_name}}" data-path="/admin/delcate/" class="btn btn-secondary del"><i class="mdi mdi-delete" style="font-size: 28px; color: red;"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            <br>
                {{-- {!!$show->links("pagination::bootstrap-4")!!} --}}
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
@endsection
