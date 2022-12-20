@extends('layout.admin')
@section('add')
    <a class="nav-link btn btn-warning create-new-button" href="{{route('staff.manage-staff')}}"><<< Trang Nhân Sự</a>
@stop()
@section('content')
<div class="col-md-12 ">
    <div class="x_panel">
        <div class="x_title">
            <h2>Thêm Nhân Sự</h2>      
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
        <br />
        @if(\Session::has('success'))
            <div class="succWrap"><strong>Thành Công</strong>: {{ \Session::get('success') }}</div>
        @endif
            <form class="form-horizontal form-label-left" action="{{route('staff.store')}}" method="POST" enctype="multipart/form-data">
                @csrf         
                <div class="form-group row ">
                    <label class="control-label col-md-3 col-sm-3 ">Tên Nhân Sự</label>
                    <div class="col-md-9 col-sm-9 ">
                        <input type="text" class="form-control" name="staff_name" placeholder="Nhập Tên Nhân Viên Mới" style="border: 1px solid; width:50%;">
                        @error('staff_name')
                                <span style="color: red;">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row ">
                    <label class="control-label col-md-3 col-sm-3 ">Email</label>
                    <div class="col-md-9 col-sm-9 ">
                        <input type="text" class="form-control" name="email" placeholder="Nhập Email" style="border: 1px solid; width:50%;">
                        @error('email')
                                <span style="color: red;">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row ">
                    <label class="control-label col-md-3 col-sm-3 ">Số Điện Thoại</label>
                    <div class="col-md-9 col-sm-9 ">
                        <input type="text" class="form-control" name="staff_phone" placeholder="Nhập Số Điện Thoại" style="border: 1px solid; width:50%;">
                        @error('staff_phone')
                                <span style="color: red;">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row ">
                    <label class="control-label col-md-3 col-sm-3 ">Mật Khẩu</label>
                    <div class="col-md-9 col-sm-9 ">
                        <input type="password" class="form-control" name="staff_pass" placeholder="Mật Khẩu" style="border: 1px solid; width:50%;">
                        @error('staff_pass')
                                <span style="color: red;">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="control-label col-md-3 col-sm-3 ">Xác Nhận Mật Khẩu</label>
                    <div class="col-md-9 col-sm-9 ">
                        <input type="password" class="form-control" id="staff_pass_confirmation" placeholder=" Xác Nhận Mật Khẩu" name="staff_pass_confirmation" style="border: 1px solid; width:50%;">
                    </div>
                </div>
                <div class="in_solid"></div>
                <div class="form-group">
                    <div class="col-md-9 col-sm-9  offset-md-3"> 
                        <button type="submit" class="btn btn-success">Tạo Tài Khoản</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection