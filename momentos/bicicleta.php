<!--Aqui verifica se há um ID ( Número ou código único atribuído a cada item) de bicicleta na 
URL (Endereço de um recurso específico na web) e, se existir, mostra os detalhes
dessa bicicleta. Se não houver ID válido, redireciona para a página inicial. -->

<?php
session_start();

require 'conexao.php';

if (isset($_GET['b'])) {
    if (ctype_digit($_GET['b'])) { 
        $b = (int) $_GET['b'];
        if ($b > 0) {
            $sql = "SELECT * FROM tipos_bicicletas WHERE id_tipo_bic = ? LIMIT 1";
            $stmt = mysqli_prepare($conexao, $sql);
            mysqli_stmt_bind_param($stmt, "i", $b);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if (mysqli_num_rows($result) > 0) {
                $bicic = mysqli_fetch_assoc($result);
                $imagem = $bicic['imagem'] ?? '';
                $titulo = $bicic['modelo'] ?? '';
                $subtitulo = $bicic['subtitulo'] ?? '';
                $descricao = $bicic['descricao'] ?? '';

                if ($imagem) {
                    $imagem_nomebase = substr($imagem, 0, -5);
                    $imagem_extensao = substr($imagem, -3);

                    $imagem1 = $imagem_nomebase . "1." . $imagem_extensao;
                    $imagem2 = $imagem_nomebase . "2." . $imagem_extensao;
                    $imagem3 = $imagem_nomebase . "3." . $imagem_extensao;
                    $imagem4 = $imagem_nomebase . "4." . $imagem_extensao;
                    $imagem5 = $imagem_nomebase . "5." . $imagem_extensao;
                } else {
                    $imagem = ''; 
                }
            } else {
                header("Location: index.php");
                exit();
            }
        } else {
            header("Location: index.php");
            exit();
        }
    } else {
        header("Location: index.php");
        exit();
    }
} else {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-PT">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Momentos Terapêuticos e Bem Estar</title>
    <link rel="icon" type="image/png" href="img/Momentos.PNG">
    <link rel="stylesheet" href="css/estilos.css">
    <link rel="stylesheet" href="css/bicicleta.css">
    <link rel="stylesheet" href="css/slideshow.css">  
</head>
<body>
<!-- Imagem de fundo -->
<div id="tudo">
<?php include_once ("menu.php"); ?>

<!-- Estrutura Principal -->
<!-- Slide Show -->
<main>
    <div class="meio">

        <div class="esq">
            <div class="slideshow-container">
                <?php for ($i = 1; $i <= 5; $i++) { ?>
                    <?php 
                        if (!empty(${"imagem$i"})) { ?>
                        <div class="mySlides">
                            <div class="numbertext"><?php echo $i; ?> / 5</div>
                            <img src="img/<?php echo ${"imagem$i"}; ?>" style="width:100%">
                            <div class="text"></div>
                        </div>
                    <?php } ?>
                <?php } ?>
                <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                <a class="next" onclick="plusSlides(1)">&#10095;</a>
            </div>
        </div>

        <div class="dir">
            <div class="container">
                <div class="card">
                    <div class="texto">
                        <h1 class="text-main"><?php echo $titulo; ?></h1>
                        <h2 class="text-main2"><?php echo $subtitulo; ?></h2>
                        <p class="text-main3"><?php echo $descricao; ?></p>
                        <div class="button">
                            <button type="button" class="btn" onclick="window.location.href='Loja.php'">Entre na Loja</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- Estrutura de Footer -->
<?php include_once ("footer2.php"); ?>

<!-- Conexão ao java script ao SlideShow -->
<script src="js/slideshow.js"></script>

</div> 
</body>
</html>