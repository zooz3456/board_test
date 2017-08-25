<?php

include "conn.php";

$writer=mysqli_real_escape_string($conn,$_POST['writer']);
$subject=mysqli_real_escape_string($conn,$_POST['subject']);
$content=mysqli_real_escape_string($conn,$_POST['content']);

if($writer=='' OR $subject=='' OR $content=='')
{
  echo "<script>
        alert('글이 입력되지않았습니다.');
        location.href='/board1_qa_main.php';
        </script>";
        mysqli_close($conn);
        exit;
}
if(isset($_POST['reserve']))
{
  $year=$_POST['year'];
  $mon=$_POST['mon'];
  $day=$_POST['day'];
  $hour=$_POST['hour'];
  $min=$_POST['min'];

  $sql="INSERT INTO reserve_qa(writer,subject,content,show_date)
  values('{$writer}','{$subject}','{$content}','{$year}-{$mon}-{$day} {$hour}:{$min}:00')";
}
else{

$sql="INSERT INTO board1_qa(writer,subject,content)
      values('{$writer}','{$subject}','{$content}')";
}
$result=mysqli_query($conn,$sql);

if($result)
{
  mysqli_close($conn);
  echo "<script>
        alert('글이 등록되었습니다.');
        location.href='/board1_qa_main.php';
        </script>";
}
else
{
  mysqli_close($conn);
  echo "<script>
        alert('글이 등록되지 않았습니다.');
        location.href='/board1_qa_main.php';
        </script>";
}



 ?>
