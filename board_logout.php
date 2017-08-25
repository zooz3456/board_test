<?php
SESSION_START();
SESSION_DESTROY();

echo "<script>
	alert('접속을 종료 합니다');
	location.href='/free_board.php';
	</script>";
?>