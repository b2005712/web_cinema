@extends('admin.layouts.index')
@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Thực phẩm</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <a style="float:right;padding-right:30px;" class="text-light">
                            <button class=" btn btn-primary float-right mb-3" data-bs-toggle="modal" data-bs-target="#food">Tạo
                            </button>
                        </a>
                        <table class="table align-items-center mb-0 ">
                            <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7">Tên</th>
                                <th class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7">Hình ảnh</th>
                                <th class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7">Giá</th>
                                <th class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7">Trạng thái</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"></th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($food as $value)
                                <tr>
                                    <td class="align-middle text-center">
                                        <h6 class="mb-0 text-sm ">{!! $value['name'] !!}</h6>
                                    </td>
                                    <td class="align-middle text-center">
                                        <img style="height: 200px"
                                            src="/images/foods/{!! $value['image'] !!}"
                                            alt="user1">
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-secondary font-weight-bold">{!! number_format($value['price']) !!}</span>
                                    </td>
                                    <td id="status{!! $value['id'] !!}" class="align-middle text-center text-sm ">
                                        @if($value['status'] == 1)
                                            <a href="javascript:void(0)" class="btn_active"  onclick="changestatus({!! $value['id'] !!},0)">
                                                <span class="badge badge-sm bg-gradient-success">Online</span>
                                            </a>
                                        @else
                                            <a href="javascript:void(0)" class="btn_active"  onclick="changestatus({!! $value['id'] !!},1)">
                                                <span class="badge badge-sm bg-gradient-secondary">Offline</span>
                                            </a>
                                        @endif
                                    </td>
                                    <td class="align-middle">
                                        <a href="#editFood" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip"
                                           data-original-title="Edit director" data-bs-target="#editFood{!! $value['id'] !!}"
                                           data-bs-toggle="modal">
                                            <i class="fa-solid fa-pen-to-square fa-lg"></i>
                                        </a>
                                    </td>
                                    <td class="align-middle">
                                        <a href="javascript:void(0)" data-url="{{ url('admin/food/delete', $value['id'] ) }}"
                                           class="text-secondary font-weight-bold text-xs delete-food" data-toggle="tooltip">
                                            <i class="fa-solid fa-trash-can fa-lg"></i>
                                        </a>
                                    </td>
                                </tr>
                                <form action="admin/food/edit/{!! $value['id'] !!}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="modal fade" id="editFood{!! $value['id'] !!}" tabindex="-1" aria-labelledby="food_title" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="food_title">{!! $value['name'] !!}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                
                                                <div class="modal-body">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="example-text-input" class="form-control-label">Tên</label>
                                                                    <input class="form-control" type="text" value="{!! $value['name'] !!}" name="name">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="example-text-input" class="form-control-label">Giá</label>
                                                                    <input class="form-control" type="number" value="{!! $value['price']!!}" name="price">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group file-uploader">
                                                                    <label for="example-text-input" class="form-control-label">Hình ảnh</label>
                                                                    <input type='file' name='Image' class="form-control image-food">
                                                                    <img style="height: 200px" src="/images/foods/{!! $value['image'] !!}"
                                                                         class="img_food" alt="user1">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                                                    <button type="submit" class="btn btn-primary">Lưu</button>
                                                </div>
                                
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            @endforeach
                            <form action="admin/food/create" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="modal fade" id="food" tabindex="-1" aria-labelledby="food_title" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="food_title">Thực phẩm</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                            
                                            <div class="modal-body">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="example-text-input" class="form-control-label">Tên</label>
                                                                <input class="form-control" type="text" value="" name="name"
                                                                       placeholder="Nhập tên">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="example-text-input" class="form-control-label">Giá</label>
                                                                <input class="form-control" type="number" value="" name="price"
                                                                       placeholder="Nhập giá">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group file-uploader">
                                                                <label for="example-text-input" class="form-control-label">Hình ảnh</label>
                                                                <input type='file' name='Image' class="form-control image-food">
                                                                <img style="height: 200px" src="" class="img_food d-none" alt="user1">
                                                            </div>
                                                        </div>
                            
                                                    </div>
                                                </div>
                                            </div>
                            
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
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
                        {!! $food->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('.delete-food').on('click', function () {
                var userURL = $(this).data('url');
                var trObj = $(this);
                if (confirm("Bạn có muốn xóa không?") === true) {
                    $.ajax({
                        url: userURL,
                        type: 'DELETE',
                        dataType: 'json',
                        success: function (data) {
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
                reader.onload = function (e) {
                    $('.file-uploader .img_food').attr('src', e.target.result).removeClass('d-none');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        $(".image-food").change(function () {
            readURL(this);
        });
    </script>
    <script>
        function changestatus(food_id,active){
            if(active === 1){
                $("#status" + food_id).html(' <a href="javascript:void(0)"  class="btn_active" onclick="changestatus('+ food_id +',0)">\
                    <span class="badge badge-sm bg-gradient-success">Online</span>\
            </a>')
            }else{
                $("#status" + food_id).html(' <a  href="javascript:void(0)" class="btn_active"  onclick="changestatus('+ food_id +',1)">\
                    <span class="badge badge-sm bg-gradient-secondary">Offline</span>\
            </a>')
            }
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "/admin/food/status",
                type: 'GET',
                dataType: 'json',
                data: {
                    'active': active,
                    'food_id': food_id
                },
                success: function (data) {
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
