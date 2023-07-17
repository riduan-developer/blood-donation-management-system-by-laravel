@extends('front_end.app.app')

@section('main')



    @include('front_end.feature.slider')



    {{-- blood seeking request part --}}
    
    <div class="slider-area ">
        <div class="single-slider section-overly slider-height2 d-flex align-items-center" style="min-height: 250px;" data-background="{{ asset('front_end/assets/img/gallery/how-applybg.png') }}">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="hero-cap text-center">
                            <h2>Recent Donation Requests</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Hero Area End -->


    <!-- donation request List Area Start -->
    <div class="job-listing-area pt-120 pb-120">
        <div class="container">
            <div class="row">
                <!-- Right content -->
                <div class="col-xl-8 col-lg-8 col-md-10 m-auto">
                    <!-- Featured_job_start -->
                    <section class="featured-job-area">
                        <div class="container">
                           
                            @foreach ($datas as $data)
                                <div class="single-job-items mb-30" style="border: 1px solid lightgrey; padding: 25px 25px;">
                                    <div class="job-items">
                                        <div class="company-img">
                                            <a class="genric-btn primary-border" style="padding: 8px 12px;margin: 0 10px; color: #1f2b7b; font-size: 30px">
                                                {{ $data->relation_to_blood->blood_group }}
                                            </a>
                                            <p style="text-align:center;color: #1f2b7b;"> <small>NEEDED</small></p>
                                        </div>
                                        <div class="job-tittle job-tittle2">
                                            <a>
                                                <h4>{{ $data->quantity }} bags ({{ $data->element_type != 0 ?  $data->relation_to_blood_element->element_type : "Blood"  }})</h4>
                                            </a>
                                            <ul>
                                                <li>Blood needed: {{ Carbon\Carbon::parse($data->blood_require_time)->diffForHumans() }}</li>
                                                <li><i class="fas fa-map-marker-alt"></i>{{ $data->relation_to_city->name }}</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="items-link items-link2 f-right">
                                        @auth
                                        @if (Auth::user()->email_verified_at != NULL)
                                        <a type="button" id="redhvr" class="btn btn-primary " style="padding: 1.2rem 25px;border-color:#fb246a;color:#fff" data-toggle="modal" data-target="#{{ $data->id }}">
                                            DETAILS
                                            </a>
                                        @else 
                                        <a type="button" class="btn btn-primary " style="padding: 1.2rem 25px;border-color:#fb246a;color:#fff" href="{{ route('profile_view',Auth::id()) }}">DETAILS</a>

                                        @endif
                                    @endauth
                                    
                                        <span>{{ Carbon\Carbon::parse($data->created_at)->diffForHumans() }}</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </section>
                    <!-- Featured_job_end -->
                </div>
            </div>

            <div class="row">
                <div class="col-12 text-center pt-20">
                    <div class="apply-btn2">
                        <a class="btn" style="font-size: 20px; margin-bottom: 10px" href="{{ route('data') }}">See More</a>
                    </div>
                </div>
            </div>

            
        </div>
    </div>
    
        
    <div class="slider-area ">
        <div class="single-slider section-overly slider-height2 d-flex align-items-center" style="min-height: 250px;" data-background="{{ asset('front_end/assets/img/gallery/how-applybg.png') }}">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="hero-cap text-center">
                            <h2>Our Donors</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Hero Area End -->

    <!-- donation request List Area End -->
    <div class="job-listing-area pt-120 pb-120">
        <div class="container">
            <div class="row">
                @forelse ($donors as $donor)
                <div class="col-xl-4 col-lg-4 col-6">
                    <div  id="dnr_dtls" class="post-details3 mb-20" style="box-shadow: 4px 4px #ededed">
                        <h6>{{ $donor->name }}</h6>
                        <br>
                    <ul>
                        <li>Blood Group : <span style="font-weight: bold">{{ $donor->relation_to_donor->blood_group }}</span></li>
                        <li>City : <span style="font-weight: bold">{{ $donor->relation_to_city->name }}</span></li>
                        <li>Availability : <span style="font-weight: bold">{{ $donor->avail_to_donate === 1 ? "Available" : "Not Available" }}</span></li>
                        <li>Donated : <span style="font-weight: bold">{{ $donor->donate_number }} times</span></li>
                    </ul>
                    <div class="apply-btn2">
                        @auth
                        @if (Auth::user()->email_verified_at != NULL)
                        <a type="button" id="redhvr" class="genric-btn primary small text-white" data-toggle="modal" data-target="#{{ $donor->id }}">
                            DETAILS
                        </a>
                        @else 
                        <a class="genric-btn danger small text-black" href="{{ route('profile_view',Auth::id()) }}">DETAILS</a>

                        @endif
                        @endauth
                    </div>
                </div>
                </div>
                @empty 
                <a href="" type="button" class="genric-btn danger">No Data Available</a>
                @endforelse
            </div>
            <div class="row">
                <div class="col-12 text-center pt-20">
                    <div class="apply-btn2">
                        <a class="btn" style="font-size: 20px; margin-bottom: 10px" href="{{ route('donor_list_view') }}">See More</a>
                    </div>
                </div>
            </div>

        </div>
    </div>



    @include('front_end.feature.apply_process')


@endsection