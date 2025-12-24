<div x-data="{ open: false }">

    <!-- Trigger -->
    <div @click="open = true">
        {{ $trigger }}
    </div>

    <!-- Overlay -->
    <div x-show="open" x-transition class="fixed inset-0 z-50 flex items-center justify-center bg-black/50">
        <div @click.away="open = false"
            class="w-full max-w-sm p-6 bg-white rounded-lg shadow dark:bg-gray-900">

            <h2 class="mb-4 text-lg font-semibold text-gray-800 dark:text-white">
                تأكيد الحذف
            </h2>

            <p class="mb-6 text-gray-600 dark:text-gray-400">
                هل أنت متأكد من حذف المحجوز؟
            </p>

            <form method="POST" action="{{ route('reservations.delete', $reservation->id) }}">
                @csrf
                @method('DELETE')

                <div class="flex justify-end gap-2">
                    <button type="button" @click="open = false"
                        class="px-4 py-2 border rounded-lg">
                        الغاء
                    </button>
                    <button type="submit"
                        class="px-4 py-2 text-white bg-red-500 rounded-lg hover:bg-red-600">
                        حذف
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
