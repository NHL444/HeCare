<!DOCTYPE html>
<html lang="en">
  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Trang Admin</title>

    {{-- css Template --}}
    <link rel="stylesheet" href="/admin/assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="/admin/assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="/admin/assets/vendors/jvectormap/jquery-jvectormap.css">
    <link rel="stylesheet" href="/admin/assets/vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="/admin/assets/vendors/owl-carousel-2/owl.carousel.min.css">
    <link rel="stylesheet" href="/admin/assets/vendors/owl-carousel-2/owl.theme.default.min.css">

    {{-- css su dung --}}
    <link rel="stylesheet" href="/admin/assets/css/style.css">
    <link rel="stylesheet" href="/admin/assets/css/sweetalert.css">
    <link rel="shortcut icon" href="assets/images/favicon.png" />
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
    <link rel="stylesheet" href="/admin/assets/vendors/datatables/dataTables.bootstrap4.min.css" >
    
    
  </head>
  <body>
    <div class="container-scroller">
        @include('admin.structure.sidebar')
        <div class="container-fluid page-body-wrapper">
          @include('admin.structure.header')
          <div class="main-panel">
            <div class="content-wrapper">
              @yield('content')
            </div>
          </div>  
        </div>
      </div>
     
      <script src="{{asset('/admin/assets/vendors/js/vendor.bundle.base.js')}}"></script>
      <script src="/admin/assets/vendors/owl-carousel-2/owl.carousel.min.js"></script>
      <script src="/admin/assets/js/owl-carousel.js"></script>
   
      <script src="{{asset('/admin/assets/vendors/jquery.repeater/jquery.repeater.min.js')}}"></script>
      <script src="/admin/assets/js/misc.js"></script>
      <script src="/admin/assets/js/sweetalert.min.js"></script>
      <script src="/master/js/bootstrap.min.js"></script>  
      @yield('js')

      
  {{-- Soạn Thảo --}}
    <script src="/ckeditor/ckeditor.js"></script>
    <script src="/ckfinder/ckfinder.js"></script>
    <script>      
      CKEDITOR.replace( 'ckeditor', {
          filebrowserBrowseUrl: '/ckfinder/ckfinder.html',
          filebrowserUploadUrl: '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files'
      } );
    </script>

  {{-- alert-sweet --}}
    <script
      src="https://code.jquery.com/jquery-3.6.1.js"
      integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI="
      crossorigin="anonymous">
    </script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    {{-- alert-del --}}
    <script type="text/javascript">
      $('.del').click(function(){
        var del = $(this).attr('data-id');
        var delname = $(this).attr('data-delname'); 
        var delpath = $(this).attr('data-path'); 
        swal({
          title: "Bạn có chắc muốn xóa?",
          text: "Việc làm này sẽ xóa "+delname+" vĩnh viễn và không thể phục hồi! ",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            window.location = ""+delpath+""+del+""
            swal("Hoàn tất, đã xóa công việc!", {
              icon: "success",
            });
          }
        });
      });
    </script>
  {{-- Calendar --}}
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script type="text/javascript">
    $( function() {
      $( "#from" ).datepicker({
        prevText:"Tháng trước",
        nextText:"Tháng sau",
        dateFormat:"yy-mm-dd",
        dayNamesMin: [ "CN", "Hai", "Ba", "Tư", "Năm", "Sáu", "Bảy" ],
        monthNames: [ "Tháng 1", "Tháng 2", "Tháng 3", "Tháng 4", "Tháng 5", "Tháng 6", "Tháng 7", "Tháng 8", "Tháng 9", "Tháng 10", "Tháng 11", "Tháng 12" ],
        duration:"slow"
      });
      $( "#to" ).datepicker({
        prevText:"Tháng trước",
        nextText:"Tháng sau",
        dateFormat:"yy-mm-dd",
        dayNamesMin: [ "CN", "Hai", "Ba", "Tư", "Năm", "Sáu", "Bảy" ],
        monthNames: [ "Tháng 1", "Tháng 2", "Tháng 3", "Tháng 4", "Tháng 5", "Tháng 6", "Tháng 7", "Tháng 8", "Tháng 9", "Tháng 10", "Tháng 11", "Tháng 12" ],
        duration:"slow"
      });
    } );
    </script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
          chart30daysorder();

          var chart = new Morris.Line({
                            element: 'showchart',

                            lineColors: ['#819C79', 'red', 'green', 'blue'],

                            pointFillColors: ['#ffffff'],
                            pointStrokeColors: ['black'],
                              fillOpacity: 0.6,
                              hideHover: 'auto',
                              parseTime: false,

                              xkey: 'date',
                              ykeys: ['order','price','profit','quantity'],
                              behaveLikeLine: true,
                              labels: ['đơn hàng', 'doanh số', 'lợi nhuận', 'số lượng']
          });
          function chart30daysorder(){
            
          };

          $('.time-filter').change(function(){
            var time = $(this).val();
            var _token = $('input[name="_token"]').val();
            $.ajax({
                  url:"{{url('/admin/filter-time')}}",
                  method:"POST",
                  dataType:"JSON",
                  data:{time:time,_token:_token},
                  success:function(data){
                      chart.setData(data);
                  }
              });
          });

          $('#btn-filter').click(function(){
            var _token = $('input[name="_token"]').val();
            var fromdate = $('#from').val();
            var todate = $('#to').val();
            $.ajax({
                  url:"{{url('/admin/filter-revenue')}}",
                  method:"POST",
                  dataType:"JSON",
                  data:{fromdate:fromdate,todate:todate,_token:_token},
                  success:function(data){
                      chart.setData(data);
                  }
              });
          });

        });
    </script>
  {{-- Sắp xếp --}}
    <script src="/admin/assets/vendors/datatables/jquery.dataTables.min.js"></script>
    <script src="/admin/assets/vendors//datatables/dataTables.bootstrap4.min.js"></script>
    <script src="/admin/assets/js/datatables-demo.js"></script>
  {{-- Thư viện ảnh --}}
    <script type="text/javascript">
      $(document).ready(function(){
        load_gallery();

        function load_gallery(){
            var gl_product = $('.gl_product').val();
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url:"{{url('/admin/product/load-gallery')}}",
                method:"POST",
                data:{gl_product:gl_product,_token:_token},
                success:function(data){
                    $('#gallery_load').html(data);
                }
            });
        }
        $('#file').change(function(){
            var err = '';
            var files = $('#file')[0].files;
            if(files.length>5){
              err+='<p>Tối Đa Chọn Chỉ Được 5 Ảnh!</p>'
            }else if(files.length==''){
              err+='<p>Không Được Bỏ Trống Ảnh!</p>'
            }else if(files.size > 2000000){
              err+='<p>File Không Vượt Quá 2M!</p>'
            }
            if(err==''){
              
            }else{
              $('#file').val('');
              $('#error_gallery').html('<span class="text-danger">'+err+'</span>');
              return false;
            }
        });
        $(document).on('blur','.edit',function(){
            var gly_id= $(this).data('gly_id');
            var new_name = $(this).text();
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url:"{{url('/admin/product/update-gallery')}}",
                method:"POST",
                data:{gly_id:gly_id,new_name:new_name,_token:_token},
                success:function(data){
                    load_gallery();
                    $('#error_gallery').html('<span class="text-success">Tên Hình Ảnh Đã Được Thay Đổi!</span>');
                }
            });
        });
        $(document).on('click','.delete',function(){
            var gly_id= $(this).data('gly_id');
            var _token = $('input[name="_token"]').val();
            if(confirm('Bạn Chắc Chắn Muốn Xóa Ảnh Này?')){
              $.ajax({
                  url:"{{url('/admin/product/delete-gallery')}}",
                  method:"POST",
                  data:{gly_id:gly_id,_token:_token},
                  success:function(data){
                      load_gallery();
                      $('#error_gallery').html('<span class="text-success">Hình Ảnh Đã Bị Xóa!</span>');
                  }
              });
          }
        });
      });
    </script>
  
  {{-- Phí Vận Chuyển --}}
    <script type="text/javascript">
        $(document).ready(function(){
          
          fetch_delivery();

          function fetch_delivery(){
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url:"{{url('/admin/feeship/display')}}",
                  method:"POST",
                  data:{_token:_token},
                  success:function(data){
                       $('#load_delivery').html(data);

                  }
              });
          }

          $('.add_delivery').click(function(){

            var province = $('.province').val();
            var district = $('.district').val();
            var commune = $('.commune').val();
            var feeship = $('.feeship').val();
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url:"{{url('/admin/feeship/addfee')}}",
                  method:"POST",
                  data:{province:province,district:district,commune:commune,feeship:feeship,_token:_token},
                  success:function(data){
                        alert('Phí Vận Chuyển Đã Được Cập Nhật!');

                  }
              });
          });
          
          $('.parent').on('change',function(){
              var action = $(this).attr('id');
              var parent_id = $(this).val();
              var _token = $('input[name="_token"]').val();
              var result = '';

              if(action == 'province'){
                  result = 'district';
              }else{
                  result = 'commune';
              }
              
              $.ajax({
                url:"{{url('/admin/feeship/parent')}}",
                  method:"POST",
                  data:{action:action,parent_id:parent_id,_token:_token},
                  success:function(data){
                      $('#'+result).html(data);
                  }
              });
          });

          $(document).on('blur','.editfee',function(){
            var fee_id= $(this).data('fee_id');
            var new_fee = $(this).text();
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url:"{{url('/admin/feeship/editfee')}}",
                method:"POST",
                data:{fee_id:fee_id,new_fee:new_fee,_token:_token},
                success:function(data){
                    fetch_delivery();
                    $('#error_fee').html('<span class="text-success">Phí Vận Chuyển Đã Được Thay Đổi!</span>');
                }
            });
        });
        $(document).on('click','.deletefee',function(){
            var fee_id= $(this).data('fee_id');
            var _token = $('input[name="_token"]').val();
            if(confirm('Bạn Chắc Chắn Muốn Phí Vận Chuyển Này?')){
              $.ajax({
                  url:"{{url('/admin/feeship/deletefee')}}",
                  method:"POST",
                  data:{fee_id:fee_id,_token:_token},
                  success:function(data){
                      fetch_delivery();
                      alert('Phí Vận Chuyển Đã Được Xóa!')
                  }
              });
          }
        });
        })
    </script>

  {{-- Trạng thái đơn hàng --}}
    <script type="text/javascript">
        $('.order_status').change(function(){
            var status = $(this).val();
            var order_id = $(this).children(":selected").attr("id");
            var _token = $('input[name="_token"]').val();

            qty = [];
            $("input[name='quantity']").each(function(){
              qty.push($(this).val());
            });

            order_pro = [];
            $("input[name='order_pro_id']").each(function(){
              order_pro.push($(this).val());
            });
            k =0;
            for(i=0;i<order_pro.length;i++){
              var order_qty = $('.order_qty_' + order_pro[i]).val();
              var stock = $('.order_stock_' + order_pro[i]).val();

              if(parseInt(order_qty)>parseInt(stock)){
                k = k+1;
                if(k==1){
                  alert('Không đủ hàng')
                }
                $('.warning_' + order_pro[i]).html('<strong>Cảnh báo</strong>: Kho hiện không đủ sản phẩm!').css('color','red');
              }
            }

            if(k==0){
            $.ajax({
                  url:"{{url('/admin/order/update-stock')}}",
                  method:"POST",
                  data:{status:status,order_id:order_id,_token:_token,qty:qty,order_pro:order_pro},
                  success:function(data){
                      alert('Đã cập nhật!');
                      location.reload();
                  }
              });

            }
            
        });

    </script>

</body>
</html>