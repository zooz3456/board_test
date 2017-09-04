<html>
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
//게시글 출력을 위한 query 문
$no=$_GET['no'];
$page=$_GET['page'];
include 'conn.php';

$sql="update board1_admin set hit=hit+1 where no={$no}";
$result=mysqli_query($conn,$sql);

$sql="select * from board1_admin where no={$no}";
$result=mysqli_query($conn,$sql);
$arr=mysqli_fetch_assoc($result);
?>
<!-- 게시글 출력 -->
<div align='center'>
<form method='POST' action=''>
<table class='type06' border='1' width="80%" align='center'>
<tr><th class='type06' width="20%">번호</th><td class='type06'><?=$arr['no']?></td></tr>
<tr><th class='type06' width="20%">제목</th><td class='type06'>[공지]<?=$arr['subject']?></td></tr>
<tr><th class='type06' width="20%">작성자</th><td class='type06'><?=$arr['writer']?></td></tr>
<tr><th class='type06' width="20%">작성일</th><td class='type06'><?=$arr['date']?></td></tr>
<tr><th class='type06' width="20%">조회수</th><td class='type06'><?=$arr['hit']?></td></tr>
<tr><th class='type06' width="20%">첨부파일</th>
<td><?php
  if($arr['upload']=='')
  {
	  echo "";
  }
  else
  {
	echo"<a href='http://192.168.0.107/upload/{$arr['upload']}'>{$arr['upload']}</a>" ; 
  }?>
</td>
<tr><th class='type06' colspan="2">본문 내용</td></tr>
<tr>
<div><td colspan="2">
	<?php
  if($arr['upload']!="")
  {
	?>
<img src="\upload\<?=$arr['upload']?>" width=60% height=60% >
	<?php	  
  }
?>

<textarea rows='7'  cols='100'  
style="width:100%; height:100%; border:0;overflow-y:hidden;background:clear;"readonly>
<?=$arr['content']?>
</textarea></div></td></tr>
</table>
</form>
</div>
<br>
<!-- 게시글 작성자인 회원 or 관리자만 게시글 수정,삭제 가능-->
<div align='center'>
<?php
//게시글을 작성한 회원, 관리자만 수정 삭제를 사용가능하게 하기 위한 문열
if(isset($_SESSION['id']))
{
if($_SESSION['id']==$arr['writer'] or $_SESSION['id']=="admin")
{
?>
<form method='POST' action='' >
<input type='hidden' name='no' value='<?=$arr['no']?>'>
<input type='hidden' name='writer' value='<?=$arr['writer']?>'>
<input type='hidden' name='page' value='<?=$page?>'>
<input type='hidden' name='board_name' value='board1_admin'>
<input type='submit' value='수정'
formaction='free_board_read_mod.php'>
<input type='submit' value='삭제'
formaction='free_board_read_del.php'>
<?php
}
}
?>
<input type='button' value='목록으로'
onclick="location.href='free_board.php?page=<?=$page?>'">
</form>
</div>
<br>
<!-- 댓글 작성 -->
<div align='center'>
<table class='type06' border='1' width='80%' align='center'>
<form method='POSt' action='free_board_reply.php'>
<tr>
<input type='hidden' name='no' value='<?=$arr['no']?>'>
<input type='hidden' name='board_name' value='board1_admin'>
<th>작성자
<?php
//로그인 했을 경우 로그인한 id로 댓글이 작성되게 하기 위한 php문
if(isset($_SESSION['id']))
{
?><input type='text' name='writer' value='<?=$_SESSION['id']?>' readonly></th>
<?php } 
else
{
echo "<input type='text' name='writer'></td>";
}	?>
<td><textarea cols='60' rows='4' name='content'>
</textarea></td>
<td><input class='button' type='submit' value='댓글 등록'></td>
</tr>
</form>
</table>
</div>
<br>
<div align='center'>
<!-- 댓글 출력 -->
<?php
mysqli_free_result($result);
$sql="select no,writer,content,board_no from free_reply where board_name='board1_admin' and board_no={$arr['no']}";
$result=mysqli_query($conn,$sql);
$rows=mysqli_num_rows($result);
$arr=mysqli_fetch_all($result,MYSQLI_ASSOC);
if($rows)
{
	echo "<table class='type06' border='1' width='80%' align='center'>";
for($i=0; $i<$rows; $i++)
{
?>
<tr>
<form method='POST' action='free_board_reply_del.php'>
<input type='hidden' name='no' value='<?=$arr[$i]['no']?>'>
<input type='hidden' name='board_no' value='<?=$arr[$i]['board_no']?>'>
<input type='hidden' name='board_name' value='board1_admin'>
<th class='type06' width="40%" style='margin-top:10px;'>작성자 : <?=$arr[$i]['writer']?></th>
<td><textarea cols='70' rows='4' readonly>
<?=$arr[$i]['content']?>
</textarea></td>
<?php
if(isset($_SESSION['id']))
{
if($_SESSION['id']==$arr[$i]['writer'] or $_SESSION['id']=='admin')
{
echo "<td><input class='button' type='submit' value='삭제'></td>";
}
}
?>
</tr>
</form>
<?php
}
echo "</table>";
}
?>
</div>
</body>

</html>