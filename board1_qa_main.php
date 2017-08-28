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

<title>질문 게시판</title>

</head>
<body>
<?php
SESSION_START();
?>
  <header>
        <h1>질문 게시판</h1>
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
    <div style='margin-left:25%;'>질문 게시판</div>
    <ul class="style1">
        <li class="first"><a href="free_board.php">자유 게시판</a></li>
		<li><a href="board1_qa_main.php">질문 게시판</a></li>
        <li><a href="st.php">이미지 게시판</a></li>
        <li><a href="board_vb.php">방명록</a></li>
    </ul>


</div>

<div id="content">
<table class='type06' border='1' align='center' width="90%">
    <tr>
        <th width="10%" >글 번호</th><th width="15%">작성자</th><th width="20%">제목</th>
        <th width="20%">작성일</th><th width="10%">조회수</th>
    </tr>
<?php
//로그인 확인이 되었을경우
include 'conn.php';
if(isset($session['id']))
{
    if($session['id']=='admin')
    {
        echo "관리자님 환영합니다.";
    }
    else
    {
        echo "{$session['id']}님이 로그인 하셨습니니다.";
    }
}
//search 검색으로 조회 했을때
$per_page = 5;

if(isset($_GET['page']))
{
    $page= ($_GET['page'] - 1 )*$per_page;
}
else
{
    $page = 0;
}
if(isset($_POST['search'])!="")
{
    $field=$_POST['field'];
    $search=mysqli_real_escape_string($conn,$_POST['search']);
    $sql="select * from board1_qa where {$field} LIKE '%{$search}%' order by no desc limit {$page},{$per_page}";
}
else
{
    $sql="select * from board1_qa order by no desc limit {$page},{$per_page}";
}
    $result=mysqli_query($conn,$sql);
    $rows=mysqli_num_rows($result);
    $arr=mysqli_fetch_all($result,MYSQLI_ASSOC);

//게시글들 조회

if($rows)
{
    for($i=0; $i<$rows; $i++)
    {
        ?>
        <tr onclick="location.href='board1_qa_read.php?no=<?=$arr[$i]['no']?>'">
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
    <form method='POST' action='board1_qa_main.php'>
        <table class='rist'>
            <tr></td>
            <?php

            mysqli_free_result($result);

            if(isset($_POST['search'])!="")
            {
                $field=$_POST['field'];
                $search=mysqli_real_escape_string($conn,$_POST['search']);
                $sql="select no from board1_qa where {$field} LIKE '%{$search}%' limit {$page},{$per_page}";
            }
            else
            {
                $sql="select no from board1_qa";
            }
                $result = mysqli_query($conn,$sql);
                $rows = mysqli_num_rows($result);
                //$per_page = 3;//페이지당 출력 글 갯수 위에 입력해준다
                $num_page = ceil($rows/$per_page);//ceil($rows/$per_page);
                mysqli_free_result()

            for($i=1; $i<=$num_page; $i++)
            {
                echo "<a href='/board1_qa_main.php?page={$i}'>{$i}</a>&nbsp";
            }
?>             </td></tr><tr><td>
            <div class='search'>
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
                <input type='button' onclick=location.href='board1_qa_writer.php' value='글쓰기'>

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
