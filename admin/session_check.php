<?php 
  

    session_start();

    if(!empty($_SESSION['admin']))
    {
        $user = $_SESSION['admin'];
    }
    else
    {
      header('Location: logout.php');

    }


?>
