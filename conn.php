<?php

  $host = "127.0.0.1";
  $id = "root";
  $pass = "1234";
  $db = "board";

  $conn = mysqli_connect($host, $id, $pass, $db);

  if(!$conn)
  {
    echo "DB 접속에 실패 했습니다.";
    exit;
  }

?>
