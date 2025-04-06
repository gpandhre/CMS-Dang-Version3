<?php
if(isset($_SESSION['compOfficer-authenticated']))
{
    $email = validate($_SESSION['auth_compOfficer']['email']);
    $query = "select * from admin_details where email = '$email' limit 1";
    $result = mysqli_query($conn,$query);

        if(mysqli_num_rows($result)==0)
        {
            unset($_SESSION['compOfficer-authenticated']);
            unset($_SESSION['auth_compOfficer']);
        }
        else
        {
            $row = mysqli_fetch_assoc($result);
            if($row["verify_status"]=='0')
            {
                unset($_SESSION['compOfficer-authenticated']);
                unset($_SESSION['auth_compOfficer']);
                redirect('../../login.php','Your account is not verified. Please verify to proceed.');
            }

        }
}
else{
    redirect('../../login','Please login to continue.');
}
?>