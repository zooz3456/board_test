<?php
SESSION_START();

if(!isset($_POST['no']))
{
	echo "<script>
	alert('비정상적인 접근입니다.');
	location.href='free_board.php?page=1';
	</script>";	
	exit;
}
include 'conn.php';
$no=(int)mysqli_real_escape_string($conn,$_POST['no']);
$writer=mysqli_real_escape_string($conn,$_POST['writer']);
$content=mysqli_real_escape_string($conn,$_POST['content']);
$board_name=mysqli_real_escape_string($conn,$_POST['board_name']);

if($writer=='')
{
	echo "<script>
			alert('내용값 입력이 필요합니다.');
			location.href='javascript:history.back()';
			</script>";
	mysqli_close($conn);
	exit;
}
else
{
	$sql="insert into free_reply(writer,content,board_name,board_no)
	values('{$writer}','{$content}','{$board_name}',{$no})";		
	$result=@mysqli_query($conn,$sql);
	if($result)
	{	
		$sql="update {$board_name} set reply = reply + 1 where no={$no}";
		$result=@mysqli_query($conn,$sql);
		
		echo "<script>
		alert('댓글을 작성 했습니다.');
		location.href='javascript:history.back()';
		</script>";
	}
	else
	{
		echo "<script>
		alert('댓글 작성에 실패 했습니다.');
		location.href='javascript:history.back()';
		</script>";	
	}
}
mysqli_close($conn);
?>