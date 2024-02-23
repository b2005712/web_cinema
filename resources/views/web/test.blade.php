@extends('web.layouts.app')
@section('content')
<section>
    <div class="modal-body">
        <ul class="list-group list-group-horizontal flex-wrap">
            <li class="list-group-item border-0">
                <button data-bs-toggle="collapse" data-bs-target="#schedule_date_0" aria-expanded="false"
                    class="btn btn-block btn-outline-dark p-2 m-2 list-group-item-action list-group-item-dark">
                    18/02
                </button>
            </li>
            <li class="list-group-item border-0">
                <button data-bs-toggle="collapse" data-bs-target="#schedule_date_1 list-group-item-action" aria-expanded="false"
                    class="btn btn-block btn-outline-dark p-2 m-2">
                    19/02
                </button>
            </li>
            <li class="list-group-item border-0">
                <button data-bs-toggle="collapse" data-bs-target="#schedule_date_2 list-group-item-action" aria-expanded="false"
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
            <div class="collapse-horizontal collapse" id="schedule_date_0" data-bs-parent="#schedulesMain" style="">
                <div class="d-flex flex-row mt-4">
                    <div class="flex-city p-2 m-1 border-0">
                        <button class="btn p-3 btn-theater" data-bs-toggle="collapse" data-bs-target="#Theater_HồChíMinh" aria-expanded="true">Cần thơ
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
                        <div class="d-flex flex-row mt-4">
                            <div class="flex-city p-2 m-1 border-0">
                                <div class="item">
                                    <button class="btn rounded-0 p-3 active" data-bs-toggle="collapse"
                                        data-bs-target="#TheaterSchedules_1">
                                        Rạp Ninh Kiều
                                    </button>
                                </div>
                            </div>
                            <div class="flex-city p-2 m-1 border-0">
                                <div class="item">
                                    <button class="btn rounded-0 p-3 active" data-bs-toggle="collapse"
                                        data-bs-target="#TheaterSchedules_1">
                                        Rạp xuân Khánh
                                    </button>
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
                    <div id="TheaterSchedules_1">

                    </div>
                </div>
            </div>
    
    
            <div class="collapse-horizontal collapse show" id="schedule_date_1" data-bs-parent="#schedulesMain" style="">
                2
            </div>
            <div class="collapse collapse-horizontal " id="schedule_date_2" data-bs-parent="#schedulesMain">
                3
            </div>
            <div class="collapse collapse-horizontal " id="schedule_date_3" data-bs-parent="#schedulesMain">
            </div>
            <div class="collapse collapse-horizontal " id="schedule_date_4" data-bs-parent="#schedulesMain">
            </div>
            <div class="collapse collapse-horizontal " id="schedule_date_5" data-bs-parent="#schedulesMain">
            </div>
            <div class="collapse collapse-horizontal " id="schedule_date_6" data-bs-parent="#schedulesMain">
            </div>
            <div class="collapse collapse-horizontal " id="schedule_date_7" data-bs-parent="#schedulesMain">
            </div>
        </div>
    </div>
</section>

@endsection