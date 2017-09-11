<?php
session_start();
include "conn.php";
if($_POST['id'] == '' or $_POST['pass'] == '')
{
  echo "<script>
  alert('ID/PASS가 입력되지 않았습니다.');
  location.href='javascript:history.back()';
  </script>";
}//POST 형태로 넘어온 데이터에 값이 없는 경우 오류 메시지 출력
//이전 페이지로 이동
$id = mysqli_real_escape_string($conn,$_POST['id']);
$pass = mysqli_real_escape_string($conn,$_POST['pass']);
//POST 형태로 넘어온 데이터 변수 재지정 및 이스케이프 처리

$sql = "select id,active from user where id='{$id}' and pass=sha2('{$pass}',0)";
 //SELECT 쿼리 구문 작성
$result = mysqli_query($conn,$sql);
//DB에 쿼리문 전송
$rows = mysqli_num_rows($result);
$arr = mysqli_fetch_assoc($result);

if($rows)
{
  if($arr['active'] == 1)
  {
    //  date_default_timezone_set("Asia/Seoul");
    //  $cur_date = date('Y-m-d H:i:s',time());
      //결과 행 개수가 1개 라면 로그인 성공
    //=세선에 기록
    //$sql = "update user set last_login = '{$cur_date}' where id='{$id}'";
    $sql = "update user set last_login = now() where id='{$id}'";//마지막으로 로그인한 시간
    //now()라고 쓰면 현재날짜,시간이 나오기 때문에 현재시간 변수를 안써도됨
    $result = mysqli_query($conn,$sql);
    $_SESSION['id'] = "{$arr['id']}";
    $_SESSION['board'] ="board";
    //- $_SESSION['id'] = "{$arr['id']}";
    //- $_SESSION['host'] ="board";
    //- 이전 페이지로 이동
      echo "<script>
      alert('로그인 성공');
      location.href='/board.php'?page=;
      </script>";
  }
  else
  {
    echo "<script>
    alert('휴면계정');
    location.href='/active_user.php'?page=;
    </script>";
  }
}
else
{//결과 행 개수가 없다면 로그인 실패
//-이전 페이지로 이동
  echo "<script>
  alert('로그인 실패');
  location.href='javascript:history.back()'?page=;
  </script>";
}
 ?>
