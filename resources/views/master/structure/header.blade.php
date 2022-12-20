<div id="preloder">
    <div class="loader"></div>
</div>

<!-- Offcanvas Menu Section Begin -->
<div class="offcanvas-menu-overlay"></div>
<div class="offcanvas-menu-wrapper">
<div class="canvas-close">
    <i class="fa fa-close"></i>
</div>
<div class="canvas-search search-switch">
    <i class="fa fa-search"></i>
</div>
<nav class="canvas-menu mobile-menu">
    <ul>
        <li><a href="{{route('home.index')}}">TRANG CHỦ</a></li>
        <li><a href="{{route('home.about')}}">CHÚNG TÔI</a></li>
        <li><a href="{{route('shop.homepage')}}">SẢN PHẨM HỔ TRỢ</a></li>
        <li><a href="">TẬP GYM</a>
            <ul class="dropdown">
                @foreach($gym as $val)
                <li><a href="{{asset('gym/'.$val->atp_id.'/'.$val->atp_slug.'.html')}}">{{$val->atp_name}}</a>
                    @foreach($type as $key => $g)
                        @if( $val->atp_id == $g->atp_parent)
                        <ul class="sub-menu">
                            @foreach($type as $key => $data)
                                @if($data->atp_parent==$val->atp_id)
                                    <li><a href="{{asset('gym/'.$val->atp_id.'/'.$data->atp_id.'/'.$data->atp_slug.'.html')}}">{{$data->atp_name}}</a><li>
                                @endif
                            @endforeach     
                        </ul>                                  
                        @endif
                    @endforeach
                            
                </li>                                 
                @endforeach
            </ul>
        </li>
        <li><a href="">TRIATHLON</a>
            <ul class="dropdown">
                @foreach ($triathlon as $val)
                <li><a href="{{asset('home/'.$val->atp_id.'/'.$val->atp_slug.'.html')}}">{{$val->atp_name}}</a></li>                                 
                @endforeach
            </ul>
        </li>
        <li><a href="{{asset('home/6/yoga.html')}}">TẬP YOGA</a></li>
        <li><a href="./team.html">CHẾ ĐỘ ĂN</a>
            <ul class="dropdown">
                @foreach ($eatclean as $val)
                <li><a href="{{asset('home/'.$val->atp_id.'/'.$val->atp_slug.'.html')}}">{{$val->atp_name}}</a></li>                                 
                @endforeach
            </ul>
        </li>
        <li><a href="{{route('home.contact')}}">LIÊN HỆ</a></li>
    </ul>
</nav>
<div id="mobile-menu-wrap"></div>
{{-- <div class="canvas-social">
    <a href="#"><i class="fa fa-facebook"></i></a>
    <a href="#"><i class="fa fa-twitter"></i></a>
    <a href="#"><i class="fa fa-youtube-play"></i></a>
    <a href="#"><i class="fa fa-instagram"></i></a>
</div> --}}
</div>

<header class="header-section">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3">
                <div class="logo">
                    <a href="./index.html">
                        <img src="/master/img/logo.png" alt="">
                    </a>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="top-option">
                    {{-- <div class="to-search search-switch">
                        <i class="fa fa-search"></i>
                    </div> --}}
                    {{-- <div class="to-social">
                        <a href="#"><i class="fa fa-facebook"></i></a>
                        <a href="#"><i class="fa fa-twitter"></i></a>
                        <a href="#"><i class="fa fa-youtube-play"></i></a>
                        <a href="#"><i class="fa fa-instagram"></i></a>
                    </div> --}}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <nav class="nav-menu">
                    <ul>
                        <li class="active"><a href="{{route('home.index')}}">TRANG CHỦ</a></li>
                        <li><a href="{{route('home.about')}}">CHÚNG TÔI</a></li>
                        <li><a href="{{route('shop.homepage')}}">SẢN PHẨM HỖ TRỢ</a></li>
                        <li><a href="">Tập GYM</a>
                            
                            <ul class="dropdown">
                                @foreach($gym as $val)
                                <li><a href="{{asset('home/'.$val->atp_id.'/'.$val->atp_slug.'.html')}}">{{$val->atp_name}}</a>
                                    @foreach($type as $key => $g)
                                        @if( $val->atp_id == $g->atp_parent)
                                        <ul class="sub-menu">
                                            @foreach($type as $key => $data)
                                                @if($data->atp_parent==$val->atp_id)
                                                    <li><a href="{{asset('home/'.$data->atp_id.'/'.$data->atp_slug.'.html')}}">{{$data->atp_name}}</a><li>
                                                @endif
                                            @endforeach     
                                        </ul>                                  
                                        @endif
                                    @endforeach
                                            
                                </li>                                 
                                @endforeach
                            </ul>
                           
                        </li>
                        <li><a href="">TRIATHLON</a>
                            <ul class="dropdown">
                                @foreach ($triathlon as $val)
                                <li><a href="{{asset('home/'.$val->atp_id.'/'.$val->atp_slug.'.html')}}">{{$val->atp_name}}</a></li>                                 
                                @endforeach
                            </ul>
                        </li>
                        <li><a href="{{asset('home/6/yoga.html')}}">TẬP YOGA</a></li>
                        <li><a href="">CHẾ ĐỘ ĂN</a>
                            <ul class="dropdown">
                                @foreach ($eatclean as $val)
                                <li><a href="{{asset('home/'.$val->atp_id.'/'.$val->atp_slug.'.html')}}">{{$val->atp_name}}</a></li>                                 
                                @endforeach
                            </ul>
                        </li>
                        <li><a href="{{route('home.contact')}}">LIÊN HỆ</a></li>
                    </ul>
                </nav>
            </div>           
        </div>
        <div class="canvas-open">
            <i class="fa fa-bars"></i>
        </div>
    </div>
</header>
