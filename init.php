# php-issues
 Ali cloud project to solve the online process, access to the database through PHP, error analysis
 Accessing database through PHP
  error：PHP Fatal error: Call to undefined method mysqli::mysqli_fetch_all();
  Source code：
<?php
$db_host='~~127.0.0.1~~';
$db_user='~~root~~';
$db_password='';
$db_database='~~building~~';
$db_port=3306;
$db_charset='UTF8';
$conn=mysqli_connect($db_host,$db_user,$db_password,$db_database,$db_port);
mysqli_query($conn,"SET NAMES $db_charset");
function sql_execute($sql){
  global $conn;
  $result = mysqli_query($conn, $sql);
  if(!$result){
    return  "$sql";
  }else {
    return $rowList=mysqli_fetch_all($result,MYSQLI_ASSOC);
  }
}
  
modified：
 <?php
 $db_host='~~127.0.0.1~~';
 $db_user='~~root~~';
 $db_password='';
 $db_database='~~building~~';
 $db_port=3306;
 $db_charset='UTF8';

 $conn=mysqli_connect($db_host,$db_user,$db_password,$db_database,$db_port);
 mysqli_query($conn,"SET NAMES $db_charset");
 function sql_execute($sql){
  global $conn;
  $result = mysqli_query($conn, $sql);

  if(!$result){
    return  "$sql";
  }else {
		$rowList=mysqli_fetch_assoc($result);
		while($rowList!=null){
		   $rows[]=$rowList;
		   $rowList=mysqli_fetch_assoc($result);
		}
		return $rows;
  }
}


 error：Syntax erro ‘[’;
 Source code：
   <?php
    header("Content-Type:application/json;charset=UTF-8");
    require("../init.php");
    @$tid=$_REQUEST['tid'];
    $output=["recordCount"=>0, "data"=>null];
    $sql="select * from bd_topic where tid=$tid";
    $result=mysqli_query($conn,$sql);
    $row=mysqli_fetch_all($result,MYSQLI_ASSOC);
    $output['data']=$row;

    $sql="select count(*) from bd_topic";
    $result=mysqli_query($conn,$sql);
    $row=mysqli_fetch_all($result);
    $output['recordCount']=$row;
    echo json_encode($output);
    ?>
 
    modified：
<?php
header("Content-Type:application/json;charset=UTF-8");
require("../init.php");
@$tid=$_REQUEST['tid'];
//$output=['recordCount'=>0, 'data'=>null];
$output=array();
$output['data']=null;
$output['recordCount']=0;
$sql="select * from bd_topic where tid=$tid";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($result);
while($row!=null){
		   $rows[]=$row;
		   $row=mysqli_fetch_assoc($result);
		}
$output['data']=$rows;

$sql="select count(*) from bd_topic";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_row($result);
$output['recordCount']=$row;
echo json_encode($output);
?>
