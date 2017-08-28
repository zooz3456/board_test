<html>
<head>
<style>
html{
	background-color: #CEFFE7;
}
header{
	text-align:center;
	background-color :  #33cc99;
	height : 50px;
	margin-bottom : 10px;
}

#content
{
  float:right;
  width:80%;
}
table.vb{
	width : 163px;
	height : 10px;	
	margin-top : 0px;
} 
#content2
{
  margin-top : 50px;
  margin-left: 20%;
}
#sidebar
{
  float:left;
  width: 19%;
  border-radius:5px;
  background-color : white;
  padding-bottom:20px;
  margin-top : 15px;
  padding-left : 5px;


}
table.login{
	width : 163px;
	height : 10px;	
}  
input.login{
	height:100%;
	width:100%;
	paddint:10px;
	border:0px;
	outline:black;
	float:center;
}
#footer
{
	float:center;
	width : 80%;
	clear:both;
	margin-top : 50px;
	margin-left : 10%;
}

table.type06 {
    border-collapse: collapse;
    text-align: left;
		margin:15px 0;
		margin-bottom : 0px;
}
table.type06 th {
    font-weight: bold;
	text-align : center;
    vertical-align: top;
	background: #efefef;


}
table.type06 td {
	padding:0px 0px 0px 0px;
    vertical-align: top;
	font-size:12pt; 
	color:black; 
	background-color:white;
}
table.rist {
	margin-top : 0px;
    
}
select.search{
	float:left;
	height:40px;
}
div.search{
	height:40px;
	width:400px;
	border:1px solid black;
	background:#ffffff;
}
input.search{
	height:40px;
	width:205px;
	paddint:10px;
	border:0px;
	outline:black;
	float:center;
}
input.button{
	width : 50px;
	height : 100%;
	border:0px;
	backfground: #1b5ac2;
	outline : none;
	float:right;
	color:#ffffff
}
li
{
	margin-top : 5px;
}
a:link {
    color: black;
}

/* visited link */
a:visited {
    color: black;
}

/* mouse over link */
a:hover {
    color: black;
}

/* selected link */
a:active {
    color: blue;
}
</style>

<title>방명록</title>

</head>
<body>
<?php
SESSION_START();
?>
  <header>  
        <h1>방명록 게시판</h1>  
   </header> 
<div>
<div id ="sidebar">
<?php
if(!isset($_SESSION['id']))
{
?>

	<table class='login' border='1'>
		<form method='POST' action='board_login.php'>
		<tr><th>ID</th><td><input class='login' type='text' name='id'></td>
		</tr>
		<tr><th>PASS</th><td><input class='login' type='text' name='pass'></td>
		</tr>
		<tr>
		<td colspan='2' align='center'><input type='submit' value='로그인'>
		<input type='submit' formaction='board_join.php' value='회원가입'></td>
		</tr>

<?php
}
else
{
	echo"<tr><td>{$_SESSION['id']}님 환영합니다</td></tr>";
	echo"<tr><td><input type='button' onclick=\"location.href='board_logout.php'\" value='로그아웃'></td></tr>";
}	
?>
</form>
</table>

	<div style='margin-left:30%; margin-top:5px;'>방명록</div>
	<ul class="style1">
		<li class="first"><a href="\free_board.php">자유 게시판</a></li>
		<li><a href="board1_qa_main.php">질문 게시판</a></li>
		<li><a href="st.php">이미지 게시판</a></li>
		<li><a href="board_vb.php">방명록</a></li>
	</ul>


</div>



<div id="content" style='height : 320px;'>

<table class='type06' border='1' align='center' width='90%'>
	<tr>
		<th width="20%" >작성자</th><th width='50%'>내용</th>
	</tr>
<?php
//출력할 게시물 갯수
include 'conn.php';

$per_page = 5;

if(isset($_GET['page']))
{
	$page= ($_GET['page'] - 1 )*$per_page;
}
else
{
	$page = 0;
}
	$sql="select * from board1_vb order by no DESC limit {$page},{$per_page} ";
	$result=mysqli_query($conn,$sql);
	$rows=mysqli_num_rows($result);
	$arr=mysqli_fetch_all($result,MYSQLI_ASSOC);
if($rows)
{
	for($i=0; $i<$rows; $i++)
	{
		?>
		<tr>
		<td><?=$arr[$i]['writer']?></td>
		<td><?=$arr[$i]['content']?></td>
		</tr>
		<?php
	}?>

<?php
}
?>
</table>
	
<div id="content2">
<?php
			mysqli_free_result($result);

				$sql="select no from board1_vb";
				$result = mysqli_query($conn,$sql);
				$rows = mysqli_num_rows($result);
				//$per_page = 3;//페이지당 출력 글 갯수 위에 입력해준다
				$num_page = ceil($rows/$per_page);//ceil($rows/$per_page);
				mysqli_free_result($result);
			
			echo "<div style='margin-left:23%;'>";
			for($i=1; $i<=$num_page; $i++)
			{	
				
				echo "<a href='/board_vb.php?page={$i}'>{$i}</a>&nbsp";
				
			}
			echo "</div>";
?>
<table class='type06' border='1' align='center' 
		width='60%' >
	<form method='POST' action='board_vb_write.php'>
	<tr>
		<th width="20%" >작성자</th>
		<td width='40%'>
	<?php
	if(isset($_SESSION['id']))
	{
	?>		
		<input type='text' name='writer' value='<?=$_SESSION['id']?>' style='width : 100%;' readonly >
	<?php
	}	
	else
	{  
		echo"<input type='text' name='writer' style='width : 100%;'>";
	}
	?>			
		</td>
		<th rowspan='2' style='width : 10%; height : 100%;'><input type='submit' value='글쓰기'
			style="width : 100%; height : 58px;"></th></tr>
		<tr>
		<th width='20%' style=" margin-top:5px;
		padding-bottom: 0px; padding-top: 8px;">내용</th>
		<td width='40%'><textarea name='content' style=' width : 100%;'></textarea></td>
	</tr>
	</form>
</table>

</div>

</div>

</table>
</form>
</div>
</body>