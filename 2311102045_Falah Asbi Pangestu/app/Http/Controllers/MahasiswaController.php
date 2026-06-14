<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;

class MahasiswaController extends Controller
{
    public function index()
    {
        return view('mahasiswa');
    }

    public function data()
    {
        return response()->json(
            Mahasiswa::all()
        );
    }

    public function store(Request $request)
    {
        Mahasiswa::create([
            'nama' => $request->nama,
            'nim' => $request->nim,
            'prodi' => $request->prodi,
            'email' => $request->email
        ]);

        return response()->json([
            'success' => true
        ]);
    }

    public function edit($id)
    {
        return response()->json(
            Mahasiswa::findOrFail($id)
        );
    }

    public function update(Request $request, $id)
    {
        $mhs = Mahasiswa::findOrFail($id);

        $mhs->update([
            'nama' => $request->nama,
            'nim' => $request->nim,
            'prodi' => $request->prodi,
            'email' => $request->email
        ]);

        return response()->json([
            'success' => true
        ]);
    }

    public function destroy($id)
    {
        Mahasiswa::findOrFail($id)->delete();

        return response()->json([
            'success' => true
        ]);
    }
}