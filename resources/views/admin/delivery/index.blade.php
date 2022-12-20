@extends('layout.admin')
@section('add')
    <a class="nav-link btn btn-success create-new-button" href="{{route('feeship.feemanage')}}">+ Thêm Phí Vận Chuyển</a>
@stop()
@section('content')
    <div class="col-md-12 col-sm-12  ">
        <div class="x_panel">
            <div class="x_title">
                <h2>Liệt Kê Phí</h2>
                
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <span id="fee-success"></span><br>
                <form action="">
                    @csrf
                    <table class="table table-striped" id="myTable">
                        <thead style="background: palegoldenrod">                       
                            <tr style="border: 1px solid lightgray;">
                                <th style="text-align: center">Tỉnh/Thành Phố</th>
                                <th style="text-align: center">Quận/Huyện/Thị Xã</th>
                                <th style="text-align: center">Xã/Phường/Thị Trấn</th>
                                <th style="text-align: center">Phí Vận Chuyên</th>
                                <th style="text-align: center">Thao Tác </th>
                            </tr>                  
                        </thead>
                        <tfoot style="background: palegoldenrod">                       
                            <tr style="border: 1px solid lightgray;">
                                <th style="text-align: center">Tỉnh/Thành Phố</th>
                                <th style="text-align: center">Quận/Huyện/Thị Xã</th>
                                <th style="text-align: center">Xã/Phường/Thị Trấn</th>
                                <th style="text-align: center">Phí Vận Chuyển</th>
                                <th style="text-align: center">Thao Tác </th>
                            </tr>                  
                        </tfoot>
                        <tbody style="text-align: center">
                            @foreach ($list as $data)
                            <tr style="border: 1px solid lightgray;">
                                <td style="font-size:18px;">{{$data->Province->province_name}}</td>
                                <td style="font-size:20px;">{{$data->District->district_name}}</td>
                                <td style="font-size:18px;">{{$data->Commune->commune_name}}</td>
                                <td contenteditable class="editfeeship" style="font-size:20px;" data-fee_id="{{$data->fee_id}}">{{number_format($data->fee_payable,0,',',',')}}</td>
                                <td>   
                                    <a href="#" data-id="{{$data->fee_id}}" data-delname="phí vận chuyển" data-path="/admin/feeship-del/" class="btn btn-secondary del"><i class="mdi mdi-delete" style="font-size: 28px; color: red;"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </form>
            <br>
                {{-- {!!$order->links("pagination::bootstrap-4")!!} --}}
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
@stop()
@section('js')
<script type="text/javascript">
      $(document).ready(function(){
        $(document).on('blur','.editfeeship',function(){
            var fee_id= $(this).data('fee_id');
            var new_fee = $(this).text();
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url:"{{url('/admin/feeship/editfee')}}",
                method:"POST",
                data:{fee_id:fee_id,new_fee:new_fee,_token:_token},
                success:function(data){
                    $('#fee-success').html('<span class="text-success">Phí Vận Chuyển Mới Đã Được Cập Nhật!</span>');
                }
            });
        });
      });
</script>
@stop()
