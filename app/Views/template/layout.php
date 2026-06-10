<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My CodeIgniter 4 App</title>
    <!-- Bootstrap CSS -->
    <style>
        body {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 250px;
            background-color: #722EF9;
            color: #fff;
            padding: 15px;
            position: fixed;
            height: 100%;
            overflow-y: auto;
        }

        .sidebar a {
            color: #ddd;
            text-decoration: none;
            display: block;
            padding: 10px;
        }

        .sidebar a:hover {
            background-color: white;
            color: black
        }

        .content {
            margin-left: 250px;
            margin-right: 150px;
            padding: 20px;
            flex-grow: 1;
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                position: relative;
                height: auto;
            }

            .content {
                margin-left: 0;
            }
        }
    </style>
    <link href="<?= base_url('bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">MyApp</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebar" aria-controls="sidebar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>

    <div class="sidebar">
        <h3>Menu</h3>
        <a href="/">Home</a>
        <a href="/barang/home">Data Barang</a>
        <a href="/pelanggan/home">Data Pelanggan</a>
        <a href="/transaksi/home">Data Transaksi</a>
        <a href="#">Laporan</a>
    </div>

    <div class="content">

        <?php $this->renderSection('content'); ?>

    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="<?= base_url('bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
    
</body>

</html>