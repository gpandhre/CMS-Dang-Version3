<?php include 'includes/header.php'; ?>
<div class="add-admin">
    <div class="head">
        <h1>Create Department</h1>
        <a href="departments.php">
            <button>Back</button>
        </a>
    </div>
   <div class="form-container">
    <?php alertMessage();?>
   <form action="code.php" method="POST">
          <div class="field">
            <input type="text" placeholder="Department Name" required name="name">
          </div>
          <div class="field">
            <input type="text" placeholder="Department Head" required name="head">
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
            <input type="submit" value="Add" name="dept-save-btn">
          </div>
          
        </form>
   </div>
</div>
<?php include 'includes/footer.php';?>