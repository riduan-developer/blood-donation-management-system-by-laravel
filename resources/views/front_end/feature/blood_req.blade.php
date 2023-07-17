@extends('front_end.app.app_auth')
@section('main')
<div class="container" style="margin-top: 5rem; margin-bottom:5rem;">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                
                @foreach ($errors->all() as $error)
                    {{ $error }}
                @endforeach
                <div class="card-body">
                 
                    {{-- PERSONAL INFORMATION STARTS --}}
                    <div class="card-header text-center" style="background-color:rgba(0,0,0,0.09); font-weight:bold">{{ __('Patient Information') }}</div><br>

                    <form method="POST" action="{{ route('request_post') }}">
                        @csrf

                        
                        {{-- row 1 --}}
                        <div class="row mb-3 mt-30">
                            {{-- sickness --}}
                            <div class="col-md-6">
                                <label for="sickness" class="col-form-label text-md-end">{{ __('Write about Patient Sickness*') }}</label>

                                <div class="">
                                    <input id="quantity" type="text" class="form-control @error('sickness') is-invalid @enderror" name="sickness" value="{{ old('sickness') }}" required autofocus>

                                    @error('sickness')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>


                             {{-- gender --}}
                             <div class="col-md-3 col-6 input-group-icon">
                                <label for="gender" class="col-form-label text-md-end">{{ __('Gender*') }}</label>
								<div class="form-select" id="default-select">
                                    <select name="gender">
                                        <option value="" selected="true">Choose any</option>
                                        <option value="1">Male</option>
                                        <option value="2">Female</option>
                                        <option value="3">Others</option>
									</select>
								</div>
							</div>

                            
                            {{-- age --}}
                            <div class="col-md-3 col-6">
                                <label for="p_age" class="col-form-label text-md-end">{{ __('Age*') }}</label>

                                <div class="">
                                    <input id="p_age" type="number" class="form-control @error('p_age') is-invalid @enderror" name="p_age" value="{{ old('p_age') }}" required>
                                    @error('p_age')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            

                        </div>
                        <hr>

                        {{-- row 2 --}}
                        <div class="row mb-3 mt-30">

                            {{-- blood_group --}}
                            <div class="col-md-3 col-6 input-group-icon">
                                <label for="blood_group" class="col-form-label text-md-end">{{ __('Blood Group*') }}</label>
                                <div class="form-select" id="default-select">
                                    <select name="blood_group" value="{{ old('blood_group') }}">
                                            <option value="" selected="true">Choose blood group</option>
                                        @foreach ($bloods as $bg)
                                            <option value="{{ $bg->id }}">{{ $bg->blood_group }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                             {{-- blood_element --}}
                            <div class="col-md-3 col-6 input-group-icon">
                                <label for="blood_element" class="col-form-label text-md-end">{{ __('Blood Element') }}</label>
                                <div class="form-select" id="default-select">
                                    <select name="blood_element" value="{{ old('blood_element') }}">
                                        <option value="" selected="true">Choose any element</option>
                                        @foreach ($elements as $element)
                                            <option value="{{ $element->id }}">{{ $element->element_type }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>                           

                            {{-- quantity --}}
                            <div class="col-md-3 col-6">
                                <label for="quantity" class="col-form-label text-md-end">{{ __('No. of Bags*') }}</label>

                                <div class="">
                                    <input id="quantity" type="number" class="form-control @error('quantity') is-invalid @enderror" name="quantity" value="{{ old('quantity') }}" required>
                                    @error('quantity')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- require time --}}
                            <div class="col-md-3 col-6">
                                <label for="date" class="col-form-label text-md-end">{{ __('When Needed*') }}</label>

                                <div class="">
                                    @error('require_time')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <input id="require_time" type="datetime-local" class="form-control @error('require_time') is-invalid @enderror" name="require_time" value="{{ old('require_time') }}" required>
                                    
                                </div>
                            </div>

                            

                        </div>
                        <hr>                      


                        {{-- HEALTH INFORMATION STARTS --}}

                        <div class="card-header text-center" style="background-color:rgba(0,0,0,0.09);font-weight:bold">{{ __('Donation Address Information') }}</div><br>

                        {{-- row 3 --}}
                        <div class="row mb-3 mt-30">

                        
                            {{-- email --}}
                            <div class="col-md-3">
                                <label for="email" class="col-form-label text-md-end">{{ __('Email Address*') }}</label>

                                <div class="">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                                    @auth value="{{ auth()->user()->email }}" @endauth
                                    @guest value="{{ old('email') }}" @endguest required autocomplete="email" placeholder="demo@demo.com">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>


                            {{-- phone --}}
                            <div class="col-md-3">
                                <label for="phone" class="col-form-label text-md-end">{{ __('Phone Number*') }}</label>

                                <div class="">
                                    <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" @auth value="{{ auth()->user()->phone }}" @endauth
                                    @guest value="{{ old('phone') }}" @endguest required autocomplete="phone" placeholder="01XXXXXXXXX">

                                    @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- city --}}
                            <div class="col-md-3 col-6 input-group-icon">
                                <i class="fa fa-plane" aria-hidden="true"></i>
                                <label for="city" class="col-form-label text-md-end">{{ __('City*') }}</label>
                                <div class="form-select" id="default-select">
                                    <select name="city"  id="city_list">
                                        <option value="">--Select Any--</option>

                                        @foreach ($cities as $city)
                                        <option value="{{ $city->id }}">{{ $city->name }}</option>
                                        @endforeach                                    
                                    </select>
                                </div>
                            </div>

                            {{-- upazila --}}
                            {{-- <div class="col-md-3 col-6 input-group-icon">
                                <i class="fa fa-plane" aria-hidden="true"></i>
                                <label for="division" class="col-form-label text-md-end">{{ __('Area / Thana*') }}</label>
                                <div class="form-select" id="default-select">
                                    <select name="division" id="division_list">
                                        <option value="">--Select Any--</option>
                                        @foreach ($upazilas as $upazila)
                                        {{ $upazila }}
                                            <option value="{{ $upazila->id }}">{{ $upazila->name }}</option>
                                        @endforeach
                                        </select>
                                </div>
                            </div> --}}
                           
                        </div>
                        <hr>
                        
                        {{-- row 4 --}}
                        <div class="row mb-3">

                            {{-- address --}}
                            <div class="col-md-10 m-auto">
                                <label for="address" class="col-form-label text-md-end">{{ __('Write your address in details*') }} <small>(hospital / area / road etc)</small></label>
                                <div class="">
                                    <textarea id="address" rows="2" class="form-control @error('address') is-invalid @enderror" name="address" required autofocus placeholder="where you need the blood?"> {{ old('address') }} </textarea>

                                    @error('address')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                 
                        </div>
                        <hr>

                        {{-- row 5 --}}
                        <div class="row mt-10">
                            <div class="col-md-10 text-center m-auto">
                                <button type="submit" class="btn btn-danger" style="border-radius: 25px">
                                    {{ __('Send Request') }}
                                </button>
                            </div>
                        </div>
                        {{-- row 6 --}}
                        <div class="row mb-0 mt-4">
                            <div class="col-md-8">
                                <a class="btn-link text-danger text-bold" style="font-size: 15px;" href="{{ route('login') }}">
                                    {{ __('Search For Donors? Click here') }}
                                </a>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
