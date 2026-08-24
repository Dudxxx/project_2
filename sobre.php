<?php
$tituloPagina = 'RetroByte Store - Sobre';
$paginaAtual = 'sobre';

include 'includes/header.php';
?>

<div class="container my-5">
    <div class="row align-items-center g-5">
        <div class="col-lg-6">
            <span class="badge bg-primary-subtle text-primary mb-3">Sobre a loja</span>
            <h1 class="fw-bold mb-3">Quem somos</h1>
            <p class="lead">
                A RetroByte Store é uma loja fictícia criada para o projeto acadêmico, com foco em periféricos gamer e tecnologia.
            </p>
            <p class="text-muted">
                O objetivo do sistema é apresentar um catálogo moderno, organizado e dinâmico, com dados vindos do banco de dados,
                visual profissional com Bootstrap e navegação simples entre páginas.
            </p>

            <div class="d-flex gap-2 mt-4">
                <a href="produtos.php" class="btn btn-primary">Ver produtos</a>
                <a href="index.php" class="btn btn-outline-secondary">Voltar ao início</a>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card border-0 shadow-sm produto-card">
                <div class="card-body p-4 p-md-5">
                    <h3 class="fw-bold mb-3">Nossa proposta</h3>
                    <ul class="list-unstyled mb-0">
                        <li class="mb-3">• Interface limpa e profissional</li>
                        <li class="mb-3">• Produtos carregados do banco de dados</li>
                        <li class="mb-3">• Navegação entre páginas</li>
                        <li class="mb-0">• Estrutura ideal para apresentação acadêmica</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>