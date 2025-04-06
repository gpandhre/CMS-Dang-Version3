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
$complaintsResult = getAll('complaints');
$complaints = [];

if ($complaintsResult && mysqli_num_rows($complaintsResult) > 0) {
    while ($row = mysqli_fetch_assoc($complaintsResult)) {
        $complaints[] = $row;
    }
}

$found = false;

if (!empty($complaints)): 
    foreach ($complaints as $complaintsItem):  
        if ($complaintsItem['collector'] == 0 &&$complaintsItem['dept_head'] == 1):  
            $found = true; 
?>
        
            <div class="complaints">
                <div class="left">
                    <h1 style="text-align:left"><?=$complaintsItem['subject'];?></h1>
                    <div class="desc">
                        <h2>Description:</h2>
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
?>

    
</div>
<?php include 'includes/footer.php'; ?>
