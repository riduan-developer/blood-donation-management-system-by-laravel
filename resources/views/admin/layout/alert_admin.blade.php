

    @if (session()->get( 'success' ))
        <div class="col-6 ml-auto alert alert-success alert-dismissible pd-y-20" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            <div class="d-sm-flex align-items-center justify-content-start">
            <i class="icon ion-ios-checkmark alert-icon tx-52 mg-r-20 tx-success"></i>
            <div class="mg-t-20 mg-sm-t-0">
            <h5 class="mg-b-2 tx-success text-capitalize">{{ session()->get( 'success' ) }}</h5>
            </div>
            </div><!-- d-flex -->
        </div><!-- alert -->
    @endif


    @if (session()->get( 'error' ))
        <div class="col-6 ml-auto alert alert-danger alert-dismissible pd-y-20" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            <div class="d-sm-flex align-items-center justify-content-start">
            <i class="icon ion-ios-close alert-icon tx-52 mg-r-20 tx-danger"></i>
            <div class="mg-t-20 mg-sm-t-0">
            <h5 class="mg-b-2 tx-danger">{{ session()->get( 'error' ) }}</h5>
            </div>
            </div><!-- d-flex -->
        </div><!-- alert -->
    @endif
