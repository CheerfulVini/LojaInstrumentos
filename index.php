<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once("util/Conexao.php");

$con = Conexao::getConexao();

$sql = "SELECT * FROM instrumento";
$stm = $con->prepare($sql);
$stm->execute();
$instrumentos = $stm->fetchAll();
$msg = "";
    
if(isset($_POST['nome'])){
    if ($_POST['quantidade'] > 0 and $_POST['preco'] > 0) {
        $nome = $_POST['nome'];
        $marca = $_POST['marca'];
        $estado = $_POST['estado'];
        $preco = $_POST['preco'];
        $quantidade = $_POST['quantidade'];
        $entrada = $_POST['entrada'];
        $imagem = $_POST['imagem'];

        $sql = "INSERT INTO instrumento (nome, marca, estado, preco, quantidade, entrada, imagem) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stm = $con->prepare(query: $sql);
        $stm->execute(params: [$nome, $marca, $estado, $preco, $quantidade, $entrada, $imagem]);
        header("location: index.php");
    }else{
        $msg = "ESCREVE DIREITO ARROMBADO";
    }
}else{
    $msg = "ESCREVE DIREITO ARROMBADO";
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styleIndex.css">
</head>

<body>

    <header>
        <h1>Loja de musica</h1>
    </header>

    <main>
        
        <form action="" method="post">
            <? print($msg); ?>
            Nome<input type="text" name="nome" required><br>
            Marca<input type="text" name="marca"required><br>
            Estado<select name="estado" id="" required>
                <option value="">------------</option>
                <option value="N">Novo</option>
                <option value="S">Seminovo</option>
                <option value="U">Usado</option>
                <option value="M">Muito usado</option>
                <option value="Q">Quebrado</option>
            </select><br>
            Preço<input type="number" name="preco" id="" required><br>
            Quantidade<input type="number" name="quantidade" id="" required><br>
            Entrada<select name="entrada" id="" required>
                <option value="">------------</option>
                <option value="P">P10</option>
                <option value="F">P2/P3</option>
                <option value="X">XLR</option>
                <option value="M">MIDI</option>
                <option value="U">USB</option>
                <option value="O">Outros</option>
            </select><br>
            Link da imagem<input type="text" name="imagem" id="" required><br>
                <button type="submit">Enviar</button>
                <a href="instrumentos.php">Mostrar todos os instrumentos</a>
        </form>

        <div id="tabela">

            <?php
                $estado = "";
                $entrada = "";

                 print("<table style='border:1px solid black; background-color: white;'>");

                print("<tr style='border:1px solid black;'> <th style='border:1px solid black;'>Nome</th> <th style='border:1px solid black;'>Marca</th> <th style='border:1px solid black;'>Estado</th> <th style='border:1px solid black;'>Preço</th> <th style='border:1px solid black;'>Quantidade</th> <th style='border:1px solid black;'>Entrada</th> <th style='border:1px solid black;'>Excluir</th> </tr>");
                foreach ($instrumentos as $instrumento) {


                    switch ($instrumento['estado']) {
                        case 'N':
                            $estado = "novo";
                        break;

                        case 'S':
                            $estado = "seminovo";
                        break;

                        case 'U':
                            $estado = "usado";
                        break;

                        case 'M':
                            $estado = "muito usado";
                        break;

                        case 'Q':
                            $estado = "quebrado";
                        break;
                    }

                    switch ($instrumento['entrada']) {
                        case 'P':
                            $entrada = "P10";
                        break;

                        case 'F':
                            $entrada = "P2/P3";
                        break;

                        case 'X':
                            $entrada = "XLR";
                        break;

                        case 'M':
                            $entrada = "MIDI";
                        break;

                        case 'U':
                            $entrada = "USB";
                        break;

                        case 'O':
                            $entrada = "Outros";
                        break;
                        
                        default:
                            # code...
                        break;
                    }


                    print("<tr style='border:1px solid black;'>");
                        print("<td style='border:1px solid black;'>" . $instrumento['nome'] . "</td>");
                        print("<td style='border:1px solid black;'>" . $instrumento['marca'] . "</td>");
                        print("<td style='border:1px solid black;'>" . $estado . "</td>");
                        print("<td style='border:1px solid black;'>" . $instrumento['preco'] . "</td>");
                        print("<td style='border:1px solid black;'>" . $instrumento['quantidade'] . "</td>");
                        print("<td style='border:1px solid black;'>" . $entrada . "</td>");
                        print("<td style='border:1px solid black;'> <a onclick='return confirm('Certeza?')' href='excluir.php?id=" . $instrumento['ID'] . "'><button>Excluir</button></a> </td>");
                    print("</tr>");
                }
            ?>
        </div>
    </main>
</body>
</html>