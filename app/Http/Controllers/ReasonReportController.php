<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\VisitDetail;
use Illuminate\Http\Request;
use App\Models\Visitor;
use App\Models\Staff;
use App\Models\Reason;
use Session;
use Illuminate\Support\Facades\Auth;

class ReasonReportController extends Controller
{
    //

    public function reasonWiseReport()
    {
        $reason_id = Session::get('reason_id');
        // dd($reason_id);
        $reasons = Reason::all();

        $visitorDetails = [];

        if($reason_id!="All"){
            $visitorData = Visitor::whereHas('visit', function ($query) use ($reason_id) {
                $query->where('reason_id', $reason_id);
            })->with(['visit' => function ($query) use ($reason_id) {
                $query->where('reason_id', $reason_id);
            }])->get();
    
            // dd($visitorData);
    
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
        }else{

            $visitorData = Visitor::with('visit')->get();
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
        }

        return view('frontdesk.report.reasonWiseReport',compact('reasons','visitorDetails'));
    }

    public function reasonReportStore(Request $request)
    {
        $reason_id = $request->get('reason_id');
        // dd($reason_id);
        Session::put(['reason_id'=>$reason_id]);

        return redirect(route('reasonWiseReport'));
    }
}
