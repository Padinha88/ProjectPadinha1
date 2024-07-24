<!--Aqui verifica se há um ID ( Número ou código único atribuído a cada item) de bicicleta na 
URL (Endereço de um recurso específico na web) e, se existir, mostra os detalhes dessa bicicleta.
Se não houver ID válido, redireciona para a página inicial. -->

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
    <link rel="stylesheet" href="css/bicicleta.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/Loja.css">
    <link rel="stylesheet" href="css/Loja2.css">
</head>
<body>
<!-- Imagem de fundo -->
<div id="tudo_loja">

<!-- Barra de Menu -->
<?php include_once ("menu.php"); ?>
<!-- Estrutura Principal -->

<main>
    <div class="meio">
     <div class="container">
      <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-6 col-xs-12">

<!-- Exibe uma lista de bicicletas a partir de um banco de dados,
com opções para adicionar cada bicicleta ao carrinho. -->
          <?php
            $k=0;
            $sql = "SELECT id_tipo_bic,imagem,modelo,preco_dia FROM tipos_bicicletas";
            $res_bic = mysqli_query($conexao, $sql);
            $num_tipos_bic = mysqli_num_rows($res_bic);
		      ?>

          <?php
    				if ($num_tipos_bic>0) {

    					while ($bicic = mysqli_fetch_assoc($res_bic)) {
                $k++;
    						$bic_id=$bicic["id_tipo_bic"];
    						$bic_model=$bicic["modelo"];
    						$bic_img=$bicic["imagem"];
    						$bic_preco =$bicic["preco_dia"];
						?>

          <?php 
            if($k % 2 != 0){ 
              echo'<div class="row">';
            }
            else{
            }

            if($k==1) {
              echo'<div class="col-sm-6 col-md-6 col-lg-6 col-xs-6">';
            }
            else if ($k==2) {
              echo'<div class="col-sm-12 col-md-12 col-lg-6 col-xs-12">';
            }
            else {
              echo'<div class="col-sm-12 col-md-12 col-lg-6 col-xs-12">';
            }
          ?>
              <div class="shadow-sm card mb-3 product">
                <img class="product-img" src="img/<?php echo $bic_img;?>" width="200" height="90" alt="prd1" onmouseover="animateImg(this)"
                onmouseout="normalImg(this)"/>
                <div class="card-body">
                  <h5 class="card-title text-white bold product-name"><?php echo $bic_model;?></h5>
                  <p class="card-text text-white product-price"><?php echo $bic_preco;?> €</p>
                  <button class="btn badge badge-success badge-secondary mt-2 float-center" type="button"
                    data-action="add-to-cart">ADICIONAR</button>
                </div>
              </div>
            </div>
          <?php 
            if($k % 2 == 0 && ($num_tipos_bic>$k)){ 
              echo'</div>';
            }

          } // fecha o while

        } // fecha o if

          ?>

<!-- Representa um formulário que permite ao utilizador selecionar datas de levantamento e devolução,
 escrever detalhes adicionais evisualizar o número de dias de aluguer. -->
              <div class="cart_fora">
                <div class="cart">
                  <div class="campo">
                    <div class="input-box1">
                      <label for="email" style="color: white;">LEVANTAR</label>
                      <div class="input-box_1">
                      <input type="date" id="txtDate1" name="date1" required onchange="data_alterada(event,1);">
                      </div>
                    </div>
                    <div class="input-box2">
                      <label for="number" style="color: white;">DEVOLVER</label>
                      <div class="input-box_2">
                      <input type="date" id="txtDate2" name="date2" required onchange="data_alterada(event,0);">
                      </div>
                    </div>
                    <div class="mensagem">
                    <br>
                  <textarea id="mensagem" rows="5" placeholder="Escreva aqui alguns detalhes da sua pré-reserva." name="detalhes_res"></textarea>
                  <div id="dias_alug">
                    <h5 id="dias_a">
                      
                    </h5>
                  </div>
                </div>
              </div>    
            </div>
          </div>
        </div>
      </main>


<!-- Verifica se as credenciais de login estão corretas, se sim, inicia a sessão do usuário.
Se não, redireciona para a página de registro se o nome de usuário não existir. -->
<?php
$foisubmetido=FALSE;

if(isset($_POST['fazerlogin'])) {
    $foisubmetido=TRUE;
    $utilizador = $_POST['utilizador'];
    $password = md5($_POST['password']);

    if( ($utilizador != '') && ($password != '') ) {
        
        $sql = "SELECT id_user FROM utilizadores WHERE username = '$utilizador' AND senha = '$password' limit 1";


        $result = mysqli_query($conexao, $sql);
        if(mysqli_num_rows($result) > 0) {
          $res1 = mysqli_fetch_assoc($result);
          $iduser=$res1['id_user'];
          
          session_start();
          $_SESSION['iduser'] = $iduser;
          $_SESSION['username'] = $utilizador;
    
          header("Location: index.php");
          exit();
        }
        else {
          $sql2 = "SELECT id_user FROM utilizadores WHERE username = '$utilizador' limit 1";
          $result2 = mysqli_query($conexao, $sql2);
          if(mysqli_num_rows($result2) == 0) {
      
            header("Location: criar_conta.php");
            exit();
          }
        }
      }
    }
?>  

<!--<div class="cx_variaveis">
<?php 
    echo 'utilizador = '.$utilizador;
    echo '<br>';
    echo 'senha = '.$password;
    echo '<br>';
?>
</div> -->

<!-- Conexão ao java script do loja2 -->
<script src="js/loja2.js"></script>

</div>
</body>
</html>