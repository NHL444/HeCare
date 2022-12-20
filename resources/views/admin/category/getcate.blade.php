
@extends('layout.admin')
@section('content')
<div class="col-md-12 ">
    <div class="x_panel">
        <div class="x_title">
            <h2>CẬP NHẬT DANH MỤC</h2>      
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
        <br />
        @if(\Session::has('success'))
            <div class="succWrap"><strong>Thành Công</strong>: {{ \Session::get('success') }}</div>
        @endif
        @foreach($getcate as $key =>$val)
            <form class="form-horizontal form-label-left" action="{{URL::to('/admin/postcate/'.$val->cate_id)}}" method="POST" enccate="multipart/form-data">
                @csrf         
                <div class="form-group row ">
                    <label class="control-label col-md-3 col-sm-3 ">Tên Danh Mục</label>
                    <div class="col-md-9 col-sm-9 ">
                        <input cate="text" class="form-control" name="cate_name" value="{{$val->cate_name}}">
                        @error('cate_name')
                        <span style="color: red;">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                @if($val->cate_parent == 0) 
                <div class="form-group row">
                    <label class="control-label col-md-3 col-sm-3 ">Danh Mục Cha</label>   
                    <div class="col-md-9 col-sm-9 ">
                        <select required name="cate_parent" class="form-control" style="border: 1px solid; width: 150px;">
                            <option value="0">Là Danh Mục Cha</option>
                        </select>
                    </div>
                </div>
                @else
                <div class="form-group row">
                    <label class="control-label col-md-3 col-sm-3 ">Danh Mục Cha</label>
                    <div class="col-md-9 col-sm-9 ">
                        <select required name="cate_parent" class="form-control" style="border: 1px solid; width: 150px;">
                            <option value="0">Là Danh Mục Cha</option>
                        @foreach($cate as $key => $data)                           
                            <option {{$val->cate_parent == $data->cate_id ? 'selected' : ''}} value="{{$data->cate_id}}">
                            @php
                             $str = '';
                             for($i = 0;$i < $data->level ; $i++){
                                echo $str;
                                $str.='-- ';
                             }   
                            @endphp
                                {{$data->cate_name}}</option>
                                              
                        @endforeach     
                        </select>
                    </div>
                </div>
                @endif
                <div class="in_solid"></div>
                <div class="form-group">
                    <div class="col-md-9 col-sm-9  offset-md-3"> 
                        <button cate="submit" class="btn btn-success">Sửa</button>
                        <a href="/admin/show" class="btn btn-danger">Hủy</a>
                        @if($val->cate_parent == 0)   
                        <a href="#"data-id="{{$val->cate_id}}" data-delname="{{$val->cate_name}}" data-path="/admin/delcate/" class="btn btn-warning del">Xóa</a>
                        @endif
                                             
                    </div>
                </div>     
            </form>
            @endforeach
        </div>
    </div>
</div>
@endsection