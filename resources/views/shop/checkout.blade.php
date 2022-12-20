@extends('layout.shop')
@section('title', 'Shop')
@section('content')

    @section('banner')
    <div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">Thông Tin Thanh Toán</h1>
            <div class="d-inline-flex">
                <p class="m-0"><a href="">Home</a></p>
                <p class="m-0 px-2">-</p>
                <p class="m-0">Thông Tin Thanh Toán</p>
            </div>
        </div>
    </div>
    @endsection

    <div class="container-fluid pt-5">
        <div class="row px-xl-5">
            <div class="col-lg-8">
                <div class="mb-4">
                    <div class="card-header bg-secondary border-0">
                        <h4 class="font-weight-semi-bold m-0">Thông Tin Khách Hàng</h4>
                    </div>
                    {{-- <h4 class="font-weight-semi-bold mb-4">Thông Tin Gửi Hàng</h4> --}}
                    
                        <form action="{{URL::to('/checkout/cus_info')}}" method="POST" style="width:100%;">
                            @csrf
                        <div class="row" style="padding-top: 15px; ">
                        <div class="col-md-12 form-group">
                            <label>Họ Và Tên Khách Hàng</label>
                            <input class="form-control" name="name" type="text" placeholder="Họ Tên" value="{{old('name')}}">
                            @error('name')
                                <span style="color: red;">{{$message}}</span>
                            @enderror
                        </div>                    
                        <div class="col-md-6 form-group">
                            <label>E-mail</label>
                            <input class="form-control" name="email" type="text" placeholder="vidu@email.com" value="{{old('email')}}"> 
                            @error('email')
                                <span style="color: red;">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Số Điện Thoại</label>
                            <input class="form-control" name="phone" type="text" placeholder="+84" value="{{old('phone')}}">
                            @error('phone')
                                <span style="color: red;">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Tỉnh/Thành Phố</label>
                            <select required name="province" id="province" class="custom-select province parent">
                                <option>Chọn tỉnh/thành phố</option>
                                @foreach($province as $val)
                                <option value="{{$val->province_id}}">{{$val->province_name}}</option>                      
                            @endforeach
                            </select>
                            
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Quận/Huyện/Thị Xã</label>
                            <select required name="district" id="district" class="custom-select district parent">
                                <option value="0">Chọn quận/huyện/thị xã</option>
                            </select>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Xã/Phường/Thị Trấn</label>
                            <select required name="commune" id="commune" class="custom-select commune">
                                <option value="0">Chọn xã/phường/thị trấn</option>
                            </select>
                            
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Địa chỉ</label>
                            <input class="form-control" name="address" type="text" placeholder="Địa chỉ cụ thể (đường, khóm, ấp, thôn, khu vực,..)." value="{{old('address')}}">
                            @error('address')
                                <span style="color: red;">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="col-md-12 form-group">
                            <label>Ghi Chú</label>
                            <textarea name="note" class="form-control" placeholder="Bạn cần lưu ý gì!" rows="10"></textarea>
                        </div>
                        <div class="card-footer border-secondary bg-transparent">
                            <button name="totalfee" class="btn btn-lg btn-block btn-primary font-weight-bold my-3 py-3 totalfee" type="submit" name="send">Lưu Thông Tin</button>
                        </div>                 
                        
                    
                    </div>
                </form>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card border-secondary mb-5">
                    <div class="card-header bg-secondary border-0">
                        <h4 class="font-weight-semi-bold m-0">Hóa Đơn</h4>
                    </div>
                    <div class="card-body">
                        <h5 class="font-weight-medium mb-3">Sản Phẩm</h5>
                        @foreach($cart as $data)
                            <div class="d-flex justify-content-between">
                                <p>{{$data->name}}</p>
                                <p>{{number_format($data->price,0,',',',')}} VND</p>
                            </div>
                        @endforeach
                        <hr class="mt-0">
                        <div class="d-flex justify-content-between mb-3 pt-1">
                            <h6 class="font-weight-medium">Tổng Tiền</h6>
                            <h6 class="font-weight-medium">{{$ptotal.' '.'VND'}}</h6>
                        </div>                      
                    </div>
                    <div class="card-footer border-secondary bg-transparent">
                        <div class="d-flex justify-content-between mt-2">
                            <h5 class="font-weight-bold">Tạm tính</h5>
                            <h5 class="font-weight-bold">{{$total.' '.'VND'}}</h5>
                        </div>
                    </div>
                </div>
                @if(count($delivery)>0)
                <div class="card border-secondary mb-5">
                    <div class="card-header bg-secondary border-0">
                        <h4 class="font-weight-semi-bold m-0">Địa Chỉ Đã Lưu</h4>
                    </div> 
                    <form action="{{URL::to('/checkout/shipping')}}" method="POST" style="width:100%;">
                        @csrf                 
                    <div class="card-body">
                        @foreach($delivery as $val)
                        <div class="form-group">
                            <div class="custom-control custom-radio">
                                @if($recent->ship_id == $val['ship_id'])
                                <input type="radio" class="custom-control-input" name="address" id="address{{$val['ship_id']}}" value="{{$val['ship_id']}}" checked>
                                <label class="custom-control-label" for="address{{$val['ship_id']}}"><strong>Thông tin: </strong>{{$val['ship_name']}}, {{$val['ship_email']}},  {{$val['ship_phone']}} <br>
                                   <strong>Địa chỉ nhận hàng:</strong> {{App\Models\Commune::where('commune_id',$val['commune'])->first()->commune_name}},
                                     {{App\Models\District::where('district_id',$val['district'])->first()->district_name}}, 
                                     {{App\Models\Province::where('province_id',$val['province'])->first()->province_name}},
                                     {{$val['ship_address']}}
                                    </label>
                                @else
                                <input type="radio" class="custom-control-input" name="address" id="address{{$val['ship_id']}}" value="{{$val['ship_id']}}">
                                <label class="custom-control-label" for="address{{$val['ship_id']}}">{{$val['ship_name']}}, {{$val['ship_email']}},  {{$val['ship_phone']}}, 
                                    {{App\Models\Commune::where('commune_id',$val['commune'])->first()->commune_name}},
                                     {{App\Models\District::where('district_id',$val['district'])->first()->district_name}}, 
                                     {{App\Models\Province::where('province_id',$val['province'])->first()->province_name}},
                                     {{$val['ship_address']}}
                                </label>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div> 
                    <div class="card-footer border-secondary bg-transparent">
                        <input type="submit"class="btn btn-lg btn-block btn-primary font-weight-bold my-3 py-3" value="Xác Nhận Địa Chỉ">
                    </div> 
                    </form>     
                </div>
                @endif
            </div>
        </div>
    </div>
@stop

<a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>