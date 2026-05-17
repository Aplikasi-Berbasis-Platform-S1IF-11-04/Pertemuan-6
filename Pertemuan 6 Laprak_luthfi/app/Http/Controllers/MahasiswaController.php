<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    public function index()
    {
        return view('mahasiswa');
    }

    public function getData()
    {
        $path = public_path('datamahasiswa.json');

        if (!file_exists($path)) {
            return response()->json([
                'message' => 'File JSON tidak ditemukan'
            ], 404);
        }

        $json = file_get_contents($path);
        $data = json_decode($json, true);

        return response()->json($data);
    }
}