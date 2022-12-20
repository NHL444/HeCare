@extends('layout.shop')
@section('title', 'Sản Phẩm Hỗ Trợ')

@section('content')
    @section('banner')
        <div id="header-carousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active" style="height: 410px;">
                    <img class="img-fluid" src="/shop/img/wheyban.jpg" alt="Image">
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3" style="max-width: 700px;">
                            <h4 class="text-light text-uppercase font-weight-medium mb-3">THÁNG 12 VUI VẺ</h4>
                            <h3 class="display-4 text-white font-weight-semi-bold mb-4">MUA SẮM THẢ GA</h3>
                            <a href="" class="btn btn-light py-2 px-3">MUA NGAY</a>
                        </div>
                    </div>
                </div> 
                <div class="carousel-item" style="height: 410px;">
                    <img class="img-fluid" src="/shop/img/sport.jpg" alt="Image" >
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3" style="max-width: 700px;">
                            <h4 class="text-light text-uppercase font-weight-medium mb-3">THÁNG 12 VUI VẺ</h4>
                            <h3 class="display-4 text-white font-weight-semi-bold mb-4">PHỤ KIỆN MỚI NHẤT</h3>
                            <a href="" class="btn btn-light py-2 px-3">MUA NGAY</a>
                        </div>
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#header-carousel" data-slide="prev">
                <div class="btn btn-dark" style="width: 45px; height: 45px;">
                    <span class="carousel-control-prev-icon mb-n2"></span>
                </div>
            </a>
            <a class="carousel-control-next" href="#header-carousel" data-slide="next">
                <div class="btn btn-dark" style="width: 45px; height: 45px;">
                    <span class="carousel-control-next-icon mb-n2"></span>
                </div>
            </a>
        </div>
    @endsection
    @include('shop.structure.choseus')
@stop()
@section('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
@stop()