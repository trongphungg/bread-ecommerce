<div class="sidebar" data-background-color="dark">
  <div class="sidebar-logo">
    <!-- Logo Header -->
    <div class="logo-header" data-background-color="dark">
      <a class="logo">
        <img
          src="{{asset('admin/assets/img/banner-fruits.jpg')}}"
          alt="navbar brand"
          class="navbar-brand"
          height="20"
        />
        <p class="text-white p-3 my-4">Bánh mì Phong Hiền</p>
      </a>
      <div class="nav-toggle">
        <button class="btn btn-toggle toggle-sidebar">
          <i class="gg-menu-right"></i>
        </button>
        <button class="btn btn-toggle sidenav-toggler">
          <i class="gg-menu-left"></i>
        </button>
      </div>
      <button class="topbar-toggler more">
        <i class="gg-more-vertical-alt"></i>
      </button>
    </div>
    <!-- End Logo Header -->
  </div>
  <div class="sidebar-wrapper scrollbar scrollbar-inner">
    <div class="sidebar-content">
      <ul class="nav nav-secondary">
        <li class="nav-item">
          <a
            href="{{route('dashboard')}}"
          >
            <i class="fas fa-home"></i>
            <p>Dashboard</p>
          </a>
        </li>
        <li class="nav-section">
          <span class="sidebar-mini-icon">
            <i class="fa fa-ellipsis-h"></i>
          </span>
          <h4 class="text-section">Components</h4>
        </li>
        <li class="nav-item">
          <a data-bs-toggle="collapse" href="#base">
            <i class="fas fa-layer-group"></i>
            <p>Quản lý tin tức</p>
            <span class="caret"></span>
          </a>
          <div class="collapse" id="base">
            <ul class="nav nav-collapse">
              <li>
                <a href="{{route('newsIndex')}}">
                  <span class="sub-item">Danh sách tin tức</span>
                </a>
              </li>
              <li>
                <a href="{{route('opinionIndex')}}">
                  <span class="sub-item">Danh sách ý kiến</span>
                </a>
              </li>

            </ul>
          </div>
        </li>
        <li class="nav-item">
          <a  href="{{route('userIndex')}}" 
          {{-- data-bs-toggle="collapse" href="#sidebarLayouts" --}}
          >
            <i class="fas fa-th-list"></i>
            <p>Quản lí tài khoản</p>

          </a>
          <div class="collapse" id="sidebarLayouts">
            <ul class="nav nav-collapse">
              <li>
                <a href="{{route('userIndex')}}">
                  <span class="sub-item">Danh sách người dùng</span>
                </a>
              </li>
            </ul>
          </div>
        </li>
        <li class="nav-item">
          <a data-bs-toggle="collapse" href="#forms">
            <i class="fas fa-pen-square"></i>
            <p>Quản lí sản phẩm</p>
            <span class="caret"></span>
          </a>
          <div class="collapse" id="forms">
            <ul class="nav nav-collapse">
              <li>
                <a href="{{route('productIndex')}}">
                  <span class="sub-item">Danh sách sản phẩm</span>
                </a>
              </li>
              <li>
                <a href="{{route('categoryIndex')}}">
                  <span class="sub-item">Danh mục sản phẩm</span>
                </a>
              </li>
            </ul>
          </div>
        </li>
        <li class="nav-item">
          <a href="{{route('orderIndex')}}"
          {{-- data-bs-toggle="collapse" href="#maps" --}}
          >
            <i class="fas fa-map-marker-alt"></i>
            <p>Quản lí đơn hàng</p>
          </a>
          <div class="collapse" id="maps">
            <ul class="nav nav-collapse">
              <li>
                <a href="{{route('orderIndex')}}">
                  <span class="sub-item">Danh sách đơn hàng</span>
                </a>
              </li>
            </ul>
          </div>
        </li>
        <li class="nav-item">
          <a href="{{route('reviewIndex')}}"
          {{-- data-bs-toggle="collapse" href="#charts" --}}
          >
            <i class="far fa-chart-bar"></i>
            <p>Quản lý đánh giá</p>
          </a>
          <div class="collapse" id="charts">
            <ul class="nav nav-collapse">
              <li>
                <a href="{{route('reviewIndex')}}">
                  <span class="sub-item">Danh sách đánh giá</span>
                </a>
              </li>
            </ul>
          </div>
        </li>
        <li class="nav-item">
          <a href="{{route('policyIndex')}}"
          {{-- data-bs-toggle="collapse" href="#policy" --}}
          >
            <i class="far fa-chart-bar"></i>
            <p>Quản lý chính sách</p>
          </a>
          <div class="collapse" id="policy">
            <ul class="nav nav-collapse">
              <li>
                <a href="{{route('policyIndex')}}">
                  <span class="sub-item">Danh sách chính sách</span>
                </a>
              </li>
            </ul>
          </div>
        </li>
        <li class="nav-item {{ request()->routeIs('warehouseIndex') ? 'active' : '' }}">
          <a data-bs-toggle="collapse" href="#kho">
            <i class="far fa-chart-bar"></i>
            <p>Quản lý kho</p>
            <span class="caret"></span>
          </a>
          <div class="collapse" id="kho">
            <ul class="nav nav-collapse">
              <li class="{{ request()->routeIs('warehouseIndex') ? 'active' : '' }}">
                <a href="{{route('warehouseIndex')}}">
                  <span class="sub-item">Danh sách nhập kho</span>
                </a>
              </li>
              <li>
                <a href="{{route('ingredientIndex')}}">
                  <span class="sub-item">Danh sách nguyên liệu</span>
                </a>
              </li>
              <li>
                <a href="{{route('recipeIndex')}}">
                  <span class="sub-item">Danh sách công thức</span>
                </a>
              </li>
            </ul>
          </div>
        </li>
      </ul>
    </div>
  </div>
</div>