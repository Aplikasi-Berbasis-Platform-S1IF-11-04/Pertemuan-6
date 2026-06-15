<!DOCTYPE html>
<html>
    <head>
        <title>Data Mahasiswa</title>
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    </head>
    <body>
        <div class="bg-animation"></div>

        <div class="navbar">
            <div></div>
            <button onclick="loadData()">Load Data</button>
        </div>

        <div class="hero">
            <h1>Data Mahasiswa</h1>
            <p>by D'sharlendita Febianda Aurelia | 2311102069 </p>
            <br>
            <button class="cta" onclick="loadData()">Tampilkan Data</button>
        </div>

        <div class="container">
            <div id="result"></div>
        </div>
        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>