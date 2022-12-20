@extends('layout.admin')
@section('add')
    <a class="nav-link btn btn-success create-new-button" href="{{route('article.createtype')}}"><<< Thêm Bộ Môn</a>
@stop()
@section('content')
    <div class="col-md-12 col-sm-12  ">
        <div class="x_panel">
            <div class="x_title">
                <h2>Danh Sách Bộ Môn</h2>
                
                <div class="clearfix"></div>
            </div>
            @if(\Session::has('success'))
                <div class="succWrap"><strong>Thành Công</strong>: {{ \Session::get('success') }}</div>
            @endif
            <div class="x_content">
                <table class="table table-striped" id="myTable">
                    <thead style="background: palegoldenrod">                       
                        <tr style="border: 1px solid lightgray;">
                            <th style="text-align: center">Tên Loại Hình</th>
                            <th style="text-align: center">Thuộc Danh Mục</th>
                            <th style="text-align: center">Ảnh Đại Diện</th>
                            <th style="text-align: center">Logo</th>
                            @if($user->role == 1) <th style="text-align: center">Thao Tác</th>@endif
                        </tr>                  
                    </thead>
                    <tfoot style="background: palegoldenrod">                       
                        <tr style="border: 1px solid lightgray;">
                            <th style="text-align: center">Tên Loại Hình</th>
                            <th style="text-align: center">Thuộc Danh Mục</th>
                            <th style="text-align: center">Ảnh Đại Diện</th>
                            <th style="text-align: center">Logo</th>
                            @if($user->role == 1) <th style="text-align: center">Thao Tác</th>@endif
                        </tr>                  
                    </tfoot>
                    <tbody style="text-align: center">
                        @foreach ($dis as $data)
                        <tr style="border: 1px solid lightgray;">
                            <td style="font-size:20px;">{{$data->atp_name}}</td>
                            <td style="font-size:20px;">
                                @if($data->atp_parent==0)
                                <span>Danh muc cha</span>
                                @else
                                    @foreach($dis as $val)
                                        @if($val->atp_id==$data->atp_parent)
                                        <span>{{$val->atp_name}}</span>
                                        @endif
                                    @endforeach
                                @endif
                            </td>               
                            <td><img src="/type/photo/{{$data->atp_photo}}" style="width: 150px; height: 80px; border-radius: 10%;"/></td>
                            <td><img src="/type/logo/{{$data->atp_logo}}" style="width: 100px; height: 80px; border-radius: 10%;"/></td>
                            @if($user->role == 1)
                            <td>
                                <a href="{{route('article.gettype',$data->atp_id)}}" class="btn btn-secondary"><i class="mdi mdi-pen" style="font-size: 28px; color: darkblue;"></i></a>
                                <a href="{{route('article.deltype',$data->atp_id)}}"  class="btn btn-secondary complete"><i class="mdi mdi-delete" style="font-size: 28px; color: red;"></i></a>
                            </td>
                            @endif
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
