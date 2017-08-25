<?php
include 'conn.php';

date_default_timezone_set("Asia/Seoul");

while(1)
{
$cur_date=date('Y-m-d H:i:m',strtotime('-3 month'));

$sql="select * from user where last_login<='{$cur_date}' and active='1' ";
$result=mysqli_query($conn,$sql);
$rows=mysqli_num_rows($result);
$arr=mysqli_fetch_all($result,MYSQLI_ASSOC);
mysqli_free_result($result);
if($rows)
{	
	echo "총 {$rows}개의 비활성화 대상 계정을 발견했습니다.\n";
	for($i=0; $i<$rows; $i++)
	{
		$sql="update user set active=0 where id='{$arr[$i]['id']}'";
		$result=mysqli_query($conn,$sql);
	}
		if($result)
		{
			echo "{$rows}개의 계정을 비활성화 시켰습니다.\n";
		}
		else
		{
			echo "비활성화에 실패 했습니다.\n";
		}
}
else
{
	echo "현재 조회된 계정이 없습니다.\n";
}
sleep(60);
}
?>