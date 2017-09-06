<?php
SESSION_START();

if(!isset($_SESSION['id']))
{
	echo "<script>
	alert('비정상적인 접근입니다.');
	location.href='free_board.php?page=1';
	</script>";	
	exit;
}
$no=$_POST['no'];
$page=$_POST['page'];
include 'conn.php';
$board_name=$_POST['board_name'];

$sql="delete from {$board_name} where no={$no}";
$result=mysqli_query($conn,$sql);
if($result)
{
	$sql="delete from free_reply where board_name='{$board_name}' and board_no={$no}";
	$result=mysqli_query($conn,$sql);
		echo "<script>
		alert('게시글이 삭제 되었습니다.');
		location.href='/free_board.php?page={$page}';
		</script>";
}
else
{
		echo "<script>
		alert('게시글 삭제에 실패 했습니다.');
		location.href='javascript:history.back()';
		</script>";
}

mysqli_close($conn);
?>