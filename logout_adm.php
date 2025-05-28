<?php
    session_start();
    session_destroy();
    header('Location: tela_login_adm.php');
    exit();
?>
