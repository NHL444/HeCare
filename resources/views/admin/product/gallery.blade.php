
@extends('layout.admin')
@section('content')
<div class="col-md-12 ">
    <div class="x_panel">
        <div class="x_title">
            <h2>THÊM THƯ VIỆN ẢNH</h2>      
            <div class="clearfix"></div>
        </div>
        <br />
        @if(\Session::has('success'))
            <div class="succWrap"><strong>Thành Công</strong>: {{ \Session::get('success') }}</div>
        @endif
        <form action="{{URL::to('/admin/product/insert-gallery/'.$pro_id)}}" method="POST" enctype="multipart/form-data">
            @csrf
        <div class="row">
            <div class="col-md-3">

            </div>
            <div class="col-md-6">
                <input type="file" class="form-control" id="file" name="file[]" accept="image/*" multiple>
                <span id="error_gallery"></span>
            </div>
            <div class="col-md-3" style="padding-top: 7px;">
                <input type="submit" name="upload" name="load" value="Tải Ảnh" class="btn btn-success">
                <a href="/admin/product/manage" class="btn btn-primary">Quay về</a>
            </div>
        </div>
        </form> 
        <br>
        <input type="hidden" value="{{$pro_id}}" name="gl_product" class="gl_product">
        <form>
            @csrf
            <div class="x_content" id="gallery_load">
                
            </div>
        </form>
    </div>
</div>
@endsection