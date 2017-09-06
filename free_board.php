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
	width : 80%;
	clear:both;
	margin-top : 50px;
	margin-left : 2%;
}

table.type06 {
    border-collapse: collapse;
	margin:15px 0;
	margin-bottom : 0px;
	text-align:center;
}
table.type06 th {

	background: #efefef;
}


table.type06 td {
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

<title>자유 게시판</title>

</head>

<body>
<?php
SESSION_START();
?>
  <header>  
        <h1>자유 게시판</h1>  
   </header> 
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


	<div style='margin-left:25%; margin-top:5px;'>자유게시판</div>
	<ul class="style1">
		<li class="first"><a href="free_board.php?page=1">자유 게시판</a></li>
		<li><a href="board1_qa_main.php?page=1">질문 게시판</a></li>
		<li><a href="st.php?page=1">이미지 게시판</a></li>
		<li><a href="board_vb.php?page=1">방명록</a></li>
	</ul>



</div>
<div id="content">
<table class='type06' border='1' align='center' width="100%">
	<tr>
		<th width="10%" >글 번호</th><th width="15%">작성자</th><th width="20%">제목</th>
		<th width="20%">작성일</th><th width="10%">조회수</th>
	</tr>
<?php
//로그인 확인이 되었을경우
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
// !!페이지 분활
if(isset($_POST['search'])!="")
	{
		$field=$_POST['field'];
		$search=mysqli_real_escape_string($conn,$_POST['search']);
		$sql="select no from board1_free where {$field} LIKE '%{$search}%' limit {$page},{$per_page}";	
	}
	else
	{
		$sql="select no from board1_free";
	}
		$result = mysqli_query($conn,$sql);
		$rows = mysqli_num_rows($result);
		//$per_page = 3;//페이지당 출력 글 갯수 위에 입력해준다
		$num_page = ceil($rows/$per_page);//ceil($rows/$per_page);
// !!페이지 분활
if($_GET['page']<=-1 or $_GET['page']>$num_page or $_GET['page']==0)
{
	echo "<script>
	alert('비 정상적인 접근입니다.');
	location.href='/free_board.php?page=1';
	</script>";
	exit;
}


//공지사항
$sql="select * from board1_admin order by no DESC";
$result=mysqli_query($conn,$sql);
if($result)
{
$rows=mysqli_num_rows($result);
$arr=mysqli_fetch_all($result,MYSQLI_ASSOC);
mysqli_free_result($result);
if($rows)
{
	for($i=0; $i<$rows; $i++)
	{
		?>
		<tr style="border-bottom: 1px solid red;" onclick="location.href='free_board_read_admin.php?no=<?=$arr[$i]['no']?>&page=<?=$_GET['page']?>'">
		<td style=' font-size:13pt; background-color:white'><?=$arr[$i]['no']?></td>
		<td style=' font-size:13pt; background-color:white'><?=$arr[$i]['writer']?></td>
		<td style=' font-size:13pt; background-color:white'>[공지]<?=$arr[$i]['subject']?>[<?=$arr[$i]['reply']?>]</td>
		<td style=' font-size:13pt; background-color:white'><?=$arr[$i]['date']?></td>
		<td style=' font-size:13pt; background-color:white'><?=$arr[$i]['hit']?></td>
		</tr>
		<?php
	}?>
<?php
}
}
//search 검색으로 조회 했을때

?>

<?php
if(isset($_GET['search'])!="")
{
	$field=$_GET['field'];
	$search=mysqli_real_escape_string($conn,$_GET['search']);
	$sql="select * from board1_free where {$field} LIKE '%{$search}%' order by no DESC limit {$page},{$per_page}";	
}
else
{
	$sql="select * from board1_free order by no DESC limit {$page},{$per_page}";
}
	$result=@mysqli_query($conn,$sql);
if(!$result)
{
	mysqli_close($conn);
	exit;
}	
	$rows=@mysqli_num_rows($result);
	$arr=@mysqli_fetch_all($result,MYSQLI_ASSOC);
	
//게시글들 조회	

if($rows)
{
	for($i=0; $i<$rows; $i++)
	{
		?>
		<tr onclick="location.href='free_board_read.php?no=<?=$arr[$i]['no']?>&page=<?=$_GET['page']?>'">
		<td><?=$arr[$i]['no']?></td>
		<td><?=$arr[$i]['writer']?></td>
		<td><?=$arr[$i]['subject']?>[<?=$arr[$i]['reply']?>]</td>
		<td><?=$arr[$i]['date']?></td>
		<td><?=$arr[$i]['hit']?></td>
		</tr>
		<?php
	}?>

<?php
}
?>
</table>


<div id='footer' align='center'>
	<form method='GET' action='free_board.php'>
		<table class='rist'>
			
			<?php

			mysqli_free_result($result);
				
			for($i=1; $i<=$num_page; $i++)
			{	
				echo "<a href='/free_board.php?page={$i}'>{$i}</a>&nbsp";
			}
?> 			<tr><td>
			<div class='search'>
				<input type='hidden' name='page' value='<?=$_GET['page']?>'>
				<select class='search' name='field'>
					<option value='writer'>작성자</option>
					<option value='subject'>제목</option>
					<option value='content'>내용</option>
				</select>
				<input class='search' size='40' type='text' name='search' style='height:40px; width:250px;'>
				<input class='button' type='submit' value='검색'></td>

				<?php
				if(isset($_SESSION['id']))
				{
				?>
				<td>
				<input type='button' onclick=location.href='free_board_write.php?page=<?=$_GET['page']?>' value='글쓰기'>

				<?php
				}
				?>
				</td></tr>
			</div>
</div>
			
</div>

</table>
</form>


</body>
