<?php include 'includes/header.php'; ?>
<div class="departments">
    <div class="head">
        <h1>Departments</h1>
        <a href="department-create.php">
            <button>Create</button>
        </a>
    </div>
    
    <div class="tableDept">
    <?php alertMessage();?>
        <div class="dept-table-head">
            <h3 style="width:35%">Name</h3>
            <h3 style="width:35%">Head</h3>
            <h3 style="width:30%">Action</h3>
        </div>

        <!-- Displaying all the admins  -->
        <?php 
        $dept = getByRefAll('department','admin_details');
        if($dept)
        {
            if($dept['status']==200)
        {
            $deptData= $dept['data'] ?? null;
        ?>
        <?php foreach($deptData as $deptItem):?>    
            <div class="deptRec">
            <div style="width:35%"><?= $deptItem['dept_name']?></div>
            <div style="width:35%"><?= $deptItem['name']?></div>
            <div style="width:30%">
                <a href="department-edit.php?id=<?=$deptItem['dept_id']?>"><button class="edit">Edit</button></a>
                <a href="department-delete.php?id=<?=$deptItem['dept_id']?>"><button class="del">Delete</button></a>
            </div>
        </div>
        <?php endforeach;?> 
        <?php
        }
    }
        else{
        ?>
            <div class="deptRec">
                <h2>No departments yet...</h2>
            </div>
            <?php
        }  
        ?>
        
    </div>
</div>
<?php include 'includes/footer.php';?>

