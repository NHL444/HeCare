@extends('layout.admin')
@section('content')
<div class="col-md-12 ">
    <div class="x_panel">
        <div class="x_title">
            <h2>Chỉnh Sửa Bài Đăng</h2>  
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
        <br />
            @if(\Session::has('success'))
                <div class="succWrap"><strong>Thành Công</strong>: {{ \Session::get('success') }}</div>
            @endif
           
            <form class="form-horizontal form-label-left" action="{{URL::to('/admin/editarticle/'.$edit->id)}}" method="POST" enctype="multipart/form-data"> 
                @csrf
                    <div class="form-group row ">
                        <label class="control-label col-md-3 col-sm-3 ">Tiêu Đề</label>
                        <div class="col-md-9 col-sm-9 ">
                            <input type="text" class="form-control" name="atl_title" placeholder="Tiêu Đề" value="{{$edit->atl_title}}">
                        </div>
                        @error('atl_title')
                            <span style="color: red;">{{$message}}</span>
                        @enderror
                    </div>
                                                    
                    <div class="form-group row ">
                        <label class="control-label col-md-3 col-sm-3 ">Chủ Đề</label>
                        <div class="col-md-9 col-sm-9 ">
                            <input type="text" class="form-control" name="atl_topic" placeholder="Chủ Đề" value="{{$edit->atl_topic}}">
                        </div>
                        @error('atl_topic')
                            <span style="color: red;">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-md-3 col-sm-3 ">Loại Hình</label>
                        <div class="col-md-9 col-sm-9 ">
                            <select required name="atl_type" class="form-control" style="border: 1px solid; width: 150px;">
                                <option>Choose option</option>
                            @foreach($type as $key => $data)                  
                            <option value="{{$data->atp_id}}" @if($edit->atl_type == $data->atp_id) selected @endif>         
                            {{-- <option {{$val->atp_parent == $data->atp_id ? 'selected' : ''}} value="{{$data->atp_id}}"> --}}
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
                            <img id="avatar" width="200px" src="/photo/{{$edit->atl_photo}}" alt="">
                            <input type="file" name="atl_photo">                   
                        </div>
                    </div>
                                                
                    <div class="form-group row ">
                        <label class="control-label col-md-3 col-sm-3 ">Tóm Tắt</label>
                        <div class="col-md-9 col-sm-9 ">
                            <input type="text" class="form-control" name="atl_descript" placeholder="Mô Tả Ngắn" value="{{$edit->atl_descript}}">
                        </div>
                        @error('atl_descript')
                            <span style="color: red;">{{$message}}</span>
                        @enderror
                    </div>             
                    <div class="form-group row ">
                        <label class="control-label col-md-3 col-sm-3 ">Nội Dung</label>
                        <div class="col-md-9 col-sm-9 ">
                            <textarea id="ckeditor" required name="atl_content" class="form-control ckeditor-box" rows="3"  placeholder="Nội Dung">{{$edit->atl_content}}</textarea>
                            <script type="text/javascript"> 
                                var editor = CKEDITOR.replace( 'atl_content', {
                                    filebrowserBrowseUrl: '/ckfinder/ckfinder.html',
                                    filebrowserUploadUrl: '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files'
                                } );
                            </script>
                        </div>
                    </div>                 
                    <div class="in_solid"></div>
                    <div class="form-group">
                        <div class="col-md-9 col-sm-9  offset-md-3"> 
                            <button type="submit" class="btn btn-success">Chỉnh Sửa</button>
                            <a href="/admin/article-manage" class="btn btn-danger">Hủy Bỏ</a>
                        </div>
                    </div>        
            </form>
          
        </div>
    </div>
</div>
@endsection