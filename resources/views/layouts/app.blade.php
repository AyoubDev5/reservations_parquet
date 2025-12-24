<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/@tailwindplus/elements@1" type="module"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="//unpkg.com/alpinejs" defer=""></script>
    @livewireStyles
</head>

<body class="bg-gradient-to-br from-slate-50 to-slate-100 min-h-screen font-sans flex flex-col">

    <livewire:layout.navbar />

    <main class="container mx-auto px-4 py-8 flex-grow">
        {{ $slot }}
    </main>

    <livewire:layout.footer />

    @livewireScripts
    @livewireScriptConfig

    <script>
        // لأزرار التأكيد على الحذف
        document.addEventListener('livewire:load', function() {
            Livewire.on('confirmDelete', id => {
                if (confirm('هل أنت متأكد من الحذف؟')) {
                    Livewire.emit('deleteConfirmed', id);
                }
            });
        });
    </script>
</body>

</html>