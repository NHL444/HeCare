@extends('layout.admin')
@section('add')
<a class="nav-link btn btn-success create-new-button" href="{{route('product.add')}}">+ Thêm Sản Phẩm</a>
@stop()
@section('content')
    <div class="col-md-12 col-sm-12  ">
        <div class="x_panel">
            <div class="x_title">
                <h2>Tất Cả Sản Phẩm</h2>
                
                <div class="clearfix"></div>
            </div>
            @if(\Session::has('success'))
                <div class="succWrap"><strong>Thành Công</strong>: {{ \Session::get('success') }}</div>
            @endif
            <div class="x_content">
                <table class="table table-striped" id="myTable">
                    <thead style="background: palegoldenrod">                       
                        <tr style="border: 1px solid lightgray;">
                            <th>Tên Sản Phẩm</th>
                            <th>Giá Cả</th>
                            <th>Tồn</th> 
                            <th>Ảnh Đại Diện</th>
                            <th>Danh Mục</th>   
                            <th>Loại</th>      
                            <th>Đánh giá</th>                                          
                            <th style="text-align: center">Thao Tác</th>
                        </tr>                  
                    </thead>
                    <tfoot style="background: palegoldenrod">                       
                        <tr style="border: 1px solid lightgray;">
                            <th>Tên Sản Phẩm</th>
                            <th>Giá Cả</th>
                            <th>Tồn</th> 
                            <th>Ảnh Đại Diện</th>
                            <th>Danh Mục</th>   
                            <th>Loại</th>   
                            <th>Đánh giá</th>                                         
                            <th style="text-align: center">Thao Tác</th>
                        </tr>                  
                    </tfoot>
                    <tbody>
                        @foreach ($show as $data)
                        <tr style="border: 1px solid lightgray;">
                            <td style="font-size:20px;">{!! \Illuminate\Support\Str::limit($data->pro_name, 30, '...') !!}</td>
                            <td style="font-size:20px;">{{number_format($data->pro_sell,0,',',',')}}đ</td>
                            <td style="font-size:20px;">{{$data->pro_qty}}</td>
                            <td><img src="/image/{{$data->pro_image}}" style="width: 115px; height: 80px; border-radius: 10%;"/>
                                &nbsp;<a href="{{URL::to('/admin/product/gallery/'.$data->pro_id)}}"><i class="mdi mdi-upload" style="color: red;"></i></a>
                            </td>
                            <td style="font-size:20px;">{{$data->Category()->first()->cate_name}}</td>  
                            <td style="font-size:20px;">{{$data->Type()->first()->tp_name}}</td>
                            @if(($data->Rating->count())>0)
                            <td style="font-size:20px;">{{number_format($data->Rating->avg('rating_vote'),1,',',',')}} sao</td>
                            @else 
                            <td style="font-size:20px;">0 sao</td>
                            @endif                   
                            <td  style="text-align: center">
                                <a href="{{route('product.edit',$data->pro_id)}}" class="btn btn-secondary"><i class="mdi mdi-pen" style="font-size: 28px; color: darkblue;"></i></a>
                                <a href="#" data-id="{{$data->pro_id}}" data-delname="sản phẩm" data-path="/admin/product/delete/" class="btn btn-secondary del"><i class="mdi mdi-delete" style="font-size: 28px; color: red;"></i></a>
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
