@extends('front_end.app.app')

@section('main')

            <!-- Hero Area Start-->
            <div class="slider-area ">
                <div class="single-slider section-overly slider-height2 d-flex align-items-center" style="min-height: 250px" data-background="{{ asset('front_end/assets/img/hero/about.jpg') }}">
                    <div class="container">
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="hero-cap text-center">
                                    <h2>{{ $donor->name }} Profile</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
                <!-- Hero Area End -->
                <!-- job post company Start -->
                <div class="job-post-company pt-120 pb-120">
                    <div class="container">
                        
                        @if (Auth::user()->email_verified_at == NULL)
                        <div class="row justify-content-between" style="text-transform: capitalize">
                            <div class="col-xl-10 col-lg-10">
                                <h4>Please Verify your email with the verfication link we sent.</h4>
                                <h6>if you haven't got the link, <a href="#" style="color: blue">click here to get another link</a></h6>
                                
                            </div>
                        </div>
                        @else

                        <div class="row justify-content-between">
                            <!-- Left Content -->

                            <div class="col-xl-4 col-lg-4">
                                <div class="post-details3">
                                    <!-- Small Section Tittle -->
                                    <ul style="font-size: 14px;text-transform: capitalize">
                                        <li>Name : <span>{{ $donor->name }}</span></li>
                                        <li>Donor : <span>{{ $donor->gender }} | {{ Carbon\Carbon::parse($donor->DOB)->age }} yrs</span></li>
                                        <li>Blood Group : <span>" {{ $donor->relation_to_donor->blood_group }} "</span></li>
                                        <li>Donated : <span>{{ $donor->donate_number }} times</span></li>
                                        <li>Last Donate : <span>{{ $donor->last_donate == NULL ? "Not Found" : $donor->last_donate  }}</span></li>
                                        <li>Availability : <span>{{ $donor->avail_to_donate == 1 ? "Available" : "Not Available" }}</span></li>
                                        <br>
                                        <li>Location: <span>{{ $donor->relation_to_city->name }}</span></li>
                                        <li>Address : <span>{{ $donor->address }}</span></li>
                                        <li>Contact : <span>{{ $donor->phone }}</span></li>
                                        <br>
                                        <li style="font-weight: bold">Health Information</li>
                                        <li>Health : <span>{{ $donor->health_condition  }}</span></li>
                                        <li>Diabetes : <span>{{ $donor->diabetes }}</span></li>
                                        <li>Blood Pressure : <span>{{ $donor->BP }}</span></li>
                                        @if ($donor->checkup_report != NULL)
                                        <li>Checkup Report : <span>{{ $donor->checkup_report }}</span></li>
                                        @endif
                                    </ul>

                                    <div class="apply-btn2">
                                        <a href="{{ route('profile_update',$donor->id) }}" class="btn">Edit Info</a>
                                    </div>
                                </div>
                            </div>

                            <!-- Right Content -->
                            <div class="col-xl-7 col-lg-8">
                                    <h5>Your Current Request</h5><br>
                                    @forelse ($current_reqs as $req)
                                        <div class="single-job-items mb-30" style="border: 1px solid lightgrey; padding: 15px 15px;">
                                            <div class="job-items">
                                                <div class="company-img">
                                                    <a class="genric-btn primary-border" style="padding: 5px 12px;margin: 0 10px; color: #1f2b7b; font-size: 20px">
                                                        {{ $req->relation_to_blood->blood_group }}
                                                    </a>
                                                    <p style="text-align:center;color: #1f2b7b;"></p>
                                                </div>
                                                <div class="job-tittle job-tittle2">
                                                    <a>
                                                        <h6>{{ $req->quantity }} bags ({{ $req->element_type != 0 ?  $req->relation_to_blood_element->element_type : "Blood"  }})</h6>
                                                    </a>
                                                    <ul>
                                                        <li><i class="fas fa-map-marker-alt"></i>{{ $req->relation_to_city->name }}</li>
                                                        <li>{{ Carbon\Carbon::parse($req->created_at)->diffForHumans() }}</li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="items-link items-link2 f-lelft">
                                                <a type="button" href="{{ route('donation_complete',$req->id) }}" class="btn btn-primary" style="padding: 1.2rem 20px;border-color:#fb246a;background: none">Donation Received</a>
                                            </div>
                                            <div class="items-link items-link2 f-right">
                                                <a type="button" id="redhvr" class="btn btn-primary " style="padding: 1.2rem 20px;border-color:#fb246a;color:#fff" data-toggle="modal" data-target="#{{ $req->id }}">
                                                    DETAILS
                                                    </a>
                                                
                                            </div>
                                        </div>
                                        {{-- modal content --}}
                                        <div class="modal fade" id="{{ $req->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">{{ $req->relation_to_blood->blood_group }} needed - {{ $req->quantity }} bags ({{ $req->element_type != 0 ?  $req->relation_to_blood_element->element_type : "Blood"  }})</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="post-details3  mb-50">
                                                            <!-- Small Section Tittle -->
                                                            <div class="small-section-tittle">
                                                                <h4>Detailed Information</h4>
                                                            </div>
                                                            <ul style="font-size: 18px">
                                                                <li>Patient : <span>{{ $req->recipient_gender }} | {{ $req->recipient_age }}yrs</span></li>
                                                                <li>Sickness : <span>{{ $req->recipient_sickness }}</span></li>
                                                                <li>Location : <span>{{ $req->relation_to_city->name }}</span></li>
                                                                <li>Address : <span>{{ $req->recipient_address }}</span></li>
                                                                <hr>
                                                                <li>Donate Time : <span>{{ $req->blood_require_time->format('d-M-y, h:i A') }}</span></li>
                                                                <li>Donation Completed : <span>{{ $req->donation_status == 1 ? $req->relation_to_donation_info->donation_completed->format('d-M-y') : "" }}</span></li>
                                                                <li>Contact : <span>{{ $req->recipient_phone }}</span></li>
                                                            </ul>
                                                            <hr>
                                                            <ul style="font-size: 18px">
                                                                <li>Donation Status :
                                                                    <span>
                                                                        <button class="genric-btn primary circle arrow" style="line-height: 30px">{{ $req->donation_status != 0 ? "Successful" : "Donor Needed" }}
                                                                        </button>
                                                                    </span>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @empty
                                        <div class="items-link items-link2">
                                            <a type="button" class="btn btn-primary " style="padding: 1.2rem 20px;border-color:#fb246a;color:#fff">
                                            No Current Requests are running. 
                                            </a>
                                        </div>
                                    @endforelse
                                    <hr>
                                    <!-- job single -->
                                    <h5>Your Current Donation</h5><br>
                                    @forelse ($current_donations as $data)
                                        <div class="single-job-items mb-30" style="border: 1px solid lightgrey; padding: 15px 15px;">
                                            <div class="job-items">
                                                <div class="company-img">
                                                    <a class="genric-btn primary-border" style="padding: 5px 12px;margin: 0 10px; color: #1f2b7b; font-size: 20px">
                                                        {{ $data->relation_to_donate_req->relation_to_blood->blood_group }}
                                                    </a>
                                                    <p style="text-align:center;color: #1f2b7b;"></p>
                                                </div>
                                                <div class="job-tittle job-tittle2">
                                                    <a>
                                                        <h6>{{ $data->relation_to_donate_req->quantity }} bags ({{ $data->relation_to_donate_req->element_type != 0 ?  $data->relation_to_donate_req->relation_to_blood_element->element_type : "Blood"  }})</h6>
                                                    </a>
                                                    <ul>
                                                        <li><i class="fas fa-map-marker-alt"></i>{{ $data->relation_to_donate_req->relation_to_city->name }}</li>
                                                        <li>{{ Carbon\Carbon::parse($data->relation_to_donate_req->created_at)->diffForHumans() }}</li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="items-link items-link2 f-right">
                                                <a type="button" id="redhvr" class="btn btn-primary " style="padding: 1.2rem 20px;border-color:#fb246a;color:#fff" data-toggle="modal" data-target="#{{ $data->id }}">
                                                    DETAILS
                                                    </a>
                                            </div>
                                        </div>
                                        {{-- modal content --}}
                                        <div class="modal fade" id="{{ $data->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">{{ $data->relation_to_donate_req->relation_to_blood->blood_group }} needed - {{ $data->relation_to_donate_req->quantity }} bags ({{ $data->relation_to_donate_req->element_type != 0 ?  $data->relation_to_donate_req->relation_to_blood_element->element_type : "Blood"  }})</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="post-details3  mb-50">
                                                            <!-- Small Section Tittle -->
                                                            <div class="small-section-tittle">
                                                                <h4>Detailed Information</h4>
                                                            </div>
                                                            <ul style="font-size: 18px">
                                                                <li>Patient : <span>{{ $data->relation_to_donate_req->recipient_gender }} | {{ $data->relation_to_donate_req->recipient_age }}yrs</span></li>
                                                                <li>Sickness : <span>{{ $data->relation_to_donate_req->recipient_sickness }}</span></li>
                                                                <li>Location : <span>{{ $data->relation_to_donate_req->relation_to_city->name }}</span></li>
                                                                <li>Address : <span>{{ $data->relation_to_donate_req->recipient_address }}</span></li>
                                                                <hr>
                                                                <li>Donate Time : <span>{{ $data->relation_to_donate_req->blood_require_time->format('d-M-y, h:i A') }}</span></li>
                                                                <li>Donation Completed : <span>{{ $data->donation_completed != NULL ? $data->donation_completed->format('d-M-y') : "" }}</span></li>
                                                                <li>Contact : <span>{{ $data->relation_to_donate_req->recipient_phone }}</span></li>
                                                            </ul>
                                                            <hr>
                                                            <ul style="font-size: 18px">
                                                                <li>Donation Status :
                                                                    <span>
                                                                        <button class="genric-btn primary circle arrow" style="line-height: 30px">{{ $data->donation_completed != NULL ? "Successful" : "Donor Needed" }}
                                                                        </button>
                                                                    </span>
                                                                </li>
                                                            </ul>
                                                            @if ($data->donation_completed == NULL)
                                                                <div class="apply-btn2">
                                                                    <a type="button" class="btn" href="{{ route('b_req_update_info',$data->id) }}">Donate</a>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @empty
                                        <div class="items-link items-link2">
                                            <a type="button" class="btn btn-primary " style="padding: 1.2rem 20px;border-color:#fb246a;color:#fff">
                                            You haven't donated for donation yet. 
                                            </a>
                                        </div>
                                    @endforelse
                                <!-- job single End -->
                                    <hr>


                                 <!-- job single -->
                                    <h5>Your Donation History</h5><br>
                                    @forelse ($datas as $data)
                                        <div class="single-job-items mb-30" style="border: 1px solid lightgrey; background: lightgrey; padding: 15px 15px;">
                                            <div class="job-items">
                                                <div class="company-img">
                                                    <a class="genric-btn primary-border" style="padding: 5px 12px;margin: 0 10px; color: #1f2b7b; font-size: 20px">
                                                        {{ $data->relation_to_donate_req->relation_to_blood->blood_group }}
                                                    </a>
                                                    <p style="text-align:center;color: #1f2b7b;"></p>
                                                </div>
                                                <div class="job-tittle job-tittle2">
                                                    <a>
                                                        <h6>{{ $data->relation_to_donate_req->quantity }} bags ({{ $data->relation_to_donate_req->element_type != 0 ?  $data->relation_to_donate_req->relation_to_blood_element->element_type : "Blood"  }})</h6>
                                                    </a>
                                                    <ul>
                                                        <li><i class="fas fa-map-marker-alt"></i>{{ $data->relation_to_donate_req->relation_to_city->name }}</li>
                                                        <li>{{ Carbon\Carbon::parse($data->relation_to_donate_req->created_at)->diffForHumans() }}</li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="items-link items-link2 f-right">
                                                <a type="button" id="redhvr" class="btn btn-primary " style="padding: 1.2rem 20px;border-color:#fb246a;color:#fff" data-toggle="modal" data-target="#{{ $data->id }}">
                                                    DETAILS
                                                    </a>
                                            </div>
                                        </div>
                                        {{-- modal content --}}
                                        <div class="modal fade" id="{{ $data->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">{{ $data->relation_to_donate_req->relation_to_blood->blood_group }} needed - {{ $data->relation_to_donate_req->quantity }} bags ({{ $data->relation_to_donate_req->element_type != 0 ?  $data->relation_to_donate_req->relation_to_blood_element->element_type : "Blood"  }})</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="post-details3  mb-50">
                                                            <!-- Small Section Tittle -->
                                                            <div class="small-section-tittle">
                                                                <h4>Detailed Information</h4>
                                                            </div>
                                                            <ul style="font-size: 18px">
                                                                <li>Patient : <span>{{ $data->relation_to_donate_req->recipient_gender }} | {{ $data->relation_to_donate_req->recipient_age }}yrs</span></li>
                                                                <li>Sickness : <span>{{ $data->relation_to_donate_req->recipient_sickness }}</span></li>
                                                                <li>Location : <span>{{ $data->relation_to_donate_req->relation_to_city->name }}</span></li>
                                                                <li>Address : <span>{{ $data->relation_to_donate_req->recipient_address }}</span></li>
                                                                <hr>
                                                                <li>Donate Time : <span>{{ $data->relation_to_donate_req->blood_require_time->format('d-M-y, h:i A') }}</span></li>
                                                                <li>Donation Completed : <span>{{ $data->donation_completed != NULL ? $data->donation_completed->format('d-M-y') : "" }}</span></li>
                                                                <li>Contact : <span>{{ $data->relation_to_donate_req->recipient_phone }}</span></li>
                                                            </ul>
                                                            <hr>
                                                            <ul style="font-size: 18px">
                                                                <li>Donation Status :
                                                                    <span>
                                                                        <button class="genric-btn primary circle arrow" style="line-height: 30px">{{ $data->donation_completed != NULL ? "Successful" : "Donor Needed" }}
                                                                        </button>
                                                                    </span>
                                                                </li>
                                                            </ul>
                                                            @if ($data->donation_completed == NULL)
                                                                <div class="apply-btn2">
                                                                    <a type="button" class="btn" href="{{ route('b_req_update_info',$data->id) }}">Donate</a>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @empty
                                        <div class="items-link items-link2">
                                            <a type="button" class="btn btn-primary " style="padding: 1.2rem 20px;border-color:#fb246a;color:#fff">
                                            You haven't donated for donation yet. 
                                            </a>
                                        </div>
                                    @endforelse
                                  <!-- job single End -->
                                  <hr>


                                  <h5>Your Requested Posts History</h5><br>
                                  @forelse ($reqs as $req)
                                    <div class="single-job-items mb-30" style="border: 1px solid lightgrey; background: lightgrey; padding: 15px 15px;">
                                        <div class="job-items">
                                            <div class="company-img">
                                                <a class="genric-btn primary-border" style="padding: 5px 12px;margin: 0 10px; color: #1f2b7b; font-size: 20px">
                                                    {{ $req->relation_to_blood->blood_group }}
                                                </a>
                                                <p style="text-align:center;color: #1f2b7b;"></p>
                                            </div>
                                            <div class="job-tittle job-tittle2">
                                                <a>
                                                    <h6>{{ $req->quantity }} bags ({{ $req->element_type != 0 ?  $req->relation_to_blood_element->element_type : "Blood"  }})</h6>
                                                </a>
                                                <ul>
                                                    <li><i class="fas fa-map-marker-alt"></i>{{ $req->relation_to_city->name }}</li>
                                                    <li>{{ Carbon\Carbon::parse($req->created_at)->diffForHumans() }}</li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="items-link items-link2 f-right">
                                            <a type="button" id="redhvr" class="btn btn-primary " style="padding: 1.2rem 20px;border-color:#fb246a;color:#fff" data-toggle="modal" data-target="#{{ $req->id }}">
                                                DETAILS
                                                </a>
                                        </div>
                                    </div>
                                    {{-- modal content --}}
                                    <div class="modal fade" id="{{ $req->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">{{ $req->relation_to_blood->blood_group }} needed - {{ $req->quantity }} bags ({{ $req->element_type != 0 ?  $req->relation_to_blood_element->element_type : "Blood"  }})</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="post-details3  mb-50">
                                                        <!-- Small Section Tittle -->
                                                        <div class="small-section-tittle">
                                                            <h4>Detailed Information</h4>
                                                        </div>
                                                        <ul style="font-size: 18px">
                                                            <li>Patient : <span>{{ $req->recipient_gender }} | {{ $req->recipient_age }}yrs</span></li>
                                                            <li>Sickness : <span>{{ $req->recipient_sickness }}</span></li>
                                                            <li>Location : <span>{{ $req->relation_to_city->name }}</span></li>
                                                            <li>Address : <span>{{ $req->recipient_address }}</span></li>
                                                            <hr>
                                                            <li>Donate Time : <span>{{ $req->blood_require_time->format('d-M-y, h:i A') }}</span></li>
                                                            <li>Donation Completed : <span>{{ $req->donation_status != NULL ? $data->donation_completed->format('d-M-y') : "" }}</span></li>
                                                            <li>Contact : <span>{{ $req->recipient_phone }}</span></li>
                                                        </ul>
                                                        <hr>
                                                        <ul style="font-size: 18px">
                                                            <li>Donation Status :
                                                                <span>
                                                                    <button class="genric-btn primary circle arrow" style="line-height: 30px">{{ $req->donation_status != NULL ? "Successful" : "Donor Needed" }}
                                                                    </button>
                                                                </span>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                  @empty
                                    <div class="items-link items-link2">
                                        <a type="button" class="btn btn-primary " style="padding: 1.2rem 20px;border-color:#fb246a;color:#fff">
                                        You haven't requested for donation yet. 
                                        </a>
                                    </div>
                                  @endforelse
                                  <hr>
                            </div>
                            
                        </div>
                        
                        @endif
                        
                    </div>
                </div>
                <!-- job post company End -->







@endsection