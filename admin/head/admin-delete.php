<?php
require '../../config/function.php';

 if(isset($_GET['id']))
 {
    $adminId = validate($_GET['id']);
    $dept = getById('admin_details',$adminId);
    if($dept['status']==200)
    {
        $headDelete = deleteRowsAdmin('admin_details',$adminId);
        if($headDelete)
        {
            redirect('admin-staff.php','Admin / Staff Deleted Successfully.');
        }
        else
        {
            redirect('admin-staff.php','Something went wrong!');
             
        }
    }
    else
    {
        redirect('admin-staff.php',$dept['status']);
    }
 }
 else
 {
    redirect('admin-staff.php','Something went wrong!');
 }
?>