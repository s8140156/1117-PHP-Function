<?php
date_default_timezone_get("Asia/Taipei");
$dsn="mysql:host=localhost;charset=utf8;dbname=school";
$pdo=new PDO($dsn,'root','');
session_start();
// 第三種簡化方式by global 通常會把共通程式放在最上面執行(搭配function find)



function pdo($db){
	$dsn="mysql:host=localhost;charset=utf8;dbname=$db";
	$pdo=new PDO($dsn,'root','');
	// 第二種寫法 可以將相同的函式帶入不同的資料庫 需給予資料庫一個變數

	return $pdo;
	// 確實要記得return阿...
}


function all($table=null,$where='',$other=''){
	// 在all的函式增加$table參數;預設$where為空''
	// $dsn="mysql:host=localhost;charset=utf8;dbname=school";
	// $pdo=new PDO($dsn,'root','');
	$pdo=pdo('school');
	// 所以這邊引用上面的function pdo 所以要把需要的資料庫'school'填上
	$sql="select * from `$table`";

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
				$sql .= " where ".join(" && ",$tmp);
			}
		}else{
			$sql .=" $where";
		}

			$sql .=$other;
		//echo 'all=>' .$sql;
		$rows=$pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
		return $rows;
	}else{
	echo "錯誤:沒有指定的資料表名稱";
	}
}


function find($table,$id){
	// $dsn="mysql:host=localhost;charset=utf8;dbname=school";
	// $pdo=new PDO($dsn,'root','');

	global $pdo;
	// 在這邊引用外部變數$pdo
	$sql="select * from `$table`";

	if(is_array($id)){
		foreach($id as $col => $value){
			$tmp[]="`$col`='$value'";
		}
		$sql .="where" .join(" && ",$tmp);
	}else if(is_numeric($id)){
		$sql .= "where `id`='$id'";
	}else{
		echo "錯誤:參數的資料型態必須是數字或陣列";
	}
	echo 'find=>' .$sql;
	$row=$pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
	return $row;
	// 找一筆而已 把變數變單數
}

function update($table,$id,$cols){
	$dsn="mysql:host=localhost;charset=utf8;dbname=school";
	$pdo=new PDO($dsn,'root','');

	$sql="update `$table` set ";
	if(!empty($cols)){
		foreach($cols as $col => $value){
			$tmp[]="`$col`='$value'";
		}
	}else{
		echo "錯誤:缺少要編輯的欄位陣列";
	}
	$sql .= join(",",$tmp);
	$tmp=[];
	if(is_array($id)){
			foreach($id as $col => $value){
			$tmp[]="`$col`='$value'";
	}
	$sql .="where" .join(" && ",$tmp);
	}else if(is_numeric($id)){
		$sql .= "where `id`='$id'";
	
	}else{
		echo "錯誤:參數的資料型態必須是數字或陣列";
	}
	echo $sql;
	// 這個是測試自己sql語法是否有問題 不是程式碼之一
	return $pdo->exec($sql);
	// update使用exec() 不會列印出回傳值 只會顯示影響列數


}

function insert($table,$values){
	$dsn="mysql:host=localhost;charset=utf8;dbname=school";
	$pdo=new PDO($dsn,'root','');

	$sql="insert into `$table` ";
	$cols="(`".join("`,`",array_keys($values))."`)";
	$vals="('".join("','",$values)."')";


	$sql=$sql .$cols."values".$vals;

	// echo $sql;

	return $pdo->exec($sql);

}

function del($table,$id,){

	// $dsn="mysql:host=localhost;charset=utf8;dbname=school";
	// $pdo=new PDO($dsn,'root','');
	include "pdo.php";
	// 第一種簡化重複的方式: 把常用函式獨立一頁then使用include 
	$sql="delete from `$table` where ";

	if(is_array($id)){
		foreach($id as $col => $value){
			// foreach要把陣列的key value轉成需要的字串
			$tmp[]="`$col`='$value'";
		}
		$sql .= join(" && ",$tmp);
	}else if(is_numeric($id)){
		$sql .= " `id`='$id'";
	}else{
		echo "錯誤:參數的資料型態必須是數字或陣列";
	}

	// echo $sql;


	return $pdo->exec($sql);

}



function dd($array){
	echo "<pre>";
	print_r($array);
	echo "</pre>";
}
// dd direct dump 直接把資料印出來


?>