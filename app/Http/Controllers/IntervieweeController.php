<?php

namespace App\Http\Controllers;

use App\Models\Interviewee;
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
        $path = $request->file('csv_file')->getRealPath();
        $row_index = file($request->file('csv_file'), FILE_SKIP_EMPTY_LINES);
        $data = array_map('str_getcsv', file($path));
        $csv_data = array_slice($data, 1, count($row_index));

        $currentDate = Carbon::now()->format('Ymd');

        $counter = 1;

        foreach ($csv_data as $key => $value) {
            $visitorName = $value[0];
            $phone = $value[1];
            $nid = $value[2];
            $purpose = $value[3];

            $barCode = $nid .. 'IN' . str_pad($counter, 4, '0', STR_PAD_LEFT);

            $counter++;

            $data1['name'] = $visitorName;
            $data1['phone'] = $phone;
            $data1['nid'] = $nid;
            $data1['purpose'] = $purpose;
            $data1['bar_code'] = $barCode;

            Interviewee::create($data1);
        }

        return redirect()->route('interviewee_registration')->with('success_message', 'Interviewees registered successfully.');
    }


}
