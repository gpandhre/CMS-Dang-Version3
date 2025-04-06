<?php include "includes/header.php" ?>

<div class="edit-complaint">
    <div class="head">
        <h1>EDIT COMPLAINT</h1>
        <a href="dashboard.php">
            <button>Back</button>
        </a>
    </div>

    <?php
        if($_GET['id'])
        {
            $complaintId = validate($_GET['id']);
            $complaintData=mysqli_query($conn,"select * from complaints where id = $complaintId");
        
        if(mysqli_num_rows($complaintData)>0)
        {
            $complaint=[];
            $data = mysqli_fetch_assoc($complaintData);
            $complaint[]=$data;
    ?>
    <?php 
    foreach ($complaint as $complaintData):?>
    <div class="form-container">
    <?php alertMessage();?>
  <form action="code.php" method="POST" enctype="multipart/form-data">
          <?php
              $dept = getAll('department');
              if($dept)
          ?>
          <input type="text" value="<?=$complaintData['id']?>" hidden name="c_id">
          <div class="field">
            <select name="category" required="">
            <option value="<?="$complaintData[cType]"?>"><?="$complaintData[cType]"?></option>
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
                <option value="<?="$complaintData[sub_category]"?>"><?="$complaintData[sub_category]"?></option>
                <?php foreach($subcat as $subCatData):?>
                  <option value="<?="$subCatData[sub_category_name]"?>"><?="$subCatData[sub_category_name]"?></option>
                <?php endforeach;?>
            </select>
          </div>
          <div class="field" style="display:flex; gap: 1rem;">
            <input type="text" placeholder="Address" required name="address" value="<?=$complaintData['address']?>">
          </div>
          
          <div class="field" style="display:flex; gap: 1rem;">
            <input type="text" placeholder="City" required name="city" value="<?=$complaintData['city']?>">
          </div>
          
          <div class="field" style="display:flex; gap: 1rem;">
            <input type="text" placeholder="Subject" required name="subject" value="<?=$complaintData['subject']?>">
          </div>
          <div class="field" style="display:flex; gap: 1rem;">
          <textarea name="complaint-desc" required="required" cols="10" rows="10" maxlength="2000"><?=$complaintData['description']?></textarea>
          </div>
          
          <div class="field btn">
            <input type="submit" value="Update" name="com-edit-btn">
          </div>
          
  </form>
   </div>    
    <?php
    endforeach;
        }
        }
    ?>
    
</div>

<?php include "includes/footer.php" ?>
