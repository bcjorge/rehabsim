<?php
if(isset($_SESSION['authuser'])&& $_SESSION['authuser']==1){
    if(isset($_SESSION['tipo_utilizador'])&& $_SESSION['tipo_utilizador']==1){
        include('pag_admin.php');
    }
    else if (isset($_SESSION['tipo_utilizador'])&& $_SESSION['tipo_utilizador']==2){
        include('pag_terapeuta.php');
    }
    else if (isset($_SESSION['tipo_utilizador'])&& $_SESSION['tipo_utilizador']==3){
        include('pag_cuidador.php');
    }
    //echo 'Welcome'.$_SESSION['username'];
}
else{
    javascript:alert('Password ou Utilizador Incorretos');
    //echo'login incorreto. Password ou Utilizador Incorretos';
    include('login.php');
}
?>
