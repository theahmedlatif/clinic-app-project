@extends('admin.layouts.master')

@section('content')

    <div class="page-header">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">
                    <i class="ik ik-inbox bg-blue"></i>
                    <div class="d-inline">
                        <h5>Doctors</h5>
                        <span>List of All Doctors</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <nav class="breadcrumb-container" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="../index.html"><i class="ik ik-home"></i></a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="#">Doctors</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Index</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-12">
            @if (Session::has('message'))
                <div class="alert bg-success alert-success text-white text-center" role="alert">
                    {{ Session::get('message') }}
                </div>
            @endif
            <div class="card">
                <div class="card-body">
                    <div class="container-fluid">
                        <table id="" class="table-responsive table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th class="nosort">Avatar</th>
                                    <th>Email</th>
                                    <th>City</th>
                                    <th>Phone number</th>
                                    <th>Specialization</th>
                                    <th>Doctor Status</th>
                                    <th class="nosort">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($doctors) > 0)
                                    @foreach ($doctors as $doctor)
                                        <tr>
                                            <td>{{ $doctor->first_name.' '.$doctor->middle_name.' '.$doctor->last_name }}</td>
                                            <td><img src="{{--asset('images') }}/{{ $user->image--}}" class="table-user-thumb"
                                                    alt="">
                                            </td>
                                            <td>{{ $doctor->email }}</td>
                                            <td>{{ $doctor->city }}</td>
                                            <td>{{ $doctor->phone_number }}</td>
                                            <td>{{ $doctor->specialty_name }}</td>
                                            <td>{{$doctor->is_active == 1 ? 'Active' : 'Inactive'}}</td>
                                            <td>

                                                <a href="{{route('admin.edit.doctor', [$doctor->id])}}" class="btn btn-dark"> Edit</a>
                                                @if($doctor->is_active == 1)
                                                <form method="post" action="{{route('admin.hide.doctor')}}">@csrf
                                                    <input type="number" name="doctor_id" value="{{$doctor->id}}" hidden>
                                                    <button type="submit" class="btn btn-danger">
                                                        Delete
                                                    </button>
                                                </form>
                                                @elseif($doctor->is_active == 0)
                                                <form method="post" action="{{route('admin.reactive.doctor')}}">@csrf
                                                    <input type="number" name="doctor_id" value="{{$doctor->id}}" hidden>
                                                    <button type="submit" class="btn btn-success">
                                                        Reactive
                                                    </button>
                                                </form>
                                                @endif
                                                <!-- View Modal -->
                                                @include('admin.doctor.modal')


                                            </td>
                                        </tr>
                                    @endforeach

                                @else
                                    <td>No user to display</td>
                                @endif

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
