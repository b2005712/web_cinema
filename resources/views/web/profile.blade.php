@extends('web.layouts.app')
@section('content')
@php
$generatorPNG = new Picqer\Barcode\BarcodeGeneratorPNG();
@endphp
<section class="container clearfix">
    <div class="container">
        <h1 class="mb-5"></h1>
        <div class="bg-white shadow rounded-lg d-block d-sm-flex">
            <div class="profile-tab-nav border-right">
                <div class="p-5">
                    <h4 class="text-center">{!! $user['fullname'] !!}</h4>
                </div>
                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <a class="nav-link" id="account-tab" href="#account" data-bs-toggle="collapse" data-bs-target="#account" aria-expanded="false" aria-controls="account" role="button">
                        <i class="fa fa-home text-center mr-1"></i>
                        Tài khoản
                    </a>
                    <a class="nav-link" id="password-tab" href="#password" data-bs-toggle="collapse" data-bs-target="#password" aria-expanded="false" aria-controls="password">
                        <i class="fa fa-key text-center mr-1"></i>
                        Đổi mật khẩu
                    </a>
                    <a class="nav-link" id="notification-tab" href="#notification" data-bs-toggle="collapse" data-bs-target="#notification" aria-expanded="false">
                        <i class="fa-solid fa-clock-rotate-left"></i>
                        Vé của tôi
                    </a>
                </div>
            </div>
            <div class="tab-content  w-100 p-4 p-md-5">
                <div id="mainContent">
                    <form action="/editProfile" method="POST">
                        @csrf
                        <div class="collapse show" id="account" data-bs-parent="#mainContent">
                            <div aria-labelledby="account-tab">
                                <h4 class="text-center">Mã thành viên</h4>
                                <div class="text-center mt-3">
                                    <img src="data:image/png;base64,{!! base64_encode($generatorPNG->getBarcode($user['code'],$generatorPNG::TYPE_CODE_128)) !!}" />
                                </div>
                                <div class="text-center mt-3">
                                    {!! $user['code'] !!}
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Tên</label>
                                            <input type="text" class="form-control" name="fullname" required value="{!! $user['fullname'] !!}" aria-label="">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="email" class="form-control" name="email" value="{!! $user['email'] !!}" aria-label="">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Số điện thoại</label>
                                            <input type="text" class="form-control" name="phone" value="{!! $user['phone'] !!}" aria-label="">
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <button class="btn btn-primary" type="submit">Cập nhật</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                    <form action="/changePassword" method="POST">
                        @csrf
                        <div class="collapse" id="password" data-bs-parent="#mainContent">
                            <div aria-labelledby="password-tab">
                                <h3 class="mb-4"></h3>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Mật khẩu cũ</label>
                                            <input type="password" name="oldpassword" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Mật khẩu mới</label>
                                            <input type="password" name="password" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Nhập lại mật khẩu mới</label>
                                            <input type="password" name="repassword" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <button class="btn btn-primary" type="submit">Cập nhật</button>
                                </div>
                            </div>
                        </div>
                    </form>

                    <div class="collapse" id="notification" data-bs-parent="#mainContent">
                        <div aria-labelledby="notification-tab">
                            <h3 class="mb-4 text-center">Vé của tôi</h3>
                            <div class="container ">
                                @foreach($sort_ticket as $value)
                                @if(isset($value['schedule']['movie']['image']))
                                <div class="row">
                                    <p style="margin-top: 10px!important;">Code: {!! $value['code'] !!} </p>
                                    <div class="col-2">
                                        <img style="width: auto;height: 218px;" src="/images/movies/{!! $value['schedule']['movie']['image'] !!}">
                                    </div>
                                    <div class="col">
                                        <p>{!! $value['schedule']['movie']['name'] !!}</p>
                                        <p class="badge
                                                @if($value['schedule']['movie']['rating']['name'] == 'C18') bg-danger
                                                @elseif($value['schedule']['movie']['rating']['name'] == 'C16') bg-warning
                                                @elseif($value['schedule']['movie']['rating']['name'] == 'P') bg-success
                                                @elseif($value['schedule']['movie']['rating']['name'] == 'K') bg-primary
                                                @else bg-info
                                                @endif me-1"> {!! $value['schedule']['movie']['rating']['name'] !!} </p>
                                        <p>{!! date("d/m/Y",strtotime($value['schedule']['date'] )) !!}</p>
                                        <p>Phòng {!! date("H:i A",strtotime($value['schedule']['startTime'] )) !!} ~ Đến {!! date("H:i A",strtotime($value['schedule']['endTime'] )) !!}</p>
                                        <p>{!! $value['schedule']['room']['theater']['name'] !!}: 
                                            {!! $value['schedule']['room']['name'] !!}
                                            (
                                            @foreach($value['ticketSeats'] as $seat)
                                                @if ($loop->first)
                                                    {{ $seat->row.$seat->col }}
                                                @else
                                                    ,{{ $seat->row.$seat->col }}
                                                @endif
                                            @endforeach
                                            )
                                        </p>
                                        <p>Giá tiền: {!! number_format($value['totalPrice'],0,",",".") !!}</p>
                                        <a href="/ticketPaid/{{$value->id}}" class="btn btn-warning">Chi tiết</a>
                                    </div>
                                </div>

                                @endif
                                @endforeach
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
    $(document).ready(function() {
        $(".nav .nav-link").on("click", function(e) {
            $(".nav").find(".active").removeClass("active");
            $(e.target).addClass("active");
        });
    });
</script>
{{-- <script type="text/javascript">
    $(document).ready(function() {
        $("#download").click(function() {
            screenshot();
        });
    });

    function screenshot() {
        html2canvas(document.getElementById("photo")).then(function(canvas) {
            downloadImage(canvas.toDataURL(), "BillInfo.png");
        });
    }

    function downloadImage(uri, filename) {
        var link = document.createElement('a');
        if (typeof link.download !== 'string') {
            window.open(uri);
        } else {
            link.href = uri;
            link.download = filename;
            accountForFirefox(clickLink, link);
        }
    }

    function clickLink(link) {
        link.click();
    }

    function accountForFirefox(click) {
        var link = arguments[1];
        document.body.appendChild(link);
        click(link);
        document.body.removeChild(link);
    }
</script>
<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('.refund-ticket').on('click', function() {
            var ticket_id = $(this).data("id");
            if (confirm("Bạn có chắc chắn muốn hoàn vé ?") === true) {
                $.ajax({
                    url: '/refund-ticket',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        'ticket_id': ticket_id,
                    },
                    success: function(data) {
                        if (data['success']) {
                            alert(data.success);
                            window.location.reload();
                        } else if (data['error']) {
                            alert(data.error);
                        }
                    }
                });
            }
        });
    });
</script> --}}
@endsection