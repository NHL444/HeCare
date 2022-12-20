@extends('layout.master')
@section('title','Liên Hệ')
@section('content')


    <section class="breadcrumb-section set-bg" data-setbg="/master/img/breadcrumb-bg.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb-text">
                        <h2>Phản Hồi Với Chúng Tôi!</h2>
                        <div class="bt-option">
                            <a href="{{route('home.index')}}">Trang Chủ</a>
                            <span>Liên Hệ</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="contact-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="section-title contact-title">
                        <span>Liên Hệ Với Chúng Tôi</span>
                        <h2>Thông Qua</h2>
                    </div>
                    <div class="contact-widget">
                        <div class="cw-text">
                            <i class="fa fa-map-marker"></i>
                            <p>58A, 3 tháng 2 <br> Xuân Khánh, Ninh Kiều, TPCT. <br> VietNam</p>
                        </div>
                        <div class="cw-text">
                            <i class="fa fa-clock-o"></i>
							<p>Thứ 2 - Thứ 6: 8h đến 22h<br> Thứ 7 & Chủ Nhật: 10h đến 20h </p>
						</div>
                        <div class="cw-text">
                            <i class="fa fa-mobile"></i>
                                <p>Phone: +84 355 110 420</p>
                        </div>
                        <div class="cw-text email">
                            <i class="fa fa-envelope"></i>
                            <p>Email: huuluan444@gmail.com</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="section-title contact-title">
						<span>Có phải bạn có điều gì cần nói?</span>
						<p>Lời góp ý của bạn là nguồn động lực để Trang phát triển, vui mừng khi được đánh giá tốt và khắc phục sửa chữa những sai sót!</p>
					</div>
                    @if(\Session::has('success'))
                        <div class="succWrap"><strong>Thành Công</strong>: {{ \Session::get('success') }}</div>
                    @endif
                    <div class="leave-comment">
                        <form action="{{url('/postcontact')}}" method="POST">
                            @csrf
                            <p>
                                <input type="text" name="name" placeholder="Họ Tên Khách Hàng">
                                @error('name')
                                        <span style="color: red;">{{$message}}</span>
                                @enderror
                            </p>
                            <p>
                            <input type="text" name="email" placeholder="Email">
                                @error('email')
                                        <span style="color: red;">{{$message}}</span>
                                @enderror
                            </p>
                            <p>
                                <input type="text" name="phone" placeholder="Số Điện Thoại">
                                @error('phone')
                                        <span style="color: red;">{{$message}}</span>
                                @enderror
                            </p>
                            <p>
                                <textarea name="content" placeholder="Nội Dung Phản Hồi"></textarea>
                                @error('content')
                                        <span style="color: red;">{{$message}}</span>
                                @enderror
                            </p>
                            <button type="submit">Gửi Phản Hồi</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="map">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3928.911932205573!2d105.7647401147944!3d10.024126092834607!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31a0891740040435%3A0xf676481fbae1f363!2zVmFzY2FyYSBD4bqnbiBUaMah!5e0!3m2!1svi!2s!4v1649318271945!5m2!1svi!2s" 
                    height="550" style="border:0;" allowfullscreen=""></iframe>
            </div>
        </div>
    </section>

@stop