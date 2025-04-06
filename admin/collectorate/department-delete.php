<?php
require '../../config/function.php';

 if(isset($_GET['id']))
 {
    $deptId = validate($_GET['id']);
    $dept = getByRefID('department','admin_details',$deptId);
    if($dept['status']==200)
    {
        $headDelete = deleteRowsHead('admin_details',$deptId);
        if($headDelete)
        {
            $deptDelete = deleteRowsHead('department',$deptId);
            redirect('departments.php','Department Deleted Successfully.');
        }
        else
        {
            redirect('departments.php','Something went wrong!');
             
        }
    }
    else
    {
        redirect('departments.php',$dept['status']);
    }
 }
 else
 {
    redirect('departments.php','Something went wrong!');
 }
?>