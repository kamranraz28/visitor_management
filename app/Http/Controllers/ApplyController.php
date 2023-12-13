<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\Staff;
use App\Models\Visitor;
use App\Models\Reason;
use App\Models\VisitDetail;
use Illuminate\Support\Facades\Redirect;

class ApplyController extends Controller
{
    //
    public function apply()
    {
        $department= Department::all();
        $staffs = Staff::all();
        $reasons = Reason::all();
        return view('frontend.applyForm',compact('department','staffs','reasons'));
    }

    public function applyStore(Request $request)
{
    try {
        $visitor = new Visitor();

        $visitor->name = $request->name;
        $visitor->phone = $request->phone;
        $visitor->email = $request->email;
        $visitor->address = $request->address;

        $visitor->save();
        
        $visitorId = $visitor->id;

        $visit = new VisitDetail();

        $visit->visitor_id = $visitorId;
        $visit->department_id = $request->department;
        $visit->staff_id = $request->staff;
        $visit->reason_id = $request->reason;

        $visit->save();

        return Redirect::back()->with('success_message', 'Your application has been submitted.');
    } catch (\Exception $e) {
        return Redirect::back()->with('error_message', 'Sorry, something is wrong. Please try again.');
    }
}


}
