@extends('web.layouts.app')
@php use Illuminate\Support\Facades\Cookie; @endphp
@section('content')
<section class="container">
    <div class="mt-5 login-banner" id="register">
        <div class="row">
            <div class="col col-sm-6"></div>
            <div class="col col-sm-6">
                <ul class="nav mb-4 justify-content-center">
                    <li class="nav-item">
                        <a href="\login">
                            <button class="h5 nav-link link-secondary"
                                aria-expanded="true"
                                data-bs-toggle="collapse"
                                data-bs-target="#login" disabled>
                                Đăng nhập
                            </button>
                        </a>
                    </li>
                    <li class="vr mx-5"></li>
                    <li class="nav-item">
                        <a class="h5 nav-link fw-bold border-bottom border-2 active" href="/register">
                            Đăng ký
                        </a>
                    </li>
                </ul>
                <div id="register" class="collapse show" data-bs-parent="#register">
                    <form method='post' action="/signUp">
                        @if(session('fail'))
                            <div class="alert alert-danger">
                                {{ session('fail') }}
                            </div>
                        @endif
                        @csrf
                        <div class="mb-3">
                            <label for="fullname" class="form-label fw-bold">Tên</label>
                            <input type="text" class="form-control" id="fullname" name="fullname">
                            @if ($errors->has('fullname'))
                                <p>{{ $errors->first('fullname') }}</p>
                            @endif
                          </div>
                        <div class="mb-3">
                          <label for="email" class="form-label fw-bold">Email</label>
                          <input type="email" class="form-control" id="email" name="email">
                          @if ($errors->has('email'))
                            <p>{{ $errors->first('email') }}</p>
                          @endif
                        </div>
                        <div class="mb-3">
                            <label for="phone_number" class="form-label fw-bold">Số điện thoại</label>
                            <input type="nunber" class="form-control" id="phone_number" name="phone">
                            @if ($errors->has('phone'))
                                <p>{{ $errors->first('phone') }}</p>
                            @endif
                        </div>
                        <div class="row">
                            <div class="mb-3 col-sm-6">
                                <label for="birth" class="form-label fw-bold">Ngày sinh</label>
                                <input type="date" class="form-control" id="birth" name="birth">
                                @if ($errors->has('birth'))
                                    <p>{{ $errors->first('birth') }}</p>
                                @endif
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label fw-bold">Giới tính</label><br>
                                <input type="radio" class="form-check-input" id="men" name="gender" value="Nam">
                                <label for="men" class="form-label fw-bold">Nam</label>
                                <input type="radio" class="form-check-input" id="women" name="gender" value="Nữ">
                                <label for="woman" class="form-label fw-bold">Nữ</label>
                                @if ($errors->has('gender'))
                                    <p>{{ $errors->first('gender') }}</p>
                                @endif
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label fw-bold">Mật khẩu</label>
                            <input type="password" class="form-control" id="password" name="password">
                            @if ($errors->has('password'))
                                <p>{{ $errors->first('password') }}</p>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="rpassword" class="form-label fw-bold">Nhập lại mật khẩu</label>
                            <input type="password" class="form-control" id="repassword" name="repassword">
                            @if ($errors->has('repassword'))
                                <p>{{ $errors->first('repassword') }}</p>
                            @endif
                        </div>
                        
                        
                        <div class="row">
                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="agreement" name="agreement">
                                <label class="form-check-label" for="agreement"> Đồng ý với điều khoản.</label>
                                @if ($errors->has('agreement'))
                                    <p>{{ $errors->first('agreement') }}</p>
                                @endif
                            </div>
                             <div class="d-flex justify-content-end">
                                <button type="submit" class="btn fw-bold">Đăng ký</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</section>
@endsection