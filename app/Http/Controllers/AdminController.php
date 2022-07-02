<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Receptionist;
use App\Models\Status;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function patientsReport()
    {
        $patientsList = new ReportController();
        $patients = $patientsList->patientsList();
        return view('admin.reports.patients',compact('patients'));
    }

    public function visitsReportView()
    {
        $statuses = Status::all(['id','status_name']);
        return view('admin.reports.visits',compact('statuses'));
    }

    public function viewDoctors()
    {
        $doctors_list = new DoctorController();
        $doctors = $doctors_list->getDoctorsList();
        return view('admin.doctor.index', compact('doctors'));
    }

    public function appointmentEditForm()
    {
        return view('admin.appointment.confirm');
    }

}
