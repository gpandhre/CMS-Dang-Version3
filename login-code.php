<?php
include 'config/function.php';

if(isset($_POST['admin-login-btn']))
{
    $email = validate($_POST['email']);
    $password = validate($_POST['password']);

    if($email != '' && $password != '')
    {
        $queryCollector = "select * from admin_details where email = '$email' and password = '$password' and desig = 'Collector' limit 1";
        $resultCollector = mysqli_query($conn,$queryCollector);
        $queryHead = "select * from admin_details where email = '$email' and password = '$password' and desig = 'Head' limit 1";
        $resultHead = mysqli_query($conn,$queryHead);
        $queryCompOfficer = "select * from admin_details where email = '$email' and password = '$password' and desig = 'Complaint Officer' limit 1";
        $resultCompOfficer = mysqli_query($conn,$queryCompOfficer);
        $queryRouteOfficer = "select * from admin_details where email = '$email' and password = '$password' and desig = 'Routing Officer' limit 1";
        $resultRouteOfficer = mysqli_query($conn,$queryRouteOfficer);
        if($resultCollector)
        {
            if(mysqli_num_rows($resultCollector)==1)
            {
                $row = mysqli_fetch_assoc($resultCollector);
                if($row["verify_status"]=='1')
                {
                    $_SESSION["admin-authenticated"] = true;
                    $_SESSION["auth_admin"] =
                    [
                        "admin_id" => $row["id"],
                        "username"=> $row["name"],
                        "phone"=> $row["contact"],
                        "email"=> $row["email"],
                    ];

                    redirect('admin/collectorate/index.php');
                }
                else
                {
                    $_SESSION['status'] = 'Please verify your email address.';
                    header("Location:login.php");
                    exit(0);
                }
            }
            else if($resultHead)
            {
                if(mysqli_num_rows($resultHead)==1)
                {
                    $row = mysqli_fetch_assoc($resultHead);
                    if($row["verify_status"]=='1')
                    {
                        $_SESSION["head-authenticated"] = true;
                        $_SESSION["auth_head"] = 
                        [
                            "admin_id" => $row["id"],
                            "dept_id"=> $row['dept_id'],
                            "username"=> $row["name"],
                            "phone"=> $row["contact"],
                            "email"=> $row["email"],
                        ];
    
                        redirect('admin/head/index.php');
                    }
                    else
                    {
                        $_SESSION['status'] = 'Please verify your email address.';
                        header("Location:login.php");
                        exit(0);
                    }
                }

                else if($resultCompOfficer)
                {
                if(mysqli_num_rows($resultCompOfficer)==1)
                {
                    $row = mysqli_fetch_assoc($resultCompOfficer);
                    if($row["verify_status"]=='1')
                    {
                        $_SESSION["compOfficer-authenticated"] = true;
                        $_SESSION["auth_compOfficer"] = 
                        [
                            "admin_id" => $row["id"],
                            "dept_id"=> $row['dept_id'],
                            "username"=> $row["name"],
                            "phone"=> $row["contact"],
                            "email"=> $row["email"],
                        ];
    
                        redirect('admin/deptComOfficer/index.php');
                    }
                    else
                    {
                        $_SESSION['status'] = 'Please verify your email address.';
                        header("Location:login.php");
                        exit(0);
                    }
                }
                else if($resultRouteOfficer)
                {
                if(mysqli_num_rows($resultRouteOfficer)==1)
                {
                    $row = mysqli_fetch_assoc($resultRouteOfficer);
                    if($row["verify_status"]=='1')
                    {
                        $_SESSION["routeOfficer-authenticated"] = true;
                        $_SESSION["auth_routeOfficer"] = 
                        [
                            "admin_id" => $row["id"],
                            "dept_id"=> $row['dept_id'],
                            "username"=> $row["name"],
                            "phone"=> $row["contact"],
                            "email"=> $row["email"],
                        ];
    
                        redirect('admin/routingOfficer/index.php');
                    }
                    else
                    {
                        $_SESSION['status'] = 'Please verify your email address.';
                        header("Location:login.php");
                        exit(0);
                    }
                }

               
                }

               
                }
               
            }
            
            else
            {
                redirect('login.php','Invalid credentials!');
            }
        }
       
        else
        {
            redirect('login.php','Somethin went wrong!');
        }
    }
    else
    {
        redirect('login.php','All fields are mandatory');
    }

}
if(isset($_POST['user-login-btn']))
{
    $email = validate($_POST['email']);
    $password = validate($_POST['password']);

    if($email != '' && $password != '')
    {
        $query = "select * from user_details where email = '$email' and password = '$password' limit 1";
        $result = mysqli_query($conn,$query);
        if($result)
        {
            if(mysqli_num_rows($result)==1)
            {
                $row = mysqli_fetch_assoc($result);
                if($row["verify_status"]=='1')
                {
                    $_SESSION["user-authenticated"] = true;
                    $_SESSION["auth_user"] = 
                    [
                        "userid"=> $row['user_id'],
                        "username"=> $row["name"],
                        "phone"=> $row["contact"],
                        "email"=> $row["email"],
                    ];

                    redirect('user/dashboard.php');
                }
                else
                {
                    $_SESSION['status'] = 'Please verify your email address.';
                    header("Location:login.php");
                    exit(0);
                }
            }
            else
            {
                redirect('login-user.php','Invalid credentials!');
            }
        }
        else
        {
            redirect('login-user.php','Somethin went wrong!');
        }
    }
    else
    {
        redirect('login-user.php','All fields are mandatory');
    }

}

?>