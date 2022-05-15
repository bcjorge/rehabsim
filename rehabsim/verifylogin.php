<?php
if(isset($_SESSION['authuser'])&& $_SESSION['authuser']==1){
    echo 'Welcome'.$_SESSION['username'];
}
else{
    echo'login incorreto. Pass/user incorretos';
    include('login.php');
}
?>
