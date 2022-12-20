@extends('layout.admin')
@section('add')
    <a class="nav-link btn btn-success create-new-button" data-toggle="modal" data-target="#myKey">+ Thêm Từ Khóa</a>
    
@stop()
@section('content')
    <div class="col-md-12 col-sm-12  ">
        <div class="x_panel">
            <div class="modal fade" id="myKey" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Thêm Từ Khóa Mới</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{route('chatbot.savekey-user')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row ">
                                <label class="control-label col-md-3 col-sm-3 ">Từ Khóa Mới</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <input type="text" class="form-control" name="keyword" placeholder="Nhập Từ Khóa Mới"  style="border: 1px solid; width: 300px;">
                                    @error('keyword')
                                            <span style="color: red;">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3 ">Thuộc</label>
                                <div class="col-md-9 col-sm-9 ">
                                    <select required name="choose" class="form-control" style="border: 1px solid; width: 150px;">
                                        <option>Từ Khóa Thuộc</option>
                                            <option value="1">Chào Hỏi</option>   
                                            <option value="2">Bộ Môn</option>
                                            <option value="3">Khác</option>  
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row ">
                                <div class="col-md-12 col-sm-12 ">
                                    <textarea id="ckeditor" required name="reply" class="form-control ckeditor-box" rows="3"  placeholder="Nội Dung"></textarea>
                                    <script type="text/javascript"> 
                                        var editor = CKEDITOR.replace( 'reply', {
                                            filebrowserBrowseUrl: '/ckfinder/ckfinder.html',
                                            filebrowserUploadUrl: '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files'
                                        } );
                                    </script>
                                </div>
                            </div>
                            <div class="form-group row ">
                            
                                <button type="submit" class="btn btn-success">Thêm</button>
                            
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
                <h2>Từ Khóa Tiên Đoán Từ Khách</h2>
                
                <div class="clearfix"></div>
            </div>
            @if(\Session::has('success'))
                <div class="succWrap"><strong>Thành Công</strong>: {{ \Session::get('success') }}</div>
            @endif
            <div class="row">
                <div class="col-md-12 col-sm-12">               
                    <div class="x_content">
                        <table class="table table-striped" id="myTable">
                            <thead style="background: palegoldenrod">                       
                                <tr style="border: 1px solid lightgray;">
                                    <th>Từ Khóa</th>
                                    <th>Trả Lời</th>
                                    <th>Chỉnh Sửa</th>
                                </tr>                  
                            </thead>
                            <tfoot style="background: palegoldenrod">                       
                                <tr style="border: 1px solid lightgray;">
                                    <th>Từ Khóa</th>
                                    <th>Trả Lời</th>
                                    <th>Chỉnh Sửa</th>
                                </tr>                  
                            </tfoot>
                            <tbody>
                                @foreach ($other as $data)
                                <tr style="border: 1px solid lightgray;">
                                    <td style="font-size:20px;">{{$data->intent_other}}</td>
                                    <td style="font-size:20px;">{!! \Illuminate\Support\Str::limit($data->reply_intent, 70, '...') !!}</td>
                                    <td><a href="{{route('chatbot.editkey-other',$data->id)}}" class="btn btn-secondary"><i class="mdi mdi-pen" style="font-size: 28px; color: darkblue;"></i></a></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    <br>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6">               
                    <div class="x_content">
                        <table class="table table-striped" >
                            <thead style="background: palegoldenrod">                       
                                <tr style="border: 1px solid lightgray;">
                                    <th>Chào Hỏi</th>
                                </tr>                  
                            </thead>
                            <tfoot style="background: palegoldenrod">                       
                                <tr style="border: 1px solid lightgray;">
                                    <th>Chào Hỏi</th>
                                </tr>                  
                            </tfoot>
                            <tbody>
                                @foreach ($greet as $data)
                                <tr style="border: 1px solid lightgray;">
                                    <td contenteditable class="editgreet" style="font-size:20px;" data-greet_id="{{$data->id}}">{{$data->intent_greet}}</td>
                                    <span id="success"></span>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    <br>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6">               
                    <div class="x_content">
                            <table class="table table-striped" id="myTable">
                                <thead style="background: palegoldenrod">                       
                                    <tr style="border: 1px solid lightgray;">
                                        <th>Bộ Môn</th>
                                    </tr>                  
                                </thead>
                                <tfoot style="background: palegoldenrod">                       
                                    <tr style="border: 1px solid lightgray;">
                                        <th>Bộ Môn</th>
                                    </tr>                  
                                </tfoot>
                                <tbody>
                                    @foreach ($type as $data)
                                    <tr style="border: 1px solid lightgray;">
                                        <td contenteditable class="editkey" style="font-size:20px;" data-key_id="{{$data->id}}">{{$data->intent_model}}</td>
                                        <span id="error_gallery"></span>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                    <br>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
          
@stop()
@section('js')
<script type="text/javascript">
      $(document).ready(function(){
        $(document).on('blur','.editkey',function(){
            var key_id= $(this).data('key_id');
            var new_name = $(this).text();
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url:"{{url('/chatbot/edit-keyword')}}",
                method:"POST",
                data:{key_id:key_id,new_name:new_name,_token:_token},
                success:function(data){
                    $('#error_gallery').html('<span class="text-success">Từ Khóa Đã Được Thay Đổi!</span>');
                }
            });
        });
      });
</script>
<script type="text/javascript">
    $(document).ready(function(){
      $(document).on('blur','.editgreet',function(){
          var key_id= $(this).data('greet_id');
          var new_name = $(this).text();
          var _token = $('input[name="_token"]').val();
          $.ajax({
              url:"{{url('/chatbot/edit-greet')}}",
              method:"POST",
              data:{key_id:key_id,new_name:new_name,_token:_token},
              success:function(data){
                  $('#success').html('<span class="text-success">Từ Khóa Đã Được Thay Đổi!</span>');
              }
          });
      });
    });
</script>
@stop()