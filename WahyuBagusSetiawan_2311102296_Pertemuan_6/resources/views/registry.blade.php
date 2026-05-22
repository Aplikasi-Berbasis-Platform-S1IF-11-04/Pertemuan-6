<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registry Dashboard</title>

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        *{
            font-family: 'Poppins', sans-serif;
        }

        body{
            background:
                radial-gradient(circle at top left, rgba(59,130,246,0.25), transparent 25%),
                radial-gradient(circle at bottom right, rgba(168,85,247,0.25), transparent 25%),
                linear-gradient(135deg, #020617 0%, #0f172a 100%);
            min-height: 100vh;
            overflow-x: hidden;
        }

        .glass{
            background: rgba(15, 23, 42, 0.6);
            backdrop-filter: blur(14px);
            border: 1px solid rgba(255,255,255,0.08);
        }

        .glow{
            box-shadow:
                0 0 25px rgba(59,130,246,0.15),
                0 0 60px rgba(168,85,247,0.08);
        }

        .student-card:hover{
            transform: translateY(-8px) scale(1.02);
        }

        .floating{
            animation: floating 4s ease-in-out infinite;
        }

        @keyframes floating{
            0%{transform: translateY(0px);}
            50%{transform: translateY(-8px);}
            100%{transform: translateY(0px);}
        }

        .gradient-text{
            background: linear-gradient(to right, #60a5fa, #a78bfa);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .loader {
            border-top-color: #60a5fa;
            animation: spinner 0.8s linear infinite;
        }

        @keyframes spinner {
            to {
                transform: rotate(360deg);
            }
        }
    </style>
</head>

<body class="text-white p-6 md:p-10">

<div class="max-w-7xl mx-auto">

    <!-- HEADER -->
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6 mb-10">

        <div>
            <p class="uppercase tracking-[5px] text-blue-400 text-xs font-semibold mb-3">
                Laravel AJAX Dashboard
            </p>

            <h1 class="text-4xl md:text-6xl font-bold leading-tight">
                Student
                <span class="gradient-text">
                    Registry
                </span>
            </h1>

            <p class="text-slate-400 mt-4 max-w-2xl">
                Sistem informasi mahasiswa modern berbasis Laravel, AJAX Fetch API,
                dan database JSON lokal dengan antarmuka futuristik.
            </p>
        </div>

        <!-- BUTTON -->
        <button id="btnSync"
            class="group relative overflow-hidden px-8 py-4 rounded-2xl bg-gradient-to-r from-blue-500 to-purple-500 font-semibold text-white shadow-2xl hover:scale-105 transition-all duration-300">

            <span class="relative z-10 flex items-center gap-3">
                ⚡
                <span id="btnText">
                    Sync Student Records
                </span>
            </span>

            <div class="absolute inset-0 bg-white/10 translate-y-full group-hover:translate-y-0 transition-all duration-300"></div>
        </button>
    </div>

    <!-- STATS -->
    <div class="grid md:grid-cols-3 gap-6 mb-10">

        <div class="glass glow rounded-3xl p-6 floating">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-slate-400 text-sm">
                        Total Students
                    </p>

                    <h2 id="statTotal" class="text-4xl font-bold mt-2">
                        0
                    </h2>
                </div>

                <div class="text-5xl">
                    🎓
                </div>
            </div>
        </div>

        <div class="glass glow rounded-3xl p-6 floating">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-slate-400 text-sm">
                        API Status
                    </p>

                    <div id="statStatus"
                        class="mt-3 inline-flex items-center gap-2 bg-red-500/20 text-red-400 px-4 py-2 rounded-full text-sm font-semibold">
                        ● OFFLINE
                    </div>
                </div>

                <div class="text-5xl">
                    🌐
                </div>
            </div>
        </div>

        <div class="glass glow rounded-3xl p-6">
            <p class="text-slate-400 text-sm mb-3">
                Quick Search
            </p>

            <input
                type="text"
                id="searchInput"
                disabled
                placeholder="Cari nama atau NIM..."
                class="w-full bg-slate-900/80 border border-slate-700 rounded-2xl px-5 py-3 text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all"
            >
        </div>
    </div>

    <!-- LOADER -->
    <div id="loadingSection" class="hidden justify-center py-20">
        <div class="loader w-16 h-16 border-4 border-slate-700 rounded-full"></div>
    </div>

    <!-- STUDENT GRID -->
    <div id="studentContainer"
        class="grid sm:grid-cols-2 xl:grid-cols-3 gap-8">

        <!-- EMPTY -->
        <div id="emptyState"
            class="col-span-full text-center py-28">

            <div class="text-7xl mb-5">
                📂
            </div>

            <h3 class="text-2xl font-semibold text-slate-200 mb-3">
                Belum Ada Data
            </h3>

            <p class="text-slate-500 max-w-md mx-auto">
                Tekan tombol sinkronisasi untuk mengambil data mahasiswa
                dari server Laravel menggunakan AJAX Fetch API.
            </p>
        </div>
    </div>

</div>

<!-- TOAST -->
<div id="toast"
    class="fixed bottom-8 right-8 translate-y-32 opacity-0 transition-all duration-500 bg-red-500 text-white px-6 py-4 rounded-2xl shadow-2xl z-50">
    <span id="toastMsg"></span>
</div>

<script>

    let cachedStudents = [];

    const btnSync = document.getElementById('btnSync');

    btnSync.addEventListener('click', async () => {

        const btnText = document.getElementById('btnText');
        const loading = document.getElementById('loadingSection');
        const emptyState = document.getElementById('emptyState');

        btnSync.disabled = true;
        btnText.textContent = 'Synchronizing...';

        loading.classList.remove('hidden');
        loading.classList.add('flex');

        emptyState.classList.add('hidden');

        try{

            const response = await fetch('{{ url("/api/v1/students") }}');

            if(!response.ok){
                throw new Error('Server gagal merespon.');
            }

            const result = await response.json();

            cachedStudents = result.records;

            document.getElementById('statTotal').textContent = result.total;

            const status = document.getElementById('statStatus');

            status.innerHTML = '● ONLINE';
            status.classList.remove(
                'bg-red-500/20',
                'text-red-400'
            );

            status.classList.add(
                'bg-emerald-500/20',
                'text-emerald-400'
            );

            document.getElementById('searchInput').disabled = false;

            renderStudents(cachedStudents);

        }catch(error){

            showToast(error.message);

            emptyState.classList.remove('hidden');

        }finally{

            loading.classList.add('hidden');

            btnSync.disabled = false;

            btnText.textContent = 'Sync Student Records';
        }
    });

    function renderStudents(data){

        const container = document.getElementById('studentContainer');

        container.innerHTML = '';

        if(data.length === 0){

            container.innerHTML = `
                <div class="col-span-full text-center py-20 text-slate-400">
                    Mahasiswa tidak ditemukan.
                </div>
            `;

            return;
        }

        data.forEach(student => {

            const initials = student.nama
                .split(' ')
                .map(word => word[0])
                .join('')
                .substring(0,2);

            const card = document.createElement('div');

            card.className =
                'student-card glass glow rounded-3xl p-7 transition-all duration-300';

            card.innerHTML = `
                <div class="flex items-start justify-between mb-6">

                    <div class="flex items-center gap-4">

                        <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-blue-500 to-purple-500 flex items-center justify-center text-lg font-bold shadow-lg">
                            ${initials}
                        </div>

                        <div>
                            <h2 class="text-xl font-semibold text-white">
                                ${student.nama}
                            </h2>

                            <p class="text-slate-400 text-sm">
                                ${student.prodi}
                            </p>
                        </div>

                    </div>

                    <span class="bg-blue-500/20 text-blue-400 text-xs font-semibold px-3 py-2 rounded-full">
                        ${student.kelas}
                    </span>

                </div>

                <div class="border-t border-slate-700 pt-5 flex items-center justify-between">

                    <div>
                        <p class="text-xs text-slate-500">
                            Nomor Induk Mahasiswa
                        </p>

                        <p class="text-sm font-semibold tracking-wider mt-1">
                            ${student.nim}
                        </p>
                    </div>

                    <div class="text-2xl">
                        📘
                    </div>

                </div>
            `;

            container.appendChild(card);

        });
    }

    document.getElementById('searchInput')
        .addEventListener('input', function(e){

            const keyword = e.target.value.toLowerCase();

            const filtered = cachedStudents.filter(student => {

                return student.nama.toLowerCase().includes(keyword)
                    || student.nim.includes(keyword);

            });

            renderStudents(filtered);
        });

    function showToast(message){

        const toast = document.getElementById('toast');
        const toastMsg = document.getElementById('toastMsg');

        toastMsg.textContent = message;

        toast.classList.remove(
            'translate-y-32',
            'opacity-0'
        );

        setTimeout(() => {

            toast.classList.add(
                'translate-y-32',
                'opacity-0'
            );

        }, 4000);
    }

</script>

</body>
</html>