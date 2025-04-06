<?php include 'includes/header.php'; ?>
<div class="admins">
    <div class="head">
        <h1>YOUR COMPLAINTS</h1>
        <a href="dashboard.php">
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
    if(isset($_SESSION['auth_user'])) 
    {
    $id = $_SESSION['auth_user'];
    $complaints = getByIdUser('complaints', $id['userid']);

    if($complaints)
    {
        if($complaints['status'] == 200)
        {
        $data = $complaints['data'];
        foreach ($data as $complaintData): ?>    
            <div class="adminRec">
                <div><?= $complaintData['cType']?></div>
                <div><?= $complaintData['sub_category'] ?></div>
                <div><?= $complaintData['subject'] ?></div>
                <?php
                    if($complaintData['dept_comp_officer']=='1' && $complaintData['approved'] == '0')
                    {
                        ?>
                        <div>Pending</div>
                        <?php
                    }
                    elseif($complaintData['dept_head']=='1' && $complaintData['approved'] == '0')
                    {
                        ?>
                        <div>Approved</div>
                        <?php
                    }
                    elseif($complaintData['dept_head']=='1' && $complaintData['collector'] == '1' && $complaintData['approved'] == '1' && $complaintData['closed'] == '0')
                    {
                        ?>
                        <div>In-progress</div>
                        <?php
                    }
                    elseif($complaintData['dept_head']=='1' && $complaintData['collector'] == '1' && $complaintData['approved'] == '1' && $complaintData['closed'] == '1')
                    {
                        ?>
                        <div>Closed</div>
                        <?php
                    }
                    else
                    {
                        ?>
                        <div>Pending</div>
                        <?php
                    }

                    
                ?>
                <div>
                    <a href="view-complaint.php?id=<?= $complaintData['id'] ?>"><button class="edit">View</button></a>
                </div>
            </div>
        <?php endforeach;
        }
        else 
        { ?>
            <div class="adminRec">
                <h2>No record found..</h2>
            </div>
        <?php 
        } 
    }

}
?>

        
    </div>
</div>
<?php include 'includes/footer.php';?>