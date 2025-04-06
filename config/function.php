<?php
session_start();
require 'dbconn.php';
//For input field validation
function validate($inputdata)
{
    global $conn;
    $validatedData = mysqli_escape_string($conn,$inputdata);
    return trim($validatedData);
}

//For redirecting to another page with message(status)
function redirect($url,$status=null)
{
    $_SESSION["status"] = $status;
    header("Location: ".$url);
    exit(0);
}

//For showing message or status after any process.
function alertMessage()
{
    if(isset($_SESSION['status']))
    echo "<div class='alert'>
          <h2>$_SESSION[status]</h2>
          <button onclick=closeMsg()>close</button>
          </div>";
    unset($_SESSION['status']);

    echo "
    <script>
    let alertClose = document.getElementById('close')
    let alertMsg = document.querySelector('.alert');
    function closeMsg(){
    alertMsg.style.display = 'none';
    }
    </script>
    ";
}

//For inserting record in table 
function insert($tableName,$data)
{
    global $conn;
    $table = validate($tableName);
    $columns = array_keys($data);
    $values=array_values($data);
    $finalColumn = implode(',',$columns);
    $finalValues = "'".implode("','",$values)."'";
    $query = "insert into $table ($finalColumn) values ($finalValues)";
    $result=mysqli_query($conn,$query);
    return $result;
}

//For updating records in table
function update($tableName,$id,$data)
{
    global $conn;
    $table = validate($tableName);
    $id = validate($id);
    $updateDataString = "";
    foreach($data as $column => $value)
    {
        $updateDataString .= $column.'='."'$value',";
    }
    $finalUpdateData = substr(trim($updateDataString),0,-1);
    $query = "update $table set $finalUpdateData where id = '$id'";
    $result = mysqli_query($conn,$query);
    return $result;
}




//For geting all the records from database
function getAll($tableName,$status=NULL)
{
    global $conn;
    $table = validate($tableName);
    $status = validate($status);
    if($status == 'status')
    {
        $query = "select * from $table where status = '0'";
    }
    else
    {
        $query = "select * from $table";
    }
    return mysqli_query($conn,$query);
}

//For getting individual record from database

function getById($tableName, $id)
{
    global $conn;
    $table = validate($tableName);
    $id = validate($id);
    
    // Fetch all complaints for the given user
    $query = "SELECT * FROM $table WHERE id = '$id'";
    $result = mysqli_query($conn, $query);
    
    if ($result) {
        if (mysqli_num_rows($result) > 0) 
        {
            $rows = [];
            while ($row = mysqli_fetch_assoc($result)) {
                $rows[] = $row;
            }
            $response = [
                'status' => 200,
                'data' => $rows,
                'message' => 'Records found'
            ];
            return $response;
        } 
        else 
        {
            return [
                'status' => 404,
                'message' => 'No data found'
            ];
        }
    } 
    else 
    {
        return [
            'status' => 500,
            'message' => 'Something went wrong'
        ];
    }
}
function getByIdUser($tableName, $user_id)
{
    global $conn;
    $table = validate($tableName);
    $user_id = validate($user_id);
    
    // Fetch all complaints for the given user
    $query = "SELECT * FROM $table WHERE user_id = '$user_id'";
    $result = mysqli_query($conn, $query);
    
    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            $rows = [];
            while ($row = mysqli_fetch_assoc($result)) {
                $rows[] = $row;
            }
            $response = [
                'status' => 200,
                'data' => $rows,
                'message' => 'Records found'
            ];
            return $response;
        } else {
            return [
                'status' => 404,
                'message' => 'No data found'
            ];
        }
    } else {
        return [
            'status' => 500,
            'message' => 'Something went wrong'
        ];
    }
}
//For deleting a record from database using id
function deleteRowsHead($tableName,$id)
{
    global $conn;
    $table = validate($tableName);
    $id = validate($id);
    $query = "delete from $table where dept_id=$id limit 1 ";
    $result = mysqli_query($conn,$query);
    return $result;
}


function deleteRowsAdmin($tableName,$id)
{
    global $conn;
    $table = validate($tableName);
    $id = validate($id);
    $query = "delete from $table where id=$id limit 1 ";
    $result = mysqli_query($conn,$query);
    return $result;
}


//For counting the number of complaints according to their status....

function countAll($tableName)
{
    global $conn;
    $table = validate($tableName);
    $query = "select count(*) as total from $table";
    $result = mysqli_query($conn,$query);
    
    if($result)
    {
        if(mysqli_num_rows($result)>0)
        {
           $row = mysqli_fetch_assoc($result);
           $response = [
            'status'=>200,
            'data'=>$row,
            'message'=>'Record found'
        ];
        return $response;
        }
        else
        {
            $response = [
                'status'=>404,
                'message'=>'No data found'
            ];
            return $response;
        }
    }
    else
    {
       $response = [
        'status'=>500,
        'message'=>'Something went wrong'
       ];
       return $response;
    }
}

function countAllForRouter($tableName)
{
    global $conn;
    $table = validate($tableName);
    $query = "select count(*) as total from $table where routing_officer = 1";
    $result = mysqli_query($conn,$query);
    
    if($result)
    {
        if(mysqli_num_rows($result)>0)
        {
           $row = mysqli_fetch_assoc($result);
           $response = [
            'status'=>200,
            'data'=>$row,
            'message'=>'Record found'
        ];
        return $response;
        }
        else
        {
            $response = [
                'status'=>404,
                'message'=>'No data found'
            ];
            return $response;
        }
    }
    else
    {
       $response = [
        'status'=>500,
        'message'=>'Something went wrong'
       ];
       return $response;
    }
}

function countAllId($tableName,$id)
{
    global $conn;
    $id = validate($id);
    $table = validate($tableName);
    $query = "select count(*) as total from $table where user_id = '$id'";
    $result = mysqli_query($conn,$query);
    
    if($result)
    {
        if(mysqli_num_rows($result)>0)
        {
           $row = mysqli_fetch_assoc($result);
           $response = [
            'status'=>200,
            'data'=>$row,
            'message'=>'Record found'
        ];
        return $response;
        }
        else
        {
            $response = [
                'status'=>404,
                'message'=>'No data found'
            ];
            return $response;
        }
    }
    else
    {
       $response = [
        'status'=>500,
        'message'=>'Something went wrong'
       ];
       return $response;
    }
}


function countPending($tableName)
{
    global $conn;
    $table = validate($tableName);
    $query = "select count(*) as pending from $table where approved='0'";
    $result = mysqli_query($conn,$query);
    
    if($result)
    {
        if(mysqli_num_rows($result)>0)
        {
           $row = mysqli_fetch_assoc($result);
           $response = [
            'status'=>200,
            'data'=>$row,
            'message'=>'Record found'
        ];
        return $response;
        }
        else
        {
            $response = [
                'status'=>404,
                'message'=>'No data found'
            ];
            return $response;
        }
    }
    else
    {
       $response = [
        'status'=>500,
        'message'=>'Something went wrong'
       ];
       return $response;
    }
    
}



function countPendingID($tableName,$id)
{
    global $conn;
    $id = validate($id);
    $table = validate($tableName);
    $query = "select count(*) as pending from $table where approved='0' and user_id = '$id'";
    $result = mysqli_query($conn,$query);
    
    if($result)
    {
        if(mysqli_num_rows($result)>0)
        {
           $row = mysqli_fetch_assoc($result);
           $response = [
            'status'=>200,
            'data'=>$row,
            'message'=>'Record found'
        ];
        return $response;
        }
        else
        {
            $response = [
                'status'=>404,
                'message'=>'No data found'
            ];
            return $response;
        }
    }
    else
    {
       $response = [
        'status'=>500,
        'message'=>'Something went wrong'
       ];
       return $response;
    }
    
}

function countInProgress($tableName)
{
    global $conn;
    $table = validate($tableName);
    $query = "select count(*) as inprocess from $table where approved='1' and closed='0'";
    $result = mysqli_query($conn,$query);
    
    if($result)
    {
        if(mysqli_num_rows($result)>0)
        {
           $row = mysqli_fetch_assoc($result);
           $response = [
            'status'=>200,
            'data'=>$row,
            'message'=>'Record found'
        ];
        return $response;
        }
        else
        {
            $response = [
                'status'=>404,
                'message'=>'No data found'
        
            ];
            return $response;
        }
    }
    else
    {
       $response = [
        'status'=>500,
        'message'=>'Something went wrong'
       ];
       return $response;
    }
}

function countInProgressId($tableName , $id)
{
    global $conn;
    $id = validate($id);
    $table = validate($tableName);
    $query = "select count(*) as inprocess from $table where approved='1' and closed='0' and user_id = '$id'";
    $result = mysqli_query($conn,$query);
    
    if($result)
    {
        if(mysqli_num_rows($result)>0)
        {
           $row = mysqli_fetch_assoc($result);
           $response = [
            'status'=>200,
            'data'=>$row,
            'message'=>'Record found'
        ];
        return $response;
        }
        else
        {
            $response = [
                'status'=>404,
                'message'=>'No data found'
        
            ];
            return $response;
        }
    }
    else
    {
       $response = [
        'status'=>500,
        'message'=>'Something went wrong'
       ];
       return $response;
    }
}

function countClosed($tableName)
{
    global $conn;
    $table = validate($tableName);
    $query = "select count(*) as closed from $table where closed='1'";
    $result = mysqli_query($conn,$query);
    
    if($result)
    {
        if(mysqli_num_rows($result)>0)
        {
           $row = mysqli_fetch_assoc($result);
           $response = [
            'status'=>200,
            'data'=>$row,
            'message'=>'Record found'
        ];
        return $response;
        }
        else
        {
            $response = [
                'status'=>404,
                'message'=>'No data found'
            ];
            return $response;
        }
    }
    else
    {
       $response = [
        'status'=>500,
        'message'=>'Something went wrong'
       ];
       return $response;
    }
}


function countClosedId($tableName,$id)
{
    global $conn;
    $id = validate($id);
    $table = validate($tableName);
    $query = "select count(*) as closed from $table where closed='1' and user_id = '$id'";
    $result = mysqli_query($conn,$query);
    
    if($result)
    {
        if(mysqli_num_rows($result)>0)
        {
           $row = mysqli_fetch_assoc($result);
           $response = [
            'status'=>200,
            'data'=>$row,
            'message'=>'Record found'
        ];
        return $response;
        }
        else
        {
            $response = [
                'status'=>404,
                'message'=>'No data found'
            ];
            return $response;
        }
    }
    else
    {
       $response = [
        'status'=>500,
        'message'=>'Something went wrong'
       ];
       return $response;
    }
}

//Getting thorugh reference table
function getByRefID($table1,$table2, $id)
{
    global $conn;
    $table_1 = validate($table1);
    $table_2 = validate($table2);
    $id = validate($id);
    
    // Fetch all complaints for the given user
    $query = "SELECT $table_1.*, $table_2.* FROM $table_1 inner join $table2 on $table_1.dept_id = $id and $table_2.dept_id = $id";
    $result = mysqli_query($conn, $query);
    
    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            $rows = [];
            while ($row = mysqli_fetch_assoc($result)) {
                $rows[] = $row;
            }
            $response = [
                'status' => 200,
                'data' => $rows,
                'message' => 'Records found'
            ];
            return $response;
        } else {
            return [
                'status' => 404,
                'message' => 'No data found'
            ];
        }
    } else {
        return [
            'status' => 500,
            'message' => 'Something went wrong'
        ];
    }
}


function getByRefIDWithAdmin($table1,$table2, $admin_id,$dept_id)
{
    global $conn;
    $table_1 = validate($table1);
    $table_2 = validate($table2);
    $admin_id2 = validate($admin_id);
    $dept_id2= validate($dept_id);

    
    // Fetch all complaints for the given user
    $query = "SELECT $table_1.*, $table_2.* FROM $table_1 inner join $table2 on $table_1.dept_id = $dept_id2 and $table_2.dept_id = $dept_id2 where id = '$admin_id2'";
    $result = mysqli_query($conn, $query);
    
    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            $rows = [];
            while ($row = mysqli_fetch_assoc($result)) {
                $rows[] = $row;
            }
            $response = [
                'status' => 200,
                'data' => $rows,
                'message' => 'Records found'
            ];
            return $response;
        } else {
            return [
                'status' => 404,
                'message' => 'No data found'
            ];
        }
    } else {
        return [
            'status' => 500,
            'message' => 'Something went wrong'
        ];
    }
}

function getByRefAll($table1,$table2)
{
    global $conn;
    $table_1 = validate($table1);
    $table_2 = validate($table2);
    
    // Fetch all complaints for the given user
    $query = "SELECT $table_1.*, $table_2.* FROM $table_1 inner join $table_2 on $table_1.dept_id = $table_2.dept_id";
    $result = mysqli_query($conn, $query);
    
    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            $rows = [];
            while ($row = mysqli_fetch_assoc($result)) {
                $rows[] = $row;
            }
            $response = [
                'status' => 200,
                'data' => $rows,
                'message' => 'Records found'
            ];
            return $response;
        } else {
            return [
                'status' => 404,
                'message' => 'No data found'
            ];
        }
    } else {
        return [
            'status' => 500,
            'message' => 'Something went wrong'
        ];
    }
}


function getByRefAllDesig($table1,$table2)
{
    global $conn;
    $table_1 = validate($table1);
    $table_2 = validate($table2);
    // Fetch all complaints for the given user
    $query = "SELECT $table_1.*, $table_2.* FROM $table_1 inner join $table_2 on $table_1.dept_id = $table_2.dept_id where desig not in ('Collector','Head','Routing Officer')";
    $result = mysqli_query($conn, $query);
    
    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            $rows = [];
            while ($row = mysqli_fetch_assoc($result)) {
                $rows[] = $row;
            }
            $response = [
                'status' => 200,
                'data' => $rows,
                'message' => 'Records found'
            ];
            return $response;
        } else {
            return [
                'status' => 404,
                'message' => 'No data found'
            ];
        }
    } else {
        return [
            'status' => 500,
            'message' => 'Something went wrong'
        ];
    }
}

//updating using reference
function updateRef($table1,$table2,$id,$data)
{
    global $conn;
    $table_1 = validate($table1);
    $table_2 = validate($table2);

    $id = validate($id);
    $updateDataString = "";
    foreach($data as $column => $value)
    {
        $updateDataString .= $column.'='."'$value',";
    }
    $finalUpdateData = substr(trim($updateDataString),0,-1);
    $query = "update $table_1,$table_2 set $finalUpdateData where $table_1.dept_id=$id and $table_2.dept_id = $id";
    $result = mysqli_query($conn,$query);
    return $result;
}

//For deleting a record from database using id
function deleteRowsRef($table1,$table2,$id)
{
    global $conn;
    $table_1 = validate($table1);
    $table_2 = validate($table2);

    $id = validate($id);
    $query = "delete from $table_1,$table_2 where $table_1.dept_id=$id and $table_2.dept_id=$id limit 1 ";
    $result = mysqli_query($conn,$query);
    return $result;
}


// update query to route complaint

function updateComp($tableName,$cid,$uid,$data)
{
    global $conn;
    $table = validate($tableName);
    $cid = validate($cid);
    $uid = validate($uid);
    $updateDataString = "";
    foreach($data as $column => $value)
    {
        $updateDataString .= $column.'='."'$value',";
    }
    $finalUpdateData = substr(trim($updateDataString),0,-1);
    $query = "update $table set $finalUpdateData where id = '$cid' and user_id = '$uid'";
    $result = mysqli_query($conn,$query);
    return $result;
}

?>
