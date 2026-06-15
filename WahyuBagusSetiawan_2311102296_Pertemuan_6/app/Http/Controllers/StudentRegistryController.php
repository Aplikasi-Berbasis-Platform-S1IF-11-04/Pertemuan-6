<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class StudentRegistryController extends Controller
{
    /**
     * Membuka halaman dashboard utama.
     */
    public function index()
    {
        return view('registry'); 
    }

    /**
     * Mengambil data secara aman dari berkas JSON internal.
     */
    public function getStudentRegistry()
    {
        // Path absolut menunjuk ke folder storage/app/database/students.json
        $path = storage_path('app/database/students.json');

        if (!file_exists($path)) {
            return response()->json([
                'status'  => 'error',
                'code'    => Response::HTTP_NOT_FOUND,
                'message' => 'Koneksi database lokal gagal. Berkas tidak ditemukan.'
            ], Response::HTTP_NOT_FOUND);
        }

        $jsonString = file_get_contents($path);
        $parsedData = json_decode($jsonString, true);

        // Validasi jika format JSON rusak/salah penulisan koma atau tanda kurung
        if (json_last_error() !== JSON_ERROR_NONE) {
            return response()->json([
                'status'  => 'error',
                'code'    => Response::HTTP_UNPROCESSABLE_ENTITY,
                'message' => 'Gagal membaca format JSON: ' . json_last_error_msg()
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        return response()->json([
            'status'     => 'success',
            'code'       => Response::HTTP_OK,
            'total'      => count($parsedData),
            'records'    => $parsedData
        ], Response::HTTP_OK);
    }
}
