<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MahasiswaController extends Controller
{
    // Fungsi untuk menampilkan halaman utama
    public function index()
    {
        return view('mahasiswa');
    }

    // Fungsi untuk membaca file JSON dan mengembalikannya ke AJAX
    public function getJsonData()
    {
        // Menggunakan file_get_contents agar lebih "bebas" dari proteksi Laravel Storage
        $path = base_path('mahasiswa.json');

        if (!file_exists($path)) {
            return response()->json([
                ["nama" => "Error", "nim" => "0", "kelas" => "-", "prodi" => "File mahasiswa.json tidak ditemukan di folder utama"]
            ]);
        }

        $json = file_get_contents($path);
        return response($json)->header('Content-Type', 'application/json');
    }
}