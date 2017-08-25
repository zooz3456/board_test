<?php
  session_start();
  $no = $_GET['no'];
  //사용자가 선택한 글 번호를 no 변수가 가리키게 함
  include "conn.php";
  $sql = "SELECT * FROM free WHERE no = {$no}";
  //사용자가 선택한 글 만 조회
  $result = mysqli_query($conn, $sql);
  $arr = mysqli_fetch_assoc($result);
  //한 행만 가져오는 함수 사용해서 밑에 내용에 추가되도록
?>
<table border="1" width="100%">
  <tr><th width="20%">번호</th><td><?=$arr['no']?></td></tr>
  <tr><th width="20%">제목</th><td><?=$arr['subject']?></td></tr>
  <tr><th width="20%">작성자</th><td><?=$arr['writer']?></td></tr>
  <tr><th width="20%">작성일</th><td><?=$arr['date']?></td></tr>
  <tr><th width="20%">조회수</th><td><?=$arr['hit']?></td></tr>
  <tr><th width="20%">첨부파일</th>
    <td>
      <?php
      if($arr['upload'] == '')
      {
        echo "";
      }
      else
      {
        echo "<a href='http://192.168.0.95{$arr['upload']}'>{$arr['upload']}</a>";
      }
      ?>
    </td>
  </tr>
  <tr><th colspan="2">본문 내용</th></tr>
<tr><td colspan="2"><textarea cols="100" rows="7" readonly>
    <?=$arr['content']?></textarea></td></tr>
</table>
<br>
<div align="center">
  <input type="button" onclick="location.href='/board.php'" value="목록">
<?php
  if($_SESSION['id'] == $arr['writer'])
  {
?>
  <input type="button" onclick="location.href='/mod.php?no=<?=$no?>'" value="수정">
  <input type="button" onclick="location.href='/del.php?no=<?=$no?>'" value="삭제">
<?php
  }
?>
<div>
<br>
<table border="1" width="100%">
  <form method="POST" action="reply_proc.php">
  <tr>
    <input type="hidden" name="no" value="<?=$no?>">
    <td>작성자<input type="text" name="writer" size="10"></td>
    <td><textarea cols="100" rows="5" name="content"></textarea></td>
    <td><input type="submit" value="댓글등록"></td>
  </tr>
  </form>
</table>

<table border="1" width="100%">
  <tr><th colspan="3">댓글 내용</th></tr>
<?php
  mysqli_free_result($result);
  $sql = "SELECT writer, content, date FROM reply WHERE
          board_name = 'free' AND board_no = {$no}";
  $result = mysqli_query($conn, $sql);
  $arr = mysqli_fetch_all($result, MYSQLI_NUM);
  $rows = mysqli_num_rows($result);
  $fields = mysqli_num_fields($result);

  for($i = 0; $i < $rows; $i++)
  {
    echo "<tr>";
    for($j = 0; $j < $fields; $j++)
    {
      echo "<td>{$arr[$i][$j]}</td>";
    }
    echo "</tr>";
  }
?>
  </table>
<?php //조회 수 증가
  mysqli_free_result($result);
  $sql = "UPDATE free SET hit = hit + 1
            WHERE no = {$no}";
  // free 테이블의 hit 필드 값에 1을 더함. no에 해당하는것만
  mysqli_query($conn, $sql);
  mysqli_close($conn);
?>
