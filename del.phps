<?php
  //$no = $_GET['no'];
  //접속 정보
  include "conn.php";

  $sql = "DELETE FROM free WHERE no = {$_GET['no']}";
  $result = mysqli_query($conn, $sql);

  if($result)//DELETE 성공 = 1
  {//삭제 성공 시 첫 페이지로 이동
    echo "<script>
          alert('{$_GET['no']}번 글이 삭제 되었습니다.');
          location.href='/board.php';
          </script>";
  }
  else
  {//삭제 실패 시 이전 페이지로 이동
    echo "<script>
            alert('삭제에 실패 했습니다.');
            location.href='javascript:history.back()';
          </script>";
  }
?>
