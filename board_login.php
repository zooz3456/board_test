<?php
SESSION_START();
if($_POST['id']=="" or $_POST['pass']=="")
{
		echo "<script>
		alert('회원정보를 입력 해주세요.');
		location.href='javascript:history.back()';
		</script>";	
		exit;
}
else
{

include 'conn.php';

$id=mysqli_real_escape_string($conn,$_POST['id']);
$pass=mysqli_real_escape_string($conn,$_POST['pass']);


$sql="select id, active from user where id='{$id}' and pass=sha2('{$pass}',0)";
$result=@mysqli_query($conn,$sql);
$rows=@mysqli_num_rows($result);
$arr=@mysqli_fetch_assoc($result);
if($rows)
{
	if($arr['active']=='1')
	{
		mysqli_free_result($result);
		$sql="update user set last_login=now() where id='{$arr['id']}'";
		$result=@mysqli_query($conn,$sql);
		echo "<script>
		alert('{$arr['id']}님이 로그인 되었습니다.');
		location.href='javascript:history.back()';
		</script>";
		$_SESSION['id']=$arr['id'];
	}
	else
	{
		echo "<script>
		alert('3개월간 접속 하지 않아 휴면처리 되었습니다. 해제 해주세요.');
		location.href='board_login2.php';
		</script>";
	}
		
}
else
{
		echo "<script>
		alert('회원정보가 틀립니다.');
		location.href='javascript:history.back()';
		</script>";	
}
}
mysqli_close($conn);
?>