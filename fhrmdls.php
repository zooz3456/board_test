
아이디,비밀번호,이름,이메일 회원가입 버튼 생성
<script src="http://code.jquery.com/jquery-3.2.1.js"></script>


<table border="1">
<form method="POST" action="ghldnjsrkdlq.php">
<tr><td>id</td><td><input type="text" name="id"><input type="button" name="click" value="중복여부"></td></tr>
<!--<tr><td></td><td><div></div></td></tr>-->
<tr><td>pass</td><td><input type="text" name="pass"></td></tr>
<tr><td>name</td><td><input type="text" name="name"></td></tr>
<tr><td>email</td><td><input type="text" name="email"></td></tr>
<tr><td><input type="submit" name="check" value="회원가입"></td></tr>
</form>
</table>
<script>
function ajax_func(fa)
{
 $("div").text(fa);
}
function click_func()
{
  id = $("input[name='id']").val();
  $.ajax({
    type : "POST",
    url : "idwndqhr.php",
    data : {id:id},
    success : ajax_func
  });
};
 $("input[name='click']").click(click_func);
</script>
<script>
  function check()
  {
    id = $("input[name='id']").val();
    regex = /[^a-z0-9]/i;
    if(id.match(regex))
    {
      alert("아이디 형식과 일치하지 않습니다.");
      return false;
    }
  }
  $("input[name='check']").click(check);
</script>
<script>
  function check()
  {
    pass = $("input[name='pass']").val();
    regex = /[^a-z0-9]{8,}$/i;
    if(pass.match(regex))
    {
      alert("비밀번호 형식과 일치하지 않습니다.");
      return false;
    }
  }
  $("input[name='check']").click(check);
</script>
<script>
  function check()
  {
    email = $("input[name='email']").val();
    regex = /.*[@].*/;
    if(!email.match(regex))
    {
      alert("이메일 형식과 일치하지 않습니다.");
      return false;
    }
  }
  $("input[name='check']").click(check);
</script>
