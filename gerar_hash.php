<?php
$sql = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$login = trim($_POST['login'] ?? '');
	$senha = $_POST['senha'] ?? '';
	if ($login !== '' && $senha !== '') {
		$hash = password_hash($senha, PASSWORD_DEFAULT);
		$sql = "UPDATE Usuarios SET Senha_usu = '" . $hash . "', Ativo_usu = 1 WHERE Login_usu = '"
			. str_replace("'", "''", $login) . "';";
	}
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head><meta charset="utf-8"><title>Gerar hash</title></head>
<body style="font-family:Arial;max-width:600px;margin:40px auto">
	<h3>Gerar UPDATE de senha</h3>
	<form method="post">
		<p>Usuário: <input name="login" required></p>
		<p>Senha: <input name="senha" required></p>
		<button>Gerar</button>
	</form>
	<?php if ($sql): ?>
		<p>Copie e rode no phpMyAdmin:</p>
		<textarea rows="5" style="width:100%"><?php echo htmlspecialchars($sql); ?></textarea>
	<?php endif; ?>
</body>
</html>