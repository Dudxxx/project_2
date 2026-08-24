<?php
require_once 'includes/conexao.php';
$tituloPagina = 'RetroByte Store - Início';
$paginaAtual = 'inicio';

function validarProdutos(array $produtos): bool
{
    if (empty($produtos)) {
        return false;
    }

    foreach ($produtos as $produto) {
        if (!isset($produto['preco']) || $produto['preco'] < 0) {
            return false;
        }
    }

    return true;
}

function aplicarDesconto(array $produtos, float $percentual): array
{
    $resultado = [];

    foreach ($produtos as $produto) {
        $produto['preco_desconto'] = $produto['preco'] - ($produto['preco'] * $percentual / 100);
        $resultado[] = $produto;
    }

    return $resultado;
}

function filtrarProdutosPorPreco(array $produtos, float $valorMinimo): array
{
    $filtrados = [];

    foreach ($produtos as $produto) {
        if ($produto['preco'] > $valorMinimo) {
            $filtrados[] = $produto;
        }
    }

    return $filtrados;
}

function buscarProdutoPorNome(array $produtos, string $termo): array
{
    $resultado = [];

    foreach ($produtos as $produto) {
        if (stripos($produto['nome_produto'], $termo) !== false) {
            $resultado[] = $produto;
        }
    }

    return $resultado;
}

try {
    $sql = "
        SELECT p.id_produto, p.nome_produto, p.descricao, p.preco
        FROM produtos p
        WHERE p.destaque = 1
        ORDER BY p.id_produto DESC
        LIMIT 3
    ";
    $stmt = $pdo->query($sql);
    $destaques = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $destaques = [];
}

$produtosValidos = validarProdutos($destaques);
$produtosComDesconto = aplicarDesconto($destaques, 10);
$produtosAcimaDe100 = filtrarProdutosPorPreco($destaques, 100);

$termoBusca = isset($_GET['q']) ? trim($_GET['q']) : '';
$produtosEncontrados = $termoBusca !== '' ? buscarProdutoPorNome($destaques, $termoBusca) : $destaques;

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
                <a href="produtos.php" class="btn btn-primary btn-lg px-4 me-2">Ver catálogo</a>
                <a href="#tech-forge" class="btn btn-outline-light btn-lg px-4">Tech Forge</a>
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
        <?php if ($produtosValidos): ?>
            <?php foreach ($destaques as $produto): ?>
                <div class="col-md-4">
                    <div class="card produto-card h-100 border-0 shadow-sm">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title fw-bold">
                                <?= htmlspecialchars($produto['nome_produto']); ?>
                            </h5>
                            <p class="card-text text-muted">
                                <?= htmlspecialchars($produto['descricao']); ?>
                            </p>
                            <div class="mt-auto d-flex justify-content-between align-items-center">
                                <span class="preco">
                                    R$ <?= number_format($produto['preco'], 2, ',', '.'); ?>
                                </span>
                                <span class="badge text-bg-dark">Destaque</span>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12">
                <div class="alert alert-warning mb-0">
                    Nenhum produto em destaque encontrado.
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>

<section id="tech-forge" class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold mb-0">Ofertas da Semana</h2>
        <form method="GET" class="d-flex gap-2">
            <input
                type="text"
                name="q"
                class="form-control"
                placeholder="Buscar produto"
                value="<?= htmlspecialchars($termoBusca); ?>"
            >
            <button class="btn btn-primary" type="submit">Buscar</button>
        </form>
    </div>

    <?php if ($produtosValidos): ?>
        <div class="row g-4 mb-4">
            <?php foreach ($produtosComDesconto as $produto): ?>
                <div class="col-md-4">
                    <div class="card produto-card h-100 border-0 shadow-sm">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title fw-bold">
                                <?= htmlspecialchars($produto['nome_produto']); ?>
                            </h5>
                            <p class="card-text text-muted">
                                <?= htmlspecialchars($produto['descricao']); ?>
                            </p>

                            <p class="text-decoration-line-through text-muted mb-1">
                                R$ <?= number_format($produto['preco'], 2, ',', '.'); ?>
                            </p>

                            <h4 class="text-success mb-0">
                                R$ <?= number_format($produto['preco_desconto'], 2, ',', '.'); ?>
                            </h4>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="row g-4">
            <div class="col-md-6">
                <div class="card shadow-sm h-100 border-0">
                    <div class="card-body">
                        <h3 class="card-title h5 fw-bold">Produtos acima de R$ 100</h3>
                        <?php foreach ($produtosAcimaDe100 as $produto): ?>
                            <p class="mb-2">
                                <strong><?= htmlspecialchars($produto['nome_produto']); ?></strong><br>
                                R$ <?= number_format($produto['preco'], 2, ',', '.'); ?>
                            </p>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card shadow-sm h-100 border-0">
                    <div class="card-body">
                        <h3 class="card-title h5 fw-bold">Resultado da busca</h3>
                        <?php if (count($produtosEncontrados) > 0): ?>
                            <?php foreach ($produtosEncontrados as $produto): ?>
                                <p class="mb-2">
                                    <strong><?= htmlspecialchars($produto['nome_produto']); ?></strong><br>
                                    <?= htmlspecialchars($produto['descricao']); ?>
                                </p>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="alert alert-warning mb-0">
                                Nenhum produto encontrado.
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow-sm border-0 mt-4">
            <div class="card-body">
                <h3 class="card-title h5 fw-bold">Array principal</h3>
                <pre class="mb-0"><?php print_r($destaques); ?></pre>
            </div>
        </div>
    <?php else: ?>
        <div class="alert alert-danger mb-0">
            Nenhum dado válido foi encontrado no array.
        </div>
    <?php endif; ?>
</section>

<?php include 'includes/footer.php'; ?>