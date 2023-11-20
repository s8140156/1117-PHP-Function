<?php

$rows=all('students', "where `dept`='1'");

dd($rows);


function all($table=null,$where=''){
	// 在all的函式增加$table參數;預設$where為空''
	$dsn="mysql:host=localhost;charset=utf8;dbname=school";
	$pdo=new PDO($dsn,'root','');

	if(isset($table) && !empty($table)){
		// 因為將$table參數給予null值(預設)(先佔位) 執行sql會造成fatal而無法執行
		// 所以要寫判斷若有資料表而且不是空值就執行sql
		// 若無 會有error訊息告知沒有指定資料表名稱 但這樣可以執行
		// 在函式中增加參數,提升泛用性(用寬鬆的條件去使用, 只要放個參數、變數上去就大多數可適用)

		if(is_array($where)){

			if(!empty($where)){
				foreach($where as $col => $value){
					$tmp[]="`$col`='$value'";
			}
			$sql="select * from `$table` where" .join(" && ",$tmp);
		}else{
			$sql="select * from `$table`;
		}else{
			$sql="select * from `$table` $where";
		// echo $sql;
		// exit();
		$rows=$pdo->query($sql)->fetchAll();
		return $rows;

	}else{
		echo "Error:沒有指定的資料表名稱";
	}

}

function dd($array){
	echo "<pre>";
	print_r($array);
	echo "</pre>";
}
// dd direct dump 直接把資料印出來


?>