<?php

  //print_r($_POST);
  include "conn.php";
  $field = $_POST['field'];
  $search = mysqli_real_escape_string($conn, $_POST['search']);

  if($search == '')
  {
    echo "검색어가 입력되지 않았습니다.";
    exit;
  }

  $sql = "SELECT * FROM free WHERE {$field} LIKE '%{$search}%'";
  $result = mysqli_query($conn, $sql);
  $rows = mysqli_num_rows($result);
  $fields = mysqli_num_fields($result);
  $arr = mysqli_fetch_all($result, MYSQLI_NUM);

  for($i = 0; $i < $rows; $i++)
  {
    for($j = 0; $j < $fields; $j++)
    {
      echo $arr[$i][$j] . "<br>";
    }
    echo "<br>";
  }

?>
