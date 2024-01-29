<?php

require "./conexao.php";

/* -- DELETE DADOS -- */

$id = $_POST['id'];

$sqlDelete = "DELETE FROM produtos WHERE id = :id";
$delete = $conexao->prepare($sqlDelete);
$delete->bindValue(':id', $id, PDO::PARAM_INT);

$delete->execute();
echo "<p class='alert alert-success'> Produto deletado! </p>";
