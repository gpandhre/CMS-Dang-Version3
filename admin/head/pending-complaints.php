<?php include 'includes/header.php'; ?>
<div class="admins">
    <div class="head">
        <h1>PENDING COMPLAINTS</h1>
        <a href="index.php">
            <button>Back</button>
        </a>
    </div>
    
    <div class="tableAdmin">
    <?php alertMessage();?>
        <div class="admin-table-head">
            <h3>Category</h3>
            <h3>Sub-Category</h3>
            <h3>Subject</h3>
            <h3>Status</h3>
            <h3>Action</h3>
        </div>

        <!-- Displaying all the admins  -->
    <?php 
        alertMessage();
        if(isset($_SESSION['auth_head']))
        {
            $complaintsResult = getAll('complaints');
            $complaints = [];
            $compOfficerDeptId = $_SESSION['auth_head']['dept_id'];

        if ($complaintsResult && mysqli_num_rows($complaintsResult) > 0) {
            while ($row = mysqli_fetch_assoc($complaintsResult)) {
                $complaints[] = $row;
            }
        }

        $found = false;

        if (!empty($complaints)): 
            foreach ($complaints as $complaintsItem):  
                if ($complaintsItem['dept_comp_officer']== 1 && $complaintsItem['dept_head'] == 1 && $complaintsItem['approved']==0 && $complaintsItem['dept_id']== $compOfficerDeptId):  
                    $found = true; 
    ?>   
            <div class="adminRec">
                <div><?= $complaintsItem['cType']?></div>
                <div><?= $complaintsItem['sub_category'] ?></div>
                <div><?= $complaintsItem['subject'] ?></div>
                <div>Pending</div>
                <div>
                    <a href="view-complaints.php?id=<?= $complaintsItem['id'] ?>"><button class="edit">View</button></a>
                </div>
            </div>
        <?php 
        endif;
        endforeach;
        if(!$found):
    ?>
        <div class="adminRec">
            <h2>No record found..</h2>
        </div>
        <?php 
    endif; 
endif;
}
?>

        
    </div>
</div>
<?php include 'includes/footer.php';?>