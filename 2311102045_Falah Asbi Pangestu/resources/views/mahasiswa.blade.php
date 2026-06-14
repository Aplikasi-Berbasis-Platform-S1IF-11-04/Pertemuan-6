<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Mahasiswa</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- DataTables -->
    <link href="https://cdn.datatables.net/1.13.8/css/jquery.dataTables.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body{
            background: linear-gradient(135deg,#667eea,#764ba2);
            min-height:100vh;
        }

        .card-custom{
            border:none;
            border-radius:20px;
            box-shadow:0 10px 25px rgba(0,0,0,.2);
        }

        .title{
            font-weight:700;
            color:#4f46e5;
        }

        .btn-custom{
            border-radius:10px;
        }

        table{
            width:100% !important;
        }
    </style>
</head>
<body>

<div class="container py-5">

    <div class="card card-custom">

        <div class="card-body">

            <div class="d-flex justify-content-between align-items-center mb-4">

                <div>
                    <h2 class="title">
                        <i class="bi bi-mortarboard-fill"></i>
                        CRUD Data Mahasiswa
                    </h2>

                    <small class="text-muted">
                        Laravel + Bootstrap + DataTables + Ajax
                    </small>
                </div>

                <button class="btn btn-primary btn-custom"
                    onclick="tambah()">
                    <i class="bi bi-plus-circle"></i>
                    Tambah Data
                </button>

            </div>

            <table id="myTable" class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>NIM</th>
                        <th>Prodi</th>
                        <th>Email</th>
                        <th width="180">Aksi</th>
                    </tr>
                </thead>
            </table>

        </div>

    </div>

</div>

<!-- Modal -->

<div class="modal fade" id="modalForm">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">
                    Form Mahasiswa
                </h5>
            </div>

            <div class="modal-body">

                <input type="hidden" id="id">

                <div class="mb-3">
                    <label>Nama</label>
                    <input type="text" id="nama" class="form-control">
                </div>

                <div class="mb-3">
                    <label>NIM</label>
                    <input type="text" id="nim" class="form-control">
                </div>

                <div class="mb-3">
                    <label>Program Studi</label>
                    <input type="text" id="prodi" class="form-control">
                </div>

                <div class="mb-3">
                    <label>Email</label>
                    <input type="email" id="email" class="form-control">
                </div>

            </div>

            <div class="modal-footer">
                <button class="btn btn-success"
                    onclick="simpan()">
                    Simpan
                </button>
            </div>

        </div>
    </div>
</div>

<!-- JQuery -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<!-- Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- DataTables -->
<script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>

<script>

let table;
let modal;
let save_method;

$.ajaxSetup({
    headers:{
        'X-CSRF-TOKEN':
        $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).ready(function(){

    modal = new bootstrap.Modal(
        document.getElementById('modalForm')
    );

    table = $('#myTable').DataTable({

        ajax:{
            url:'/data',
            dataSrc:''
        },

        columns:[
            {data:'id'},
            {data:'nama'},
            {data:'nim'},
            {data:'prodi'},
            {data:'email'},

            {
                data:null,
                render:function(data){

                    return `
                        <button class="btn btn-warning btn-sm"
                            onclick="edit(${data.id})">
                            Edit
                        </button>

                        <button class="btn btn-danger btn-sm"
                            onclick="hapus(${data.id})">
                            Hapus
                        </button>
                    `;
                }
            }
        ]
    });

});

function tambah(){

    save_method = 'add';

    $('#id').val('');
    $('#nama').val('');
    $('#nim').val('');
    $('#prodi').val('');
    $('#email').val('');

    modal.show();
}

function simpan(){

    let url =
        save_method == 'add'
        ? '/store'
        : '/update/' + $('#id').val();

    let method =
        save_method == 'add'
        ? 'POST'
        : 'PUT';

    $.ajax({

        url:url,
        type:method,

        data:{
            nama:$('#nama').val(),
            nim:$('#nim').val(),
            prodi:$('#prodi').val(),
            email:$('#email').val()
        },

        success:function(){

            modal.hide();

            table.ajax.reload();

            Swal.fire(
                'Berhasil',
                'Data berhasil disimpan',
                'success'
            );

        }

    });

}

function edit(id){

    save_method='edit';

    $.get('/edit/' + id,function(data){

        $('#id').val(data.id);
        $('#nama').val(data.nama);
        $('#nim').val(data.nim);
        $('#prodi').val(data.prodi);
        $('#email').val(data.email);

        modal.show();

    });

}

function hapus(id){

    Swal.fire({
        title:'Yakin?',
        text:'Data akan dihapus',
        icon:'warning',
        showCancelButton:true
    }).then((result)=>{

        if(result.isConfirmed){

            $.ajax({

                url:'/delete/' + id,
                type:'DELETE',

                success:function(){

                    table.ajax.reload();

                    Swal.fire(
                        'Berhasil',
                        'Data berhasil dihapus',
                        'success'
                    );

                }

            });

        }

    });

}

</script>

</body>
</html>