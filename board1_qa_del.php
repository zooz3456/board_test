<?php
include "conn.php";
$no=$_GET['no'];
$sql="DELETE FROM board1_qa WHERE no='{$no}'";
$result=mysqli_query($conn,$sql);

if($result)
{
  $sql="DELETE FROM reply_qa WHERE board_no={$no}";
  $result=mysqli_query($conn,$sql);
  echo "<script>
        alert('글이 삭제되었습니다.');
        location.href='/board1_qa_main.php';
        </script>";
}
else{
  mysqli_close($conn);
  echo "<script>
        alert('글삭제에 실패하였습니다.');
        location.href='/board1_qa_main.php';
        </script>";
}


 ?>
