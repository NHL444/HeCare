@extends('layout.admin')
@section('add')
    <a class="nav-link btn btn-warning create-new-button" href="{{route('feeship.index')}}"><<< Toàn Bộ Phí Vận Chuyển</a>
@stop()
@section('content')
<div class="col-md-12 ">
    <div class="x_panel">
        <div class="x_title">
            <h2>CẬP NHẬT PHÍ VẬN CHUYỂN</h2>      
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
        <br />
        <span id="error_fee"></span>
        @if(\Session::has('success'))
            <div class="succWrap"><strong>Thành Công</strong>: {{ \Session::get('success') }}</div>
        @endif
            <form class="form-horizontal form-label-left">
                @csrf         
                <div class="form-group row">
                    <label class="control-label col-md-3 col-sm-3 ">Tỉnh/Thành</label>
                    <div class="col-md-9 col-sm-9 ">
                        <select required name="province" id="province" class="form-control province parent" style="border: 1px solid; width: 300px;">
                            <option>Chọn tỉnh/thành</option>
                            @foreach($province as $val)
                                <option value="{{$val->province_id}}">{{$val->province_name}}</option>                      
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="control-label col-md-3 col-sm-3 ">Quận/Huyện/Thị Xã</label>
                    <div class="col-md-9 col-sm-9 ">
                        <select required name="district" id="district" class="form-control district parent" style="border: 1px solid; width: 300px;">
                            <option value="0">Chọn quận/huyện/thị xã</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="control-label col-md-3 col-sm-3 ">Xã/Phường/Thị Trấn</label>
                    <div class="col-md-9 col-sm-9 ">
                        <select required name="commune" id="commune" class="form-control commune" style="border: 1px solid; width: 300px;">
                            <option value="0">Chọn xã/phường/thị trấn</option>

                        </select>
                    </div>
                </div>
                <div class="form-group row ">
                    <label class="control-label col-md-3 col-sm-3">Phí Vận Chuyển</label>
                    <div class="col-md-9 col-sm-9 ">
                        <input type="text" name="feeship" id="feeship" class="form-control feeship">                   
                    </div>
                </div>
                <div class="in_solid"></div>
                <div class="form-group">
                    <div class="col-md-9 col-sm-9  offset-md-3"> 
                        <button type="submit" name="add_delivery" class="btn btn-success add_delivery">Cập Nhật</button>
                    </div>
                </div>
            </form>
        </div>
        <div id="load_delivery">
            
        </div>
    </div>
</div>
@endsection