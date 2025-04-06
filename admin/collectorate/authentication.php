<?php
if(isset($_SESSION['admin-authenticated']))
{
    $email = validate($_SESSION['auth_admin']['email']);
    $query = "select * from admin_details where email = '$email' limit 1";
    $result = mysqli_query($conn,$query);

        if(mysqli_num_rows($result)==0)
        {
            unset($_SESSION['admin-authenticated']);
            unset($_SESSION['auth_admin']);
        }
        else
        {
            $row = mysqli_fetch_assoc($result);
            if($row["verify_status"]=='0')
            {
                unset($_SESSION['admin-authenticated']);
                unset($_SESSION['auth_admin']);
                redirect('../login.php','Your account is not verified. Please verify to proceed.');
            }

        }
}
else{
    redirect('../../login.php','Please login to continue.');
}
?>