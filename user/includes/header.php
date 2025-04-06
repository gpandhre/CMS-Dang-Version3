<?php 

include '../config/function.php';
include 'authentication.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complaint Mangement System - Dang/Dashboard</title>
    <link rel="stylesheet" href="assets/style.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet"/>
    <script type="text/javascript" src="assets/app.js" defer></script>
</head>
<body>
    <?php 
        include 'includes/topbar.php';
        include 'includes/topbar2.php';
    ?>
    <nav id="sidebar">
        <?php include 'includes/sidebar.php'; ?>
    </nav>
    <main id="main">
