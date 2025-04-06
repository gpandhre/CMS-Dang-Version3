<?php
    require '../../config/function.php';
    if(isset($_SESSION['routeOfficer-authenticated']))
    {
        unset($_SESSION['routeOfficer-authenticated']);
        unset($_SESSION['auth_routeOfficer']);
        redirect('../../index.php');
    }
?>