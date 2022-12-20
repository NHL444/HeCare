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
                            <form action="{{route('chatbot.savekey')}}" method="POST" enctype="multipart/form-data">
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
                                                <option value="0">Gym</option>   
                                                <option value="1">Chế Độ Ăn</option>
                                                <option value="2">Triathlon</option>  
                                                <option value="3">Tập Yoga</option>                   
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
                                
                                    <button type="submit" class="btn btn-success">Tạo</button>
                                
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
                <h2>Từ Khóa Được Thiết Lập</h2>
                
                <div class="clearfix"></div>
            </div>
            @if(\Session::has('success'))
                <div class="succWrap"><strong>Thành Công</strong>: {{ \Session::get('success') }}</div>
            @endif
            <div class="x_content">
                <table class="table table-striped" id="myTable" >
                    <thead style="background: palegoldenrod">                       
                        <tr style="border: 1px solid lightgray;">
                            <th>Từ Khóa</th>
                            <th>Thuộc Chủ Đề</th>
                            <th>Nội dung</th>
                            <th style="text-align: center">Thao Tác</th>
                        </tr>                  
                    </thead>
                    <tfoot style="background: palegoldenrod">                       
                        <tr style="border: 1px solid lightgray;">
                            <th>Từ Khóa</th>
                            <th>Thuộc Chủ Đề</th>
                            <th>Nội dung</th>
                            <th style="text-align: center">Thao Tác</th>
                        </tr>                  
                    </tfoot>
                    <tbody>
                        @foreach ($all as $data)
                        <tr style="border: 1px solid lightgray;">
                            <td style="font-size:20px;">{{$data->keyword}}</td>
                            <td style="font-size:20px;">
                                        @if($data->parent==0)
                                        Gym
                                        @elseif($data->parent==1)
                                        Chế Độ Ăn
                                        @elseif($data->parent==2)
                                        Ba môn phối hợp
                                        @else
                                        Tập Yoga
                                        @endif
                            </td>
                            <td style="font-size:20px;">{!! \Illuminate\Support\Str::limit($data->reply, 40, '...') !!}</td>
                            <td  style="text-align: center">
                                <a href="{{route('chatbot.editkey-model',$data->id)}}" class="btn btn-secondary"><i class="mdi mdi-pen" style="font-size: 28px; color: darkblue;"></i></a>
                                <a href="#"data-id="{{$data->id}}" data-delname="từ khóa {{$data->keyword}}" data-path="/chatbot/delkey/" class="btn btn-secondary del"><i class="mdi mdi-delete" style="font-size: 28px; color: red;"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            <br>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
          
@endsection
