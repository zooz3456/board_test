<html>
<!DOCTYPE html>
<script src="http://code.jquery.com/jquery-3.2.1.js"></script>
<head>
<style>
html{
    background-color: #CEFFE7;
}
table.type06 {
    border-collapse: collapse;
    margin:15px 0;
    margin-bottom : 0px;
}
table.type06 th {
    background: #efefef;
}
table.type06 td {
    font-size:12pt;
    color:black;
    background-color : white;
}
input.button{
    width : 100%;
    height : 66px;
    float:right;
}
</style>
</head>
<body>

<?php SESSION_START(); ?>

<div align='center'>
<form method='POST' action='board1_qa_reservation_proc.php' enctype='multipart/form-data'>
<table class='type06' border="1" width="70%" align='center'>
<tr><th class='type06' width="90px">제목</th><td  class='type06' ><input type='text' name='subject'></td></tr>
<tr><th class='type06' width="90px">작성자</th><td  class='type06'>
<?php
if(isset($_SESSION['id']))
{
?>
<input type='text' name='writer' value='<?=$_SESSION['id']?>' readonly>
<?php
}
else
{
?>
 <input type='text' name='writer'>
<?php
}
?>
</td></tr>
<tr><th width="90px">예약글</th>
<td><input type='checkbox' name='reserve'>
<select name='year'></select>
<select name='month'></select>
<select name='day'></select>
<select name='hour'></select>
<select name='min'></select>
</td></tr>
<tr><th width="90px">첨부파일</th>
<td>
<input type='file' name='attach'>
</td>
<tr><td colspan='2'>본문 내용</td>
</td></tr>
<tr><td colspan="2"  class='type06'><textarea cols='100' rows='7' name='content'>
</textarea></td></tr>
</table>
</div>
<br>
<div align='center'>
<input type='submit' value='작성'>
</form>
<input type='button' value='목록으로'
onclick="location.href='board1_qa_main.php'">
</div>

<script>
function func()
{
if($("input[name='reserve']").prop("checked"))
{
    $("select").show();
}
else
{
    $("select").hide();
}
}
$("select").hide();
$("input[name='reserve']").click(func);

for(i=2017; i<=2030; i++)
{
year="<option value='"+i+"'>"+i+"년</option>";
$("select[name='year']").append(year);
}

for(i=1; i<=12; i++)
{
month="<option value='"+i+"'>"+i+"월</option>";
$("select[name='month']").append(month);
}

for(i=1; i<=31; i++)
{
day="<option value='"+i+"'>"+i+"일</option>";
$("select[name='day']").append(day);
}

for(i=0; i<=23; i++)
{
hour="<option value='"+i+"'>"+i+"시</option>";
$("select[name='hour']").append(hour);
}

for(i=0; i<=59; i++)
{
min="<option value='"+i+"'>"+i+"분</option>";
$("select[name='min']").append(min);
}

function date()
{
year = $("select[name='year']").val();
month = $("select[name='month']").val();
date = new Date(year,month,0);
days = date.getDate();
$("select[name='day']").text("");
    for(i=1; i<=days ; i++)
    {
     day="<option value='"+i+"'>"+i+"일</option>";
     $("select[name='day']").append(day);
    }
}
$("select[name='month']").change(date);
</script>
</body>
</html>
