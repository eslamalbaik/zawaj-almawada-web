@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">إدارة الاستشارة</h1>
        <a href="{{ route('admin.family-counseling.index') }}" class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition">
            <i class="fas fa-arrow-right ml-2"></i>
            العودة للقائمة
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Question Details -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-4">تفاصيل الاستشارة</h2>
            
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">الاسم المستعار</label>
                    <p class="mt-1 text-sm text-gray-900">{{ $counselingRequest->pseudonym ?: 'غير محدد' }}</p>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700">البريد الإلكتروني</label>
                    <p class="mt-1 text-sm text-gray-900">{{ $counselingRequest->email ?: 'غير محدد' }}</p>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700">السؤال/المشكلة</label>
                    <div class="mt-1 p-3 bg-gray-50 rounded-md">
                        <p class="text-sm text-gray-900 whitespace-pre-wrap">{{ $counselingRequest->question }}</p>
                    </div>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700">تاريخ الإرسال</label>
                    <p class="mt-1 text-sm text-gray-900">{{ $counselingRequest->created_at->format('Y/m/d H:i:s') }}</p>
                </div>
                
            </div>
        </div>

        <!-- Answer Form -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-4">إدارة الإجابة</h2>
            
            <form method="POST" action="{{ route('admin.family-counseling.update', $counselingRequest) }}">
                @csrf
                @method('PUT')
                
                <div class="space-y-4">
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-2">الحالة</label>
                        <div class="relative">
                            <select name="status" id="status" class="w-full p-3 pr-10 border border-gray-300 rounded-md focus:ring-2 focus:ring-purple-500 focus:border-purple-500 appearance-none bg-white custom-select">
                                <option value="pending" {{ $counselingRequest->status == 'pending' ? 'selected' : '' }}>في الانتظار</option>
                                <option value="answered" {{ $counselingRequest->status == 'answered' ? 'selected' : '' }}>تم الرد</option>
                            </select>
                        </div>
                    </div>
                    
                    <div>
                        <label for="is_public" class="flex items-center">
                            <input type="checkbox" name="is_public" id="is_public" value="1" 
                                   {{ $counselingRequest->is_public ? 'checked' : '' }}
                                   class="rounded border-gray-300 text-purple-600 shadow-sm focus:border-purple-300 focus:ring focus:ring-purple-200 focus:ring-opacity-50">
                            <span class="mr-2 text-sm font-medium text-gray-700">عرض السؤال والإجابة للعامة</span>
                        </label>
                        <p class="text-xs text-gray-500 mt-1">سيتم عرض السؤال والإجابة في الصفحة العامة للاستشارات</p>
                    </div>
                    
                    <div id="answer-field">
                        <label for="answer" class="block text-sm font-medium text-gray-700 mb-2">
                            الإجابة 
                            <span id="answer-required" class="text-red-500 hidden">*</span>
                        </label>
                        <textarea name="answer" id="answer" rows="8" 
                                  class="w-full p-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-purple-500"
                                  placeholder="اكتب إجابتك هنا...">{{ $counselingRequest->answer }}</textarea>
                        <p id="answer-help" class="mt-1 text-xs text-gray-500">
                            الإجابة مطلوبة عند تغيير الحالة إلى "تم الرد" (على الأقل 10 أحرف)
                        </p>
                        @error('answer')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    @if($counselingRequest->answeredBy)
                    <div class="bg-blue-50 p-3 rounded-md">
                        <p class="text-sm text-blue-800">
                            <strong>تم الرد بواسطة:</strong> {{ $counselingRequest->answeredBy->name }}
                            <br>
                            <strong>تاريخ الرد:</strong> {{ $counselingRequest->answered_at ? $counselingRequest->answered_at->format('Y/m/d H:i:s') : 'غير محدد' }}
                        </p>
                    </div>
                    @endif
                    
                    <div class="space-y-4">
                        <button type="submit" class="w-full inline-flex items-center justify-center bg-purple-600 text-white py-3 px-6 rounded-md hover:bg-purple-700 transition duration-200 font-medium">
                            <i class="fas fa-save ml-2"></i>
                            حفظ التغييرات
                        </button>
                        
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Preview Section -->
    @if($counselingRequest->answer && $counselingRequest->is_public && $counselingRequest->status == 'answered')
    <div class="mt-6 bg-white rounded-lg shadow-md p-6">
        <h2 class="text-xl font-bold text-gray-800 mb-4">معاينة المنشور</h2>
        <div class="border border-gray-200 rounded-lg p-6">
            <div class="mb-4">
                <h3 class="text-lg font-semibold text-gray-800 mb-2">السؤال:</h3>
                <p class="text-gray-700 whitespace-pre-wrap">{{ $counselingRequest->question }}</p>
            </div>
            
            <div class="mb-4">
                <h3 class="text-lg font-semibold text-gray-800 mb-2">الإجابة:</h3>
                <p class="text-gray-700 whitespace-pre-wrap">{{ $counselingRequest->answer }}</p>
            </div>
            
            <div class="text-sm text-gray-500">
                <p>من: {{ $counselingRequest->pseudonym ?: 'مجهول' }}</p>
                <p>تاريخ النشر: {{ $counselingRequest->answered_at ? $counselingRequest->answered_at->format('Y/m/d') : 'غير محدد' }}</p>
            </div>
        </div>
    </div>
    @endif
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const statusSelect = document.getElementById('status');
    const isPublicCheckbox = document.getElementById('is_public');
    const answerTextarea = document.getElementById('answer');
    
    // No auto-checking needed since published status is removed
    
    // Validate form based on status
    function validateForm() {
        const status = statusSelect.value;
        const answer = answerTextarea.value.trim();
        const answerRequired = document.getElementById('answer-required');
        const answerField = document.getElementById('answer-field');
        
        // Clear any custom validity
        answerTextarea.setCustomValidity('');
        
        if (status === 'answered') {
            // Answer is required when status is 'answered'
            answerTextarea.required = true;
            answerRequired.classList.remove('hidden');
            answerField.style.opacity = '1';
            
            if (!answer) {
                answerTextarea.setCustomValidity('يرجى كتابة الإجابة عند تغيير الحالة إلى "تم الرد"');
            } else if (answer.length < 10) {
                answerTextarea.setCustomValidity('يجب أن تكون الإجابة على الأقل 10 أحرف');
            }
        } else {
            // Answer is optional for pending status
            answerTextarea.required = false;
            answerRequired.classList.add('hidden');
            answerField.style.opacity = '1';
        }
    }
    
    statusSelect.addEventListener('change', validateForm);
    answerTextarea.addEventListener('input', validateForm);
    
    // Form submission handler
    const form = document.querySelector('form[method="POST"]');
    if (form) {
        form.addEventListener('submit', function(e) {
            console.log('Form submitting...');
            console.log('Status:', statusSelect.value);
            console.log('Answer:', answerTextarea.value);
            console.log('Answer length:', answerTextarea.value.length);
            
            // Validate before submission
            const status = statusSelect.value;
            const answer = answerTextarea.value.trim();
            
            if (status === 'answered' && !answer) {
                e.preventDefault();
                answerTextarea.setCustomValidity('يرجى كتابة الإجابة عند تغيير الحالة إلى "تم الرد"');
                answerTextarea.reportValidity();
                return false;
            }
            
            if (status === 'answered' && answer.length < 10) {
                e.preventDefault();
                answerTextarea.setCustomValidity('يجب أن تكون الإجابة على الأقل 10 أحرف');
                answerTextarea.reportValidity();
                return false;
            }
            
            console.log('Form validation passed, submitting...');
        });
    }
    
    // Initial validation
    validateForm();
});
</script>
@endpush
@endsection
