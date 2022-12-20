<section class="classes-section spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <span>KIẾN THỨC</span>
                    <h2>NHỮNG THỨ BẠN ĐANG MUỐN BIẾT</h2>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach($tp as $val)
   
            <div class="col-lg-4 col-md-6">
                <div class="class-item">
                    <div class="ci-pic" style="height: 210px">
                        <img src="/type/photo/{{$val->atp_photo}}" alt="">
                    </div>
                    <div class="ci-text">
                        <span>
                            @if($val->atp_parent==1)
                            Gym
                            @else Triathlon
                            @endif
                        </span> 
                        <h5>{{$val->atp_name}}</h5>
                        <a href="{{asset('home/'.$val->atp_id.'/'.$val->atp_slug.'.html')}}"><i class="fa fa-angle-right"></i></a>
                    </div>
                </div>
            </div>
        
            @endforeach
            <div class="col-lg-6 col-md-6">
                <div class="class-item">
                    <div class="ci-pic">
                        <img src="/master/img/gallery/tapyoga.jpg" alt="">
                    </div>
                    <div class="ci-text">
                        <span>Yoga</span>
                        <h4>Tập Yoga</h4>
                        <a href="{{asset('home/6/yoga.html')}}"><i class="fa fa-angle-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="class-item">
                    <div class="ci-pic">
                        <img src="/master/img/gallery/anchedo.jpg" alt="">
                    </div>
                    <div class="ci-text">
                        <span>Dinh Dưỡng</span>
                        <h4>Chế Độ Ăn</h4>
                        <a href="{{asset('home/6/yoga.html')}}"><i class="fa fa-angle-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>