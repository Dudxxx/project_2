<?php
require_once 'includes/conexao.php';
$tituloPagina = 'RetroByte Store - Produtos';

$sql = "
    SELECT
        p.id_produto,
        p.nome_produto,
        p.descricao,
        p.preco,
        GROUP_CONCAT(c.nome_categoria SEPARATOR ', ') AS categorias
    FROM produtos p
    LEFT JOIN produto_categoria pc ON pc.id_produto = p.id_produto
    LEFT JOIN categorias c ON c.id_categoria = pc.id_categoria
    GROUP BY p.id_produto, p.nome_produto, p.descricao, p.preco
    ORDER BY p.nome_produto ASC
";
$stmt = $pdo->query($sql);
$produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);

include 'includes/header.php';
?>

<div class="container my-5">
    <div class="mb-4">
        <h1 class="fw-bold mb-2">Catálogo de Produtos</h1>
        <p class="text-muted mb-0">Produtos carregados diretamente do banco de dados.</p>
    </div>

    <div class="row g-4">
        <?php if (count($produtos) > 0): ?>
            <?php foreach ($produtos as $produto): ?>
                <div class="col-md-6 col-lg-4">
                    <div class="card produto-card h-100 border-0 shadow-sm">
                        <div class="card-body d-flex flex-column">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <span class="badge text-bg-secondary"><?= htmlspecialchars($produto['categorias'] ?? 'Sem categoria'); ?></span>
                                <span class="badge text-bg-light">ID <?= (int)$produto['id_produto']; ?></span>
                            </div>

                            <h5 class="card-title fw-bold"><?= htmlspecialchars($produto['nome_produto']); ?></h5>
                            <p class="card-text text-muted"><?= htmlspecialchars($produto['descricao']); ?></p>

                            <div class="mt-auto d-flex justify-content-between align-items-center pt-3">
                                <span class="preco">R$ <?= number_format($produto['preco'], 2, ',', '.'); ?></span>
                                <button class="btn btn-outline-primary btn-sm" disabled>Em breve</button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12">
                <div class="alert alert-warning">Nenhum produto encontrado.</div>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php include 'includes/footer.php'; ?>