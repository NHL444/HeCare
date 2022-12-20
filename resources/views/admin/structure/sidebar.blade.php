
<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
    <a class="sidebar-brand brand-logo" href="{{route('admin.homepage')}}" style="text-decoration: none;font-size:20px;color:cadetblue;"><img src="/admin/assets/images/home-icon.PNG" alt="logo" style="width:40px;"/>  HECARE SYSTEM</a>
    <a class="sidebar-brand brand-logo-mini" href="{{route('admin.homepage')}}"><img src="/admin/assets/images/home-icon.png" alt="logo" style="width:40px;"/></a>
  </div>
  <ul class="nav">
    <li class="nav-item profile"> {{-- Profile --}}
      <div class="profile-desc">
        <div class="profile-pic">
          <div class="count-indicator">
            @if($user->role == 1)<img class="img-xs rounded-circle" src="/admin/assets/images/itmine.jpg" alt="" width="60px"/>
                                                                                @else <img class="img-xs rounded-circle" src="/admin/assets/images/staff.png" width="60px" alt="" /> 
                                                                                @endif
            <span class="count bg-success"></span>
          </div>
          <div class="profile-name">
            <h4 style="color: #FFC20E" class="mb-0 font-weight-normal"><?=$user->name?></h5>
            <span>@if($user->role == 1)Quản Trị Viên @else Nhân Viên @endif</span>
          </div>
        </div>
      </div>
    </li>
    <li class="nav-item nav-category"> {{-- Title --}}
      <span class="nav-link">Tác Vụ</span>
    </li>
     <li class="nav-item menu-items"> {{-- Trang chủ --}}
      <a class="nav-link" href="{{route('admin.homepage')}}">
        <span class="menu-icon">
          <i class="mdi mdi-speedometer"></i>
        </span>
        <span class="menu-title">Trang Chủ</span>
      </a>
    </li>
    <li class="nav-item menu-items"> {{-- Loại Hình --}}
      <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
        <span class="menu-icon">
          <i class="mdi mdi-call-made"></i>
        </span>
        <span class="menu-title">Loại Hình</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="ui-basic">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> 
            <a class="nav-link" href="{{route('article.display')}}">
              <span class="menu-icon">
                <i class="mdi mdi-call-made"></i>
              </span>
              <span class="menu-title">Các Bộ Môn</span>
            </a>
          </li>
          <li class="nav-item"> 
            <a class="nav-link" href="{{route('product.createtype')}}">
              <span class="menu-icon">
                <i class="mdi mdi-call-made"></i>
              </span>
              <span class="menu-title">Loại/Thương Hiệu</span>
            </a>
          </li>
          <li class="nav-item"> 
            <a class="nav-link" href="{{route('product.distype')}}">
              <span class="menu-icon">
                <i class="mdi mdi-call-made"></i>
              </span>
              <span class="menu-title">Loại Sản Phẩm</span>
            </a>
          </li>
          <li class="nav-item"> 
            <a class="nav-link" href="{{route('product.brand')}}">
              <span class="menu-icon">
                <i class="mdi mdi-call-made"></i>
              </span>
              <span class="menu-title">Thương Hiệu</span>
            </a>
          </li>
        </ul>
      </div>
    </li>
    <li class="nav-item menu-items"> {{-- Danh Mục --}}
      <a class="nav-link" href="{{route('category.show')}}">
        <span class="menu-icon">
          <i class="mdi mdi-bulletin-board"></i>
        </span>
        <span class="menu-title">Quản Lý Danh Mục</span>
      </a>
    </li>
    <li class="nav-item menu-items"> {{-- Bài Viết --}}
      <a class="nav-link" data-bs-toggle="collapse" href="#ui-atl" aria-expanded="false" aria-controls="ui-atl">
        <span class="menu-icon">
          <i class="mdi mdi-newspaper"></i>
        </span>
        <span class="menu-title">Quản Lý Bài Viết</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="ui-atl">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> 
            <a class="nav-link" href="{{route('article.writearticle')}}">
              <span class="menu-icon"> 
                <i class="mdi mdi-newspaper"></i>
              </span>
              <span class="menu-title">Đăng Bài</span>
            </a>
          </li>
          <li class="nav-item"> 
            <a class="nav-link" href="{{route('article.article-manage')}}">
              <span class="menu-icon">
                <i class="mdi mdi-newspaper"></i>
              </span>
              <span class="menu-title">Bài Viết</span>
            </a>
          </li>
        </ul>
      </div>
    </li>
    <li class="nav-item menu-items"> {{-- Sản Phẩm --}}
      <a class="nav-link" data-bs-toggle="collapse" href="#ui-pro" aria-expanded="false" aria-controls="ui-pro">
        <span class="menu-icon">
          <i class="mdi mdi-cart"></i>
        </span>
        <span class="menu-title">Quản Lý Sản Phẩm</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="ui-pro">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> 
            <a class="nav-link" href="{{route('product.promanage')}}">
              <span class="menu-icon">
                <i class="mdi mdi-cart"></i>
              </span>
              <span class="menu-title">Sản Phẩm</span>
            </a>
          </li>
          <li class="nav-item"> 
            <a class="nav-link" href="{{route('product.add')}}">
              <span class="menu-icon">
                <i class="mdi mdi-cart"></i>
              </span>
              <span class="menu-title">Thêm Sản Phẩm</span>
            </a>
          </li>
        </ul>
      </div>
    </li>
    @if($user->role == 1)
    <li class="nav-item menu-items"> {{-- Nhân Sự --}}
      <a class="nav-link" data-bs-toggle="collapse" href="#ui-staff" aria-expanded="false" aria-controls="ui-staff">
        <span class="menu-icon">
          <i class="mdi mdi-bulletin-board"></i>
        </span>
        <span class="menu-title">Quản Lý Nhân Sự</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="ui-staff">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> 
            <a class="nav-link" href="{{route("staff.manage-staff")}}">
              <span class="menu-icon">
                <i class="mdi mdi-bulletin-board"></i>
              </span>
              <span class="menu-title">Danh Sách</span>
            </a>
          </li>
          <li class="nav-item"> 
            <a class="nav-link" href="{{route("staff.create")}}">
              <span class="menu-icon">
                <i class="mdi mdi-bulletin-board"></i>
              </span>
              <span class="menu-title">Thêm Nhân Sự</span>
            </a>
          </li>
        </ul>
      </div>
    </li>
    @endif
    <li class="nav-item menu-items"> {{-- Phí Vận Chuyển --}}
      <a class="nav-link" href="{{route('feeship.feemanage')}}">
        <span class="menu-icon">
          <i class="mdi mdi-truck-delivery"></i>
        </span>
        <span class="menu-title">Phí Vận Chuyển</span>
      </a>
    </li>
    <li class="nav-item menu-items"> {{-- Phiếu Nhập Kho --}}
      <a class="nav-link" data-bs-toggle="collapse" href="#ui-warehouse" aria-expanded="false" aria-controls="ui-pro">
        <span class="menu-icon">
          <i class="mdi mdi-receipt"></i>
        </span>
        <span class="menu-title">Quản Lý Nhập Hàng</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="ui-warehouse">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> 
            <a class="nav-link" href="{{route('warehouse.manage-receipt')}}">
              <span class="menu-icon">
                <i class="mdi mdi-receipt"></i>
              </span>
              <span class="menu-title">Phiếu Nhập Hàng</span>
            </a>
          </li>
          <li class="nav-item"> 
            <a class="nav-link" href="{{route('warehouse.add-receipt')}}">
              <span class="menu-icon">
                <i class="mdi mdi-receipt"></i>
              </span>
              <span class="menu-title">Lập Phiếu</span>
            </a>
          </li>
        </ul>
      </div>
    </li>
    <li class="nav-item menu-items"> {{-- Trò Chuyện --}}
      <a class="nav-link" data-bs-toggle="collapse" href="#ui-chatbot" aria-expanded="false" aria-controls="ui-pro">
        <span class="menu-icon">
          <i class="mdi mdi-wechat"></i>
        </span>
        <span class="menu-title">Trò Chuyện Với Bot</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="ui-chatbot">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> 
            <a class="nav-link" href="{{route('chatbot.manage-key')}}">
              <span class="menu-icon">
                <i class="mdi mdi-wechat"></i>
              </span>
              <span class="menu-title">Lập Từ Khóa</span>
            </a>
          </li>
          <li class="nav-item"> 
            <a class="nav-link" href="{{route('chatbot.add-key')}}">
              <span class="menu-icon">
                <i class="mdi mdi-wechat"></i>
              </span>
              <span class="menu-title">Nhận Diện Từ Khách</span>
            </a>
          </li>
        </ul>
      </div>
    </li>
    
    <li class="nav-item nav-category"> {{-- Title --}}
      <span class="nav-link">Nhận Từ Khách</span>
    </li>
    <li class="nav-item menu-items"> {{-- Khách Hàng --}}
      <a class="nav-link" href="{{route("customer.manage-customer")}}">
        <span class="menu-icon">
          <i class="mdi mdi-account-group"></i>
        </span>
        <span class="menu-title">Tài Khoản Khách</span>
      </a>
    </li>
    <li class="nav-item menu-items"> {{-- Đơn Hàng --}}
      <a class="nav-link" href="{{route('order.index')}}">
        <span class="menu-icon">
          <i class="mdi mdi-cash-multiple"></i>
        </span>
        <span class="menu-title">Quản Lý Đơn Hàng</span>
      </a>
    </li>
    <li class="nav-item menu-items"> {{-- Phản Hồi --}}
      <a class="nav-link" href="{{route('cont.contact')}}">
        <span class="menu-icon">
          <i class="mdi mdi-email"></i>
        </span>
        <span class="menu-title">Phản Hồi</span>
      </a>
    </li>

   
  </ul>
</nav>