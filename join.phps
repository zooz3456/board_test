<?php
  //ID 변수 존재 유무로 처음 접속 여부 확인
  if(!isset($_POST['id']))
  {
?>
    <p align="center"> 회원 가입 </p>
    <form method="POST" action="join.php">
    <table border="1" align="center">
      <tr><td>ID</td><td><input type="text" name="id"></td></tr>
      <tr><td>PASS</td><td><input type="text" name="pass"></td></tr>
      <tr><td>이름</td><td><input type="text" name="name"></td></tr>
      <tr><td>email</td><td><input type="text" name="email"></td></tr>
      <tr><td></td><td><input type="submit" value="회원가입"></td></tr>
    </table>
    </form>
<?php
    exit;
  }

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

  $sql = "INSERT INTO user(id, pass, name, email) VALUES
          ('{$id}', sha2('{$pass}', 0), '{$name}', '{$email}')";
  $result = mysqli_query($conn, $sql);

  mysqli_close($conn);

  if($result) //INSERT 성공 = 1
  {//가입 성공
    echo "<script>
            alert('가입 성공');
            location.href='/index.html';
          </script>";
  }
  else
  {//가입 실패
    echo "<script>
            alert('가입 실패');
            location.href='javascript:history.back()';
          </script>";
  }
?>
