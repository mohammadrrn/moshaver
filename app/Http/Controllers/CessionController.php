<?php

namespace App\Http\Controllers;

use App\Models\Cession;
use App\Models\EstateRequest;
use Illuminate\Http\Request;

class CessionController extends Controller
{
    public function report($estateRequestId)
    {
        $checkExist = EstateRequest::findOrFail($estateRequestId);
        if ($checkExist) {
            $check = Cession::where('estate_request_id', $estateRequestId)->first();
            if (!$check) {
                Cession::create([
                    'estate_request_id' => $estateRequestId
                ]);
                return redirect()->back()->with(['success' => 'گزارش شما با موفقیت ارسال شد']);
            }
            return redirect()->back()->with(['success' => 'گزارش شما بررسی خواهد شد']);
        }
        return redirect()->back()->withErrors('خطا');
    }

    public function reportsList()
    {
        $cessionReports = Cession::get();
        $data = [
            'cessionReports' => $cessionReports
        ];
        return view('panel.cession.cessionReportsList', compact('data'));
    }

    public function confirmCession($estateRequestId)
    {
        $estateRequest = EstateRequest::find($estateRequestId);
        $estateRequest->status = 2;
        $estateRequest->save();
        $cession = Cession::where('estate_request_id', $estateRequestId)->first();
        $cession->delete();
        return redirect()->back()->with(['success' => 'عملیات با موفقیت انجام شد']);
    }

    public function unconfirmedCession($estateRequestId)
    {
        $estateRequest = EstateRequest::find($estateRequestId);
        $estateRequest->status = 1;
        $estateRequest->save();
        return redirect()->back()->with(['success' => 'عملیات با موفقیت انجام شد']);
    }

    public function confirmCessionManual($estateRequestId)
    {
        $estateRequest = EstateRequest::find($estateRequestId);
        $estateRequest->status = 2;
        $estateRequest->save();
        return redirect()->back()->with(['success' => 'عملیات با موفقیت انجام شد']);
    }
}
