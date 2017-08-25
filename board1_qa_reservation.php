<!DOCTYPE html>
<table border="1">
<meta charset="utf-8">
<script src="http://code.jquery.com/jquery-3.2.1.js"></script>
<form method="post" action="board1_qa_reservation_proc.php" enctype='multipart/form-data'>
<tr>
  <td>작성자</td>
  <td><input type='text' name='writer'></td>
</tr>
<tr>
  <td>제목</td>
  <td><input type='text' name='subject'></td>
</tr>
<tr>
  <td>예약글</td>
  <td><input type='checkbox' name='reserve'>
      <select name='year'></select>
      <select name='month'></select>
      <select name='day'></select>
      <select name='hour'></select>
      <select name='min'></select>
  </td>
</tr>
<tr>
<td>파일 업로드</td>
<td>
  <input type='file' name='attach'>
</td>
</tr>
<tr>
  <td colspan='2'> 본문내용 </td>
</tr>
<tr>
<td colspan='2'> <textarea rows="5" cols="70" name="content"></textarea></td>
</tr>
<tr>
  <td><input type='submit' value='전송'></td>
</tr>
</table>
</form>

<script>
function func()
{
  if($("input[name='reserve']").prop("checked"))
  {
    $("select").show();
  }
  else {
    $("select").hide();
  }
}
$("select").hide();
$("input[name='reserve']").click(func);

for(i=2017; i<=2030; i++)
{
  year="<option value='" + i + "'>" + i + "년</option>";
  $("select[name='year']").append(year);
}

for(i=1; i<=12; i++)
{
  mon="<option value='" + i + "'>" + i + "월</option>";
  $("select[name='mon']").append(mon);
}

for(i=1; i<=31; i++)
{
  day="<option value='" + i + "'>" + i + "일</option>";
  $("select[name='day']").append(day);
}

for(i=0; i<=23; i++)
{
  hour="<option value='" + i + "'>" + i + "시</option>";
  $("select[name='hour']").append(hour);
}

for(i=0; i<=59; i++)
{
  min="<option value='" + i + "'>" + i + "분</option>";
  $("select[name='min']").append(min);
}
function change_func()
{
  year = $("select[name='year'] option:selected").val();
  month = $("select[name='mon'] option:selected").val();
  date = new Date(year, month, 0);
  days = date.getDate();
  $("select[name='day']").text("");

  for(i=1; i<=days; i++)
  {
    day="<option value='" + i + "'>" + i + "일</option>";
    $("select[name='day']").append(day);
  }
}

  $("select[name='mon']").change(change_func);
</script>
