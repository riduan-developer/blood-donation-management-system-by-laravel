@extends('front_end.app.app')

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

                    <form method="POST" action="{{ route('profile_update_post',$donor->id) }}">
                        @csrf

                        
                        {{-- row 1 --}}
                        <div class="row mb-3 mt-30">

                            {{-- name --}}
                            <div class="col-md-4">
                                <label for="name" class="col-form-label text-md-end">{{ __('Name') }}</label>

                                <div class="">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $donor->name }}" required autocomplete="name" autofocus>

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
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $donor->email }}" required autocomplete="email">

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
                                    <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ $donor->phone }}" required>

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
                            <div class="col-md-2 m-auto input-group-icon">
                                <label for="gender" class="col-form-label text-md-end">{{ __('Gender') }}</label>
                                <div class="form-select" id="default-select">
                                    <select name="gender">
                                        @if ($donor->gender == 'male')
                                        <option value="{{ $donor->gender }}" selected="true">{{ $donor->gender }}</option>
                                        <option value="female">Female</option>
                                        <option value="others">Others</option>    
                                        @elseif($donor->gender == 'female')
                                        <option value="{{ $donor->gender }}" selected="true">{{ $donor->gender }}</option>
                                        <option value="male">Male</option>
                                        <option value="others">Others</option>
                                        @elseif($donor->gender == 'others')
                                        <option value="{{ $donor->gender }}" selected="true">{{ $donor->gender }}</option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                        @endif
                                        
                                    </select>
                                </div>
                            </div>

                            
                            {{-- dob --}}
                            <div class="col-md-2 m-auto">
                                <label for="date" class="col-form-label text-md-end">{{ __('Date of Birth') }}</label>

                                <div class="">
                                    @error('dob')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <input id="dob" type="date" class="form-control @error('dob') is-invalid @enderror" name="dob" value="{{ $donor->DOB }}" required>
                                    
                                </div>
                            </div>

                            {{-- city --}}
                            <div class="col-md-2 m-auto input-group-icon">
                                <i class="fa fa-plane" aria-hidden="true"></i>
                                <label for="city" class="col-form-label text-md-end">{{ __('City') }}</label>
                                <div class="form-select" id="default-select">
                                    <select name="city">
                                        <option value="1" selected="true">Dhaka</option>
                                    </select>
                                </div>
                            </div>

                        </div>
                        <hr>                      
                        
                        {{-- row 3 --}}
                        <div class="row mb-3 mt-30">

                            {{-- address --}}
                            <div class="col-md-8">
                                <label for="address" class="col-form-label text-md-end">{{ __('Area/Street') }}</label>

                                <div class="">
                                    <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ $donor->address }}" required autocomplete="address" autofocus>

                                    @error('address')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>



                        </div>
                        <hr>


                        {{-- HEALTH INFORMATION STARTS --}}

                        <div class="card-header text-center" style="background-color:rgba(0,0,0,0.09);font-weight:bold">{{ __('Health Information') }}</div><br>

                        {{-- row 4 --}}
                        
                        <div class="row mb-3 mt-30">


                            {{-- weight --}}
                            <div class="col-md-2 m-auto">
                                <label for="weight" class="col-form-label text-md-end">{{ __('Your Weight (Kg)') }}</label>

                                <div class="">
                                    <input id="weight" type="text" class="form-control @error('weight') is-invalid @enderror" name="weight" value="{{ $donor->weight }}" required>
                                    @error('weight')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>


                            {{-- height --}}
                            <div class="col-md-2 m-auto">
                                <label for="height" class="col-form-label text-md-end">{{ __('Your Height (feet)') }}</label>

                                <div class="">
                                    <input id="height" type="text" class="form-control @error('height') is-invalid @enderror" name="height"  value="{{ $donor->height }}" required>
                                    @error('height')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>


                            {{-- blood_group --}}
                            <div class="col-md-2 m-auto input-group-icon">
                                    <label for="blood_group" class="col-form-label text-md-end">{{ __('Blood Group') }}</label>
                                <div class="form-select" id="default-select">
                                    <select name="blood_group" value="{{ old('blood_group') }}">
                                        <option value="">Choose your blood group</option>
                                        <option value="1" selected="true">O+</option>
                                        <option value="2">O-</option>
                                    </select>
                                </div>
                            </div>      


                            {{-- bp Report --}}
                            <div class="col-md-2 m-auto input-group-icon">
                                <label for="bp" class="col-form-label text-md-end">{{ __('Blood Pressure') }}</label>
                                <div class="form-select" id="default-select">
                                    <select name="bp" value="">
                                        <option value="{{ $donor->BP }}" selected="true">{{ $donor->BP }}</option>
                                        
                                    </select>
                                </div>
                            </div>
                                                       

                        </div>
                        <hr>
                        
                        {{-- row 5 --}}
                        <div class="row mb-3">

                            {{-- AIDS --}}
                            <div class="col-md-3 m-auto input-group-icon">
                                <label for="blood_group" class="col-form-label text-md-end">{{ __('AIDS') }}</label>
                                <div class="form-select" id="default-select">
                                    <select name="aids" value="">
                                        <option value="{{ $donor->AIDS }}" selected="true">{{ $donor->AIDS }}</option>
                                    </select>
                                </div>
                            </div>


                            {{-- Malaria Report --}}
                            <div class="col-md-3 m-auto input-group-icon">
                                <label for="malaria" class="col-form-label text-md-end">{{ __('Malaria') }}</label>
                                <div class="form-select" id="default-select">
                                    <select name="malaria" value="">
                                        <option value="{{ $donor->malaria }}" selected="true">{{ $donor->malaria }}</option>
                                    </select>
                                </div>
                            </div>
              


                            {{-- Diabetes Report --}}
                            <div class="col-md-3 input-group-icon">
                                <label for="diabetes" class="col-form-label text-md-end">{{ __('Diabetes') }}</label>
                                <div class="form-select" id="default-select">
                                    <select name="diabetes" value="">
                                        <option value="{{ $donor->diabetes }}" selected="true">{{ $donor->diabetes }}</option>
                                    </select>
                                </div>
                            </div>

                           
                        </div>
                        <hr>


                        <div class="row mt-10">
                            <div class="col-md-10 text-center m-auto">
                                <button type="submit" class="btn btn-danger" style="border-radius: 25px">
                                    {{ __('Update') }}
                                </button>
                            </div>
                        </div>

                        <div class="row mb-0 mt-4">
                            <div class="col-md-8">
                                <a class="btn-link text-danger text-bold" style="font-size: 15px;" href="{{ route('profile_view',$donor->id) }}">
                                    {{ __('Return Back') }}
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