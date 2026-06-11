# Implementasi AJAX dengan Laravel (Tanpa Database)

Repositori ini berisi proyek praktikum implementasi **AJAX (Asynchronous JavaScript and XML)** pada framework Laravel. Proyek ini mendemonstrasikan bagaimana mengambil dan menampilkan data secara dinamis dari file JSON lokal tanpa perlu memuat ulang (*reload*) seluruh halaman web.

##  Fitur Utama
- **Asynchronous Data Fetching:** Memuat data mahasiswa menggunakan Fetch API (Vanilla JavaScript) di latar belakang.
- **No-Database Storage:** Memanfaatkan file JSON lokal sebagai media penyimpanan data (*mock database*).
- **Responsive UI:** Tampilan tabel data yang rapi dan modern menggunakan Tailwind CSS.

---

##  Arsitektur & Alur Kerja AJAX

Proyek ini mempraktikkan konsep pembaruan halaman web secara parsial berdasarkan diagram alur kerja AJAX standar:



1. **Penyimpanan Data (`storage/app/mahasiswa.json`)** Bertindak sebagai database tiruan yang menyimpan data statis berformat JSON (Nama, NIM, Kelas, dan Prodi).
2. **Backend / Endpoint API (`app/Http/Controllers/MahasiswaController.php`)** Fungsi `getJsonData()` membaca file JSON melalui fasad `Storage::get()` dan mengembalikannya sebagai respon HTTP dengan header `application/json` melalui rute `/api/mahasiswa`.
3. **Frontend & DOM Manipulation (`resources/views/mahasiswa.blade.php`)** Ketika tombol diklik, JavaScript mengirimkan permintaan HTTP secara asinkronus menggunakan `fetch()`. Setelah data diterima, JavaScript melakukan perulangan (*looping*), menyusun struktur tabel HTML, dan langsung menyisipkannya ke dalam halaman web tanpa *refresh* total.

---

##  Cara Menjalankan Proyek

1. **Clone repositori ini:**
   ```bash
   git clone [https://github.com/username/nama-repositori.git](https://github.com/username/nama-repositori.git)
