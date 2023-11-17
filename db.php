<?php

$rows=all('students', "where `dept`='1'");

dd($rows);


function all($table=null,$where=''){
	$dsn="mysql:host=localhost;charset=utf8;dbname=school";
	$pdo=new PDO($dsn,'root','');

	if(isset($table) && !empty($table)){

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

?>