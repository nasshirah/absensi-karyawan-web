<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class KaryawanController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->string('q')->toString();
        $users = User::query()
            ->when($q, fn($query) => $query->where(fn($sub) => $sub->where('name','like',"%{$q}%")->orWhere('email','like',"%{$q}%")))
            ->role('karyawan')
            ->orderBy('name')
            ->paginate(10)->withQueryString();

        return view('admin.karyawan.index', compact('users','q'));
    }

    public function create()
    {
        return view('admin.karyawan.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required','string','max:255'],
            'email' => ['required','email','max:255','unique:users,email'],
            'password' => ['required','string','min:8'],
            'nip' => ['nullable','string','max:50'],
            'division' => ['nullable','string','max:100'],
            'position' => ['nullable','string','max:100'],
            'phone' => ['nullable','string','max:50'],
            'join_date' => ['nullable','date'],
            'status' => ['nullable','string','max:50'],
        ]);

        $user = new User();
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = Hash::make($data['password']);
        $user->nip = $data['nip'] ?? null;
        $user->division = $data['division'] ?? null;
        $user->position = $data['position'] ?? null;
        $user->phone = $data['phone'] ?? null;
        $user->join_date = $data['join_date'] ?? null;
        $user->status = $data['status'] ?? null;
        $user->save();
        if (method_exists($user, 'assignRole')) {
            $user->assignRole('karyawan');
        }

        return redirect()->route('admin.karyawan.index')->with('success', 'Karyawan berhasil ditambahkan.');
    }

    public function edit(User $karyawan)
    {
        return view('admin.karyawan.edit', ['user' => $karyawan]);
    }

    public function update(Request $request, User $karyawan)
    {
        $data = $request->validate([
            'name' => ['required','string','max:255'],
            'email' => ['required','email','max:255','unique:users,email,'.$karyawan->id],
            'password' => ['nullable','string','min:8'],
            'nip' => ['nullable','string','max:50'],
            'division' => ['nullable','string','max:100'],
            'position' => ['nullable','string','max:100'],
            'phone' => ['nullable','string','max:50'],
            'join_date' => ['nullable','date'],
            'status' => ['nullable','string','max:50'],
        ]);

        $karyawan->fill($data);
        if (!empty($data['password'])) {
            $karyawan->password = Hash::make($data['password']);
        }
        $karyawan->save();

        if (method_exists($karyawan, 'syncRoles')) {
            $karyawan->syncRoles(['karyawan']);
        }

        return redirect()->route('admin.karyawan.index')->with('success', 'Karyawan berhasil diperbarui.');
    }

    public function destroy(User $karyawan)
    {
        $karyawan->delete();
        return redirect()->route('admin.karyawan.index')->with('success', 'Karyawan berhasil dihapus.');
    }
}

