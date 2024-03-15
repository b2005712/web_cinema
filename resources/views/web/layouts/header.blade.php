<header class="header-area header-sticky">
    <title>{{$info['name']}}</title>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="main-nav">
                    <a href="home" class="logo">
                        <img src="/images/web/{{$info['logo']}}" alt="">
                    </a>
                    <div class="search-input">
                        <form id="search" action="/search"  method="get">
                          <input type="text" placeholder="Type Something"  name="search" onkeypress="handle" />
                          <i class="fa fa-search"></i>
                        </form>
                    </div>
                    <ul class="nav">
                        <li><a href="/home" class="active">Trang chủ</a></li>
                        <li class="dropdown">
                            <a href="/movies" role="button">Phim</a>
                        </li>
                        <li><a href="/theater">Rạp chiếu</a></li>
                        <li><a href="/news">Tin tức</a></li>
                        <li><a href="/contact">Liên hệ\Dịch vụ</a></li>
                        <li class="profile dropdown">
                            @if (Auth::check())
                                <a href="#" class="profile-a" role="button" data-bs-toggle="dropdown" aria-expanded="false">{{ Auth::user()->fullname }}</a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="/profile">Tài khoản</a></li>
                                    <li><a class="dropdown-item" href="/logout">Đăng xuất</a></li>
                                </ul>
                            @else
                                <a href="/login" class="profile-a">Đăng nhập</a>
                            @endif
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