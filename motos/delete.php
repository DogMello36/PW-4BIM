<?php
include "function.php";

try {
    if (isset($_GET['id'])) {
        delete($_GET['id']);
    } //else {
    //     die("ERRO: ID não definido.");
    // }
} catch (Exception $e) {
    $_SESSION["message"] = "Nao foi possivel realizar a operacao.<br>{$e->getMessage()}";
    $_SESSION["type"] = "danger";
    header("location:index.php");
}
?>