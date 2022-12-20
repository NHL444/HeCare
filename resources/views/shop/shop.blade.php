@extends('layout.shop')
@section('title', 'Shop')
@section('content')
@section('banner')

    <div id="header-carousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active" style="height: 410px;">
                <img class="img-fluid" src="/shop/img/wheyban.jpg" alt="Image">
                <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                    <div class="p-3" style="max-width: 700px;">
                        <h4 class="text-light text-uppercase font-weight-medium mb-3">
                            @if(isset($cat))
                                Danh Mục <strong>{{$cat->cate_name}}</strong>
                            @elseif(isset($discountTitle))
                            Danh Sách <strong>{{$discountTitle}}</strong>
                            @elseif(isset($count))
                            Đã Tìm Thấy {{count($count)}} Sản Phẩm
                            @else
                            Tất cả Sản Phẩm
                            @endif
                        </h4>
                        <h3 class="display-4 text-white font-weight-semi-bold mb-4">MUA SẮM THẢ GA</h3>
                        <a href="" class="btn btn-light py-2 px-3">MUA NGAY</a>
                    </div>
                </div>
            </div> 
        </div>
    </div>
@endsection
<!-- Page Header End -->


<!-- Shop Start -->
<div class="container-fluid pt-5">
    <div class="row px-xl-5">
        <!-- Shop Sidebar Start -->
        <div class="col-lg-3 col-md-12">
            <div class="border-bottom mb-4 pb-4">
                <h5 class="font-weight-semi-bold mb-4">Lọc Giá</h5>
                <div id="slider-range"></div> <br>
                    <input type="text" id="amount" readonly style="border: 0">
                    <input size="2" type="hidden" id="from" name="from">
                    <input size="2" type="hidden" id="to" name="to"><br>
            </div>
            <!-- Price End -->
            

            <div class="border-bottom mb-4 pb-4">
                <h5 class="font-weight-semi-bold mb-4">Thương Hiệu</h5>
                @foreach($brand as $val)
                <div class="custom-control d-flex custom-checkbox align-items-center justify-content-between mb-3">
                    <input type="checkbox" class="custom-control-input filterbr brand" name="brand" value="{{$val->br_id}}" id="{{$val->br_id}}">
                    <label class="custom-control-label" for="{{$val->br_id}}">{{$val->br_name}}</label>
                </div>
                @endforeach
            </div>
         
         
    
        </div>
   


        <!-- Shop Product Start -->
        <div class="col-lg-9 col-md-12">
            @if(!$product->count())
                    <div class="alert alert-warning">Chưa có sản phẩm</div>
                @else
            <div class="row pb-3" id="updatediv">
                @include('shop.structure.searchfor') 
                @foreach($product as $val)
                <div class="col-lg-4 col-md-6 col-sm-12 pb-1">
                    <div class="card product-item border-0 mb-4">
                        <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                            @if($val->pro_discount)
                                <h4><span class="badge badge-warning discount-tag">-{{$val->pro_discount}}%</span></h4>
                             @endif
                            <img class="img-fluid w-100" src="/image/{{$val->pro_image}}" alt="">
                        </div>
                        <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                            <h6 class="text-truncate mb-3">{{$val->pro_name}}</h6>
                            <div class="d-flex justify-content-center">
                                <h6 style="font-size: 20px; font-weight:bold;">{{number_format($val->pro_sell,0,',',',')}}</h6>
                                @if($val->pro_discount)
                                    <h6 style="font-size: 20px;" class="text-muted ml-2"><del>{{number_format($val->pro_price + ($val->pro_price*$val->pro_profit/100),0,',',',')}}</del></h6>
                                @endif
                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-between bg-light border">
                            <a href="{{asset('/shop/detail/'.$val->pro_id)}}" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>Xem Chi Tết</a>
                            <a href="{{asset('cart/add/'.$val->pro_id)}}" class="btn btn-sm text-dark p-0"><i class="fas fa-shopping-cart text-primary mr-1"></i>Thêm Vào Giỏ Hàng</a>
                        </div>
                    </div>
                </div>
                @endforeach
                <div class="col-12 pb-1">
                    {!!$product->links("pagination::bootstrap-4")!!}
                </div>
            </div>
            @endif
        </div>
        <!-- Shop Product End -->
    </div>
</div>
@stop()
@section('js')
<script type="text/javascript">
    $(function(){
        $('#slider-range').slider({
            orientation: "horizontal",
            range: true,
            min: 0,
            max:3000000,
            values:[0,3000000],
            slide: function(event,ui){
                $( "#amount" ).val( ui.values[ 0 ] + "đ" + " - " + ui.values[ 1 ] + "đ");
                $("#from").val(ui.values[0]);
                $("#to").val(ui.values[1]);
                var start = $('#from').val();
                var end = $('#to').val();
            
            $.ajax({
                type:'get',
                dataType:'html',
                url:'',
                data:"start=" + start + "& end=" + end,
                success:function(response){
                    console.log(response);
                    $('#updatediv').html(response);
                }
            });
        }
        
        });
        $( "#amount" ).val($( "#slider-range" ).slider( "values", 0 ) + "đ" +
        " - " + $( "#slider-range" ).slider( "values", 1 ) + "đ");
        $('.filterbr').click(function(){
            var brand = [];
            $('.filterbr').each(function(){
                if($(this).is(":checked")){
                    brand.push($(this).val());
                }
            });
            Filterbrand = brand.toString();

            $.ajax({
                type:'get',
                dataType:'html',
                url:'',
                data:"brand=" + Filterbrand,
                success:function(response){
                    console.log(response);
                    $('#updatediv').html(response);
                }
            });
        });
    });
    

</script>
@stop()