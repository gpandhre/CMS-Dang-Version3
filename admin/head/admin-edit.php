<?php include 'includes/header.php'; ?>
<div class="add-admin">
    <div class="head">
        <h1>EDIT ADMIN / STAFF</h1>
        <a href="admin-staff.php">
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
                    $adminId = $_GET['id'];

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

            $admin = getById('admin_details',$adminId);
            if($admin)
            {
                if($admin['status']==200)
                {   
                    $admindata = $admin['data'] ?? null;
                    ?>
                    <?php foreach ($admindata as $adminItem): ?> 
                    <input type="hidden" name="adminId" value="<?= $adminItem['id']?>">

                    <div class="field">
                        <input type="text" placeholder="Admin / Staff Name" required name="admin-name" value="<?=$adminItem['name'] ?>">
                    </div>
                    <div class="field">
                        <input type="text" placeholder="Designation" required name="desig" value="<?=$adminItem['desig'] ?>">
                    </div>
                    <div class="field">
                        <input type="text" placeholder="Email" required name="email" value="<?=$adminItem['email'] ?>">
                    </div>
                    <div class="field">
                        <input type="text" placeholder="Contact" required name="contact" value="<?=$adminItem['contact'] ?>">
                    </div>
                    <div class="field">
                        <input type="text" placeholder="Password" name="password">
                    </div>
                    <div class="field">
                        <input type="text" placeholder="Confirm Password" name="cpassword">
                    </div>
                    <div class="field btn">
                        <input type="submit" value="update" name="admin-edit-btn">
                    </div>
                    <?php
                    endforeach;
                }
                else
                {
                    echo '<h4>'.$admin['message'].'</h4>';
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