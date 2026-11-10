<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <title>Redline Motors | Painel de Motos</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="keywords" content="">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@500;600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="<?php echo BASEURL; ?>css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo BASEURL; ?>css/all.min.css">
    <link rel="stylesheet" href="<?php echo BASEURL; ?>css/style.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg fixed-top mb-3" data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="<?php echo BASEURL; ?>index.php"><i class="fa-solid fa-motorcycle"></i>
                <span class="rl-tag">GARAGE</span> MOTORS</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCrud"
                aria-controls="navbarCrud" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCrud">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <i class="fa-solid fa-motorcycle"></i> Motos
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="<?php echo BASEURL; ?>customers"><i
                                        class="fa-solid fa-motorcycle"></i> Gerenciar Motos</a>
                            </li>
                            <li><a class="dropdown-item" href="<?php echo BASEURL; ?>customers/add.php"><i
                                        class="fa-solid fa-bicycle"></i> Nova Moto</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="container">