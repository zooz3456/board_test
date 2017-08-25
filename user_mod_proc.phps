<?php
  session_start();

  if($_POST['id'] == '' OR $_POST['pass'] == '' OR $_POST['name'] == ''
     OR $_POST['email'] == '')
  {
    echo "<script>
            alert('내용이 입력되지 않았습니다.');
            location.href='javascript:history.back()';
          </script>";
    exit;
  }

  include "conn.php";

  $id = mysqli_real_escape_string($conn, $_POST['id']);
  $pass = mysqli_real_escape_string($conn, $_POST['pass']);
  $name = mysqli_real_escape_string($conn, $_POST['name']);
  $email = mysqli_real_escape_string($conn, $_POST['email']);

  $sql = "UPDATE user SET id = '{$id}', pass = sha2('{$pass}', 0),
          name = '{$name}', email = '{$email}' WHERE id = '{$_SESSION['id']}'";
  $result = mysqli_query($conn, $sql);

  mysqli_close($conn);

  if($result) //UPDATE 성공 = 1
  {//수정 성공
    echo "<script>
            alert('회원정보 수정 성공');
            location.href='/board.php';
          </script>";
  }
  else
  {//가입 실패
    echo "<script>
            alert('회원정보 수정 실패');
            location.href='javascript:history.back()';
          </script>";
  }
?>
