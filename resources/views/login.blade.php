<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>تسجيل الدخول - ادارة المحجوزات</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
     <link rel="logo" sizes="180x180" href="{{ asset('logo.png') }}">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="bg-gradient-to-br from-slate-50 to-slate-100 min-h-screen font-sans">  
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-slate-50 to-slate-100">
        <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
            <img src="{{ asset('logo.png') }}" alt="Logo" class="mx-auto mb-6 w-24 h-24">
            <h2 class="text-2xl font-bold mb-6 text-center text-slate-800">تسجيل الدخول إلى حسابك</h2>
            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                <div>
                    <label for="username" class="block text-sm font-medium text-slate-700"> إسم المستخدم</label>
                    <input id="username" type="username" name="username" required autofocus
                           class="mt-1 block w-full px-4 py-2 border border-slate-300 rounded-lg 
                                  focus:outline-none focus:ring-2 focus:ring-blue-500 
                                  focus:border-blue-500 transition duration-200">
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-slate-700">كلمة المرور</label>
                    <input id="password" type="password" name="password" required
                           class="mt-1 block w-full px-4 py-2 border border-slate-300 rounded-lg 
                                  focus:outline-none focus:ring-2 focus:ring-blue-500 
                                  focus:border-blue-500 transition duration-200">
                </div>

                <div>
                    <button type="submit"
                            class="w-full bg-gradient-to-r from-blue-600 to-blue-700 
                                   text-white px-4 py-2 rounded-lg 
                                   hover:from-blue-700 hover:to-blue-800 
                                   transition-all duration-200 shadow-lg">
                        تسجيل الدخول
                    </button>
                </div>
            </form>
        </div>
    </div>

    @livewireScripts
</body>

</html>