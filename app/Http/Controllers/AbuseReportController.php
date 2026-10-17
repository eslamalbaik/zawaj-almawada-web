<?php

namespace App\Http\Controllers;

use App\Models\AbuseReport;
use Illuminate\Http\Request;

class AbuseReportController extends Controller
{
    public function create()
    {
        return view('abuse-reports.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'abuse_details' => 'required|string',
            'abuser_nickname' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'abuser_full_name' => 'nullable|string|max:255',
        ]);

        AbuseReport::create($validated);

        return redirect()->back()->with('success', 'تم إرسال البلاغ بنجاح');
    }

    public function index()
    {
        $reports = AbuseReport::latest()->paginate(10);
        return view('admin.abuse-reports.index', compact('reports'));
    }

    public function toggleReview(AbuseReport $abuseReport)
    {
        $abuseReport->update(['is_reviewed' => !$abuseReport->is_reviewed]);
        return redirect()->back()->with('success', 'تم تحديث حالة المراجعة بنجاح');
    }
}
