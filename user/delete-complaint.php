<?php include "../config/function.php";

    if($_GET['id'])
    {
        $complaintId = validate($_GET['id']);
        $deleteComplaint = mysqli_query($conn,"delete from complaints where id = '$complaintId'");
        if($deleteComplaint)
        {
            redirect('all-complaints.php?id='.$complaintId,'Complaint Deleted Succesfully.');
        }
        else
        {
            redirect('all-complaints.php?id='.$complaintId,'Something Went Wrong!');
        }
    }
    else
    {
        redirect('all-complaints.php?id='.$complaintId,'Something Went Wrong!');
    }

?>