<?php

namespace App\Http\Controllers;
use App\Models\Department;
use App\Models\VisitDetail;
use Illuminate\Http\Request;
use App\Models\Visitor;
use App\Models\Staff;
use Session;
use Illuminate\Support\Facades\Auth;

class dayReportController extends Controller
{
    //
    public function dayWiseReport()
    {
        $from = Session::get('from');
        $to = Session::get('to');
        // dd($from);
        $departments = Department::all();

        $visitorDetails = [];

        $visitorData = Visitor::with('visit')
        ->whereBetween('created_at', [$from, $to])
        ->get();
        $totalCount = $visitorData->count();

        foreach ($visitorData as $visitor) {
            $visitorName = $visitor->name;
            $visitorPhone = $visitor->phone;
            $visitorEmail = $visitor->email;
            $visitorBarCode = $visitor ? $visitor->card_number : null;
            $visitorAddress = $visitor->address;
            $visitorAddress = $visitor->address;
            $visitCheckin = $visitor->visit->check_in;
            $visitorId = $visitor->id;

            // StaffInfo start
            $staffId = $visitor->visit->staff_id;
            $staffInfo = VisitDetail::with('staff')->where('staff_id', $staffId)->first();
            $staffName = $staffInfo ? $staffInfo->staff->name : null;
            // StaffInfo End

            // DepartmentInfo start
            $deptId = $visitor->visit->department_id;
            $deptInfo = VisitDetail::with('department')->where('department_id', $deptId)->first();
            $deptName = $deptInfo ? $deptInfo->department->name : null;
            // DepartmentInfo End

            // ReasonInfo start
            $reasonId = $visitor->visit->reason_id;
            $reasonInfo = VisitDetail::with('reason')->where('reason_id', $reasonId)->first();
            $reasonName = $reasonInfo ? $reasonInfo->reason->name : null;
            // ReasonInfo End

            $details = [
                'visitorBarCode' => $visitorBarCode,
                'visitorName' => $visitorName,
                'visitorPhone' => $visitorPhone,
                'visitorEmail' => $visitorEmail,
                'visitorAddress' => $visitorAddress,
                'deptName' => $deptName,
                'staffName' => $staffName,
                'visitReason' => $reasonName,
                'visitCheckin' => $visitCheckin,
                'id' => $visitorId,
            ];

            $visitorDetails[] = $details;
        }


        return view('frontdesk.report.dayWiseReport',compact('departments','visitorDetails'));
    }

    public function dayReportStore(Request $request)
    {
        $from = $request->get('from');
        $to = $request->get('to');
        // dd($from);
        Session::put(['from'=>$from]);
        Session::put(['to'=>$to]);
        // dd(Session::get('from'));

        return redirect(route('dayWiseReport'));
    }
}
