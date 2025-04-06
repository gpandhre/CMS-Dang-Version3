<?php include 'includes/header.php'; ?>


<a class="new" href="newCom.php" style="text-decoration: none">
    <div class="new-com">
    <?php
    if(isset($_SESSION['auth_head']))
    {
    $deptHead = $_SESSION['auth_head']['dept_id'];
    $countNew = mysqli_query($conn,"select count(*) as newComp from complaints where dept_comp_officer = 1 and dept_head = 0 and dept_id = $deptHead");
    if($countNew)
    {
        $row = mysqli_fetch_array($countNew);
    }
    ?>
        <h1 style="background-color: cornflowerblue; padding: 2rem; border-radius: 50%; width: 1rem; height: 1rem; display: flex; justify-content: center; align-items: center; font-size: 2rem; font-weight: 700; color:white"><?= $row['newComp']?></h1>
    <?php

    }
    ?>
        <h1 style="margin-left:3rem; margin-right: 3rem; font-size: 2.1rem; font-weight: 500;">New Complaints</h1>
        <img src="../images/letter.svg" alt="">
    </div>
</a>
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
        if(isset($_SESSION['auth_head']))
        {
        $deptHead = $_SESSION['auth_head']['dept_id'];
        $countNew = mysqli_query($conn,"select count(*) as allComp from complaints where dept_comp_officer = 1 and dept_id = $deptHead");
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
        <a href="all-complaints.php">All Complaints</a>
        </div>
        <div class="elem-img">
        <img src="../images/letter.svg" alt="">
        </div>
    </div>
    <div class="dash-elem">
        <div class="count">
        <?php
        if(isset($_SESSION['auth_head']))
        {
        $deptHead = $_SESSION['auth_head']['dept_id'];
        $countNew = mysqli_query($conn,"select count(*) as penComp from complaints where dept_comp_officer = 1 and dept_head = 1 and approved = 0 and dept_id = $deptHead");
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
        if(isset($_SESSION['auth_head']))
        {
        $deptHead = $_SESSION['auth_head']['dept_id'];
        $countNew = mysqli_query($conn,"select count(*) as inprogressComp from complaints where dept_comp_officer = 1 and dept_head = 1 and approved = 1 and closed = 0 and dept_id = $deptHead");
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
        if(isset($_SESSION['auth_head']))
        {
        $deptHead = $_SESSION['auth_head']['dept_id'];
        $countNew = mysqli_query($conn,"select count(*) as closedComp from complaints where dept_comp_officer = 1 and dept_head = 1 and approved = 1 and closed = 1 and dept_id = $deptHead");
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
