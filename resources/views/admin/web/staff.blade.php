@extends('admin.layouts.index')
@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Tài khoản nhân viên</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <button style="float:right;padding-right:30px;" class="me-5  btn bg-gradient-primary float-right mb-3" data-bs-toggle="modal" data-bs-target="#staff">
                                Tạo
                            </button>
                            <table class="table align-items-center mb-0 ">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7">
                                            Tên
                                        </th>
                                        <th class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7">
                                            Email
                                        </th>
                                        <th class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7">
                                            Số điện thoại
                                        </th>
                                        <th class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7">
                                            Vai trò
                                        </th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Rạp</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($staff as $value)
                                    {{-- @foreach($value['roles'] as $role)--}}
                                    {{-- @if($value->getRoleNames()->first() == 'admin' || $value->getRoleNames()->first() == 'staff') --}}
                                    <tr>
                                        <td class="align-middle text-center">
                                            <h6 class="mb-0 text-sm ">{!! $value['fullname'] !!}</h6>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span class="text-secondary font-weight-bold">{!! $value['email'] !!}</span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span class="text-secondary font-weight-bold">{!! $value['phone'] !!}</span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span class="text-secondary font-weight-bold"> 
                                            @if ($value->role == "staff")
                                                Nhân viên
                                            @endif</span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span class="text-secondary font-weight-bold">{{ $value->StaffTheater->name }}</span>
                                        </td>
                                        <td class="align-middle">
                                            <a href="javascript:void(0)" data-url="{{ url('admin/staff/delete', $value['id'] ) }}" class="text-secondary font-weight-bold text-xs delete-staff" data-toggle="tooltip" data-original-title="Edit user">
                                                <i class="fa-solid fa-trash-can fa-lg"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    {{-- @include('admin.staff_account.permisson') --}}
                                    
                                    {{-- @endforeach--}}
                                    @endforeach
                                    <form action="admin/staff/create" method="POST">
                                        @csrf
                                        <div class="modal fade" id="staff" tabindex="-1" aria-labelledby="staff_title" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="staff_title">Nhân viên</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="card-body">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label>Tên</label>
                                                                        <input aria-label="" id="fn" class="form-control" type="text" value="" name="fullname"
                                                                               placeholder="Nhập tên">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label>Email</label>
                                                                        <input aria-label="" id="e" class="form-control" type="email" value="" name="email"
                                                                               placeholder="Nhập email">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label>Số điện thoại</label>
                                                                        <input aria-label="" id="p" class="form-control" type="text" value="" name="phone"
                                                                               placeholder="Số điện thoại">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label>Mật khẩu</label>
                                                                        <input aria-label="" id="rp" class="form-control" type="password" value="" name="password"
                                                                               placeholder="Mật khẩu">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label>Rạp</label>
                                                                        <select id="t" aria-label="" class="form-control" name="theater_id">
                                                                            @foreach($theaters as $theater)
                                                                                <option value="{{$theater->id}}">{{$theater->name}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Hủy</button>
                                                        <button type="submit" class="btn bg-gradient-info">Lưu</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>                                    
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-center mt-3">
                            {!! $staff->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
<script>
    function selects() {
        var ele = document.getElementsByName('permission[]');
        for (var i = 0; i < ele.length; i++) {
            if (ele[i].type === 'checkbox')
                ele[i].checked = true;
        }
    }

    function unselects() {
        var ele = document.getElementsByName('permission[]');
        for (var i = 0; i < ele.length; i++) {
            if (ele[i].type === 'checkbox')
                ele[i].checked = false;
        }
    }
</script>
<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('.delete-staff').on('click', function() {
            var userURL = $(this).data('url');
            var trObj = $(this);
            if (confirm("Are you sure you want to remove it?") === true) {
                $.ajax({
                    url: userURL,
                    type: 'DELETE',
                    dataType: 'json',
                    success: function(data) {
                        if (data['success']) {
                            // alert(data.success);
                            trObj.parents("tr").remove();
                        } else if (data['error']) {
                            alert(data.error);
                        }
                    }
                });
            }

        });
    });
</script>
<script>
    function changestatus(user_id, active) {
        if (active === 1) {
            $("#status" + user_id).html(' <a href="javascript:void(0)"  class="btn_active" onclick="changestatus(' + user_id + ',0)">\
            <span class="badge badge-sm bg-gradient-success">Online</span>\
    </a>')
        } else {
            $("#status" + user_id).html(' <a  href="javascript:void(0)" class="btn_active"  onclick="changestatus(' + user_id + ',1)">\
            <span class="badge badge-sm bg-gradient-secondary">Offline</span>\
    </a>')
        }
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "/admin/user/status",
            type: 'GET',
            dataType: 'json',
            data: {
                'active': active,
                'user_id': user_id
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
@endsection