<?php
    include "../../config/function.php";



//Add Departments and Department Head...



if(isset($_POST['dept-save-btn']))
{
    $name = validate($_POST['name']);
    $head = validate($_POST['head']);
    $email = validate($_POST['email']);
    $contact = validate($_POST['contact']);
    $password = validate($_POST['password']);
    $cpassword = validate($_POST['cpassword']);
    $verify_token = md5(rand());

    if($name != '' && $head != '' && $email != '' && $contact != '' && $password != '')
    {
        $check_dept_result = mysqli_query($conn,"select dept_name from department where dept_name = '$name' limit 1");
        if(mysqli_num_rows($check_dept_result)>0)
        {
            redirect('department-create.php','Department already exist!');
        }
        $data =[
            'dept_name'=>$name
        ];
        $result = insert('department',$data);
        $check_email_result = mysqli_query($conn,"select email from admin_details where email = '$email' limit 1");
        if(mysqli_num_rows($check_email_result)>0)
        {
            redirect('department-create.php','Email already exist!');
        }
        $deptid = mysqli_query($conn,"select dept_id from department where dept_name = '$name' limit 1"); 
        if($deptid)
        {
        foreach($deptid as $deptIDItem)
        {
            $dept_id = $deptIDItem['dept_id'];
        }
        $data =[
            'dept_id'=>$dept_id,
            'desig'=>'Head',
            'name'=>$head,
            'email'=>$email,
            'contact'=>$contact,
            'password'=>$password,
            'verify_token'=>$verify_token
        ];
        $result = insert('admin_details',$data);
        if($result)
        {
            redirect('departments.php','Admin Created Successfully');
        }
        else
        {
            redirect('department-create.php','Something went wrong!');
        }
    }
    }
    else
    {
        redirect('department-create.php','All the fields are mandatory!');
    }
}


//Department and Department Head Edit
if(isset($_POST['dept-edit-btn']))
    {   
        $deptId =validate($_POST['deptId']);
        $adminId =validate($_POST['adminId']);

        
            $dept = getById('admin_details',$adminId);
            if($dept['status']!=200)
            {
                redirect('department-edit.php?id='.$deptId,'All the fields are mandatory!');
            }
            $deptName = validate($_POST['name']);
            $headName = validate($_POST['head']);
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
                    redirect('department-create.php','Email is already in use');
                }
            }
            
            if($password=='')
            {
                if($dept)
                {
                    if($dept['status']==200)
                {   
                    $deptData = $dept['data'] ?? null;
                    foreach($deptData as $deptItem)
                    {
                        $password = $deptItem['password'];
                    }
                }
            }
            }
            else
            {
                $password = validate($_POST['password']);
            }

            if($deptName !='' && $headName !='' && $email != '')
            {
                $data =[
                    'dept_name'=>$deptName,
                    'name'=>$headName,
                    'email'=>$email,
                    'contact'=>$contact,
                    'password'=>$password,
                ];
                $result = updateRef('department','admin_details',$deptId,$data);
                if($result)
                {
                    redirect('departments.php?id='.$deptId,'Admin Updated Successfully');
                }
                else
                {
                    redirect('department-edit.php?id='.$deptId,'Something went wrong!');
                }
            }
            else
            {
                redirect('department-edit.php','All fields are mandatory!');
                
            }

            }

?>