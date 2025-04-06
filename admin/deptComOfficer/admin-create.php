<?php include 'includes/header.php'; ?>
<div class="add-admin">
    <div class="head">
        <h1>Create Department Admin / Staff</h1>
        <a href="admin-staff.php">
            <button>Back</button>
        </a>
    </div>
   <div class="form-container">
    <?php alertMessage();?>
   <form action="code.php" method="POST">
         <?php
          if(isset($_SESSION['auth_head']))
          {
            $id = $_SESSION['auth_head'];
            $dept = getByRefID('department','admin_details', $id['dept_id']);
            if($dept)
            {
              if($dept['status']==200)
              {
                $deptData = $dept['data'];
                foreach($deptData as $deptItem);
                 ?>
                  <div class="field">
                    <input type="text" placeholder="Department Name" required name="dept-name" value="<?=$deptItem['dept_name']?>">
                  </div>
                  <div class="field">
                    <input type="text" placeholder="Admin / Staff Name" required name="staff-name">
                  </div>
                  <div class="field">
                    <input type="text" placeholder="Designation" required name="desig">
                  </div>
                  <div class="field">
                    <input type="text" placeholder="Email" required name="email">
                  </div>
                  <div class="field">
                    <input type="text" placeholder="Contact" required name="contact">
                  </div>
                  <div class="field">
                    <input type="text" placeholder="Password" required name="password">
                  </div>
                  <div class="field">
                    <input type="text" placeholder="Confirm Password" required name="cpassword">
                  </div>
                  <div class="field btn">
                    <input type="submit" value="Add" name="admin-save-btn">
                  </div>
          
                 <?php
                }
            }
          }
         ?>
          
    </form>
   </div>
</div>
<?php include 'includes/footer.php';?>