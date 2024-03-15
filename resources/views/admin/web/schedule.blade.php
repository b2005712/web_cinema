@extends('admin.layouts.index')
@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Lịch chiếu</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <form action="admin/schedule" method="get">
                            <div class="row container">
                                <div class="col-5">
                                    <div class="input-group">
                                        <span class="input-group-text bg-gray-200"> Rạp chiếu</span>
                                        <select id="theater" class="form-select ps-2" name="theater" aria-label="">
                                            @foreach($theaters as $theater)
                                            <option value="{{ $theater->id }}" @if($theater==$theater_cur) selected @endif>
                                                {{ $theater->name }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-5">
                                    <div class="input-group">
                                        <span class="input-group-text bg-gray-200"> Ngày chiếu</span>
                                        <input name="date" id="date" value="{{ date("Y-m-d",strtotime($date_cur)) }}" aria-label="" class="form-control ps-2" type="text">
                                    </div>
                                </div>
                                <div class="col-2">
                                    <button type="submit" class="btn  bg-gradient-primary">Lưu</button>
                                </div>
                            </div>
                        </form>
                        <div class="table-responsive m-2">
                            <table class="table table-bordered table-striped align-items-center text-center">
                                <colgroup>
                                    <col span="1" style="width: 40%;">
                                    <col span="1" style="width: 30%;">
                                    <col span="1" style="width: 30%;">
                                </colgroup>
                                <thead class="table-primary">
                                    <tr>
                                        <th class="text-uppercase font-weight-bolder"> Phòng</th>
                                        <th class="text-uppercase font-weight-bolder"> Loại phòng</th>
                                        <th class="text-uppercase font-weight-bolder"> Số ghế</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @isset($theater_cur)
                                    @foreach($theater_cur->rooms as $room)
                                    @if($room['status'] == 1)
                                    <tr>
                                        <td>
                                            {{ $room->name }}
                                        </td>
                                        <td>
                                            {{ $room->roomType->name }}
                                        </td>
                                        <td>
                                            {{ $room->seats->count() }}
                                        </td>
                                    </tr>

                                    <tr>
                                        <td colspan="3">
                                            <table id="room_{{$room->id}}" class="table table-bordered align-items-center">
                                                <colgroup>
                                                    <col span="1" style="width: 20%;">
                                                    <col span="1" style="width: 80%;">
                                                </colgroup>
                                                <thead>
                                                    <tr>
                                                        <th class="text-uppercase fw-bold">Thời gian</th>
                                                        <th class="text-uppercase fw-bold text-start">Phim</th>
                                                        <th class="text-uppercase fw-bold">Trạng thái</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($room->schedulesByDate(date('Y-m-d', strtotime($date_cur))) as $schedule)
                                                    <tr class="delete_schedule" id="schedules_{{ $schedule->id }}">
                                                        <td>
                                                            {{ date('H:i', strtotime($schedule->startTime)) }}
                                                            - {{ date('H:i', strtotime($schedule->endTime)) }}
                                                        </td>
                                                        <td class="text-start">
                                                            {{ $schedule->movie->name }}
                                                        </td>
                                                        @if(date('Y-m-d', strtotime($schedule->date))
                                                        < date('Y-m-d', strtotime($schedule->movie->releaseDate)))
                                                            <td id="early_status{!! $schedule['id'] !!}" class="align-middle text-center text-sm ">
                                                                @if($schedule->early == 1)
                                                                <a href="javascript:void(0)" class="btn_active" onclick="changeearlystatus({!! $schedule['id'] !!},0)">
                                                                    <span class="badge badge-sm bg-gradient-success">
                                                                        Early access
                                                                    </span>
                                                                </a>
                                                                @else
                                                                <a href="javascript:void(0)" class="btn_active" onclick="changeearlystatus({!! $schedule['id'] !!},1)">
                                                                    <span class="badge badge-sm bg-gradient-secondary">
                                                                        Offline
                                                                    </span>
                                                                </a>
                                                                @endif
                                                            </td>
                                                            @else
                                                            <td id="status{!! $schedule['id'] !!}" class="align-middle text-center text-sm ">
                                                                @if($schedule->status == 1)
                                                                <a href="javascript:void(0)" class="btn_active" onclick="changestatus({!! $schedule['id'] !!},0)">
                                                                    <span class="badge badge-sm bg-gradient-success">Online</span>
                                                                </a>
                                                                @else
                                                                <a href="javascript:void(0)" class="btn_active" onclick="changestatus({!! $schedule['id'] !!},1)">
                                                                    <span class="badge badge-sm bg-gradient-secondary">Offline</span>
                                                                </a>
                                                                @endif
                                                            </td>
                                                            @endif
                                                    </tr>
                                                    @endforeach
                                                    <tr>
                                                        <td>
                                                            <button class="btn btn-info btn_add" data-bs-toggle="modal" data-bs-target="#CreateScheduleModal_{{ $room->id }}">
                                                                <i class="fa-regular fa-circle-plus"></i> Tạo
                                                            </button>
                                                        </td>
                                                        <td colspan="3">
                                                            <div class="d-flex justify-content-end">
                                                                <button class="btn btn-warning btn_changeAllStatus" onclick="changeAllStatus({{
                                                                        $room->id }})">
                                                                    <i class="fa-solid fa-repeat"></i> Thay đổi trạng thái tất cả
                                                                </button>
                                                                <a href="javascript:void(0);" data-date="{{$date_cur}}" data-theater="{{$theater_cur->id}}" data-room="{{$room->id}}" data-url="{{ url('admin/schedule/deleteall') }}" class="btn btn-dark ms-3 delete_all">
                                                                    <i class="fa-regular fa-trash"></i> Delete all
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                    @endif
                                    @endforeach
                                    @endisset
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @foreach($theater_cur->rooms as $room)
        @foreach ($room->latestScheduleByDate(date('Y-m-d', strtotime($date_cur))) as $latest)
            @php
            $endTime = strtotime($latest->endTime);
            $endTimeLatest = date('H:i', $endTime + 600);
            @endphp
        @endforeach
    <!-- Modal -->
        <div class="modal fade modal-lg" id="CreateScheduleModal_{{ $room->id }}" tabindex="-1" aria-labelledby="CreateScheduleLabel_{{ $room->id }}"
        aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5 text-uppercase" id="CreateScheduleLabel_{{ $room->id }}">
                            {{ $date_cur }}
                            <div class="vr mx-2"></div>
                            {{ $room->name }}
                            <div class="vr mx-2"></div>
                            Tạo lịch chiếu
                        </h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="/admin/schedule/create" method="post">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label> Thời gian</label>
                                        <div class="d-flex position-relative">
                                            <input class="form-control" id="time" type="time" name="startTime"
                                                @if($room->schedulesByDate(date('Y-m-d', strtotime($date_cur)))->count() == 0)
                                                    min="08:00"
                                                @else
                                                    @if($endTime > strtotime('22:00'))
                                                        min="22:00"
                                                    @else
                                                        min="{{$endTimeLatest}}"
                                                    @endif
                                                @endif
                                                @if($room->schedulesByDate(date('Y-m-d', strtotime($date_cur)))->count() == 0)
                                                    value="08:00"
                                                @else
                                                    value="{{$endTimeLatest}}"
                                                @endif
                                                aria-label="time">
                                        </div>
                                    </div>
                                    <div class="form-check">
                                        <input id="remainingSchedules_{{$room->id}}" type="checkbox" class="form-check-input" name="remainingSchedules"
                                            aria-label="">
                                        <label class="custom-control-label">Tất cả suất chiếu còn lại trong ngày</label>
                                    </div>

                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label class="form-label"> Phim</label>
                                        <select class="form-select" id="address" name="movie" aria-label="">
                                            @foreach($movies as $movie)
                                                @if ($movie->releaseDate <= $date_cur && $movie->endDate >= $date_cur)
                                                    <option value="{{ $movie->id }}">{{ $movie->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Âm thanh</label>
                                        <select id="city_create" class="form-select" name="audio" aria-label="audio">
                                            <option value="vn">Việt</option>
                                            <option value="en">Anh</option>
                                            <option value="cn">Trung Quốc</option>
                                            <option value="kr">Hàn</option>
                                            <option value="jp">Nhật</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label> Phụ đề</label>
                                        <select class="form-select" name="subtitle" aria-label="subtitle">
                                            <option value="vn">Việt</option>
                                            <option value="en">Anh</option>
                                        </select>
                                    </div>
                                </div>
                                <input type="hidden" name="theater" value="{{ $theater_cur->id }}">
                                <input type="hidden" name="room" value="{{ $room->id }}">
                                <input type="hidden" name="date" value="{{ $date_cur }}">
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"> Hủy</button>
                            <button type="submit" class="btn btn-primary"
                                    @if(isset($endTime))
                                        @if($endTime> strtotime('22:00'))
                                            disabled
                                @endif
                                @endif
                            >Lưu</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
@endsection
@section('scripts')
<script>
    $(document).ready(function() {
        flatpickr($("#date"), {
            dateFormat: "Y-m-d ",
            "locale": "vn"
        });

        @if(date('Y-m-d') > $date_cur)
        $('.btn-early').addClass('disabled');
        $('.btn_active').addClass('disabled');
        $('.btn_changeAllStatus').addClass('disabled');
        $('.delete_all').addClass('disabled');
        $('.btn_add').addClass('disabled');
        @endif

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('.delete_all').on('click', function(e) {
            var userURL = $(this).data('url');
            var theater_id = $(this).data('theater');
            var room_id = $(this).data('room');
            var date = $(this).data('date');
            if (confirm("Are you sure you want to remove it?") === true) {
                $.ajax({
                    url: userURL,
                    type: 'GET',
                    dataType: 'json',
                    data: {
                        'theater_id': theater_id,
                        'room_id': room_id,
                        'date': date
                    },
                    success: function(data) {
                        if (data['success']) {
                            // $(".delete_schedule").remove();
                            window.location.reload();
                        }
                    }

                });
            }
        });
    });
</script>
<script>
    function changestatus(schedule_id, active) {
        if (active === 1) {
            $("#status" + schedule_id).html(' <a href="javascript:void(0)"  class="btn_active" onclick="changestatus(' + schedule_id + ',0)">\
                    <span class="badge badge-sm bg-gradient-success">Online</span>\
            </a>')
        } else {
            $("#status" + schedule_id).html(' <a  href="javascript:void(0)" class="btn_active"  onclick="changestatus(' + schedule_id + ',1)">\
                    <span class="badge badge-sm bg-gradient-secondary">Offline</span>\
            </a>')
        }
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "/admin/schedule/status",
            type: 'GET',
            dataType: 'json',
            data: {
                'active': active,
                'schedule_id': schedule_id
            },
            success: function(data) {
                if (data['success']) {
                } else if (data['error']) {
                    alert(data.error);
                }
            }
        });
    }
</script>
<script>
    function changeearlystatus(early_id, active) {
        if (active === 1) {
            $("#early_status" + early_id).html(' <a href="javascript:void(0)"  class="btn_active" onclick="changeearlystatus(' + early_id + ',0)">\
                    <span class="badge badge-sm bg-gradient-success">Early access</span>\
            </a>')
        } else {
            $("#early_status" + early_id).html(' <a  href="javascript:void(0)" class="btn_active"  onclick="changeearlystatus(' + early_id + ',1)">\
                    <span class="badge badge-sm bg-gradient-secondary">Offline</span>\
            </a>')
        }
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "/admin/schedule/early_status",
            type: 'GET',
            dataType: 'json',
            data: {
                'active': active,
                'early_id': early_id
            },
            success: function(data) {
                if (data['success']) {
                    // alert(data.success);
                } else if (data['error']) {
                    alert(data.error);
                }
            }
        });
    }
</script>
<script>
    @isset($theater_cur)
        @foreach($theater_cur -> rooms as $room)
        $('#remainingSchedules_{{$room->id}}').change((e) => {
            if ($(e.target).is(':checked')) {
                $('#CreateScheduleModal_{{ $room->id }}').find('#time').attr('readonly', true);
            } else {
                $('#CreateScheduleModal_{{ $room->id }}').find('#time').attr('readonly', false);
            }
        });
        @endforeach
    @endisset
</script>
<script>
    changeAllStatus = (room_id) => {
        schedulesElements = $('#room_' + room_id).find('.btn_active');
        schedulesElements.toArray().forEach(schedulesElement => {
            schedulesElement.click();
        });
    }
</script>
@endsection