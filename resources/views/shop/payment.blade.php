@extends('layout.shop')
@section('title', 'Shop')
@section('content')

    @section('banner')
    <div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">Thanh Toán</h1>
            <div class="d-inline-flex">
                <p class="m-0"><a href="">Home</a></p>
                <p class="m-0 px-2">-</p>
                <p class="m-0">Thanh Toán</p>
            </div>
        </div>
    </div>
    @endsection



    <div class="container-fluid pt-5">
        <div class="row px-xl-5">
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
                     
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Phí Giao Hàng</h6>
                            <h6 class="font-weight-medium">{{number_format(Session::get('fee'),0,',',',')}} VND</h6>

                        </div>
                    </div>

             
                    
                    <div class="card-footer border-secondary bg-transparent">
                        <div class="d-flex justify-content-between mt-2">
                            <h5 class="font-weight-bold">Thành Tiền</h5>
                            <h5 class="font-weight-bold">{{number_format($total,0,',',',')}} VND</h5>
                        </div>
                    </div>
                </div>

                @php
                    $vnd = $total/23881;
                    $total_paypal = round($vnd,2);
                    Session::put('paypal',$total_paypal);
                @endphp

                @if(!Session::get('success_payment_paypal')==true)
                <div class="card-footer border-secondary bg-transparent">
                    <a class="btn btn-lg btn-block btn-primary font-weight-bold my-3 py-3" href="{{ route('processTransaction') }}">Thanh Toán PayPal</a>
                </div>
                <div class="card border-secondary mb-5">
                    <div class="card-header bg-secondary border-0">
                        <h4 class="font-weight-semi-bold m-0">Phương Thức Trả</h4>
                    </div>                  
                    <form action="{{URL::to('checkout/order')}}" method="POST">
                        @csrf
                    <div class="card-body">
                        
                        <div class="form-group">
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" name="payment" id="paypal" value="Tiền mặt">
                                <label class="custom-control-label" for="paypal">Thanh toán khi nhận hàng</label>
                            </div>
                        </div>
                        <div class="">
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" name="payment" id="banktransfer" value="Thẻ tín dụng">
                                <label class="custom-control-label" for="banktransfer">Giao Dịch Ngân Hàng</label>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer border-secondary bg-transparent">
                        <input type="submit"class="btn btn-lg btn-block btn-primary font-weight-bold my-3 py-3 send" value="Thanh Toán Ngay" name="send">
                    </div>
                </form>              

                </div>
                @else
                <div class="card border-secondary mb-5">
                    <div class="card-header bg-secondary border-0">
                        <h4 class="font-weight-semi-bold m-0">Phương Thức Trả</h4>
                    </div>                  
                    <form action="{{URL::to('checkout/order')}}" method="POST">
                        @csrf
                    <div class="card-body">
                        
                        <div class="form-group">
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" name="payment" id="directcheck" checked value="Paypal">
                                <label class="custom-control-label" for="directcheck">Đã Thanh Toán Bằng Paypal</label>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer border-secondary bg-transparent">
                        <input type="submit"class="btn btn-lg btn-block btn-primary font-weight-bold my-3 py-3 send" value="Thanh Toán Ngay" name="send">
                    </div>
                </form>              
                </div>
                @endif
            </div>
            <div class="col-lg-8 table-responsive mb-5">
                <table class="table table-bordered text-center mb-0">
                    <thead class="bg-secondary text-dark">
                        <tr>
                            <th>Tên Sản Phẩm</th>
                            <th>Giá</th>
                            <th>Số Lượng</th>
                            <th>Tổng</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cart as $data)
                        <tr>
                            <td style="text-align:left;"><img src="/image/{{$data->options ->img}}" alt="" style="width:50px;"> {{$data->name}}</td>
                            <td class="align-middle">{{number_format($data->price,0,',',',')}}</td>
                            <td class="align-middle">
                                <div class="input-group quantity mx-auto" style="width: 100px;">
                                        <input type="number" @if(Session::get('success_payment_paypal')==true) readonly @endif class="quantity" name="quantity" value="{{$data->qty}}" size="2" style="text-align: center;">
                                </div>
                            </td>
                            <td class="align-middle">{{number_format($data->price*$data->qty,0,',',',')}}</td>                  
                        </tr>
                       @endforeach
                    </tbody>
                </table>
                <a href="{{asset('cart/show')}}" class="btn btn-block btn-primary my-3 py-3">Trở Về Giỏ Hàng</a>
                <div class="card-header bg-secondary border-0">
                    <h6 class="font-weight-semi-bold m-0"><a href="{{route('shop.checkform')}}" style="color: black;"><i class="fa fa-edit"></i> Đơn sẽ được giao đến {{$province->Province->province_name}}</a></h6>
                </div><br>
                @if (session('warn'))
                    <div class="alert alert-warning" style="color: red;">
                       <strong>{{ session('warn') }}</strong> 
                    </div>
                @endif
            </div>
       </div>                 
    </div>

@stop




    <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>

