<?php
    require '../../config/function.php';
    if(isset($_SESSION['compOfficer-authenticated']))
    {
        unset($_SESSION['compOfficer-authenticated']);
        unset($_SESSION['auth_compOfficer']);
        redirect('../../index.php');
    }
?>