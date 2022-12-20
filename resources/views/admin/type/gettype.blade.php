
@extends('layout.admin')
@section('add')
    <a class="nav-link btn btn-warning create-new-button" href="{{route('article.display')}}"><<< Các Bộ Môn</a>
@stop()
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
        @foreach($gettype as $key =>$val)
            <form class="form-horizontal form-label-left" action="{{URL::to('/admin/posttype/'.$val->atp_id)}}" method="POST" enctype="multipart/form-data">
                @csrf         
                <div class="form-group row ">
                    <label class="control-label col-md-3 col-sm-3 ">Tên Loại Hình</label>
                    <div class="col-md-9 col-sm-9 ">
                        <input type="text" class="form-control" name="atp_name" value="{{$val->atp_name}}" style="width: 350px;">
                        @error('atp_name')
                        <span style="color: red;">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="control-label col-md-3 col-sm-3 ">Danh Mục Cha</label>
                    <div class="col-md-9 col-sm-9 ">
                        <select required name="atp_parent" class="form-control" style="border: 1px solid; width: 150px;">
                            <option value="0">Là Danh Mục Cha</option>
                        @foreach($tp as $key => $data)                           
                            <option {{$val->atp_parent == $data->atp_id ? 'selected' : ''}} value="{{$data->atp_id}}">
                            @php
                             $str = '';
                             for($i = 0;$i < $data->level ; $i++){
                                echo $str;
                                $str.='-- ';
                             }   
                            @endphp
                                {{$data->atp_name}}</option>
                                              
                        @endforeach     
                        </select>
                    </div>
                </div>
                <div class="form-group row ">
                    <label class="control-label col-md-3 col-sm-3 ">Hình Ảnh</label>
                    <div class="col-md-9 col-sm-9 ">
                        <img id="avatar" width="200px" src="/type/photo/{{$val->atp_photo}}" alt="">
                        <input type="file" name="atp_photo">                   
                    </div>
                </div>
                <div class="form-group row ">
                    <label class="control-label col-md-3 col-sm-3 ">Logo</label>
                    <div class="col-md-9 col-sm-9 ">
                        <img id="logo" width="200px" src="/type/logo/{{$val->atp_logo}}" alt="">
                        <input type="file" name="atp_logo">                   
                    </div>
                </div>
                <div class="in_solid"></div>
                <div class="form-group">
                    <div class="col-md-9 col-sm-9  offset-md-3"> 
                        <button type="submit" class="btn btn-success">Sửa</button>
                        <a href="/admin/display" class="btn btn-danger">Hủy</a>                           
                    </div>
                </div>     
            </form>
            @endforeach
        </div>
    </div>
</div>
@endsection