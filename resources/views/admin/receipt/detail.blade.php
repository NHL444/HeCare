@extends('layout.admin')
@section('content')
<div class="row">
    <div class="col-lg-12">
      <div class="card px-2">
        <div class="card-body">
          <div class="container-fluid">
            <h3 class="my-5" style="font-size: 26px;"><strong> Phiếu Nhập Kho</strong></h3>
            <hr>
          </div>
          <div class="container-fluid d-flex justify-content-between">
            <div class="col-lg-3 ps-0">
              <p class="mb-2" style="font-size: 18px;"><b>Người Xác Nhận</b></p>
              <p style="font-size: 18px;">Luân Nguyễn</p>
            </div>
            <div class="col-lg-3 pe-0">
                <p class="mb-0 text-end" style="font-size: 18px;"><strong>Ngày Lập</strong>: {{$receipt->wr_date}}</p>
              <p class="text-end" style="font-size: 18px;"><strong>Nhà cung cấp</strong>: {{$receipt->wr_provider}}</p>
         
            </div>
          </div>
          <div class="container-fluid d-flex justify-content-between">
            <div class="col-lg-3 ps-0" >
                <p class="mb-2" style="font-size: 18px;"><b>Nhân Viên Lập Phiếu</b></p>
                <p class="text" style="font-size: 18px;">{{$staff->name}}</p>
            </div>
          </div>
          <div class="container-fluid mt-5 d-flex justify-content-center w-100">
            <div class="table-responsive w-100">
              <table class="table table-striped">
                <thead style="border: 1px solid lightgray; font-size:20px;">
                  <tr class="text-white">
                    {{-- <th>#</th> --}}
                    <th>Sản Phẩm</th>
                    <th style="font-size:20px;">Số Lượng</th>
                    <th style="font-size:20px;">Giá</th>
                    <th style="font-size:20px;">Tổng Giá</th>
                  </tr>
                </thead>
                <tbody>
                    <form action="{{route('warehouse.status',$receipt->wr_id)}}" method="POST">
                        @csrf
                    @php
                    $total = 0;
                    @endphp
                    @foreach($detail as $data)
                    @php
                        $subtotal = $data->price * $data->wrd_qty;
                        $total += $subtotal;
                        $qty=$data->wrd_qty;
                    @endphp
                  <tr style="border: 1px solid lightgray;">
                    {{-- <td class="text-start"></td> --}}
                    <td  style="font-size:18px;">{{$data->wrd_product}}</td>
                        <input type="hidden" value="{{$data->Product->pro_id}}" name="product[]">
                    <td style="font-size:18px;">{{$data->wrd_qty}}</td>
                        <input type="hidden" value="{{$data->wrd_qty}}" name="qty[]">
                    <td style="font-size:18px;">{{number_format($data->price,0,',',',')}} vnđ</td>
                        <input type="hidden" value="{{$data->price}}" name="price[]">
                    <td style="font-size:18px;">{{number_format($data->price*$data->wrd_qty,0,',',',')}} vnđ</td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
         
          <div class="container-fluid mt-5 w-100">

            <h4 class="text-end mb-5" style="font-size: 20px;">TỔNG TIỀN: {{number_format($total,0,',',',')}} vnđ</h4>
            <hr>
          </div>
          <div class="container-fluid w-100">
            <a href="#" class="btn btn-primary float-right mt-4 ms-2"><i class="mdi mdi-printer me-1"></i>Print</a>
            <input type="hidden" value="{{$total}}" name="total">
            @if(($receipt->wr_status) == 0)
                <button type="submit" class="btn btn-success float-right mt-4"><i class="mdi mdi-telegram me-1"></i>Duyệt Đơn</button>
            @else
            <a href="{{route("warehouse.manage-receipt")}}" class="btn btn-success float-right mt-4"><i class="mdi mdi-telegram me-1"></i>Phiếu Đã Duyệt</a>
            @endif
            </form>
          </div>
        </div>
      </div>
    </div>
</div>

@endsection