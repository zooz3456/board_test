<?php 
    include "conn.php"; 
    $writer = mysqli_real_escape_string($conn,$_POST['writer']); 
    $content = mysqli_real_escape_string($conn,$_POST['content']); 
  //print_r($_POST); 
    $no = $_POST['no']; 

    if($writer == '' or $content == '') 
    {//입력이 안되었으면 
        //echo "입력이 안되었습니다."; 
        echo "<script> 
            alert('내용이 입력되지 않았습니다.'); 
            location.href='javascript:history.back()'; 
            </script>"; 
        mysqli_close($conn); 
        exit; 
    } 

    $sql = "insert into reply_img(writer,content,board_name,board_no) 
    values('{$writer}', '{$content}','board1_img',{$no})"; 
  //echo $sql; 
//  exit; 
    $result = mysqli_query($conn,$sql); 

    if($result)//insert 성공 = 1 
    { 
    $sql = "update board1_img set reply = reply + 1 where no = {$no}"; 
    mysqli_query($conn,$sql); 
    mysqli_close($conn); 

    echo"<script> 
            alert('댓글등록 성공'); 
            location.href='/img1.php?no={$no}' 
        </script>"; 
        //?no={$no}->포스트로 넘어온 글번호 
    } 
    else 
    { 
    mysqli_close($conn); 
    echo"<script> 
            alert('댓글등록 실패'); 
            location.href='javascript:history.back()'; 
            </script>"; 
    } 
?> 