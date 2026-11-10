<?php
include('function.php');
view($_GET['id']);


include(HEADER_TEMPLATE);
?>

<h2>Moto <?php echo $customer['Id']; ?></h2>
<hr>

<?php if (!empty($_SESSION['message'])): ?>
    <div class="alert alert-<?php echo $_SESSION['type']; ?>"><?php echo $_SESSION['message']; ?></div>
<?php endif; ?>

<div class="detail-panel">
    <div class="detail-grid">
        <div class="detail-item">
            <span class="detail-label">Modelo:</span>
            <span class="detail-value"><?php echo $customer['Modelo']; ?></span>
        </div>
        <div class="detail-item">
            <span class="detail-label">Marca:</span>
            <span class="detail-value"><?php echo $customer['Marca']; ?></span>
        </div>
        <div class="detail-item">
            <span class="detail-label">Motor:</span>
            <span class="detail-value"><?php echo $customer['Motor']; ?></span>
        </div>
        <div class="detail-item">
            <span class="detail-label">Data de Cadastro:</span>
            <span class="detail-value"><?php echo formatData($customer['DataCad'], "d/m/Y - H:i:s"); ?></span>
        </div>
        <div class="detail-item">
            <span class="detail-label">Imagem:</span>
            <span class="detail-value">
                <?php if (!empty($customer['Imagem'])): ?>
                    <img src="<?php echo BASEURL . 'uploads/' . $customer['Imagem']; ?>" alt="Imagem da moto"
                        class="detail-image">
                <?php else: ?>
                    &mdash;
                <?php endif; ?>
            </span>
        </div>
    </div>
</div>

<div id="actions" class="row">
    <div class="col-md-12">
        <a href="edit.php?id=<?php echo $customer['Id']; ?>" class="btn btn-secondary"><i
                class="fa-solid fa-pen-to-square"></i> Editar</a>
        <a href="index.php" class="btn btn-light"><i class="fa-solid fa-arrow-rotate-left"></i> Voltar</a>
    </div>

</div>

<?php include FOOTER_TEMPLATE; ?>
