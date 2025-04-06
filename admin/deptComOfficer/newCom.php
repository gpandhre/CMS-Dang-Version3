<?php include 'includes/header.php'; ?>
<div class="comContainer">
<div class="head">
        <h1>New Complaints</h1>
        <a href="index.php">
            <button>Back</button>
        </a>
</div>
<?php 
alertMessage();
if(isset($_SESSION['auth_compOfficer']))
{
    $complaintsResult = getAll('complaints');
    $complaints = [];
    $compOfficerDeptId = $_SESSION['auth_compOfficer']['dept_id'];

if ($complaintsResult && mysqli_num_rows($complaintsResult) > 0) {
    while ($row = mysqli_fetch_assoc($complaintsResult)) {
        $complaints[] = $row;
    }
}

$found = false;

if (!empty($complaints)): 
    foreach ($complaints as $complaintsItem):  
        if ($complaintsItem['dept_comp_officer'] == 0 && $complaintsItem['routing_officer']== 1 && $complaintsItem['dept_id']== $compOfficerDeptId):  
            $found = true; 
?>
        
            <div class="complaints">
                <div class="left">
                    <h1 style="text-align:left"><?=$complaintsItem['cType'];?></h1>
                    <h2 style="text-align:left"><?=$complaintsItem['subject'];?></h2>
                    <div class="desc">
                        <h3>Description:</h3>
                        <p><?=$complaintsItem['description'] ?>.</p>
                    </div>
                    <div class="votes">
                        <span><?=$complaintsItem['votes'] ?></span>
                        <h3>Votes</h3>
                    </div>       
                </div>
                <div class="right">
                    <h3>Date: <span><?=$complaintsItem['date'] ?></span></h3>
                    <a href="view-complaints.php?id=<?=$complaintsItem['id']?>"><button>View</button></a>
                </div>
            </div>
<?php 
        endif; 
    endforeach;

    // If no complaints had officer == 0, show "No complaints found"
    if (!$found): 
?>
    <div class="no-complaints">
        <h2>No new complaints found.</h2>
    </div>
<?php 
    endif; 
endif;
}
?>

    
</div>
<?php include 'includes/footer.php'; ?>
