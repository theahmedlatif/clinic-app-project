<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Status;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    //
    public function countOfTotalAppointmentsToday($id = null)
    {
        if ($id != null)
        {
            return Appointment::query()
                ->where('date','>=',Carbon::today()->format('o-m-d'))
                ->where('status_id','<>',3)
                ->where('doctor_id','=',$id)
                ->count();
        }
        return Appointment::query()
            ->where('date','>=',Carbon::today()->format('o-m-d'))
            ->where('status_id','<>',3)
            ->whereHas('doctor',function (Builder $query) {
                $query->where('is_active','=','1');
            })
            ->count();
    }

    public function countOfTotalReservedAppointmentsToday($id = null)
    {
        if ($id != null)
        {
            return Appointment::query()
                ->where('date','>=',Carbon::today()->format('o-m-d'))
                ->where('status_id','=',4)
                ->where('doctor_id','=',$id)
                ->count();
        }

        return Appointment::query()
            ->where('date','>=',Carbon::today()->format('o-m-d'))
            ->where('status_id','=',4)
            ->whereHas('doctor',function (Builder $query) {
                $query->where('is_active','=','1');
            })
            ->count();
    }

    public function countOfTotalMissedAppointmentsToday($id = null)
    {
        if ($id != null)
        {
            return Appointment::query()
                ->where('date','>=',Carbon::today()->format('o-m-d'))
                ->where('status_id','=',2)
                ->where('doctor_id','=',$id)
                ->count();
        }
        return Appointment::query()
            ->where('date','>=',Carbon::today()->format('o-m-d'))
            ->where('status_id','=',2)
            ->whereHas('doctor',function (Builder $query) {
                $query->where('is_active','=','1');
            })
            ->count();
    }

    public function countOfTotalFinishedAppointmentsToday($id = null)
    {
        if ($id != null)
        {
            return Appointment::query()
                ->where('date','>=',Carbon::today()->format('o-m-d'))
                ->where('status_id','=',5)
                ->where('doctor_id','=',$id)
                ->count();
        }
        return Appointment::query()
            ->where('date','>=',Carbon::today()->format('o-m-d'))
            ->where('status_id','=',5)
            ->whereHas('doctor',function (Builder $query) {
                $query->where('is_active','=','1');
            })
            ->count();
    }

    public function countOfTotalNewAppointmentsToday()
    {
        return Appointment::query()
            ->where('date','>=',Carbon::today()->format('o-m-d'))
            ->where('status_id','=',5)
            ->where('appointment_type','=','New')
            ->whereHas('doctor',function (Builder $query) {
                $query->where('is_active','=','1');
            })
            ->count();
    }

    public function countOfTotalFollowUpAppointmentsToday()
    {
        return Appointment::query()
            ->where('date','>=',Carbon::today()->format('o-m-d'))
            ->where('status_id','=',5)
            ->where('appointment_type','<>','New')
            ->whereHas('doctor',function (Builder $query) {
                $query->where('is_active','=','1');
            })
            ->count();
    }

    public function incomeToday()
    {
        return Appointment::query()
            ->where('date','>=',Carbon::today()->format('o-m-d'))
            ->where('status_id','=',5)
            ->where('appointment_type','<>','New')
            ->sum('price');
    }

    public function countOfTotalAppointments($start_date,$end_date)
    {
        return Appointment::query()->where('date','>=',$start_date)
            ->where('date','<=',$end_date)->count();
    }

    public function countOfRegisteredPatients()
    {
        return Patient::query()->count();
    }

    public function countOfRegisteredDoctors()
    {
        return Doctor::query()->where('is_active','=',1)->count();
    }

    public function visitsReport(Request $request)
    {
        if ($request->start_date > $request->end_date)
        {
            return redirect()->back()
                ->with('failure','start date must be before end date!')
                ->withInput();
        }


        if ($request->status == 'all')
        {
            $report = Appointment::query()
                ->where('date','>=',$request->start_date)
                ->where('date','<=',$request->end_date)
                ->orderBy('date','desc')
                ->orderBy('start_time','desc')
                ->Paginate(15);
        }
        else
        {
            $report = Appointment::query()
                ->where('date','>=',$request->start_date)
                ->where('date','<=',$request->end_date)
                ->where('status_id','=',$request->status)
                ->orderBy('date','desc')
                ->orderBy('start_time','desc')
                ->Paginate(15);
        }

        $report->appends([
            'status' => $request->status,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date
        ]);

        return view('admin.reports.visits-result',compact('report'));
    }

    public function patientsList()
    {
        return Patient::all();
    }
}
