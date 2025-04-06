<?php
    include 'includes/header.php';

    if(isset($_GET['id']))
    {
        if($_GET['id']!='')
        {
            $complaintId = $_GET['id'];
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

<div class="file-complaint">
    <div class="head">
        <h1>Route Complaint</h1>
        <a href="view-complaints.php?id=<?=$complaintId?>">
            <button>Back</button>
        </a>
    </div>
   <div class="form-container">
    <?php alertMessage();?>
  <form action="code.php" method="POST" enctype="multipart/form-data">
          <?php
                 
                $complaint = getById('complaints',$complaintId);
                if($complaint)
                {
                    if($complaint['status']==200)
                    {
                        $complaintData = $complaint['data'] ?? null;
                    ?>
                    <?php foreach($complaintData as $complaintItem):?>
                        <input type="text" name="c_id" value="<?=$complaintItem['id']?>" hidden>
                        <input type="text" name="u_id" value="<?=$complaintItem['user_id']?>" hidden>

                        <div class="field">
                            <select name="category" required="">
                            <option value="<?="$complaintItem[cType]"?>"><?="$complaintItem[cType]"?></option>
                                <?php
                                    $dept = getAll('department');
                                    if($dept)
                                ?>
                            <?php foreach($dept as $deptData):?>
                            <option value="<?="$deptData[dept_name]"?>"><?="$deptData[dept_name]"?></option>
                            <?php endforeach; ?>                              
                            </select>
                        </div>
                        <?php
                            $subcat = getAll('sub_category');
                            if($subcat)
                        ?>
                        <div class="field">
                            <select name="sub-category" required="">
                                <option value="<?="$complaintItem[sub_category]"?>"><?="$complaintItem[sub_category]"?></option>
                                <?php foreach($subcat as $subCatData):?>
                                <option value="<?="$subCatData[sub_category_name]"?>"><?="$subCatData[sub_category_name]"?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                        <div class="field" style="display:flex; gap: 1rem;">
                            <input type="text" placeholder="Address" required name="address" readonly value="<?= $complaintItem['address'] ?>">
                        </div>
                        
                        <div class="field" style="display:flex; gap: 1rem;">
                            <input type="text" placeholder="City" required name="city" readonly value="<?= $complaintItem['city'] ?>">
                        </div>
                        
                        <div class="field" style="display:flex; gap: 1rem;">
                            <input type="text" placeholder="Subject" required name="subject" readonly value="<?= $complaintItem['subject'] ?>">
                        </div>
                        <div class="field" style="display:flex; gap: 1rem;">
                        <textarea name="complaint-desc" required="required" cols="10" rows="10" maxlength="2000" readonly ><?= $complaintItem['description'] ?></textarea>
                        </div>
                        <div class="field" style="display:flex; gap: 1rem;">
                            <input class="file" type="file" placeholder="Complaint Related Doc(if any)" name="compFile" hidden>
                        </div>
                        <div class="field btn">
                            <input type="submit" value="Route" name="com-route-btn">
                        </div>
                    <?php endforeach;?>
                    
                    <?php
                    }
                    else
                    {
                        echo '<h4>'.$complaint['message'].'</h4>';
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