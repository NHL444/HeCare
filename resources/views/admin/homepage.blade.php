@extends('layout.admin')
@section('content')
{{-- Thông báo --}}
    @if (session('warn'))
        <div class="alert alert-warning">
            {{ session('warn') }}
        </div>
    @elseif (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
      </div>
    @endif

  {{-- Thống kê số lượng --}}
    <div class="row">
      @if($user->role == 1)
      <div class="col-sm-4 grid-margin">
        <div class="card">
          <div class="card-body">
            <h5 class="card-home" style="font-size: 1.3em;">Doanh Thu</h5>
            <div class="row">
              <div class="col-8 col-sm-12 col-xl-8 my-auto">
                <div class="d-flex d-sm-block d-md-flex align-items-center">
                  <h2 class="mb-0">{{ number_format($total_money) }}</h2>
                </div>
                <h6 class="text-muted font-weight-normal">vnđ</h6>
              </div>
              <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right">
                <a style="cursor: pointer;" data-toggle="modal" data-target="#myModal"> <i class="icon-lg mdi mdi-coin text-success ml-auto"></i></a>
              </div>
              <!-- Modal -->
              <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Doanh Thu</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <h3>Tổng Doanh Thu (trừ ship)</h3>
                      <h3 style="text-align: right; color:red;">{{ number_format($total_money) }} VND</h3>
                      <hr>
                      <h3>Tiền Vốn</h3>
                      <h3 style="text-align: right; color:red;">{{ number_format($total_cost_price) }} VND</h3>
                      <hr>
                      <h3>Lợi Nhuận</h3>
                      <h3 style="text-align: right; color:red;">{{ number_format($profit) }} VND</h3>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      @endif
      <div class="col-sm-4 grid-margin">
        <div class="card">
          <div class="card-body">
            <h5 class="card-home" style="font-size: 1.3em;">Tổng Mặt Hàng Đang Bán</h5>
            <div class="row">
              <div class="col-8 col-sm-12 col-xl-8 my-auto">
                <div class="d-flex d-sm-block d-md-flex align-items-center">
                  <h2 class="mb-0">{{count($product)}}</h2>
                </div>
                <h6 class="text-muted font-weight-normal">sản phẩm</h6>
              </div>
              <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right">
                <i class="icon-lg mdi mdi-dumbbell text-warning ml-auto"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-4 grid-margin">
        <div class="card">
          <div class="card-body">
            <h5 class="card-home" style="font-size: 1.3em;">Tổng Thành Viên</h5>
            <div class="row">
              <div class="col-8 col-sm-12 col-xl-8 my-auto">
                <div class="d-flex d-sm-block d-md-flex align-items-center">
                  <h2 class="mb-0">20</h2>
                </div>
                <h6 class="text-muted font-weight-normal">tài khoản</h6>
              </div>
              <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right">
              <i class="icon-lg mdi mdi-account-group text-primary ml-auto"></i>
              </div>
              
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-4 grid-margin">
        <div class="card">
          <div class="card-body">
            <h5 class="card-home" style="font-size: 1.3em;">Tổng Bài Viết</h5>
            <div class="row">
              <div class="col-8 col-sm-12 col-xl-8 my-auto">
                <div class="d-flex d-sm-block d-md-flex align-items-center">
                  <h2 class="mb-0">{{count($news)}}</h2>
                </div>
                <h6 class="text-muted font-weight-normal">bài đăng</h6>
              </div>
              <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right">
              <i class="icon-lg mdi mdi-newspaper text-primary ml-auto"></i>
              </div>
              
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-4 grid-margin">
        <div class="card">
          <div class="card-body">
            <h5 class="card-home" style="font-size: 1.3em;">Tổng Sản Phẩm Đã Bán</h5>
            <div class="row">
              <div class="col-8 col-sm-12 col-xl-8 my-auto">
                <div class="d-flex d-sm-block d-md-flex align-items-center">
                  <h2 class="mb-0">{{$sold}}</h2>
                </div>
                <h6 class="text-muted font-weight-normal">sản phẩm</h6>
              </div>
              <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right">
              <i class="icon-lg mdi mdi-cash text-success ml-auto"></i>
              </div>
              
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-4 grid-margin">
        <div class="card">
          <div class="card-body">
            <h5 class="card-home" style="font-size: 1.3em;">Tổng Đơn Hàng Đã Giao</h5>
            <div class="row">
              <div class="col-8 col-sm-12 col-xl-8 my-auto">
                <div class="d-flex d-sm-block d-md-flex align-items-center">
                  <h2 class="mb-0">{{$delivered}}</h2>
                </div>
                <h6 class="text-muted font-weight-normal">đơn</h6>
              </div>
              <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right">
              <i class="icon-lg mdi mdi-cached text-warning ml-auto"></i>
              </div>
              
            </div>
          </div>
        </div>
      </div>
    </div>

  {{-- Thống kê doanh thu --}}
    @if($user->role == 1)
    <div class="row">
      <div class="col-12 grid-margin">
        <div class="card">
          <div class="card-body">
            <h4 class="card-home">Thống Kê Doanh Số Bán Hàng</h4>
            <div class="row">
              <div class="col-md-3">
                  <form autocomplete="off">
                    @csrf
                    <div class="col-md-9">
                      <p>Từ ngày: <input type="text" id="from" class="form-control"> </p>
                    
                    </div>
                    <div class="col-md-9">
                      <p>Đến ngày: <input type="text" id="to" class="form-control"> </p>
                    </div>
                    <input type="button" class="btn btn-primary" name="btn-filter" id="btn-filter" value="Thống kê">
    
                    <div class="col-md-9" style="padding-top: 10px">
                      <p>Lọc theo:
                        <select class="time-filter form-control" style="border:1px solid;">
                            <option>Thời Gian</option>
                            <option value="7ngay">7 ngày qua</option>
                            <option value="thangtruoc">Tháng trước</option>
                            <option value="thangnay">Tháng này</option>
                            <option value="3thang">3 Tháng</option>
                            <option value="year">365 ngày qua</option>
                        </select>
                      </p>
                    </div>
                  </form>
              </div>
              <div class="col-md-9">
                <div class="col-md-12">
                  <div id="showchart" style="height: 300px;"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    @endif
  {{-- Đơn hàng gần đây --}}
    <div class="row">
      <div class="col-12 grid-margin">
        <div class="card">
          <div class="card-body">
            <h4 class="card-home">Đơn Hàng Gần Đây</h4>
            <div class="table-responsive">
              <table class="table table-striped">
                <thead>
                  <tr style=" background-color:palegoldenrod; text-align:center; border: 1px solid lightgray;">
                    <th> Tên Khách Hàng </th>
                    <th> Ngày Đặt </th>
                    <th> Tổng Hóa Đơn </th>
                </thead>
                <tbody>
                  @foreach ($data as $data)
                      <tr style="text-align: center; border: 1px solid lightgray;">
                          <td style="font-size:18px; color:mediumblue">{{$data->cus_name}}</td>
                          <td style="font-size:18px;">{{$data->order_date}}</td>
                          <td style="font-size:18px; color:red;">{{number_format($data->order_total,0,',',',')}}đ</td>        
                      </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>

  {{-- Sản Phẩm Bán Chạy --}}
    <div class="row grid-margin">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h4 class="card-home">Sản Phẩm Bán Nhiều</h4>
            <div class="owl-carousel owl-theme loop"  style="text-align: center;">
              @foreach($lot as $val)
              <div class="item">
                <a href="{{route('product.edit',$val->pro_id)}}"><img src="/image/{{$val->pro_image}}" /></a>
                <button class="btn btn-inverse-warning btn-fw">Bán Ra: {{$val->pro_sold}} sản phẩm</button>
              </div>
              @endforeach
            </div>
          </div>
        </div>
      </div>
    </div>

@endsection