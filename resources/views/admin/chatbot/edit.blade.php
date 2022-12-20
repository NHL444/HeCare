@extends('layout.admin')
@section('add')
    @if(isset($edit))
    <a class="nav-link btn btn-warning create-new-button" href="{{route('chatbot.add-key')}}"><<< Danh Sách Từ Khóa</a>
    @else
    <a class="nav-link btn btn-warning create-new-button" href="{{route('chatbot.manage-key')}}"><<< Danh Sách Từ Khóa</a>
    @endif
@stop()
@section('content')
<div class="col-md-12 ">
    <div class="x_panel">
        <div class="x_title">
            <h2>Chỉnh Sửa Từ Khóa</h2>  
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
        <br />
            @if(isset($edit))
            <form class="form-horizontal form-label-left" action="{{URL::to('/chatbot/editkey-other/'.$edit->id)}}" method="POST" enctype="multipart/form-data"> 
            @else
            <form class="form-horizontal form-label-left" action="{{URL::to('/chatbot/editkey-model/'.$model->id)}}" method="POST" enctype="multipart/form-data"> 
            @endif
            @csrf
                @if(isset($edit))
                    <div class="form-group row ">
                        <label class="control-label col-md-3 col-sm-3 ">Từ Khóa</label>
                        <div class="col-md-9 col-sm-9 ">
                            <input type="text" class="form-control" name="keyword" placeholder="Từ Khóa" value="{{$edit->intent_other}}">
                        </div>
                    </div>
                    <div class="form-group row ">
                        <label class="control-label col-md-3 col-sm-3 ">Nội Dung</label>
                        <div class="col-md-9 col-sm-9 ">
                            <textarea id="ckeditor" required name="reply" class="form-control ckeditor-box" rows="3"  placeholder="Nội Dung">{{$edit->reply_intent}}</textarea>
                            <script type="text/javascript"> 
                                var editor = CKEDITOR.replace( 'reply', {
                                    filebrowserBrowseUrl: '/ckfinder/ckfinder.html',
                                    filebrowserUploadUrl: '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files'
                                } );
                            </script>
                        </div>
                    </div>  
                @else
                    <div class="form-group row ">
                        <label class="control-label col-md-3 col-sm-3 ">Từ Khóa</label>
                        <div class="col-md-9 col-sm-9 ">
                            <input type="text" class="form-control" name="keyword" placeholder="Từ Khóa" value="{{$model->keyword}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-md-3 col-sm-3 ">Thuộc</label>
                        <div class="col-md-9 col-sm-9 ">
                            <select required name="choose" class="form-control" style="border: 1px solid; width: 150px;">
                                <option>Từ Khóa Thuộc</option>
                                    <option value="0" @if($model->parent == 0) selected @endif>Gym</option>   
                                    <option value="1" @if($model->parent == 1) selected @endif>Chế Độ Ăn</option>
                                    <option value="2" @if($model->parent == 2) selected @endif>Triathlon</option>  
                                    <option value="3" @if($model->parent == 3) selected @endif>Tập Yoga</option>                   
                            </select>
                        </div>
                    </div>
                    <div class="form-group row ">
                        <label class="control-label col-md-3 col-sm-3 ">Nội Dung</label>
                        <div class="col-md-9 col-sm-9 ">
                            <textarea id="ckeditor" required name="reply" class="form-control ckeditor-box" rows="3"  placeholder="Nội Dung">{{$model->reply}}</textarea>
                            <script type="text/javascript"> 
                                var editor = CKEDITOR.replace( 'reply', {
                                    filebrowserBrowseUrl: '/ckfinder/ckfinder.html',
                                    filebrowserUploadUrl: '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files'
                                } );
                            </script>
                        </div>
                    </div>
                @endif                                                       
                    <div class="in_solid"></div>
                    <div class="form-group">
                        <div class="col-md-9 col-sm-9  offset-md-3"> 
                            <button type="submit" class="btn btn-success">Chỉnh Sửa</button>
                            @if(isset($edit))
                                <a href="{{route('chatbot.add-key')}}" class="btn btn-danger">Hủy Bỏ</a>
                            @else
                                <a href="{{route('chatbot.manage-key')}}" class="btn btn-danger">Hủy Bỏ</a>
                            @endif
                        </div>
                    </div>        
            </form>
          
        </div>
    </div>
</div>
@stop()