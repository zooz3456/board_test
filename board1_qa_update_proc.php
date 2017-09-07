<?php
include 'conn.php';

$writer=mysqli_real_escape_string($conn,$_POST['writer']);
$subject=mysqli_real_escape_string($conn,$_POST['subject']);
$content=mysqli_real_escape_string($conn,$_POST['content']);
$no=$_POST['no'];




if($subject=='' OR $content=='')
{
  echo "<script>
        alert('글이 입력되지않았습니다.');
        location.href='/board1_qa_main.php?page=1';
        </script>";
        mysqli_close($conn);
        exit;
}

$sql="UPDATE board1_qa SET writer='{$writer}',subject='{$subject}',content='{$content}' WHERE no='{$no}'";

$result=mysqli_query($conn,$sql);

if($result)
{
  mysqli_close($conn);
  echo "<script>
        alert('글이 수정되었습니다.');
        location.href='/board1_qa_main.php?page=1';
        </script>";
}
else {
  mysqli_close($conn);
  echo "<script>
        alert('글 수정에 실패하였습니다.');
        location.href='/board1_qa_main.php?page=1';
        </script>";
}

 ?>
