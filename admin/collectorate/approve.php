<?php
    include "../../config/function.php";

    if(isset($_GET['id']))
    {
        if($_GET['id']!='')
        {
            $complaintId = $_GET['id'];
            $data =[
                'collector'=>'1',
                'approved'=>'1'
            ];
            $result = update('complaints',$complaintId,$data);
            if($result)
            {
                redirect('newCom.php?id='.$complaintId,'Approved Successfully');
            }
            else
            {
                redirect('view-complaints.php?id='.$complaintId,'Something went wrong!');
            }

        }
        else
        {
            echo'<h4>No Id Found!</h4>';
            return false;
        }
    }
    else
    {
        echo'<h4>Something went wrong!</h4>';
        return false;
    }
?>