<?php include 'includes/header.php'; ?>
<div class="view-complaints">
<div class="head">
        <h1>Complaint</h1>
        <a href="all-complaints.php">
            <button>Back</button>
        </a>
</div>
    <?php 
     if(isset($_GET['id']))
     
    {
        $complaintId = validate($_GET['id']);

    $complaintData=mysqli_query($conn,"select * from complaints where id = $complaintId");
    
    if(mysqli_num_rows($complaintData)>0)
    {
        $complaint=[];
        $data = mysqli_fetch_assoc($complaintData);
        $complaint[]=$data;
    ?> 
    <?php foreach ($complaint as $complaintData): ?>    

    <a href="view-image.php" class="view-image"><button>View Image</button></a>
    <div class="votes">
            <div class="vote-wrap">
            <h3><?= $complaintData['votes']?></h3>
            <h3>Votes</h3>
            </div>
        </div> 
    <?php
     if($complaintData['files'])
     {
        echo "
            <div class='comp-img'>
            <img src='".$complaintData['files']."' alt='image-not-found'>
            </div>";
     }
     else
     {
        echo "
            <div class='comp-img'>
            </div>";
     } 
    ?>
    <div class="details">
        <div class="subject" style="font-size:1.6rem; font-weight:700"><?= $complaintData['subject']?></div>
        <?php
            
        ?>
        <div class="filed-by"style="font-size:1.4rem; font-weight:700"><span><?=$complaintData['user_name']?></span></div>
        <div class="category"style="font-size:1.2rem; font-weight:700"><?= $complaintData['cType']?></div>
        <div class="address"style="font-size:1.2rem"><?= $complaintData['address']?></div>
        <div class="desc">
            <h2>Description:</h2>
            <p><?= $complaintData['description']?></p>
        </div>
        
        <div class="date"><h3>Date:<span><?= $complaintData['date']?></span></h3></div>
        <div  class="approve-send">
        <a href="edit-complaint.php?id=<?=$complaintData['id']?>"><button>Edit</button></a>
        <a href="delete-complaint.php?id=<?=$complaintData['id']?>"><button>Delete</button></a>

        </div>
    </div>
    <?php
    endforeach;
        }
        }
    ?>
</div>
<?php include 'includes/footer.php'; ?>
