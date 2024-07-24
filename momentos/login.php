<!-- Verifica se as credenciais de login estão corretas, se sim, inicia a sessão do usuário.
Se não, redireciona para a página de registro se o nome de usuário não existir. -->

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

<!-- Barra de Menu -->
<?php include_once ("menu.php"); ?>

<main>
    <div class="meio">

    <div class="login">
            <h2>Login</h2>
            <form action="login.php"  method="post">
            <div class="caixalogin">
                <input type="text" name="utilizador"  autocomplete="off" autofocus="" required 
                    <?php 
                        if ($foisubmetido)
                            echo 'value='.$utilizador;
                    ?>
                >
                <label for="">Username</label>
            </div>

            <div class="caixalogin">
                <input type="password" name="password" required>
                <label for="">Senha</label>
            </div>
            <div class="conta">
            <p>Ainda não tem uma conta? <a href="criar_conta.php?b=1">Criar conta</a></p>
            </div>
            <input type="submit" value="Submeter" name="fazerlogin">
            </div>
        </form>
    </div>

    <?php include_once ("footer2.php"); ?>
</div>
</main>


</div> 
</body>
</html>