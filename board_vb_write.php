<?php
SESSION_START();
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
	$writer=$_POST['writer'];
	$content=$_POST['content'];
	
	$sql="insert into board1_vb(writer,content)
		values('{$writer}','{$content}')";
	$result=mysqli_query($conn,$sql);
	if($result)
	{
		echo "<script>
		alert('방명록을 작성 했습니다.');
		location.href='/board_vb.php';
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
mysqli_close($conn);
?>