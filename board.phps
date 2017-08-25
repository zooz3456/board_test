<?php session_start(); ?>
<html>
<head>
  <style>
    table {
      text-align: center;
    }
    table tr {
      cursor: hand;
    }
    table tr th {
      cursor: default;
    }
    .login{
      border: 1px solid #999999;
      position: absolute;
      margin-top: 0px;
      margin-left: 0px;
      width: 20%;
    }
    .board{
      border: 1px solid #999999;
      position: absolute;
      margin-top: 0px;
      margin-left: 300px;
      width: 60%;
    }
    .page{
      text-align: center;
    }
  </style>
</head>
<body>

<?php
  if(!isset($_SESSION['id']))
  {
    ?>
    <div class="login">
      <table border="1" align="center">
        <form method="POST" action="login_proc.php">
        <tr><td>ID</td><td><input type="text" name="id"></td></tr>
        <tr><td>PASS</td><td><input type="text" name="pass"></td></tr>
        <tr><td></td><td><input type="submit" value="로그인">
        <input type="button" onclick="location.href='/join.php'" value="회원가입"></td></tr>
        </form>
      </table>
    </div>
    <div class="board">
      <p align="center"> 로그인 하세요 </p>
    </div>
    <?php
    exit;
  }

  echo "<div class='login'>{$_SESSION['id']} 로그인";
  echo "<input type='button'
          onclick=\"location.href='logout.php'\" value='로그아웃'>
        <input type='button'
          onclick=\"location.href='user_mod.php'\" value='회원정보수정'>
        </div>";
?>
  <div class="board">
  <table border="1" width="100%">
    <tr>
      <th width="10%">번호</th>
      <th width="50%">제목</th>
      <th width="10%">작성자</th>
      <th width="20%">작성일</th>
      <th width="10%">조회수</th>
    </tr>
<?php
  /*$sql = "SELECT count(reply.no) as reply, free.*
          FROM free LEFT JOIN reply ON free.no =
          reply.board_no WHERE free.{$field} LIKE '%{$search}%' GROUP BY free.no";
  */
  include "conn.php";
  //데이터베이스에 접속
  $per_page = 5;
  if(isset($_GET['page']))
  {
    $page = ($_GET['page'] - 1) * $per_page;
  }
  else
  {
    $page = 0;
  }

  if(isset($_POST['search'])) // 검색 버튼을 누른 경우
  {
    $field = $_POST['field'];
    $search = mysqli_real_escape_string($conn, $_POST['search']);
    $sql = "SELECT *, (SELECT count(no) FROM reply
            WHERE free.no = reply.board_no) as reply FROM free
            WHERE {$field} LIKE '%{$search}%'
            LIMIT $page, $per_page";
  }
  else // 검색 버튼을 누르지 않은 경우
  {
    $sql = "SELECT *, (SELECT count(no) FROM reply
            WHERE free.no = reply.board_no) as reply FROM free
            LIMIT $page, $per_page";
  }

  $result = mysqli_query($conn, $sql);
  //free 테이블에서 데이터 가져옴
  $rows = mysqli_num_rows($result);
  //가져온 결과에서 행 개수 출력
  $arr = mysqli_fetch_all($result, MYSQLI_ASSOC);
  //가져온 결과에서 데이터 배열 형태로 받아서 변수가 가리키게 함
  for($i = 0; $i < $rows; $i++)
  {
?>
    <tr onclick="location.href='/read.php?no=<?=$arr[$i]['no']?>'">
    <!-- read.php 페이지로 no 변수에 값 1(글번호)을 가리키게 해서 전송 -->
      <td><?=$arr[$i]['no']?></td>
      <td><?=$arr[$i]['subject']?>[<?=$arr[$i]['reply']?>]</td>
      <td><?=$arr[$i]['writer']?></td>
      <td><?=$arr[$i]['date']?></td>
      <td><?=$arr[$i]['hit']?></td>
    </tr>
<?php
  }
  //FOR 문을 사용해서 행 개수 만큼 반복 수행 밑에 내용 출력
?>
  </table>

  <div align="center">
<?php
  $sql = "SELECT count(no) FROM free";
  $result = mysqli_query($conn, $sql);
  $arr = mysqli_fetch_row($result);
  //ceil 함수 소수 점 이하 올림
  $num_page = ceil($arr[0] / $per_page);

  for($i = 1; $i <= $num_page; $i++)
  {
    echo "<a href='/board.php?page={$i}'>{$i}</a>";
  }
?>
  </div>

  <table border="1">
    <tr>
      <td><input type="button" onclick="location.href='/write.php'"
                                              value="글쓰기"></td>
      <form method="POST" action="/board.php">
      <!-- 현재 페이지로 변수 field, search 전송 -->
      <td>
          <select name="field">
            <option value="subject">제목</option>
            <option value="content">내용</option>
            <option value="writer">작성자</option>
          </select>
          <input type="text" name="search">
          <input type="submit" value="검색">
      </td>
      </form>
    </tr>
  </table>
</div>
</body>
</html>
