@extends('layout.admin')
@section('add')
    <a class="nav-link btn btn-warning create-new-button" href="{{route('product.promanage')}}"><<< Trang Sản Phẩm</a>
@stop()
@section('content')
<div class="col-md-12 ">
    <div class="x_panel">
        <div class="x_title">
            <h2>Hãy Tạo Sản Phẩm Mới!</h2>  
            <div class="clearfix"></div>
        </div>
        <div class="row">   
            <div class="col-lg-9">
                <div class="x_content">
                <br />
                    @if(\Session::has('success'))
                        <div class="succWrap"><strong>Thành Công</strong>: {{ \Session::get('success') }}</div>
                    @endif
                    <form class="form-horizontal form-label-left" action="{{URL::to('/admin/product/editsave/'.$edit->pro_id)}}" method="POST" enctype="multipart/form-data">

                        @csrf  
                    <div class="form-group row ">
                        <label class="control-label col-md-3 col-sm-3 ">Tên Sản Phẩm</label>
                        <div class="col-md-9 col-sm-9 ">
                            <input type="text" class="form-control" name="pro_name" placeholder="Tên Sản Phẩm" value="{{$edit->pro_name}}">
                            @error('pro_name')
                                <span style="color: red;">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                                                    
                    <div class="form-group row ">
                        <label class="control-label col-md-3 col-sm-3 ">Giá Cả</label>
                        <div class="col-md-9 col-sm-9 ">
                            <input type="text" class="form-control" name="pro_price" placeholder="Nhập Giá"  style="border: 1px solid; width: 200px;" value="{{$edit->pro_price}}">
                            @error('pro_price')
                                <span style="color: red;">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row ">
                        <label class="control-label col-md-3 col-sm-3 ">Bán Ra (% lãi)</label>
                        <div class="col-md-9 col-sm-9 ">
                            <input type="text" class="form-control" name="pro_profit" placeholder="% lãi (0 - 100%)" style="border: 1px solid; width: 200px;" value="{{$edit->pro_profit}}">
                            @error('pro_profit')
                                <span style="color: red;">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row ">
                        <label class="control-label col-md-3 col-sm-3 ">Khuyến mãi</label>
                        <div class="col-md-9 col-sm-9 ">
                            <input type="text" class="form-control" name="pro_discount" placeholder="% khuyến mãi (0 - 100%)" style="border: 1px solid; width: 200px;" value="{{$edit->pro_discount}}">
                            @error('pro_discount')
                                <span style="color: red;">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row ">
                        <label class="control-label col-md-3 col-sm-3 ">Số Lượng</label>
                        <div class="col-md-9 col-sm-9 ">
                            <input type="text" class="form-control" name="pro_qty" placeholder="Nhập Số Lượng"  style="border: 1px solid; width: 200px;" value="{{$edit->pro_qty}}">
                            @error('pro_qty')
                                <span style="color: red;">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-md-3 col-sm-3 ">Danh Mục</label>
                        <div class="col-md-9 col-sm-9 ">
                            <select required name="pro_cate" class="form-control" style="border: 1px solid; width: 200px;">
                                <option>Chọn Danh Mục</option>
                            @foreach($add as $key => $data)                           
                                <option value="{{$data->cate_id}}" @if($edit->pro_cate == $data->cate_id) selected @endif>
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
                    <div class="form-group row">
                        <label class="control-label col-md-3 col-sm-3 ">Loại</label>
                        <div class="col-md-9 col-sm-9 ">
                            <select required name="pro_type" class="form-control" style="border: 1px solid; width: 200px;">
                                <option>Chọn Loại</option>
                                @foreach($type as $val)
                                    <option value="{{$val->tp_id}}" @if($edit->pro_type == $val->tp_id) selected @endif>{{$val->tp_name}}</option>                      
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-md-3 col-sm-3 ">Thương Hiệu</label>
                        <div class="col-md-9 col-sm-9 ">
                            <select required name="pro_brand" class="form-control" style="border: 1px solid; width: 200px;">
                                <option>Chọn Loại</option>
                                @foreach($brand as $val)
                                    <option value="{{$val->br_id}}" @if($edit->pro_brand == $val->br_id) selected @endif>{{$val->br_name}}</option>                      
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row ">
                        <label class="control-label col-md-3 col-sm-3 ">Xuất Xứ</label>
                        <div class="col-md-9 col-sm-9 ">
                            <input type="text" class="form-control" name="pro_origin" value="{{$edit->pro_origin}}">
                            @error('pro_origin')
                                <span style="color: red;">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                                                
                    <div class="form-group row ">
                        <label class="control-label col-md-3 col-sm-3 ">Tóm Tắt</label>
                        <div class="col-md-9 col-sm-9 ">
                            <input type="text" class="form-control" name="pro_descript" placeholder="Mô Tả Ngắn" value="{{$edit->pro_name}}">
                            @error('pro_descript')
                                <span style="color: red;">{{$message}}</span>
                            @enderror
                        </div>
                    </div>             
                    <div class="form-group row ">
                        <label class="control-label col-md-3 col-sm-3 ">Nội Dung</label>
                        <div class="col-md-9 col-sm-9 ">
                            <textarea id="ckeditor" required name="pro_content" class="form-control ckeditor-box" rows="3"  placeholder="Nội Dung">{{$edit->pro_content}}</textarea>
                            <script type="text/javascript"> 
                                var editor = CKEDITOR.replace( 'pro_content', {
                                    filebrowserBrowseUrl: '/ckfinder/ckfinder.html',
                                    filebrowserUploadUrl: '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files'
                                } );
                            </script>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-md-3 col-sm-3">Trạng thái</label>
                        <div class="col-md-9 col-sm-9 ">
                            <div id="gender" class="btn-group" data-toggle="buttons">
                                <label class="btn btn-secondary" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                                    <input type="radio" name="pro_status" value="1" @if($edit->pro_status==1) checked @endif class="join-btn"> &nbsp; Còn Hàng &nbsp;
                                </label>
                                <label class="btn btn-primary" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                                    <input type="radio" name="pro_status" value="0" @if($edit->pro_status==0) checked @endif class="join-btn"> Hết Hàng
                                </label>
                            </div>
                        </div>
                    </div>                   
                    <div class="in_solid"></div>
                    <div class="form-group">
                        <div class="col-md-9 col-sm-9  offset-md-3"> 
                            <button type="submit" class="btn btn-success">Chỉnh Sửa</button>
                            <a href="/admin/product/promanage" class="btn btn-danger">Hủy Bỏ</a>
                        </div>
                    </div>
                            

                </div>
            </div> 
            <div class="col-lg-3">
    
                <div class="display-img">
                    <input type="file" name="pro_image"> <br><br>
                    <img id="avatar" src="/image/{{$edit->pro_image}}" alt="" width="100%">

                </div>
            </div> 
        </form>
        </div>
    </div>
</div>
@endsection