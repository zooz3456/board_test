<?php
if($_POST['id']=="" or $_POST['pass']=="" or $_POST['name']=="" )
{
		echo "<script>
		alert('회원정보를 입력 해주세요.');
		location.href='javascript:history.back()';
		</script>";	
		exit;
}
else
{
	if(!$_POST['checked']=='0')
	{
		echo "<script>
		alert('ID 중복 체크를 해주세요.');
		location.href='javascript:history.back()';
		</script>";	
		exit;
	}
include 'conn.php';
//주석
$id=mysqli_real_escape_string($conn,$_POST['id']);
$pass=mysqli_real_escape_string($conn,$_POST['pass']);
$name=mysqli_real_escape_string($conn,$_POST['name']);
$email=mysqli_real_escape_string($conn,$_POST['email']);

$sql="insert into user(id,pass,name,email)
	values('{$id}',sha2('{$pass}',0),'{$name}','{$email}')";
$result=mysqli_query($conn,$sql);

if($result)
{
		echo "<script>
		alert('회원가입을 완료 했습니다. 로그인 해주세요.');
		location.href='/free_board.php';
		</script>";
}
else
{
		echo "<script>
		alert('회원가입에 실패 했습니다. 다시 시도 해주세요');
		location.href='javascript:history.back()';
		</script>";
}
}
mysqli_close($conn);

?>
