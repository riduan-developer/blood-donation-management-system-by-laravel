@extends('front_end.app.app')

@section('main')
    
            <div class="slider-area ">
                <div class="single-slider section-overly slider-height2 d-flex align-items-center" style="min-height: 300px" data-background="{{ asset('front_end/assets/img/hero/about.jpg') }}">
                    <div class="container">
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="hero-cap text-center">
                                    <h2>Donation Requests Updates</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Hero Area End -->
            <!-- request start -->
            <section class="featured-job-area feature-padding" style="padding-top: 100px">
                <div class="container">

                    <div class="row justify-content-center">
                        
                    
                        <div class="col-md-9 ">
                            <!-- single-request-content -->
                            <div class="single-job-items mb-30" style="border: 1px solid lightgrey; border-radius: 25px;">
                            
                                <div class="job-items">
                                    <div class="company-img">
                                        <a href="job_details.html"><img src="assets/img/icon/job-list1.png" alt=""></a>
                                    </div>
                                    
                                    <div class="job-tittle">
                                        <h3 style="color: red">"{{ $data->relation_to_blood->blood_group }}" <strong style="font-size: 1rem; color: grey"> blood needed</strong></h3>
                                    
                                        <br>

                                        <h6> Bags: {{ $data->quantity }}   |  Time: {{ Carbon\Carbon::parse($data->blood_require_time)->diffForHumans() }} </h6>

                                        <ul>
                                            <li style="color: black">Element Needed: {{ $data->relation_to_blood_element->element_type  }}</li>
                                            <li style="color: black">Sickness: {{ $data->recipient_sickness }}</li>
                                            <li style="color: black"><i class="fas fa-map-marker-alt"></i>City: {{ $data->relation_to_city->name }}</li>
                                            <li style="color: black">Contact: {{ $data->recipient_phone }}</li>
                                        </ul>

                                        <p>
                                            <i class="fas fa-map-marker-alt text-danger" style="padding-right: 10px"></i> {{ $data->recipient_address }}
                                        </p>   
                                    
                                    </div>
                                </div>
                                {{-- modal button --}}
                                <div class="items-link f-right">
                                    <a type="button" class="btn btn-primary " style="padding: 1.2rem 25px;border-color:#fb246a;color:#fff">
                                        @if ($data->donation_status == 0)
                                            {{ 'Looking for Donors' }}
                                        @elseif($data->donation_status == 1)
                                            @forelse ($data->relation_to_donation_info as $donation_status)
                                                {{ 'Donor Accepted' }}
                                            @empty
                                                {{ 'no data' }}
                                            @endforelse
                                        @elseif($data->donation_status == 2)
                                            {{ 'Donation Completed' }}
                                        @endif
                                    </a>

                                </div>


                            </div>
                            <hr>

                            <h6>Donors who accepted request</h6>

                            <!-- donor list -->
                            @forelse ($data->relation_to_donation_info as $donation_status)
                            <div class="single-job-items mb-30" style="border: 1px solid lightgrey; border-radius: 25px;">
                                <div class="job-items">
                                        <div class="job-tittle">
                                            
                                            <h5> {{ $donation_status->relation_to_users->name }} - "{{ $donation_status->relation_to_users->relation_to_donor->blood_group }}" </h5>
                                            <ul>
                                                <li style="font-size: 20px">{{ $donation_status->relation_to_users->address }}</li>
                                                <li style="font-size: 20px">{{ $donation_status->relation_to_users->phone }}</li>
                                                <li style="font-size: 20px">{{ Carbon\Carbon::parse($donation_status->donation_accepted)->diffForHumans() }}</li>
                                            </ul> 
                                        </div>
                                    </div>
                                    <div class="items-link f-right">
                                        <a type="button" id="redhvr" class="btn btn-primary " style="padding: 1.2rem 25px;border-color:#fb246a; color:#fff" data-toggle="modal" data-target="#{{ $donation_status->relation_to_users->id }}">
                                        Details
                                        </a>
    
                                    </div>
                                {{-- modal content --}}
                                <div class="modal fade" id="{{ $donation_status->relation_to_users->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">{{ $donation_status->relation_to_users->name }}</h5>
                                            </div>
                                            <div class="modal-body">
                                                <div class="post-details3">
                                                    <!-- Small Section Tittle -->
                                                    <ul style="font-size: 18px;text-transform: capitalize">
                                                        <li>Donor : <span>{{ $donation_status->relation_to_users->gender }} | {{ Carbon\Carbon::parse($donation_status->relation_to_users->DOB)->age }}  yrs</span></li>
                                                        <li>Blood Group : <span>" {{ $donation_status->relation_to_users->relation_to_donor->blood_group }} "</span></li>
                                                        <li>Donated : <span>{{ $donation_status->relation_to_users->donate_number }} times</span></li>
                                                        <li>Last Donate : <span>{{ $donation_status->relation_to_users->last_donate == NULL ? "Not Found" : $donation_status->relation_to_users->last_donate  }}</span></li>
                                                        <li>Availability : <span>{{ $donation_status->relation_to_users->avail_to_donate == 1 ? "Available" : "Not Available" }}</span></li>
                                                        <br>
                                                        <li>Location: <span>{{ $donation_status->relation_to_users->relation_to_city->name }}</span></li>
                                                        <li>Address : <span>{{ $donation_status->relation_to_users->address }}</span></li>
                                                        <li>Contact : <span>{{ $donation_status->relation_to_users->phone }}</span></li>
                                                        <br>
                                                        <li style="font-weight: bold">Health Information</li>
                                                        <li>Health : <span>{{ $donation_status->relation_to_users->health_condition }}</span></li>
                                                        <li>AIDS : <span>{{ $donation_status->relation_to_users->AIDS }}</span></li>
                                                        <li>Malaria : <span>{{ $donation_status->relation_to_users->malaria }}</span></li>
                                                        <li>Diabetes : <span>{{ $donation_status->relation_to_users->diabetes }}</span></li>
                                                        <li>Blood Pressure : <span>{{ $donation_status->relation_to_users->BP }}</span></li>
                                                        @if ($donation_status->relation_to_users->checkup_report != NULL)
                                                            <li>Checkup Report : <span>{{ $donation_status->relation_to_users->checkup_report }}</span></li>
                                                        @endif
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>                        
                                    </div>

                                </div>
                                    @empty
                                    <h3>{{ 'No Donor has accepted yet' }}</h3>
                            </div>
                            @endforelse
                        </div>
                            
                    </div>
                </div>
            </section>
            <!-- request end -->


@endsection