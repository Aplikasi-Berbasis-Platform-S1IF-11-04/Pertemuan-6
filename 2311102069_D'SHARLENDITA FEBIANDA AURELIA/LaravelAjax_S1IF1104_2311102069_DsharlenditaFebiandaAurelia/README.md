<h3 align="center">LAPORAN PRAKTIKUM</h3>
<h3 align="center">APLIKASI BERBASIS PLATFORM</h3>
<h3 align="center">LARAVEL + AJAX</h3>

<br>
<p align="center">
  <img src="screenshot/logo telkom university.png" width="150"/>
</p>
<br>

<p align="center">
Disusun oleh:
<br><br>
D’SHARLENDITA FEBIANDA AURELIA  
<br>
2311102069  
<br>
S1 IF-11-04  
</p>

<br>

<p align="center">
Dosen Pengampu:
<br>
Cahyo Prihantoro, S.Kom., M.Eng  
</p>

<br><br>

<p align="center">
PROGRAM STUDI S1 INFORMATIKA  
<br>
FAKULTAS INFORMATIKA  
<br>
TELKOM UNIVERSITY PURWOKERTO  
<br>
2026  
</p>

## Struktur & Penjelasan Kode

### 1. Controller (`MahasiswaController.php`)
- `index()` → menampilkan halaman utama  
- `getData()` → membaca file JSON lalu mengirim sebagai response  

Alur:
- Ambil path file (`storage_path`)
- Cek file (`file_exists`)
- Baca file (`file_get_contents`)
- Decode JSON (`json_decode`)
- Return JSON (`response()->json`)

---

### 2. Routing (`web.php`)
```php
Route::get('/', [MahasiswaController::class, 'index']);
Route::get('/get-mahasiswa', [MahasiswaController::class, 'getData']);
```

- / → halaman utama
- /get-mahasiswa → API data mahasiswa

### 3. View (Blade / HTML)
- Tombol trigger:
  ```html
  <button onclick="loadData()">Tampilkan Data</button>
  ```
- Output:
  ```html
  <div id="result"></div>
  ```

### 4. JavaScript (app.js)
Fungsi loadData():

- Tampilkan loading
- Fetch ke /get-mahasiswa
- Convert JSON
- Loop data (forEach)
- Render ke HTML (card)
- Handle error

### 5. CSS (style.css)
- Glassmorphism UI
- Animasi background
- Card responsive + hover effect

### 6. Cara Install & Menjalankan
1. Clone / Siapkan Project
2. Tambahkan Data JSON
   Simpan file di:
   storage/app/data/mahasiswa.json
   Contoh:
   ```json
   [
      {
        "nama": "Dita",
        "nim": "2311102069",
        "kelas": "IF1104",
        "prodi": "Informatika"
      }
    ]
   ```
3. Jalankan server
   ```bash
   php artisan serve
   ```
   buka di browser:
   http://127.0.0.1:8000

### 7. Cara Penggunaan
1. Buka website
2. Klik tombol Tampilkan Data
3. Data mahasiswa akan muncul otomatis
4. Jika file JSON tidak ada → muncul error

### 8. Alur Sistem
User klik tombol → JS fetch API → Controller baca JSON → kirim data → tampil di halaman

### 9. Screenshot Program
Halaman Awal
<img src="screenshot/Halaman Awal.png">
---
View Data
<img src="screenshot/View Data.png">
---
