<header class="header-area header-sticky">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="main-nav">
                    <a href="home" class="logo">
                        <img src="assets/images/logo.png" alt="">
                    </a>
                    <div class="search-input">
                        <form id="search" action="#">
                          <input type="text" placeholder="Type Something" id='searchText' name="searchKeyword" onkeypress="handle" />
                          <i class="fa fa-search"></i>
                        </form>
                    </div>
                    <ul class="nav">
                        <li><a href="home" class="active">Trang chủ</a></li>
                        <li class="dropdown">
                            <a href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Phim</a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="\movies">Phim đang chiếu</a></li>
                                <li><a class="dropdown-item" href="\movies">Phim sắp chiếu</a></li>
                            </ul>
                        </li>
                        <li><a href="\theater">Rạp chiếu</a></li>
                        <li><a href="\news">Tin tức</a></li>
                        <li><a href="\contact">Liên hệ\Dịch vụ</a></li>
                        <li class="profile dropdown">
                            <a href="login" class="profile-a">Đăng nhập</a>
                            {{-- <a href="#" class="profile-a" role="button" data-bs-toggle="dropdown" aria-expanded="false">Tài khoản<img src="assets/images/profile-header.jpg" alt=""></a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Thông tin</a></li>
                                <li><a class="dropdown-item" href="#">Vé của tôi</a></li>
                                <li><a class="dropdown-item" href="#">Đăng xuất</a></li>
                            </ul> --}}
                        </li>
                    </ul>   
                    <a class='menu-trigger'>
                        <span>Menu</span>
                    </a>
                </nav>
            </div>
        </div>
    </div>
  </header>