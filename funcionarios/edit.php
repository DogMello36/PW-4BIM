<?php
include "function.php";
edit();
include HEADER_TEMPLATE;
?>

<header class="page-heading">
    <div>
        <p class="eyebrow">CADASTRO #<?php echo (int) $funcionario['Id']; ?></p>
        <h1>Editar funcionário</h1>
    </div>
</header>

<?php exibir_mensagem(); ?>

<div class="panel-card p-4">
    <form action="edit.php?id=<?php echo (int) $funcionario['Id']; ?>" method="post" enctype="multipart/form-data" class="record-form">
        <div class="row g-3">
            <div class="form-group col-md-6">
                <label for="nome">Nome</label>
                <input type="text" class="form-control" id="nome" name="funcionario[Nome]" maxlength="50" required
                    value="<?php echo h($funcionario['Nome']); ?>">
            </div>

            <div class="form-group col-md-6">
                <label for="endereco">Endereço</label>
                <input type="text" class="form-control" id="endereco" name="funcionario[Endereco]" maxlength="50" required
                    value="<?php echo h($funcionario['Endereco']); ?>">
            </div>

            <div class="form-group col-md-3">
                <label for="idade">Idade</label>
                <input type="number" class="form-control" id="idade" name="funcionario[Idade]" min="0" max="150" required
                    value="<?php echo h($funcionario['Idade']); ?>">
            </div>

            <div class="form-group col-md-4">
                <label for="data-nasc">Data de nascimento</label>
                <input type="date" class="form-control" id="data-nasc" name="funcionario[DataNasc]" required
                    value="<?php echo h(formatData($funcionario['DataNasc'], "Y-m-d")); ?>">
            </div>

            <div class="form-group col-md-5">
                <label for="foto">Foto</label>
                <input type="file" class="form-control" id="foto" name="funcionario[Foto]"
                    accept="image/png, image/jpeg, image/gif, image/webp">
                <small class="form-hint">JPG, PNG, GIF ou WEBP, até 2MB.</small>
                <?php if (!empty($funcionario['Foto'])): ?>
                    <div class="current-image">
                        <img src="<?php echo h(BASEURL . 'uploads/' . rawurlencode(basename($funcionario['Foto']))); ?>"
                            alt="Foto atual de <?php echo h($funcionario['Nome']); ?>">
                        <span>Foto atual</span>
                    </div>
                <?php endif; ?>
                <div id="foto-preview-wrapper" class="current-image" style="display: none;">
                    <img id="foto-preview" src="" alt="Prévia da foto selecionada">
                    <span>Prévia da foto selecionada</span>
                </div>
            </div>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">
                <i class="fa-solid fa-floppy-disk"></i> Salvar alterações
            </button>
            <a href="index.php" class="btn btn-light">Cancelar</a>
        </div>
    </form>
</div>

<script>
    document.getElementById('foto').addEventListener('change', function (event) {
        var wrapper = document.getElementById('foto-preview-wrapper');
        var preview = document.getElementById('foto-preview');
        var arquivo = event.target.files[0];

        if (!arquivo) {
            wrapper.style.display = 'none';
            preview.src = '';
            return;
        }

        var leitor = new FileReader();
        leitor.onload = function (e) {
            preview.src = e.target.result;
            wrapper.style.display = 'flex';
        };
        leitor.readAsDataURL(arquivo);
    });
</script>

<?php include FOOTER_TEMPLATE; ?>
