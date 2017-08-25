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


if(is_uploaded_file($_FILES['attach']['tmp_name']))
{

	$upload_dir = "C:\\xampp\\htdocs\\upload\\";
	$tmp_file = $_FILES['attach']['tmp_name'];
	$upload_file = $upload_dir . $_FILES['attach']['name'];	
	$move_file = move_uploaded_file($tmp_file, $upload_file);

	$upload = $_FILES['attach']['name']; 
}
else
{
	$upload = "";
}
	if(isset($_POST['reserve']))
		{
		$year=$_POST['year'];
		$month=$_POST['month'];
		$day=$_POST['day'];
		$hour=$_POST['hour'];
		$min=$_POST['min'];
		
		$sql="insert into reserve(writer,subject,content,upload,board_name,show_date)
		values('{$writer}','{$subject}','{$content}','{$upload}','board1_qa'
		,'{$year}-{$month}-{$day} {$hour}:{$min}:00')";	
		}
		

	else
		{
		$sql="insert into board1_qa(writer,subject,content,upload)
		values('{$writer}','{$subject}','{$content}','{$upload}')";	
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
