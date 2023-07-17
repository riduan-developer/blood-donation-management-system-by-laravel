@extends('front_end.app.app_auth')
@section('main')
<div class="container" style="margin-top: 5rem; margin-bottom:5rem;">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                
                @foreach ($errors->all() as $error)
                    {{ $error }}
                @endforeach
                <div class="card-body">

                    {{-- PERSONAL INFORMATION STARTS --}}
                    <div class="card-header text-center" style="background-color:rgba(0,0,0,0.09); font-weight:bold">{{ __('Personal Information') }}</div><br>

                    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                        @csrf

                        
                        {{-- row 1 --}}
                        <div class="row mb-3 mt-30">

                            {{-- name --}}
                            <div class="col-md-4">
                                <label for="name" class="col-form-label text-md-end">{{ __('Name') }}</label>

                                <div class="">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- email --}}
                            <div class="col-md-4">
                                <label for="email" class="col-form-label text-md-end">{{ __('Email Address') }}</label>

                                <div class="">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- phone --}}
                            <div class="col-md-4">
                                <label for="phone" class="col-form-label text-md-end">{{ __('Phone Number') }}</label>

                                <div class="">
                                    <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required>

                                    @error('phone')
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

                            {{-- gender --}}
                            <div class="col-md-32 m-auto input-group-icon">
                                <label for="gender" class="col-form-label text-md-end">{{ __('Gender') }}</label>
                                <div class="form-select" id="default-select">
                                    <select name="gender">
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                        <option value="others">Others</option>
                                    </select>
                                </div>
                            </div>

                            
                            {{-- dob --}}
                            <div class="col-md-3 m-auto">
                                <label for="date" class="col-form-label text-md-end">{{ __('Date of Birth') }}</label>

                                <div class="">
                                    @error('dob')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <input id="dob" type="date" class="form-control @error('dob') is-invalid @enderror" name="dob" value="{{ old('dob') }}" required>
                                    
                                </div>
                            </div>


                            {{-- division --}}
                            {{-- <div class="col-md-2 m-auto input-group-icon">
                                <i class="fa fa-plane" aria-hidden="true"></i>
                                <label for="division" class="col-form-label text-md-end">{{ __('Division') }}</label>
								<div class="form-select" id="default-select">
                                    <select name="division">
                                        <option value="1" selected="true">Division</option>
                                       
									</select>
								</div>
							</div> --}}

                            {{-- city --}}
                            <div class="col-md-3 m-auto input-group-icon">
                                <i class="fa fa-plane" aria-hidden="true"></i>
                                <label for="city" class="col-form-label text-md-end">{{ __('City') }}</label>
                                <div class="form-select" id="default-select">
                                    <select name="city">
                                        @foreach ($cities as $city)
                                        <option value="{{ $city->id }}" selected="true">{{ $city->name }}</option>
                                            
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                        </div>
                        <hr>                      
                        
                        {{-- row 3 --}}
                        <div class="row mb-3 mt-30">

                            {{-- address --}}
                            <div class="col-md-6">
                                <label for="address" class="col-form-label text-md-end">{{ __('Area/Street') }}</label>

                                <div class="">
                                    <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" required autocomplete="address" autofocus>

                                    @error('address')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>


                            {{-- password --}}
                            <div class="col-md-4">
                                <label for="password" class="col-form-label text-md-end">{{ __('Password') }}</label>
                                <div>
                                    <input id="password" type="password" class="form-control" name="password" required>
                                </div>
                            </div>

                        </div>
                        <hr>


                        {{-- HEALTH INFORMATION STARTS --}}

                        <div class="card-header text-center" style="background-color:rgba(0,0,0,0.09);font-weight:bold">{{ __('Health Information') }}</div><br>

                        {{-- row 4 --}}
                        
                        <div class="row mb-3 mt-30">


                            {{-- weight --}}
                            <div class="col-md-3 m-auto">
                                <label for="weight" class="col-form-label text-md-end">{{ __('Your Weight (Kg)') }}</label>

                                <div class="">
                                    <input id="weight" type="text" class="form-control @error('weight') is-invalid @enderror" name="weight" value="{{ old('weight') }}" required>
                                    @error('weight')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>


                            {{-- height --}}
                            <div class="col-md-3 m-auto">
                                <label for="height" class="col-form-label text-md-end">{{ __('Your Height (feet)') }}</label>

                                <div class="">
                                    <input id="height" type="text" class="form-control @error('height') is-invalid @enderror" name="height"  value="{{ old('height') }}" required>
                                    @error('height')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>


                            {{-- blood_group --}}
                            <div class="col-md-3 m-auto input-group-icon">
                                    <label for="blood_group" class="col-form-label text-md-end">{{ __('Blood Group') }}</label>
                                <div class="form-select" id="default-select">
                                    <select name="blood_group" value="{{ old('blood_group') }}">
                                        <option value="">Choose blood group</option>
                                        @foreach ($bloods as $blood)
                                            <option value="{{ $blood->id }}">{{ $blood->blood_group }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>      

                        </div>
                        
                            

                        <hr>
                        
                        {{-- row 5 --}}
                        <div class="row mb-3">
                            {{-- bp Report --}}
                            <div class="col-md-2 input-group-icon">
                                <label for="bp" class="col-form-label text-md-end">{{ __('Blood Pressure') }}</label>
                                <div class="form-select" id="default-select">
                                    <select name="bp" value="{{ old('bp') }}">
                                        <option value="normal" selected="true">Normal</option>
                                        <option value="low">Low</option>
                                        <option value="high">High</option>
                                        
                                    </select>
                                </div>
                            </div>
                                                       
                            {{-- Diabetes Report --}}
                            <div class="col-md-3 input-group-icon">
                                <label for="diabetes" class="col-form-label text-md-end">{{ __('Diabetes') }}</label>
                                <div class="form-select" id="default-select">
                                    <select name="diabetes" value="{{ old('diabetes') }}">
                                        <option value="normal" selected="true">Normal</option>
                                        <option value="medium">Medium</option>
                                        <option value="high">High</option>
                                    </select>
                                </div>
                            </div>

                           
                        </div>
                        <hr>


                        <div class="row mt-10">
                            <div class="col-md-10 text-center m-auto">
                                <button type="submit" class="btn btn-danger" style="border-radius: 25px">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>

                        <div class="row mb-0 mt-4">
                            <div class="col-md-8">
                                <a class="btn-link text-danger text-bold" style="font-size: 15px;" href="{{ route('login') }}">
                                    {{ __('Already a User? Log in?') }}
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
