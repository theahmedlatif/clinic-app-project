<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Specialty;
use App\Models\Title;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class DoctorController extends Controller
{
    public function create()
    {
        $titles = Title::get(['id','title_name']);
        $specialities = Specialty::get(['id','specialty_name']);
        return view('admin.doctor.create',compact('titles','specialities'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'first_name' => 'required|max:100|alpha',
            'middle_name' => 'required|max:100|alpha',
            'last_name' => 'required|max:100|alpha',
            'email' => 'required|unique:users|max:200|email:rfc,dns',
            'city' => 'required|max:100|alpha',
            'phone_number' => 'required|unique:users|digits_between:7,13|max:50',
            'nid' => 'required|unique:users|digits:14',
            'gender' => 'required|in:male,female',
            'password' => 'required|confirmed|min:8',

            'specialty' => 'required|exists:specialties,id',
            'medical_title' => 'required|exists:titles,id',
            'bio' => 'required|min:10|max:2000',

        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.add.doctor')
                ->withErrors($validator)
                ->withInput();
        }

        $user = User::create([
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'city' => $request->city,
            'gender' => $request->gender,
            'phone_number' => $request->phone_number,
            'nid' => $request->nid,
            'role_id' => 2,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $doctor = Doctor::create([
            'user_id' => $user->id,
            'specialty_id' => $request->specialty,
            'title_id' => $request->medical_title,
            'bio' => $request->bio,
        ]);
        return redirect()->route('admin.add.doctor')->with('success','Doctor Added Successfully!');
    }

    public function edit($id)
    {
        $doctor = Doctor::query()->where('id','=',$id)->first();
        $specialties = Specialty::all();
        $titles = Title::all();
        return view('admin.doctor.edit',compact('doctor','specialties','titles'));
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'first_name' => 'nullable|max:100|alpha',
            'middle_name' => 'nullable|max:100|alpha',
            'last_name' => 'nullable|max:100|alpha',
            'email' => 'nullable|unique:users|max:200|email:rfc,dns',
            'city' => 'nullable|max:100|alpha',
            'phone_number' => 'nullable|unique:users|digits_between:7,13|max:50',
            'nid' => 'nullable|unique:users|digits:14',
            'gender' => 'nullable|in:male,female',
            'password' => 'nullable|confirmed|min:8',

            'specialty' => 'nullable|exists:specialties,id',
            'medical_title' => 'nullable|exists:titles,id',
            'bio' => 'nullable|min:10|max:2000',

        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $doctor = Doctor::find($request->doctor_id);

        $user = User::find($doctor->user_id);

        $user_updated_attributes = 0;

        isset($request->first_name) ? $user->first_name = $request->first_name : $user_updated_attributes++;
        isset($request->middle_name) ? $user->middle_name = $request->middle_name : $user_updated_attributes++;
        isset($request->last_name) ? $user->last_name = $request->last_name : $user_updated_attributes++;
        isset($request->city) ? $user->city = $request->city : $user_updated_attributes++;
        isset($request->gender) ? $user->gender = $request->gender : $user_updated_attributes++;
        isset($request->phone_number) ? $user->phone_number = $request->phone_number : $user_updated_attributes++;
        isset($request->nid) ? $user->nid = $request->nid : $user_updated_attributes++;
        isset($request->email) ? $user->email = $request->email : $user_updated_attributes++;
        isset($request->password) ? $user->password = Hash::make($request->password) : $user_updated_attributes++;

        $user->save();

        $doctor_updated_attributes = 0;
        isset($request->specialty) ? $doctor->specialty_id = $request->specialty : $doctor_updated_attributes++;
        isset($request->medical_title) ? $doctor->title_id = $request->medical_title : $doctor_updated_attributes++;
        isset($request->bio) ? $doctor->bio = $request->bio : $doctor_updated_attributes++;

        $doctor->save();

        return redirect()->route('admin.edit.doctor',$doctor->id);
    }


    public function getDoctorsList()
    {
        $doctors = [];
        if (!isset(Auth::user()->role->role_name))
        {
            $doctors= DB::table('doctors')
                ->leftjoin('users','doctors.user_id','=','users.id')
                ->leftJoin('specialties','doctors.specialty_id','=','specialties.id')
                ->leftJoin('titles','doctors.title_id','=','titles.id')
                ->select('doctors.id',
                    'doctors.user_id',
                    'users.first_name',
                    'users.middle_name',
                    'users.last_name',
                    'users.city',
                    'users.gender',
                    'users.phone_number',
                    'users.email',
                    'doctors.bio',
                    'specialties.specialty_name',
                    'titles.title_name')
                ->where('is_active','=',1)
                ->get();
        }
        else
        {
            if(Auth::user()->role->role_name == 'patient')
            {

                $doctors= DB::table('doctors')
                    ->leftjoin('users','doctors.user_id','=','users.id')
                    ->leftJoin('specialties','doctors.specialty_id','=','specialties.id')
                    ->leftJoin('titles','doctors.title_id','=','titles.id')
                    ->select('doctors.id',
                        'doctors.user_id',
                        'users.first_name',
                        'users.middle_name',
                        'users.last_name',
                        'users.city',
                        'users.gender',
                        'users.phone_number',
                        'users.email',
                        'doctors.bio',
                        'specialties.specialty_name',
                        'titles.title_name')
                    ->where('is_active','=',1)
                    ->get();
            }
            else
            {

                $doctors= DB::table('doctors')
                    ->leftjoin('users','doctors.user_id','=','users.id')
                    ->leftJoin('specialties','doctors.specialty_id','=','specialties.id')
                    ->leftJoin('titles','doctors.title_id','=','titles.id')
                    ->select('doctors.id',
                        'doctors.user_id',
                        'users.first_name',
                        'users.middle_name',
                        'users.last_name',
                        'users.city',
                        'users.gender',
                        'users.phone_number',
                        'users.email',
                        'doctors.bio',
                        'doctors.is_active',
                        'specialties.specialty_name',
                        'titles.title_name')
                    ->get();
            }
        }

        //$doctor_data = Session::push('doctor_data',$doctor_list);
        //return Session::get('doctor_data');
        //dd($doctors);
        return $doctors;
    }

    public function hide(Request $request)
    {
        $doctor = Doctor::query()->where('id','=',$request->doctor_id)->first();
        $doctor->is_active = 0;
        $doctor->save();
        return redirect()->route('admin.view.doctors')->with('success','Dr. '.$doctor->user->first_name.' '.$doctor->user->middle_name.' '.$doctor->user->last_name.' is removed successfully');
    }

    public function reactive(Request $request)
    {
        $doctor = Doctor::query()->where('id','=',$request->doctor_id)->first();
        $doctor->is_active = 1;
        $doctor->save();
        return redirect()->route('admin.view.doctors')->with('success','Dr. '.$doctor->user->first_name.' '.$doctor->user->middle_name.' '.$doctor->user->last_name.' is removed successfully');
    }

    public function getDoctorData($id)
    {
        $doctors_list = DB::table('doctors')
            ->leftjoin('users','doctors.user_id','=','users.id')
            ->leftJoin('specialties','doctors.specialty_id','=','specialties.id')
            ->leftJoin('titles','dctors.medical_title_id','=','titles.id')
            ->select('doctors.id',
                'doctors.user_id',
                'users.first_name',
                'users.middle_name',
                'users.last_name',
                'users.governorate',
                'users.city',
                'users.gender',
                'users.phone_number',
                'users.email',
                'doctors.bio',
                'specialties.specialty_name',
                'titles.title_name')
            ->where('doctors.id','=',$id)
            ->get()->first();

        return view('test.list',compact('doctors_list',));
    }

    public function viewDoctor($id)
    {
        $doctor = $this->getDoctorData($id);
        return view('test doctor profile',compact('doctor'));
    }

    public function viewMyUpcomingReservedVisits()
    {
        $doctor_id = Auth::user()->doctor->id;
        $appointments =  Appointment::where('doctor_id',$doctor_id)
            ->where('date','>=',Carbon::today('Africa/Cairo')->format('o-m-d'))
            ->where('status_id','=',4)
            ->orderBy('date','asc')
            ->orderBy('start_time','asc')
            ->get();
        $doctor = Doctor::where('id',$doctor_id)->get();
        //dd($appointments);
        return view('admin.doctor.view-my-reserved-visits',compact('appointments','doctor'));
    }

    public function viewMyUpcomingVisits()
    {
        $doctor_id = Auth::user()->doctor->id;
        $appointments =  Appointment::where('doctor_id',$doctor_id)
            ->where('date','>=',Carbon::today('Africa/Cairo')->format('o-m-d'))
            ->where('status_id','<>',3)
            ->orderBy('date','asc')
            ->orderBy('start_time','asc')
            ->get();
        $doctor = Doctor::where('id',$doctor_id)->get();
        //dd($appointments);
        return view('admin.doctor.view-my-available-visits',compact('appointments','doctor'));
    }

    public function viewMyPreviousReservedVisits()
    {
        $doctor_id = Auth::user()->doctor->id;
        $appointments =  Appointment::where('doctor_id',$doctor_id)
            ->where('date','<',Carbon::today('Africa/Cairo')->format('o-m-d'))
            ->where('patient_id','<>',null)
            ->orderBy('date','desc')
            ->orderBy('start_time','desc')
            ->get();
        $doctor = Doctor::where('id',$doctor_id)->get();
        //dd($appointments);
        return view('admin.doctor.view-my-reserved-visits',compact('appointments','doctor'));
    }

    public function viewMyPreviousVisits()
    {
        $doctor_id = Auth::user()->doctor->id;
        $appointments =  Appointment::where('doctor_id',$doctor_id)
            ->where('date','<',Carbon::today('Africa/Cairo')->format('o-m-d'))
            ->orderBy('date','desc')
            ->orderBy('start_time','desc')
            ->get();
        $doctor = Doctor::where('id',$doctor_id)->get();
        //dd($appointments);
        return view('admin.doctor.view-my-available-visits',compact('appointments','doctor'));
    }


    public function viewPatientAppointment($appointment_id)
    {
        $patientAppointment = new AppointmentController();
        $patientAppointmentDetails = $patientAppointment->getAppointment($appointment_id);
        if ($patientAppointmentDetails != null)
        {
            $patient = new PatientController();
            $patientDetails = $patient->getPatient($patientAppointmentDetails->patient_id);

            $patientPreviousVisits = $patientAppointment->getPatientAppointments($patientAppointmentDetails->patient_id);

            $records = new RecordController();
            $patientRecords = $records->getPatientRecords($patientDetails->id);
            //dd($patientDetails->date_of_birth);
            return view('booking.doctor-view',compact('patientAppointmentDetails','patientDetails','patientRecords', 'patientPreviousVisits'));
        }
        return view('booking.doctor-view')->with('failure','Appointment Not Found');
    }

}
