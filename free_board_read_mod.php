<html>
<!DOCTYPE html>
<script src="http://code.jquery.com/jquery-3.2.1.js"></script>

<head>
<style>
html{
	background-color: #CEFFE7;
}
table.type06 {
    border-collapse: collapse;
	margin:15px 0;
	margin-bottom : 0px;
}
table.type06 th {
	background: #efefef;
}
table.type06 td {
	font-size:12pt; 
	color:black; 
	background-color : white;
}
input.button{
	width : 100%;
	height : 66px;
	float:right;
}
</style>
</head>
<body>
<?php

SESSION_START();
if(!isset($_SESSION['id']))
{
	echo "<script>
	alert('비정상적인 접근입니다.');
	location.href='free_board.php?page=1';
	</script>";	
	exit;
}
$no=$_POST['no'];
$page=$_POST['page'];

include 'conn.php';
if($_SESSION['id']=='admin')
{
$sql="select*from board1_admin where no={$no}";
}
else
{
$sql="select * from board1_free where no={$no}";
}
$result=mysqli_query($conn,$sql);
$arr=mysqli_fetch_assoc($result);
?>
<div align='center'>
<table class='type06' border="1" width="50%" align='center'>
<tr><th class='type06' width="90px">제목</th><td>
<input type='hidden' name='page' value='<?=$page?>'>
<input type='hidden' name='writer' value='<?=$arr['writer']?>'>
<input type='hidden' name='no' value='<?=$arr['no']?>'>
<input type='text' name='subject'
value='<?=$arr['subject']?>'></td></tr>

<tr><th class='type06' width="90px">첨부파일</th><td>

<tr><td class='type06' colspan="2">본문 내용</td></tr>

<tr><td colspan="2"><textarea cols='80' rows='7' name='content'><?=$arr['content']?>
</textarea></td></tr>

<tr><th class='type06' colspan='2'><input type='button' name='mod' value='수정하기'></th></tr>

</table>
</div>
<script>

function func1()
{
writer = $("input[name='writer']").val();
no = $("input[name='no']").val();
subject = $("input[name='subject']").val();
content = $("textarea[name='content']").val(); 
page= $("input[name='page']").val();

$.ajax({
	type : "POST",
	url : "free_board_read_mod_proc.php",
	data : {writer:writer,no:no,subject:subject,content:content,page:page},
	success:func
});
}

function func(data)
{
$("div").html(data);
}

$("input[name='mod']").click(func1);
</script>

</body>

</html>