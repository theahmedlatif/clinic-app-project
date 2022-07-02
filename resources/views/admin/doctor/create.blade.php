@extends('admin.layouts.master')

@section('content')
    <div class="page-header mb-2 mt-0">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">
                    <i class="ik ik-command bg-blue"></i>
                    <div class="d-inline">
                        <h5>Doctors</h5>
                        <span>add doctor</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <nav class="breadcrumb-container" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{route('home')}}"><i class="ik ik-home"></i></a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Admin</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            <a href="{{route('admin.add.doctor')}}" class="breadcrumb-item active">Add New Doctor</a>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-12">
            @if (Session::has('message'))
                <div class="alert bg-success alert-success text-white text-center" role="alert">
                    {{ Session::get('message') }}
                </div>
            @endif

            <div class="card">
                <div class="card-body">
                    <form class="forms-sample" action="{{ route('admin.add.doctor') }}" method="post"
                        enctype="multipart/form-data">@csrf
                        <div class="row">
                            <div class="col-lg-4">
                                <label for="first_name">First Name</label>
                                <input id="first_name" type="text" name="first_name" class="form-control @error('first_name') is-invalid @enderror"
                                    value="{{ old('first_name') }}">
                                @error('first_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-lg-4">
                                <label for="middle_name">Middle Name</label>
                                <input id="middle_name" type="text" name="middle_name" class="form-control @error('middle_name') is-invalid @enderror"
                                       value="{{ old('middle_name') }}">
                                @error('middle_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="col-lg-4">
                                <label for="last_name">Last Name</label>
                                <input id="last_name" type="text" name="last_name" class="form-control @error('last_name') is-invalid @enderror"
                                       value="{{ old('last_name') }}">
                                @error('last_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-lg-4">
                                <label for="email">Email</label>
                                <input id="email" type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                       value="{{ old('email') }}">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="col-lg-4">
                                <label for="password">Password</label>
                                <input id="password" type="password" name="password"
                                    class="form-control @error('password') is-invalid @enderror">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="col-lg-4">
                                <label for="password-confirm">Confirm Password</label>
                                <input id="password-confirm" type="password" class="form-control @error('password') is-invalid @enderror"
                                       name="password_confirmation" autocomplete="new-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-lg-4">
                                <label for="gender">Gender</label>
                                <select id="gender" class="form-control @error('gender') is-invalid @enderror" name="gender">
                                    @if(old('gender') != null)
                                        <option value="{{old('gender')}}" selected>{{ucfirst(old('gender'))}}</option>
                                        <option value="{{old('gender') == 'male'? 'Female' : old('gender')}}">
                                            {{old('gender') == 'male'? 'Female' : ucfirst(old('gender'))}}
                                        </option>
                                    @else
                                        <option value="" selected>select</option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                    @endif
                                </select>
                                @error('gender')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="col-lg-4">
                                <label for="city">City</label>
                                <input id="city" type="text" name="city"
                                    class="form-control @error('city') is-invalid @enderror"
                                    placeholder="city name" value="{{ old('city') }}">
                                @error('city')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>Image</label>
                                    <input type="file"
                                           class="form-control file-upload-info @error('image') is-invalid @enderror"
                                           placeholder="Upload Image" name="image">
                                    <span class="input-group-append">

                                    </span>
                                    @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="nid">National ID</label>
                                    <input id="nid" type="number" name="nid"
                                           class="form-control @error('nid') is-invalid @enderror"
                                           value="{{ old('nid') }}">
                                    @error('nid')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="phone_number">Phone number</label>
                                    <input id="phone_number" type="text" name="phone_number"
                                        class="form-control @error('phone_number') is-invalid @enderror"
                                        value="{{ old('phone_number') }}">
                                    @error('phone_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="specialty">Specialty</label>

                                    <select id ="specialty" class="form-control @error('specialty') is-invalid @enderror" name="specialty">
                                        <option value="{{ old('specialty') }}">select</option>
                                        @foreach($specialities as $specialty)
                                            @if($specialty->id == old('specialty'))
                                                <option value="{{$specialty->id}}" selected>{{$specialty->specialty_name}}</option>
                                            @else
                                                <option value="{{$specialty->id}}">{{$specialty->specialty_name}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @error('specialty')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="medical_title">Medical Title</label>
                                    <select id ="medical_title" class="form-control @error('medical_title') is-invalid @enderror" name="medical_title">
                                        @foreach($titles as $title)
                                                @if($title->id == old('medical_title'))
                                                    <option value="{{$title->id}}" selected>{{$title->title_name}}</option>
                                                @else
                                                    <option value="{{$title->id}}">{{$title->title_name}}</option>
                                                @endif
                                        @endforeach
                                    </select>
                                    @error('medical_title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="bio">Bio</label>
                            <textarea class="form-control @error('bio') is-invalid @enderror" id="bio"
                                rows="2" name="bio">{{ old('bio') }}
                            </textarea>
                            @error('bio')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary mr-2 w-100">Submit</button>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @if($errors->any())
        @foreach($errors->all() as $error)
            {{$error}}
        @endforeach
    @endif

@endsection
