<?php session_start();?>



<!DOCTYPE html>
<html lang="Pt-pt">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Momentos Terapêuticos e Bem Estar</title>
    <link rel="icon" type="image/png" href="img/Momentos.PNG">
    <link rel="stylesheet" href="css/estilos.css">
    <link rel="stylesheet" href="css/pag_inicial.css">    
</head>
<body>

<!-- Imagem de fundo -->
<div id="tudo">

<?php include_once ("menu_index.php"); ?>

<main>
<!-- Frase de login -->
<div id="ola">
    <div class="box_ola sb1">

        Olá,
        <?php  
        	if (!isset($_SESSION['username'])) {
               echo' se deseja fazer pré-reserva faça login';
            } else {
                echo $_SESSION['username'];
            }
        ?>  
         💚
        

    </div>
</div>

<!-- Texto Principal -->
    <div id="slogan">

        <div id="descubra_como_momentos">
            <div id="descubra_como" class="Text-Verde">DESCUBRA COMO </div>
            <div id="momentos_slogan" class="momentos_2">
                <img src="img/Momentos_titulo.PNG" width="150px" >
            </div>
        </div>

        <div id="fazer_diferenca" class="Text-Branco">
            ESTÁ A FAZER A DIFERENÇA
        </div>

        <div id="botao_video">
            <div id="botao_v" class="anima_botao">
                <img src="img/botao.png" width="100px" alt="Tocar/sair vídeo" onclick="mostravideo()">
            </div>
        </div>


    </div>

<!-- Botão para o video principal -->
<div id="video_principal">
    <video id="video" controls
    poster="img/Capa_video.jpg">
        <source src="movie.mp4" type="video/mp4">
    </video>
</div>

    <div id="botao_video2">
            <div id="botao_v2" class="anima_botao">
                <img src="img/botao.png" width="100px" alt="Tocar/sair vídeo" onclick="escondevideo()">
        </div>
    </div>

<!-- Texto Princiapal-->
 <div id="text_sec" >
    <h3>Este website tem a finalidade informativa e de pré-reserva. 
    <br>Após realizar a sua pré-reserva, aguarde o contato  formal da
    <br>nossa empresa para proceder à efetivação da transação de aluguer.</h3>
    <div>Os preços variam conforme a quantidade de dias e bicicletas escolhidas para reserva.</div>
 </div>

<!-- Link para as Redes Sociais-->
<div class="Facebook" id="social">
    <a href="https://www.instagram.com/momentos_terapeuticos_bemestar/">
    <img width="40px" src="img/Instagram.png">
    </a>
    <a href="https://www.facebook.com/profile.php?id=100063675845776">
    <img width="34px" src="img/Facebook.png">    
    </a>
    <a href="https://twitter.com/MomentosTBEstar">
    <img width="34px" src="img/Twitter.png">
    </a>
    <a href="https://www.youtube.com/@momentosterapeuticosebem-e116">
    <img width="34px" src="img/Youtube.png">
    </a>
</div>
</main>

<!-- Estrutura de Footer -->
<?php include_once ("footer.php"); ?>
</div>

<!-- Conexão ao java script ao SlideShow -->
<script src="js/video.js"></script>

</body>
</html>