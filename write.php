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

<form method="POST" enctype="multipart/form-data" action="write_proc.php">
<table border="0">
  <tr>
    <th>작성자</th><td><input type="text" value="<?=$_SESSION['id']?>" name="writer" readonly></td>
  </tr>
  <tr>
    <th>제목</th><td><input type="text" name="subject" size="70"></td>
  </tr>
  <tr>
    <th>파일첨부</th><td><input type="file" name="att" size="70"></td>
  </tr>
  <tr>
    <td colspan="2"><textarea cols="100" rows="7" name="content"></textarea></td>
  </tr>
</table>
<div align="center"><input type="submit" value="등록"></div>
</form>
