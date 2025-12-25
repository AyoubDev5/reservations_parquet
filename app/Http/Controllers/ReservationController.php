<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ReservationController extends Controller
{
    //
    public function index()
    {
        $reservations = Reservation::latest()->get();
        return view('livewire.reservation-index', compact('reservations'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'number' => [
                'required',
                'string',
                Rule::unique('reservations', 'number'),
            ],
            'number_report' => [
                'required',
                'string',
                Rule::unique('reservations', 'number_report'),
            ],
            'number_file' => [
                'required',
                'string',
                Rule::unique('reservations', 'number_file'),
            ],
            'type_reserved' => 'required|string|max:255',
            'description' => 'required|string',
            'name_of_whos_reserved' => 'required|string|max:255',
            'date_receipt' => 'nullable|date',
            'notes' => 'nullable|string',
        ], [
            // رسائل مخصصة
            'number.unique' => 'رقم المحجوز موجود مسبقاً',
            'number_report.unique' => 'رقم المحضر موجود مسبقاً',
            'number_file.unique' => 'رقم الملف موجود مسبقاً',
        ]);

        Reservation::create($data + [
            'user_id' => auth()->id(),
        ]);

        return back()->with('message', 'تم إنشاء الحجز بنجاح');
    }

    public function update(Request $request, Reservation $reservation)
    {
        // dd($request->all());
        $data = $request->validate([
            'number' => 'required|string',
            'number_report' => 'required|string|max:255',
            'number_file' => 'required|string|max:255',
            'type_reserved' => 'required|string|max:255',
            'description' => 'required|string',
            'name_of_whos_reserved' => 'required|string|max:255',
            'date_receipt' => 'nullable|date',
            'notes' => 'nullable|string',
        ]);
        $reservation->update($data);
        return back()->with('message', 'تم تحديث الحجز بنجاح');
    }

    public function destroy(Reservation $reservation)
    {
        $reservation->delete();
        return back()->with('message', 'تم حذف الحجز');
    }
}
