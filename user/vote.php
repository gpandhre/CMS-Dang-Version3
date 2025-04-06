<?php
require '../config/function.php';

if($_GET['c_id'] && $_GET['c_id']!='')
{
    $c_id = $_GET['c_id'];
    $updateVote = mysqli_query($conn,"update complaints set votes = votes+1 where id = $c_id");
    if($updateVote)
    {
        redirect('home.php');
    }
}
else
{
    redirect('home.php','Somthing Went Wrong!..');
}

?>