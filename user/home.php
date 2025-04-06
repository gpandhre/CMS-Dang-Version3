<?php include 'includes/header.php' ?>


<div class="home-container">
    <div class="head">
        <h1>COMPLAINTS</h1>
        <a href="dashboard.php">
            <button>Back</button>
        </a>
    </div>

    <?php
        $fetchComplaints = mysqli_query($conn,"select *,TIMESTAMPDIFF(SECOND, date, NOW()) AS time from complaints order by date desc");
        function timeElapsed($seconds) {
            if ($seconds < 60) {
                return $seconds . " second" . ($seconds == 1 ? "" : "s") . " ago";
            } elseif ($seconds < 3600) {
                return floor($seconds / 60) . " minute" . (floor($seconds / 60) == 1 ? "" : "s") . " ago";
            } elseif ($seconds < 86400) {
                return floor($seconds / 3600) . " hour" . (floor($seconds / 3600) == 1 ? "" : "s") . " ago";
            } else {
                return floor($seconds / 86400) . " day" . (floor($seconds / 86400) == 1 ? "" : "s") . " ago";
            }
        }
        
        if ($fetchComplaints->num_rows > 0) {
            while ($row = $fetchComplaints->fetch_assoc()) {
            ?>

                <div class="complaint">
                <div class="user">
                    <div class="pro_img"><img src="images/vecteezy_golden-logo-template_23654784.png" alt=""></div>
                    <div class="username"><?=$row["user_name"]?></div>
                    <div class="total-votes">
                        <div class="count"><?=$row["votes"]?></div>
                        <div class="title">Votes</div>
                    </div>
                    <div class="post-time"><?=timeElapsed($row["time"])?></div>
                </div>
                <div class="department">Department: <?=$row["cType"]?></div>
                <div class="sub-category">Sub-Category: <?=$row["sub_category"]?></div>
                <div class="description"><p>Description:<br><?=$row['description']?></p></div>
                <div class="comp-images">
                    <?php
                        if($row['files'])
                        {
                            echo "<img src='".$row['files']."'>";
                        }
                    ?>
                </div>
                <div class="vote">
                    <a href="vote.php?c_id=<?=$row['id']?>" class="vote-wrapper">
                        <div class="title">Vote</div>
                    </a>
                </div>
            </div>
            <?php
            }
        } else {
            ?>
            <div class="complaint" style="height: 4rem; display: flex; justify-content: center; align-items: center; font-size: 1.3rem;">
                No Complaints Till Now..
            </div>
            <?php
        }
        
    ?>

   

   
</div>

<?php include 'includes/footer.php' ?>
