<?php

  include 'conn.php';

  $Name = mysqli_real_escape_string($conn, $_POST['Name']);
  $Stock = (int)mysqli_real_escape_string($conn, $_POST['Stock']);
  $Price = (int)mysqli_real_escape_string($conn, $_POST['Price']);

  if($Name == '' OR $Stock == 0 OR $Price == 0)
  {
    echo "입력값이 잘 못 되었습니다.";
    echo "<form><input type='submit' formaction='add.php' value='뒤로'></form>";
    exit;
  }

  if(!is_uploaded_file($_FILES['att']['tmp_name']))
  {
    echo "파일 업로드 실패";
    exit;
  }

  $tmpfile = $_FILES['att']['tmp_name'];
  $updir = "C:\\xampp\\htdocs\\upload\\";
  $upfile = $updir . $_FILES['att']['name'];
  $dbfile = "/upload/" . $_FILES['att']['name'];

  if(!move_uploaded_file($tmpfile, $upfile))
  {
    echo "파일 이동에 실패 했습니다.";
    exit;
  }
  // 파일 업로드 성공 및 파일 이동 성공한 경우
  //echo "접속 되었습니다.";
  $sql = "INSERT INTO product_tb(Name, Stock, Price, Img)
          Values('{$Name}', {$Stock}, {$Price}, '{$dbfile}')";
  $result = mysqli_query($conn, $sql);
  //echo $result;

  if($result)
  {
    echo "입력 되었습니다.";
  }
  else
  {
    echo "입력에 실패 했습니다.";
  }

  echo "<form><input type='submit' formaction='add.php' value='뒤로'></form>";

  mysqli_close($conn);
?>
