@extends('front_end.app.app')

@section('main')
    
            <div class="slider-area ">
                <div class="single-slider section-overly slider-height2 d-flex align-items-center" style="min-height: 300px" data-background="{{ asset('front_end/assets/img/hero/about.jpg') }}">
                    <div class="container">
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="hero-cap text-center">
                                    <h2>Donor List</h2>
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

                    <div class="row">
                        <div class="col-md-3 ml-auto">
                            <form action="{{ route('search_donor') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                   <div class="input-group mb-3">
                                      <input name="donor_search" type="text" class="form-control" placeholder='Search Keyword'
                                         onfocus="this.placeholder = ''" onblur="this.placeholder = 'Search donor'">
                                      <div class="input-group-append">
                                         <button style="border: 1px solid #fb246a;background: #fb246a;" type="submit"><i class="fa fa-search"></i></button>
                                      </div>
                                   </div>
                                </div>
                                
                             </form>
                        </div>
                    </div>



                    <div class="row justify-content-center">

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
                                
                                <form action="{{ route('filter_donor') }}" method="POST">
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
                        <div class="col-md-9">
                            
                            <!--Pagination Start  -->
                            <div class="pagination-area pb-50 text-center">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-xl-12 mt-20">
                                            <div class="single-wrap d-flex justify-content-center">
                                                <nav aria-label="Page navigation example">
                                                    <ul class="pagination justify-content-start">
                                                        <li class="page-item">{!! $donors->links('vendor.pagination.custom_paginate') !!}</li>
                                                    </ul>
                                                </nav>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--Pagination End  -->

                            <div class="row">

                                @forelse ($donors as $donor)
                                <div class="col-xl-4 col-lg-4 col-6">
                                    <div  id="dnr_dtls" class="post-details3 mb-20" style="box-shadow: 4px 4px #ededed">
                                        <h6>{{ $donor->name }}</h6>
                                        <br>
                                      <ul>
                                          <li>Blood Group : <span style="font-weight: bold">{{ $donor->relation_to_donor->blood_group }}</span></li>
                                          <li>Donated : <span style="font-weight: bold">{{ $donor->donate_number }} times</span></li>
                                          <li>City : <span style="font-weight: bold">{{ $donor->relation_to_city->name }}</span></li>
                                          <li>Availability : <span style="font-weight: bold">{{ $donor->avail_to_donate === 1 ? "Available" : "Not Available" }}</span></li>
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
                                        @guest
                                            <a id="redhvr" class="btn btn-primary " style="padding: 1rem 10px;border-color:#fb246a;color:#fff" href="{{ route('login') }}">Login for details</a>
                                        @endguest
                                     </div>
                                   </div>
                                
                                </div>
                                {{-- modal content --}}
                                <div class="modal fade" id="{{ $donor->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">{{ $donor->name }}</h5>
                                            </div>
                                            <div class="modal-body">
                                                <div class="post-details3">
                                                    <!-- Small Section Tittle -->
                                                    <ul style="font-size: 18px;text-transform: capitalize">
                                                        <li>Donor : <span>{{ $donor->gender }} | {{ Carbon\Carbon::parse($donor->DOB)->age }}  yrs</span></li>
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
                                                        <li>Health : <span>{{ $donor->health_condition }}</span></li>
                                                        <li>Diabetes : <span>{{ $donor->diabetes }}</span></li>
                                                        <li>Blood Pressure : <span>{{ $donor->BP }}</span></li>
                                                        @if ($donor->checkup_report != NULL)
                                                            <li>Checkup Report : <span>{{ $donor->checkup_report }}</span></li>
                                                        @endif
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>                        
                                    </div>

                                </div>
                                @empty 
                                   <a href="" type="button" class="genric-btn danger">No Data Available</a>
                                @endforelse
                            </div>
                                    <!--Pagination Start  -->
                            <div class="pagination-area pb-115 text-center">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-xl-12 mt-20">
                                            <div class="single-wrap d-flex justify-content-center">
                                                <nav aria-label="Page navigation example">
                                                    <ul class="pagination justify-content-start">
                                                        <li class="page-item">{!! $donors->links('vendor.pagination.custom_paginate') !!}</li>
                                                    </ul>
                                                </nav>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--Pagination End  -->
                            
                        </div>
                    </div>
            </section>
            <!-- request end -->
@endsection