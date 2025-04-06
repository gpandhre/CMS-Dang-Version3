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

    $complaints = mysqli_query($conn,"select * from complaints where dept_head = '1' and collector = '0' and approved = '0'");
    if(mysqli_num_rows($complaints)>0)
    {
        foreach ($complaints as $complaintData): ?>    
            <div class="adminRec">
                <div><?= $complaintData['cType']?></div>
                <div><?= $complaintData['sub_category'] ?></div>
                <div><?= $complaintData['subject'] ?></div>
                <div>Pending</div>
                <div>
                    <a href="view-complaints.php?id=<?= $complaintData['id'] ?>"><button class="edit">View</button></a>
                </div>
            </div>
        <?php endforeach;
    }
    else 
    { 
    ?>
        <div class="adminRec">
            <h2>No record found..</h2>
        </div>
    <?php 
    } 
?>

    </div>
</div>
<?php include 'includes/footer.php';?>