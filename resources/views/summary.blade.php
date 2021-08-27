@inject('basket','App\Support\Basket\Basket')
<div class="card">
    <div class="card-header">
        Payment
    </div>
    <div class="card-body">
        <div class="row d-inline-flex-flex-row mt-4">
            <h6 class="col-5 text-center">Total</h6>
            <span class="col-5 font-weight-bold text-center p-0 m-0">{{ number_format($basket->subTotal()) }} $</span>
        </div>
        <hr>
        <div class="row d-inline-flex-flex-row">
            <h6 class="col-5 text-center">Transport Cost</h6>
            <span class="col-5 font-weight-bold text-center p-0 m-0">10 $</span>
        </div>
        <hr>
        <div class="row d-inline-flex-flex-row mb-4">
            <h6 class="col-5 text-center">To Pay</h6>
            <span
                class="col-5 font-weight-bold text-center p-0 m-0">{{ number_format($basket->subTotal() + 10) }} $</span>
        </div>
    </div>
</div>
