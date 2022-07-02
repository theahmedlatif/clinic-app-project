@extends('admin.layouts.master')
@section('content')
<script src="{{ asset('js/app.js') }}" defer></script>
<div class="jumbotron bg-white py-2 ps-0">
    <i class="ik ik-monitor ms-0 text-muted fw-bold h3"></i>
    <h2 class="text-muted fw-bold mt-1 d-inline">Welcome Dr. {{auth()->user()->first_name}}</h2>
</div>
<div class="main-content p-0" id="app">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="widget">
                    <div class="widget-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="state">
                                <h6>Available Appointments Today</h6>
                                <h2>{{$figures['countOfTotalAppointmentsToday']}}</h2>
                            </div>
                            <div class="icon">
                                <i class="ik ik-user-check"></i>
                            </div>
                        </div>

                    </div>
                    <div class="progress progress-sm">
                        <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="31" aria-valuemin="0"
                             aria-valuemax="100" style="width: 31%;"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="widget">
                    <div class="widget-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="state">
                                <h6>Reserved Appointments Today</h6>
                                <h2>{{$figures['countOfTotalReservedAppointmentsToday']}}</h2>
                            </div>
                            <div class="icon">
                                <i class="ik ik-message-square"></i>
                            </div>
                        </div>

                    </div>
                    <div class="progress progress-sm">
                        <div class="progress-bar bg-info" role="progressbar" aria-valuenow="20" aria-valuemin="0"
                             aria-valuemax="100" style="width: 20%;"></div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="widget">
                    <div class="widget-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="state">
                                <h6>Missed Appointments Today</h6>
                                <h2>{{$figures['countOfTotalMissedAppointmentsToday']}}</h2>
                            </div>
                            <div class="icon">
                                <i class="ik ik-align-justify"></i>
                            </div>
                        </div>

                    </div>
                    <div class="progress progress-sm">
                        <div class="progress-bar bg-info" role="progressbar" aria-valuenow="20" aria-valuemin="0"
                             aria-valuemax="100" style="width: 20%;"></div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="widget">
                    <div class="widget-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="state">
                                <h6>Finished Appointments Today</h6>
                                <h2>{{$figures['countOfTotalFinishedAppointmentsToday']}}</h2>
                            </div>
                            <div class="icon">
                                <i class="ik ik-home"></i>
                            </div>
                        </div>

                    </div>
                    <div class="progress progress-sm">
                        <div class="progress-bar bg-info" role="progressbar" aria-valuenow="20" aria-valuemin="0"
                             aria-valuemax="100" style="width: 20%;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
