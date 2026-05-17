<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Mahasiswa Laravel AJAX</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f8;
            padding: 40px;
        }

        .container {
            max-width: 900px;
            margin: auto;
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #222;
        }

        button {
            background-color: #0073C7;
            color: white;
            border: none;
            padding: 12px 18px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
            margin-bottom: 20px;
        }

        button:hover {
            background-color: #005fa3;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th {
            background-color: #0073C7;
            color: white;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .loading {
            color: #0073C7;
            font-weight: bold;
        }

        .error {
            color: red;
            font-weight: bold;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Data Mahasiswa</h1>

    <button id="btnTampil">Tampilkan Data</button>

    <div id="hasilData">
        <p>Data mahasiswa akan tampil di sini.</p>
    </div>
</div>

<script>
    document.getElementById('btnTampil').addEventListener('click', function () {
        const hasilData = document.getElementById('hasilData');

        hasilData.innerHTML = '<p class="loading">Sedang mengambil data...</p>';

        fetch('/data-mahasiswa')
            .then(response => {
                if (!response.ok) {
                    throw new Error('Gagal mengambil data');
                }
                return response.json();
            })
            .then(data => {
                let tabel = `
                    <table>
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>NIM</th>
                                <th>Kelas</th>
                                <th>Prodi</th>
                            </tr>
                        </thead>
                        <tbody>
                `;

                data.forEach((mahasiswa, index) => {
                    tabel += `
                        <tr>
                            <td>${index + 1}</td>
                            <td>${mahasiswa.nama}</td>
                            <td>${mahasiswa.nim}</td>
                            <td>${mahasiswa.kelas}</td>
                            <td>${mahasiswa.prodi}</td>
                        </tr>
                    `;
                });

                tabel += `
                        </tbody>
                    </table>
                `;

                hasilData.innerHTML = tabel;
            })
            .catch(error => {
                hasilData.innerHTML = '<p class="error">Terjadi kesalahan saat mengambil data.</p>';
                console.error(error);
            });
    });
</script>

</body>
</html>