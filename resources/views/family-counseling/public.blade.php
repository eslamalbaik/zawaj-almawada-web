@extends('layouts.app')

@section('content')
<section class="relative">
  <div class="bg-cover bg-center min-h-[550px] py-12" style="background-image: url('assets/images/frame.png');">
    <div class="container mx-auto px-4">
      <div class="text-center mb-8">
        <h1 class="text-4xl font-bold text-gray-800 mb-4">الاستشارات المنشورة</h1>
        <p class="text-lg text-gray-600">مجموعة من الاستشارات الأسرية والإجابات المتخصصة</p>
      </div>

      <div class="max-w-4xl mx-auto">
        @forelse($publishedRequests as $request)
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
          <div class="flex justify-between items-start mb-4">
            <div>
              <h3 class="text-lg font-semibold text-gray-800 mb-2">السؤال:</h3>
              <p class="text-gray-700 whitespace-pre-wrap leading-relaxed">{{ $request->question }}</p>
            </div>
            <div class="text-sm text-gray-500 text-left">
              <p>من: {{ $request->pseudonym ?: 'مجهول' }}</p>
              <p>تاريخ النشر: {{ $request->answered_at ? $request->answered_at->format('Y/m/d') : 'غير محدد' }}</p>
            </div>
          </div>
          
          <div class="border-t border-gray-200 pt-4">
            <h3 class="text-lg font-semibold text-gray-800 mb-2">الإجابة:</h3>
            <div class="bg-purple-50 p-4 rounded-lg">
              <p class="text-gray-700 whitespace-pre-wrap leading-relaxed">{{ $request->answer }}</p>
              @if($request->answeredBy)
              <div class="mt-3 text-sm text-purple-600">
                <i class="fas fa-user-tie ml-1"></i>
                {{ $request->answeredBy->name }}
              </div>
              @endif
            </div>
          </div>
        </div>
        @empty
        <div class="bg-white rounded-lg shadow-md p-8 text-center">
          <div class="text-gray-400 mb-4">
            <i class="fas fa-comments text-6xl"></i>
          </div>
          <h3 class="text-xl font-semibold text-gray-600 mb-2">لا توجد استشارات منشورة حالياً</h3>
          <p class="text-gray-500">سيتم نشر الاستشارات والإجابات قريباً</p>
          <div class="mt-6">
            <a href="{{ route('family-counseling') }}" class="bg-purple-600 text-white px-6 py-3 rounded-lg hover:bg-purple-700 transition">
              <i class="fas fa-plus ml-2"></i>
              إرسال استشارة جديدة
            </a>
          </div>
        </div>
        @endforelse
      </div>

      <!-- Pagination -->
      @if($publishedRequests->hasPages())
      <div class="mt-8 flex justify-center">
        {{ $publishedRequests->links() }}
      </div>
      @endif

      <!-- Call to Action -->
      <div class="mt-12 text-center">
        <div class="bg-white rounded-lg shadow-md p-8 max-w-2xl mx-auto">
          <h2 class="text-2xl font-bold text-gray-800 mb-4">هل لديك استشارة أسرية؟</h2>
          <p class="text-gray-600 mb-6">يمكنك إرسال استشارتك وسيقوم المختصون بالرد عليها</p>
          <a href="{{ route('family-counseling') }}" class="bg-purple-600 text-white px-8 py-3 rounded-lg hover:bg-purple-700 transition inline-block">
            <i class="fas fa-paper-plane ml-2"></i>
            إرسال استشارة جديدة
          </a>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
