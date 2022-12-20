@extends('layout.master')
@section('title','Trang Chủ')
@section('content')
	@include('master.structure.banner')
    @include('master.structure.choseus')
    @include('master.structure.article')

    <section class="banner-section set-bg" data-setbg="/master/img/banner-bg.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="bs-text">
                        <h2>ĐĂNG KÝ TÀI KHOẢN ĐỂ MUA HÀNG NGAY THÔI</h2>
                        <div class="bt-tips">ĐÃ CÓ KIẾN THỨC, GIỜ CHỈ CẦN SẢN PHẨM HỖ TRỠ</div>
                        <a href="{{URL::to('/checkout/logincheck#signup')}}" class="primary-btn  btn-normal">ĐĂNG KÝ NGAY</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="team-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="team-title">
                        <div class="section-title">
                            <span>Bài Viết</span>
                            <h2>Hôm Nay Có Gì?</h2>
                        </div>
                        <a href="" class="primary-btn btn-normal appoinment-btn">Đọc Ngay</a>
                    </div>
                </div>
            </div>
            <div class="row">
                
                <div class="ts-slider owl-carousel">
                    @foreach($news as $val)
                    <div class="col-lg-4">
                        <div class="ts-item set-bg" data-setbg="/photo/{{$val->atl_photo}}">
                            <div class="ts_text">
                                <h4><a href="{{asset('/home/newsread/'.$val->id)}}" style="color: #FFC20E">{{$val->atl_title}}</a></h4>
                                <span>{{$val->atl_topic}}</span>
                            </div>
                        </div>
                    </div> 
                    @endforeach                
                </div>
            </div>
        </div>
    </section>

    <div class="gettouch-section">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="gt-text">
                        <i class="fa fa-map-marker"></i>
                        <p>58A, 3 tháng 2, Xuân Khánh, Ninh Kiêù <br/>Cần Thơ - Việt Nam</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="gt-text">
                        <i class="fa fa-mobile"></i>
                        <ul>
                            <li>035-511-0420</li>
                            <li>035-577-5200</li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="gt-text email">
                        <i class="fa fa-envelope"></i>
                        <p>huuluan444@gmail.com</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop

    {{-- <section class="pricing-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <span>Our Plan</span>
                        <h2>Choose your pricing plan</h2>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-4 col-md-8">
                    <div class="ps-item">
                        <h3>Class drop-in</h3>
                        <div class="pi-price">
                            <h2>$ 39.0</h2>
                            <span>SINGLE CLASS</span>
                        </div>
                        <ul>
                            <li>Free riding</li>
                            <li>Unlimited equipments</li>
                            <li>Personal trainer</li>
                            <li>Weight losing classes</li>
                            <li>Month to mouth</li>
                            <li>No time restriction</li>
                        </ul>
                        <a href="#" class="primary-btn pricing-btn">Enroll now</a>
                        <a href="#" class="thumb-icon"><i class="fa fa-picture-o"></i></a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-8">
                    <div class="ps-item">
                        <h3>12 Month unlimited</h3>
                        <div class="pi-price">
                            <h2>$ 99.0</h2>
                            <span>SINGLE CLASS</span>
                        </div>
                        <ul>
                            <li>Free riding</li>
                            <li>Unlimited equipments</li>
                            <li>Personal trainer</li>
                            <li>Weight losing classes</li>
                            <li>Month to mouth</li>
                            <li>No time restriction</li>
                        </ul>
                        <a href="#" class="primary-btn pricing-btn">Enroll now</a>
                        <a href="#" class="thumb-icon"><i class="fa fa-picture-o"></i></a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-8">
                    <div class="ps-item">
                        <h3>6 Month unlimited</h3>
                        <div class="pi-price">
                            <h2>$ 59.0</h2>
                            <span>SINGLE CLASS</span>
                        </div>
                        <ul>
                            <li>Free riding</li>
                            <li>Unlimited equipments</li>
                            <li>Personal trainer</li>
                            <li>Weight losing classes</li>
                            <li>Month to mouth</li>
                            <li>No time restriction</li>
                        </ul>
                        <a href="#" class="primary-btn pricing-btn">Enroll now</a>
                        <a href="#" class="thumb-icon"><i class="fa fa-picture-o"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}

    {{-- <div class="gallery-section">
        <div class="gallery">
            <div class="grid-sizer"></div>
            <div class="gs-item grid-wide set-bg" data-setbg="/master/img/gallery/gallery-1.jpg">
                <a href="/master/img/gallery/gallery-1.jpg" class="thumb-icon image-popup"><i class="fa fa-picture-o"></i></a>
            </div>
            <div class="gs-item set-bg" data-setbg="/master/img/gallery/gallery-2.jpg">
                <a href="/master/img/gallery/gallery-2.jpg" class="thumb-icon image-popup"><i class="fa fa-picture-o"></i></a>
            </div>
            <div class="gs-item set-bg" data-setbg="/master/img/gallery/gallery-3.jpg">
                <a href="/master/img/gallery/gallery-3.jpg" class="thumb-icon image-popup"><i class="fa fa-picture-o"></i></a>
            </div>
            <div class="gs-item set-bg" data-setbg="/master/img/gallery/gallery-4.jpg">
                <a href="/master/img/gallery/gallery-4.jpg" class="thumb-icon image-popup"><i class="fa fa-picture-o"></i></a>
            </div>
            <div class="gs-item set-bg" data-setbg="/master/img/gallery/gallery-5.jpg">
                <a href="/master/img/gallery/gallery-5.jpg" class="thumb-icon image-popup"><i class="fa fa-picture-o"></i></a>
            </div>
            <div class="gs-item grid-wide set-bg" data-setbg="/master/img/gallery/gallery-6.jpg">
                <a href="/master/img/gallery/gallery-6.jpg" class="thumb-icon image-popup"><i class="fa fa-picture-o"></i></a>
            </div>
        </div>
    </div> --}}
