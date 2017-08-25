<?php 
 //print_r($_POST); 
 include "conn.php"; 
//dpdirrmf 페이지에서 작성한 글에서 넘겨받아서 
if($_POST['subject'] == '' or $_POST['content'] == '') 
{ 
  echo "<script>; 
  alert('입력 되지 않았습니다.'); 
  location.href='javascript:history.back()'; 
  </script>"; 
  exit; 
} 
else 
{ 
$w = $_POST['writer']; 
$s = $_POST['subject']; 
$t = $_POST['content']; 

$dbfile = ''; 
if(is_uploaded_file($_FILES['attach']['tmp_name'])) 
{ 
  $tmpfile = $_FILES['attach']['tmp_name']; 
  $updir = "C:\\xampp\\htdocs\\upload\\"; 
  $upfile = $updir . $_FILES['attach']['name']; 
  $dbfile = $_FILES['attach']['name']; 

  if(!move_uploaded_file($tmpfile, $upfile)) 
  { 
    echo "<script> 
      alert('파일 이동에 실패했습니다 '); 
      location.href='javahistory.back()'; 
      </script>"; 
    exit; 
  } 
} 

if(isset($_POST['reserve'])) 
{ 
  $y = $_POST['year']; 
  $m = $_POST['month']; 
  $d = $_POST['day']; 
  $h = $_POST['hour']; 
  $n = $_POST['min']; 

  $sql = "insert into reserve(writer,subject,content,show_date,upload,board_name) values('{$w}','{$s}','{$t}', 
          '{$y}-{$m}-{$d} {$h}:{$n}:00','{$dbfile}','board1_img')"; 
  $result = mysqli_query($conn,$sql); 
  if($result) 
  { 
  echo "<script>
        alert('예약글이 등록되었습니다.');
        location.href='/st.php';
        </script>";
  } 
  else 
  { 
  echo "<script>
        alert('예약글 등록에 실패 했습니다.');
        location.href='javascript:history.back()';
        </script>"; 
  } 
} 
else 
{ 
  $sql = "insert into board1_img(writer,subject,content,upload) values('{$w}','{$s}','{$t}','{$dbfile}')"; 
  $result = mysqli_query($conn,$sql); 
  if($result) 
  { 
  echo "<script>
        alert('글이 등록되었습니다.');
        location.href='/st.php';
        </script>";
  } 
  else 
  { 
  echo "<script>
        alert('글 등록에 실패 했습니다.');
        location.href='javascript:history.back()';
        </script>"; 
  } 
} 
mysqli_close($conn); 
//데이터베이스에 저장 

} 
?> 