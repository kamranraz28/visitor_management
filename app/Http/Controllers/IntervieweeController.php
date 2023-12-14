<?php

namespace App\Http\Controllers;

use App\Models\Interviewee;
use App\Models\Worker;
use Illuminate\Http\Request;
use Carbon\Carbon;

class IntervieweeController extends Controller
{
    //
    public function interviewee_registration()
    {
        return view('frontdesk.intervieweeRegistration');
    }


    public function intervieweeStore(Request $request)
    {
        $userType= $request->input('option');
        // dd($userType);

        $path = $request->file('csv_file')->getRealPath();
        $row_index = file($request->file('csv_file'), FILE_SKIP_EMPTY_LINES);
        $data = array_map('str_getcsv', file($path));
        $csv_data = array_slice($data, 1, count($row_index));

        $currentDate = Carbon::now()->format('Ymd');

        if($userType== 'interviewee')
        {

        foreach ($csv_data as $key => $value) {
            $visitorName = $value[0];
            $phone = $value[1];
            $nid = $value[2];
            $purpose = $value[3];

            $barCode = $currentDate . 'IN'. 0;

            $data1['name'] = $visitorName;
            $data1['phone'] = $phone;
            $data1['nid'] = $nid;
            $data1['purpose'] = $purpose;

            $interviewee = Interviewee::create($data1);

            $barCode .= $interviewee->id;

            $interviewee->update(['bar_code' => $barCode]);
        }
    }else{ 
        foreach ($csv_data as $key => $value) {
            $visitorName = $value[0];
            $phone = $value[1];
            $nid = $value[2];
            $purpose = $value[3];

            $barCode = $currentDate . 'WK'. 0;

            $data1['name'] = $visitorName;
            $data1['phone'] = $phone;
            $data1['nid'] = $nid;
            $data1['purpose'] = $purpose;

            $worker = Worker::create($data1);

            $barCode .= $worker->id;

            $worker->update(['bar_code' => $barCode]);
        }

    }

        return redirect()->route('interviewee_registration')->with('success_message', 'Registered successfully.');
    }


    public function interviewee_list()
    {
        $interInfo = Interviewee::all();
        return view('frontdesk.intervieweeList',compact('interInfo'));
    }

}
