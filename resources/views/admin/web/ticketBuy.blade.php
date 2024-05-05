@extends('admin.layouts.index')
@section('content')
    <div class="container-fluid py-4">
        <div class="card">
            <div class="card-header p-0 mx-3 mt-3 position-relative z-index-1">
                bán vé
                <a class="btn btn-danger float-end" href="admin/buyTicket">Hủy</a>
            </div>

            <div class="card-body pt-2">
                <div class="row">
                    {{--Thông tin vé--}}
                    <div class="col-12 col-lg-3 fixed-start">
                        <h4>Thông tin vé</h4>
                        <div id="ticket_info" class="card mb-3 bg-dark text-light px-0 sticky-top">
                            <div class="row">
                                <div class="col-12 col-md-3 col-lg-12 d-flex justify-content-center">
                                    
                                        <img class="img p-3 w-100" alt="..." style="max-height: 361px; max-width: 241px"
                                             src="/images/movies/{{ $movie->image }}">
                                  
                                </div>
                                <div class="col-12 col-md-9 col-lg-12">
                                    <div class="card-body">
                                        <h5 class="card-title text-light">{{ $movie->name }}</h5>
                                        <ul class="list-group">
                                            <li class="list-group-item bg-transparent text-light border-0">
                                                <p>Thời gian chiếu:</p>
                                                <strong class="ps-2">
                                                    {{ date('d/m/Y', strtotime($schedule->date)).' '.date('H:i', strtotime($schedule->startTime)) }}
                                                </strong>
                                            </li>
                                            <li class="list-group-item bg-transparent text-light border-0">
                                                Rạp: <strong class="ps-2">{{ $room->theater->name }}</strong>
                                            </li>
                                            <li class="list-group-item bg-transparent text-light border-0">
                                                Phòng: <strong class="ps-2">{{ $room->name }}</strong>
                                            </li>
                                            <li class="list-group-item bg-transparent text-light border-0">
                                                Xếp hạng: <strong class="ps-2">
                                        <span class="badge @if($movie->rating->name == 'C18') bg-danger
                                                            @elseif($movie->rating->name == 'C16') bg-warning
                                                            @elseif($movie->rating->name == 'P') bg-success
                                                            @elseif($movie->rating->name == 'P') bg-primary
                                                            @else bg-info
                                                            @endif me-1">
                                            {{ $movie->rating->name }}
                                        </span> - {{ $movie->rating->description }}
                                                </strong>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer" style="background: #2e292e;">
                                <div class="d-flex flex-column">
                                    <div class="d-flex text-light p-2">
                                        <span class="flex-shrink-0"><i class="fa-solid fa-popcorn"></i>&numsp;Combo:</span>
                                        <div id="ticket_combos" class="flex-grow-1 text-end d-flex flex-column"></div>
                                    </div>
                                    <div class="d-flex text-light p-2">
                                    <span class="flex-shrink-0">
                                        <i class="fa-solid fa-seat-airline text-uppercase"></i>&numsp;Ghế:
                                    </span>
                                        <div id="ticket_seats" class="flex-grow-1 justify-content-end d-flex"></div>
                                    </div>
                                    <div class="d-flex text-light p-2">
                                        <span class="flex-shrink-0"><i class="fa-solid fa-equals"></i>&numsp;Tổng giá tiền:</span>
                                        <div class="flex-grow-1 text-end .ticketTotal"><span id="ticketSeat_totalPrice"></span> đ</div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    {{--Chọn Ghế/Combo/Thanh toán--}}
                    <div class="col-12 col-lg-9">
                        {{--Process bar--}}
                        <ul class="nav justify-content-around fw-bold">
                            <li class="nav-item">
                                <a class="nav-link active text-warning"
                                   href="#Seats"
                                   aria-controls="seat"
                                   aria-expanded="true"
                                   data-bs-toggle="collapse"
                                   data-bs-target="#Seats">1. Chọn ghế</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link disabled text-secondary" href="#Combos">2. Chọn combo</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link disabled text-secondary" href="#Payment">3. Thanh toán</a>
                            </li>
                        </ul>
                        <div class="progress" role="progressbar" aria-label="Example 1px high" aria-valuenow="10" aria-valuemin="0"
                             aria-valuemax="30" style="height: 2px">
                            <div class="progress-bar bg-warning" style="width: 34%"></div>
                        </div>
                        {{--Process bar : end--}}

                        <div id="mainTicket">
                            {{--Ghế ngồi--}}
                            <div id="Seats" class="collapse show" data-bs-parent="#mainTicket">
                                <h4 class="mt-5">Chọn ghế</h4>
                                <div class="container-fluid py-4">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="card mb-4">
                                                <div class="card-header pb-0">
                                                    <h6>{{$room->name}}</h6>
                                                </div>
                                                <div class="card-body px-0 pt-0 pb-2">
                                                    {{--Giá vé--}}
                                                    <div class="d-flex container my-3 justify-content-center">
                                                        <ul class="list-group list-group-horizontal">
                                                            <li class="list-group-item border-0">
                                                                <strong>Giá vé:</strong>
                                                            </li>
                                                            @foreach($seatTypes as $seatType)
                                                                <li class="list-group-item border-0">
                                                                    <div class="d-flex">
                                                                        <div class="d-inline-block me-2"
                                                                             style="width: 24px; height: 24px; background-color: {{ $seatType->color }}">
                                                                        </div>
                                                                        {{ number_format($seatType->surcharge+$price+$room->roomType->surcharge) }} đ
                                                                    </div>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                        <div class="vr"></div>
                                                        <ul class="list-group list-group-horizontal">
                                                            <li class="list-group-item border-0">
                                                                <div class="d-flex">
                                                                    <div class="d-inline-block me-2 text-center"
                                                                         style="width: 24px; height: 24px; background-color: #dc3545">
                                                                        <i class="fa-solid text-light fa-check"></i>
                                                                    </div>
                                                                    Đang chọn
                                                                </div>
                                                            </li>
                                                            <li class="list-group-item border-0">
                                                                <div class="d-flex">
                                                                    <div class="d-inline-block me-2"
                                                                         style="width: 24px; height: 24px; background-color: #c3c3c3">
                                                                    </div>
                                                                    Đã bán
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>

                                                    <div class="d-block overflow-x-auto text-center">
                                                        <div class="d-inline-block flex-nowrap mt-2 my-auto mb-4 text-center justify-content-center">
                                                            Màn hình
                                                            <div class="row bg-dark mx-auto" style="height: 2px; max-width: 540px"></div>
                                                            <div class="row d-block m-2" style="margin: 2px">
                                                                <div class="d-flex flex-nowrap align-middle my-0 mx-1 py-1 px-0 disabled"
                                                                     style="width: 30px; height: 30px; line-height: 22px; font-size: 10px">
                                                                </div>
                                                            </div>

                                                            @foreach($room->rows as $row)
                                                                <div class="row d-flex flex-nowrap" id="Row_{{ $row->row }}" style="margin: 2px">
                                                                    @foreach($room->seats as $seat)
                                                                        @if($seat->row == $row->row)
                                                                            @for($m = 0; $m < $seat->ms; $m++)
                                                                                <div class="seat d-inline-block align-middle disabled seat_empty"
                                                                                     style="width: 30px; height: 30px; margin: 2px 0;" choice="empty"></div>
                                                                            @endfor
                                                                            @if($seat->status == 1)
                                                                                <div class="seat d-inline-block mx-1 align-middle py-1 px-0 seat_enable"
                                                                                     id="Seat_{{ $seat->row.$seat->col}}"
                                                                                     choice="0"
                                                                                     style="background-color: {{ $seat->seatType->color }}; cursor: pointer; width: 30px; height: 30px; line-height: 22px; font-size: 10px; margin: 2px 0;"
                                                                                     onclick="seatChoice('{{$seat->row}}', {{$seat->col}},{{$seat->seatType->surcharge + $room->roomType->surcharge + $price}})">
                                                                                    {{$seat->row.$seat->col }}
                                                                                </div>
                                                                            @else
                                                                                <div class="seat d-inline-block align-middle py-1 px-0 text-dark disabled"
                                                                                     style="background-color: #cccccc; width: 30px; height: 30px;
                                                                             line-height: 22px; font-size: 10px; margin: 2px 0;" choice="1">
                                                                                    X
                                                                                </div>
                                                                            @endif
                                                                            @for($n = 0; $n < $seat->me; $n++)
                                                                                <div class="seat d-inline-block align-middle disabled seat_empty"
                                                                                     style="width: 30px; height: 30px; margin: 2px 0;" choice="empty"></div>
                                                                            @endfor
                                                                        @endif
                                                                    @endforeach
                                                                    @for($m = 0; $m < $row->mb; $m++)
                                                                        <div class="row d-flex flex-nowrap" style="margin: 2px">
                                                                            <div class="d-inline-block align-middle disabled seat_empty"
                                                                                 style="width: 30px; height: 30px; margin: 2px 0;"></div>
                                                                        </div>
                                                                    @endfor
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-footer">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-start w-50 ms-2 mt-4 float-end">
                                    <button class="btn btn-warning text-decoration-underline text-center btn_next">
                                       Tiếp tục <i class="fa-solid fa-angle-right"></i>
                                    </button>
                                    <button
                                        id="seatChoiceNext"
                                        aria-expanded="false"
                                        data-bs-toggle="collapse"
                                        data-bs-target="#Combos"
                                        class="d-none"></button>
                                </div>
                            </div>

                            {{--Combo--}}
                            <div id="Combos" class="mt-5 collapse" data-bs-parent="#mainTicket">
                                <h4>Combo</h4>
                                <div class="row g-2 mt-2 row-cols-2" data-bs-parent="#mainContent">
                                    @foreach($combos as $combo)
                                        <!-- Combo -->
                                        <div class="col">
                                            <div class="card px-0 overflow-hidden" id="Combo_{{$combo->id}}"
                                                 style="background: #f5f5f5">
                                                <div class="row g-0">
                                                    <div class="col-lg-4 col-12">
                                                        <img class="img-fluid w-100" alt="..." style="max-height: 361px; max-width: 241px" src="/images/combo/{{ $combo->image }}">
                                                    </div>
                                                    <div class="col-lg-8 col-12">
                                                        <div class="card-body">
                                                            <h5 class="card-title text-dark">{{ $combo->name }}</h5>
                                                            <p class="card-text text-dark">
                                                                @foreach($combo->foods as $food)
                                                                    @if($loop->first)
                                                                        {{ $food->pivot->quantity . ' ' . $food->name }}
                                                                    @else
                                                                        + {{ $food->pivot->quantity . ' ' . $food->name }}
                                                                    @endif
                                                                @endforeach
                                                            </p>
                                                            <p class="card-text">Giá: <span class="fw-bold">{{ number_format($combo->price) }} đ</span></p>
                                                        </div>
                                                        <div class="card-body input_combo_block">
                                                            <div class="input-group">
                                                                <input type="number" class="form-control input_combo" name="combo[{{$combo->id}}]" value="0" min="0" max="4" style="max-width: 80px" aria-label=""
                                                                data-combo-id="{{$combo->id}}" data-combo-price="{{$combo->price}}" data-combo-name="{{$combo->name}}"
                                                                >
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Combo: end -->
                                    @endforeach
                                </div>
                            
                                <div class="d-flex justify-content-center mt-4">
                                    <button id="comboBack" class="btn btn-warning mx-2 text-decoration-underline text-center btn_back"
                                            onclick="comboBack()"
                                            aria-expanded="false"
                                            data-bs-toggle="collapse"
                                            data-bs-target="#Seats"
                                    ><i class="fa-solid fa-angle-left"></i> Quay lại
                                    </button>
                            
                                    <button class="btn btn-warning mx-2  text-decoration-underline text-center btn_next"
                                            onclick="comboNext()"
                                            aria-controls="Payment"
                                            aria-expanded="false"
                                            data-bs-toggle="collapse"
                                            data-bs-target="#Payment"
                                    >Thanh toán <i class="fa-solid fa-angle-right"></i></button>
                                </div>
                            </div>

                            {{--Thanh toán--}}
                            <div id="Payment" class="mt-5 collapse" data-bs-parent="#mainTicket">
                                <h4 class="mt-4">Thanh toán</h4>
                                    <div class="bg-dark-subtle p-5">
                                        <div class="row row-cols-1" data-bs-parent="#mainContent">
                                            <div class="col">
                                                <div class="row">
                                                    <div class="form-group col-10">
                                                        <label for="userId" class="form-control-label">Mã khách hàng</label>
                                                        <input id="userId" class="form-control" name="userCode" type="number" value="">
                                                    </div>
                                                    <div class="col-2 d-flex justify-content-center">
                                                        <button type="button" onclick="UserID()"
                                                                    class="btn btn-info">
                                                                Xác Nhận<i class="fa-solid fa-angle-right"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="user" id="user"></div>
                                                <div class="phone" id="phone"></div>
                                            </div>
                                            <div class="col">
                                                <div class="bg-light p-4" id="bankCode">
                                                    <div class="form-check mb-3">
                                                        <input id="bankCode1" class="btn-check" type="radio" name="bankCode" value="QR"
                                                               aria-label="">
                                                        <label for="bankCode1"
                                                               class="custom-control-label btn btn-outline-primary fw-semibold fs-4 w-100 text-start
                                                               text-dark">
                                                            Thanh toán bằng ứng dụng hỗ trợ Momo
                                                            
                                                        </label>
                                                    </div>

                                                    <div class="form-check mb-3">
                                                        <input id="bankCode4" class="btn-check" type="radio" name="bankCode" value="MONEY"
                                                               aria-label="" checked>
                                                        <label for="bankCode4"
                                                               class="custom-control-label btn btn-outline-primary fw-semibold fs-4 w-100
                                                               text-start text-dark">
                                                            Thanh toán tiền mặt
                                                        </label>
                                                    </div>
                                                </div>
                                            
                                            </div>

                                        </div>
                                    </div>


                                    <div class="d-flex justify-content-center mt-4">
                                        <button type="button" class="btn btn-warning mx-2 text-decoration-underline text-center"
                                                onclick="paymentBack()"
                                                aria-expanded="true"
                                                data-bs-toggle="collapse"
                                                data-bs-target="#Combos">
                                            <i class="fa-solid fa-angle-left"></i> Trước
                                        </button>
                                        <button type="button" onclick="paymentNext()"
                                                class="btn btn-warning mx-2 text-decoration-underline text-uppercase text-center">
                                            Đặt vé <i class="fa-solid fa-angle-right"></i>
                                        </button>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <form action="/admin/ticketCreate" method="post" id="booking">
        @csrf
        <input type="hidden" name="schedule_id" id="schedule_id" value="{{$schedule->id}}">
        <input type="hidden" name="user_id" id="user_id" value="">
        <input type="hidden" name="ticketSeats[]" id="ticketSeats">
        <input type="hidden" name="ticketCombos[]" id="ticketCombo">
        <input type="hidden" name="totalPrice" id="totalPrice">
        <input type="hidden" name="ticketPayment" id="ticketPayment">
    </form>

@endsection
@section('js')
<script>
    $(document).ready(function() {
        $i = 0;
        let $arrSeatHtml = [];
        let $ticket_seats = {};
        let $ticket_combos = {};
        let $ticket_id = -1;
        let $sum = 0;
        // Ghế
        seatChoice = (row, col, price) => {
            var $seatCurrent = $('#Seats').find('#Seat_' + row + col);
            var choice = parseInt($seatCurrent.attr('choice'));
            if (choice === 1) {
                $i--;
                $seatCurrent.replaceWith($arrSeatHtml[row + col]);
                $(`#ticketSeat_${row + col}`).remove();
                $sum -= price;
                $('#ticketSeat_totalPrice').text($sum.toLocaleString('vi-VN'));
                delete $ticket_seats[row + col];
            } else {
                $i++;
                // Gới hạn chọn ghế
                if ($i > 8) {
                    $i--;
                    alert('chọn tối đa 8 ghế');
                    return;
                }

                $arrSeatHtml[row + col] = $seatCurrent.clone();
                $seatCurrent.replaceWith(`<div class="seat d-inline-block mx-1 align-middle py-1 px-0 seat_enable"
                    id="Seat_${row + col}" choice="1" onclick="seatChoice('${row}', ${col}, ${price})"
                    style="background-color: #dc3545; cursor: pointer; width: 30px; height: 30px; line-height: 22px; font-size: 10px;
                    margin: 2px 0;"><i class="fa-solid text-light fa-check"></i>
                    </div>`)

                $('#ticket_seats').append(`<p id="ticketSeat_${row + col}" class="mx-1 text-white">${row + col}</p>`);
                $ticket_seats[row + col] = [row, col, price];
                $sum += price;
                $('#ticketSeat_totalPrice').text($sum.toLocaleString('vi-VN'));

            }
        }


        $('#Seats').on('click', '.btn_next', (e) => {
            $('#seatChoiceNext').click();
            if ($i !== 0) {
                var ticketSeatsJSON = JSON.stringify($ticket_seats);
                $("#ticketSeats").val(ticketSeatsJSON);
            } else {
                window.location.reload();
                alert('Bạn chưa chọn ghế!!!');
            }
        })

        comboBack = () => {
            $("#ticketSeats").val('');
        }

        comboNext = () => {
            $check = jQuery.isEmptyObject($ticket_combos);
            if (!$check) {
                $("#ticketCombo").val(JSON.stringify($ticket_combos));
                $("#totalPrice").val($sum);
            }
        }

        $(".input_combo_block").keydown(function(event) {
            return false;
        });


        $('.input_combo').on('input', function() {
            let comboId = $(this).data('combo-id');
            let comboPrice = $(this).data('combo-price');
            let comboName = $(this).data('combo-name');
            let quantity = $(this).val();
            
            let totalComboPrice = comboPrice * quantity;
            if('#ticketCombo_'+ comboId) $('#ticketCombo_' + comboId).remove();
            $('#ticket_combos').append(`<p id="ticketCombo_${comboId}" class="text-white">${comboName} x ${quantity}</p>`);
            $sum += totalComboPrice;
            $('#ticketSeat_totalPrice').text($sum.toLocaleString('vi-VN'));
            $ticket_combos[comboId] = {
                name: comboName,
                price: comboPrice,
                quantity: quantity
            };
        });

        UserID = () => {
            var userCode = $("input[name='userCode']").val();

            $.ajax({
                url: "admin/buyTicket/checkUser",
                method: "POST",
                data: {
                    userCode: userCode,
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    if (response.success) {
                        var user = response.user;
                        var userFullName = "Họ tên: " + user.fullname;
                        var userPhone = "Điện thoại: " + user.phone; 
                        $("#user").text(userFullName);
                        $("#phone").text(userPhone);
                        $("#user_id").val(user.id);
                    } else {
                        alert('Sai mã khách hàng');
                    }
                },
                error: function() {
                    alert('Đã xảy ra lỗi, vui lòng thử lại sau');
                }
            });
        };


        $("input[name='bankCode']").change(function() {
            var payment = $("input[name='bankCode']:checked").val();
            $("#ticketPayment").val(payment);
        });

        // Thanh toán
        paymentNext = () => {
            $("#booking").submit();

        }

        paymentBack = () => {
            $("#ticketCombo").val();
        }


    });


    @foreach($room->seats as $seat)
        @if($seat->status == 1)
            @foreach($tickets as $ticket)
                @foreach($ticket->ticketSeats as $ticketSeat)
                    @if($seat->row == $ticketSeat->row && $seat->col == $ticketSeat->col)
                        $('#Seats').find('#Seat_{{$seat->row.$seat->col}}').replaceWith(`<div class="d-inline-block mx-1 align-middle py-1 px-0  text-dark disabled" choice="1" style="background-color: #c3c3c3; width: 30px; height: 30px; line-height: 22px; font-size: 10px; margin: 2px 0;">
                            {{ $seat->row.$seat->col }}</div>`)
                    @endif
                @endforeach
            @endforeach
        @endif
    @endforeach
</script>
@endsection
