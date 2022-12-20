@extends('layout.admin')
@section('content')
<div class="col-md-12 ">
    <div class="x_panel">
        <div class="x_title">
            <h2>CẬP NHẬT BỘ MÔN</h2>      
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
        <br />
        @if(\Session::has('success'))
            <div class="succWrap"><strong>Thành Công</strong>: {{ \Session::get('success') }}</div>
        @endif
            <form class="form-horizontal form-label-left" action="{{route('product.save')}}" method="POST" enctype="multipart/form-data">
                @csrf         
                <div class="form-group row ">
                    <label class="control-label col-md-3 col-sm-3 ">Tên Loại Hình</label>
                    <div class="col-md-9 col-sm-9 ">
                        <input type="text" class="form-control" name="name" placeholder="Nhập Tên Loại Hình Mới">
                        @error('name')
                                <span style="color: red;">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="control-label col-md-3 col-sm-3 ">Loại</label>
                    <div class="col-md-9 col-sm-9 ">
                        <select required name="choose" class="form-control" style="border: 1px solid; width: 150px;">
                            <option>Loai/Thương Hiệu</option>
                                <option value="0">Loại</option>   
                                <option value="1">Thương Hiệu</option>                      
                        </select>
                    </div>
                </div>
                <div class="in_solid"></div>
                <div class="form-group">
                    <div class="col-md-9 col-sm-9  offset-md-3"> 
                        <button type="submit" class="btn btn-success">Cập Nhật</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection