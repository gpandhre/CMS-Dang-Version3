<?php include 'includes/header.php'; ?>
<div class="view-complaints">
<div class="head">
        <h1>New Complaint</h1>
        <a href="index.php">
            <button>Back</button>
        </a>
</div>
    <?php 
     if(isset($_GET['id']))
     
    {
        $complaintId = validate($_GET['id']);

    $complaintData=getById('complaints',$complaintId,);
    if($complaintData)
    {
        if($complaintData['status']==200)
        {
            $data = $complaintData['data'] ?? null;
    ?> 
    <?php foreach ($data as $complaintData): ?>    

    <a href="view-image.php" class="view-image"><button>View Image</button></a>
    <div class="votes">
            <div class="vote-wrap">
            <h3><?= $complaintData['votes']?></h3>
            <h3>Votes</h3>
            </div>
        </div> 
    <div class="comp-img"><img src="../images/hero1.png" alt=""></div>
    <div class="details">
        <div class="subject" style="font-size:1.6rem; font-weight:700"><?= $complaintData['subject']?></div>
        <div class="filed-by"style="font-size:1.4rem; font-weight:700"><span>Username</span></div>
        <div class="category"style="font-size:1.2rem; font-weight:700"><?= $complaintData['cType']?></div>
        <div class="address"style="font-size:1.2rem"><?= $complaintData['address']?></div>
        <div class="desc">
            <h2>Description:</h2>
            <p><?= $complaintData['description']?></p>
        </div>
        
        <div class="date"><h3>Date:<span><?= $complaintData['date']?></span></h3></div>
        <div  class="approve-send">
        <a href="approve.php?id=<?=$complaintData['id']?>"><button>Approve</button></a>
        </div>
    </div>
    <?php
    endforeach;
        }
        }
    }
    ?>
</div>
<?php include 'includes/footer.php'; ?>
