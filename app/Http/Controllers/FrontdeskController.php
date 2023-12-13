<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\VisitDetail;
use Illuminate\Http\Request;
use App\Models\Visitor;
use App\Models\Staff;
use App\Models\Reason;
use Illuminate\Support\Facades\Auth;


class FrontdeskController extends Controller
{
    //

    public function new_visitor()
    {
        $visitorDetails = [];

        $visitorData = Visitor::with('visit')->where('status', 0)->get();
        $newCount = $visitorData->count();

        foreach ($visitorData as $visitor) {
            $visitorName = $visitor->name;
            $visitorPhone = $visitor->phone;
            $visitorEmail = $visitor->email;
            $visitorAddress = $visitor->address;
            $visitorTime = $visitor->created_at;
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
                'visitorName' => $visitorName,
                'visitorPhone' => $visitorPhone,
                'visitorEmail' => $visitorEmail,
                'visitorAddress' => $visitorAddress,
                'deptName' => $deptName,
                'staffName' => $staffName,
                'reasonName' => $reasonName,
                'visitorTime' => $visitorTime,
                'id' => $visitorId,
            ];

            $visitorDetails[] = $details;
        }

        return view('frontdesk.newVisitorList', compact('visitorDetails', 'newCount'));
    }


    public function total_visitor()
    {
        $visitorDetails = [];

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
                'reasonName' => $reasonName,
                'visitCheckin' => $visitCheckin,
                'id' => $visitorId,
            ];

            $visitorDetails[] = $details;
        }

        return view('frontdesk.totalVisitorList', compact('visitorDetails', 'totalCount'));
    }

    public function dashboard()
    {
        $vcount = Visitor::count();
        // dd($vcount);
        $newCount = Visitor::where('status', 0)->count();

        $qualityCount = VisitDetail::where('department_id',3)->count();
        $designCount = VisitDetail::where('department_id',1)->count();

        return view('frontdesk.dashboard',compact('vcount','newCount','qualityCount','designCount'));
    }

    public function application_details($id)
    {
        
    
        return view('frontdesk.applicationDetails');

    }
    public function new_visitor_add()
    {
        $department= Department::all();
        $staffs = Staff::all();
        $reasons = Reason::all();
        return view('frontdesk.addNewVisitor',compact('department','staffs','reasons'));
    }

    public function final_approve(Request $request)
    {
        $request->validate([
            'visitor_id' => 'required|numeric',
            'card_number' => 'required|string',
        ]);
    
        $visitorId = $request->input('visitor_id');
        $cardNumber = $request->input('card_number');
    
        $visitor = Visitor::find($visitorId);
    
        if (!$visitor) {
            return redirect()->back()->with('error', 'Visitor not found');
        }
    
        $visitInfo = VisitDetail::where('visitor_id', $visitorId)->first();
   
        if ($visitInfo) {
            $visitInfo->update([
                'check_in' => now(),
            ]);
        }
    

        $visitor->update([
            'status' => 1,
            'card_number' => $cardNumber,
        ]);
    
        return redirect()->back()->with('success', 'Visitor approved and checked-in successfully');
    }
    

    public function department_list()
    {
        $department= Department::all();
        $deptCount = $department->count();
        return view('frontdesk.departmentList',compact('deptCount','department'));
    }

    public function new_department_add()
    {
        return view('frontdesk.addNewDept');
    }

    public function deptStore(Request $request)
    {
        try {
            $deptName = $request->input('name');
            
            $dept = new Department;
            $dept->name = $deptName;
            $dept->save();

            return redirect(route('department_list'))->with('success_message', 'New Department added Successfully.');
        } catch (\Exception $e) {
            \Log::error('Error saving department: ' . $e->getMessage());
            return redirect()->back()->with('error_message', 'Sorry, something went wrong. Please try again.');
        }
    }
    
    public function department_delete($id)
    {

        $dept = Department::find($id);
        $dept->delete();
        return redirect()->route('department_list')->with('success_message', 'Department deleted successfully.');
    }

    public function deptUpdate(Request $request)
    {
        $deptId = $request->input('department_id');
        // dd($deptId);
        $deptName = $request->input('name');
        // dd($deptName);
        $depfInfo = Department::find($deptId);
        // dd($depfInfo);

        $depfInfo->update([
            'name' => $deptName,
        ]);
        return redirect()->route('department_list')->with('success_message', 'Department updated successfully.');


    }

    public function staff_list()
    {
        $staffDetails = [];

        $staffData = Staff::with('department')->get();
        $staffCount = $staffData->count();

        foreach ($staffData as $staff) {
            $staffName = $staff->name;
            $departmentName = $staff->department->name;
            $staffId = $staff->id;

            $details = [
                'staffName' => $staffName,
                'departmentName' => $departmentName,
                'id' => $staffId,
            ];
            $staffDetails[] = $details;
        }

        return view('frontdesk.staffList', compact('staffDetails', 'staffCount'));
    }


    public function staff_delete($id)
    {

        $staff = Staff::find($id);
        $staff->delete();
        return redirect()->route('staff_list')->with('success_message', 'Staff deleted successfully.');
    }

    public function new_staff_add()
    {
        $department= Department::all();

        return view('frontdesk.addNewStaff',compact('department'));
    }

    public function staffStore(Request $request)
    {
        try {
            $deptId = $request->input('department_id');
            $staffName = $request->input('name');
            
            $staff = new Staff;
            $staff->department_id = $deptId;
            $staff->name = $staffName;
            $staff->save();

            return redirect(route('staff_list'))->with('success_message', 'New Staff added successfully.');
        } catch (\Exception $e) {
            \Log::error('Error saving department: ' . $e->getMessage());
            return redirect()->back()->with('error_message', 'Sorry, something went wrong. Please try again.');
        }
    }

    public function staffUpdate(Request $request)
    {
        $staffId = $request->input('staff_id');
        // dd($staffId);
        $staffName = $request->input('name');
        // dd($staffName);
        $staffInfo = Staff::find($staffId);
        // dd($staffInfo);

        $staffInfo->update([
            'name' => $staffName,
        ]);
        return redirect()->route('staff_list')->with('success_message', 'Staff updated successfully.');


    }

    public function reason_list()
    {
        $reasons= Reason::all();
        $reasonCount = $reasons->count();
        return view('frontdesk.reasonList',compact('reasonCount','reasons'));
    }
    public function reason_delete($id)
    {

        $reason = Reason::find($id);
        $reason->delete();
        return redirect()->route('reason_list')->with('success_message', 'Reason deleted successfully.');
    }

    public function reasonUpdate(Request $request)
    {
        $reasonId = $request->input('reason_id');
        // dd($reasonId);
        $reasonName = $request->input('name');
        // dd($reasonName);
        $reasonInfo = Reason::find($reasonId);
        // dd($reasonInfo);

        $reasonInfo->update([
            'name' => $reasonName,
        ]);
        return redirect()->route('reason_list')->with('success_message', 'Reason updated successfully.');


    }

    public function new_reason_add()
    {
        return view('frontdesk.addNewReason');
    }

    public function reasonStore(Request $request)
    {
        try {
            $reasonName = $request->input('name');
            
            $reason = new Reason;
            $reason->name = $reasonName;
            $reason->save();

            return redirect(route('reason_list'))->with('success_message', 'New Reason added successfully.');
        } catch (\Exception $e) {
            \Log::error('Error saving department: ' . $e->getMessage());
            return redirect()->back()->with('error_message', 'Sorry, something went wrong. Please try again.');
        }
    }


    
}
