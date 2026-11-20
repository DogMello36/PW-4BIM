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
	close_database($db);
	$funcionarios = find_all('Funcionarios');
	$clientes = find_all('Cliente');
} catch (Exception $e) {
	$erro = $e->getMessage();
}
?>

<?php if (!$erro): ?>

	<section class="hero-panel mb-4">
		<div>
			<p class="eyebrow">PAINEL DE GESTÃO</p>
			<h1>Uma equipe forte começa com uma boa gestão.</h1>
			<p class="hero-copy mb-4">Consulte e mantenha os dados dos funcionários em um só lugar.</p>
			<a href="<?php echo BASEURL; ?>funcionarios/" class="btn btn-light">
				<i class="fa-solid fa-users"></i> Ver funcionários
			</a>
			<?php if (esta_logado()): ?>
				<a href="<?php echo BASEURL; ?>funcionarios/add.php" class="btn btn-primary ms-2">
					<i class="fa-solid fa-user-plus"></i> Novo funcionário
				</a>
			<?php endif; ?>
		</div>
		<span class="hero-symbol" aria-hidden="true"><i class="fa-solid fa-people-group"></i></span>
	</section>

	<div class="row g-3">
		<div class="col-md-6">
			<a href="<?php echo BASEURL; ?>funcionarios/" class="metric-card">
				<span class="metric-icon"><i class="fa-solid fa-user-tie"></i></span>
				<span><span class="metric-label">Funcionários cadastrados</span>
					<strong class="metric-number"><?php echo is_array($funcionarios) ? count($funcionarios) : 0; ?></strong></span>
				<span class="metric-arrow"><i class="fa-solid fa-arrow-right"></i></span>
			</a>
		</div>
		<div class="col-md-6">
			<a href="<?php echo BASEURL; ?>customers/" class="metric-card">
				<span class="metric-icon metric-icon-alt"><i class="fa-solid fa-users"></i></span>
				<span><span class="metric-label">Clientes cadastrados</span>
					<strong class="metric-number"><?php echo is_array($clientes) ? count($clientes) : 0; ?></strong></span>
				<span class="metric-arrow"><i class="fa-solid fa-arrow-right"></i></span>
			</a>
		</div>
	</div>

<?php else: ?>
	<div class="alert alert-danger" role="alert">
		<p><b>ERRO:</b> Não foi possível Conectar ao Banco de Dados!<br>
			<?= h($erro) ?>
		</p>
	</div>

<?php endif; ?>

<?php include FOOTER_TEMPLATE; ?>