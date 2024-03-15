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