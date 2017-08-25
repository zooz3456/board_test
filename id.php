<meta charset="utf-8">
<script src="http://code.jquery.com/jquery-3.2.1.js"></script>

<form method='POSt' action='id_proc.php'>
<table>
<tr><td>아이디</td><td><input type='text' name='id'>
<input type='hidden' name='checked' value='1'>
<input type='button' name='id_check' value='ID 중복 체크'></td></tr>
<tr><td><div></div></td></tr>
<tr><td>비밀번호</td><td><input type='text' name='pass'></td></tr>
<tr><td>이름</td><td><input type='text' name='name'></td></tr>
<tr><td>이메일</td><td><input type='text' name='email'></td></tr>
</table>
</form>

<script>

function AA()
{
	id=$("input[name='id']").val();
	regex=/[^a-z0-9]/i;
	if(!id.match(regex))
	{
		alert("영문만 사용해 주세요");
		$("input[name='id']").val("");
	}
}

$("input[name='id']").change(AA);

function BB()
{
	pass=$("input[name='pass']").val();
	pass_check=/^[a-z0-9\!_\-\.]{8,}$/i;
	//시작하고 끝을 설정 안해주면 시작과 끝이 조건이 맞을경우 실행이됨
	email_check=/^[a-z0-9_\-\.]+[@][a-z0-9_\-\.]+[\.][a-z]{2,3}$/i;
	blog_check = /^(http)[s]?:\/\/[a-z0-9_\-\.]{1,}[\.][a-z]{2,3}$/i;
	if(pass.match(regex))
	{
		alert("특수문자는 사용 불가능 합니다.");
		$("input[name='pass']").val("");
	}
}

$("input[name='pass']").change(BB);


function func(data)
{
	if(data==1)
	{
	alert('사용중인 아이디 입니다.');
	$("input[name='checked']").val("1");
	}
	else
	{
	alert('사용 가능한 아이디 입니다.');
	$("input[name='checked']").val("0");
	}

function checked()
{
	$("input[name='checked']").val("1");
}	
$("input[name='id']").change(checked);
}

function ids()
{
	id = $("input[name='id']").val();
	$.ajax ({
		type : 'POST',
		url : 'id_check.php',
		data : {id:id},
		success : func
		});
}
$("input[name='id_check']").click(ids);
</script>

