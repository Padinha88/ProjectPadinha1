<?php require "conexao.php" ?>

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
<div id="tudo">
<?php include_once ("menu.php"); ?>

<main>
    <div class="meio">
    <div class="criar">
    <h2>Crie sua conta</h2>
    <form action="criar_conta.php" method="post">

    <div class="form-group">
            <div class="caixacriar">
            <input type="text" name="username" autocomplete="off" required>
                <label for="">Username</label>
            </div>
        </div>

        <div class="form-group">
            <div class="caixacriar">
            <input type="password" name="password1" required>
                <label for="">Senha</label>
            
            </div>

            <div class="caixacriar">
            <input type="password" name="password2" required>
                <label for=""> Confirme Senha</label>     
            </div>
        </div>

        <div class="form-group">
            <div class="caixacriar">
            <input type="text" name="nome" autocomplete="off" required>
                <label for="">Nome</label>
            </div>

            <div class="caixacriar">
            <input type="text" name="apelido" autocomplete="off" required>
                <label for="">Apelido</label>
            </div>
        </div>

        <div class="form-group">
            <div class="caixacriar">
            <input type="text" name="morada" autocomplete="off" required>
                <label for="">Morada</label>
            </div>

            <div class="caixacriar">
            <input type="text" name="cp" autocomplete="off" required>
                <label for="">Código Postal</label>
            </div>
        </div>

        <div class="form-group">
            <div class="caixacriar">
            <input id="number" type="tel" name="telemovel" required>
                <label for="number">Telemovel</label>
            
            </div>

            <div class="caixacriar">
            <input id="number" type="email" name="email" required>
                <label for="number">E-mail</label>
            </div>
        </div>


        <input type="submit" name="botaoregisto" value="Submeter">
    </form>
</div>
        
</div>
</main>
  
 <?php include_once ("footer2.php"); ?>
</div> 
</body>
</html>