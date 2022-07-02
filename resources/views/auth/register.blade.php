@extends('layouts.app')

@section('content')

    <div class="container py-3">
        {{--@if($errors->any())
            @foreach($errors->all() as $error)
                {{$error}}
            @endforeach
        @endif--}}
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">{{ __('Register') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('patient.registration') }}">
                            @csrf

                            <div class="form-group row">
                                <div class="col-md-4">
                                    <label for="first_name">{{ __('First Name') }}</label>
                                    <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror"
                                        name="first_name" value="{{ old('first_name') }}" required autocomplete="name" autofocus>

                                    @error('first_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="col-md-4">
                                    <label for="middle_name">{{ __('Middle Name') }}</label>
                                    <input id="middle_name" type="text" class="form-control @error('middle_name') is-invalid @enderror"
                                           name="middle_name" value="{{ old('middle_name') }}" required autocomplete="name" autofocus>

                                    @error('middle_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="col-md-4">
                                    <label for="last_name">{{ __('Last Name') }}</label>

                                    <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror"
                                           name="last_name" value="{{ old('last_name') }}" required autocomplete="name" autofocus>

                                    @error('last_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">

                                <div class="col-md-4">
                                    <label for="email">{{ __('E-Mail Address') }}</label>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                        name="email" value="{{ old('email') }}" required autocomplete="email">

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="col-md-4">
                                    <label for="password">{{ __('Password') }}</label>
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="new-password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="col-md-4">
                                    <label for="password-confirm">{{ __('Confirm Password') }}</label>

                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>

                            <div class="form-group row">

                                <div class="col-md-4">
                                    <label for="gender">{{ __('Gender') }}</label>
                                    <select name="gender" id="gender"
                                        class="form-control @error('gender') is-invalid @enderror ">
                                        <option value="">
                                            Please select a gender
                                        </option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <label for="city" >{{ __('City') }}</label>

                                    <input id="city" type="text" class="form-control @error('city') is-invalid @enderror"
                                           name="city" value="{{ old('city') }}" required autocomplete="name" autofocus>

                                    @error('city')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="col-md-4">
                                    <label for="phone_number">{{ __('Phone Number') }}</label>
                                    <input id="phone_number" type="number" class="form-control @error('phone_number') is-invalid @enderror"
                                           name="phone_number" value="{{ old('phone_number') }}" required autocomplete="name" autofocus>

                                    @error('phone_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">

                                <div class="col-md-4">
                                    <label for="nid">{{ __('National ID') }}</label>
                                    <input id="nid" type="number" class="form-control @error('nid') is-invalid @enderror"
                                           name="nid" value="{{ old('nid') }}" required autocomplete="name" autofocus>

                                    @error('nid')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>


                                <div class="col-md-4">
                                    <label for="address">{{ __('Address') }}</label>

                                    <input id="address" type="text" class="form-control @error('address') is-invalid @enderror"
                                           name="address" value="{{ old('address') }}" required autocomplete="name" autofocus>

                                    @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="col-md-4">
                                    <label for="date_of_birth">{{ __('Birth Date') }}</label>
                                    <input id="date_of_birth" type="date" class="form-control @error('address') is-invalid @enderror"
                                           name="date_of_birth" value="{{ old('date_of_birth') }}" required autocomplete="name" autofocus>

                                    @error('date_of_birth')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">

                                <div class="col-md-4">
                                    <label for="note">{{ __('Note') }}</label>
                                    <input id="note" type="text" class="form-control @error('note') is-invalid @enderror"
                                           name="note" value="{{ old('note') }}" required autocomplete="name" autofocus>

                                    @error('note')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="col-md-8">
                                    <label></label>
                                    <button type="submit" class="btn btn-primary mt-2 w-100">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
