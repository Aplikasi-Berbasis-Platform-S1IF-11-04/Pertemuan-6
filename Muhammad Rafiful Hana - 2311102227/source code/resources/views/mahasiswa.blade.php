<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Manajemen Data Mahasiswa</title>
    <link href="https://fonts.googleapis.com/css2?family=Space+Mono:wght@400;700&family=Inter:wght@400;600;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: #ece8e0;
            font-family: 'Space Mono', 'Inter', monospace;
            min-height: 100vh;
            padding: 2rem;
        }

        .container-main {
            max-width: 1400px;
            margin: 0 auto;
        }

        .header-brutal {
            background: #0a0a0a;
            padding: 2rem 2.5rem;
            border-bottom: 6px solid #c0392b;
            margin-bottom: 2.5rem;
        }

        .header-brutal h1 {
            color: #ffffff;
            font-size: 2.8rem;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: -2px;
        }

        .header-brutal h1 span {
            color: #c0392b;
            border-left: 4px solid #c0392b;
            padding-left: 1rem;
            margin-left: 0.5rem;
        }

        .header-brutal .sub {
            color: #f1c40f;
            font-size: 0.8rem;
            letter-spacing: 2px;
            margin-top: 0.5rem;
        }

        .card-brutal {
            background: #ffffff;
            border: 3px solid #0a0a0a;
            box-shadow: 12px 12px 0 #c0392b;
            padding: 1.8rem;
            margin-bottom: 2rem;
            transition: 0.1s linear;
        }

        .card-brutal:hover {
            transform: translate(2px, 2px);
            box-shadow: 8px 8px 0 #c0392b;
        }

        .btn-brutal {
            background: #0a0a0a;
            border: 2px solid #0a0a0a;
            color: white;
            padding: 0.7rem 1.8rem;
            font-family: 'Space Mono', monospace;
            font-weight: 700;
            text-transform: uppercase;
            font-size: 0.8rem;
            letter-spacing: 1px;
            cursor: pointer;
            transition: 0.1s linear;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-brutal:hover {
            background: #c0392b;
            border-color: #0a0a0a;
            transform: scale(0.96);
        }

        .btn-brutal-primary {
            background: #c0392b;
            border-color: #0a0a0a;
        }

        .btn-brutal-primary:hover {
            background: #a93226;
        }

        .btn-brutal-danger {
            background: #0a0a0a;
            border-color: #c0392b;
        }

        .btn-brutal-danger:hover {
            background: #c0392b;
            color: white;
        }

        .btn-brutal-success {
            background: #27ae60;
            border-color: #0a0a0a;
        }

        .btn-brutal-success:hover {
            background: #1e8449;
        }

        .form-control-brutal {
            background: #ffffff;
            border: 2px solid #0a0a0a;
            padding: 0.7rem 1rem;
            font-family: 'Space Mono', monospace;
            font-size: 0.9rem;
            width: 100%;
            transition: 0.1s;
            outline: none;
        }

        .form-control-brutal:focus {
            border-color: #c0392b;
            box-shadow: 3px 3px 0 #c0392b40;
        }

        .table-brutal {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.85rem;
        }

        .table-brutal thead {
            background: #0a0a0a;
            color: white;
        }

        .table-brutal th {
            padding: 1rem 0.8rem;
            text-align: left;
            text-transform: uppercase;
            font-size: 0.7rem;
            letter-spacing: 1px;
        }

        .table-brutal td {
            padding: 0.8rem;
            border-bottom: 2px solid #e0dbd2;
            vertical-align: middle;
        }

        .table-brutal tbody tr:hover {
            background: #f5f0e8;
        }

        .hobi-tag {
            display: inline-block;
            background: #0a0a0a;
            color: #f1c40f;
            padding: 0.15rem 0.6rem;
            font-size: 0.7rem;
            margin: 0.1rem 0.2rem;
            border-left: 2px solid #c0392b;
        }

        .modal-brutal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.88);
            z-index: 1000;
            align-items: center;
            justify-content: center;
            backdrop-filter: blur(3px);
        }

        .modal-brutal.active {
            display: flex;
        }

        .modal-content-brutal {
            background: #fffcf5;
            border: 4px solid #0a0a0a;
            box-shadow: 18px 18px 0 #c0392b;
            max-width: 600px;
            width: 92%;
            padding: 2rem;
            max-height: 90vh;
            overflow-y: auto;
        }

        .modal-header-brutal {
            border-bottom: 3px solid #c0392b;
            padding-bottom: 1rem;
            margin-bottom: 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-header-brutal h2 {
            font-size: 1.5rem;
            font-weight: 900;
            text-transform: uppercase;
        }

        .modal-close {
            font-size: 2rem;
            cursor: pointer;
            background: none;
            border: none;
            font-weight: 700;
            color: #0a0a0a;
            transition: 0.1s;
            line-height: 1;
        }

        .modal-close:hover {
            color: #c0392b;
            transform: scale(1.2);
        }

        .form-group {
            margin-bottom: 1.2rem;
        }

        .form-group label {
            display: block;
            font-weight: 700;
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 0.3rem;
        }

        .form-group .hobi-checkbox {
            display: flex;
            flex-wrap: wrap;
            gap: 0.8rem;
            padding-top: 0.3rem;
        }

        .form-group .hobi-checkbox label {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-weight: 400;
            text-transform: none;
            font-size: 0.85rem;
            cursor: pointer;
            background: #f5f0e8;
            padding: 0.3rem 0.8rem;
            border: 1px solid #0a0a0a;
        }

        .form-group .hobi-checkbox input[type="checkbox"] {
            width: 16px;
            height: 16px;
            accent-color: #c0392b;
        }

        .form-group select {
            appearance: none;
            background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="black" stroke-width="2"><polyline points="6 9 12 15 18 9"/></svg>');
            background-repeat: no-repeat;
            background-position: right 1rem center;
            background-size: 14px;
            cursor: pointer;
        }

        .toast-brutal {
            background: #0a0a0a;
            color: #f1c40f;
            padding: 0.8rem 1.5rem;
            border-left: 5px solid #c0392b;
            margin-bottom: 1rem;
            font-weight: 700;
            display: none;
        }

        .toast-brutal.show {
            display: block;
            animation: slideIn 0.3s ease;
        }

        .toast-brutal.error {
            border-left-color: #c0392b;
            color: #c0392b;
        }

        .toast-brutal.success {
            border-left-color: #27ae60;
            color: #27ae60;
        }

        @keyframes slideIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .empty-state {
            text-align: center;
            padding: 3rem;
            color: #666;
            font-weight: 600;
        }

        .empty-state i {
            font-size: 3rem;
            display: block;
            margin-bottom: 1rem;
            color: #ccc;
        }

        .action-group {
            display: flex;
            gap: 0.5rem;
            flex-wrap: wrap;
            justify-content: center;
        }

        .btn-sm {
            padding: 0.3rem 0.8rem;
            font-size: 0.7rem;
        }

        .gender-badge {
            display: inline-block;
            padding: 0.2rem 0.6rem;
            font-weight: 700;
            font-size: 0.7rem;
            text-transform: uppercase;
            border: 1px solid #0a0a0a;
        }

        .gender-badge.pria {
            background: #3498db20;
            color: #2980b9;
        }

        .gender-badge.wanita {
            background: #e74c3c20;
            color: #c0392b;
        }

        @media (max-width: 768px) {
            body {
                padding: 1rem;
            }
            .header-brutal h1 {
                font-size: 1.8rem;
            }
            .table-brutal {
                font-size: 0.7rem;
            }
            .table-brutal th, .table-brutal td {
                padding: 0.5rem;
            }
            .card-brutal {
                padding: 1rem;
            }
            .modal-content-brutal {
                padding: 1.5rem;
            }
        }
    </style>
</head>
<body>
<div class="container-main">
    <div class="header-brutal">
        <h1>DATA <span>MAHASISWA</span></h1>
        <div class="sub">MANAJEMEN CRUD · JSON LOKAL</div>
    </div>

    <div class="card-brutal">
        <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem; margin-bottom: 1.5rem;">
            <h2 style="font-weight: 800; text-transform: uppercase; font-size: 1.2rem;">
                <i class="fas fa-users" style="color: #c0392b;"></i> Daftar Mahasiswa
            </h2>
            <button class="btn-brutal btn-brutal-primary" id="btnTambah">
                <i class="fas fa-plus"></i> Tambah Data
            </button>
        </div>
        <div id="toastContainer" class="toast-brutal"></div>
        <div id="tableContainer">
            <div class="empty-state"><i class="fas fa-spinner fa-spin"></i>Memuat data...</div>
        </div>
    </div>
</div>

<div class="modal-brutal" id="modalMahasiswa">
    <div class="modal-content-brutal">
        <div class="modal-header-brutal">
            <h2 id="modalTitle">Tambah Mahasiswa</h2>
            <button class="modal-close" id="modalClose">&times;</button>
        </div>
        <form id="formMahasiswa">
            <input type="hidden" id="id" name="id">
            <div class="form-group">
                <label for="nama">Nama Lengkap</label>
                <input type="text" class="form-control-brutal" id="nama" name="nama" placeholder="Masukkan nama lengkap" required>
            </div>
            <div class="form-group">
                <label for="nim">NIM (10 digit)</label>
                <input type="number" class="form-control-brutal" id="nim" name="nim" placeholder="Contoh: 2311102227" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control-brutal" id="email" name="email" placeholder="email@domain.com" required>
            </div>
            <div class="form-group">
                <label for="jenis_kelamin">Jenis Kelamin</label>
                <select class="form-control-brutal" id="jenis_kelamin" name="jenis_kelamin" required>
                    <option value="">Pilih Jenis Kelamin</option>
                    <option value="Pria">Pria</option>
                    <option value="Wanita">Wanita</option>
                </select>
            </div>
            <div class="form-group">
                <label>Hobi (pilih minimal 1)</label>
                <div class="hobi-checkbox">
                    <label><input type="checkbox" name="hobi[]" value="Coding"> Coding</label>
                    <label><input type="checkbox" name="hobi[]" value="Gaming"> Gaming</label>
                    <label><input type="checkbox" name="hobi[]" value="Membaca"> Membaca</label>
                    <label><input type="checkbox" name="hobi[]" value="Menulis"> Menulis</label>
                    <label><input type="checkbox" name="hobi[]" value="Musik"> Musik</label>
                    <label><input type="checkbox" name="hobi[]" value="Traveling"> Traveling</label>
                    <label><input type="checkbox" name="hobi[]" value="Olahraga"> Olahraga</label>
                    <label><input type="checkbox" name="hobi[]" value="Fotografi"> Fotografi</label>
                    <label><input type="checkbox" name="hobi[]" value="Memasak"> Memasak</label>
                </div>
            </div>
            <div class="form-group">
                <label for="pendidikan">Pendidikan</label>
                <select class="form-control-brutal" id="pendidikan" name="pendidikan" required>
                    <option value="">Pilih Pendidikan</option>
                    <option value="D3">D3</option>
                    <option value="S1">S1</option>
                    <option value="S2">S2</option>
                    <option value="S3">S3</option>
                </select>
            </div>
            <div style="display: flex; gap: 1rem; justify-content: flex-end; margin-top: 1.5rem; flex-wrap: wrap;">
                <button type="button" class="btn-brutal" id="btnBatal">Batal</button>
                <button type="submit" class="btn-brutal btn-brutal-primary" id="btnSubmit">Simpan</button>
            </div>
        </form>
    </div>
</div>

<script>
$(document).ready(function() {
    const baseUrl = '/mahasiswa';
    let isEdit = false;
    let hobiList = ['Coding', 'Gaming', 'Membaca', 'Menulis', 'Musik', 'Traveling', 'Olahraga', 'Fotografi', 'Memasak'];

    function loadData() {
        $.ajax({
            url: baseUrl + '/data',
            method: 'GET',
            success: function(response) {
                renderTable(response);
            },
            error: function() {
                showToast('Gagal memuat data', 'error');
            }
        });
    }

    function renderTable(data) {
        if (!data || data.length === 0) {
            $('#tableContainer').html('<div class="empty-state"><i class="fas fa-database"></i>Belum ada data mahasiswa</div>');
            return;
        }

        let html = `<div style="overflow-x: auto;">
            <table class="table-brutal">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>NIM</th>
                        <th>Email</th>
                        <th>JK</th>
                        <th>Hobi</th>
                        <th>Pend</th>
                        <th style="text-align: center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>`;

        data.forEach((item, index) => {
            const genderClass = item.jenis_kelamin === 'Pria' ? 'pria' : 'wanita';
            const hobiHtml = item.hobi.map(h => `<span class="hobi-tag">${h}</span>`).join('');

            html += `<tr>
                <td>${index + 1}</td>
                <td><strong>${item.nama}</strong></td>
                <td>${item.nim}</td>
                <td>${item.email}</td>
                <td><span class="gender-badge ${genderClass}">${item.jenis_kelamin}</span></td>
                <td style="min-width: 120px;">${hobiHtml}</td>
                <td><strong>${item.pendidikan}</strong></td>
                <td style="text-align: center;">
                    <div class="action-group">
                        <button class="btn-brutal btn-sm btn-edit" data-id="${item.id}">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn-brutal btn-sm btn-brutal-danger btn-hapus" data-id="${item.id}">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </td>
            </tr>`;
        });

        html += `</tbody></table></div>`;
        $('#tableContainer').html(html);
    }

    function showToast(message, type = 'success') {
        const toast = $('#toastContainer');
        toast.text(message);
        toast.removeClass('show error success').addClass('show ' + type);
        setTimeout(() => {
            toast.removeClass('show');
        }, 3500);
    }

    function resetForm() {
        $('#formMahasiswa')[0].reset();
        $('#id').val('');
        $('input[name="hobi[]"]').prop('checked', false);
        isEdit = false;
        $('#modalTitle').text('Tambah Mahasiswa');
        $('#btnSubmit').text('Simpan');
    }

    function openModal() {
        $('#modalMahasiswa').addClass('active');
    }

    function closeModal() {
        $('#modalMahasiswa').removeClass('active');
        resetForm();
    }

    function setHobiCheckboxes(hobiArray) {
        $('input[name="hobi[]"]').prop('checked', false);
        if (hobiArray && Array.isArray(hobiArray)) {
            hobiArray.forEach(function(h) {
                $('input[name="hobi[]"][value="' + h + '"]').prop('checked', true);
            });
        }
    }

    $('#btnTambah').on('click', function() {
        resetForm();
        openModal();
    });

    $('#modalClose, #btnBatal').on('click', function() {
        closeModal();
    });

    $(document).on('click', function(e) {
        if ($(e.target).closest('.modal-content-brutal').length === 0 && $(e.target).closest('.modal-brutal').length > 0) {
            closeModal();
        }
    });

    $(document).on('click', '.btn-edit', function() {
        const id = $(this).data('id');
        $.ajax({
            url: baseUrl + '/data',
            method: 'GET',
            success: function(response) {
                const data = response.find(item => item.id === id);
                if (data) {
                    $('#id').val(data.id);
                    $('#nama').val(data.nama);
                    $('#nim').val(data.nim);
                    $('#email').val(data.email);
                    $('#jenis_kelamin').val(data.jenis_kelamin);
                    $('#pendidikan').val(data.pendidikan);
                    setHobiCheckboxes(data.hobi);
                    isEdit = true;
                    $('#modalTitle').text('Edit Mahasiswa');
                    $('#btnSubmit').text('Update');
                    openModal();
                }
            }
        });
    });

    $(document).on('click', '.btn-hapus', function() {
        const id = $(this).data('id');
        if (confirm('Yakin ingin menghapus data mahasiswa ini?')) {
            $.ajax({
                url: baseUrl + '/' + id,
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    showToast(response.message, 'success');
                    loadData();
                },
                error: function(xhr) {
                    showToast(xhr.responseJSON?.message || 'Gagal menghapus data', 'error');
                }
            });
        }
    });

    $('#formMahasiswa').on('submit', function(e) {
        e.preventDefault();
        const id = $('#id').val();
        const url = isEdit ? baseUrl + '/' + id : baseUrl;
        const method = isEdit ? 'PUT' : 'POST';

        const hobiValues = [];
        $('input[name="hobi[]"]:checked').each(function() {
            hobiValues.push($(this).val());
        });

        const formData = {
            nama: $('#nama').val(),
            nim: $('#nim').val(),
            email: $('#email').val(),
            jenis_kelamin: $('#jenis_kelamin').val(),
            hobi: hobiValues,
            pendidikan: $('#pendidikan').val()
        };

        $.ajax({
            url: url,
            method: method,
            data: formData,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                showToast(response.message, 'success');
                closeModal();
                loadData();
            },
            error: function(xhr) {
                if (xhr.status === 422) {
                    const errors = xhr.responseJSON.errors;
                    let msg = '';
                    $.each(errors, function(key, value) {
                        if (key === 'hobi') {
                            msg += 'Hobi: ' + value[0] + '\n';
                        } else if (key === 'hobi.*') {
                            msg += 'Hobi tidak valid\n';
                        } else {
                            msg += value[0] + '\n';
                        }
                    });
                    showToast(msg.trim(), 'error');
                } else {
                    showToast(xhr.responseJSON?.message || 'Terjadi kesalahan', 'error');
                }
            }
        });
    });

    loadData();
});
</script>
</body>
</html>