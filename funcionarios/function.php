<?php
ob_start();

include('../config.php');
include(DBAPI);
include_once('../inc/auth.php');

const FUNCIONARIOS_TABELA = 'funcionarios';

$funcionarios = null;
$funcionario = null;

function formatData($data, $formato)
{
	if (empty($data)) {
		return '—';
	}
	$dt = new DateTime($data, new DateTimeZone("America/Sao_Paulo"));
	return $dt->format($formato);
}

function dadosFuncionario($origem)
{
	return [
		'Nome' => trim($origem['Nome'] ?? ''),
		'Endereco' => trim($origem['Endereco'] ?? ''),
		'Idade' => trim((string) ($origem['Idade'] ?? '')),
		'DataNasc' => trim($origem['DataNasc'] ?? ''),
	];
}

function validarFuncionario($dados)
{
	$erros = [];

	foreach (['Nome' => 50, 'Endereco' => 50] as $campo => $max) {
		if ($dados[$campo] === '') {
			$erros[] = "O campo $campo é obrigatório.";
		} elseif (mb_strlen($dados[$campo]) > $max) {
			$erros[] = "O campo $campo aceita no máximo $max caracteres.";
		}
	}

	$idade = filter_var($dados['Idade'], FILTER_VALIDATE_INT);
	if ($idade === false || $idade < 0 || $idade > 150) {
		$erros[] = "Informe uma idade válida entre 0 e 150 anos.";
	}

	$dataNasc = DateTime::createFromFormat('!Y-m-d', $dados['DataNasc']);
	if (!$dataNasc || $dataNasc->format('Y-m-d') !== $dados['DataNasc']) {
		$erros[] = "Informe uma data de nascimento válida.";
	}

	return $erros;
}

function definir_erro($mensagens)
{
	$_SESSION['message'] = is_array($mensagens) ? implode('<br>', $mensagens) : $mensagens;
	$_SESSION['type'] = "danger";
}

function index()
{
	global $funcionarios;
	$funcionarios = find_all(FUNCIONARIOS_TABELA, 'Nome');
}

function uploadFoto($fotoAtual = null)
{
	if (empty($_FILES['funcionario']['name']['Foto']) ||
		$_FILES['funcionario']['error']['Foto'] === UPLOAD_ERR_NO_FILE) {
		return $fotoAtual;
	}

	if ($_FILES['funcionario']['error']['Foto'] !== UPLOAD_ERR_OK) {
		definir_erro("Não foi possível enviar a foto.");
		return false;
	}

	$extensoesPermitidas = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
	$nomeOriginal = $_FILES['funcionario']['name']['Foto'];
	$extensao = strtolower(pathinfo($nomeOriginal, PATHINFO_EXTENSION));

	if (!in_array($extensao, $extensoesPermitidas, true)) {
		definir_erro("Formato de imagem não permitido. Use JPG, PNG, GIF ou WEBP.");
		return false;
	}

	if ($_FILES['funcionario']['size']['Foto'] > 2 * 1024 * 1024) {
		definir_erro("A foto deve ter no máximo 2MB.");
		return false;
	}

	if (@getimagesize($_FILES['funcionario']['tmp_name']['Foto']) === false) {
		definir_erro("O arquivo enviado não é uma imagem válida.");
		return false;
	}

	$pastaUploads = __DIR__ . '/../uploads/';
	if (!is_dir($pastaUploads) && !mkdir($pastaUploads, 0755, true) && !is_dir($pastaUploads)) {
		definir_erro("Não foi possível preparar a pasta de fotos.");
		return false;
	}

	$nomeArquivo = substr(md5(uniqid('', true)), 0, 20) . '.' . $extensao;
	if (!move_uploaded_file($_FILES['funcionario']['tmp_name']['Foto'], $pastaUploads . $nomeArquivo)) {
		definir_erro("Não foi possível salvar a foto no servidor.");
		return false;
	}

	return $nomeArquivo;
}

function apagarFoto($nomeArquivo)
{
	if (empty($nomeArquivo)) {
		return;
	}
	$caminho = __DIR__ . '/../uploads/' . basename($nomeArquivo);
	if (is_file($caminho)) {
		unlink($caminho);
	}
}

function view($id = null)
{
	global $funcionario;

	$id = (int) $id;
	$funcionario = $id > 0 ? find(FUNCIONARIOS_TABELA, $id) : null;

	if (!$funcionario) {
		$_SESSION['message'] = "Funcionário não encontrado.";
		$_SESSION['type'] = "warning";
		header('location: index.php');
		exit;
	}
}

function add()
{
	global $funcionario;
	exigir_login();

	if (empty($_POST['funcionario'])) {
		return;
	}

	$dados = dadosFuncionario($_POST['funcionario']);
	$funcionario = $dados;
	$erros = validarFuncionario($dados);
	if ($erros) {
		definir_erro($erros);
		return;
	}

	$foto = uploadFoto();
	if ($foto === false) {
		return;
	}

	$dados['Idade'] = (int) $dados['Idade'];
	$dados['DataNasc'] .= ' 00:00:00';
	$dados['Foto'] = $foto;

	if (save(FUNCIONARIOS_TABELA, $dados)) {
		header('location: index.php');
		exit;
	}
	apagarFoto($foto);
}

function edit()
{
	global $funcionario;
	exigir_login();

	$id = (int) ($_GET['id'] ?? 0);
	if ($id <= 0) {
		header('location: index.php');
		exit;
	}

	$atual = find(FUNCIONARIOS_TABELA, $id);
	if (!$atual) {
		$_SESSION['message'] = "Funcionário não encontrado.";
		$_SESSION['type'] = "warning";
		header('location: index.php');
		exit;
	}

	if (isset($_POST['funcionario'])) {
		$dados = dadosFuncionario($_POST['funcionario']);
		$erros = validarFuncionario($dados);
		if ($erros) {
			definir_erro($erros);
			$funcionario = array_merge($atual, $dados);
			return;
		}

		$foto = uploadFoto($atual['Foto'] ?? null);
		if ($foto === false) {
			$funcionario = array_merge($atual, $dados);
			return;
		}

		$dados['Idade'] = (int) $dados['Idade'];
		$dados['DataNasc'] .= ' 00:00:00';
		$dados['Foto'] = $foto;

		if (update(FUNCIONARIOS_TABELA, $id, $dados)) {
			if ($foto && $foto !== ($atual['Foto'] ?? null)) {
				apagarFoto($atual['Foto'] ?? null);
			}
			header("location: index.php");
			exit;
		}

		if ($foto && $foto !== ($atual['Foto'] ?? null)) {
			apagarFoto($foto);
		}
		$funcionario = array_merge($atual, $dados);
	}

	if (!$funcionario) {
		$funcionario = $atual;
	}
}

function delete($id = null)
{
	exigir_login();

	$id = (int) $id;
	if ($id > 0) {
		$atual = find(FUNCIONARIOS_TABELA, $id);
		if ($atual) {
			if (remove(FUNCIONARIOS_TABELA, $id)) {
				apagarFoto($atual['Foto'] ?? null);
			}
		} else {
			$_SESSION['message'] = "Funcionário não encontrado.";
			$_SESSION['type'] = "warning";
		}
	}

	header("location: index.php");
	exit;
}
?>
