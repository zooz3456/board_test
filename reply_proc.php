<?php

  include "conn.php";

  $writer = mysqli_real_escape_string($conn, $_POST['writer']);
  $content = mysqli_real_escape_string($conn, $_POST['content']);
  $no = $_POST['no'];

  if($writer == '' OR $content == '')
  {//입력이 안되었으면
    //echo "입력이 안되었습니다.";
    echo "<script>
            alert('내용이 입력되지 않았습니다.');
            location.href='javascript:history.back()';
          </script>";
    mysqli_close($conn);
    exit;
  }

  $sql = "INSERT INTO reply(writer, content, board_name, board_no)
          VALUES('{$writer}', '{$content}', 'free', {$no})";
  $result = mysqli_query($conn, $sql);

  if($result)//INSERT 성공 = 1
  {
    mysqli_close($conn);
    echo "<script>
            alert('글이 작성되었습니다.');
            location.href='/read.php?no={$no}';
          </script>";
  }
  else
  {
    mysqli_close($conn);
    echo "<script>
            alert('글 작성에 실패 했습니다.');
            location.href='javascript:history.back()';
          </script>";
  }

?>
