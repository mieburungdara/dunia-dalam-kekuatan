<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dunia dalam Kekuatan</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        body { background-color: #f8f9fa; }
        .navbar { margin-bottom: 2rem; }
        .hide { display: none; }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="<?php echo $app_base_url; ?>">Dunia dalam Kekuatan</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#main-nav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="main-nav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="<?php echo $app_base_url; ?>">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="<?php echo $app_base_url; ?>/novel">Novel</a></li>
                <li class="nav-item"><a class="nav-link" href="<?php echo $app_base_url; ?>/karakter">Karakter</a></li>
                <li class="nav-item"><a class="nav-link" href="<?php echo $app_base_url; ?>/glosarium">Glosarium</a></li>
                <li class="nav-item"><a class="nav-link" href="<?php echo $app_base_url; ?>/faq">FAQ</a></li>
            </ul>
        </div>
    </div>
</nav>

<main class="container">