function loadData() {
    const result = document.getElementById('result');

    result.innerHTML = "<div class='loading'>Loading data...</div>";

    fetch('/get-mahasiswa')
        .then(res => res.json())
        .then(data => {
            let html = "<div class='card-container'>";

            data.forEach((mhs, i) => {
                html += `
                    <div class="card" style="animation-delay:${i * 0.1}s">
                        <h3>${mhs.nama}</h3>
                        <p><b>NIM:</b> ${mhs.nim}</p>
                        <p><b>Kelas:</b> ${mhs.kelas}</p>
                        <p><b>Prodi:</b> ${mhs.prodi}</p>
                    </div>
                `;
            });

            html += "</div>";
            result.innerHTML = html;
        })
        .catch(() => {
            result.innerHTML = "<div class='loading'>Gagal mengambil data</div>";
        });
}