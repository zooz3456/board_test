<?php
  session_start();

  if($_POST['id'] == '' OR $_POST['pass'] == '')
  {//입력 값 검사
  //ID나 PASS 중 하나라도 없으면 이전 페이지로
    echo "<script>
            alert('ID/PASS가 입력되지 않았습니다.');
            location.href='javascript:history.back()';
          </script>";
    exit;
  }

  include "conn.php";

  $id = mysqli_real_escape_string($conn, $_POST['id']);
  $pass = mysqli_real_escape_string($conn, $_POST['pass']);

  $sql = "SELECT id FROM user WHERE id = '{$id}' AND
          pass = sha2('{$pass}', 0)";
  //echo $sql;

  $result = mysqli_query($conn, $sql);
  $rows = mysqli_num_rows($result);
  $arr = mysqli_fetch_row($result);

  mysqli_free_result($result);
  mysqli_close($conn);

  if($rows)//$rows 값이 1 이상이면
  {//  로그인 성공
    $_SESSION['id'] = $arr[0];
    echo "<script>
            alert('로그인 되었습니다.');
            location.href='/board.php';
          </script>";
  }
  else//아니면
  {//  로그인 실패
    echo "<script>
            alert('로그인 실패');
            location.href='javascript:history.back()';
          </script>";
  }

?>
