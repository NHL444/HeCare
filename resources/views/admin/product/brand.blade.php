@extends('layout.admin')
@section('add')
    <a class="nav-link btn btn-success create-new-button" href="{{route('product.createtype')}}"><<< Thêm Loại/Thương Hiệu</a>
@stop()
@section('content')
    <div class="col-md-12 col-sm-12  ">
        <div class="x_panel">
            <div class="x_title">
                <h2>Danh Sách Thương Hiệu</h2>
                
                <div class="clearfix"></div>
            </div>
            @if(\Session::has('success'))
                <div class="succWrap"><strong>Thành Công</strong>: {{ \Session::get('success') }}</div>
            @endif
            <div class="x_content">
                <table class="table table-striped" id="myTable">
                    <thead style="background: palegoldenrod">                       
                        <tr style="border: 1px solid lightgray;">
                            <th style="text-align: center">Tên Thương Hiệu</th>
                            <th style="text-align: center">Logo</th>
                            <th style="text-align: center">Thao Tác</th>
                        </tr>                  
                    </thead>
                    <tfoot style="background: palegoldenrod">                       
                        <tr style="border: 1px solid lightgray;">
                            <th style="text-align: center">Tên Thương Hiệu</th>
                            <th style="text-align: center">Logo</th>
                            <th style="text-align: center">Thao Tác</th>
                        </tr>                  
                    </tfoot>
                    <tbody style="text-align: center">
                        @foreach ($br as $data)
                        <tr style="border: 1px solid lightgray;">
                            <td style="font-size:20px;">{{$data->br_name}}</td>
                            <td><img src="/type/brand/{{$data->br_image}}" style="width: 170px; height: 100px; border-radius: 10%;"/></td>
                            <td>
                                <a href="{{route('product.getbrand',$data->br_id)}}" class="btn btn-secondary"><i class="mdi mdi-pen" style="font-size: 28px; color: darkblue;"></i></a>
                                <a href="#" data-id="{{$data->br_id}}" data-delname="thương hiệu" data-path="/admin/product/delbrand/" class="btn btn-secondary del"><i class="mdi mdi-delete" style="font-size: 28px; color: red;"></i></a>
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
