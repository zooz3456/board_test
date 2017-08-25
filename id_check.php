<?php
include 'conn.php';
$id=$_POST['id'];

$sql="select id from user where id='{$id}'";
$result=mysqli_query($conn,$sql);
$rows=mysqli_num_rows($result);

if($rows)
{
	echo "1";
}
else
{
	echo "0";
}
mysqli_free_result($result);
mysqli_close($conn);

?>