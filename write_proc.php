<?php

  include "conn.php";

  $writer = mysqli_real_escape_string($conn, $_POST['writer']);
  $subject = mysqli_real_escape_string($conn, $_POST['subject']);
  $content = mysqli_real_escape_string($conn, $_POST['content']);

  if($writer == '' OR $subject == '' OR $content == '')
  {//입력이 안되었으면
    //echo "입력이 안되었습니다.";
    echo "<script>
            alert('내용이 입력되지 않았습니다.');
            location.href='javascript:history.back()';
          </script>";
    mysqli_close($conn);
    exit;
  }

  if(!is_uploaded_file($_FILES['att']['tmp_name']))
  {
    echo "<script>
            alert('파일 업로드에 실패 했습니다.');
            location.href='javascript:history.back()';
          </script>";
    exit;
  }

  $tmpfile = $_FILES['att']['tmp_name'];
  $upfile = "C:\\xampp\\htdocs\\upload\\" . $_FILES['att']['name'];
  $dbfile = "/upload/" . $_FILES['att']['name'];

  if(!move_uploaded_file($tmpfile, $upfile))
  {
    echo "<script>
            alert('파일 이동에 실패 했습니다.');
            location.href='javascript:history.back()';
          </script>";
    exit;
  }

  $sql = "INSERT INTO free(writer, subject, content, upload) VALUES
          ('{$writer}', '{$subject}', '{$content}', '{$dbfile}')";
  $result = mysqli_query($conn, $sql);

  if($result)//INSERT 성공 = 1
  {
    mysqli_close($conn);
    echo "<script>
            alert('글이 작성되었습니다.');
            location.href='/board.php';
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
