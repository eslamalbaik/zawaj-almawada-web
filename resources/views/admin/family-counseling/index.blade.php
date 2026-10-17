@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">إدارة استشارات الأسرة</h1>
        <div class="flex space-x-4 space-x-reverse">
            <a href="{{ route('family-counseling.public') }}" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition">
                <i class="fas fa-eye ml-2"></i>
                عرض المنشور
            </a>
        </div>
    </div>

    <!-- Filters -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <form method="GET" class="flex flex-wrap gap-4 items-end">
            <div class="flex-1 min-w-48">
                <label for="status" class="block text-sm font-medium text-gray-700 mb-2">الحالة</label>
                <div class="relative">
                    <select name="status" id="status" class="w-full p-3 pr-10 border border-gray-300 rounded-md focus:ring-2 focus:ring-purple-500 focus:border-purple-500 appearance-none bg-white custom-select">
                        <option value="">جميع الحالات</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>في الانتظار</option>
                        <option value="answered" {{ request('status') == 'answered' ? 'selected' : '' }}>تم الرد</option>
                    </select>
                </div>
            </div>
            <div class="flex-1 min-w-48">
                <label for="is_public" class="block text-sm font-medium text-gray-700 mb-2">النشر</label>
                <div class="relative">
                    <select name="is_public" id="is_public" class="w-full p-3 pr-10 border border-gray-300 rounded-md focus:ring-2 focus:ring-purple-500 focus:border-purple-500 appearance-none bg-white custom-select">
                        <option value="">جميع الطلبات</option>
                        <option value="1" {{ request('is_public') == '1' ? 'selected' : '' }}>عام</option>
                        <option value="0" {{ request('is_public') == '0' ? 'selected' : '' }}>خاص</option>
                    </select>
                </div>
            </div>
            <div class="flex items-end">
                <button type="submit" class="bg-purple-600 text-white px-6 py-3 rounded-md hover:bg-purple-700 transition duration-200 flex items-center">
                    <i class="fas fa-search ml-2"></i>
                    بحث
                </button>
            </div>
        </form>
    </div>

    <!-- Statistics -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                    <i class="fas fa-clock text-xl"></i>
                </div>
                <div class="mr-4">
                    <p class="text-sm font-medium text-gray-600">في الانتظار</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $requests->where('status', 'pending')->count() }}</p>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                    <i class="fas fa-reply text-xl"></i>
                </div>
                <div class="mr-4">
                    <p class="text-sm font-medium text-gray-600">تم الرد</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $requests->where('status', 'answered')->count() }}</p>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-purple-100 text-purple-600">
                    <i class="fas fa-users text-xl"></i>
                </div>
                <div class="mr-4">
                    <p class="text-sm font-medium text-gray-600">إجمالي</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $requests->total() }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Requests Table -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-4 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">الاسم المستعار</th>
                        <th class="px-6 py-4 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">البريد الإلكتروني</th>
                        <th class="px-6 py-4 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">السؤال</th>
                        <th class="px-6 py-4 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">الحالة</th>
                        <th class="px-6 py-4 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">النشر</th>
                        <th class="px-6 py-4 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">التاريخ</th>
                        <th class="px-6 py-4 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">الإجراءات</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($requests as $request)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            {{ $request->pseudonym ?: 'غير محدد' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            {{ $request->email ?: 'غير محدد' }}
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-900">
                            <div class="max-w-xs truncate" title="{{ $request->question }}">
                                {{ Str::limit($request->question, 100) }}
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            @if($request->status == 'pending')
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                    في الانتظار
                                </span>
                            @elseif($request->status == 'answered')
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    تم الرد
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            @if($request->is_public)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    <i class="fas fa-globe ml-1"></i>
                                    عام
                                </span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                    <i class="fas fa-lock ml-1"></i>
                                    خاص
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                            {{ $request->created_at->format('Y/m/d H:i') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <div class="flex items-center justify-center space-x-3 space-x-reverse">
                                <a href="{{ route('admin.family-counseling.show', $request) }}" 
                                   class="inline-flex items-center px-3 py-1.5 text-sm font-medium text-blue-600 bg-blue-50 rounded-md hover:bg-blue-100 hover:text-blue-700 transition duration-200">
                                    <i class="fas fa-eye ml-1"></i>
                                    عرض
                                </a>
                                <form method="POST" action="{{ route('admin.family-counseling.destroy', $request) }}" 
                                      class="inline" onsubmit="return confirm('هل أنت متأكد من حذف هذه الاستشارة؟')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex items-center px-3 py-1.5 text-sm font-medium text-red-600 bg-red-50 rounded-md hover:bg-red-100 hover:text-red-700 transition duration-200">
                                        <i class="fas fa-trash ml-1"></i>
                                        حذف
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-6 py-4 text-center text-gray-500">
                            لا توجد استشارات
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        @if($requests->hasPages())
        <div class="px-6 py-4 border-t border-gray-200">
            {{ $requests->appends(request()->query())->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
