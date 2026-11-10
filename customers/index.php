<?php
    include("function.php");
    index();
    include HEADER_TEMPLATE;
?>

<header>
    <div class="row">
        <div class="col-sm-6">
            <h2>Motos</h2>
        </div>
        <div class="col-sm-6 text-end h2">
            <a class="btn btn-secondary mb-2" href="add.php"><i class="fa-solid fa-bicycle"></i> Nova Moto</a>
            <a class="btn btn-light" href="index.php"><i class="fa-solid fa-refresh"></i> Atualizar</a>
        </div>
    </div>
</header>

<?php if (!empty($_SESSION['message'])): ?>
    <div class="alert alert-<?php echo $_SESSION['type']; ?> alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                aria-hidden="true">&times;</span></button>
        <?php echo $_SESSION['message']; ?>
    </div>
    <?php //clear_messages(); ?> 
    <!-- clear_messages -> limpa as msg´s ($_SESSION['message'] e $_SESSION['type'])-->
<?php endif; ?>

<hr>

<table class="table table-hover">
    <thead>
        <tr>
            <th>ID</th>
            <th width="30%">Modelo</th>
            <th>Marca</th>
            <th>Motor</th>
            <th>Atualizado em</th>
            <th>Opções</th>
        </tr>
    </thead>
    <tbody>
        <!-- Os dois pontos ":" indica se vai mostrar o que vira depois-->
        <?php if ($customers): ?>
            <?php foreach ($customers as $customer): ?> 
                <tr>
                    <td><?php echo $customer['Id']; ?></td>
                    <td><?php echo $customer['Modelo']; ?></td>
                    <td><?php echo $customer['Marca']; ?></td>
                    <td><?php echo $customer['Motor']; ?></td>
                    <td>
                        <?php 
                            $dt = new DateTime($customer['DataCad'], new DateTimeZone("America/Sao_Paulo"));
                            echo $dt->format("d/m/Y - H:i:s"); 
                        ?>
                    </td>
                    <td class="actions text-end">
                        <a href="view.php?id=<?php echo $customer['Id']; ?>" class="btn btn-sm btn-light"><i
                                class="fa fa-eye"></i> Visualizar</a>
                        <a href="edit.php?id=<?php echo $customer['Id']; ?>" class="btn btn-sm btn-secondary"><i
                                class="fa fa-pencil"></i> Editar</a>
                        <a href="#" class="btn btn-sm btn-dark mt-2" data-bs-toggle="modal" data-bs-target="#delete-modal"
                            data-customer="<?= $customer['Id']; ?>">
                            <i class="fa fa-trash"></i> Excluir
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="6">Nenhum registro encontrado.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<?php include "modal.php"; ?>
<?php include FOOTER_TEMPLATE; ?>