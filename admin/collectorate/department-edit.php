<?php include 'includes/header.php'; ?>
<div class="add-admin">
    <div class="head">
        <h1>EDIT DEPARTMENT</h1>
        <a href="departments.php">
            <button>Back</button>
        </a>
    </div>
   <div class="form-container">
    <?php alertMessage();?>
    <form action="code.php" method="POST">
        <?php
            if(isset($_GET['id']))
            {
                if($_GET['id']!='')
                {
                    $deptId = $_GET['id'];

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

            $dept = getByRefID('department','admin_details',$deptId);
            if($dept)
            {
                if($dept['status']==200)
                {   
                    $deptdata = $dept['data'] ?? null;
                    ?>
                    <?php foreach ($deptdata as $deptItem): ?> 
                    <input type="hidden" name="deptId" value="<?= $deptItem['dept_id']?>">
                    <input type="hidden" name="adminId" value="<?= $deptItem['id']?>">

                    <div class="field" style="display:flex; gap: 1rem;">
                        <input type="text" placeholder="Name" required name="name" value="<?= $deptItem['dept_name']?>">
                    </div>
                    <div class="field" style="display:flex; gap: 1rem;">
                        <input type="text" placeholder="Head" required name="head" value="<?= $deptItem['name']?>">
                    </div>
                    <div class="field" style="display:flex; gap: 1rem;">
                        <input type="text" placeholder="Email Address" required name="email" value="<?= $deptItem['email']?>">
                        <input type="text" placeholder="Contact Number" required name="contact" value="<?= $deptItem['contact']?>">
                    </div>   
                    
                    <div class="field" style="display:flex; gap: 1rem;">
                        <input type="password" placeholder="Password" name="password">
                        <input type="password" placeholder="Confirm Password" name="cpassword">
                    </div>
                    <div class="field btn">
                        <input type="submit" value="update" name="dept-edit-btn">
                    </div>
                    
   </div>
                    <?php
                    endforeach;
                }
                else
                {
                    echo '<h4>'.$dept['message'].'</h4>';
                }
            }
            else
            {
                echo 'Something went wrong!';
                return false;
            }
        ?>
         
          
        </form>
   </div>
</div>
<?php include 'includes/footer.php';?>