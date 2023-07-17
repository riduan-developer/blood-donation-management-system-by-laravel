
@if (session()->get('success'))
    <div class="col-10 col-md-5 ml-auto alert alert-primary alert-dismissible pd-y-20" role="alert" style="position:fixed; top:2%; right:1%;  z-index:999999">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        <div class="d-sm-flex align-items-center justify-content-start">
        <i class="icon ion-ios-checkmark alert-icon tx-52 mg-r-20 tx-primary"></i>
        <div class="mg-t-20 mg-sm-t-0">
        <h5 class="mg-b-2 tx-success text-primary">{{ session()->get('success') }}</h5>
        </div>
        </div><!-- d-flex -->
    </div><!-- alert -->
@endif

@if (session()->get('error'))
    <div class="col-md-5 col-10 ml-auto alert alert-danger alert-dismissible pd-y-20" role="alert" style="position:fixed; top:2%; right:1%;  z-index:999999">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        <div class="d-sm-flex align-items-center justify-content-start">
        <i class="icon ion-ios-checkmark alert-icon tx-52 mg-r-20 tx-danger"></i>
        <div class="mg-t-20 mg-sm-t-0">
        <h5 class="mg-b-2 tx-error text-danger">{{ session()->get('error') }}</h5>
        </div>
        </div><!-- d-flex -->
    </div><!-- alert -->
@endif