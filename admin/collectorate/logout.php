<?php
    require '../../config/function.php';
    if(isset($_SESSION['admin-authenticated']))
    {
        unset($_SESSION['admin-authenticated']);
        unset($_SESSION['auth_admin']);
        redirect('../../index.php');
    }
?>