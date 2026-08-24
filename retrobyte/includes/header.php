<?php
if (!isset($tituloPagina)) {
    $tituloPagina = 'RetroByte Store';
}

if (!isset($paginaAtual)) {
    $paginaAtual = '';
}

function ativo(string $pagina, string $atual): string
{
    return $pagina === $atual ? 'active fw-bold' : '';
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($tituloPagina); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm sticky-top">
    <div class="container">
        <a class="navbar-brand fw-bold" href="index.php">RetroByte Store</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menuTopo">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="menuTopo">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link <?= ativo('inicio', $paginaAtual); ?>" href="index.php">Início</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= ativo('produtos', $paginaAtual); ?>" href="produtos.php">Produtos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= ativo('sobre', $paginaAtual); ?>" href="sobre.php">Sobre</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= ativo('tech', $paginaAtual); ?>" href="index.php#tech-forge">Tech Forge</a>
                </li>
            </ul>
        </div>
    </div>
</nav>