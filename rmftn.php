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
?>
<?php 
if(!isset($_SESSION['id']))
{
  exit;
} 

$no=$_GET['no']; 

$sql="select * from board1 where no={$no}"; 
$result=mysqli_query($conn,$sql); 
$arr=mysqli_fetch_assoc($result); 
mysqli_close($conn); 

?> 

<div align='center'> 
<table class='type06' border="1" width="50%" align='center'> 
<form method="POST" action="tnwjd.php"> 
<tr><th class='type06' width="90px">제목</th><td> 
<input type='hidden' name='writer' value='<?=$arr['writer']?>'> 
<input type='hidden' name='no' value='<?=$arr['no']?>'> 
<input type='text' name='subject' 
value='<?=$arr['subject']?>'></td></tr> 

<tr><th class='type06' width="90px">첨부파일</th><td> 

<tr><td class='type06' colspan="2">본문 내용</td></tr>
<?php include 'conn.php'; ?>

<tr><td colspan="2"><textarea cols='80' rows='7' name='content'><?=$arr['content']?> 
</textarea></td></tr> 
<tr><th class='type06' colspan='2'><input type='submit' name='mod' value='수정하기'></th></tr> 
</form> 
</table> 
</div> 

</body> 

</html> 