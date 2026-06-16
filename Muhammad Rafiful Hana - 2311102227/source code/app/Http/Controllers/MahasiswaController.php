<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class MahasiswaController extends Controller
{
private function getJsonPath()
{
    return storage_path('app/mahasiswa.json');
}
private function readData()
{
    $path = $this->getJsonPath();
    if (!File::exists($path)) {
        $default = [
            [
                'id' => 1,
                'nama' => 'Muhammad Rafiful Hana',
                'nim' => 2311102227,
                'email' => 'rafiful@example.com',
                'jenis_kelamin' => 'Pria',
                'hobi' => ['Coding', 'Gaming'],
                'pendidikan' => 'S1'
            ],
            [
                'id' => 2,
                'nama' => 'Ahmad Fauzi',
                'nim' => 2311102228,
                'email' => 'ahmad2@example.com',
                'jenis_kelamin' => 'Pria',
                'hobi' => ['Membaca', 'Menulis'],
                'pendidikan' => 'S1'
            ]
        ];
        File::put($path, json_encode($default, JSON_PRETTY_PRINT));
        return $default;
    }
    return json_decode(File::get($path), true) ?? [];
}

    private function writeData($data)
    {
        File::put($this->getJsonPath(), json_encode($data, JSON_PRETTY_PRINT));
    }

    public function index()
    {
        return view('mahasiswa');
    }

    public function getData()
    {
        return response()->json($this->readData());
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:100',
            'nim' => 'required|numeric|digits:10',
            'email' => 'required|email|max:100',
            'jenis_kelamin' => 'required|in:Pria,Wanita',
            'hobi' => 'required|array|min:1',
            'hobi.*' => 'string|max:50',
            'pendidikan' => 'required|in:S1,S2,S3,D3'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $data = $this->readData();
        $newId = count($data) > 0 ? max(array_column($data, 'id')) + 1 : 1;

        $newData = [
            'id' => $newId,
            'nama' => $request->nama,
            'nim' => (int)$request->nim,
            'email' => $request->email,
            'jenis_kelamin' => $request->jenis_kelamin,
            'hobi' => $request->hobi,
            'pendidikan' => $request->pendidikan
        ];

        $data[] = $newData;
        $this->writeData($data);

        return response()->json(['message' => 'Data berhasil ditambahkan', 'data' => $newData], 201);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:100',
            'nim' => 'required|numeric|digits:10',
            'email' => 'required|email|max:100',
            'jenis_kelamin' => 'required|in:Pria,Wanita',
            'hobi' => 'required|array|min:1',
            'hobi.*' => 'string|max:50',
            'pendidikan' => 'required|in:S1,S2,S3,D3'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $data = $this->readData();
        $index = array_search((int)$id, array_column($data, 'id'));

        if ($index === false) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $data[$index] = [
            'id' => (int)$id,
            'nama' => $request->nama,
            'nim' => (int)$request->nim,
            'email' => $request->email,
            'jenis_kelamin' => $request->jenis_kelamin,
            'hobi' => $request->hobi,
            'pendidikan' => $request->pendidikan
        ];

        $this->writeData($data);

        return response()->json(['message' => 'Data berhasil diupdate', 'data' => $data[$index]]);
    }

    public function destroy($id)
    {
        $data = $this->readData();
        $index = array_search((int)$id, array_column($data, 'id'));

        if ($index === false) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        array_splice($data, $index, 1);
        $this->writeData($data);

        return response()->json(['message' => 'Data berhasil dihapus']);
    }
}