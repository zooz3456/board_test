<?php
include "conn.php";
$no=$_POST['no'];
$writer=$_POST['writer'];
$content=$_POST['content'];

$sql="INSERT INTO reply_qa(writer,content,board_no)
values('{$writer}','{$content}','{$no}')";
$result=mysqli_query($conn,$sql);

if($result)
{
  $sql="UPDATE board1_qa SET reply=reply+1 WHERE no={$no}";
  $result=mysqli_query($conn,$sql);

  echo "<script>
        alert('댓글이 등록되었습니다.');
        location.href='/board1_qa_read.php?no={$no}';
        </script>";
}
else {
  mysqli_close($conn);
  echo "<script>
        alert('댓글이 등록되지 않았습니다.');
        location.href='/board1_qa_read.php?no={$no}';
        </script>";
}





 ?>
