<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet"> 

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="/shop/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="/shop/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="/admin/assets/css/sweetalert.css">
    <link rel="stylesheet" href="/master/css/starrr.css">
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.2.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    @yield('css')
</head>

<body>

    @include('shop.structure.header')
    @include('shop.structure.navbar')

    @yield('content')

    

    

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="/shop/lib/easing/easing.min.js"></script>
    <script src="/shop/lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="/admin/assets/js/sweetalert.min.js"></script>

    <!-- Contact Javascript File -->
    <script src="/shop/mail/jqBootstrapValidation.min.js"></script>
    <script src="/shop/mail/contact.js"></script>

    <!-- Template Javascript -->
    <script src="/shop/js/main.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>
    
    <script type="text/javascript">
    
        $('.send').click(function(){
            swal("Đơn đã được đặt!", "Cảm Ơn Đã Mua Hàng!", "success")
       
    });
    </script>
    <script type="text/javascript">
        function submitForm(form){
            swal({
                title: "Cân Nhắc",
                text: "Bạn Có Chắc Muốn Đổi Mật Khẩu!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((isOkay) => {
                if(isOkay){
                    form.submit();
                }
            });
            return false;
          };
      </script>
    
    <script type="text/javascript">
        $(document).ready(function(){
            $('.parent').on('change',function(){
                var chose = $(this).attr('id');
                var parent_id = $(this).val();
                var _token = $('input[name="_token"]').val();
                var result = '';
  
                if(chose == 'province'){
                    result = 'district';
                }else{
                    result = 'commune';
                }
                
                $.ajax({
                    url:"{{url('/checkout/delivery')}}",
                    method:"POST",
                    data:{chose:chose,parent_id:parent_id,_token:_token},
                    success:function(data){
                        $('#'+result).html(data);
                    }
                });
            });
        })
    </script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('.totalfee').click(function(){
                var province = $('.province').val();
                var district = $('.district').val();
                var commune = $('.commune').val();
                var _token = $('input[name="_token"]').val();
                if(province == '' && district == ''  && commune == ''){
                    alert('Hãy điền thông tin vận chuyển!')
                }
                $.ajax({
                    url:"{{url('/checkout/totalfee')}}",
                    method:"POST",
                    data:{province:province,district:district,commune:commune,_token:_token},
                    success:function(){
                            location.reload();

                    }
                });
            });
        })

    </script>
    <script type="text/javascript">
        $(document).ready(function(){
            load_comment();
            function load_comment(){
                var pro_id = $('.comment_product').val();
                var _token = $('input[name="_token"]').val();
                
                $.ajax({
                    url:"{{url('/shop/comment')}}",
                    method:"POST",
                    data:{pro_id:pro_id,_token:_token},
                    success:function(data){
                        $('#comment').html(data);
                    }
                });

            }
            $('.send-comment').click(function(){
                var pro_id = $('.comment_product').val();
                var cmt_name = $('.name').val();
                var cmt_content = $('.message').val();
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url:"{{url('/shop/get-comment')}}",
                    method:"POST",
                    data:{pro_id:pro_id,cmt_name:cmt_name,cmt_content:cmt_content,_token:_token},
                    success:function(data){
                       load_comment();
                       $('.success').html('<strong>Thành Công</strong>: Thêm bình luận thành công!');
                       $('.success').fadeOut(3000);
                       $('.name').val('');
                       $('.message').val('');
                    }
                });
            })
        })
        
    </script>
   
    <script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>
    
    @yield('js')
</body>

</html>