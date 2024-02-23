@extends('web.layouts.app')
@section('content')
<section class="container clearfix">
    <div class="Movies" id="Movies">
        <ul class="nav justify-content-start mb-4 align-items-center">
            <li class="nav-item">
                <button class="h5 nav-link active fw-bold border-bottom border-2 movie-border"
                        aria-expanded="true"
                        data-bs-toggle="collapse"
                        data-bs-target="#phimdangchieu" disabled>
                    Phim đang chiếu
                </button>
            </li>
            <li class="vr mx-5"></li>
            <li class="nav-item me-auto">
                <button class="h5 nav-link link-secondary "
                        aria-expanded="false"
                        data-bs-toggle="collapse" data-bs-target="#phimsapchieu">
                    Phim sắp chiếu
                </button>
            </li>
    
            <button class="btn" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
                <i class="fa-solid fa-filter"></i>
            </button>
        </ul>
    
        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
           <div class="offcanvas-header">
               <h5 class="offcanvas-title" id="offcanvasRightLabel">Bộ lọc</h5>
               <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
           </div>
           <div class="offcanvas-body">
               <form action="/movies/filter" method="get">
                   <div class="m-2 form-group mb-3">
                       <label class="form-label" for="movieGenres">Thể loại</label>
                       <select id="movieGenres" class="form-select director-input" name="movieGenres[]" multiple>
                            <option value="" >Tất cả</option>
                            <option value="" >1</option>
                            <option value="" >2</option>
                            <option value="" >3</option>
                       </select>
                   </div>
    
                   <div class="m-2 form-group mb-3">
                       <label class="form-label" for="rating director-input">Giới hạng độ tuổi</label>
                       <select id="rating" class="form-select" name="rating">
                           <option value="" selected>Tất cả</option>
                           <option value="" >Tất cả</option>
                           <option value="" >Tất cả</option>
    
                       </select>
                   </div>

                   <button type="submit" class="btn btn-primary m-2 mt-4 w-100">Xác nhận</button>
               </form>
           </div>
        </div>

        <div id="phimdangchieu" class="row g-4 mt-2 row-cols-1 row-cols-md-2 collapse show" data-bs-parent="#Movies">
            <div class="product w-100">
                <div class="row d-flex justify-content-center">
                    <div class="product-list col-10">
                        <div class="row">
                            <article class="col-md-3 col-sm-4 col-xs-6 thumb grid-item post-38424">
                                <div class="item">
                                   <a class="thumb" href="\movieDetails" title="GÓA PHỤ ĐEN">
                                    <figure><img class="lazy img-responsive" src="image_products/The_Wolf_of_Wall_Street.png" alt="GÓA PHỤ ĐEN" title="GÓA PHỤ ĐEN"></figure>
                                    <span class="status" style="background-color: cadetblue">18T</span>
                                    <div class="product-info">
                                        <h2 class="product-name">Sói già phố Wall</h2>
                                        <div class="movie-info">
                                            <span class="bold">Thể loại: </span>
                                            <span class="normal">Gia đình, Hài, Tình cảm</span>
                                        </div>
                                        <div class="movie-info">
                                            <span class="bold">Thời lượng: </span>
                                            <span class="normal">120 phút</span>
                                        </div>
                                        <div class="movie-info">
                                            <span class="bold">Khởi chiếu: </span>
                                            <span class="normal">23-02-2024</span>
                                        </div>
                                    </div>
                                    <ul>
                                        <li class="like">
                                            <button class="btn btn-like"><i class="fa fa-thumbs-up"></i> Like 12</button>
                                        </li>
                                        <li class="booking">
                                            <button class="btn btn-booking"><i class="fa-solid fa-receipt"></i> Đặt vé</button>
                                        </li>
                                    </ul>
                                   </a>
                                </div>
                            </article>
                            <article class="col-md-3 col-sm-4 col-xs-6 thumb grid-item post-38424">
                                <div class="item">
                                   <a class="thumb" href="chitiet.php" title="GÓA PHỤ ĐEN">
                                    <figure><img class="lazy img-responsive" src="image_products/The_Wolf_of_Wall_Street.png" alt="GÓA PHỤ ĐEN" title="GÓA PHỤ ĐEN"></figure>
                                    <span class="status" style="background-color: cadetblue">18T</span>
                                    <div class="product-info">
                                        <h2 class="product-name">Sói già phố Wall</h2>
                                        <div class="movie-info">
                                            <span class="bold">Thể loại: </span>
                                            <span class="normal">Gia đình, Hài, Tình cảm</span>
                                        </div>
                                        <div class="movie-info">
                                            <span class="bold">Thời lượng: </span>
                                            <span class="normal">120 phút</span>
                                        </div>
                                        <div class="movie-info">
                                            <span class="bold">Khởi chiếu: </span>
                                            <span class="normal">23-02-2024</span>
                                        </div>
                                    </div>
                                    <ul>
                                        <li class="like">
                                            <button class="btn btn-like"><i class="fa fa-thumbs-up"></i> Like 12</button>
                                        </li>
                                        <li class="booking">
                                            <button class="btn btn-booking"><i class="fa-solid fa-receipt"></i> Đặt vé</button>
                                        </li>
                                    </ul>
                                   </a>
                                </div>
                            </article>
                        </div>
                    </div>
                    <div class="product-rating col-2">

                    </div>
                </div>

            </div>
        </div>

        <div id="phimsapchieu" class="row g-4 mt-2 row-cols-1 row-cols-md-2 collapse" data-bs-parent="#Movies">
            <article class="card px-0 overflow-hidden" style="background: #f5f5f5">
                2
            </article>
        </div>
        
    </div>
</section>
@endsection

@section('js')
    <script>
        $(document).ready(function () {
            $('.director-input').select2({
                tags: true
            });

            $('#rating').select2({
                tags: true
            })

            $('#movieGenres').select2({
                tags: true
            });

            $("#Movies .nav .nav-item .nav-link").on("click", function () {
                $("#Movies .nav-item").find(".active").removeClass("active fw-bold border-bottom border-2 movie-border").addClass("link-secondary").prop('disabled', false);
                $(this).addClass("active fw-bold border-bottom border-2 movie-border").removeClass("link-secondary").prop('disabled', true);
            });
        });
    </script>
@endsection
