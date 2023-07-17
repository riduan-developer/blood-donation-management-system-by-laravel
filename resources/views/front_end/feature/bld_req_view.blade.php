@extends('front_end.app.app')

    @section('main')
    
            <div class="slider-area ">
                <div class="single-slider section-overly slider-height2 d-flex align-items-center" style="min-height: 250px;" data-background="{{ asset('front_end/assets/img/gallery/how-applybg.png') }}">
                    <div class="container">
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="hero-cap text-center">
                                    <h2>Donation Requests</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Hero Area End -->
            <!-- Job List Area Start -->
            <div class="job-listing-area pt-120 pb-120">
                <div class="container">
                    <div class="row">
                        <div class="col-md-3 ml-auto">
                            <form action="{{ route('search_request') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                   <div class="input-group mb-3">
                                      <input name="search_request" type="text" class="form-control" placeholder='Search Keyword'
                                         onfocus="this.placeholder = ''" onblur="this.placeholder = 'Search Donation Request'">
                                      <div class="input-group-append">
                                         <button style="border: 1px solid #fb246a;background: #fb246a;" type="submit"><i class="fa fa-search"></i></button>
                                      </div>
                                   </div>
                                </div>
                                
                             </form>
                        </div>
                    </div>



                    <div class="row">
                        <!-- Left content -->
                        <div class="col-md-3">
                            <div class="row">
                                <div class="col-12">
                                        <div class="small-section-tittle2 mb-45">
                                        <div class="ion"> <svg 
                                            xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink"
                                            width="20px" height="12px">
                                        <path fill-rule="evenodd"  fill="rgb(27, 207, 107)"
                                            d="M7.778,12.000 L12.222,12.000 L12.222,10.000 L7.778,10.000 L7.778,12.000 ZM-0.000,-0.000 L-0.000,2.000 L20.000,2.000 L20.000,-0.000 L-0.000,-0.000 ZM3.333,7.000 L16.667,7.000 L16.667,5.000 L3.333,5.000 L3.333,7.000 Z"/>
                                        </svg>
                                        </div>
                                        <h4>Filter Donors</h4>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Job Category Listing start -->
                            <div class="job-category-listing mb-50">
                                <!-- single one -->
                                <form action="{{ route('filter_bld_req') }}" method="POST">
                                    @csrf
                                    <div class="single-listing">
                                        <div class="small-section-tittle2">
                                                <h4>Blood Group</h4>
                                        </div>
                                        <!-- Select job items start -->
                                        <div class="select-job-items2">
                                            <select name="blood">
                                                <option  value="">Select any</option>
                                                @foreach ($bloods as $blood)
                                                    <option value="{{ $blood->id }}">{{ $blood->blood_group }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <!--  Select job items End-->
                                                
                                    </div>
                                    <!-- single two -->
                                    <div class="single-listing">
                                        <div class="small-section-tittle2">
                                                <h4>Filter by Location</h4>
                                        </div>
                                            <!-- Select job items start -->
                                            <div class="select-job-items2">
                                                <select name="city" class="form-control" >
                                                    <option  value="">Select any</option>
                                                    @forelse ($cities as $city)
                                                        <option  value="{{ $city->id }}">{{ $city->name }}</option>
                                                    @empty
                                                    <option value="">No City Found</option>
                                                    @endforelse
                                                </select>
                                            </div>

                                    </div>

                                    <button class="genric-btn danger radius" type="submit">Filter</button>
                                </form>
                            </div>
                            <!-- Job Category Listing End --> 
                            
                        </div>
                        <!-- Right content -->
                        <div class="col-xl-9 col-lg-9 col-md-8">
                            <!--Pagination Start  -->
                            <div class="pagination-area pb-30 text-center">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-xl-12">
                                            <div class="single-wrap d-flex justify-content-center">
                                                <nav aria-label="Page navigation example">
                                                    <ul class="pagination justify-content-start">
                                                        <li class="page-item">{!! $datas->links('vendor.pagination.custom_paginate') !!}</li>
                                                    </ul>
                                                </nav>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--Pagination End  -->
                                                                
                            <!-- Featured_job_start -->
                            <section class="featured-job-area">
                                <div class="container">
                                    <!-- single-job-content -->
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
                                                        <li style="color: red">Donation needed: {{ Carbon\Carbon::parse($data->blood_require_time)->diffForHumans() }}</li>
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
                                                @guest
                                                    <a id="redhvr" class="btn btn-primary " style="padding: 1rem 10px;border-color:#fb246a;color:#fff" href="{{ route('login') }}">Login for details</a>
                                                @endguest
                                                
                                                <span>{{ Carbon\Carbon::parse($data->created_at)->diffForHumans() }}</span>
                                            </div>
                                        </div>


                                        {{-- modal content --}}
                                        <div class="modal fade" id="{{ $data->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">{{ $data->relation_to_blood->blood_group }} needed - {{ $data->quantity }} bags ({{ $data->element_type != 0 ?  $data->relation_to_blood_element->element_type : "Blood"  }})</h5>
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
                                                            <li>Patient : <span>{{ $data->recipient_gender }} | {{ $data->recipient_age }}yrs</span></li>
                                                            <li>Sickness : <span>{{ $data->recipient_sickness }}</span></li>
                                                            <li>Location : <span>{{ $data->relation_to_city->name }}</span></li>
                                                            <li>Address : <span>{{ $data->recipient_address }}</span></li>
                                                            <hr>
                                                            <li>Donate Time : <span>{{ $data->blood_require_time->format('d-M-y, h:i A') }}</span></li>
                                                            <li>Contact : <span>{{ $data->recipient_phone }}</span></li>
                                                        </ul>
                                                        <hr>
                                                        <ul style="font-size: 18px">
                                                            <li>Donation Status :
                                                                <span>
                                                                    <button class="genric-btn primary circle arrow" style="line-height: 30px">{{ $data->donation_status == 1 ?  "Successful" : "Donor Needed" }}
                                                                    </button>
                                                                </span>
                                                            </li>
                                                        </ul>
                                                        <div class="apply-btn2">
                                                            @auth
                                                                @if (Auth::user()->email_verified_at != NULL)
                                                                    <a style="color: #fb246a;font-weight:bold float:right" href="{{ route('b_req_update_info',$data->id) }}">Click for details</a><br>
                                                                    @if ($data->donation_status == 0)
                                                                        <p style="text-transform: capitalize;">if you want to donate. Click the button.</p>
                                                                        <form action="{{ route('b_req_update_info',$data->id) }}" method="POST">
                                                                            @csrf
                                                                            <input type="hidden" value="{{ Auth::id() }}" name="donor_id">
                                                                            <input type="hidden" value="{{ $data->id }}" name="req_id">
                                                                            <button type="submit" class="btn">I want to donate</button> 
                                                                        </form>
                                                                    @endif
                                                                @else 
                                                                <a style="color: #fb246a;font-weight:bold float:right" href="{{ route('profile_view',Auth::id()) }}">Verify Email First</a><br>
                                                                @endif
                                                            @endauth
                                                            @guest
                                                                <p style="text-transform: capitalize;">if you want to donate. Login First.</p>
                                                                <a type="button" class="btn" href="{{ route('login') }}">Login</a>
                                                            @endguest
                                                            
                                                        </div>
                                                        

                                                    </div>
                                                    </div>
                                                </div>
                                                </div>
                                        </div>

                                    @endforeach
                                <!--Pagination Start  -->
                                <div class="pagination-area pb-50 text-center">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-xl-12 mt-10">
                                                <div class="single-wrap d-flex justify-content-center">
                                                    <nav aria-label="Page navigation example">
                                                        <ul class="pagination justify-content-start">
                                                            <li class="page-item">{!! $datas->links('vendor.pagination.custom_paginate') !!}</li>
                                                        </ul>
                                                    </nav>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--Pagination End  -->
                                </div>
                            </section>
                            <!-- Featured_job_end -->
                        </div>
                                    <!--Pagination Start  -->
            
                    </div>
                </div>
            </div>
            <!-- Job List Area End -->

                                    


       

    @endsection