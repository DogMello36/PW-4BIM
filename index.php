<?php
include 'config.php';
include DBAPI;
include_once ABSPATH . 'inc/auth.php';

// visitante que clicou em "Continuar sem login"
if (isset($_GET['visitante'])) {
	$_SESSION['visitante'] = true;
}

// abriu o site sem login e sem escolher ser visitante: vai para o login
if (!esta_logado() && empty($_SESSION['visitante'])) {
	header('Location: ' . BASEURL . 'login.php');
	exit;
}

include HEADER_TEMPLATE;
$erro = null;
try {
	$db = open_database();
} catch (Exception $e) {
	$erro = $e->getMessage();
}
?>

<h1>Dashboard</h1>
<hr>

<?php if (!$erro): ?>

	<div class="row">
		<div class="col-xs-6 col-sm-3 col-md-2">
			<a href="customers/add.php" class="btn btn-secondary">
				<div class="row">
					<div class="col-xs-12 text-center">
						<i class="fa-solid fa-bicycle i"></i>
					</div>
					<div class="col-xs-12 text-center">
						<p>Nova Moto</p>
					</div>
				</div>
			</a>
		</div>

		<div class="col-xs-6 col-sm-3 col-md-2">
			<a href="customers" class="btn btn-light">
				<div class="row">
					<div class="col-xs-12 text-center">
						<i class="fa-solid fa-motorcycle i"></i>
					</div>
					<div class="col-xs-12 text-center">
						<p>Motos</p>
					</div>
				</div>
			</a>
		</div>
	</div>

<?php else: ?>
	<div class="alert alert-danger" role="alert">
		<p><b>ERRO:</b> Não foi possível Conectar ao Banco de Dados!<br>
			<?= $erro ?>
		</p>
	</div>

<?php endif; ?>

<?php include FOOTER_TEMPLATE; ?>