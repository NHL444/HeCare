@extends('layout.master')
@section('title','Giới Thiệu')
@section('content')
    <section class="breadcrumb-section set-bg" data-setbg="/master/img/breadcrumb-bg.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb-text">
                        <h2>Về Chúng Tôi</h2>
                        <div class="bt-option">
                            <a href="{{route('home.index')}}">Trang Chủ</a>
                            <span>Giới Thiệu</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('master.structure.choseus')
@stop