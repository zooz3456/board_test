<?php

  include "conn.php";
  $no = $_POST['no'];
  $writer = $_POST['writer'];
  $subject = mysqli_real_escape_string($conn, $_POST['subject']);
  $content = mysqli_real_escape_string($conn, $_POST['content']);

  if($subject == '' OR $content == '')
  {//입력이 안되었으면
    //echo "입력이 안되었습니다.";
    echo "<script>
            alert('내용이 입력되지 않았습니다.');
            location.href='javascript:history.back()';
          </script>";
    mysqli_close($conn);
    exit;
  }

  $sql = "UPDATE free SET subject = '{$subject}',
          content = '{$content}' WHERE no = {$no}";
  // UPDATE [테이블명] SET [필드명] = [변경할 값],
  //  [필드명] = [변경할 값] WHERE no = {$no};
  $result = mysqli_query($conn, $sql);

  if($result)//INSERT 성공 = 1
  {
    mysqli_close($conn);
    echo "<script>
            alert('수정 되었습니다.');
            location.href='javascript:history.back()';
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
