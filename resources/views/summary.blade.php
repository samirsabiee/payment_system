@inject('cost','App\Support\Cost\Contracts\CostInterface')
<div class="card">
    <div class="card-header">
        Payment
    </div>
    <div class="card-body">
        @foreach($cost->getSummary() as $description => $price)
            <div class="row d-inline-flex-flex-row mt-4">
                <h6 class="col-5 text-center">{{ $description }}</h6>
                <span class="col-5 font-weight-bold text-center p-0 m-0">{{ number_format($price) }} $</span>
            </div>
            <hr>
        @endforeach
        <div class="row d-inline-flex-flex-row mb-4">
            <h6 class="col-5 text-center">To Pay</h6>
            <span
                class="col-5 font-weight-bold text-center p-0 m-0">{{ number_format($cost->getTotalCost()) }} $</span>
        </div>
        @auth
            @if(session()->has('coupon'))
                <form method="get" action="{{ route('coupons.remove') }}">
                    @csrf
                    <hr>
                    <div class="row input-group d-flex flex-row mt-2 justify-content-center align-items-center p-0">
                        <h6 class="col=5 mx-2">Coupon</h6>
                        <span class="mx-5">{{ session()->get('coupon')->code }}</span>
                        <button type="submit" class="mx-2 btn btn-primary btn-sm">Remove</button>
                    </div>
                </form>
            @else
                <form method="post" action="{{ route('coupons.store') }}">
                    @csrf
                    <hr>
                    <div class="row d-flex flex-row mt-2 justify-content-center align-items-center p-0">
                        <h6 class="col=5">Coupon</h6>
                        <div class="col-5 form-group p-0 m-0 mx-3">
                            <input id="coupon" name="coupon" type="text" class="form-control" aria-label="Coupon"/>
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm">Apply</button>
                    </div>
                </form>
            @endif
        @endauth
    </div>
</div>
@include('partials.validation-errors')
