@extends('admin.app.app_admin')


@section('title')
{{-- type the title --}}
    Donor
@endsection

@section('subtitle')
{{-- type the Subtitle --}}
    @if ($user) {{ $user->name }} detail information @endif 
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
                    <h5 class="card-title text-center">Personal Information</h5>
                    <hr>
                    <div class="card-text">  
                        <ul style="list-style-type: none; text-transform: capitalize">
                            <li> name  <span style="float:right">{{ $user->name }}</span></li>
                            <li> Blood Group:  <span style="float:right">{{ $user->relation_to_donor->blood_group }}</span></li>
                            <li> gender  <span style="float:right">{{ $user->gender }}</span></li>
                            <li> age  <span style="float:right">{{ $user->DOB }}</span></li>
                            <li> email  <span style="float:right">{{ $user->gender }}</span></li>
                            <li> phone  <span style="float:right">{{ $user->gender }}</span></li>
                            <li> Division  <span style="float:right">{{ $user->gender }}</span></li>
                            <li> City  <span style="float:right">{{ $user->gender }}</span></li>
                            <li> Address  <span style="float:right">{{ $user->gender }}</span></li>
                            <li> Role  <span style="float:right">{{ $user->relation_to_role == NULL ? "user" : 'admin' }}</span></li>
                            <br>
                        </ul>
                    </div>
                    </div>
                </div><!-- card -->
                <div class="card col-md-4">
                    <div class="card-body">
                    <h5 class="card-title text-center">Health Information</h5>
                    <hr>
                    <div class="card-text">  
                        <ul style="list-style-type: none; text-transform: capitalize">
                            <li> Health Condition  <span style="float:right">{{ $user->health_condition ==  NULL ? 'not found' : $user->health_condition }}</span></li>
                            <li> Checkup report  <span style="float:right">{{ $user->checkup_report == NULL ? 'Not found' : $user->checkup_report }}</span></li>                        
                            <li> BMI Info  <span style="float:right">{{ $user->BMI }}</span></li>
                            <li> AIDS  <span style="float:right">{{ $user->gender }}</span></li>
                            <li> malaria  <span style="float:right">{{ $user->gender }}</span></li>
                            <li> diabetes  <span style="float:right">{{ $user->gender }}</span></li>
                        </ul>
                    </div>
                    </div>
                </div><!-- card -->
                <div class="card col-md-4">
                    <div class="card-body">
                    <h5 class="card-title text-center">Donation Information</h5>
                    <hr>
                    <div class="card-text">  
                        <ul style="list-style-type: none; text-transform: capitalize">
                            
                            <li> donated  <span style="float:right">{{ $user->to_donation_info->count() }} {{ $user->to_donation_info->count() > 1 ? 'times' : 'time' }}</span></li>
                            <br>
                            @forelse ($donations as $donation)
                            <li> donated at 
                                <span style="float:right">
                                    <button class="btn {{ $donation->donation_completed == NULL ? "btn-outline-danger" : "btn-outline-success" }} btn-block">
                                        {{ $donation->donation_completed == NULL ? "Not found" : $donation->donation_completed }}</td>
                                    </button>
                                </span>
                                
                            </li>    
                            @empty
                                <li>No Donation Information yet.</li>
                            @endforelse
                        </ul>
                    </div>
                    </div>
                </div><!-- card -->
            </div>
        </div>
   </div>
   

@endsection