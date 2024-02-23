@extends('web.layouts.app')
@section('content')
<section class="container clearfix">
    <div class="theater">
        <div class="collapse show" data-bs-parent="#schedules">
            <div class="d-flex flex-row mt-4">
                <div class="flex-city p-2 m-1 border-0">
                    <button class="btn p-3 btn-theater" data-bs-toggle="collapse" data-bs-target="#Theater_HồChíMinh" aria-expanded="true" disabled="">Cần thơ
                    </button>
                </div>
                <div class="flex-city p-2 m-1 border-0">
                    <button class="btn p-3 collapsed btn-secondary" data-bs-toggle="collapse" data-bs-target="#Theater_HàNội" aria-expanded="false">Hồ Chí Minh
                    </button>
                </div>
                <div class="flex-city p-2 m-1 border-0">
                    <button class="btn p-3 collapsed btn-secondary" data-bs-toggle="collapse" data-bs-target="#Theater_ĐàNẵng" aria-expanded="false">Vĩnh Long
                    </button>
                </div>
            </div>
            <div id="theaterParent">
                <div class="collapse  show " id="Theater_HồChíMinh" data-bs-parent="#theaterParent">
                    <div class="row g-4 mt-2 row-cols-1 row-cols-sm-2 row-cols-md-4 ">
                        <div class="col">
                            <div class="card px-0 overflow-hidden theater_item" style="background: #f5f5f5">
                                <button class="btn rounded-0 border-0 btn_theater  btn-warning " data-bs-toggle="collapse"
                                    data-bs-target="#TheaterSchedules_1" disabled="">
                                    <div class="card-body">
                                        <h5 class="card-title fs-4">Rạp Cao Lỗ</h5>
                                        <p class="card-text fs-6 text-secondary">
                                            <i class="fa-solid fa-location-dot"></i>
                                            180 Cao Lỗ, Phường 4, Quận 8
                                        </p>
                                    </div>
                                </button>
        
                                <div class="card-footer">
                                    <a href="https://goo.gl/maps/byH5EsfDuzKR1fYu6" class="btn w-100 h-100 text-uppercase"
                                        target="_blank">xem Bản đồ
                                        <i class="fa-solid fa-map-location-dot"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="collapse " id="Theater_HàNội" data-bs-parent="#theaterParent">
                    <div class="row g-4 mt-2 row-cols-1 row-cols-sm-2 row-cols-md-4 ">
                        <div class="col">
                            <div class="card px-0 overflow-hidden theater_item" style="background: #f5f5f5">
                                <button class="btn rounded-0 border-0 btn_theater " data-bs-toggle="collapse"
                                    data-bs-target="#TheaterSchedules_2">
                                    <div class="card-body">
                                        <h5 class="card-title fs-4">Rạp Hồ Gươm </h5>
                                        <p class="card-text fs-6 text-secondary">
                                            <i class="fa-solid fa-location-dot"></i>
                                            180 Lỗ Cao, Phường 5, Quận 9
                                        </p>
                                    </div>
                                </button>
        
                                <div class="card-footer">
                                    <a href="https://goo.gl/maps/byH5EsfDuzKR1fYu6" class="btn w-100 h-100 text-uppercase"
                                        target="_blank">xem Bản đồ
                                        <i class="fa-solid fa-map-location-dot"></i>
                                    </a>
                                </div>
                            </div> 
                        </div>
                    </div>
                </div>
                <div class="collapse " id="Theater_ĐàNẵng" data-bs-parent="#theaterParent">
                    <div class="row g-4 mt-2 row-cols-1 row-cols-sm-2 row-cols-md-4 ">
                        <div class="col">
                            <div class="card px-0 overflow-hidden theater_item" style="background: #f5f5f5">
                                <button class="btn rounded-0 border-0 btn_theater " data-bs-toggle="collapse"
                                    data-bs-target="#TheaterSchedules_3">
                                    <div class="card-body">
                                        <h5 class="card-title fs-4">Rạp VinCom Đà Nẵng</h5>
                                        <p class="card-text fs-6 text-secondary">
                                            <i class="fa-solid fa-location-dot"></i>
                                            180 Cỗ Lao, Phường 6, Quận 10
                                        </p>
                                    </div>
                                </button>
        
                                <div class="card-footer">
                                    <a href="https://goo.gl/maps/byH5EsfDuzKR1fYu6" class="btn w-100 h-100 text-uppercase"
                                        target="_blank">xem Bản đồ
                                        <i class="fa-solid fa-map-location-dot"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="theaterSchedulesParent">
                    <div class="collapse  show " id="TheaterSchedules_1" data-bs-parent="#theaterSchedulesParent">
                        <ul class="list-group list-group-horizontal flex-wrap mt-4 listDate">
                            <li class="list-group-item border-0">
                                <button data-bs-toggle="collapse" data-bs-target="#schedule_1_date_0" aria-expanded="false"
                                    class="btn btn-block btn-outline-dark p-2 m-2 btn-date collapsed">
                                    18/02
                                </button>
                            </li>
                            <li class="list-group-item border-0">
                                <button data-bs-toggle="collapse" data-bs-target="#schedule_1_date_1" aria-expanded="false"
                                    class="btn btn-block btn-outline-dark p-2 m-2 btn-date collapsed">
                                    19/02
                                </button>
                            </li>
                            <li class="list-group-item border-0">
                                <button data-bs-toggle="collapse" data-bs-target="#schedule_1_date_2" aria-expanded="false"
                                    class="btn btn-block btn-outline-dark p-2 m-2 btn-date collapsed">
                                    20/02
                                </button>
                            </li>
                            <li class="list-group-item border-0">
                                <button data-bs-toggle="collapse" data-bs-target="#schedule_1_date_3" aria-expanded="false"
                                    class="btn btn-block btn-outline-dark p-2 m-2 btn-date collapsed">
                                    21/02
                                </button>
                            </li>
                            <li class="list-group-item border-0">
                                <button data-bs-toggle="collapse" data-bs-target="#schedule_1_date_4" aria-expanded="false"
                                    class="btn btn-block btn-outline-dark p-2 m-2 btn-date collapsed">
                                    22/02
                                </button>
                            </li>
                            <li class="list-group-item border-0">
                                <button data-bs-toggle="collapse" data-bs-target="#schedule_1_date_5" aria-expanded="false"
                                    class="btn btn-block btn-outline-dark p-2 m-2 btn-date collapsed">
                                    23/02
                                </button>
                            </li>
                            <li class="list-group-item border-0">
                                <button data-bs-toggle="collapse" data-bs-target="#schedule_1_date_6" aria-expanded="true"
                                    class="btn btn-block btn-outline-dark p-2 m-2 btn-date">
                                    24/02
                                </button>
                            </li>
                            <li class="list-group-item border-0">
                                <button data-bs-toggle="collapse" data-bs-target="#schedule_1_date_7" aria-expanded="true"
                                    class="btn btn-block btn-outline-dark p-2 m-2 btn-date active">
                                    25/02
                                </button>
                            </li>
                        </ul>
                        <div class="mt-2">
                            <h4>Lịch chiếu phim</h4>
                            <div>
                                <div class="d-block mt-2 mb-5" id="schedulesMain_1">
                                    <div class="collapse-horizontal collapse" id="schedule_1_date_0"
                                        data-bs-parent="#schedulesMain_1" style="">
                                    </div>
                                    <div class="collapse-horizontal collapse" id="schedule_1_date_1"
                                        data-bs-parent="#schedulesMain_1" style="">
                                    </div>
                                    <div class="collapse-horizontal collapse" id="schedule_1_date_2"
                                        data-bs-parent="#schedulesMain_1" style="">
                                    </div>
                                    <div class="collapse-horizontal collapse" id="schedule_1_date_3"
                                        data-bs-parent="#schedulesMain_1" style="">
                                    </div>
                                    <div class="collapse-horizontal collapse" id="schedule_1_date_4"
                                        data-bs-parent="#schedulesMain_1" style="">
                                    </div>
                                    <div class="collapse-horizontal collapse" id="schedule_1_date_5"
                                        data-bs-parent="#schedulesMain_1" style="">
                                    </div>
                                    <div class="collapse-horizontal collapse show" id="schedule_1_date_6"
                                        data-bs-parent="#schedulesMain_1" style="">
                                    </div>
                                    <div class="collapse-horizontal collapse show" id="schedule_1_date_7"
                                        data-bs-parent="#schedulesMain_1" style="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="collapse " id="TheaterSchedules_2" data-bs-parent="#theaterSchedulesParent">
                        <ul class="list-group list-group-horizontal flex-wrap mt-4 listDate">
                            <li class="list-group-item border-0">
                                <button data-bs-toggle="collapse" data-bs-target="#schedule_2_date_0" aria-expanded="true"
                                    class="btn btn-block btn-outline-dark p-2 m-2 btn-date">
                                    18/02
                                </button>
                            </li>
                            <li class="list-group-item border-0">
                                <button data-bs-toggle="collapse" data-bs-target="#schedule_2_date_1" aria-expanded="false"
                                    class="btn btn-block btn-outline-dark p-2 m-2 btn-date">
                                    19/02
                                </button>
                            </li>
                            <li class="list-group-item border-0">
                                <button data-bs-toggle="collapse" data-bs-target="#schedule_2_date_2" aria-expanded="false"
                                    class="btn btn-block btn-outline-dark p-2 m-2 btn-date">
                                    20/02
                                </button>
                            </li>
                            <li class="list-group-item border-0">
                                <button data-bs-toggle="collapse" data-bs-target="#schedule_2_date_3" aria-expanded="false"
                                    class="btn btn-block btn-outline-dark p-2 m-2 btn-date">
                                    21/02
                                </button>
                            </li>
                            <li class="list-group-item border-0">
                                <button data-bs-toggle="collapse" data-bs-target="#schedule_2_date_4" aria-expanded="false"
                                    class="btn btn-block btn-outline-dark p-2 m-2 btn-date">
                                    22/02
                                </button>
                            </li>
                            <li class="list-group-item border-0">
                                <button data-bs-toggle="collapse" data-bs-target="#schedule_2_date_5" aria-expanded="false"
                                    class="btn btn-block btn-outline-dark p-2 m-2 btn-date">
                                    23/02
                                </button>
                            </li>
                            <li class="list-group-item border-0">
                                <button data-bs-toggle="collapse" data-bs-target="#schedule_2_date_6" aria-expanded="false"
                                    class="btn btn-block btn-outline-dark p-2 m-2 btn-date">
                                    24/02
                                </button>
                            </li>
                            <li class="list-group-item border-0">
                                <button data-bs-toggle="collapse" data-bs-target="#schedule_2_date_7" aria-expanded="false"
                                    class="btn btn-block btn-outline-dark p-2 m-2 btn-date">
                                    25/02
                                </button>
                            </li>
                        </ul>
                        <div class="mt-2">
                            <h4>Lịch chiếu phim</h4>
                            <div>
                                <div class="d-block mt-2 mb-5" id="schedulesMain_2">
                                    <div class="collapse collapse-horizontal  show " id="schedule_2_date_0"
                                        data-bs-parent="#schedulesMain_2">
                                    </div>
                                    <div class="collapse collapse-horizontal " id="schedule_2_date_1"
                                        data-bs-parent="#schedulesMain_2">
                                    </div>
                                    <div class="collapse collapse-horizontal " id="schedule_2_date_2"
                                        data-bs-parent="#schedulesMain_2">
                                    </div>
                                    <div class="collapse collapse-horizontal " id="schedule_2_date_3"
                                        data-bs-parent="#schedulesMain_2">
                                    </div>
                                    <div class="collapse collapse-horizontal " id="schedule_2_date_4"
                                        data-bs-parent="#schedulesMain_2">
                                    </div>
                                    <div class="collapse collapse-horizontal " id="schedule_2_date_5"
                                        data-bs-parent="#schedulesMain_2">
                                    </div>
                                    <div class="collapse collapse-horizontal " id="schedule_2_date_6"
                                        data-bs-parent="#schedulesMain_2">
                                    </div>
                                    <div class="collapse collapse-horizontal " id="schedule_2_date_7"
                                        data-bs-parent="#schedulesMain_2">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="collapse " id="TheaterSchedules_3" data-bs-parent="#theaterSchedulesParent">
                        <ul class="list-group list-group-horizontal flex-wrap mt-4 listDate">
                            <li class="list-group-item border-0">
                                <button data-bs-toggle="collapse" data-bs-target="#schedule_3_date_0" aria-expanded="true"
                                    class="btn btn-block btn-outline-dark p-2 m-2 btn-date">
                                    18/02
                                </button>
                            </li>
                            <li class="list-group-item border-0">
                                <button data-bs-toggle="collapse" data-bs-target="#schedule_3_date_1" aria-expanded="false"
                                    class="btn btn-block btn-outline-dark p-2 m-2 btn-date">
                                    19/02
                                </button>
                            </li>
                            <li class="list-group-item border-0">
                                <button data-bs-toggle="collapse" data-bs-target="#schedule_3_date_2" aria-expanded="false"
                                    class="btn btn-block btn-outline-dark p-2 m-2 btn-date">
                                    20/02
                                </button>
                            </li>
                            <li class="list-group-item border-0">
                                <button data-bs-toggle="collapse" data-bs-target="#schedule_3_date_3" aria-expanded="false"
                                    class="btn btn-block btn-outline-dark p-2 m-2 btn-date">
                                    21/02
                                </button>
                            </li>
                            <li class="list-group-item border-0">
                                <button data-bs-toggle="collapse" data-bs-target="#schedule_3_date_4" aria-expanded="false"
                                    class="btn btn-block btn-outline-dark p-2 m-2 btn-date">
                                    22/02
                                </button>
                            </li>
                            <li class="list-group-item border-0">
                                <button data-bs-toggle="collapse" data-bs-target="#schedule_3_date_5" aria-expanded="false"
                                    class="btn btn-block btn-outline-dark p-2 m-2 btn-date">
                                    23/02
                                </button>
                            </li>
                            <li class="list-group-item border-0">
                                <button data-bs-toggle="collapse" data-bs-target="#schedule_3_date_6" aria-expanded="false"
                                    class="btn btn-block btn-outline-dark p-2 m-2 btn-date">
                                    24/02
                                </button>
                            </li>
                            <li class="list-group-item border-0">
                                <button data-bs-toggle="collapse" data-bs-target="#schedule_3_date_7" aria-expanded="false"
                                    class="btn btn-block btn-outline-dark p-2 m-2 btn-date">
                                    25/02
                                </button>
                            </li>
                        </ul>
                        <div class="mt-2">
                            <h4>Lịch chiếu phim</h4>
                            <div>
                                <div class="d-block mt-2 mb-5" id="schedulesMain_3">
                                    <div class="collapse collapse-horizontal  show " id="schedule_3_date_0"
                                        data-bs-parent="#schedulesMain_3">
                                    </div>
                                    <div class="collapse collapse-horizontal " id="schedule_3_date_1"
                                        data-bs-parent="#schedulesMain_3">
                                    </div>
                                    <div class="collapse collapse-horizontal " id="schedule_3_date_2"
                                        data-bs-parent="#schedulesMain_3">
                                    </div>
                                    <div class="collapse collapse-horizontal " id="schedule_3_date_3"
                                        data-bs-parent="#schedulesMain_3">
                                    </div>
                                    <div class="collapse collapse-horizontal " id="schedule_3_date_4"
                                        data-bs-parent="#schedulesMain_3">
                                    </div>
                                    <div class="collapse collapse-horizontal " id="schedule_3_date_5"
                                        data-bs-parent="#schedulesMain_3">
                                    </div>
                                    <div class="collapse collapse-horizontal " id="schedule_3_date_6"
                                        data-bs-parent="#schedulesMain_3">
                                    </div>
                                    <div class="collapse collapse-horizontal " id="schedule_3_date_7"
                                        data-bs-parent="#schedulesMain_3">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('js')
    <script>
        $(document).ready(function () {
            $("#schedules .nav .nav-item .nav-link").on("click", function () {
                $("#schedules .nav-item").find(".active").removeClass("active link-warning fw-bold border-bottom border-2 border-warning").addClass("link-secondary").prop('disabled', false);
                $(this).addClass("active link-warning fw-bold border-bottom border-2 border-warning").removeClass("link-secondary").prop('disabled', true);
            });

            $("#lichtheorap .d-flex .flex-city .btn").on("click", function () {
                $("#lichtheorap .flex-city").find(".btn").removeClass("btn-warning").addClass("btn-secondary").prop('disabled', false);
                $(this).addClass("btn-warning").removeClass("btn-secondary").prop('disabled', true);
            });

            $(".theater_item .btn_theater").on("click", function () {
                $(".theater_item ").find(".btn_theater").removeClass("btn-warning").prop('disabled', false);
                $(this).addClass("btn-warning").prop('disabled', true);
            });

            $(".listDate button").on('click', function () {
                $(".listDate").find(".btn").removeClass('active');
                $(this).addClass("active");
            })
        })
    </script>
@endsection