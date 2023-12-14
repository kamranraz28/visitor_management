<?php

namespace App\Http\Controllers;

use App\Models\Worker;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Milon\Barcode\DNS1D;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class WorkerController extends Controller
{
    //
    public function worker_registration()
    {
        return view('frontdesk.workerRegistration');
    }


    public function workerStore(Request $request)
{
    $path = $request->file('csv_file')->getRealPath();
    $row_index = file($request->file('csv_file'), FILE_SKIP_EMPTY_LINES);
    $data = array_map('str_getcsv', file($path));
    $csv_data = array_slice($data, 1, count($row_index));

    $currentDate = Carbon::now()->format('Ymd');

    foreach ($csv_data as $key => $value) {
        $visitorName = $value[0];
        $phone = $value[1];
        $nid = $value[2];
        $purpose = $value[3];

        $barCode = $currentDate . 'WK';

        $data1['name'] = $visitorName;
        $data1['phone'] = $phone;
        $data1['nid'] = $nid;
        $data1['purpose'] = $purpose;

        $worker = Worker::create($data1);

        $barCode .= $worker->id;

        // Generate barcode image and save it
        $barcode = new DNS1D();
        $barcode->setStorPath(storage_path('app/barcodes/'));
        $barcodeImageName = $barCode . '.png';
        $barcodeImagePath = 'barcodes/' . $barcodeImageName;
        $barcode->getBarcodePNG($barCode, 'C39', 2, 33, array(1, 1, 1), true);

        // Store the barcode image in the public disk
        Storage::disk('public')->put($barcodeImagePath, file_get_contents($barcodeImagePath));

        // Update Worker with the generated barcode and barcode image
        $worker->update(['bar_code' => $barCode, 'barcode_image' => $barcodeImagePath]);
    }

    return redirect()->route('worker_registration')->with('success_message', 'Workers registered successfully.');
}
 
}
