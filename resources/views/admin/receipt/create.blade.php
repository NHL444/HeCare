@extends('layout.admin')
@section('add')
    <a class="nav-link btn btn-warning create-new-button" href="{{route('warehouse.manage-receipt')}}"><<< Danh Sách Phiếu Nhập Hàng</a>
@stop()
@section('content')

<div class="col-md-12 ">
  <div class="x_panel">
      <div class="x_title">
          <h2>Lập Phiếu Nhập Kho Mới!</h2>  
          <div class="clearfix"></div>
      </div>
      <div class="row">   
          <div class="col-lg-12">
              <div class="x_content">
              <br />
                  @if(\Session::has('success'))
                      <div class="succWrap"><strong>Thành Công</strong>: {{ \Session::get('success') }}</div>
                  @elseif(\Session::has('error'))
                      <div class="alert alert-danger">
                        {{ session('error') }}
                      </div>
                  @endif
                      <form class="form repeater-default" action="{{route('warehouse.create')}}" method="POST">
                        @csrf
                      <div class="form-group row">
                        <div class="col-md-3">
                          <label><strong>Người Lập Phiếu</strong></label>
                          <select name="staff" class="form-control" style="border: 1px solid;">
                            <option>Ai Lập Phiếu</option>
                            @foreach($staff as $val)
                                <option value="{{$val->id}}">{{$val->name}}</option>                      
                            @endforeach
                        </select>
                        </div>
                        <div class="col-md-3">
                          <label><strong>Nhà Cung Cấp</strong> </label>
                            <input class="form-control" type="text" name="provider" placeholder="Tên nhà cung cấp">
                        </div>
                        <div class="col-md-3 col-sm-12 form-group d-flex align-items-center pt-4">
                          <button class="btn btn-success" type="submit">
                              Tạo phiếu
                          </button>
                          </div>
                      </div>
                      </form>
                          

              </div>
          </div> 
      </div>
  </div>
</div>

<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="row">
        <div class="col-lg-12">
          <div class="card-body">
              <form class="form repeater-default" action="{{route('warehouse.update')}}" method="POST">
                  @csrf
              <div data-repeater-list="group_a">
                  <div data-repeater-item>
                  <div class="row justify-content-between">
                      <div class="col-md-3 col-sm-12 form-group">
                          <label for="pro_name"><strong>Tên Sản Phẩm</strong></label>
                          <select name="pro_name" class="form-control" style="border: 1px solid;" >
                              <option>Sản Phẩm</option>
                              @foreach($product as $val)
                                  <option value="{{$val->pro_name}}">{{$val->pro_name}}</option>                      
                              @endforeach
                          </select>
                      </div>
                      <div class="col-md-3 col-sm-12 form-group">
                      <label for="qty"><strong>Số Lượng</strong></label>
                      <input type="text" class="form-control" name="qty" placeholder="Nhập số lượng">
                      </div>
                      <div class="col-md-3 col-sm-12 form-group">
                          <label for="price"><strong>Giá Nhập Vào</strong></label>
                          <input type="text" class="form-control" name="price" value="{{old('price')}}">
                      </div>
                      <div class="col-md-3 col-sm-12 form-group d-flex align-items-center pt-2">
                      <button class="btn btn-danger" data-repeater-delete type="button"> <i class="bx bx-x"></i>
                          Xóa
                      </button>
                      </div>
                  </div>
                  <hr>
                  </div>
              </div>
              <div class="form-group">
                  <div class="col p-0">
                  <button class="btn btn-primary" data-repeater-create type="button"><i class="fa fa-plus"></i>
                      Thêm
                  </button>
                  <button class="btn btn-success" type="submit">
                      Tạo
                  </button>
                  </div>
              </div>
              </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@stop()
@section('js')
<script>
    $('.repeater-default').repeater({
  show: function () {
    $(this).slideDown();
  },
  hide: function (deleteElement) {
    if (confirm('Are you sure you want to delete this element?')) {
      $(this).slideUp(deleteElement);
    }
  }
});
</script>
@stop()


