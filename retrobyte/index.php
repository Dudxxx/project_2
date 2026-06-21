<?php
require_once 'includes/conexao.php';
$tituloPagina = 'RetroByte Store - Início';

$sql = "
    SELECT p.id_produto, p.nome_produto, p.descricao, p.preco
    FROM produtos p
    WHERE p.destaque = 1
    ORDER BY p.id_produto DESC
    LIMIT 3
";
$stmt = $pdo->query($sql);
$destaques = $stmt->fetchAll(PDO::FETCH_ASSOC);

include 'includes/header.php';
?>

<section class="hero py-5">
    <div class="container">
        <div class="row align-items-center g-4">
            <div class="col-lg-7">
                <span class="badge bg-primary-subtle text-primary mb-3">Loja Gamer & Tech</span>
                <h1 class="display-5 fw-bold mb-3">Seu setup começa aqui.</h1>
                <p class="lead text-light-emphasis mb-4">
                    A RetroByte Store reúne periféricos modernos, design elegante e produtos escolhidos para quem quer performance.
                </p>
                <a href="produtos.php" class="btn btn-primary btn-lg px-4">Ver catálogo</a>
            </div>
            <div class="col-lg-5">
                <div class="hero-card p-4 p-md-5 rounded-4 shadow-lg">
                    <h3 class="fw-bold mb-3">O que você encontra</h3>
                    <ul class="list-unstyled mb-0">
                        <li class="mb-2">• Teclados mecânicos</li>
                        <li class="mb-2">• Mouses gamer</li>
                        <li class="mb-2">• Headsets</li>
                        <li class="mb-0">• Monitores e acessórios</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold mb-0">Produtos em destaque</h2>
        <a href="produtos.php" class="text-decoration-none">Ver todos</a>
    </div>

    <div class="row g-4">
        <?php if (count($destaques) > 0): ?>
            <?php foreach ($destaques as $produto): ?>
                <div class="col-md-4">
                    <div class="card produto-card h-100 border-0 shadow-sm">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title fw-bold"><?= htmlspecialchars($produto['nome_produto']); ?></h5>
                            <p class="card-text text-muted"><?= htmlspecialchars($produto['descricao']); ?></p>
                            <div class="mt-auto d-flex justify-content-between align-items-center">
                                <span class="preco">R$ <?= number_format($produto['preco'], 2, ',', '.'); ?></span>
                                <span class="badge text-bg-dark">Destaque</span>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12">
                <div class="alert alert-warning">Nenhum produto em destaque encontrado.</div>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php include 'includes/footer.php'; ?>