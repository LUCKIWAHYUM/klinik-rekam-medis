<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $no = 1;
        $user = User::get();
        return view('pages.user', compact(
            'user',
            'no'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
    try {
        $data = $request->all();
        $data['password'] = Hash::make($data['password']);
        User::create($data);
        return redirect()->route('user.index')->with('success', 'Pengguna "' . $request->name . '" berhasil ditambahkan.');
    } catch (\Exception $e) {
        return redirect()->route('user.index')->with('error', 'Gagal menambahkan pengguna: ' . $e->getMessage());
    }
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
        public function update(Request $request, $id)
        {
    try {
        $user = User::findOrFail($id);

        $request->validate([
            'email' => 'required|email',
            'name' => 'required',
            'password' => 'required',
            'role' => 'required',
        ]);

        $user->update($request->all());

        return redirect()->route('user.index')->with('success', 'Pengguna "' . $user->name . '" berhasil diperbarui.');
    } catch (\Exception $e) {
        return redirect()->route('user.index')->with('error', 'Gagal memperbarui pengguna: ' . $e->getMessage());
    }
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
    try {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('user.index')->with('success', 'Pengguna "' . $user->name . '" berhasil dihapus.');
    } catch (\Exception $e) {
        return redirect()->route('user.index')->with('error', 'Gagal menghapus pengguna: ' . $e->getMessage());
    }
}
}

