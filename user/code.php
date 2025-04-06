<?php
    include "../config/function.php";

require_once '../vendor/autoload.php';


function sendEmail_verify($email, $verify_token)
{

// Create the Transport
$transport = (new Swift_SmtpTransport('smtp.gmail.com',587,'tls'))
  ->setUsername('gpandhre97@gmail.com')
  ->setPassword('csiq rqnk nrkl tjdl')
;

// Create the Mailer using your created Transport
$mailer = new Swift_Mailer($transport);
$email_template = "
            <h2>You have registered with Complaint Management System - Dangs</h2>
            <h5>Verify your email address to login with the below given link</h5>
            <br/><br/>
            <a href = 'http://localhost/cms-dang-version3/verify-user-email.php?token=$verify_token'>Click Here </a> ";

$message = (new Swift_Message())
->setSubject('Email Verification from CMS')
->setFrom(['gpandhre97@gmail.com'=>'CMS-DANG'])
->setTo([$email, 'other@domain.org' => 'A name'])
->setBody($email_template,'text/html')
  ;

// Send the message
$result = $mailer->send($message);

if($result)
{
    redirect($_SERVER['HTTP_REFERER'],'Registration Succesfull. Please login to continue.');
}
else
{
    redirect($_SERVER['HTTP_REFERER'],'Something went wrong.');

}
}

// Add admin code.......

    if(isset($_POST['user-signup-btn']))
    {
        $name = validate($_POST['name']);
        $email = validate($_POST['email']);
        $contact = validate($_POST['contact']);
        $password = validate($_POST['password']);
        $cpassword = validate($_POST['password']);
        $verify_token = md5(rand());

        if($name != '' && $email != '' && $contact != '' && $password != '' && $cpassword != '')
        {
            $check_email_result = mysqli_query($conn,"select email from user_details where email = '$email' limit 1");
            if(mysqli_num_rows($check_email_result)>0)
            {
                redirect('../signup.php','Email already exist!');
            }
            $data =[
                'name'=>$name,
                'email'=>$email,
                'contact'=>$contact,
                'password'=>$password,
                'verify_token'=>$verify_token
            ];
            $result = insert('user_details',$data);
            if($result)
            {
                sendEmail_verify($email, $verify_token);
                redirect('../login-user.php','Registered successfully. Verify your email.');
            }
            else
            {
                redirect('../signup.php','Something went wrong!');
            }
        }
        else
        {
            redirect('../signup.php','All the fields are mandatory!');
        }
    }

//Filing Complaint....

if(isset($_SESSION['auth_user']))
{
    if(isset($_POST['com-file-btn']))
{
    $id = $_SESSION['auth_user']['userid'];
    $user_name = $_SESSION['auth_user']['username'];
    $userID = validate($id);
    $category = validate($_POST['category']);
    $subCategory = validate($_POST['sub-category']);
    $address = validate($_POST['address']);
    $city = validate($_POST['city']);
    $subject = validate($_POST['subject']);
    $description = validate($_POST['complaint-desc']);
    $image_path = "";


    if( $category != '' && $subCategory != '' && $address != '' && $city != '' && $subject != '' && $description != '')
    {
        if(isset($_FILES['compFile']) && $_FILES['compFile']['error'] == 0)
        {
            $target_dir = "../uploads/";
            $image_path = $target_dir . basename($_FILES["compFile"]["name"]);
            move_uploaded_file($_FILES["compFile"]["tmp_name"], $image_path);
        }
        $data =[
            'user_id'=>$userID,
            'user_name'=>$user_name,
            'cType'=>$category,
            'sub_category'=>$subCategory,
            'address'=>$address,
            'city'=>$city,
            'subject'=>$subject,
            'description'=>$description,
            'files'=>$image_path
        ];
        
        $result = insert('complaints',$data);
        if($result)
        {   
            $last_id = $conn->insert_id;
            $fetchDeptName = mysqli_query($conn,"select cType from complaints where id = $last_id");
            if(mysqli_num_rows($fetchDeptName)>0)
            {
                $deptName = mysqli_fetch_assoc($fetchDeptName);

                $fetchDeptId = mysqli_query($conn,"select dept_id from department where dept_name = '$deptName[cType]'");
                if(mysqli_num_rows($fetchDeptId)>0)
                {
                    $deptId = mysqli_fetch_assoc($fetchDeptId);
                    $updateDeptId = mysqli_query($conn,"update complaints set dept_id = $deptId[dept_id] where id = $last_id");
                    if($updateDeptId)
                    {
                      redirect('all-complaints.php','Complaint Filed successfully.');
                    }
                }
            }

            
           
        }
        else
        {
            redirect('file-complaint.php','Something went wrong!');
        }
    }
    else
    {
        redirect('file-complaint.php','All the fields are mandatory!');
    }

}

}


// Complaint Edit

if(isset($_SESSION['auth_user']))
{
    if(isset($_POST['com-edit-btn']))
{
    $cId = validate($_POST['c_id']);
    $category = validate($_POST['category']);
    $subCategory = validate($_POST['sub-category']);
    $address = validate($_POST['address']);
    $city = validate($_POST['city']);
    $subject = validate($_POST['subject']);
    $description = validate($_POST['complaint-desc']);
 


    if( $category != '' && $subCategory != '' && $address != '' && $city != '' && $subject != '' && $description != '')
    {
        
        $data =[
            
            'cType'=>$category,
            'sub_category'=>$subCategory,
            'address'=>$address,
            'city'=>$city,
            'subject'=>$subject,
            'description'=>$description
            
        ];
        
        $result = update('complaints',$cId,$data);
        if($result)
        {   

            $last_id = mysqli_query($conn,"SELECT id FROM complaints ORDER BY updated_at DESC LIMIT 1");
            if(mysqli_num_rows($last_id)>0)
            {
                $lastDeptId = mysqli_fetch_assoc($last_id);
                $fetchDeptName = mysqli_query($conn,"select cType from complaints where id = $lastDeptId[id]");
                if(mysqli_num_rows($fetchDeptName)>0)
                {
                    $deptName = mysqli_fetch_assoc($fetchDeptName);
    
                    $fetchDeptId = mysqli_query($conn,"select dept_id from department where dept_name = '$deptName[cType]'");
                    if(mysqli_num_rows($fetchDeptId)>0)
                    {
                        $deptId = mysqli_fetch_assoc($fetchDeptId);
                        $updateDeptId = mysqli_query($conn,"update complaints set dept_id = $deptId[dept_id] where id = $lastDeptId[id]");
                        if($updateDeptId)
                        {
                            redirect('all-complaints.php?id='.$cId,'Complaint Updated successfully.');
                        }
                    }
                } 

            }
           
        }
    }
    }
    else
    {
        redirect('edit-complaint.php?id='.$cId,'Something went wrong!');
    }
    }
else
{
    redirect('edit-complaint.php?id='.$cId,'All the fields are mandatory!');
}




?>