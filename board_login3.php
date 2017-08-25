<?php
if($_POST['id']==""or$_POST['pass']=="")
{
	echo "<script>
			alert('회원 정보를 입력 해주세요.');
			location.href='javascript:history.back()';
			</script>";
	exit;
}
else
{
include 'conn.php';
$id=$_POST['id'];
$pass=$_POST['pass'];	

$sql="select id from user where id='{$id}' and pass=sha2('{$pass}',0)";
$result=mysqli_query($conn,$sql);
$rows=mysqli_num_rows($result);
$arr=mysqli_fetch_assoc($result);
if($rows)
{
	mysqli_free_result($result);
	$sql="update user set active=1 where id='{$arr['id']}'";
	$result=mysqli_query($conn,$sql);
	echo "<script>
		alert('계정이 활성화 되었습니다. 로그인 해주세요.');
		location.href='free_board.php';
		</script>";
}	
else
{
	echo "<script>
		alert('회원 정보가 틀립니다. 다시 시도 해주세요.');
		location.href='javascript:history.back()';
		</script>";	
}
}
mysqli_free_result($result);
mysqli_close($conn);
?>