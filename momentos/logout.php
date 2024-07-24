<?php
// Iniciar a sessão.
// Se estiver a utilizar session_name("algo"), não se esqueça agora!
session_start();

// Limpar todas as variáveis de sessão.
$_SESSION = array();

// Se desejar encerrar a sessão, também delete o cookie da sessão.
// Nota: Isso irá destruir a sessão, e não apenas os dados da sessão!
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Por fim, destruir a sessão.
session_destroy();

header("Location: index.php");
exit;
?>