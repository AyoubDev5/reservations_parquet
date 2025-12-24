<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use function Laravel\Prompts\info;

class UserController extends Controller
{
    //
    public function index()
    {
        if (!Auth::check()) {
            abort(401);
        }

        $users = User::all();

        return view('livewire.users-index', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'role' => 'required|in:admin,president,parquet',
            'password' => 'required|min:6',
        ]);

        User::create([
            'username' => $request->username,
            'role' => $request->role,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->back()->with('success', 'تم اضافة المستخدم بنجاح');
    }
    public function update(Request $request, User $user)
    {

        $id = User::find($user->id);
        if(!$id){
            return redirect()->back()->with('error', 'المستخدم غير موجود');
        }
        $data = $request->validate([
            'username' => 'required',
            'role' => 'required|in:admin,president,parquet',
            'password' => 'nullable|min:6',
        ]);

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        } else {
            unset($data['password']);
        }
        
        $user->update($data);

        return back()->with('success', 'تم التحديث بنجاح');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return back()->with('success', 'تم الحذف بنجاح');
    }
}
