@extends('admin.layouts.index')
@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Vé</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0 ">
                            <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7">Tên phim</th>
                                <th class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7"></th>
                                <th class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7">Phòng</th>
                                <th class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7">Ghế</th>
                                <th class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7">Combo</th>
                                <th class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7">Thời gian</th>
                                <th class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7">Ngày</th>
                                <th class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7">Code</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Trạng thái</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($ticket as $value)
                            <tr>
                                <td class="align-middle text-center">
                                    @isset($value['schedule'])
                                    <h6 class="mb-0 text-sm " style="width:150px; overflow: hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 1; -webkit-box-orient: vertical">{!! $value['schedule']['movie']['name'] !!}</h6>
                                    @endisset
                                </td>
                                <td class="align-middle text-center">
                                    @isset($value['schedule'])
                                    <h6 class="mb-0 text-sm ">{!! $value['schedule']['room']['roomType']['name'] !!}</h6>
                                    @endisset
                                </td>
                                <td class="align-middle text-center">
                                    @isset($value['schedule'])
                                    <h6 class="mb-0 text-sm ">{!! $value['schedule']['room']['name'] !!}</h6>
                                    @endisset
                                </td>
                                <td class="align-middle text-center">
                                    @isset($value['ticketSeats'])
                                    <span class="text-secondary font-weight-bold" style="width:150px; overflow: hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 1; -webkit-box-orient: vertical">
                                        @foreach($value['ticketSeats'] as $seat)
                                            @if($loop->first)
                                        {!! $seat['row']."-".$seat['col'] !!}
                                            @else
                                                , {!! $seat['row']."-".$seat['col'] !!}
                                            @endif
                                        @endforeach
                                    </span>
                                    @endisset
                                </td>
                                <td>
                                    @if(isset($value->ticketCombos) || isset($value->ticketFoods))
                                        <span class="text-secondary font-weight-bold" >
                                            @foreach($value['ticketCombos'] as $combo)
                                                    • {{ $combo->comboName.' x '. $combo->quantity }} <br>
                                            @endforeach
                                        </span>

                                    @endif
                                </td>
                                <td class="align-middle text-center">
                                    @isset($value['schedule'])
                                    <span class="text-secondary font-weight-bold">{!! $value['schedule']['startTime'] !!}</span>
                                    @endisset
                                </td>
                                <td class="align-middle text-center">
                                    @isset($value['schedule'])
                                    <span class="text-secondary font-weight-bold">{!! date("d-m-Y", strtotime($value['schedule']['date'])) !!}</span>
                                    @endisset
                                </td>
                                <td class="align-middle text-center">
                                    <button href="#barcode" class="btn btn-link text-danger "
                                            data-bs-toggle="modal"
                                            data-bs-target="#barcode{!! $value['id'] !!}"><i style="color:grey" class="fa-sharp fa-regular fa-eye"></i>
                                    </button>
                                </td>
                                <td class="align-middle text-center text-sm">
                                    @if($value['schedule_id']!= NULL)
                                        @if( $value['status'] == 1)
                                            <span class="badge badge-sm bg-gradient-secondary">Đã xong</span>
                                        @else
                                            <span class="badge badge-sm bg-gradient-success">Chờ</span>
                                        @endif
                                    @else
                                        <span class=""><i class="fa-regular fa-ban"></i></span>
                                    @endif
                                </td>
                            </tr>
                            <div class="modal fade modal-md" id="barcode{!! $value['id'] !!}" tabindex="-1" aria-labelledby="barcode_title" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="barcode_title"></h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="card-body">
                                                <div class="row ">
                                                    <div class="col-md-12">
                                                            <div class="flex-column d-flex justify-content-center text-center">
                                                                <div>
                                                                    @php
                                                                        $generatorPNG = new Picqer\Barcode\BarcodeGeneratorPNG();
                                                                    @endphp
                                                                    <div class="text-center">
                                                                        <img src="data:image/png;base64,{!! base64_encode($generatorPNG->getBarcode($value->code,$generatorPNG::TYPE_CODE_128)) !!}" />
                                                                    </div>
                                                                </div>
                                                                <div class="mt-2">
                                                                    {!! $value['code'] !!}
                                                                </div>
                                                            </div>
                                                        </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="d-flex justify-content-center mt-3">
                    {!! $ticket->links() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
