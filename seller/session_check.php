<?php 
  

    session_start();

    if(!empty($_SESSION['seller']))
    {
        $user = $_SESSION['seller'];
    }
    else
    {
      header('Location: logout.php');

    }


?>
