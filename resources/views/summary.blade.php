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
    </div>
</div>
