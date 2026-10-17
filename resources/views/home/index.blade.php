<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>زواج المودة</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@700&display=swap" rel="stylesheet">
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Almarai:wght@300;400;700&display=swap');

    @font-face {
      font-family: 'Samim';
      src: url('/assets/fonts/alfont_com_ArbFONTS-Samim.ttf') format('truetype');
      font-weight: normal;
      font-style: normal;
    }

    body {
      font-family: 'Almarai', sans-serif;
      background-color: #f9fafb;
    }

    .islamic-pattern {
      background-image: radial-gradient(circle, #f4e9ff 10%, transparent 20%),
        radial-gradient(circle, #f4e9ff 10%, transparent 20%);
      background-size: 50px 50px;
      background-position: 0 0, 25px 25px;
    }

    .gold-btn {
      background: linear-gradient(45deg, #CBA63D 0%, #D4AF37 100%);
      box-shadow: 0 4px 15px rgba(203, 166, 61, 0.3);
      transition: all 0.3s ease;
    }

    .gold-btn:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(203, 166, 61, 0.4);
    }

    .section-title {
      position: relative;
      padding-bottom: 1rem;
    }

    .section-title::after {
      content: '';
      position: absolute;
      bottom: 0;
      left: 50%;
      transform: translateX(-50%);
      width: 60px;
      height: 3px;
      background: #d4b341;
    }

    .feature-card {
      background: rgba(255, 255, 255, 0.9);
      backdrop-filter: blur(10px);
      border: 1px solid rgba(203, 166, 61, 0.2);
      transition: transform 0.3s ease;
    }

    .feature-card:hover {
      transform: translateY(-5px);
    }

    /* Enhanced card alignment for better icon-text positioning */
    .feature-card .flex {
      align-items: center;
    }

    .feature-card .flex-shrink-0 {
      flex-shrink: 0;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    /* Responsive adjustments for smaller screens */
    @media (max-width: 768px) {
      .feature-card .flex {
        flex-direction: column;
        text-align: center;
        gap: 1rem;
      }
      
      .feature-card .space-x-4 {
        margin: 0;
      }
    }

    .nav-link {
      @apply text-gray-700 hover: text-purple-900 transition-colors flex items-center;
    }

    .nav-link.active {
      @apply text-[#d4b341] font-bold;
    }

    .social-icon {
      @apply w-10 h-10 rounded-full bg-white/10 flex items-center justify-center hover: bg-[#d4b341] transition-colors text-xl;
    }

    .sidebar-link {
      display: flex;
      align-items: center;
      padding: 0.5rem 1rem;
      border-radius: 0.375rem;
      transition: background-color 0.2s;
      color: #d1d5db;
      /* gray-300 */
    }

    .sidebar-link:hover {
      background-color: #374151;
      /* gray-700 */
      color: white;
    }

    .sidebar-link.active {
      background-color: #553566;
      /* Custom purple */
      color: white;
      font-weight: bold;
    }

    .sub-link {
      display: block;
      padding: 0.5rem 1rem;
      border-radius: 0.375rem;
      transition: background-color 0.2s;
      color: #9ca3af;
      /* gray-400 */
      font-size: 0.875rem;
    }

    .sub-link:hover {
      background-color: #374151;
      /* gray-700 */
      color: white;
    }

    .sub-link.active {
      background-color: #4c2e5a;
      color: white;
    }

    .hide-scrollbar::-webkit-scrollbar {
      display: none;
    }

    .hide-scrollbar {
      -ms-overflow-style: none;
      scrollbar-width: none;
    }
  </style>
</head>

<body>
  @if(auth()->check() && auth()->user()->isAdmin())
  {{-- ==== ADMIN LAYOUT ==== --}}
  <div x-data="{ sidebarOpen: window.innerWidth >= 1024 }" @resize.window="sidebarOpen = window.innerWidth >= 1024"
    class="relative min-h-screen md:flex">
    @include('layouts.admin-sidebar')

    <main class="flex-1 min-w-0">
      {{-- Admin Top Bar --}}
      <header class="flex justify-between items-center min-h-[61px] px-6 bg-white border-b-2 shadow-sm">
        {{-- Sidebar Toggle Button --}}
        <button @click.prevent="sidebarOpen = !sidebarOpen" class="text-gray-500 focus:outline-none lg:hidden">
          <i class="fas fa-bars fa-lg"></i>
        </button>
        <div class="text-sm max-h-fit">
          <!-- Page Title/Breadcrumbs can go here -->
        </div>
        @auth
        <div class="flex items-center">
          <x-dropdown align="right" width="48">
            <x-slot name="trigger">
              <button
                class="inline-flex items-center px-3 py-1 border border-transparent text-sm font-medium rounded-full text-gray-900 bg-gray-100 hover:bg-gray-200 focus:outline-none transition-all duration-300">
                <div>{{ Auth::user()->name }}</div>
                <div class="mr-2"><i class="fas fa-chevron-down text-sm"></i></div>
              </button>
            </x-slot>
            <x-slot name="content">
              <form method="POST" action="{{ route('logout') }}" id="logout-form">
                @csrf
              </form>
              <x-dropdown-link href="#"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                class="text-gray-900 hover:bg-gray-100 transition-colors">
                <i class="fas fa-sign-out-alt ml-2"></i> تسجيل الخروج
              </x-dropdown-link>
            </x-slot>
          </x-dropdown>
        </div>
        @endauth
      </header>

      {{-- Main Content --}}
      <div class="overflow-y-auto bg-gray-200" style="height: calc(100vh - 61px);">
        <section class="relative islamic-pattern p-4 md:p-14">
          @auth
          @if(!in_array(Auth::user()->status, ['available', 'engaged']))
          <section class="py-0 px-4 sm:px-8 lg:px-16">
            <div class="container mx-auto px-4">
              <div
                class="bg-gradient-to-br from-purple-50 to-blue-50 border border-purple-100 p-8 rounded-2xl shadow-lg">
                <div class="flex items-start">
                  <div class="flex-shrink-0 pt-1">
                    <i class="fas fa-hourglass-half text-[#d4b341] text-2xl"></i>
                  </div>
                  <div class="mr-3 flex items-center justify-between gap-2 w-full flex-wrap">
                    <div>
                      <h3 class="text-xl font-bold text-purple-900">طلب خطوبة نشط</h3>
                      <div class="mt-2 text-gray-700">
                        <p>لديك طلب خطوبة نشط مع
                          <span class="font-medium">
                            @if($marriageRequest)
                            {{ $marriageRequest->user_id === Auth::id() ? $marriageRequest->target->name :
                            $marriageRequest->user->name ?? 'غير محدد' }}
                            @else
                            غير محدد
                            @endif
                          </span>
                        </p>
                      </div>
                    </div>
                    <div class="mt-4">
                      <a href="{{ route('marriage-requests.status') }}"
                        class="inline-flex items-center px-6 py-2 bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 text-white text-sm font-medium rounded-lg transition-all transform hover:scale-105 shadow-md">
                        <i class="fas fa-clock ml-2"></i>
                        متابعة حالة الطلب
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>
          @endif
          @endauth
          <div
            class="flex flex-col mt-10 py-8 px-4 sm:px-8 lg:px-16 rounded-3xl lg:flex-row items-center gap-8 lg:gap-16 bg-cover bg-center"
            style="background-image: url('assets/images/frame.png');">

            <div class="w-full lg:w-1/2 space-y-6 text-center lg:text-right bg-white bg-opacity-80 p-4 rounded-lg">
              <h1 class="text-3xl sm:text-4xl font-bold text-purple-900 leading-tight">
                مقياس التوافق الزواجي
              </h1>
              <p class="text-gray-700 text-sm sm:text-base leading-relaxed">
                يساعدك هذا المقياس على معرفة مدى التوافق النفسي والاجتماعي والسلوكي بينك وبين خطيبك، مما يساعد في بناء علاقة متينة وفهم أعمق لشخصياتكما، وبيانات الطرفين مشفرة لا يطلع عليها حتى القائمين على المنصة، وشعار المقياس: إذا احسنت الاختيار ستنعم بالاستقرار.
              </p>
              @auth
              <a href="{{ route('exam.pledge') }}" class="inline-block">
                @else
                <a href="{{ route('login') }}" class="inline-block">
                  @endauth
                  <button
                    class="bg-[#d4b341] hover:bg-yellow-700 text-white px-6 py-3 rounded-3xl transition-colors text-sm sm:text-base">
                    اجراء اختبار
                  </button>
                </a>
            </div>
            <div class="w-full lg:w-1/2 flex justify-center">
              <img src="/assets/images/2.png" class="w-64 sm:w-80 lg:w-96 h-auto" alt="marriage compatibility test">
            </div>
          </div>
        </section>

    {{-- مقياس التوافق الزواجي Section --}}
    <section class="py-16 px-4 sm:px-8 lg:px-16 bg-gradient-to-br from-purple-50 to-blue-50">
      <div class="container mx-auto px-4">
        <div class="text-center mb-12">
          <h2 class="section-title text-4xl font-bold text-purple-900 mb-4">
            مقياس التوافق الزواجي
          </h2>
          <p class="text-gray-600 text-lg max-w-3xl mx-auto">
            يساعدك هذا المقياس على معرفة مدى التوافق النفسي والاجتماعي والسلوكي بينك وبين خطيبك، مما يساعد في بناء علاقة متينة وفهم أعمق لشخصياتكما، وبيانات الطرفين مشفرة لا يطلع عليها حتى القائمين على المنصة، وشعار المقياس: إذا احسنت الاختيار ستنعم بالاستقرار.
          </p>
        </div>

        <div class="flex justify-center mb-16">
          <div class="text-center">
            <img src="/assets/images/2.png" class="w-80 h-auto mx-auto" alt="marriage compatibility test">
          </div>
        </div>

        <div class="bg-white rounded-2xl p-8 shadow-lg">
          <h3 class="text-2xl font-bold text-purple-900 mb-4 text-center">أهداف المقياس</h3>
          <p class="text-gray-700 text-lg leading-relaxed text-center max-w-4xl mx-auto">
            يهدف هذا المقياس إلى تقييم درجة التوافق بين الشريكين قبل الزواج من خلال استكشاف الجوانب النفسية
            والاجتماعية والسلوكية.
          </p>
          <div class="text-center mt-8">
            @auth
            <a href="{{ route('exam.pledge') }}" class="inline-block">
            @else
            <a href="{{ route('login') }}" class="inline-block">
            @endauth
              <button class="bg-[#d4b341] hover:bg-yellow-700 text-white px-8 py-4 rounded-3xl transition-colors text-lg font-semibold">
                <i class="fas fa-play ml-2"></i>
                ابدأ مقياس التوافق
              </button>
            </a>
          </div>
        </div>
      </div>
    </section>

    {{-- برنامج الزواج الشرعي Section --}}
    <section class="py-16 px-4 sm:px-8 lg:px-16 bg-white">
      <div class="container mx-auto px-4">
        <div class="text-center mb-12">
          <h2 class="section-title text-4xl font-bold text-purple-900 mb-4">
            برنامج الزواج الشرعي
          </h2>
          <p class="text-gray-600 text-lg max-w-3xl mx-auto">
            انضم إلى برنامج الزواج الشرعي للعثور على شريك حياة وفق مقاييس توافق دقيقة بينكما، مع حفاظ تام على خصوصيتك.
          </p>
        </div>

        {{-- Main Content Card --}}
        <div class="bg-gradient-to-br from-purple-50 via-pink-50 to-indigo-50 rounded-3xl p-8 md:p-12 shadow-2xl border border-purple-100 overflow-hidden relative">
          {{-- Background Pattern --}}
          <div class="absolute inset-0 opacity-5">
            <div class="absolute top-0 left-0 w-32 h-32 bg-purple-400 rounded-full -translate-x-16 -translate-y-16"></div>
            <div class="absolute top-0 right-0 w-24 h-24 bg-pink-400 rounded-full translate-x-12 -translate-y-12"></div>
            <div class="absolute bottom-0 left-0 w-40 h-40 bg-indigo-400 rounded-full -translate-x-20 translate-y-20"></div>
            <div class="absolute bottom-0 right-0 w-28 h-28 bg-purple-300 rounded-full translate-x-14 translate-y-14"></div>
          </div>
          
          <div class="relative z-10">
            <div class="flex flex-col lg:flex-row items-center gap-8 lg:gap-12">
              {{-- Icon and Title Section --}}
              <div class="flex-shrink-0 text-center lg:text-right">
                <div class="w-24 h-24 bg-gradient-to-br from-purple-500 to-pink-500 rounded-full flex items-center justify-center mb-6 mx-auto lg:mx-0 shadow-lg">
                  <i class="fas fa-heart text-white text-3xl"></i>
                </div>
                <h3 class="text-3xl md:text-4xl font-bold text-purple-900 mb-2">
                  برنامج الزواج الشرعي
                </h3>
                <div class="w-20 h-1 bg-gradient-to-r from-purple-500 to-pink-500 rounded-full mx-auto lg:mx-0"></div>
              </div>

              {{-- Content Section --}}
              <div class="flex-1 text-center lg:text-right">
                <p class="text-gray-700 text-lg md:text-xl leading-relaxed mb-6 max-w-2xl mx-auto lg:mx-0">
                  انضم إلى برنامجنا المتخصص للزواج الشرعي واكتشف شريك حياتك المناسب وفق معايير التوافق العلمية والدينية. 
                  نضمن لك تجربة آمنة وموثوقة مع الحفاظ التام على خصوصيتك.
                </p>
                
                
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    {{-- الدورات Section --}}
    <section class="py-16 px-4 sm:px-8 lg:px-16 bg-gradient-to-br from-blue-50 to-purple-50">
      <div class="container mx-auto px-4">
        <div class="text-center mb-12">
          <h2 class="section-title text-4xl font-bold text-purple-900 mb-4">
            الدورات التدريبية
          </h2>
          <p class="text-gray-600 text-lg max-w-3xl mx-auto">
            دورات متخصصة لتأهيلك للحياة الزوجية وبناء علاقة ناجحة ومستقرة
          </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
          <div class="space-y-6">
            <div class="feature-card p-6 rounded-xl">
              <div class="flex items-center space-x-4 space-x-reverse">
                <div class="text-[#d4b341] text-3xl flex-shrink-0 ml-6">
                  <i class="fas fa-graduation-cap"></i>
                </div>
                <div>
                  <h4 class="text-xl font-bold text-purple-900 mb-2">دورة التأهيل للحياة الزوجية</h4>
                  <p class="text-gray-700">دورة شاملة تغطي جميع جوانب الحياة الزوجية الناجحة</p>
                </div>
              </div>
            </div>

            <div class="feature-card p-6 rounded-xl">
              <div class="flex items-center space-x-4 space-x-reverse">
                <div class="text-[#d4b341] text-3xl flex-shrink-0 ml-6">
                  <i class="fas fa-video"></i>
                </div>
                <div>
                  <h4 class="text-xl font-bold text-purple-900 mb-2">محتوى تفاعلي</h4>
                  <p class="text-gray-700">فيديوهات تعليمية ومواد تفاعلية لضمان أفضل تجربة تعلم</p>
                </div>
              </div>
            </div>

            <div class="feature-card p-6 rounded-xl">
              <div class="flex items-center space-x-4 space-x-reverse">
                <div class="text-[#d4b341] text-3xl flex-shrink-0 ml-6">
                  <i class="fas fa-certificate"></i>
                </div>
                <div>
                  <h4 class="text-xl font-bold text-purple-900 mb-2">شهادة إنجاز</h4>
                  <p class="text-gray-700">احصل على شهادة معتمدة عند إكمال الدورة بنجاح</p>
                </div>
              </div>
            </div>
          </div>
          <div class="text-center">
            <div class="bg-white rounded-2xl p-8 shadow-lg">
              <div class="w-20 h-20 bg-gradient-to-r from-blue-100 to-purple-100 rounded-full flex items-center justify-center mb-6 mx-auto">
                <i class="fas fa-book-open text-purple-900 text-4xl"></i>
              </div>
              <h3 class="text-2xl font-bold text-purple-900 mb-4">
                ابدأ رحلة التعلم
              </h3>
              <p class="text-gray-700 leading-relaxed text-lg mb-8">
                انضم إلى دوراتنا التدريبية المتخصصة واكتسب المهارات اللازمة لبناء حياة زوجية سعيدة
              </p>
              <a href="{{ route('courses.index') }}"
                class="bg-[#d4b341] hover:bg-yellow-700 text-white px-8 py-4 rounded-3xl transition-colors text-lg font-semibold inline-block">
                <i class="fas fa-play ml-2"></i>
                تصفح الدورات
              </a>
            </div>
          </div>
        </div>
      </div>
    </section>

    {{-- الاستشارات الاسرية والزواجية Section --}}
    <section class="py-16 px-4 sm:px-8 lg:px-16 bg-white">
      <div class="container mx-auto px-4">
        <div class="text-center mb-12">
          <h2 class="section-title text-4xl font-bold text-purple-900 mb-4">
            الاستشارات الأسرية والزواجية
          </h2>
          <p class="text-gray-600 text-lg max-w-3xl mx-auto">
            {{-- احصل على استشارات متخصصة من خبراء في العلاقات الأسرية والزواجية
          </p> --}}
        </div>

        {{-- Hidden cards - will be restored later --}}
        {{-- 
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
          <div class="feature-card p-6 rounded-xl text-center">
            <div class="w-16 h-16 bg-gradient-to-r from-green-100 to-blue-100 rounded-full flex items-center justify-center mb-4 mx-auto">
              <i class="fas fa-user-md text-green-600 text-2xl"></i>
            </div>
            <h4 class="text-lg font-bold text-purple-900 mb-2">استشارة طبيب</h4>
            <p class="text-gray-700 text-sm mb-4">استشارات طبية متخصصة</p>
            <a href="{{ route('doctor-counseling') }}"
              class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg transition-colors text-sm">
              اطلب استشارة
            </a>
          </div>

          <div class="feature-card p-6 rounded-xl text-center">
            <div class="w-16 h-16 bg-gradient-to-r from-blue-100 to-indigo-100 rounded-full flex items-center justify-center mb-4 mx-auto">
              <i class="fas fa-balance-scale text-blue-600 text-2xl"></i>
            </div>
            <h4 class="text-lg font-bold text-purple-900 mb-2">استشارة قانوني</h4>
            <p class="text-gray-700 text-sm mb-4">استشارات قانونية متخصصة</p>
            <a href="{{ route('legal-counseling') }}"
              class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition-colors text-sm">
              اطلب استشارة
            </a>
          </div>

          <div class="feature-card p-6 rounded-xl text-center">
            <div class="w-16 h-16 bg-gradient-to-r from-yellow-100 to-orange-100 rounded-full flex items-center justify-center mb-4 mx-auto">
              <i class="fas fa-brain text-yellow-600 text-2xl"></i>
            </div>
            <h4 class="text-lg font-bold text-purple-900 mb-2">استشارة نفسية</h4>
            <p class="text-gray-700 text-sm mb-4">استشارات نفسية متخصصة</p>
            <a href="{{ route('psychic-counseling') }}"
              class="bg-yellow-600 hover:bg-yellow-700 text-white px-4 py-2 rounded-lg transition-colors text-sm">
              اطلب استشارة
            </a>
          </div>
        </div>
        --}}

        {{-- Full-width Family Counseling Card --}}
        <div class="bg-gradient-to-br from-purple-50 via-pink-50 to-indigo-50 rounded-3xl p-8 md:p-12 shadow-2xl border border-purple-100 overflow-hidden relative">
          {{-- Background Pattern --}}
          <div class="absolute inset-0 opacity-5">
            <div class="absolute top-0 left-0 w-32 h-32 bg-purple-400 rounded-full -translate-x-16 -translate-y-16"></div>
            <div class="absolute top-0 right-0 w-24 h-24 bg-pink-400 rounded-full translate-x-12 -translate-y-12"></div>
            <div class="absolute bottom-0 left-0 w-40 h-40 bg-indigo-400 rounded-full -translate-x-20 translate-y-20"></div>
            <div class="absolute bottom-0 right-0 w-28 h-28 bg-purple-300 rounded-full translate-x-14 translate-y-14"></div>
          </div>
          
          <div class="relative z-10">
            <div class="flex flex-col lg:flex-row items-center gap-8 lg:gap-12">
              {{-- Icon and Title Section --}}
              <div class="flex-shrink-0 text-center lg:text-right">
                <div class="w-24 h-24 bg-gradient-to-br from-purple-500 to-pink-500 rounded-full flex items-center justify-center mb-6 mx-auto lg:mx-0 shadow-lg">
                  <i class="fas fa-home text-white text-3xl"></i>
                </div>
                <h3 class="text-3xl md:text-4xl font-bold text-purple-900 mb-2">
                  استشارة أسرية
                </h3>
                <div class="w-20 h-1 bg-gradient-to-r from-purple-500 to-pink-500 rounded-full mx-auto lg:mx-0"></div>
              </div>

              {{-- Content Section --}}
              <div class="flex-1 text-center lg:text-right">
                <p class="text-gray-700 text-lg md:text-xl leading-relaxed mb-6 max-w-2xl mx-auto lg:mx-0">
                  احصل على استشارات متخصصة من خبراء مؤهلين في العلاقات الأسرية والزواجية. 
                  نقدم لك الدعم والاستشارة في جميع جوانب الحياة الأسرية لبناء علاقات قوية ومستقرة.
                </p>
                
                {{-- Features List --}}
                {{-- <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-8">
                  <div class="flex items-center justify-center lg:justify-start gap-3">
                    <div class="w-8 h-8 bg-purple-100 rounded-full flex items-center justify-center">
                      <i class="fas fa-check text-purple-600 text-sm"></i>
                    </div>
                    <span class="text-gray-700 font-medium">استشارات زواجية متخصصة</span>
                  </div>
                  <div class="flex items-center justify-center lg:justify-start gap-3">
                    <div class="w-8 h-8 bg-purple-100 rounded-full flex items-center justify-center">
                      <i class="fas fa-check text-purple-600 text-sm"></i>
                    </div>
                    <span class="text-gray-700 font-medium">حل المشاكل الأسرية</span>
                  </div>
                  <div class="flex items-center justify-center lg:justify-start gap-3">
                    <div class="w-8 h-8 bg-purple-100 rounded-full flex items-center justify-center">
                      <i class="fas fa-check text-purple-600 text-sm"></i>
                    </div>
                    <span class="text-gray-700 font-medium">تأهيل ما قبل الزواج</span>
                  </div>
                  <div class="flex items-center justify-center lg:justify-start gap-3">
                    <div class="w-8 h-8 bg-purple-100 rounded-full flex items-center justify-center">
                      <i class="fas fa-check text-purple-600 text-sm"></i>
                    </div>
                    <span class="text-gray-700 font-medium">استشارات سرية ومضمونة</span>
                  </div>
                </div> --}}

                {{-- CTA Button --}}
                <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                  <a href="{{ route('family-counseling') }}"
                    class="bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 text-white px-8 py-4 rounded-2xl transition-all duration-300 transform hover:scale-105 shadow-lg font-semibold text-lg inline-flex items-center justify-center gap-3">
                    <i class="fas fa-calendar-check"></i>
                    اطلب الاستشارة الان
                  </a>
                  <a href="/family-counseling/public"
                    class="border-2 border-purple-600 text-purple-600 hover:bg-purple-600 hover:text-white px-8 py-4 rounded-2xl transition-all duration-300 font-semibold text-lg inline-flex items-center justify-center gap-3">
                    <i class="fas fa-eye"></i>
                    مشاهدة الاستشارات السابقة
                  </a>
                  {{-- <a href="#"
                    class="border-2 border-purple-600 text-purple-600 hover:bg-purple-600 hover:text-white px-8 py-4 rounded-2xl transition-all duration-300 font-semibold text-lg inline-flex items-center justify-center gap-3">
                    <i class="fas fa-phone"></i>
                    تواصل معنا
                  </a> --}}
                </div>
              </div>
            </div>
          </div>
        </div>

        {{-- <div class="text-center mt-12">
          <div class="bg-gradient-to-r from-purple-50 to-pink-50 border border-purple-100 p-8 rounded-2xl shadow-lg max-w-4xl mx-auto">
            <h3 class="text-2xl font-bold text-purple-900 mb-4">
              احصل على المساعدة التي تحتاجها
            </h3>
            <p class="text-gray-700 leading-relaxed text-lg mb-6">
              فريقنا من الخبراء المتخصصين جاهز لتقديم الدعم والاستشارة في جميع جوانب الحياة الأسرية والزواجية
            </p>
            <div class="flex flex-wrap justify-center gap-4">
              <a href="{{ route('legitimate-counseling') }}"
                class="bg-[#d4b341] hover:bg-yellow-700 text-white px-6 py-3 rounded-3xl transition-colors font-semibold">
                <i class="fas fa-gavel ml-2"></i>
                استشارة شرعية
              </a>
            </div>
          </div>
        </div> --}}
      </div>
    </section>
        @guest
        <section class="my-16 px-4 sm:px-8 lg:px-16">
          <div
            class="rounded-3xl p-6 border-2 flex flex-col items-center justify-center gap-12 bg-cover bg-center min-h-[250px]"
            style="background-image: url('assets/images/frame.png');">
            <div class="text-center md:text-right bg-white bg-opacity-80 p-4 pb-0 rounded-lg">
              <h3 class="text-[#58306D] font-bold text-2xl mb-2">انضم الآن لعضوية الموقع</h3>
              <p class="text-[#58306D] text-sm sm:text-base leading-relaxed">
                احصل على كافة خدمات المنصة بشكل مجاني              </p>
            </div>
            <div class="mt-2 md:mt-0">
              <a href="{{ route('register') }}"
                class="bg-[#d4b341] hover:bg-yellow-700 text-white px-6 py-3 rounded-3xl transition-colors text-sm sm:text-base">
                تسجيل عضوية
              </a>
            </div>
          </div>
        </section>
        @endguest

        <footer class="bg-purple-900 text-white pt-12">
          <div class="container mx-auto px-12">
            <div class="grid grid-cols-1 md:grid-cols-5 gap-14 border-b border-purple-800 pb-12">
              <div class="md:col-span-2">
                <h4 class="text-xl font-bold mb-6">عن الموقع</h4>
                <p class="text-gray-300">
                  هو منصة إلكترونية يديرها د.حمود النوفلي من سلطنة عمان، ويقدم فيها خدمات مجانية في كل ما يحتاج له
                  الشباب
                  المقبلين على
                  الزواج والمتزوجين حديثاً، من تأهيل واستشارات وخدمات ومقاييس ودورات وكتب تمكنهم من بناء حياة أسرية
                  سعيدة
                  بعيداً عن
                  المشكلات و التفكك الأسري.
                </p>
              </div>

              <div>
                <h4 class="text-xl font-bold mb-6">روابط سريعة</h4>
                <ul class="space-y-3">
                  <li><a href="{{ route('terms') }}" class="hover:text-[#d4b341] transition-colors">الشروط والأحكام</a></li>
                  <li><a href="{{ route('privacy') }}" class="hover:text-[#d4b341] transition-colors">سياسة الخصوصية</a></li>
                  <li><a href="#" class="hover:text-[#d4b341] transition-colors">الأسئلة الشائعة</a></li>
                  <li><a href="#" class="hover:text-[#d4b341] transition-colors">المدونة</a></li>
                </ul>
              </div>

              <div>
                <h4 class="text-xl font-bold mb-6">تواصل معنا</h4>
                <ul class="space-y-3">
                  <li class="flex items-center">
                    <i class="fas fa-phone ml-2 text-[#d4b341]"></i>
                    0096894128090
                  </li>
                  <li class="flex items-center">
                    <i class="fas fa-envelope ml-2 text-[#d4b341]"></i>
                    info@zawaj-almawada.com
                  </li>
                </ul>
              </div>

              <div>
                <h4 class="text-xl font-bold mb-6">تابعنا</h4>
                <div class="flex space-x-2 gap-4">
                  <a href="https://www.instagram.com/hamoodalnoofli/" class="social-icon hover:-translate-y-1"
                    target="_blank">
                    <i class="fab fa-instagram"></i>
                  </a>
                  <a href="https://x.com/molhim399?s=08" class="social-icon hover:-translate-y-1">
                    <i class="fab fa-twitter"></i>
                  </a>
                  <a href="https://www.youtube.com/channel/UC6pJW3_VsKH1M1NqbkeYITQ"
                    class="social-icon hover:-translate-y-1" target="_blank">
                    <i class="fab fa-youtube"></i>
                  </a>
                </div>
              </div>
            </div>

            <div class="py-4 text-center text-white">
              جميع الحقوق محفوظة © زواج المودة 2025
            </div>
          </div>
        </footer>
      </div>
    </main>
  </div>
  @else
  {{-- ==== GUEST/USER LAYOUT ==== --}}
  <div class="min-h-screen">
    @include('layouts.navigation')

    <section class="relative islamic-pattern p-4 md:p-14">
      @auth
      @if(!in_array(Auth::user()->status, ['available', 'engaged']))
      <section class="py-0 px-4 sm:px-8 lg:px-16">
        <div class="container mx-auto px-4">
          <div class="bg-gradient-to-br from-purple-50 to-blue-50 border border-purple-100 p-8 rounded-2xl shadow-lg">
            <div class="flex items-start">
              <div class="flex-shrink-0 pt-1">
                <i class="fas fa-hourglass-half text-[#d4b341] text-2xl"></i>
              </div>
              <div class="mr-3 flex items-center justify-between gap-2 w-full flex-wrap">
                <div>
                  <h3 class="text-xl font-bold text-purple-900">طلب خطوبة نشط</h3>
                  <div class="mt-2 text-gray-700">
                    <p>لديك طلب خطوبة نشط مع
                      <span class="font-medium">
                        @if($marriageRequest)
                        {{ $marriageRequest->user_id === Auth::id() ? $marriageRequest->target->name :
                        $marriageRequest->user->name ?? 'غير محدد' }}
                        @else
                        غير محدد
                        @endif
                      </span>
                    </p>
                  </div>
                </div>
                <div class="mt-4">
                  <a href="{{ route('marriage-requests.status') }}"
                    class="inline-flex items-center px-6 py-2 bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 text-white text-sm font-medium rounded-lg transition-all transform hover:scale-105 shadow-md">
                    <i class="fas fa-clock ml-2"></i>
                    متابعة حالة الطلب
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      @endif
      @endauth
      <div
        class="flex flex-col mt-10 py-8 px-4 sm:px-8 lg:px-16 rounded-3xl lg:flex-row items-center gap-8 lg:gap-16 bg-cover bg-center"
        style="background-image: url('assets/images/frame.png');">

        <div class="w-full lg:w-1/2 space-y-6 text-center lg:text-right bg-white bg-opacity-80 p-4 rounded-lg">
          <h1 class="text-3xl sm:text-4xl font-bold text-purple-900 leading-tight">
            مقياس التوافق الزواجي
          </h1>
          <p class="text-gray-700 text-sm sm:text-base leading-relaxed">
            يساعدك هذا المقياس على معرفة مدى التوافق النفسي والاجتماعي والسلوكي بينك وبين خطيبك، مما يساعد في بناء علاقة متينة وفهم أعمق لشخصياتكما، وبيانات الطرفين مشفرة لا يطلع عليها حتى القائمين على المنصة، وشعار المقياس: إذا احسنت الاختيار ستنعم بالاستقرار.
          </p>
          @auth
          <a href="{{ route('exam.pledge') }}" class="inline-block">
            @else
            <a href="{{ route('login') }}" class="inline-block">
              @endauth
              <button
                class="bg-[#d4b341] hover:bg-yellow-700 text-white px-6 py-3 rounded-3xl transition-colors text-sm sm:text-base">
                اجراء اختبار
              </button>
            </a>
        </div>
        <div class="w-full lg:w-1/2 flex justify-center">
          <img src="/assets/images/2.png" class="w-64 sm:w-80 lg:w-96 h-auto" alt="marriage compatibility test">
        </div>
      </div>
    </section>

    {{-- مقياس التوافق الزواجي Section --}}
    <section class="py-16 px-4 sm:px-8 lg:px-16 bg-gradient-to-br from-purple-50 to-blue-50">
      <div class="container mx-auto px-4">
        <div class="text-center mb-12">
          <h2 class="section-title text-4xl font-bold text-purple-900 mb-4">
            مقياس التوافق الزواجي
          </h2>
          <p class="text-gray-600 text-lg max-w-3xl mx-auto">
            يساعدك هذا المقياس على معرفة مدى التوافق النفسي والاجتماعي والسلوكي بينك وبين خطيبك، مما يساعد في بناء علاقة متينة وفهم أعمق لشخصياتكما، وبيانات الطرفين مشفرة لا يطلع عليها حتى القائمين على المنصة، وشعار المقياس: إذا احسنت الاختيار ستنعم بالاستقرار.
          </p>
        </div>

        <div class="flex justify-center mb-16">
          <div class="text-center">
            <img src="/assets/images/2.png" class="w-80 h-auto mx-auto" alt="marriage compatibility test">
          </div>
        </div>

        <div class="bg-white rounded-2xl p-8 shadow-lg">
          <h3 class="text-2xl font-bold text-purple-900 mb-4 text-center">أهداف المقياس</h3>
          <p class="text-gray-700 text-lg leading-relaxed text-center max-w-4xl mx-auto">
            يهدف هذا المقياس إلى تقييم درجة التوافق بين الشريكين قبل الزواج من خلال استكشاف الجوانب النفسية
            والاجتماعية والسلوكية.
          </p>
          <div class="text-center mt-8">
            @auth
            <a href="{{ route('exam.pledge') }}" class="inline-block">
            @else
            <a href="{{ route('login') }}" class="inline-block">
            @endauth
              <button class="bg-[#d4b341] hover:bg-yellow-700 text-white px-8 py-4 rounded-3xl transition-colors text-lg font-semibold">
                <i class="fas fa-play ml-2"></i>
                ابدأ مقياس التوافق
              </button>
            </a>
          </div>
        </div>
      </div>
    </section>

    {{-- برنامج الزواج الشرعي Section --}}
    <section class="py-16 px-4 sm:px-8 lg:px-16 bg-white">
      <div class="container mx-auto px-4">
        <div class="text-center mb-12">
          <h2 class="section-title text-4xl font-bold text-purple-900 mb-4">
            برنامج الزواج الشرعي
          </h2>
          <p class="text-gray-600 text-lg max-w-3xl mx-auto">
            انضم إلى برنامج الزواج الشرعي للعثور على شريك حياة وفق مقاييس توافق دقيقة بينكما، مع حفاظ تام على خصوصيتك.
          </p>
        </div>
        <center>
          <a href="/marriage-requests">
            <button class="bg-[#d4b341] hover:bg-yellow-700 text-white px-8 py-4 rounded-3xl transition-colors text-lg font-semibold">
              <i class="fas fa-play ml-2"></i>
              انضم إلى البرنامج
            </button>
          </a>

        </center>
       
      </div>
    </section>

    {{-- الدورات Section --}}
    <section class="py-16 px-4 sm:px-8 lg:px-16 bg-gradient-to-br from-blue-50 to-purple-50">
      <div class="container mx-auto px-4">
        <div class="text-center mb-12">
          <h2 class="section-title text-4xl font-bold text-purple-900 mb-4">
            الدورات التدريبية
          </h2>
          <p class="text-gray-600 text-lg max-w-3xl mx-auto">
            دورات متخصصة لتأهيلك للحياة الزوجية وبناء علاقة ناجحة ومستقرة
          </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
          <div class="space-y-6">
            <div class="feature-card p-6 rounded-xl">
              <div class="flex items-center space-x-4 space-x-reverse">
                <div class="text-[#d4b341] text-3xl flex-shrink-0 ml-6">
                  <i class="fas fa-graduation-cap"></i>
                </div>
                <div>
                  <h4 class="text-xl font-bold text-purple-900 mb-2">دورة التأهيل للحياة الزوجية</h4>
                  <p class="text-gray-700">دورة شاملة تغطي جميع جوانب الحياة الزوجية الناجحة</p>
                </div>
              </div>
            </div>

            <div class="feature-card p-6 rounded-xl">
              <div class="flex items-center space-x-4 space-x-reverse">
                <div class="text-[#d4b341] text-3xl flex-shrink-0 ml-6">
                  <i class="fas fa-video"></i>
                </div>
                <div>
                  <h4 class="text-xl font-bold text-purple-900 mb-2">محتوى تفاعلي</h4>
                  <p class="text-gray-700">فيديوهات تعليمية ومواد تفاعلية لضمان أفضل تجربة تعلم</p>
                </div>
              </div>
            </div>

            <div class="feature-card p-6 rounded-xl">
              <div class="flex items-center space-x-4 space-x-reverse">
                <div class="text-[#d4b341] text-3xl flex-shrink-0 ml-6">
                  <i class="fas fa-certificate"></i>
                </div>
                <div>
                  <h4 class="text-xl font-bold text-purple-900 mb-2">شهادة إنجاز</h4>
                  <p class="text-gray-700">احصل على شهادة معتمدة عند إكمال الدورة بنجاح</p>
                </div>
              </div>
            </div>
          </div>
          <div class="text-center">
            <div class="bg-white rounded-2xl p-8 shadow-lg">
              <div class="w-20 h-20 bg-gradient-to-r from-blue-100 to-purple-100 rounded-full flex items-center justify-center mb-6 mx-auto">
                <i class="fas fa-book-open text-purple-900 text-4xl"></i>
              </div>
              <h3 class="text-2xl font-bold text-purple-900 mb-4">
                ابدأ رحلة التعلم
              </h3>
              <p class="text-gray-700 leading-relaxed text-lg mb-8">
                انضم إلى دوراتنا التدريبية المتخصصة واكتسب المهارات اللازمة لبناء حياة زوجية سعيدة
              </p>
              <a href="{{ route('courses.index') }}"
                class="bg-[#d4b341] hover:bg-yellow-700 text-white px-8 py-4 rounded-3xl transition-colors text-lg font-semibold inline-block">
                <i class="fas fa-play ml-2"></i>
                تصفح الدورات
              </a>
            </div>
          </div>
        </div>
      </div>
    </section>

    {{-- الاستشارات الاسرية والزواجية Section --}}
    <section class="py-16 px-4 sm:px-8 lg:px-16 bg-white">
      <div class="container mx-auto px-4">
        <div class="text-center mb-12">
          <h2 class="section-title text-4xl font-bold text-purple-900 mb-4">
            الاستشارات الأسرية والزواجية
          </h2>
          {{-- <p class="text-gray-600 text-lg max-w-3xl mx-auto">
            احصل على استشارات متخصصة من خبراء في العلاقات الأسرية والزواجية
          </p> --}}
        </div>

        {{-- Hidden cards - will be restored later --}}
        {{-- 
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
          <div class="feature-card p-6 rounded-xl text-center">
            <div class="w-16 h-16 bg-gradient-to-r from-green-100 to-blue-100 rounded-full flex items-center justify-center mb-4 mx-auto">
              <i class="fas fa-user-md text-green-600 text-2xl"></i>
            </div>
            <h4 class="text-lg font-bold text-purple-900 mb-2">استشارة طبيب</h4>
            <p class="text-gray-700 text-sm mb-4">استشارات طبية متخصصة</p>
            <a href="{{ route('doctor-counseling') }}"
              class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg transition-colors text-sm">
              اطلب استشارة
            </a>
          </div>

          <div class="feature-card p-6 rounded-xl text-center">
            <div class="w-16 h-16 bg-gradient-to-r from-blue-100 to-indigo-100 rounded-full flex items-center justify-center mb-4 mx-auto">
              <i class="fas fa-balance-scale text-blue-600 text-2xl"></i>
            </div>
            <h4 class="text-lg font-bold text-purple-900 mb-2">استشارة قانوني</h4>
            <p class="text-gray-700 text-sm mb-4">استشارات قانونية متخصصة</p>
            <a href="{{ route('legal-counseling') }}"
              class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition-colors text-sm">
              اطلب استشارة
            </a>
          </div>

          <div class="feature-card p-6 rounded-xl text-center">
            <div class="w-16 h-16 bg-gradient-to-r from-yellow-100 to-orange-100 rounded-full flex items-center justify-center mb-4 mx-auto">
              <i class="fas fa-brain text-yellow-600 text-2xl"></i>
            </div>
            <h4 class="text-lg font-bold text-purple-900 mb-2">استشارة نفسية</h4>
            <p class="text-gray-700 text-sm mb-4">استشارات نفسية متخصصة</p>
            <a href="{{ route('psychic-counseling') }}"
              class="bg-yellow-600 hover:bg-yellow-700 text-white px-4 py-2 rounded-lg transition-colors text-sm">
              اطلب استشارة
            </a>
          </div>
        </div>
        --}}

        {{-- Full-width Family Counseling Card --}}
        <div class="bg-gradient-to-br from-purple-50 via-pink-50 to-indigo-50 rounded-3xl p-8 md:p-12 shadow-2xl border border-purple-100 overflow-hidden relative">
          {{-- Background Pattern --}}
          <div class="absolute inset-0 opacity-5">
            <div class="absolute top-0 left-0 w-32 h-32 bg-purple-400 rounded-full -translate-x-16 -translate-y-16"></div>
            <div class="absolute top-0 right-0 w-24 h-24 bg-pink-400 rounded-full translate-x-12 -translate-y-12"></div>
            <div class="absolute bottom-0 left-0 w-40 h-40 bg-indigo-400 rounded-full -translate-x-20 translate-y-20"></div>
            <div class="absolute bottom-0 right-0 w-28 h-28 bg-purple-300 rounded-full translate-x-14 translate-y-14"></div>
          </div>
          
          <div class="relative z-10">
            <div class="flex flex-col lg:flex-row items-center gap-8 lg:gap-12">
              {{-- Icon and Title Section --}}
              <div class="flex-shrink-0 text-center lg:text-right">
                <div class="w-24 h-24 bg-gradient-to-br from-purple-500 to-pink-500 rounded-full flex items-center justify-center mb-6 mx-auto lg:mx-0 shadow-lg">
                  <i class="fas fa-home text-white text-3xl"></i>
                </div>
                <h3 class="text-3xl md:text-4xl font-bold text-purple-900 mb-2">

                  استشارات أسرية
                </h3>
                <div class="w-20 h-1 bg-gradient-to-r from-purple-500 to-pink-500 rounded-full mx-auto lg:mx-0"></div>
              </div>

              {{-- Content Section --}}
              <div class="flex-1 text-center lg:text-right">
                <p class="text-gray-700 text-lg md:text-xl leading-relaxed mb-6 max-w-2xl mx-auto lg:mx-0">
                  احصل على استشارات متخصصة من خبراء مؤهلين في العلاقات الأسرية والزواجية. 
                  نقدم لك الدعم والاستشارة في جميع جوانب الحياة الأسرية لبناء علاقات قوية ومستقرة.
                </p>
                
                {{-- Features List --}}
                {{-- <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-8">
                  <div class="flex items-center justify-center lg:justify-start gap-3">
                    <div class="w-8 h-8 bg-purple-100 rounded-full flex items-center justify-center">
                      <i class="fas fa-check text-purple-600 text-sm"></i>
                    </div>
                    <span class="text-gray-700 font-medium">استشارات زواجية متخصصة</span>
                  </div>
                  <div class="flex items-center justify-center lg:justify-start gap-3">
                    <div class="w-8 h-8 bg-purple-100 rounded-full flex items-center justify-center">
                      <i class="fas fa-check text-purple-600 text-sm"></i>
                    </div>
                    <span class="text-gray-700 font-medium">حل المشاكل الأسرية</span>
                  </div>
                  <div class="flex items-center justify-center lg:justify-start gap-3">
                    <div class="w-8 h-8 bg-purple-100 rounded-full flex items-center justify-center">
                      <i class="fas fa-check text-purple-600 text-sm"></i>
                    </div>
                    <span class="text-gray-700 font-medium">تأهيل ما قبل الزواج</span>
                  </div>
                  <div class="flex items-center justify-center lg:justify-start gap-3">
                    <div class="w-8 h-8 bg-purple-100 rounded-full flex items-center justify-center">
                      <i class="fas fa-check text-purple-600 text-sm"></i>
                    </div>
                    <span class="text-gray-700 font-medium">استشارات سرية ومضمونة</span>
                  </div>
                </div> --}}

                {{-- CTA Button --}}
                <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                  <a href="{{ route('family-counseling') }}"
                    class="bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 text-white px-8 py-4 rounded-2xl transition-all duration-300 transform hover:scale-105 shadow-lg font-semibold text-lg inline-flex items-center justify-center gap-3">
                    <i class="fas fa-calendar-check"></i>
                    اطلب الاستشارة الان
                  </a>
                  <a href="/family-counseling/public"
                  class="border-2 border-purple-600 text-purple-600 hover:bg-purple-600 hover:text-white px-8 py-4 rounded-2xl transition-all duration-300 font-semibold text-lg inline-flex items-center justify-center gap-3">
                  <i class="fas fa-eye"></i>
                  مشاهدة الاستشارات السابقة
                </a>
               
                </div>
              </div>
            </div>
          </div>
        </div>
{{-- 
        <div class="text-center mt-12">
          <div class="bg-gradient-to-r from-purple-50 to-pink-50 border border-purple-100 p-8 rounded-2xl shadow-lg max-w-4xl mx-auto">
            <h3 class="text-2xl font-bold text-purple-900 mb-4">
              احصل على المساعدة التي تحتاجها
            </h3>
            <p class="text-gray-700 leading-relaxed text-lg mb-6">
              فريقنا من الخبراء المتخصصين جاهز لتقديم الدعم والاستشارة في جميع جوانب الحياة الأسرية والزواجية
            </p>
            <div class="flex flex-wrap justify-center gap-4">
              <a href="{{ route('legitimate-counseling') }}"
                class="bg-[#d4b341] hover:bg-yellow-700 text-white px-6 py-3 rounded-3xl transition-colors font-semibold">
                <i class="fas fa-gavel ml-2"></i>
                استشارة شرعية
              </a>
            </div>
          </div>
        </div> --}}
      </div>
    </section>
    @guest
    <section class="my-16 px-4 sm:px-8 lg:px-16">
      <div
        class="rounded-3xl p-6 border-2 flex flex-col items-center justify-center gap-12 bg-cover bg-center min-h-[250px]"
        style="background-image: url('assets/images/frame.png');">
        <div class="text-center md:text-right bg-white bg-opacity-80 p-4 pb-0 rounded-lg">
          <h3 class="text-[#58306D] font-bold text-2xl mb-2">انضم الآن لعضوية الموقع</h3>
          <p class="text-[#58306D] text-sm sm:text-base leading-relaxed">
            احصل على كافة خدمات المنصة بشكل مجاني          </p>
        </div>
        <div class="mt-2 md:mt-0">
          <a href="{{ route('register') }}"
            class="bg-[#d4b341] hover:bg-yellow-700 text-white px-6 py-3 rounded-3xl transition-colors text-sm sm:text-base">
            تسجيل عضوية
          </a>
        </div>
      </div>
    </section>
    @endguest

    <footer class="bg-purple-900 text-white pt-12">
      <div class="container mx-auto px-12">
        <div class="grid grid-cols-1 md:grid-cols-5 gap-14 border-b border-purple-800 pb-12">
          <div class="md:col-span-2">
            <h4 class="text-xl font-bold mb-6">عن الموقع</h4>
            <p class="text-gray-300">
              هو منصة إلكترونية يديرها د.حمود النوفلي من سلطنة عمان، ويقدم فيها خدمات مجانية في كل ما يحتاج له الشباب
              المقبلين على
              الزواج والمتزوجين حديثاً، من تأهيل واستشارات وخدمات ومقاييس ودورات وكتب تمكنهم من بناء حياة أسرية سعيدة
              بعيداً عن
              المشكلات و التفكك الأسري.
            </p>
          </div>

          <div>
            <h4 class="text-xl font-bold mb-6">روابط سريعة</h4>
            <ul class="space-y-3">
                  <li><a href="{{ route('terms') }}" class="hover:text-[#d4b341] transition-colors">الشروط والأحكام</a></li>
                  <li><a href="{{ route('privacy') }}" class="hover:text-[#d4b341] transition-colors">سياسة الخصوصية</a></li>
                  <li><a href="#" class="hover:text-[#d4b341] transition-colors">الأسئلة الشائعة</a></li>
                  <li><a href="#" class="hover:text-[#d4b341] transition-colors">المدونة</a></li>
            </ul>
          </div>

          <div>
            <h4 class="text-xl font-bold mb-6">تواصل معنا</h4>
            <ul class="space-y-3">
              <li class="flex items-center">
                <i class="fas fa-phone ml-2 text-[#d4b341]"></i>
                0096894128090
              </li>
              <li class="flex items-center">
                <i class="fas fa-envelope ml-2 text-[#d4b341]"></i>
                info@zawaj-almawada.com
              </li>
            </ul>
          </div>

          <div>
            <h4 class="text-xl font-bold mb-6">تابعنا</h4>
            <div class="flex space-x-2 gap-4">
              <a href="https://www.instagram.com/hamoodalnoofli/" class="social-icon hover:-translate-y-1"
                target="_blank">
                <i class="fab fa-instagram"></i>
              </a>
              <a href="https://x.com/molhim399?s=08" class="social-icon hover:-translate-y-1">
                <i class="fab fa-twitter"></i>
              </a>
              <a href="https://www.youtube.com/channel/UC6pJW3_VsKH1M1NqbkeYITQ"
                class="social-icon hover:-translate-y-1" target="_blank">
                <i class="fab fa-youtube"></i>
              </a>
            </div>
          </div>
        </div>

        <div class="py-4 text-center text-white">
          جميع الحقوق محفوظة © زواج المودة 2025
        </div>
      </div>
    </footer>
  </div>
  @endif

  <script>
    $(document).ready(function() {
      $('#menu-toggle').click(function() {
        $('#mobile-menu').slideToggle(300);
      });
    });
  </script>
</body>

</html>