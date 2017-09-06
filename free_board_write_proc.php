<?php
if(!isset($_POST['page']))
{
	echo "<script>
	alert('비정상적인 접근입니다.');
	location.href='free_board.php?page=1';
	</script>";
	exit;	
}
if($_POST['writer']=="")
{
		echo "<script>
		alert('제목을 입력 해주세요.');
		location.href='javascript:history.back()';
		</script>";
		exit;
}
include 'conn.php';
$page=$_POST['page'];
$subject=mysqli_real_escape_string($conn,$_POST['subject']);
$writer=mysqli_real_escape_string($conn,$_POST['writer']);
$content=mysqli_real_escape_string($conn,$_POST['content']);
$year=$_POST['year'];
$month=$_POST['month'];
$day=$_POST['day'];
$hour=$_POST['hour'];
$min=$_POST['min'];


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
			if($writer=="admin")
			{
				$sql="insert into reserve(writer,subject,content,upload,board_name,show_date)
				values('{$writer}','{$subject}','{$content}','{$upload}','board1_admin'
				,'{$year}-{$month}-{$day} {$hour}:{$min}:00')";	
			}
			else
			{
				$sql="insert into reserve(writer,subject,content,upload,board_name,show_date)
				values('{$writer}','{$subject}','{$content}','{$upload}','board1_free'
				,'{$year}-{$month}-{$day} {$hour}:{$min}:00')";	
			}
		}
		

	else
	{
		if($writer=="admin")
		{
				$sql="insert into board1_admin(writer,subject,content,upload)
				values('{$writer}','{$subject}','{$content}','{$upload}')";	

		}
		else
		{
				$sql="idnsert into board1_free(writer,subject,content,upload)
				values('{$writer}','{$subject}','{$content}','{$upload}')";	
		}
	}

$result=mysqli_query($conn,$sql);
if($result)
{
		echo "<script>
		alert('게시글이 작성 되었습니다.');
		location.href='/free_board.php?page={$page}';
		</script>";
}
else
{
		echo "<script>
		alert('게시글 작성에 실패 했습니다.');
		location.href='/free_board.php?page={$page}';
		</script>";
}
mysqli_close($conn);
?>