@extends('layout.admin')
@section('add')
    <a class="nav-link btn btn-warning create-new-button" href="{{route('article.article-manage')}}"><<< Trang Bài Viết</a>
@stop()
@section('content')
<div class="col-md-12 ">
    <div class="x_panel">
        <h3><button class="btn btn-primary" data-toggle="modal" data-target="#myExcel"> Tải lên (file Excel) <i class="mdi mdi-upload"></i></button></h3>
        <div class="modal fade" id="myExcel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Đăng Bài</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                    <h3>Import Bài Viết (file Excel)</h3>
                    <form action="{{route('article.excel')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row ">
                         <input type="file" name="excelfile">
                        </div>
                        <div class="form-group row ">
                        
                            <button type="submit" class="btn btn-success">Đăng Bài</button>
                        
                        </div>
                    </form>
                  
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                </div>
              </div>
            </div>
        </div>
        <div class="x_title">
            <h2>Hôm Nay Có Gì?</h2>
            
            <div class="clearfix"></div>
        </div>
        
        <div class="x_content">
        <br />
        @if(\Session::has('success'))
            <div class="succWrap"><strong>Thành Công</strong>: {{ \Session::get('success') }}</div>
        @endif
            <form class="form-horizontal form-label-left" action="{{route('article.postarticle')}}" method="POST" enctype="multipart/form-data">
            
                @csrf
                    <div class="form-group row ">
                        <label class="control-label col-md-3 col-sm-3 ">Tiêu Đề</label>
                        <div class="col-md-9 col-sm-9 ">
                            <input type="text" class="form-control" name="atl_title" placeholder="Tiêu Đề" value="{{old('atl_title')}}">
                            @error('atl_title')
                                <span style="color: red;">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                                                    
                    <div class="form-group row ">
                        <label class="control-label col-md-3 col-sm-3 ">Chủ Đề</label>
                        <div class="col-md-9 col-sm-9 ">
                            <input type="text" class="form-control" name="atl_topic" placeholder="Chủ Đề" value="{{old('atl_topic')}}">
                            @error('atl_topic')
                                <span style="color: red;">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-md-3 col-sm-3 ">Loại Hình</label>
                        <div class="col-md-9 col-sm-9 ">
                            <select required name="atl_type" class="form-control" style="border: 1px solid; width: 150px;">
                                <option>Choose option</option>
                            @foreach($type as $key => $data)                           
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
                            @error('atl_type')
                                <span style="color: red;">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row ">
                        <label class="control-label col-md-3 col-sm-3 ">Hình Ảnh</label>
                        <div class="col-md-9 col-sm-9 ">
                            <input type="file" name="atl_photo">                   
                        </div>
                        @error('atl_photo')
                            <span style="color: red;">{{$message}}</span>
                        @enderror
                    </div>
                                                
                    <div class="form-group row ">
                        <label class="control-label col-md-3 col-sm-3 ">Tóm Tắt</label>
                        <div class="col-md-9 col-sm-9 ">
                            <input type="text" class="form-control" name="atl_descript" placeholder="Mô Tả Ngắn" value="{{old('atl_descript')}}">
                            @error('atl_descript')
                                <span style="color: red;">{{$message}}</span>
                            @enderror
                        </div>
                    </div>             
                    <div class="form-group row ">
                        <label class="control-label col-md-3 col-sm-3 ">Nội Dung</label>
                        <div class="col-md-9 col-sm-9 ">
                            <textarea id="ckeditor" required name="atl_content" class="form-control ckeditor-box" rows="3"  placeholder="Nội Dung"></textarea>
                            <script type="text/javascript"> 
                                var editor = CKEDITOR.replace( 'atl_content', {
                                    filebrowserBrowseUrl: '/ckfinder/ckfinder.html',
                                    filebrowserUploadUrl: '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files'
                                } );
                            </script>
                            @error('atl_content')
                            <span style="color: red;">{{$message}}</span>
                             @enderror
                        </div>
                    </div>                 
                    <div class="in_solid"></div>
                    <div class="form-group">
                        <div class="col-md-9 col-sm-9  offset-md-3"> 
                            <button type="submit" class="btn btn-success">Đăng Bài</button>
                        </div>
                    </div>
                
            </form>
    
        </div>
    </div>
</div>
@endsection