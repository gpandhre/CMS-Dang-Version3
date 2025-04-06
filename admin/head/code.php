<?php
    include "../../config/function.php";



//Add Departments and Department Head...



if(isset($_POST['admin-save-btn']))
{
    $deptName = validate($_POST['dept-name']);
    $staffName = validate($_POST['staff-name']);
    $desig = validate($_POST['desig']);
    $email = validate($_POST['email']);
    $contact = validate($_POST['contact']);
    $password = validate($_POST['password']);
    $cpassword = validate($_POST['cpassword']);
    $verify_token = md5(rand());

    if($deptName != '' && $staffName != '' && $desig != '' && $email != '' && $contact != '' && $password != '')
    {
    
        $check_email_result = mysqli_query($conn,"select email from admin_details where email = '$email' limit 1");
        if(mysqli_num_rows($check_email_result)>0)
        {
            redirect('admin-create.php','Email already exist!');
        }
        $deptid = mysqli_query($conn,"select dept_id from department where dept_name = '$deptName' limit 1"); 
        if($deptid)
        {
        foreach($deptid as $deptIDItem)
        {
            $dept_id = $deptIDItem['dept_id'];
        }
        $data =[
            'dept_id'=>$dept_id,
            'desig'=>$desig,
            'name'=>$staffName,
            'email'=>$email,
            'contact'=>$contact,
            'password'=>$password,
            'verify_token'=>$verify_token
        ];
        $result = insert('admin_details',$data);
        if($result)
        {
            redirect('admin-staff.php','Admin Created Successfully');
        }
        else
        {
            redirect('admin-create.php','Something went wrong!');
        }
    }
    }
    else
    {
        redirect('admin-create.php','All the fields are mandatory!');
    }
}


//Department and Department Head Edit
if(isset($_POST['admin-edit-btn']))
    {   
        $adminId =validate($_POST['adminId']);

        
            $admin = getById('admin_details',$adminId);
            if($admin['status']!=200)
            {
                redirect('admin-edit.php?id='.$adminId,'All the fields are mandatory!');
            }
            $adminName = validate($_POST['admin-name']);
            $adminDesig = validate($_POST['desig']);
            $email = validate($_POST['email']);
            $contact = validate($_POST['contact']);
            $password = validate($_POST['password']);
            $cpassword = validate($_POST['cpassword']);

            $emailCheck = "select email from admin_details where email = '$email' and id != '$adminId'";
            $checkEmailResult = mysqli_query($conn,$emailCheck);
            if($checkEmailResult)
            {
                if(mysqli_num_rows($checkEmailResult)>0)
                {
                    redirect('admin-create.php','Email is already in use');
                }
            }
            
            if($password=='')
            {
                if($dept)
                {
                    if($dept['status']==200)
                {   
                    $adminData = $admin['data'] ?? null;
                    foreach($adminData as $adminItem)
                    {
                        $password = $adminItem['password'];
                    }
                }
            }
            }
            else
            {
                $password = validate($_POST['password']);
            }

            if($adminName !='' && $adminDesig !='' && $email != '')
            {
                $data =[
                    'name'=>$adminName,
                    'desig'=>$adminDesig,
                    'email'=>$email,
                    'contact'=>$contact,
                    'password'=>$password,
                ];
                $result = update('admin_details',$adminId,$data);
                if($result)
                {
                    redirect('admin-staff.php?id='.$adminId,'Admin Updated Successfully');
                }
                else
                {
                    redirect('admin-edit.php?id='.$adminId,'Something went wrong!');
                }
            }
            else
            {
                redirect('admin-edit.php','All fields are mandatory!');
                
            }

            }

?>