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
$sql = "select * from board1_img where no={$no}";
$result = mysqli_query($conn,$sql);
$arr = mysqli_fetch_assoc($result);
//echo $arr['writer'];
?>
  <table border="0">
  <form method="POST" action="tnwjd.php">
    <input type="hidden" name="no" value="<?=$arr['no']?>">
  <tr>
  <th>작성자</th><td><input type="text" name="writer" value="<?=$arr['writer']?>"></td><!--readonly 입력,수정 불가-->
  <!--html구문에서 php구문을 사용할때 변수['값'] 할때 씀-->
  </tr>
  <tr>
  <th>제목</th><td><input type="text" name="subject" ondragover="" size="70" value="<?=$arr['subject']?>"></td>
  </tr>
  <tr>
  <th>파일첨부</th><td><input type="file" name="att" size="70"></td>
  </tr>

  <tr>
  <td colspan="2"><textarea cols="100" rows="7" name="content"><?=$arr['content']?></textarea></td>
  </tr>
  </table>
  <div align="center"><input type="submit" value="수정"></div>
  </form>
</table>
