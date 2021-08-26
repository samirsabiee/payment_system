@if(session('success'))
    <div class="alert alert-success mx-3">
        Operation Successfully Done
    </div>
@endif

@if(session('failed'))
    <div class="alert alert-danger mx-3">
        Operation Failed!
    </div>
@endif
