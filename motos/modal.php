<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <!-- Modal de Delete-->
    <div class="modal fade" id="delete-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="modalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modalLabel">Excluir Item</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Deseja realmente excluir este item?
                </div>
                <div class="modal-footer">
                    <a id="confirm" class="btn btn-dark" href="#">
                        <i class="fa-solid fa-circle-check"></i> Sim
                    </a>
                    <a id="cancel" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fa-solid fa-circle-xmark"></i> Não
                    </a>
                </div>
            </div>
        </div>
    </div> <!-- /.modal -->
</body>

</html>