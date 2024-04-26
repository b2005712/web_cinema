@extends('admin.layouts.index')
@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Quảng cáo</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <a style="float:right;padding-right:30px;" class="text-light">
                                <button class=" btn btn-primary float-right mb-3" data-bs-toggle="modal" data-bs-target="#banner">Thêm</button>
                            </a>
                            <table class="table align-items-center mb-0 ">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7">Hình ảnh</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Trạng thái</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"></th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($banners as $value)
                                    <tr>
                                        <td class="align-middle text-center">
                                            <img style="width: 300px" src="/images/banners/{!! $value['image'] !!}" alt="user1">
                                        </td>
                                        <td id="status{!! $value['id'] !!}" class="align-middle text-center text-sm ">
                                            @if($value['status'] == 1)
                                            <a href="javascript:void(0)" class="btn_active" onclick="changestatus({!! $value['id'] !!},0)">
                                                <span class="badge badge-sm bg-gradient-success">Online</span>
                                            </a>
                                            @else
                                            <a href="javascript:void(0)" class="btn_active" onclick="changestatus({!! $value['id'] !!},1)">
                                                <span class="badge badge-sm bg-gradient-secondary">Offline</span>
                                            </a>
                                            @endif
                                        </td>

                                        <td class="align-middle">
                                            <a href="#editBanner" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit banner" data-bs-target="#editBanner{!! $value['id'] !!}" data-bs-toggle="modal">
                                                <i class="fa-solid fa-pen-to-square fa-lg"></i>
                                            </a>
                                        </td>
                                        <td class="align-middle">
                                            <a href="javascript:void(0)" data-url="{{ url('admin/banners/delete', $value['id'] ) }}" class="text-secondary font-weight-bold text-xs delete-banner" data-toggle="tooltip">
                                                <i class="fa-solid fa-trash-can fa-lg"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <form action="admin/banners/edit/{!! $value['id'] !!}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal fade" id="editBanner{!! $value['id'] !!}" tabindex="-1" aria-labelledby="banner_title" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="banner_title">{!! $value['name'] !!}</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="card-body">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group file-uploader">
                                                                        <label for="example-text-input" class="form-control-label">Hình ảnh</label>
                                                                        <input type='file' name='Image' class="form-control image-director">
                                                                    
                                                                            <img style="width: 300px" class="img_direc"
                                                                                 src="/images/banners/{!! $value['image'] !!}" alt="user1">
                    
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                    
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                                        <button type="submit" class="btn btn-primary">Lưu</button>
                                                    </div>
                                    
                                                </div>
                                            </div>
                                        </div>
                                    </form>                                    
                                    @endforeach
                                    <form action="admin/banners/create" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal fade" id="banner" tabindex="-1" aria-labelledby="banner_title" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="banner_title">Quảng cáo</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                    
                                                    <div class="modal-body">
                                                        <div class="card-body">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group file-uploader">
                                                                        <label for="example-text-input" class="form-control-label">Hình ảnh</label>
                                                                        <input type='file' name='Image' class="form-control image-director">
                                                                        <img style="width: 300px" src="" class="img_direc d-none" alt="user1">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                    
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                                        <button type="submit" class="btn btn-primary">Lưu</button>
                                                    </div>
                                    
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-center mt-3">
                            {!! $banners->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('.delete-banner').on('click', function() {
            var userURL = $(this).data('url');
            var trObj = $(this);
            if (confirm("Are you sure you want to remove it?") == true) {
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
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('.file-uploader .img_direc').attr('src', e.target.result).removeClass('d-none');
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $(".image-director").change(function() {
        readURL(this);
    });
</script>
<script>
    function changestatus(banner_id, active) {
        if (active === 1) {
            $("#status" + banner_id).html(' <a href="javascript:void(0)"  class="btn_active" onclick="changestatus(' + banner_id + ',0)">\
                    <span class="badge badge-sm bg-gradient-success">Online</span>\
            </a>')
        } else {
            $("#status" + banner_id).html(' <a  href="javascript:void(0)" class="btn_active"  onclick="changestatus(' + banner_id + ',1)">\
                    <span class="badge badge-sm bg-gradient-secondary">Offline</span>\
            </a>')
        }
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "/admin/banners/status",
            type: 'GET',
            dataType: 'json',
            data: {
                'active': active,
                'banner_id': banner_id
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