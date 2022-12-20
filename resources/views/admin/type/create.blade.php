@extends('layout.admin')
@section('add')
    <a class="nav-link btn btn-warning create-new-button" href="{{route('article.display')}}"><<< Các Bộ Môn</a>
@stop()
@section('content')
<div class="col-md-12 ">
    <div class="x_panel">
        <div class="x_title">
            <h2>THÊM BỘ MÔN MỚI</h2>      
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
        <br />
        @if(\Session::has('success'))
            <div class="succWrap"><strong>Thành Công</strong>: {{ \Session::get('success') }}</div>
        @endif
            <form class="form-horizontal form-label-left" action="{{route('article.ctype')}}" method="POST" enctype="multipart/form-data">
                @csrf         
                <div class="form-group row ">
                    <label class="control-label col-md-3 col-sm-3 ">Tên Loại Hình</label>
                    <div class="col-md-9 col-sm-9 ">
                        <input type="text" class="form-control" name="atp_name" placeholder="Nhập Tên Bộ Môn Mới" value="{{old('atp_name')}}" style="width: 350px;">
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
                            <option value="{{$data->atp_id}}">
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
                        <input type="file" name="atp_photo">                   
                    </div>
                </div>
                <div class="form-group row ">
                    <label class="control-label col-md-3 col-sm-3 ">Logo</label>
                    <div class="col-md-9 col-sm-9 ">
                        <input type="file" name="atp_logo">                   
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