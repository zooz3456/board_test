<?php
	$no = $_GET['no'];
	include "conn.php";//접속 정보

	$sql = "delete from board1_img where no={$_GET['no']}";
	$result = mysqli_query($conn,$sql);

	if($result)//delete 성공 = 1
	{//삭제 성공시 첫 페이지로 이동
	$sql="delete from reply_img where board_no={$_GET['no']}";
	$result=mysqli_query($conn,$sql);
		echo "<script>
				alert('{$_GET['no']}번 글이 삭제 되었습니다.');
				location.href='/st.php';
				</script>";

	}
	else
	{//삭제 실패 시 이전 페이지로 이동
		echo "<script>
				alert('삭제에 실패 했습니다.');
				location.href='javascript:history.back()';
				</script>";
	}
	mysqli_close($conn);
?>
