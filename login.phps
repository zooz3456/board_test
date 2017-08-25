<?php
  session_start();

  if(isset($_SESSION['id']))
  {//isset 로그인 성공 했다면 로그인 성공한 내용 표시, 로그아웃 버튼 표시
    echo "{$_SESSION['id']} 로그인";
    echo "<input type='button'
            onclick=\"location.href='logout.php'\" value='로그아웃'>";
    //echo "<button onclick=\"location.href='logout.php'\">로그아웃</button>";
  }
  else
  {//아니라면 밑에 테이블 출력
?>
    <table border="1" align="center">
      <form method="POST" action="login_proc.php">
      <tr><td>ID</td><td><input type="text" name="id"></td></tr>
      <tr><td>PASS</td><td><input type="text" name="pass"></td></tr>
      <tr><td></td><td><input type="submit" value="로그인"></td></tr>
      </form>
    </table>
<?php
  }
?>
