<?php

require_once("util/Conexao.php");

$id = $_GET['id'];

$con = Conexao::getConexao();

$sql = "DELETE FROM instrumento WHERE id = ?;";
$stm = $con->prepare(query: $sql);
$stm->execute(params: [$id]);

header("location: index.php");