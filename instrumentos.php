<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
require_once("util/Conexao.php");

$con = Conexao::getConexao();

$sql = "SELECT * FROM instrumento";
$stm = $con->prepare($sql);
$stm->execute();
$instrumentos = $stm->fetchAll();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Loja de Música</title>
    <link rel="stylesheet" href="styleIndex.css">
    <link rel="stylesheet" href="styleInst.css">
</head>
<body>

<header>
    <h1>Loja de música</h1>
</header>

<main>
    <div id="instrumentos">
        <!-- Botão voltar dentro do grid -->
        <div class="instrumento">
            <a href="index.php"><button class="btn-voltar">Voltar</button></a>
        </div>

        <?php
        $estado = "";
        $entrada = "";

        foreach ($instrumentos as $instrumento) {
            switch ($instrumento['estado']) {
                case 'N': $estado = "novo"; break;
                case 'S': $estado = "seminovo"; break;
                case 'U': $estado = "usado"; break;
                case 'M': $estado = "muito usado"; break;
                case 'Q': $estado = "quebrado"; break;
            }

            switch ($instrumento['entrada']) {
                case 'P': $entrada = "P10"; break;
                case 'F': $entrada = "P2/P3"; break;
                case 'X': $entrada = "XLR"; break;
                case 'M': $entrada = "MIDI"; break;
                case 'U': $entrada = "USB"; break;
                case 'O': $entrada = "Outros"; break;
            }

            echo '
            <div class="instrumento">
                <img src="' . $instrumento['imagem'] . '" alt="">
                <strong>Nome:</strong> ' . $instrumento['nome'] . '<br>
                <strong>Estado:</strong> ' . $estado . '<br>
                <strong>Preço:</strong> ' . $instrumento['preco'] . '<br>
                <strong>Entrada:</strong> ' . $entrada . '<br>
                <strong>Quantidade:</strong> ' . $instrumento['quantidade'] . '
            </div>';
        }
        ?>
    </div>
</main>

</body>
</html>
