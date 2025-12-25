<x-app-layout>
    <div>
        <div x-data="{
                    search: '',
                    rows: [],
                    init() {
                        this.rows = Array.from(this.$refs.tbody.children)
                    }
                }" class="space-y-6">
            <!-- رسالة التنبيه -->
            @if (session()->has('message'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('message') }}</span>
            </div>
            @endif
            @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>• {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <div class="flex justify-between items-center">
                <h2 class="text-3xl font-bold text-slate-800">
                    @if(auth()->user()->role === 'president')
                    إدارة المحجوزات الرئاسة
                    @elseif(auth()->user()->role === 'parquet')
                    إدارة المحجوزات النيابة العامة
                    @else
                    إدارة المحجوزات
                    @endif
                </h2>
                @if(auth()->user()->role === 'parquet' || auth()->user()->role === 'admin')
                <x-create-reservation-modal>
                    <x-slot name="trigger">
                        <button
                            class="bg-gradient-to-r from-blue-600 to-blue-700 
                        text-white px-6 py-3 rounded-lg 
                        hover:from-blue-700 hover:to-blue-800 
                        transition-all duration-200 shadow-lg">
                            + حجز جديد
                        </button>
                    </x-slot>
                </x-create-reservation-modal>
                @endif
            </div>

            <div class="relative flex items-center mt-4 md:mt-0">
                <span class="absolute">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mx-3 text-gray-400 dark:text-gray-600">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                    </svg>
                </span>

                <input x-model="search" type="text" placeholder="بحث..." class="block w-full py-1.5 pr-5 text-gray-700 bg-white border border-gray-200 rounded-lg md:w-80 placeholder-gray-400/70 pl-11 rtl:pr-11 rtl:pl-5 dark:bg-gray-900 dark:text-gray-300 dark:border-gray-600 focus:border-blue-400 dark:focus:border-blue-300 focus:ring-blue-300 focus:outline-none focus:ring focus:ring-opacity-40">
            </div>

            <!-- بطاقات الحجوزات -->
            <div class="flex flex-col mt-6">
                <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                        <div class="overflow-hidden border border-gray-200 dark:border-gray-700 md:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead class="bg-gray-50 dark:bg-gray-800">
                                    <tr>
                                        <th scope="col" class="py-3.5 px-4 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                            <button class="flex items-center gap-x-3 focus:outline-none">
                                                <span>رقم</span>
                                                <svg class="h-3" viewBox="0 0 10 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <!-- SVG code -->
                                                </svg>
                                            </button>
                                        </th>
                                        <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                            تاريخ التسجيل
                                        </th>
                                        <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                            رقم المحضر
                                        </th>
                                        <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                            رقم الملف
                                        </th>
                                        <th scope="col" class="px-12 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                            نوع المحجوزات
                                        </th>
                                        <th scope="col" class="px-12 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                            وصف المحجوزات
                                        </th>
                                        <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                            اسم الشخص التي تم الحجز منه
                                        </th>
                                        @if(auth()->user()->role === 'admin' || auth()->user()->role === 'president')
                                        <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                            تاريخ التوصل للرئاسة
                                        </th>
                                        <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                            ملاحظات
                                        </th>
                                        @endif
                                        <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                            تعديلات
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200 dark:divide-gray-700 dark:bg-gray-900">
                                    @forelse($reservations as $reservation)
                                    <tr x-show="
                                    search === '' ||
                                    '{{ $reservation->number_report }}'.toLowerCase().includes(search.toLowerCase()) ||
                                    '{{ $reservation->number_file }}'.toLowerCase().includes(search.toLowerCase())">
                                        <td class="px-4 py-4 text-sm text-center font-medium text-gray-700 whitespace-nowrap">
                                            {{ $reservation->number }}
                                        </td>
                                        <td class="px-4 py-4 text-sm text-center text-gray-500 whitespace-nowrap">
                                            {{ $reservation->created_at->format('Y-m-d') }}
                                        </td>
                                        <td class="px-4 py-4 text-sm text-center text-gray-500 whitespace-nowrap">
                                            {{ $reservation->number_report }}
                                        </td>
                                        <td class="px-4 py-4 text-sm text-center text-gray-500 whitespace-nowrap">
                                            {{ $reservation->number_file }}
                                        </td>
                                        <td class="px-12 py-4 text-sm text-center text-gray-500 whitespace-nowrap">
                                            {{ $reservation->type_reserved === 'precious' ? 'ثمين' : '' }}
                                            {{ $reservation->type_reserved === 'currencyMad' ? 'عملة محلية' : '' }}
                                            {{ $reservation->type_reserved === 'weaponWhite' ? 'سلاح ابيض' : '' }}
                                            {{ $reservation->type_reserved === 'firearm' ? 'سلاح ناري' : '' }}
                                            {{ $reservation->type_reserved === 'currencyInter' ? 'عملة صعبة' : '' }}
                                            {{ $reservation->type_reserved === 'normal' ? 'عادي' : '' }}
                                            {{ $reservation->type_reserved === 'drugs' ? 'مخدرات' : ''  }}
                                        </td>
                                        <td class="px-12 py-4 text-sm text-center text-gray-500 whitespace-nowrap">
                                            {{ Str::limit($reservation->description, 50) }}
                                        </td>
                                        <td class="px-4 py-4 text-sm text-center text-gray-500 whitespace-nowrap">
                                            {{ $reservation->name_of_whos_reserved }}
                                        </td>
                                        @if(auth()->user()->role === 'admin' || auth()->user()->role === 'president')
                                        <td class="px-4 py-4 text-sm text-center text-gray-500 whitespace-nowrap">
                                            {{ $reservation->date_receipt ?? '---' }}
                                        </td>
                                        <td class="px-4 py-4 text-sm text-center text-gray-500 whitespace-nowrap">
                                            {{ $reservation->notes }}
                                        </td>
                                        @endif
                                        <td class="px-4 py-4 text-sm whitespace-nowrap">
                                            <div class="flex items-center gap-x-2">
                                                <x-edit-reservation-modal :reservation="$reservation">
                                                    <x-slot name="trigger">
                                                        <button
                                                            class="text-blue-600 hover:text-blue-900">
                                                            تعديل
                                                        </button>
                                                    </x-slot>
                                                </x-edit-reservation-modal>
                                                @if(auth()->user()->role === 'admin')
                                                <x-reservation-delete-modal :reservation="$reservation">
                                                    <x-slot name="trigger">
                                                        <button
                                                            class="text-red-600 hover:text-red-900">
                                                            حذف
                                                        </button>
                                                    </x-slot>
                                                </x-reservation-delete-modal>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="12" class="px-4 py-4 text-sm text-center text-gray-500">
                                            لا توجد حجوزات
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>