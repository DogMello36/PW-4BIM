<?php
include("function.php");
index();
include HEADER_TEMPLATE;
?>

<header class="page-heading">
    <div>
        <p class="eyebrow">EQUIPE</p>
        <h1>Funcionários</h1>
        <p class="section-note mb-0">Consulte e gerencie os dados da equipe.</p>
    </div>
    <div class="d-flex gap-2">
        <?php if (esta_logado()): ?>
            <a class="btn btn-primary" href="add.php"><i class="fa-solid fa-user-plus"></i> Novo funcionário</a>
        <?php endif; ?>
        <a class="btn btn-light" href="index.php" aria-label="Atualizar lista">
            <i class="fa-solid fa-rotate"></i> Atualizar
        </a>
    </div>
</header>

<?php if (!empty($_SESSION['message'])): ?>
    <div class="alert alert-<?php echo h($_SESSION['type']); ?> alert-dismissible fade show" role="alert">
        <?php echo $_SESSION['message']; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
    </div>
    <?php clear_messages(); ?>
<?php endif; ?>

<section class="panel-card">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Foto</th>
                    <th>Nome</th>
                    <th>Endereço</th>
                    <th>Idade</th>
                    <th>Data de nascimento</th>
                    <th class="text-end">Opções</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($funcionarios): ?>
                    <?php foreach ($funcionarios as $funcionario): ?>
                        <tr>
                            <td><?php echo (int) $funcionario['Id']; ?></td>
                            <td>
                                <?php if (!empty($funcionario['Foto'])): ?>
                                    <img src="<?php echo h(BASEURL . 'uploads/' . rawurlencode(basename($funcionario['Foto']))); ?>"
                                        alt="Foto de <?php echo h($funcionario['Nome']); ?>" class="employee-thumb">
                                <?php else: ?>
                                    <span class="employee-thumb-placeholder"><i class="fa-solid fa-user"></i></span>
                                <?php endif; ?>
                            </td>
                            <td><strong><?php echo h($funcionario['Nome']); ?></strong></td>
                            <td><?php echo h($funcionario['Endereco']); ?></td>
                            <td><?php echo (int) $funcionario['Idade']; ?></td>
                            <td><?php echo formatData($funcionario['DataNasc'], "d/m/Y"); ?></td>
                            <td class="actions text-end text-nowrap">
                                <a href="view.php?id=<?php echo (int) $funcionario['Id']; ?>" class="btn btn-sm btn-light" aria-label="Visualizar">
                                    <i class="fa-solid fa-eye"></i>
                                </a>
                                <?php if (esta_logado()): ?>
                                    <a href="edit.php?id=<?php echo (int) $funcionario['Id']; ?>" class="btn btn-sm btn-primary" aria-label="Editar">
                                        <i class="fa-solid fa-pen"></i>
                                    </a>
                                    <a href="#" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal"
                                        data-bs-target="#delete-modal" data-customer="<?php echo (int) $funcionario['Id']; ?>" data-rotulo="Funcionário"
                                        aria-label="Excluir">
                                        <i class="fa-solid fa-trash"></i>
                                    </a>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="empty-state">Nenhum funcionário cadastrado.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <?php if ($funcionarios): ?>
        <div class="table-caption"><?php echo count($funcionarios); ?> funcionário(s) cadastrado(s)</div>
    <?php endif; ?>
</section>

<?php include "modal.php"; ?>
<?php include FOOTER_TEMPLATE; ?>
