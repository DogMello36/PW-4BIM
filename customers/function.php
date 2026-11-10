<?php
ob_start(); //output buffer aberto, para não dar erro de header location

include('../config.php');
include(DBAPI);

$customers = null;
$customer = null;

/**
 *  Formatar as datas
 */
function formatData($data, $formato)
{
	$dt = new Datetime($data, new DateTimeZone("America/Sao_Paulo"));// "-0300"
	return $dt->format($formato);
}

/**
 *  Formatar os telefones
 */
function telefone($tel)
{ //15999990000
	return "(" . substr($tel, 0, 2) . ")" . substr($tel, 2, 5)
		. "-" . substr($tel, 7, 4);
}

/**
 *  Formatar os cep´s
 */
function cep($cep)
{
	return substr($cep, 0, 5) . "-" . substr($cep, 5, 3);
}

/**
 *  Listagem de Clientes
 */
function index()
{
	global $customers;
	$customers = find_all("customers");
	//find_all e find é a mesma coisa, resulta na mesma coisa
}
function uploadImagem($imagemAtual = null)
{
	if (empty($_FILES['customer']['name']['imagem']) || $_FILES['customer']['error']['imagem'] === UPLOAD_ERR_NO_FILE) {
		return $imagemAtual;
	}

	if ($_FILES['customer']['error']['imagem'] !== UPLOAD_ERR_OK) {
		$_SESSION['message'] = "Não foi possível enviar a imagem.";
		$_SESSION['type'] = "danger";
		return $imagemAtual;
	}

	$extensoesPermitidas = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
	$nomeOriginal = $_FILES['customer']['name']['imagem'];
	$extensao = strtolower(pathinfo($nomeOriginal, PATHINFO_EXTENSION));

	if (!in_array($extensao, $extensoesPermitidas)) {
		$_SESSION['message'] = "Formato de imagem não permitido. Use JPG, PNG, GIF ou WEBP.";
		$_SESSION['type'] = "danger";
		return $imagemAtual;
	}

	if ($_FILES['customer']['size']['imagem'] > 2 * 1024 * 1024) { // 2MB
		$_SESSION['message'] = "A imagem deve ter no máximo 2MB.";
		$_SESSION['type'] = "danger";
		return $imagemAtual;
	}

	$pastaUploads = __DIR__ . '/../uploads/';
	if (!is_dir($pastaUploads)) {
		mkdir($pastaUploads, 0755, true);
	}

	// nome curto o suficiente para caber na coluna varchar(30)
	$nomeArquivo = substr(md5(uniqid('', true)), 0, 20) . '.' . $extensao;

	if (!move_uploaded_file($_FILES['customer']['tmp_name']['imagem'], $pastaUploads . $nomeArquivo)) {
		$_SESSION['message'] = "Não foi possível salvar a imagem no servidor.";
		$_SESSION['type'] = "danger";
		return $imagemAtual;
	}

	return $nomeArquivo;
}

/**
 *  Visualização de um Cliente
 */
function view($id = null)
{
	global $customer;
	$customer = find('customers', $id);
}

/**
 *  Cadastro de Clientes
 */
function add()
{
	if (!empty($_POST['customer'])) {

		$today = new DateTime('now', new DateTimeZone('America/Sao_Paulo'));

		$customer = $_POST['customer'];
		$customer['DataCad'] = $today->format("Y-m-d H:i:s");
		$customer['Imagem'] = uploadImagem();

		save('customers', $customer);
		header('location: index.php');
	}
}

/**
 *	Atualizacao/Edicao de Cliente
 */
function edit() {

  $now = date_create('now', new DateTimeZone('America/Sao_Paulo'));

  if (isset($_GET['id'])) {

    $id = $_GET['id'];

        if (isset($_POST['customer'])) {

      $customer = $_POST['customer'];

      $clienteAtual = find('customers', $id);
      $customer['Imagem'] = uploadImagem($clienteAtual['Imagem'] ?? null);

      update("customers", $id, $customer);
      header("location: index.php");
    } else {

      global $customer;
      $customer = find("customers", $id);
    } 
  } else {
    header("location: index.php");
  }
}

/**
 *  Exclusão de um Cliente
 */
function delete($id = null) {

  global $customer;
  $customer = remove('customers', $id);

  header("location: index.php");
}

?>