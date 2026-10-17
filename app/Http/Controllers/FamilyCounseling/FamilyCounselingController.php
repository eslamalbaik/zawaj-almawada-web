<?php

namespace App\Http\Controllers\FamilyCounseling;

use App\Http\Controllers\Controller;
use App\Models\FamilyCounselingRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class FamilyCounselingController extends Controller
{
    public function index(){
        return view('family-counseling.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'nullable|email|max:255',
            'pseudonym' => 'nullable|string|max:255',
            'question' => 'required|string|min:10|max:2000',
            'botcheck' => 'accepted'
        ], [
            'question.required' => 'يرجى كتابة سؤالك أو مشكلتك',
            'question.min' => 'يجب أن يكون السؤال على الأقل 10 أحرف',
            'question.max' => 'يجب ألا يتجاوز السؤال 2000 حرف',
            'email.email' => 'يرجى إدخال بريد إلكتروني صحيح',
            'botcheck.accepted' => 'تم رفض الطلب'
        ]);

        try {
            FamilyCounselingRequest::create([
                'email' => $request->email,
                'pseudonym' => $request->pseudonym,
                'question' => $request->question,
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'status' => 'pending'
            ]);

            return response()->json([
                'success' => true,
                'message' => 'تم إرسال استشارتك بنجاح! سنقوم بالرد عليك قريباً.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'حدث خطأ أثناء إرسال الاستشارة. يرجى المحاولة مرة أخرى.'
            ], 500);
        }
    }

    // Admin methods
    public function adminIndex(Request $request)
    {
        $query = FamilyCounselingRequest::with('answeredBy')
            ->orderBy('created_at', 'desc');

        // Filter by status
        if ($request->has('status') && $request->status !== '') {
            $query->where('status', $request->status);
        }

        // Filter by public status
        if ($request->has('is_public') && $request->is_public !== '') {
            $query->where('is_public', $request->is_public);
        }

        $requests = $query->paginate(15);

        return view('admin.family-counseling.index', compact('requests'));
    }

    public function adminShow(FamilyCounselingRequest $counselingRequest)
    {
        $counselingRequest->load('answeredBy');
        return view('admin.family-counseling.show', compact('counselingRequest'));
    }

    public function adminUpdate(Request $request, FamilyCounselingRequest $counselingRequest)
    {
        // Conditional validation based on status
        $validationRules = [
            'is_public' => 'boolean',
            'status' => ['required', Rule::in(['pending', 'answered'])]
        ];

        $validationMessages = [
            'status.required' => 'يرجى اختيار حالة الطلب'
        ];

        // Answer is required when status is 'answered'
        if ($request->status === 'answered') {
            $validationRules['answer'] = 'required|string|min:10|max:5000';
            $validationMessages['answer.required'] = 'يرجى كتابة الإجابة عند تغيير الحالة إلى "تم الرد"';
            $validationMessages['answer.min'] = 'يجب أن تكون الإجابة على الأقل 10 أحرف';
            $validationMessages['answer.max'] = 'يجب ألا تتجاوز الإجابة 5000 حرف';
        } else {
            // Answer is optional for pending status
            $validationRules['answer'] = 'nullable|string|max:5000';
            $validationMessages['answer.max'] = 'يجب ألا تتجاوز الإجابة 5000 حرف';
        }

        $request->validate($validationRules, $validationMessages);

        // Prepare update data
        $updateData = [
            'is_public' => $request->boolean('is_public'),
            'status' => $request->status,
        ];

        // Always save the answer if provided, regardless of status
        if ($request->filled('answer')) {
            $updateData['answer'] = $request->answer;
        }
        
        // Set answered_by and answered_at only when status is answered
        if ($request->status === 'answered') {
            $updateData['answered_by'] = Auth::id();
            $updateData['answered_at'] = now();
        } else {
            // For pending status, clear the answered_by and answered_at fields
            $updateData['answered_by'] = null;
            $updateData['answered_at'] = null;
        }

        $counselingRequest->update($updateData);

        return redirect()->route('admin.family-counseling.index')
            ->with('success', 'تم تحديث الاستشارة بنجاح');
    }

    public function adminDestroy(FamilyCounselingRequest $counselingRequest)
    {
        $counselingRequest->delete();
        return redirect()->route('admin.family-counseling.index')
            ->with('success', 'تم حذف الاستشارة بنجاح');
    }

    // Public method to show published Q&A
    public function publicIndex()
    {
        $publishedRequests = FamilyCounselingRequest::answered()
            ->public()
            ->with('answeredBy')
            ->orderBy('answered_at', 'desc')
            ->paginate(10);

        return view('family-counseling.public', compact('publishedRequests'));
    }
}
