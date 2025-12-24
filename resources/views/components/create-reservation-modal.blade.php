<div x-data="{ open: false }">

    <!-- زر الفتح -->
    <div @click="open = true">
        {{ $trigger }}
    </div>

    <!-- الخلفية -->
    <div
        x-show="open"
        x-transition
        class="fixed inset-0 z-50 bg-black/50 flex items-center justify-center">

        <!-- المودال -->
        <div
            @click.away="open = false"
            class="w-full max-w-lg bg-white rounded-lg shadow-xl">

            <!-- Header -->
            <div class="flex items-center justify-between p-4 border-b">
                <h3 class="text-xl font-semibold">إضافة محجوز</h3>
                <button @click="open = false" class="text-gray-500 hover:text-red-600">
                    ✕
                </button>
            </div>

            <!-- Form -->
            <form method="POST" action="{{ route('reservations.store') }}" class="p-6 space-y-4">
                @csrf
                <div>
                    <label class="block text-sm">رقم المحجوز</label>
                    <input name="number" required class="w-full border rounded px-3 py-2">
                </div>

                <div>
                    <label class="block text-sm">رقم المحضر</label>
                    <input name="number_report" required class="w-full border rounded px-3 py-2">
                </div>

                <div>
                    <label class="block text-sm">رقم الملف</label>
                    <input name="number_file" required class="w-full border rounded px-3 py-2">
                </div>

                <div>
                    <label class="block text-sm">نوع المحجوزات</label>
                    <select name="type_reserved" required class="w-full border rounded px-3 py-2">
                        <option value="">اختر</option>
                        <option value="precious">محجوز ثمين</option>
                        <option value="currency">عمولة</option>
                        <option value="drugs">مخدرات</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm">الوصف</label>
                    <textarea name="description" class="w-full border rounded px-3 py-2"></textarea>
                </div>

                <div>
                    <label class="block text-sm">اسم الشخص</label>
                    <input name="name_of_whos_reserved" required class="w-full border rounded px-3 py-2">
                </div>

                @if(auth()->user()->role === 'admin' || auth()->user()->role === 'president')
                <div>
                    <label class="block text-sm"> تاريخ التوصل بالرئاسة </label>
                    <input type="date" name="date_receipt" class="w-full border rounded px-3 py-2">
                </div>
                <div>
                    <label class="block text-sm">ملاحظات</label>
                    <textarea name="notes" class="w-full border rounded px-3 py-2"></textarea>
                </div>
                @endif
                <!-- Footer -->
                <div class="flex justify-end gap-2 pt-4 border-t">
                    <button type="button" @click="open = false"
                        class="px-4 py-2 border rounded">
                        إلغاء
                    </button>
                    <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded">
                        حفظ
                    </button>
                </div>
            </form>
             @if ($errors->any())
            <div class="mb-4 p-3 text-sm text-red-600 bg-red-100 rounded">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
        </div>
    </div>
</div>