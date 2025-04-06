<?php
if(isset($_SESSION['user-authenticated']))
{
    $email = validate($_SESSION['auth_user']['email']);
    $query = "select * from user_details where email = '$email' limit 1";
    $result = mysqli_query($conn,$query);

        if(mysqli_num_rows($result)==0)
        {
            unset($_SESSION['user-authenticated']);
            unset($_SESSION['auth_user']);
        }
        else
        {
            $row = mysqli_fetch_assoc($result);
            if($row["verify_status"]=='0')
            {
                unset($_SESSION['user-authenticated']);
                unset($_SESSION['auth_user']);
                redirect('../login-user.php','Your account is not verified. Please verify to proceed.');
            }

        }
}
else{
    redirect('../login-user.php','Please login to continue.');
}
?>