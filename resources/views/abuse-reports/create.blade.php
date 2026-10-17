@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-purple-50 to-blue-50 py-12">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-xl shadow-lg p-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">
                تقديم بلاغ عن إساءة استخدام برنامج الزواج الشرعي


            </h2>

            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <form action="{{ route('abuse-reports.store') }}" method="POST" class="space-y-6">
                @csrf

                <div>
                    <label for="full_name" class="block text-sm font-medium text-gray-700">الاسم الثلاثي</label>
                    <input type="text" name="full_name" id="full_name" value="{{ old('full_name') }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500"
                        required>
                    @error('full_name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700">رقم الهاتف</label>
                    <input type="tel" name="phone" id="phone" value="{{ old('phone') }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500"
                        required>
                    @error('phone')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">البريد الإلكتروني</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500"
                        required>
                    @error('email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="abuse_details" class="block text-sm font-medium text-gray-700">تفاصيل الإساءة</label>
                    <textarea name="abuse_details" id="abuse_details" rows="4"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500"
                        required>{{ old('abuse_details') }}</textarea>
                    @error('abuse_details')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="abuser_nickname" class="block text-sm font-medium text-gray-700">الاسم المستعار للعضو المسيء</label>
                    <input type="text" name="abuser_nickname" id="abuser_nickname" value="{{ old('abuser_nickname') }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500"
                        required>
                    @error('abuser_nickname')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="state" class="block text-sm font-medium text-gray-700">الولاية</label>
                    <input type="text" name="state" id="state" value="{{ old('state') }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500"
                        required>
                    @error('state')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="abuser_full_name" class="block text-sm font-medium text-gray-700">الاسم الثلاثي للعضو المسيء (إن وجد)</label>
                    <input type="text" name="abuser_full_name" id="abuser_full_name" value="{{ old('abuser_full_name') }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500">
                    @error('abuser_full_name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-center">
                    <button type="submit"
                        class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                        إرسال البلاغ
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection