<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tugas AJAX Mahasiswa</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-10">

    <div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <h1 class="text-2xl font-bold text-gray-800 mb-4">Data Mahasiswa (AJAX Version)</h1>
        
        <button id="btnTampil" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded mb-6">
            Tampilkan Data
        </button>

        <div id="areaHasil">
            <p class="text-gray-500 italic">Klik tombol di atas untuk memuat data tanpa reload...</p>
        </div>
    </div>
<script>
    const btnTampil = document.getElementById('btnTampil');
    const areaHasil = document.getElementById('areaHasil');

    btnTampil.addEventListener('click', function() {
        btnTampil.innerText = "Memuat...";

        fetch('/api/mahasiswa')
            .then(response => response.json())
            .then(data => {
                // UNTUK DEBUG: Cek di console apakah datanya muncul atau []
                console.log("Data yang diterima:", data);

                if (data.length === 0) {
                    areaHasil.innerHTML = '<p class="text-yellow-600 italic">Data kosong atau file tidak terbaca.</p>';
                } else {
                    let html = `
                        <table class="w-full text-left border-collapse border border-gray-300">
                            <thead>
                                <tr class="bg-gray-200 text-sm">
                                    <th class="border border-gray-300 px-4 py-2">Nama</th>
                                    <th class="border border-gray-300 px-4 py-2">NIM</th>
                                    <th class="border border-gray-300 px-4 py-2">Kelas</th>
                                    <th class="border border-gray-300 px-4 py-2">Prodi</th>
                                </tr>
                            </thead>
                            <tbody>
                    `;

                    data.forEach(mhs => {
                        html += `
                            <tr class="hover:bg-gray-50 text-sm">
                                <td class="border border-gray-300 px-4 py-2">${mhs.nama}</td>
                                <td class="border border-gray-300 px-4 py-2">${mhs.nim}</td>
                                <td class="border border-gray-300 px-4 py-2">${mhs.kelas}</td>
                                <td class="border border-gray-300 px-4 py-2">${mhs.prodi}</td>
                            </tr>
                        `;
                    });

                    html += `</tbody></table>`;
                    areaHasil.innerHTML = html;
                }
                btnTampil.innerText = "Tampilkan Data";
            })
            .catch(error => {
                console.error('Ada error:', error);
                areaHasil.innerHTML = '<p class="text-red-500">Gagal memuat data.</p>';
                btnTampil.innerText = "Tampilkan Data";
            });
    });
</script>
</body>
</html>