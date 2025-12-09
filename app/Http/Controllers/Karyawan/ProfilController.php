<?php

namespace App\Http\Controllers\Karyawan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfilController extends Controller
{
    public function index()
    {
        return view('karyawan.profil', ['user' => Auth::user(), 'title' => 'Profil']);
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:50',
            'division' => 'nullable|string|max:100',
            'position' => 'nullable|string|max:100',
        ]);

        $user->fill($data);
        $user->save();

        return back()->with('success', 'Profil diperbarui.');
    }
}

