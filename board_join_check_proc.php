<?php

if($_POST['id']=="")
{
		echo "<script>
		alert('ID를 입력 해주세요.');
		</script>";	
		exit;
}
else
{
	include 'conn.php';
	$id = mysqli_real_escape_string($conn,$_POST['id']);
	$sql="select id from user where id='{$id}'";
	$result=@mysqli_query($conn,$sql);
	$rows=@mysqli_num_rows($result);
	if($rows)
	{
		echo 1;
	}
	else
	{
		echo 0;
	}
}
@mysqli_free_result($result);
@mysqli_close($conn);
?>
		