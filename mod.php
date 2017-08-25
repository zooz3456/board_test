<?php session_start(); ?>
<html>
<head>
  <style>
    input {
      border: 0px;
      border-bottom: 1px solid #999999;
    }
    table tr th{
      text-align: center;
    }
  </style>
</head>

<?php
  $no = $_GET['no'];

  include "conn.php";

  $sql = "SELECT writer, subject, content FROM free WHERE no = {$no}";
  $result = mysqli_query($conn, $sql);
  $arr = mysqli_fetch_assoc($result);
?>

<form method="POST" action="mod_proc.php">
<table border="0">
  <input type="hidden" name="no" value="<?=$no?>">
  <tr>
    <th>작성자</th><td><input type="text" value="<?=$arr['writer']?>" name="writer" readonly></td>
  </tr>
  <tr>
    <th>제목</th><td><input type="text" value="<?=$arr['subject']?>" name="subject" size="70"></td>
  </tr>
  <tr>
    <td colspan="2"><textarea cols="100" rows="7" name="content"><?=$arr['content']?></textarea></td>
  </tr>
</table>
<div align="center"><input type="submit" value="수정"></div>
</form>
<?php
mysqli_free_result($result);
mysqli_close($conn);
?>