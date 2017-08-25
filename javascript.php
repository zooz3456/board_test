
<meta charset="utf-8">
<script src="http://code.jquery.com/jquery-3.2.1.js"></script>

<?php
/*$str="문자열";
if($str=="문자열")
{
	echo "문자열 입니다.";
}
else
{
	echo "문자열이 아닙네다.";
}
*/
?>
<!--위쪽의 if구문이 아래쪽의 한줄로 요약가능-->
<!-- $str=="문자열" 부분은 if문 조건에 해당 ?= 구분해주기 위한 표시
		뒤의 문자열 입니다 : 문자열이 아닙니다= 참이냐 거짓이냐를 표시-->
<!--<?/*=$str=="문자열"?"문자열 입니다.":"문자열이 아닙니다."*/?>-->

<!--<form method='POST' action='javascript.php'>
<input type='text'name='phone'>
<input type='submit' name='check' value='전송'>
</form>
-->

<script>

//stock = "500개";
/*아래 regex= 0~9 사이의 숫자를 (^)제외한 값 */
//regex = /[^0-9]/;
/*stock 으로 검사를 진행하다 문자열이 발견되면(위에서 0~9를 제외한 값을 regex로 ) regex를 돌려줘라
의 조건식에 대해 참이므로 문자가 포함됨 이라는 워드가 출력됨*/
/*if(stock.match(regex))
{
	document.write("문자가 포함됨");
	return false;
}
*/
/*  function check()
  {
    stock = $("input[name='stock']").val();
    regex = /^[^0-9]/;
    if(stock.match(regex))
    {
      document.write("문자가 포함됨");
      return false;
    }
  }
  $("input[name='check']").click(check);
*/

/*
str= "https://www.naver.com";
regex = /^(http)[s]?/g;

document.write(str.match(regex));*/

/*
function check()
{
email= $("input[name='phone']").val();
a-_0dmin @ nav-_er.com
regex=/^[0-9]{7}-[1-4]{1}[0-9]{6}$/g;

if(email.match(regex))
{
	document.write("휴대폰 형식에 일치합니다.");
}
else
{
	document.write("휴대폰 형식에 일치하지 않습니다.");
}
}
$("input[name='check']").click(check);
*/

str="admindfwfQFQEFQEfqefqef-246245-4134-234-2351";
regex=/[a-z]/ig;

if(str.match(regex))
{
	alert('아이디 끝에 숫자가 올수 없소');
}
</script>