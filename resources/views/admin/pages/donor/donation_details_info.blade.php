@extends('admin.app.app_admin')


@section('title')
{{-- type the title --}}
Donation
@endsection

@section('subtitle')
{{-- type the Subtitle --}}
    Donation Details
@endsection


@section('main_content_admin')
   
   {{-- place your content here --}}

   
   {{-- place your content here --}}
   <div class="row row-sm mg-t-20">
    {{-- new role adding form --}}
        <div class="col-md-10 m-auto">
            <div class="row">
                <div class="card col-md-4">
                    <div class="card-body">
                    <h5 class="card-title text-center">Donation Information</h5>
                    <hr>
                    <div class="card-text">  
                        <ul style="list-style-type: none; text-transform: capitalize">
                            <li> Donation Code  <span style="float:right">{{ $donation->b_req_code }}</span></li>
                            <li> Blood Group:  <span style="float:right">{{ $donation->relation_to_donate_req->relation_to_blood->blood_group }}</span></li>
                            <li> Blood ELement  <span style="float:right">{{ $donation->element_type }}</span></li>
                            <li> Quantity  <span style="float:right">{{ $donation->relation_to_donate_req->quantity }}</span></li>
                            <li> Requested  <span style="float:right">{{ $donation->relation_to_donate_req->created_at }}</span></li>
                            <li> Completed  <span style="float:right">{{ $donation->donation_completed }}</span></li>
                            <br>
                        </ul>
                    </div>
                    </div>
                </div><!-- card -->
                <div class="card col-md-4">
                    <div class="card-body">
                    <h5 class="card-title text-center"> Patient Information</h5>
                    <hr>
                    <div class="card-text">  
                        
                        <ul style="list-style-type: none; text-transform: capitalize">
                            <li> Gender  <span style="float:right">{{ $donation->relation_to_donate_req->recipient_gender }}</span></li>
                            <li> Age  <span style="float:right">{{ $donation->relation_to_donate_req->recipient_age }}</span></li>                        
                            <li> Sickness  <span style="float:right">{{ $donation->relation_to_donate_req->recipient_sickness }}</span></li>
                            <li> Email  <span style="float:right; text-transform: lowercase">{{ $donation->relation_to_donate_req->recipient_email }}</span></li>
                            <li> Phone  <span style="float:right">{{ $donation->relation_to_donate_req->recipient_phone }}</span></li>
                            <li> Location  <span style="float:right">{{ $donation->relation_to_donate_req->city_id }} / {{ $donation->relation_to_donate_req->division_id }} </span></li>
                            <li> Address  <span style="float:right">{{ $donation->relation_to_donate_req->recipient_address }}</span></li>

                        </ul>
                    </div>
                    </div>
                </div><!-- card -->
                {{-- {{ $donation }} --}}
                <br>
                <hr>
                
                <div class="card col-md-4">
                    <div class="card-body">
                    <h5 class="card-title text-center">Donor Information</h5>
                    <hr>
                    <div class="card-text">  
                        <ul style="list-style-type: none; text-transform: capitalize">
                            <li> Name  <span style="float:right">{{ $donation->relation_to_users->name }}</span></li>
                            <li> Gender  <span style="float:right">{{ $donation->relation_to_users->gender }}</span></li>                        
                            <li> Age  <span style="float:right">{{ $donation->relation_to_users->DOB }}</span></li>
                            <li> Email  <span style="float:right; text-transform: lowercase">{{ $donation->relation_to_users->email }}</span></li>
                            <li> Phone  <span style="float:right">{{ $donation->relation_to_users->phone }}</span></li>
                            <li> Location  <span style="float:right">{{ $donation->relation_to_users->city_id }} / {{ $donation->relation_to_users->division_id }} </span></li>
                            <li> Address  <span style="float:right">{{ $donation->relation_to_users->address }}</span></li>
                        </ul>
                    </div>
                    </div>
                </div><!-- card -->
            </div>
        </div>
   </div>
   

@endsection