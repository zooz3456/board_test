
<?php
include 'conn.php';
date_default_timezone_set("Asia/Seoul");
$cur_date = date('Y-m-d H:i:s',time());
//time()
//strtotime("-3 month")
while(1)
{
$sql="select*from reserve where show_date<='{$cur_date}'";
$result=@mysqli_query($conn,$sql);
$rows=@mysqli_num_rows($result);
if($rows)
{
	echo "총{$rows}개의 예약된 게시물을 발견 했습니다.\n";
	for($i=0; $i<$rows; $i++)
	{	$arr=@mysqli_fetch_all($result,MYSQLI_ASSOC);
		if(!isset($arr[$i]['upload']))
		{
			@mysqli_free_result($result);
			$sql="insert into board1_free(writer,subject,content)
				value('{$arr[$i]['writer']}','{$arr[$i]['subject']}','{$arr[$i]['content']}')";
		}
		else
		{
			@mysqli_free_result($result);
			$sql="insert into board1_free(writer,subject,content,upload)
				value('{$arr[$i]['writer']}','{$arr[$i]['subject']}','{$arr[$i]['content']}'
				,'{$arr[$i]['upload']}')";
		}
		$result=@mysqli_query($conn,$sql);
		
		$sql="delete from reserve where no={$arr[$i]['no']}";
		$result=@mysqli_query($conn,$sql);
		}
	echo "예약된 총{$rows}개의 게시물을 작성 했습니다.\n";

}
else
{
	echo "현재 예약된 게시물이 없습니다.\n";
}
sleep(30);
}


?>