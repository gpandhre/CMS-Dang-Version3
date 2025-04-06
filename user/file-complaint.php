<?php include 'includes/header.php';?>

<div class="file-complaint">
    <div class="head">
        <h1>File Complaint</h1>
        <a href="dashboard.php">
            <button>Back</button>
        </a>
    </div>
   <div class="form-container">
    <?php alertMessage();?>
  <form action="code.php" method="POST" enctype="multipart/form-data">
          <?php
              $dept = getAll('department');
              if($dept)
          ?>
         
          <div class="field">
            <select name="category" required="">
              <?php foreach($dept as $deptData):?>
                <option value="<?="$deptData[dept_name]"?>"><?="$deptData[dept_name]"?></option>
              <?php endforeach;?>
            </select>
          </div>
          <?php
              $subcat = getAll('sub_category');
              if($subcat)
          ?>
          <div class="field">
            <select name="sub-category" required="">
                <?php foreach($subcat as $subCatData):?>
                  <option value="<?="$subCatData[sub_category_name]"?>"><?="$subCatData[sub_category_name]"?></option>
                <?php endforeach;?>
            </select>
          </div>
          <div class="field" style="display:flex; gap: 1rem;">
            <input type="text" placeholder="Address" required name="address">
          </div>
          
          <div class="field" style="display:flex; gap: 1rem;">
            <input type="text" placeholder="City" required name="city">
          </div>
          
          <div class="field" style="display:flex; gap: 1rem;">
            <input type="text" placeholder="Subject" required name="subject">
          </div>
          <div class="field" style="display:flex; gap: 1rem;">
          <textarea name="complaint-desc" required="required" cols="10" rows="10" maxlength="2000"></textarea>
          </div>
          <div class="field" style="display:flex; gap: 1rem;">
            <input class="file" type="file" placeholder="Complaint Related Doc(if any)" name="compFile" accept="image/*" required>
          </div>
          <div class="field btn">
            <input type="submit" value="File" name="com-file-btn">
          </div>
          
  </form>
   </div>
</div>

<?php include 'includes/footer.php';?>