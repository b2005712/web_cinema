@extends('web.layouts.app')
@section('content')
<section class="container">
    <div class="mt-5 login-banner" id="login">
        <div class="row">
            <div class="col col-sm-6"></div>
            <div class="col col-sm-6">
                <ul class="nav mb-4 justify-content-center">
                    <li class="nav-item">
                        <button class="h5 nav-link active fw-bold border-bottom border-2"
                                aria-expanded="true"
                                data-bs-toggle="collapse"
                                data-bs-target="#login" disabled>
                            Đăng nhập
                        </button>
                    </li>
                    <li class="vr mx-5"></li>
                    <li class="nav-item">
                        <a class="h5 nav-link link-secondary" href="/register">
                            Đăng ký
                        </a>
                    </li>
                </ul>
                <div id="login" class="collapse show" data-bs-parent="#login">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if(session('warning'))
                            <div class="alert alert-danger">
                                {{ session('warning') }}
                            </div>
                        @endif
                    <form method='post' action="/signIn">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                        <input type="hidden" name="url" value="{{ url()->current() }}"/>
                        <div class="mb-3">
                          <label for="username" class="form-label fw-bold">Email hoặc SDT</label>
                          <input type="text" class="form-control" id="username" name="username"
                            @if(session()->has('username_web'))
                                    value="{!!session()->get('username_web') !!}"
                                        @endif
                                        name="username" aria-label="username"
                                        autocomplete="email"
                          >
                          @if ($errors->has('username'))
                            <p>{{ $errors->first('username') }}</p>
                          @endif
                        </div>
                        <div class="mb-3">
                          <label for="Password" class="form-label fw-bold">Mật khẩu</label>
                          <input type="password" class="form-control" id="Password" name="password"
                          @if(session()->has('password_web'))
                                   value="{!!session()->get('password_web') !!}"
                               @endif
                               name="password" aria-label="password">
                          @if ($errors->has('password'))
                            <p>{{ $errors->first('password') }}</p>
                          @endif
                        </div>
                        <div class="row">
                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="remeber_me" name="rememberme" 
                                @if(session()->has('username_web'))
                                   checked
                               @endif name="rememberme">
                                <label class="form-check-label" for="remeber_me"> Nhớ tôi</label>
                            </div>
                             <div class="d-flex justify-content-end">
                                <button type="submit" class="btn fw-bold">Đăng nhập</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</section>
@endsection