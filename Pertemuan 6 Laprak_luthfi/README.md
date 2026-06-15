# Praktikum Laravel + AJAX

Project ini adalah aplikasi Laravel sederhana untuk menampilkan data mahasiswa dari file JSON lokal menggunakan AJAX tanpa melakukan reload halaman.

## Deskripsi Project

Aplikasi ini dibuat untuk memenuhi tugas praktikum Laravel + AJAX dengan ketentuan:

- Menggunakan Laravel Blade sebagai halaman utama.
- Menampilkan judul halaman.
- Menampilkan tombol **Tampilkan Data**.
- Menyediakan area hasil data.
- Menggunakan file JSON lokal sebagai sumber data.
- Menggunakan controller Laravel untuk membaca file JSON.
- Mengambil data menggunakan AJAX tanpa reload halaman.
- Menampilkan data mahasiswa dalam bentuk tabel.
- Tidak menggunakan database.

## Fitur Aplikasi

- Halaman utama berbasis Blade.
- Tombol untuk mengambil data mahasiswa.
- Data diambil dari file JSON lokal.
- Data ditampilkan secara dinamis menggunakan JavaScript `fetch()`.
- Tampilan data berbentuk tabel.
- Tidak membutuhkan database MySQL atau SQLite untuk menjalankan fitur utama.

## Data Mahasiswa

Data mahasiswa minimal berisi:

- Nama
- NIM
- Kelas
- Prodi

File data berada di:

```bash
public/datamahasiswa.json
```

Contoh struktur data JSON:

```json
[
    {
        "nama": "Luthfi Adi Harianto",
        "nim": "2311102172",
        "kelas": "IF 11 05",
        "prodi": "Teknik Informatika"
    },
    {
        "nama": "Dzaki Resalianto",
        "nim": "2311102172",
        "kelas": "IF 11 05",
        "prodi": "Teknik Informatika"
    },
    {
        "nama": "Fadhel Setiawan",
        "nim": "2311102172",
        "kelas": "IF 11 05",
        "prodi": "Teknik Informatika"
    }
]
```

## Struktur File Penting

```bash
Pertemuan 6 Laprak_luthfi/
├── app/
│   └── Http/
│       └── Controllers/
│           └── MahasiswaController.php
├── public/
│   └── datamahasiswa.json
├── resources/
│   └── views/
│       └── mahasiswa.blade.php
├── routes/
│   └── web.php
└── README.md
```

## Route yang Digunakan

Route berada pada file:

```bash
routes/web.php
```

Isi route utama:

```php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MahasiswaController;

Route::get('/', [MahasiswaController::class, 'index']);
Route::get('/data-mahasiswa', [MahasiswaController::class, 'getData']);
```

Keterangan:

- `/` digunakan untuk menampilkan halaman utama.
- `/data-mahasiswa` digunakan untuk mengambil data mahasiswa dalam format JSON.

## Controller

Controller yang digunakan:

```bash
app/Http/Controllers/MahasiswaController.php
```

Controller berfungsi untuk:

1. Menampilkan halaman Blade.
2. Membaca file `datamahasiswa.json`.
3. Mengembalikan data dalam format JSON.

Contoh fungsi pengambilan data:

```php
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
```

## Halaman Blade

File tampilan utama berada di:

```bash
resources/views/mahasiswa.blade.php
```

Pada halaman ini terdapat:

- Judul halaman **Data Mahasiswa**.
- Tombol **Tampilkan Data**.
- Area hasil data.
- Script AJAX menggunakan `fetch()`.

Contoh pemanggilan AJAX:

```javascript
fetch('/data-mahasiswa')
    .then(response => response.json())
    .then(data => {
        console.log(data);
    })
    .catch(error => {
        console.error(error);
    });
```

## Cara Menjalankan Project

1. Buka project menggunakan VS Code.

2. Buka terminal pada folder utama project.

3. Jalankan perintah berikut:

```bash
php artisan serve
```

4. Buka browser dan akses:

```bash
http://127.0.0.1:8000
```

5. Klik tombol:

```bash
Tampilkan Data
```

6. Data mahasiswa akan tampil tanpa reload halaman.

## Teknologi yang Digunakan

- Laravel
- Laravel Blade
- PHP
- JavaScript
- AJAX / Fetch API
- JSON
- HTML
- CSS

## Catatan Penting

Project ini tidak menggunakan database. Data mahasiswa disimpan di file JSON lokal pada folder `public`, kemudian dibaca oleh controller Laravel dan dikirim ke halaman dalam format JSON.

## Pembuat

Nama: Luthfi Adi Harianto  
NIM: 2311102172
Kelas: IF 11 05  
Prodi: Teknik Informatika
