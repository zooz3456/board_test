<?php
include 'conn.php';

if($_POST['subject']=='' or $_POST['content']=='')
{
		echo "<script>
		alert('제목, 내용을 입력 해주세요.');
		location.href='javascript:history.back()';
		</script>";	
		mysqli_close($conn);
		exit;
}

$subject=mysqli_real_escape_string($conn,$_POST['subject']);
$content=mysqli_real_escape_string($conn,$_POST['content']);
$no=$_POST['no'];
$page=$_POST['page'];

if($_POST['writer']=='admin')
{
$sql="update board1_admin set subject='{$subject}',content='{$content}'
		where no={$no}";
}
else
{
$sql="update board1_free set subject='{$subject}',content='{$content}'
		where no={$no}";
}
$result=mysqli_query($conn,$sql);
if($result)
{
	if($_POST['writer']=='admin')
	{
		echo "<script>
		alert('공지가 수정 되었습니다.');
		location.href='/free_board_read_admin.php?no={$no}& page={$page}';
		</script>";
	}
	else
	{
		echo "<script>
		alert('게시글이 수정 되었습니다.');
		location.href='/free_board_read.php?no={$no}& page={$page}';
		</script>";
	}

}
else
{
		echo "<script>
		alert('게시글 수정에 실패 했습니다.');
		location.href='javascript:history.back()';
		</script>";	
}
mysqli_close($conn);

?>