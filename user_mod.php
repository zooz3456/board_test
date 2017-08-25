<?php
  session_start();

  include "conn.php";

  $sql = "SELECT * FROM user WHERE id = '{$_SESSION['id']}'";
  $result = mysqli_query($conn, $sql);
  $arr = mysqli_fetch_assoc($result);

?>
<p align="center"> 회원 정보 수정 </p>
<form method="POST" action="user_mod_proc.php">
<table border="1" align="center">
  <tr><td>ID</td><td><input type="text" name="id" value="<?=$arr['id']?>"></td></tr>
  <tr><td>PASS</td><td><input type="text" name="pass" value=""></td></tr>
  <tr><td>이름</td><td><input type="text" name="name" value="<?=$arr['name']?>"></td></tr>
  <tr><td>email</td><td><input type="text" name="email" value="<?=$arr['email']?>"></td></tr>
  <tr><td></td><td><input type="submit" value="회원정보수정"></td></tr>
</table>
</form>
