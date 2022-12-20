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
                <p class="m-0">Hồ Sơ Cá Nhân</p>
            </div>
        </div>
    </div>
    @endsection

    <div class="container-fluid pt-5">
       
        <div class="row px-xl-5">
            <div class="col-lg-7 mb-5">
               
                <div class="d-flex flex-column mb-3">
                    <h4 class="font-weight-semi-bold mb-3">Thông Tin Cá Nhân</h4>
                    <h5 class="mb-2"><i class="fa fa-user text-primary mr-3"></i>{{$cus->cus_name}}</h5>
                    <h5 class="mb-2"><i class="fa fa-envelope text-primary mr-3"></i>{{$cus->cus_email}}</h5>
                    <h5 class="mb-2"><i class="fa fa-phone-alt text-primary mr-3"></i>{{$cus->cus_phone}}</h5>
                </div>
                @if(Session::get('ship_id')!=NULL)
                <div class="d-flex flex-column mb-3">
                    <h4 class="font-weight-semi-bold mb-3">Thông Tin Vận Chuyển</h4>
                    <h5 class="mb-2"><i class="fa fa-user text-primary mr-3"></i>{{$ship->ship_name}}</h5>
                    <h5 class="mb-2"><i class="fa fa-envelope text-primary mr-3"></i>{{$ship->ship_email}}</h5>
                    <h5 class="mb-2"><i class="fa fa-phone-alt text-primary mr-3"></i>{{$ship->ship_phone}}</h5>
                    <h5 class="mb-2"><i class="fa fa-map-marker-alt text-primary mr-3"></i>{{$ship->ship_address}}, {{$ship->Commune->commune_name}}, {{$ship->District->district_name}}, {{$ship->Province->province_name}}</h5>
                </div>
                @else
                <a href="{{route("shop.checkform")}}" class="btn btn-primary py-2 px-4" id="sendMessageButton">Thêm Nơi Vận Chuyển</a>
                @endif
            </div>
            <div class="col-lg-5 mb-5">
                <div class="text-center mb-4">
                    <h4 class="section-title px-5"><span class="px-2">Đổi Mật Khẩu</span></h4>
                </div>
                <div class="contact-form">
                    <div id="success"></div>
                    <form  class="form" action="{{route('shop.changepass')}}" method="post" onsubmit="return submitForm(this);">
                        @csrf
                        <div class="control-group" style="position: relative;">
                            <input type="password" class="form-control" id="current_password" name="current_password" placeholder="Mật Khẩu Hiện Tại" >
                            {{-- <a href="javascript:void(0)" style="position:absolute;"><i class="fa fa-eye"></i></a> --}}
                            @error('current_password')
                                <span style="color: red;">{{$message}}</span>
                            @enderror
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="control-group">
                            <input type="password" class="form-control" id="new_password" name="new_password" placeholder="Mật Khẩu Mới">
                            @error('new_password')
                                <span style="color: red;">{{$message}}</span>
                            @enderror
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="control-group">
                            <input type="password" class="form-control" id="new_password_confirmation" placeholder=" Xác Nhận Mật Khẩu Mới" name="new_password_confirmation">
                            <p class="help-block text-danger"></p>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary py-2 px-4 consider" id="sendMessageButton">Thay Đổi</button>
                        </div>
                        
                    </form>
                </div>
            </div>           
        </div>
    </div>
@stop()
@section('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
@stop()
@section('script')
<script>
    $(function(){
        $(".control-group a").click(function(){
            let $this = $(this);

            if($this.hasClass('active')){
                $this.parents('.form-control').find('input').attr('type','password')
                $this.removeClass('active');
            }else{
                $this.parents('.form-control').find('input').attr('type','text')
                $this.addClass('active')
            }
        });
    });
</script>
@stop()

<a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>

