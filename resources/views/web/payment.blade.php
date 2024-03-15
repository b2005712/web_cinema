{{--Thanh toán--}}
<div id="Payment" class="mt-5 collapse" data-bs-parent="#mainTicket">
    @csrf
        <h4 class="mt-4">Phương thức thanh toán</h4>

        <div class="bg-dark-subtle p-5">
            <div class="row row-cols-1">
                <div class="col container">
                    <div class="form-check pe-4" id="bankCode">
                        <input id="bankCode1" class="btn-check" type="radio" name="bankCode" value="QR" aria-label="">
                        <label for="bankCode1"
                               class="fw-semibold btn btn-light btn-outline-primary h3 p-3 my-2 w-100 text-start text-dark">
                            Thanh toán bằng ứng dụng hỗ trợ
                            <span class="Momo">
                                Ví Momo
                            </span>
                        </label>

                        <input id="bankCode2" class="btn-check" type="radio" name="bankCode" value="ATM" aria-label="">
                        <label for="bankCode2"
                               class="fw-semibold btn btn-light btn-outline-primary h3 p-3 my-2 w-100 text-start text-dark">
                            Thanh toán qua thẻ ATM/Tài khoản nội địa
                        </label>
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
                <i class="fa-solid fa-angle-left"></i> Quay lại
            </button>
            <button type="button" onclick="paymentNext()"
                    class="btn btn-warning mx-2 text-decoration-underline text-uppercase text-center">
                Đặt vé <i class="fa-solid fa-angle-right"></i>
            </button>
        </div>
</div>