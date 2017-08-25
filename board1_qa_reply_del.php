<?php
include "conn.php";
$no=$_POST['no'];
$boardno=$_POST['board_no'];

$sql="DELETE FROM reply_qa WHERE no='{$no}'";
$result=mysqli_query($conn,$sql);

if($result)
{
  $sql="UPDATE board1_qa SET reply=reply-1 WHERE no={$boardno}";
  $result=mysqli_query($conn,$sql);
  mysqli_close($conn);
  echo "<script>
        alert('댓글이 삭제되었습니다.');
        location.href='/board1_qa_read.php?no={$boardno}';
        </script>";
}
else {
  mysqli_close($conn);
  echo "<script>
        alert('댓글이 삭제되지 않았습니다.');
        location.href='/board1_qa_read.php';
        </script>";
}
