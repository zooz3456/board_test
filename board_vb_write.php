<?php
SESSION_START();

if(!isset($_SESSION['id']))
{
	echo "<script>
	alert('비정상적인 접근입니다.');
	location.href='board_vb.php?page=1';
	</script>";	
	exit;
}
include 'conn.php';

if($_POST['writer']=='' or $_POST['content']=='')
{
		echo "<script>
		alert('내용을 입력 해주세요.');
		location.href='javascript:history.back()';
		</script>";
}
else
{
	$writer=mysqli_real_escape_string($conn,$_POST['writer']);
	$content=mysqli_real_escape_string($conn,$_POST['content']);
	
	$sql="insert into board1_vb(writer,content)
		values('{$writer}','{$content}')";
	$result=@mysqli_query($conn,$sql);
	if($result)
	{
		echo "<script>
		alert('방명록을 작성 했습니다.');
		location.href='javascript:history.back()';
		</script>";		
	}
	else
	{
		echo $sql;
		exit;
		echo "<script>
		alert('작성에 실패 했습니다.');
		location.href='javascript:history.back()';
		</script>";			
	}
}
@mysqli_close($conn);
?>