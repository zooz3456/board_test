<?php
session_start();
$conn = mysqli_connect('127.0.0.1','root','1111','board1');
$id = $_POST['id'];
$pass = $_POST['pass'];
if(!$conn)
{
  echo "접속을 실패 하였습니다.";
}
$sql = "select id from user where id='{$id}' and pass=sha2('{$pass}',0)";
$result = mysqli_query($conn,$sql);
$rows = mysqli_num_rows($result);
$arr=mysqli_fetch_all($result,MYSQLI_NUM);
mysqli_free_result($result);
mysqli_close($conn);
if($rows)
{
  echo "로그인에 성공했습니다.";
  $_SESSION['id'] = $id;
}
else
{
  echo "로그인에 실패했습니다.";
}
?>
<script>
if(<?=$rows?>)
{
  alert('로그인 되었습니다.');
  location.href='st.php';
}
else
{
  alert('로그인에 실패 하였습니다.');
  location.href='javascript:history.back()';
}
</script>
