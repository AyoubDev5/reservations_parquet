<div x-data="{ open: false }">

    <!-- Trigger -->
    <div @click="open = true">
        {{ $trigger }}
    </div>

    <!-- Overlay -->
    <div x-show="open" x-transition class="fixed inset-0 z-50 flex items-center justify-center bg-black/50">
        <div @click.away="open = false"
            class="w-full max-w-md p-6 bg-white rounded-lg shadow dark:bg-gray-900">

            <div class="flex justify-between mb-4">
                <h2 class="text-lg font-semibold text-gray-800 dark:text-white">
                    تعديل المستخدم
                </h2>
                <button @click="open = false">✕</button>
            </div>

            <form method="POST" action="{{ route('users.update', $user->id) }}" class="space-y-4">
                @csrf
                @method('PUT')
                <div>
                    <label class="block text-sm text-gray-600 dark:text-gray-300">اسم المستخدم</label>
                    <input type="text" name="username" required value="{{ $user->username }}"
                        class="w-full mt-1 px-3 py-2 border rounded-lg focus:ring focus:ring-blue-300 dark:bg-gray-800 dark:text-white">
                </div>


                <div>
                    <label class="block text-sm text-gray-600 dark:text-gray-300"> صنف المستخدم</label>
                    <select name="role" required
                        class="w-full mt-1 px-3 py-2 border rounded-lg focus:ring focus:ring-blue-300 dark:bg-gray-800 dark:text-white">
                        <option value="parquet" {{ $user->role === 'parquet' ? 'selected' : '' }}>مستخدم نيابة العامة</option>
                        <option value="president" {{ $user->role === 'president' ? 'selected' : '' }}>مستخدم الرئاسة </option>
                        <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>مدبر نظام</option>
                    </select>
                </div>

                <!-- Password -->
                <div>
                    <label class="block text-sm text-gray-600 dark:text-gray-300">كلمة المرور</label>
                    <input type="password" name="password" placeholder="كلمة مرور جديدة (اختياري)"
                        class="w-full mt-1 px-3 py-2 border rounded-lg focus:ring focus:ring-blue-300 dark:bg-gray-800 dark:text-white">
                </div>

                <!-- Submit -->
                <div class="flex justify-end gap-2">
                    <button type="button" @click="open = false"
                        class="px-4 py-2 text-sm text-gray-600 border rounded-lg">
                        الغاء
                    </button>

                    <button type="submit"
                        class="px-4 py-2 text-sm text-white bg-blue-500 rounded-lg hover:bg-blue-600">
                        تحديث
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