@extends('admin.layouts.index')
@section('content')
<section class="container-fluid py-4">
    <div class="row">
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-uppercase font-weight-bold">Doanh thu trong ngày</p>
                                <h5 class="font-weight-bolder">
                                    {{-- {!! number_format($sum_today,0,",",".") !!} Vnđ --}}
                                    800000 vnd
                                </h5>
                                <p class="mb-0">
                                    {{-- <span class="text-info text-sm font-weight-bolder">{!! date("d-m-Y",strtotime($now)) !!}</span> --}}
                                    <span class="text-info text-sm font-weight-bolder">22/02/2024</span>
                                </p>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                                <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-uppercase font-weight-bold">Khách hàng</p>
                                <h5 class="font-weight-bolder">
                                    {{-- {!! count($user) !!} --}}
                                    5
                                </h5>
                                <p class="mb-0">
                                     {{-- <span class="text-success text-sm font-weight-bolder">{!! date("d-m-Y",strtotime($now)) !!}</span> --}}
                                     <span class="text-success text-sm font-weight-bolder">22/02/2024</span>
                                </p>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
                                <i class="ni ni-paper-diploma text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-uppercase font-weight-bold">Số vé bán ra</p>
                                <h5 class="font-weight-bolder">
                                    {{-- {!! $ticket_seat !!} --}}
                                    100
                                </h5>
                                {{-- <span class="text-danger text-sm font-weight-bolder">{!! date("d-m-Y",strtotime($year)) !!}
                                        | {!! date("d-m-Y",strtotime($now)) !!}</span> --}}
                                <span class="text-danger text-sm font-weight-bolder">2024</span>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
                                <i class="ni ni-world text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-uppercase font-weight-bold">Tổng doanh thu</p>
                                <h5 class="font-weight-bolder">
                                    {{-- {!! number_format($sum,0,",",".") !!} Vnđ --}}
                                    10000000 vnd
                                </h5>
                                <p class="mb-0">
                                    {{-- <span class="text-warning text-sm font-weight-bolder">{!! date("d-m-Y",strtotime($year)) !!}
                                        | {!! date("d-m-Y",strtotime($now)) !!}</span> --}}
                                        <span class="text-warning text-sm font-weight-bolder">2024</span>
                                </p>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">
                                <i class="ni ni-cart text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row mt-4">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Doanh thu</h6>
                </div>
                <div class="card-body ms-8">
                    <div class="row">
                            <div class="col-md-5">
                                <label for="start_time" class="form-control-label">Từ</label>
                                <div class="form-group" style="text-align:center">
                                    <input name="start_time"  id="start_time" class="form-control datepicker" placeholder="Please select date" type="text">
                                </div>
                            </div>
                            <div class="col-md-5">
                                <label for="end_time"  class="form-control-label">Đến</label>
                                <div class="form-group" style="text-align:center">
                                    <input name="end_time" id="end_time" value="{!! date("Y-m-d") !!}" class="form-control datepicker" placeholder="Please select date" type="text" >
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <button  id="btn-statistical-filter" class="form-control">Xác nhận</button>
                                </div>
                            </div>
    
                        <div class="col-md-5">
                            <label for="statistical" class="form-control-label">Theo thời gian</label>
                            <div class="form-group" style="text-align:center">
                                <select id="statistical" style="width: 50%" class="statistical-filter form-control">
                                    <option value="null" selected>Chọn</option>
                                    <option value="week" >Tuần</option>
                                    <option value="this_month">Tháng</option>
                                    <option value="year">Năm</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <label for="theater" class="form-control-label">Rạp</label>
                            <div class="form-group" style="text-align:center">
                                <select id="theater" style="width: 50%" class="statistical-sortby form-control">
                                    <option value="null" selected>Chọn</option>
                                    <option value="ticket">Lọc theo vé</option>
                                    <option value="theater">Lọc theo rạp</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12 ">
        <div id="admin_chart" style="height: 300px; width: 100%" ></div>
    </div>

    <div class="row mt-4">
        <div class="col-lg-7 mb-lg-0 mb-4">
            <div class="card ">
                <div class="card-header pb-0 p-3">
                    <div class="d-flex justify-content-between ">
                        <h6 class="mb-2">
                            Doanh thu theo rạp
                        </h6>
                        <a href="#" data-bs-toggle="modal" data-bs-target="#movie" class="float-end">Xem tất cả</a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table align-items-center ">
                        <tbody>
                            <tr>
                                <td class="w-30">
                                    <div class="d-flex px-2 py-1 align-items-center">
                                        <div class="ms-4">
                                            <p class="text-xs font-weight-bold mb-0">Phim</p>
                                            <h6 class="text-sm mb-0">
                                                Tên phim
                                            </h6>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">Số vé đã bán</p>
                                        <h6 class="text-sm mb-0">
                                            20
                                        </h6>
                                    </div>
                                </td>
                                <td>
                                    <div class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">Doanh thu</p>
                                        <h6 class="text-sm mb-0">
                                            20000000 đ
                                        </h6>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-5">
            <div class="card ">
                <div class="card-header pb-0 p-3">
                    <div class="d-flex justify-content-between">
                        <h6 class="mb-2">Doanh thu theo phim</h6>
                        <a href="#" data-bs-toggle="modal" data-bs-target="#theater_modal" class="float-end">Xem tất cả</a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table align-items-center ">
                        <tbody>
                            <tr>
                                <td class="w-30">
                                    <div class="d-flex px-2 py-1 align-items-center">
                                        <div class="ms-4">
                                            <p class="text-xs font-weight-bold mb-0">Rạp chiếu</p>
                                            <h6 class="text-sm mb-0">Rạp Ninh Kiều</h6>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">Vé đã bán</p>
                                        <h6 class="text-sm mb-0">
                                            20
                                        </h6>
                                    </div>
                                </td>
                                <td>
                                    <div class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">Doanh thu</p>
                                        <h6 class="text-sm mb-0">
                                            200000000 đ
                                        </h6>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
    <div class="modal fade" id="movie" tabindex="-1" aria-labelledby="movie_title" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="movie_title">
                        Doanh thu theo phim
                        <label for="search_movie">
                            <input type="text" placeholder="Nhập tên phim " class="form-controller" id="search_movie" name="search_movie" />
                        </label>
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <div class="row">
                            <div class="table-responsive">
                                <table class="table align-items-center ">
                                    <tbody id="tbody_movie">
                                        <td class="w-30">
                                            <div class="d-flex px-2 py-1 align-items-center">
                                                <div class="ms-4">
                                                    <p class="text-xs font-weight-bold mb-0">Phim</p>
                                                    <h6 class="text-sm mb-0">
                                                        Tên phim
                                                    </h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="text-center">
                                                <p class="text-xs font-weight-bold mb-0">Vé đã bán</p>
                                                <h6 class="text-sm mb-0">
                                                    20
                                                </h6>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="text-center">
                                                <p class="text-xs font-weight-bold mb-0">Doanh thu</p>
                                                <h6 class="text-sm mb-0">
                                                    2000000000
                                                </h6>
                                            </div>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="modal fade" id="theater_modal" tabindex="-1" aria-labelledby="theater_modal_title" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="theater_modal_title">
                        Doanh thu theo rạp
                        <label for="search_theater">
                            <input type="text" placeholder="Nhập rạp " class="form-controller" id="search_theater" name="search_theater" />
                        </label>
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <div class="row">
                            <div class="table-responsive">
                                <table class="table align-items-center ">
                                    <tbody id="tbody_theater">

                                        <tr>
                                            <td class="w-30">
                                                <div class="d-flex px-2 py-1 align-items-center">
                                                    <div class="ms-4">
                                                        <p class="text-xs font-weight-bold mb-0">Rạp</p>
                                                        <h6 class="text-sm mb-0">Tên rạp</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="text-center">
                                                    <p class="text-xs font-weight-bold mb-0">Vé đã bán</p>
                                                    <h6 class="text-sm mb-0">
                                                        20
                                                    </h6>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="text-center">
                                                    <p class="text-xs font-weight-bold mb-0">Tổng tiền</p>
                                                    <h6 class="text-sm mb-0">
                                                        222222 đ
                                                    </h6>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

</section>
@endsection