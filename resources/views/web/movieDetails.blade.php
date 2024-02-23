@extends('web.layouts.app')
@section('content')
<section class="container clearfix">
    <nav aria-label="breadcrumb mt-5">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/" class="link link-dark text-decoration-none"><i class="fa-solid fa-house"></i></a></li>
            <li class="breadcrumb-item"><a href="/movies" class="link link-dark text-decoration-none">Phim đang chiếu</a></li>
            <li class="breadcrumb-item active" aria-current="page">Sói gia</li>
        </ol>
    </nav>
    <div class="movieDetails mt-5">
        <h3 class="mb-3 pb-3 border-bottom border-3">Nội dung phim</h3>
        <div class="row">
            <div class="col-2">
                <img class="lazy img-responsive" src="image_products/The_Wolf_of_Wall_Street.png" alt="GÓA PHỤ ĐEN" title="GÓA PHỤ ĐEN">
            </div>
            <div class="col">
                <h4 class="pb-3 border-bottom">SÓI GIÀ PHỐ WALL</h4>
                <div class="mt-3">
                    <div class="product-info">
                        <div class="movie-info">
                            <span class="bold">Đạo diễn: </span>
                            <span class="normal"></span>
                        </div>
                        <div class="movie-info">
                            <span class="bold">Diễn viên: </span>
                            <span class="normal">Gia đình, Hài, Tình cảm</span>
                        </div>
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
                        <div class="movie-info">
                            <span class="bold">Thời lượng: </span>
                            <span class="normal">123 phút</span>
                        </div>
                        <div class="movie-info">
                            <span class="bold">Rate: </span>
                            <span class="normal">123 phút</span>
                        </div>
                        <ul>
                            <li class="like">
                                <button class="btn btn-like"><i class="fa fa-thumbs-up"></i> Like 12</button>
                            </li>
                            <li class="booking">
                                <button class="btn btn-booking" data-bs-toggle="modal" data-bs-target="#datve"><i class="fa-solid fa-receipt"></i> Đặt vé</button>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="datve" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-xl">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">SÓI GIÀ PHỐ WAL</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <ul class="list-group list-group-horizontal flex-wrap date">
                            <li class="list-group-item border-0">
                                <button data-bs-toggle="collapse" data-bs-target="#schedule_date_0" aria-expanded="false"
                                    class="btn btn-block btn-outline-dark p-2 m-2 active" disabled>
                                    18/02
                                </button>
                            </li>
                            <li class="list-group-item border-0">
                                <button data-bs-toggle="collapse" data-bs-target="#schedule_date_1" aria-expanded="false"
                                    class="btn btn-block btn-outline-dark p-2 m-2">
                                    19/02
                                </button>
                            </li>
                            <li class="list-group-item border-0">
                                <button data-bs-toggle="collapse" data-bs-target="#schedule_date_2" aria-expanded="false"
                                    class="btn btn-block btn-outline-dark p-2 m-2">
                                    20/02
                                </button>
                            </li>
                            <li class="list-group-item border-0">
                                <button data-bs-toggle="collapse" data-bs-target="#schedule_date_3" aria-expanded="false"
                                    class="btn btn-block btn-outline-dark p-2 m-2">
                                    21/02
                                </button>
                            </li>
                            <li class="list-group-item border-0">
                                <button data-bs-toggle="collapse" data-bs-target="#schedule_date_4" aria-expanded="false"
                                    class="btn btn-block btn-outline-dark p-2 m-2">
                                    22/02
                                </button>
                            </li>
                            <li class="list-group-item border-0">
                                <button data-bs-toggle="collapse" data-bs-target="#schedule_date_5" aria-expanded="false"
                                    class="btn btn-block btn-outline-dark p-2 m-2">
                                    23/02
                                </button>
                            </li>
                            <li class="list-group-item border-0">
                                <button data-bs-toggle="collapse" data-bs-target="#schedule_date_6" aria-expanded="false"
                                    class="btn btn-block btn-outline-dark p-2 m-2">
                                    24/02
                                </button>
                            </li>
                            <li class="list-group-item border-0">
                                <button data-bs-toggle="collapse" data-bs-target="#schedule_date_7" aria-expanded="false"
                                    class="btn btn-block btn-outline-dark p-2 m-2">
                                    25/02                              
                                </button>
                            </li>
                        </ul>
                        <div class="mt-2 mb-5" id="schedulesMain">
                            <div class="collapse-horizontal collapse show" id="schedule_date_0" data-bs-parent="#schedulesMain" style="">
                                <div class="d-flex flex-row mt-4">
                                    <div class="flex-city p-2 m-1 border-0">
                                        <button class="btn p-3 collapsed btn active btn-theater place" data-bs-toggle="collapse" data-bs-target="#Theater_HồChíMinh" aria-expanded="true" disabled>Cần thơ
                                        </button>
                                    </div>
                                    <div class="flex-city p-2 m-1 border-0">
                                        <button class="btn p-3 collapsed active place" data-bs-toggle="collapse" data-bs-target="#Theater_HàNội" aria-expanded="false">Hồ Chí Minh
                                        </button>
                                    </div>
                                    <div class="flex-city p-2 m-1 border-0">
                                        <button class="btn p-3 collapsed active place" data-bs-toggle="collapse" data-bs-target="#Theater_ĐàNẵng" aria-expanded="false">Vĩnh Long
                                        </button>
                                    </div>
                                </div>
                                <div id="theaterParent">
                                    <div class="collapse show " id="Theater_HồChíMinh" data-bs-parent="#theaterParent">
                                        <div class="d-flex flex-row mt-4">
                                            <ul class="list-group list-group-flush w-100">
                                                <h4>Rạp Ninh Kiều</h4>
                                                <li class="list-group-item">
                                                    <div class="d-flex flex-wrap">
                                                        <ul class="list-group list-group-horizontal flex-wrap date">
                                                            <li class="list-group-item border-0">
                                                                <a href="" class="btn border-1 active">8.00PM</a>
                                                            </li>
                                                            <li class="list-group-item border-0">
                                                                <a href="" class="btn border-1 active">8.00PM</a>
                                                            </li>
                                                            <li class="list-group-item border-0">
                                                                <a href="" class="btn border-1 active">8.00PM</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </li>
                                                <h4>Rạp Ninh Kiều</h4>
                                                <li class="list-group-item">
                                                    <div class="d-flex flex-wrap">
                                                        <ul class="list-group list-group-horizontal flex-wrap date">
                                                            <li class="list-group-item border-0">
                                                                <a href="" class="btn border-1 active">8.00PM</a>
                                                            </li>
                                                            <li class="list-group-item border-0">
                                                                <a href="" class="btn border-1 active">8.00PM</a>
                                                            </li>
                                                            <li class="list-group-item border-0">
                                                                <a href="" class="btn border-1 active">8.00PM</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </li>
                                            </ul>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                  </div>
                </div>
            </div>
{{-- Detail --}}
            <div id="Detail" class="mt-3">
                <ul class="nav justify-content-center mb-4 align-items-center m-auto">
                    <li class="nav-item">
                        <button class="nav-link active fw-bold border-bottom detail"
                                aria-expanded="true"
                                data-bs-toggle="collapse"
                                data-bs-target="#chitiet" disabled>
                            Chi tiết
                        </button>
                    </li>
                    <li class="vr mx-5"></li>
                    <li class="nav-item">
                        <button class="nav-link link-secondary trailer"
                                aria-expanded="false"
                                data-bs-toggle="collapse" data-bs-target="#trailer">
                                Trailer
                        </button>
                    </li>
                </ul>
                <div id="chitiet" class="row g-4 mt-2 row-cols-1 row-cols-md-2 collapse show" data-bs-parent="#Detail">
                    <div class="movie-info">
                        <span class="bold">Nội dung: </span>
                        <span class="normal">123 phút</span>
                    </div>
                </div>
                <div id="trailer" class="row g-4 mt-2 row-cols-1 row-cols-md-2 collapse justify-content-center" data-bs-parent="#Detail">
                    <iframe width="560" height="315" src="https://www.youtube.com/embed/iszwuX1AK6A" frameborder="0" allowfullscreen></iframe>
                </div>
                
            </div>
        </div>
    </div>
</section>
@endsection

@section('js')
<script>
    $(document).ready(function () {
        $("#datve .date .btn").on("click", function () {
            $("#datve .date .btn").removeClass("btn btn-block btn-outline-dark p-2 m-2 active").addClass("h5 nav-link link-secondary").prop('disabled', false);
            $(this).addClass("btn btn-block btn-outline-dark p-2 m-2 active").prop('disabled', true);
        });
        
        $("#schedulesMain .place").on("click", function () {
            $("#datve .place").removeClass("btn-theater").prop('disabled', false);
            $(this).addClass("btn-theater").prop('disabled', true);
        });
        $("#theaterParent .theater").on("click", function () {
            $("#theaterParent .theater").removeClass("btn-theater").prop('disabled', false);
            $(this).addClass("btn-theater").prop('disabled', true);
        });
        $("#Detail .nav-link").on("click", function () {
            $("#Detail .nav-link").removeClass("active fw-bold border-bottom border-2").prop('disabled', false);
            $(this).addClass("nav-link active fw-bold border-bottom border-2").prop('disabled', true);
        });
    });
</script>    
@endsection