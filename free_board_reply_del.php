<?php
SESSION_START();
include 'conn.php';
$no=$_POST['no'];
$board_no=$_POST['board_no'];
$board_name=mysqli_real_escape_string($conn,$_POST['board_name']);

$sql="delete from free_reply where no={$no} AND board_no={$board_no} AND board_name='{$board_name}'";
$result=mysqli_query($conn,$sql);

if($result)
{
		$sql="update {$board_name} set reply = reply - 1 where no={$board_no}";
		$result=mysqli_query($conn,$sql);
		echo "<script>
		alert('댓글을 삭제 했습니다.');
		location.href='javascript:history.back()';
		</script>";
}
else
{
		echo "<script>
		alert('댓글 삭제에 실패 했습니다.');
		location.href='javascript:history.back()';
		</script>";	
}
mysqli_close($conn);
?>