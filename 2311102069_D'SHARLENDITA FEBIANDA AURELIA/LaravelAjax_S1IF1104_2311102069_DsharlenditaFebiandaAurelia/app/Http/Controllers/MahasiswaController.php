<?php

namespace App\Http\Controllers;

class MahasiswaController extends Controller
{
    public function index()
    {
        return view('mahasiswa');
    }

    public function getData()
    {
        $path = storage_path('app/data/mahasiswa.json');

        if (!file_exists($path)) {
            return response()->json([
                'error' => 'File mahasiswa.json tidak ditemukan'
            ], 404);
        }

        $json = file_get_contents($path);

        $data = json_decode($json, true);

        return response()->json($data);
    }
}