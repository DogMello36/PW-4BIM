<?php
include('function.php');
view($_GET['id'] ?? null);
include(HEADER_TEMPLATE);
?>

<header class="page-heading">
    <div>
        <p class="eyebrow">DETALHES DO CADASTRO</p>
        <h1><?php echo h($funcionario['Nome']); ?></h1>
    </div>
</header>

<?php exibir_mensagem(); ?>

<section class="panel-card p-4">
    <dl class="detail-grid mb-0">
        <div>
            <dt>ID</dt>
            <dd>#<?php echo (int) $funcionario['Id']; ?></dd>
        </div>
        <div>
            <dt>Nome</dt>
            <dd><?php echo h($funcionario['Nome']); ?></dd>
        </div>
        <div>
            <dt>Endereço</dt>
            <dd><?php echo h($funcionario['Endereco']); ?></dd>
        </div>
        <div>
            <dt>Idade</dt>
            <dd><?php echo (int) $funcionario['Idade']; ?> anos</dd>
        </div>
        <div>
            <dt>Data de nascimento</dt>
            <dd><?php echo formatData($funcionario['DataNasc'], "d/m/Y"); ?></dd>
        </div>
        <div class="detail-wide">
            <dt>Foto</dt>
            <dd>
                <?php if (!empty($funcionario['Foto'])): ?>
                    <img src="<?php echo h(BASEURL . 'uploads/' . rawurlencode(basename($funcionario['Foto']))); ?>"
                        alt="Foto de <?php echo h($funcionario['Nome']); ?>" class="detail-image">
                <?php else: ?>
                    &mdash;
                <?php endif; ?>
            </dd>
        </div>
    </dl>
</section>

<div class="form-actions">
    <?php if (esta_logado()): ?>
        <a href="edit.php?id=<?php echo (int) $funcionario['Id']; ?>" class="btn btn-primary">
            <i class="fa-solid fa-pen-to-square"></i> Editar
        </a>
    <?php endif; ?>
    <a href="index.php" class="btn btn-light"><i class="fa-solid fa-arrow-left"></i> Voltar</a>
</div>

<?php include FOOTER_TEMPLATE; ?>
