@extends('layout.admin')
@section('add')
    <a class="nav-link btn btn-success create-new-button" href="{{route('article.writearticle')}}"><<< Thêm Bài Viết</a>
@stop()
@section('content')
    <div class="col-md-12 col-sm-12  ">
        <div class="x_panel">
            <div class="x_title">
                <h2>Tất Cả Bài Viết</h2>
                
                <div class="clearfix"></div>
            </div>
            @if(\Session::has('success'))
                <div class="succWrap"><strong>Thành Công</strong>: {{ \Session::get('success') }}</div>
            @endif
            <div class="x_content">
                <table class="table table-striped" id="myTable" >
                    <thead style="background: palegoldenrod">                       
                        <tr style="border: 1px solid lightgray;">
                            <th style="text-align: center">Tên Bài Viết</th>
                            <th style="text-align: center">Ảnh Đại Diện</th>
                            <th style="text-align: center">Bài Viết Thuộc</th>
                            <th style="text-align: center">Thao Tác</th>
                        </tr>                  
                    </thead>
                    <tfoot style="background: palegoldenrod">                       
                        <tr style="border: 1px solid lightgray;">
                            <th style="text-align: center">Tên Bài Viết</th>
                            <th style="text-align: center">Ảnh Đại Diện</th>
                            <th style="text-align: center">Bài Viết Thuộc</th>
                            <th style="text-align: center">Thao Tác</th>
                        </tr>                  
                    </tfoot>
                    <tbody>
                        @foreach ($manage as $data)
                        <tr style="border: 1px solid lightgray;">
                            <td style="font-size:20px;">{{$data->atl_title}}</td>
                            <td style="text-align: center"><img src="/photo/{{$data->atl_photo}}" style="width: 150px; height: 80px; border-radius: 10%;"/></td>
                            <td style="font-size:20px;text-align: center">{{$data->Type->atp_name}}</td>
                            <td  style="text-align: center">
                                <a href="{{route('article.edit',$data->id)}}" class="btn btn-secondary"><i class="mdi mdi-pen" style="font-size: 28px; color: darkblue;"></i></a>
                                <a href="# "data-id="{{$data->id}}" data-delname="bài viết" data-path="/admin/delete/" class="btn btn-secondary del"><i class="mdi mdi-delete" style="font-size: 28px; color: red;"></i></a>
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
