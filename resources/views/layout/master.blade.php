<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Gym Template">
    <meta name="keywords" content="Gym, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> @yield('title') </title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Muli:300,400,500,600,700,800,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Oswald:300,400,500,600,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/botman-web-widget@0/build/assets/css/chat.min.css">
    <!-- Css Styles -->
    <link rel="stylesheet" href="/master/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="/master/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="/master/css/flaticon.css" type="text/css">
    <link rel="stylesheet" href="/master/css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="/master/css/barfiller.css" type="text/css">
    <link rel="stylesheet" href="/master/css/magnific-popup.css" type="text/css">
    <link rel="stylesheet" href="/master/css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="/master/css/style.css" type="text/css">
    

</head>

<body>
        @include('master.structure.header')

        @yield('content')

        @include('master.structure.footer')
        
        <div class="search-model">
            <div class="h-100 d-flex align-items-center justify-content-center">
                <div class="search-close-switch">+</div>
                <form class="search-model-form">
                    <input type="text" id="search-input" placeholder="Search here.....">
                </form>
            </div>
        </div>
        {{-- <script id="botmanWidget" src='https://cdn.jsdelivr.net/npm/botman-web-widget@0/build/js/chat.js'></script> --}}

        <script>
            var botmanWidget = {
                introMessage: "✋Xin chào bạn! Chúng tôi có thể giúp gi được cho bạn?",
                mainColor:'#c02026',
                aboutText:'',
                bubbleBackground:'#c02026',
                headerTextColor: '#fff',
                };              
        </script>     
        {{-- <script  type="text/javascript">
                 $(document).on('click', '.desktop-closed-message-avatar img', function() {
                    var iframe = document.getElementById("chatBotManFrame");
                    iframe.addEventListener('load', function () {
                        var htmlFrame = this.contentWindow.document.getElementsByTagName("html")[0];
                        var bodyFrame = this.contentWindow.document.getElementsByTagName("body")[0];
                        var headFrame = this.contentWindow.document.getElementsByTagName("head")[0];

                        var image = "https://images.unsplash.com/photo-1501597301489-8b75b675ba0a?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1349&q=80"

                        htmlFrame.style.backgroundImage = "url("+image+")";
                        bodyFrame.style.backgroundImage = "url("+image+")";
                    });
                });
        </script> --}}
       
        <script src='https://cdn.jsdelivr.net/npm/botman-web-widget@0/build/js/widget.js'></script>
        <script src="/master/js/jquery-3.3.1.min.js"></script>
        <script src="/master/js/bootstrap.min.js"></script>
        <script src="/master/js/jquery.magnific-popup.min.js"></script>
        <script src="/master/js/masonry.pkgd.min.js"></script>
        <script src="/master/js/jquery.barfiller.js"></script>
        <script src="/master/js/jquery.slicknav.js"></script>
        <script src="/master/js/owl.carousel.min.js"></script>
        <script src="/master/js/main.js"></script>
        
</body>
</html>