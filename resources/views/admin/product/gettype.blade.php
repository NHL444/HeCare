
@extends('layout.admin')
@section('content')
<div class="col-md-12 ">
    <div class="x_panel">
        <div class="x_title">
            <h2>CẬP NHẬT LOẠI SẢN PHẨM</h2>      
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
        <br />
        @if(\Session::has('success'))
            <div class="succWrap"><strong>Thành Công</strong>: {{ \Session::get('success') }}</div>
        @endif
            <form class="form-horizontal form-label-left" action="{{URL::to('/admin/product/posttype/'.$gettype->tp_id)}}" method="POST" enctype="multipart/form-data">
                @csrf         
                <div class="form-group row ">
                    <label class="control-label col-md-3 col-sm-3 ">Tên Loại</label>
                    <div class="col-md-9 col-sm-9 ">
                        <input type="text" class="form-control" name="tp_name" value="{{$gettype->tp_name}}">
                        @error('tp_name')
                        <span style="color: red;">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="in_solid"></div>
                <div class="form-group">
                    <div class="col-md-9 col-sm-9  offset-md-3"> 
                        <button type="submit" class="btn btn-success">Sửa</button>
                        <a href="/admin/product/distype" class="btn btn-danger">Hủy</a>                           
                    </div>
                </div>     
            </form>
        </div>
    </div>
</div>
@endsection