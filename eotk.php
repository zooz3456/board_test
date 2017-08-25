<?php 
    $no = $_POST['no']; 
  $i = $_POST['board_no']; 
  include "conn.php";//접속 정보 



    $sql = "delete from reply_img where no={$no} and board_name='board1_img' and board_no={$i}"; 
    $result = mysqli_query($conn,$sql); 

    if($result)//delete 성공 = 1 
    {//삭제 성공시 첫 페이지로 이동 
        $sql = "update board1_img set reply = reply - 1 where no = {$i}"; 
        mysqli_query($conn,$sql); 
        mysqli_close($conn); 
        echo "<script> 
                alert('{$_POST['no']}번 댓글이 삭제 되었습니다.'); 
                location.href='img1.php?no={$i}'; 
                </script>"; 
                exit; 
    } 
    else 
    {//삭제 실패 시 이전 페이지로 이동 
        echo "<script> 
                alert('댓글삭제에 실패 했습니다.'); 
                location.href='javascript:history.back()'; 
                </script>"; 
    } 
?> 