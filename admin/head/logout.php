<?php
    require '../../config/function.php';
    if(isset($_SESSION['head-authenticated']))
    {
        unset($_SESSION['head-authenticated']);
        unset($_SESSION['auth_head']);
        redirect('../../index.php');
    }
?>