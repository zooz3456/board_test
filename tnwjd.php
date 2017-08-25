<?php 
//print_r($_POST); 
if($_POST['subject'] == '' or $_POST['content'] == '') 
{ 
  exit; 
  echo "<script> 
  alert('입력값이 없습니다.'); 
  location.href='javascript:history.back()'; 
  </script>"; 
  exit; 
} 
include  "conn.php"; 

$no = $_POST['no']; 
$writer = mysqli_real_escape_string($conn,$_POST['writer']); 
$subject = mysqli_real_escape_string($conn,$_POST['subject']); 
$content = mysqli_real_escape_string($conn,$_POST['content']); 
//POST 형태로 넘어온 데이터 변수 지정 및 이스케이프처리 
$sql = "update board1_img set writer='{$writer}', subject='{$subject}',content='{$content}' where no={$no}"; 
//echo $sql; 
//exit; 
//UPDATE 쿼리문 작성 
$result = mysqli_query($conn,$sql); 
//DB에 쿼리문 전송 
//mysqli_close($conn) 
if($result)//update 값이 1이라면 성공 
{ 
  //수정 성공 시 수정에 성공 했습니다. 
  //-이전 페이지 
  echo "<script> 
  alert('수정에 성공 했습니다.'); 
  location.href='/img1.php?no={$no}'; 
  </script>"; 
} 
else 
{ 
  //수정 실패 시 수정에 실패 했습니다. 
  //-이전 페이지 
  echo "<script> 
  alert('수정에 실패 했습니다.'); 
  location.href='javascript:history.back()'; 
  </script>"; 
} 
?> 