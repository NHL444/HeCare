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
        <div class="x_content">
        <br />
        @if(\Session::has('success'))
            <div class="succWrap"><strong>Thành Công</strong>: {{ \Session::get('success') }}</div>
        @endif
            <form class="form-horizontal form-label-left" action="{{route('product.store')}}" method="POST" enctype="multipart/form-data">
            
                @csrf
                    <div class="form-group row ">
                        <label class="control-label col-md-3 col-sm-3 ">Tên Sản Phẩm</label>
                        <div class="col-md-9 col-sm-9 ">
                            <input type="text" class="form-control" name="pro_name" placeholder="Tên Sản Phẩm" value="{{old('pro_name')}}">
                            @error('pro_name')
                                <span style="color: red;">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                                                    
                    <div class="form-group row ">
                        <label class="control-label col-md-3 col-sm-3 ">Giá Gốc</label>
                        <div class="col-md-9 col-sm-9 ">
                            <input type="text" class="form-control" name="pro_price" placeholder="Nhập Giá" style="border: 1px solid; width: 200px;" value="{{old('pro_price')}}">
                            @error('pro_price')
                                <span style="color: red;">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row ">
                        <label class="control-label col-md-3 col-sm-3 ">Bán Ra (% lãi)</label>
                        <div class="col-md-9 col-sm-9 ">
                            <input type="text" class="form-control" name="pro_profit" placeholder="% lãi (0 - 100%)" style="border: 1px solid; width: 200px;" value="{{old('pro_profit')}}">
                            @error('pro_profit')
                                <span style="color: red;">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row ">
                        <label class="control-label col-md-3 col-sm-3 ">Khuyến mãi</label>
                        <div class="col-md-9 col-sm-9 ">
                            <input type="text" class="form-control" name="pro_discount" placeholder="% khuyến mãi (0 - 100%)" style="border: 1px solid; width: 200px;" value="{{old('pro_profit')}}">
                            @error('pro_discount')
                                <span style="color: red;">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row ">
                        <label class="control-label col-md-3 col-sm-3 ">Số Lượng</label>
                        <div class="col-md-9 col-sm-9 ">
                            <input type="text" class="form-control" name="pro_qty" placeholder="Nhập Số Lượng" style="border: 1px solid; width: 200px;" value="{{old('pro_qty')}}">
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
                                <option value="{{$data->cate_id}}">
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
                                @foreach($tpy as $val)
                                    <option value="{{$val->tp_id}}">{{$val->tp_name}}</option>                      
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-md-3 col-sm-3 ">Thương Hiệu</label>
                        <div class="col-md-9 col-sm-9 ">
                            <select required name="pro_brand" class="form-control" style="border: 1px solid; width: 200px;">
                                <option>Chọn Thương Hiệu</option>
                                @foreach($brand as $val)
                                    <option value="{{$val->br_id}}">{{$val->br_name}}</option>                      
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row ">
                        <label class="control-label col-md-3 col-sm-3 ">Xuất Xứ</label>
                        <div class="col-md-9 col-sm-9 ">
                            <input type="text" class="form-control" name="pro_origin" placeholder="Xuất Xứ" value="{{old('pro_origin')}}">
                            @error('pro_origin')
                                <span style="color: red;">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row ">
                        <label class="control-label col-md-3 col-sm-3 ">Hình Ảnh</label>
                        <div class="col-md-9 col-sm-9 ">
                            <input type="file" name="pro_image">                   
                        </div>
                    </div>
                                                
                    <div class="form-group row ">
                        <label class="control-label col-md-3 col-sm-3 ">Tóm Tắt</label>
                        <div class="col-md-9 col-sm-9 ">
                            <input type="text" class="form-control" name="pro_descript" placeholder="Mô Tả Ngắn" value="{{old('pro_descript')}}">
                            @error('pro_descript')
                                <span style="color: red;">{{$message}}</span>
                            @enderror
                        </div>
                    </div>             
                    <div class="form-group row ">
                        <label class="control-label col-md-3 col-sm-3 ">Nội Dung</label>
                        <div class="col-md-9 col-sm-9 ">
                            <textarea id="ckeditor" required name="pro_content" class="form-control ckeditor-box" rows="3"  placeholder="Nội Dung">{{old('pro_content')}}</textarea>
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
                                    <input type="radio" name="pro_status" value="1" class="join-btn"> &nbsp; Còn Hàng &nbsp;
                                </label>
                                <label class="btn btn-primary" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                                    <input type="radio" name="pro_status" value="0" class="join-btn"> Hết Hàng
                                </label>
                            </div>
                        </div>
                    </div>                    
                    <div class="in_solid"></div>
                    <div class="form-group">
                        <div class="col-md-9 col-sm-9  offset-md-3"> 
                            <button type="submit" class="btn btn-success">Tạo Sản Phẩm</button>
                        </div>
                    </div>
                
            </form>
    
        </div>
    </div>
</div>
@endsection