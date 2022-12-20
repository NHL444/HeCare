@extends('layout.master')
@section('title','Bài Viết')
@section('content')

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="/master/img/breadcrumb-bg.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb-text">
                        <h2>{{$atype->atp_name}}</h2>
                        <div class="bt-option">
                            <a href="./index.html">Trang Chủ</a>
                            <span>{{$atype->atp_name}}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Services Section Begin -->
    <section class="services-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <span>Kiến Thức Tập Luyện</span>
                        <h2>Tất Cả Bài Viết Liên Quan</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach($news as $val)
                
                <div class="col-lg-3 col-md-6 p-0">
                    <div class="ss-pic" style="margin-top: 25px; height: 200px;">
                        <img src="/photo/{{$val->atl_photo}}" alt="">
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 p-0">
                    <div class="ss-text">
                        <h4>{{$val->atl_title}}</h4>
                        <p>{{ \Illuminate\Support\Str::limit($val->atl_descript, 100, '...') }}</p>
                        <a href="{{asset('/home/newsread/'.$val->id)}}">Đọc Ngay</a>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="float-right col-12 " style="padding-top: 15px;">
                {!!$news->links("pagination::bootstrap-4")!!}
            </div>
        </div>
    </section>

@stop


