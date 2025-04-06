<?php include 'includes/header.php'; ?>
<div class="fileComp">
    <a href="file-complaint.php">
    <div class="wrapper">
        <div class="title"><h1>File Complaint</h1></div>
        <div class="icon"><i class="ri-file-edit-fill"></i></div>        
    </div>
    </a>
</div>
<hr style="height: .3vh; background-color: rgb(246, 229, 196);">
<div class="divison">
    <div class="line"></div>
    <h1 style="margin:0;">OVERVIEW</h1>
    <div class="line"></div>
</div>

<div class="dashboard">
    <div class="dash-elem">
        <div class="count">
        <?php
        if(isset($_SESSION['auth_user']))
        {
        $compOfficerDeptId = $_SESSION['auth_user']['userid'];
        $countNew = mysqli_query($conn,"select count(*) as allComp from complaints where user_id = $compOfficerDeptId");
        if($countNew)
        {
            $row = mysqli_fetch_array($countNew);
        }
        ?>
            <h1>
                <?= $row['allComp'] ?>
            </h1>
        <?php

        }
        ?>
           
        </div>
        <div class="title">
        <a href="all-complaints.php">Your Complaints</a>
        </div>
        <div class="elem-img">
        <img src="../images/letter.svg" alt="">
        </div>
    </div>
    <div class="dash-elem">
        <div class="count">
        <?php
        if(isset($_SESSION['auth_user']))
        {
        $compOfficerDeptId = $_SESSION['auth_user']['userid'];
        $countNew = mysqli_query($conn,"select count(*) as penComp from complaints where dept_head = 0 and collector = 0 and approved = 0 and user_id = $compOfficerDeptId");
        if($countNew)
        {
            $row = mysqli_fetch_array($countNew);
        }
        ?>
            <h1>
                <?= $row['penComp'] ?>
            </h1>
        <?php

        }
        ?>
        </div>
        <div class="title">
        <a href="pending-complaints.php">Pending Complaints</a>
        </div>
        <div class="elem-img">
        <img src="../images/letter.svg" alt="">
        </div>
    </div>
    <div class="dash-elem">
        <div class="count">
        <?php
        if(isset($_SESSION['auth_user']))
        {
        $compOfficerDeptId = $_SESSION['auth_user']['userid'];
        $countNew = mysqli_query($conn,"select count(*) as inprogressComp from complaints where dept_head = 1 and collector = 1 and approved = 1 and closed = 0 and user_id = $compOfficerDeptId");
        if($countNew)
        {
            $row = mysqli_fetch_array($countNew);
        }
        ?>
            <h1>
                <?= $row['inprogressComp'] ?>
            </h1>
        <?php

        }
        ?>
        </div>
        <div class="title">
       <a href="inprogress-complaints.php">InProgress Complaints</a>
        </div>
        <div class="elem-img">
        <img src="../images/letter.svg" alt="">
        </div>
    </div>
    <div class="dash-elem">
        <div class="count">
        <?php
        if(isset($_SESSION['auth_user']))
        {
        $compOfficerDeptId = $_SESSION['auth_user']['userid'];
        $countNew = mysqli_query($conn,"select count(*) as closedComp from complaints where dept_head = 1 and collector = 1 and approved = 1 and closed = 1 and user_id = $compOfficerDeptId");
        if($countNew)
        {
            $row = mysqli_fetch_array($countNew);
        }
        ?>
            <h1>
                <?= $row['closedComp'] ?>
            </h1>
        <?php

        }
        ?>
        </div>
        <div class="title">
        <a href="closed-complaints.php">Closed Complaints</a>
        </div>
        <div class="elem-img">
        <img src="../images/letter.svg" alt="">
        </div>
    </div>
</div>
<?php include 'includes/footer.php'; ?>
