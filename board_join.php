<html>
<!DOCTYPE html>
<script src="http://code.jquery.com/jquery-3.2.1.js"></script>
<head></head>
<body>
<form method='POST' action='board_join_proc.php'>
<div></div>
<table border='0.5' align='center'>
<tr>
<td>아이디</td><td><input type='text' name='id'>
<input type='button' name='id_check' value='ID중복체크'>
<input type='hidden' name='checked' value='1'></td>
</tr>
<tr>
<td>비밀번호</td><td><input type='text' name='pass'></td>
</tr>
<tr>
<td>이름</td><td><input type='text' name='name'></td>
</tr>
<tr>
<td>email</td><td><input type='text' name='email'></td>
</tr>
<tr>
<td align='right'><input type='submit' value='회원가입'></td>
<td> </td>
</tr>
</table>
</form>


</body>
</html>
<script>
function id_check(data)
{
	if(data==1)
	{
		alert('사용중인 ID입니다.');
		$("input[name='checked']").val('1');
	}
	else
	{
		alert('사용 가능한 ID입니다.');
		$("input[name='checked']").val('0');
	}
}

function func()
{
	id = $("input[name='id']").val();
	$.ajax ({
		type : 'POST',
		url : 'board_join_check_proc.php',
		data : {id:id},
		success : id_check
	});
}

$("input[name='id_check']").click(func);
</script>