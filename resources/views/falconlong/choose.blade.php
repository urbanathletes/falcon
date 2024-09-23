@extends('master3')

@section('content')

<style>
    .card {
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        transition: all 0.3s ease;
    }

    .card:hover {
        transform: translateY(-5px);
        /* Efek hover saat kartu diklik */
    }

    .card-title {
        font-size: 1.2rem;
        font-weight: bold;
    }

    .btn-danger {
        background-color: #ff0000;
        border-color: #ff0000;
        width: 100%;
        /* Tombol penuh di HP */
        padding: 10px;
    }

    h3 {
        font-size: 1.5rem;
        margin-bottom: 15px;
    }

    p {
        font-size: 0.9rem;
    }

    /* Penyesuaian khusus untuk layar kecil */
    @media (max-width: 768px) {
        .card-body {
            padding: 15px;
            /* Kurangi padding di HP agar lebih kompak */
        }

        h3 {
            font-size: 1.2rem;
            /* Ukuran teks lebih kecil di HP */
        }

        .card-title {
            font-size: 1rem;
            /* Judul paket lebih kecil di HP */
        }

        .btn-danger {
            font-size: 0.9rem;
            /* Ukuran teks tombol lebih kecil di HP */
        }
    }
</style>
<div class="container mt-5">
    <div class="row">
        <!-- Contoh penggunaan Bootstrap untuk membuat grid 5 kolom -->
        <div class="col-md-12 text-center">
            <h1 class="text-white">Falcon Fitness Box</h1>
        </div>
        <div class="col-lg-2"></div> <!-- Tambahan padding kiri dan kanan -->

        <!-- Package 1 -->
        <div class="col-lg-2 col-md-6 mb-4">
            <div class="card text-white bg-dark p-3" style="border-radius: 15px;">
                <div class="card-body">
                    <h5 class="card-title text-warning">Presale Early Bird - EFT</h5>
                    <h3>IDR 848.000 / Month</h3>
                    <p class="small">(+ Rp. 488.000) untuk Myzone Heart Rate tracker</p>
                    <button class="btn btn-danger">Choose Package</button>
                </div>
            </div>
        </div>

        <!-- Package 2 -->
        <div class="col-lg-2 col-md-6 mb-4">
            <div class="card text-white bg-dark p-3" style="border-radius: 15px;">
                <div class="card-body">
                    <h5 class="card-title text-warning">Presale Early Bird</h5>
                    <h3>IDR 1.000.000 / Month</h3>
                    <p class="small">(+ Rp. 688.000) untuk Myzone Heart Rate tracker</p>
                    <button class="btn btn-danger">Choose Package</button>
                </div>
            </div>
        </div>

        <!-- Package 3 -->
        <div class="col-lg-2 col-md-6 mb-4">
            <div class="card text-white bg-dark p-3" style="border-radius: 15px;">
                <div class="card-body">
                    <h5 class="card-title text-warning">Presale Early Bird</h5>
                    <h3>IDR 2.888.000 / 3 Months</h3>
                    <p class="small">(+ Rp. 588.000) untuk Myzone Heart Rate tracker</p>
                    <button class="btn btn-danger">Choose Package</button>
                </div>
            </div>
        </div>

        <!-- Package 4 -->
        <div class="col-lg-2 col-md-6 mb-4">
            <div class="card text-white bg-dark p-3" style="border-radius: 15px;">
                <div class="card-body">
                    <h5 class="card-title text-warning">Presale Early Bird</h5>
                    <h3>IDR 4.888.000 / 6 Months</h3>
                    <p class="small">(+ Rp. 488.000) untuk Myzone Heart Rate tracker</p>
                    <button class="btn btn-danger">Choose Package</button>
                </div>
            </div>
        </div>

        <!-- Package 5 -->
        <div class="col-lg-2 col-md-6 mb-4">
            <div class="card text-white bg-dark p-3" style="border-radius: 15px;">
                <div class="card-body">
                    <h5 class="card-title text-warning">Presale Early Bird</h5>
                    <h3>IDR 8.888.000 / 12 Months</h3>
                    <p class="small">FREE Myzone Heart Rate</p>
                    <button class="btn btn-danger">Choose Package</button>
                </div>
            </div>
        </div>

        <div class="col-lg-2"></div> <!-- Tambahan padding kiri dan kanan -->
    </div>
</div>
@endsection