<footer>
    <div class="container">
      <nav class="main-nav">
        <div class="row">
          <div class="col-sm-4 col-xl-3">
            <a href="index.html" class="logo">
                <img src="/images/web/{{$info->logo}}" alt="">
            </a>
            <p>
                cinema@gmail.com
            </p>
            <div class="social">
              <a class="link link-dark text-decoration-none rounded-circle fs-4" href="{{isset($info['facebook']) ? $info['facebook'] : ''}}"><i class="fa-brands fa-facebook"></i></a>
              <a class="link link-dark text-decoration-none rounded-circle fs-4" href="{{isset($info['twitter']) ? $info['twitter'] : ''}}"><i class="fa-brands fa-twitter"></i></a>
              <a class="link link-dark text-decoration-none rounded-circle fs-4" href="{{isset($info['instagram']) ? $info['instagram'] : ''}}"><i class="fa-brands fa-instagram"></i></a>                  
              <a class="link link-dark text-decoration-none rounded-circle fs-4" href="{{isset($info['youtube']) ? $info['youtube'] : ''}}"><i class="fa-brands fa-youtube"></i></a>
            </div>
            <div class="row">
                <p class="link-info">
                    Thời gian: 06:00 - 23:00
                </p>
            </div>
            <div class="row">
                <p class="link-info">
                    Hotline: 0901234567
                </p>
            </div>
          </div>
    
          <div class="col-sm-4 col-xl-3">
            <h5>Thông tin</h5>
            <ul class="details">
                <li><a href="#">Giới thiệu</a></li>
                <li><a href="movie-list-left.html">Phim</a></li>
                <li><a href="trailer.html">Trailers</a></li>
                <li><a href="rates-left.html">Rates</a></li>
            </ul>
          </div>

            <div class="col-sm-4 col-xl-3">
              <h5>Điều khoản sử dụng</h5>
              <ul class="details">
                  <li><a href="coming-soon.html">Điều khoản chung</a></li>
                  <li><a href="cinema-list.html">Chính sách thanh toán</a></li>
                  <li><a href="offers.html">Chính sách bảo mật</a></li>
                  <li><a href="news-left.html">Câu hỏi thường gặp</a></li>
              </ul>
          </div>
          <div class="col-sm-4 col-xl-3">
            <h5>Hỗ Trợ</h5>
            <ul class="details">
                <li><a href="#">Liên hệ</a></li>
                <li><a href="gallery-four.html">Góp ý</a></li>
            </ul>
          </div>
      </nav>
    </div>
  </footer>